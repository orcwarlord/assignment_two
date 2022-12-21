<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    // The fields that are mass assignable
    protected $fillable = [
        'book_id',
        'user_id',
        'body',
    ];

    // The comment belongs to a book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // The comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
