<?php


namespace App\Services;

use App\Models\Contact;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class Bank2
{
    private static $bank_id=2;
    public static function send($contact_id,$tariff_id,$city){

        $contact = Contact::find($contact_id);
        $bank_config = config('bank.' .self::$bank_id );
        $headers = [
            'content-type: multipart/form-data',
            'x-auth-token: ' . $bank_config['token']
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['test_add'];
        } else {
            $url = $bank_config['add'];
        }
        $resust = [
            'idd' => null,
            'input' => null
        ];

        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['test_add'];
        } else {
            $url = $bank_config['test_add'];
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
            ])->getBody()->getContents();;
            $response = json_decode($response);
            $resust['idd'] = $response->id;

        } catch (RequestException $e) {
            $resust['input']=Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                $resust['input'] =$resust['input']. Psr7\Message::toString($e->getResponse());
            }
        }

        return $resust;


    }
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
            if($response->status=="created"){
                $report->status=2;
                $report->save();
            }
        }
        catch (RequestException $e){
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }
    }
}
