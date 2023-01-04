<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_id',
        'user_id',
        'is_up',
    ];

    /**
     * Get the post that the like belongs to.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user that liked or disliked the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

