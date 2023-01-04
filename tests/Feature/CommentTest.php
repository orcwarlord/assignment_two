<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factory;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class StoreCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_submit_a_comment()
    {
        // Arrange
        $newAdminLevel = User::factory()->create(['userlevel' => 'admin'])->first();

        $book = Book::factory()->create(['user_id' => $newAdminLevel->id]);

        $newUserLevel = User::factory()->create(['userlevel' => 'user'])->first();


        $this->actingAs($newUserLevel);

        // Act
        $response = $this->post("/books/{$book->uuid}/comments", [
            'body' => 'This is a test comment',
        ]);

        // Assert
        $response->assertRedirect("/books/{$book->uuid}");
        $this->assertDatabaseHas('comments', [
            'body' => 'This is a test comment',
            'book_id' => $book->id,
            'user_id' => $newUserLevel->id,
        ]);
    }

    public function testDestroyComment()
    {
        // Set up a mock user, book, and comment
        $user = User::factory()->create(['userlevel' => 'user']);
        $book = Book::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create(['book_id' => $book->id, 'user_id' => $user->id, 'body' => 'This is a test comment']);

        // Set the user as authenticated
        $this->actingAs($user);

        // Send a request to the destroy route with the book's uuid and comment's id as parameters
        $response = $this->delete(route('books.comments.destroy', ['book' => $book, 'comment' => $comment]));

        // Assert that the response has the correct status code
        $response->assertStatus(302);

        // Assert that the comment has been deleted from the database
        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);

        // Assert that the response redirects to the book show page
        $response->assertRedirect(route('books.show', $book->uuid));
    }
}



