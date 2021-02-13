<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Contact;
use App\Models\Report;
use App\Models\ContactLog;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;


class ContactAjax extends Controller
{
    public function update(Request $request)
    {
        $contact = Contact::find($request->id);
        $log = new ContactLog;
        $log->user_id = Auth::user()->id;
        $log->contact_id = $request->id;
        $log->type = '2';
        $log->ip = $request->ip();
        $log->input =  json_encode([
            'inn'=>$contact->inn,
            'phone'=>$contact->phone,
            'fullname'=>$contact->fullname,
            'organization'=>$contact->organization,
            'email'=>$contact->email,
            'address'=>$contact->address,
        ]);
        $log->input_new = json_encode([
            'inn'=>$request->inn,
            'phone'=>$request->phone,
            'fullname'=>$request->fullname,
            'organization'=>$request->organization,
            'email'=>$request->email,
            'address'=>$request->address,
        ]);
        $log->save();

        $contact->inn = $request->inn;
        $contact->phone = $request->phone;
        $contact->fullname = $request->fullname;
        $contact->organization = $request->organization;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->save();

        return response()->json(['suc' => true]);
    }

    public function log(Request $request)
    {
        $id = $request->id;
        $contactlogs = ContactLog::where('contact_id', $id)->orderBy('id', 'desc')->get();
        $config = config('contactlog');
        $res_contactlogs = [];
        foreach ($contactlogs as $contactlog) {
            $res_contactlogs[] = [
                'input' => json_decode($contactlog->input),
                'input_new' => json_decode($contactlog->input_new),
                'type' => $config[$contactlog->type],
                'user' => $contactlog->user->email,
                'date'=>$contactlog->created_at->format('d-m-Y h:i:s')
            ];
        }
        return response()->json([
            'contactlogs' => $res_contactlogs,
        ]);

    }

    // отправка данных в банк
    public  function  sendBankContac(Request $request){

        $bank_id = $request->bank_id;
        $city_id = $request->city_id;
        $city = City::where('idd', $city_id)->first();
        $tariff_id = $request->tariff_id;
        $contact_id = $request->contact_id;

        $contact = Contact::find($contact_id);
        $bank_config = config('bank.' . $bank_id);
        $headers = [
            'content-type: multipart/form-data',
            'x-auth-token: '.$bank_config['token']
        ];
        $client = new Client([
            'base_uri' => $bank_config['host'],
        ]);
        if (env('APP_ENV') === 'testing') {
            $url = $bank_config['test_add'];
        } else {
            $url = $bank_config['test_add'];
        }
        $resust = [
            'idd' => null,
            'input' => null
        ];
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

        $report=new Report;
        $report->bank_id=$request->bank_id;
        $report->city=$city->title;
        $report->tariff_id=$request->tariff_id;
        $report->contact_id=$request->contact_id;
        $report->user_id=Auth::user()->id;
        $report->input=$resust['input'];
        $report->idd=$resust['idd'];

        if($resust['input']){
            $report->status=0;
        }else{
            $report->status=1;
        }
        $report->save();

        return response()->json([
            'suc' => true
        ]);

    }
}
