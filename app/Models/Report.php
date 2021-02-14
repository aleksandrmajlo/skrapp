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
        $status = config('reports');
        return $status[$this->status];
    }


    public function scopeSend($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 2);
    }


}
