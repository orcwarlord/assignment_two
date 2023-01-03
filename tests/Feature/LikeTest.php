<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Like;
use App\Models\User;
use App\Http\Controllers\BookController;
use Illuminate\Database\Eloquent\Factory;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class LikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testLikeExists()
    {
        // Create a mock user and book

        $user = User::factory()->create(['userlevel' => 'user'])->first();
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Create a like record for the user and book
        $like = new Like([
            'book_id' => $book->id,
            'user_id' => $user->id
        ]);
        $like->save();

        // Assert that _likeExists returns true for the given user and book
        $this->assertTrue($this->$book->_likeExists([
            'book_id' => $book->id,
            'user_id' => $user->id
        ]));

        // Assert that _likeExists returns false for a different book
        $this->assertFalse($this->$book->_likeExists([
            'book_id' => $book->id + 1,
            'user_id' => $user->id
        ]));

        // Assert that _likeExists returns false for a different user
        $this->assertFalse($this->$book->_likeExists([
            'book_id' => $book->id,
            'user_id' => $user->id + 1
        ]));
    }
}



