<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    public function user()
     {
         return $this->belongsTo(User::class);
     }


    public function contact()
     {
         return $this->belongsTo(Contact::class);
     }
     

    public function bank()
     {
         return $this->belongsTo(Bank::class);
     }

     public function getTypeAttribute()
        {
            if($this->status=='1'){
                return 'СЧЁТ ОТКРЫТ';
            }
            else{
                return 'АНКЕТА ОТПРАВЛЕНА';
            }
        }

}
