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
        $r= $bank->contacts()->where('id',$contact->id )->first();
        if($r){
            $bank_data=[
                'date'=>$r->pivot->created_at,
                'status'=>$r->pivot->status,
                'value'=>3
            ];
        }else{
            $report=$bank->reports()->where('contact_id',$contact->id )->first();
            if($report){
                $bank_data=[
                    'date'=>$report->updated_at,
                    'value'=>2
                ];
            }else{
                $bank_data=[
                    'value'=>0
                ];
            }
        }
        return $bank_data;

    }
}
