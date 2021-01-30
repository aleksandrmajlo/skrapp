<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, AuthenticationLogable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'fio',
        'phone',
        'status',
        'upload'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function scopeActiveoperator($query)
    {
        return $query->where('status', '1')->where('role',2);
    }

}
