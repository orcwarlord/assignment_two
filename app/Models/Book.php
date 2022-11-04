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

    // Use UID in URL rather than ID
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    // Relationship with user table
    public function user(){
        return $this->belongsTo(User::class);
    }
}


