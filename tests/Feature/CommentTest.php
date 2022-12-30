<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Http\Controllers\CommentController;
use Illuminate\Database\Eloquent\Factory;
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
}



