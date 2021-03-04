<?php


namespace App\Services;

use App\Models\Contact;
use App\Models\Dublicate;

use App\Models\Log;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use GuzzleHttp\RequestOptions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Bank2
{
    private static $bank_id = 2;

    // отправка заяки  в банк!!!!!!
    public static function send($contact_id, $tariff_id, $city)
    {

        $contact = Contact::find($contact_id);
        $bank_config = config('bank.' . self::$bank_id);
        $headers = [
            'content-type: multipart/form-data',
            'x-auth-token: ' . $bank_config['token']
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);

//        if (env('APP_ENV') === 'testing') {
//            $url = $bank_config['test_add'];
//        } else {
//            $url = $bank_config['add'];
//        }

        $resust = [
            'idd' => null,
            'input' => null
        ];

        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['test_add'];
        } else {
            $url = $bank_config['add'];
        }

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'multipart' => [
                    [
                        'name' => 'full_name',
                        'contents' => $contact->fullname
                    ],
                    [
                        'name' => 'inn',
                        'contents' => $contact->inn
                    ],
                    [
                        'name' => 'email',
                        'contents' => $contact->email
                    ],
                    [
                        'name' => 'phone',
                        'contents' => $contact->phone
                    ],
                    [
                        'name' => 'tariff',
                        'contents' => $tariff_id
                    ],
                    [
                        'name' => 'city',
                        'contents' => $city->title,
                    ],
                ]
            ])->getBody()->getContents();
            $response = json_decode($response);
            $resust['idd'] = $response->id;
            // логирование
            $log = Log::create([
                'request' => [
                    'contact_id' => $contact_id,
                    'tariff_id' => $tariff_id,
                    'city' => $city->title,
                    'bank_id' => self::$bank_id
                ],
                'answer' => ['idd' => $response->id],
                'type' => 'POST ' . $bank_config['host'] . $url,
            ]);

        } catch (RequestException $e) {

            $resust['input'] = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $resust['input'] = $resust['input'] . Psr7\Message::toString($e->getResponse());
            }
            // логирование
            $log = Log::create([
                'request' => [
                    'contact_id' => $contact_id,
                    'tariff_id' => $tariff_id,
                    'bank_id' => self::$bank_id,
                    'city' => $city->title,
                ],
                'answer' => ['error' => $resust['input']],
                'type' => 'POST ' . $bank_config['host'] . $url,
            ]);
        }

        return $resust;


    }

    // проверка статуса отправленной заявки
    public static function check($report)
    {
        $id = $report->idd;
        $bank_config = config('bank.' . $report->bank_id);


        $headers = [
            'x-auth-token: ' . $bank_config['token']
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['get_status_test'] . $id;
        } else {
            $url = $bank_config['get_status'] . $id;
        }
        try {
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ])->getBody()->getContents();
            $response = json_decode($response);
            // логирование
            $log = Log::create([
                'request' => [
                    'report' => $report,
                    'bank_id' => self::$bank_id
                ],
                'answer' => $response,
                'type' => 'GET ' . $bank_config['host'] . $url,
            ]);
            // логирование end
            $status = 2;
            if (isset($bank_config['statusText'][$response->status])) {
                $status = $bank_config['statusText'][$response->status]["status"];
            }
            $report->status = $status;
            $report->save();

            $r = DB::table('bank_contact')
                ->where('contact_id', $report->contact_id)
                ->where('bank_id', self::$bank_id)
                ->first();

            if ($r) {
                DB::table('bank_contact')
                    ->where('contact_id', $report->contact_id)
                    ->where('bank_id', self::$bank_id)
                    ->update([
                        'status' => $response->status,
                        'message' => $response->label,
                        'updated_at' => Carbon::now()
                    ]);
            } else {
                DB::table('bank_contact')->insert([
                    'contact_id' => $report->contact_id,
                    'bank_id' => self::$bank_id,
                    'status' => $response->status,
                    'message' => $response->label,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

        } catch (RequestException $e) {
            $error = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $error .= Psr7\Message::toString($e->getResponse());
            }

            // логирование
            $log = Log::create([
                'request' => [
                    'report' => $report,
                    'bank_id' => self::$bank_id
                ],
                'answer' => ['error' => $error],
                'type' => 'GET ' . $bank_config['host'] . $url,
            ]);

        }
    }

    // отправка запроса на дублирование
    public static function InnDublicate($inns)
    {
        $bank_config = config('bank.' . self::$bank_id);
        $headers = [
            'x-auth-token: ' . $bank_config['token'],
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['inn_dublicate_test'];
        } else {
            $url = $bank_config['inn_dublicate'];
        }
        try {
            $response = $client->post($url, [
                'headers' => $headers,
                RequestOptions::JSON => ['inns' => $inns],
            ])->getBody()->getContents();
            $response = json_decode($response);
            $log = Log::create([
                'request' => ['inns' => $inns],
                'answer' => $response,
                'type' => 'POST ' . $bank_config['host'] . $url,
            ]);
            $duplicate = Dublicate::create([
                'idd' => $response->id,
                'inns' => $inns,
                'bank_id' => self::$bank_id
            ]);
        } catch (RequestException $e) {
            $error = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $error .= Psr7\Message::toString($e->getResponse());
            }
            $log = Log::create([
                'request' => ['inns' => $inns],
                'answer' => ['error' => $error],
                'type' => 'POST ' . $bank_config['host'] . $url,
            ]);
        }
    }

    // проверка отправленной задачи на дубли
    public static function InnDublicateCheck($duplikate)
    {
        $bank_config = config('bank.' . self::$bank_id);
        $headers = [
            'x-auth-token: ' . $bank_config['token'],
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['inn_dublicate_get_test'] . $duplikate->idd;
        } else {
            $url = $bank_config['inn_dublicate_get'] . $duplikate->idd;
        }
        try {
            $response = $client->request('GET', $url, [
                'headers' => $headers
            ])->getBody()->getContents();
            $response = json_decode($response);
            if ($response->status == "done") {
                $duplikate->status = 1;
                $duplikate->response = $response;
                $duplikate->save();
                $inns = $response->result->inns;
                // логирование
                $log = Log::create([
                    'request' => ['idd' => $duplikate->idd],
                    'answer' => $response,
                    'type' => 'GET ' . $bank_config['host'] . $url,
                ]);
                if ($inns) {
                    foreach ($inns as $inn) {
                        $contacts = Contact::where('inn', $inn->inn)->get();
                        if ($contacts) {
                            $message = null;
                            if (isset($inn->message)) $message = $inn->message;
                            foreach ($contacts as $contact) {
                                $r = DB::table('bank_contact')
                                    ->where('contact_id', $contact->id)
                                    ->where('bank_id', self::$bank_id)
                                    ->first();
                                if ($r) {
                                    DB::table('bank_contact')
                                        ->where('contact_id', $contact->id)
                                        ->where('bank_id', self::$bank_id)
                                        ->update([
                                            'status' => $inn->inn_status,
                                            'message' => $message,
                                            'updated_at' => Carbon::now()
                                        ]);
                                } else {
                                    DB::table('bank_contact')->insert([
                                        'contact_id' => $contact->id,
                                        'bank_id' => self::$bank_id,
                                        'status' => $inn->inn_status,
                                        'message' => $message,
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now()

                                    ]);
                                }
                            }
                        }

                    }
                }

            }
        } catch (RequestException $e) {
            $error = Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $error .= Psr7\Message::toString($e->getResponse());
            }
            // логирование
            $log = Log::create([
                'request' => ['idd' => $duplikate->idd],
                'answer' => ['error' => $error],
                'type' => 'GET ' . $bank_config['host'] . $url,
            ]);
        }


    }

}
