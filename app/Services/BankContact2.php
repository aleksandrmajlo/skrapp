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


class BankContact2
{
    private static $bank_id = 2;

    static function ContactData($bank,$contact){
        // тут проверка или есть уже отношение банк
        $bank_data=[];
        $bank_config_all=config('bank');
        $bank_config=$bank_config_all[self::$bank_id];

        $r= $bank->contacts()->where('id',$contact->id )->first();
        if($r){
            if(isset($bank_config["status"][$r->pivot->status])){
                $bank_data=[
                    'date'=>$r->pivot->created_at,
                    'value'=>$bank_config["status"][$r->pivot->status]
                ];
            }
        }else{
            // проверка или отправлялась заявка
            $report=$bank->reports()->where('contact_id',$contact->id )->first();
            if($report){
                // если да и статус 1 - то есть только отправилась
                if($report->status==1){
                    $bank_data=[
                        'date'=>$report->updated_at,
                        'value'=>2
                    ];
                }
            }
        }
        if(empty($bank_data)){
            $bank_data=[
                    'value'=>0
                ];
        }
        return $bank_data;
    }
}
