<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comment;
use Illuminate\Foundation\Auth\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;


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

    // The post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // The book has many likes and dislikes

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    protected function _addLike(User $user, $isUp = true)
    {
        return $this->likes()->create([
            'user_id' => $user->id,
            'is_up' => $isUp
        ]);
    }

    public function addUpLike($user)
    {
        return $this->_addLike($user, true);
    }

    public function addDownLike($user)
    {
        return $this->_addLike($user, false);
    }

    public function scopeWithLikes($query)
    {
        return $query->withCount([
            'likes AS up_likes' => function (Builder $query) {
                $query->where('is_up', true);

            },
            'likes AS down_likes' => function (Builder $query) {
                $query->where('is_up', false);
            }
        ]);
    }


}


