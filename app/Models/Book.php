<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_date'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}


