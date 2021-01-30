<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Bank extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public  function  cities(){
        return $this->hasMany(City::class);
    }

    public  function  tariffs(){
        return $this->hasMany(Tariff::class);
    }

}
