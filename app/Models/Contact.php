<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'fullname',
        'organization',
        'inn',
        'email',
        'address',
        'idbank',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
