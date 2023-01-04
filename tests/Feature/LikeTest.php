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
    public function TestLikesCanBeSaved()
    {
        // Create a mock user and book


        $user = User::factory()->create(['userlevel' => 'user']);
        // dd($user);
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Create a like record for the user and book
        $like = Like::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'is_up' => 1,
        ]);

        $like->save();
        // dd($like);
        $bookController = new BookController();
        $response = $bookController->testLikeExists($like);
        // dd($response);

        // Assert that _likeExists returns true for the given user and book
        $this->assertTrue($response);

        // Assert that _likeExists returns true for the given user and book
        $this->assertTrue($bookController->testLikeExists([
            'book_id' => $book->id,
            'user_id' => $user->id
        ]));
        // Assert that _likeExists returns false for a different book
        $this->assertFalse($bookController->testLikeExists([
            'book_id' => $book->id + 1,
            'user_id' => $user->id
        ]));

        // Assert that _likeExists returns false for a different user
        $this->assertFalse($bookController->testLikeExists([
            'book_id' => $book->id,
            'user_id' => $user->id + 1
        ]));



    }

    public function TestLikesCanBeSavedToDatabase()
    {
        // Create a mock user and book
        $user = User::factory()->create(['userlevel' => 'user']);
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Create a like record for the user and book
        $like = Like::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
            'is_up' => 1,
        ]);

        $like->save();
        $bookController = new BookController();
        $response = $bookController->testLikeExists($like);

        //Assert that the like is saved to the database

        $this->assertDatabaseHas('likes', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'is_up' => 1,
        ]);

    }

    public function testAddLike()
    {
        // Set up a mock user and book
        $user = User::factory()->create(['userlevel' => 'user']);
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Set the user as authenticated
        $this->actingAs($user);

        // Send a request to the like route
        $response = $this->post(route('books.uplike',
            ['book' => $book->uuid]
        ));

        // Assert that the response is a redirect
        $response->assertRedirect();

        // Assert that the correct message is present in the session
        $response->assertSessionHas('success', 'Book liked');

        // Assert that the like has been added to the database
        $this->assertDatabaseHas('likes', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'is_up' => 1,
        ]);
    }

    public function testAddDisike()
    {
        // Set up a mock user and book
        $user = User::factory()->create(['userlevel' => 'user']);
        $book = Book::factory()->create(['user_id' => $user->id]);

        // Set the user as authenticated
        $this->actingAs($user);

        // Send a request to the like route
        $response = $this->post(route(
            'books.downlike',
            ['book' => $book->uuid]
        ));

        // Assert that the response is a redirect
        $response->assertRedirect();

        // Assert that the correct message is present in the session
        $response->assertSessionHas('success', 'Book disliked');

        // Assert that the like has been added to the database
        $this->assertDatabaseHas('likes', [
            'book_id' => $book->id,
            'user_id' => $user->id,
            'is_up' => 0,
        ]);
    }

}



