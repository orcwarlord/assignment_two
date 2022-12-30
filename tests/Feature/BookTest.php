<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Database\Seeders\BookSeeder;
use Database\Seeders\UserSeeder;
use App\Http\Controllers\BookController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Http\Response;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_books()
    {
        $response = $this->followingRedirects()->get('/books');
        // $response = $this->call('GET','books' );

        $response->assertStatus(200);
    }

    public function test_not_authorised_user_is_redirected()
    {
        $this->followingRedirects()->get('/books')->assertViewIs('auth.login');
    }

    public function test_admin_user_can_see_books()
    {
        $newAdminLevel = User::factory()->create(['userlevel'=>'admin'])->first();
        // Ignore the VSCode error
        $this->actingAs($newAdminLevel)->
            followingRedirects()->
            get('/books')->assertViewIs('books.indexAdmin');
    }

    public function test_user_user_can_see_books()
    {
        $newUserLevel = User::factory()->create(['userlevel' => 'user'])->first();
        // Ignore the VSCode error
        $this->actingAs($newUserLevel)->followingRedirects()->get('/books')->assertViewIs('books.indexUser');
    }

    public function test_admin_user_can_see_book_details()
    {

        $newAdminLevel = User::factory()->create(['userlevel' => 'admin'])->first();
        // echo($newAdminLevel);
        $book = Book::factory()->create(['user_id' => $newAdminLevel->id]);



        // Ignore the VSCode error
        $response = $this->actingAs($newAdminLevel)
            ->followingRedirects()
            ->get("/books/{$book->uuid}");

        $response->assertViewIs('books.show');

        // Get the data used on the page
        $data = $response->original->gatherData();

        //Dump the data
        // dd($data);

        // Check the displayed data for title and synopsis match teh database data.
        $this->assertSame($book->title, $data['book']->title);
        $this->assertSame($book->synopsis, $data['book']->synopsis);
    }

    public function test_user_user_cannot_see_book_details()
    {

        $newUserLevel = User::factory()->create(['userlevel' => 'user'])->first();
        // echo($newAdminLevel);
        $book = Book::factory()->create(['user_id' => $newUserLevel->id]);



        // Ignore the VSCode error
        $response = $this->actingAs($newUserLevel)
            ->followingRedirects()
            ->get("/books/{$book->uuid}");

        $response->assertViewIs('books.show');


    }

    public function test_books_show()
    {

        $newAdminLevel = User::factory()->create(['userlevel' => 'admin'])->first();

        $this->actingAs($newAdminLevel)->followingRedirects()->get('/books')->assertStatus(200);
    }

    public function test_edit_method()
    {
        // First, create a new book instance
        $newUserLevel = User::factory()->create(['userlevel' => 'user'])->first();
        // echo($newAdminLevel);
        $book = Book::factory()->create(['user_id' => $newUserLevel->id]);

        $controller = new BookController();
        $response = $controller->edit($book);

        // Finally, assert that the response is an instance of View, and that it contains the correct data
        $this->assertInstanceOf('Illuminate\View\View', $response);
        $this->assertEquals('books.edit', $response->name());
        $this->assertEquals($book, $response->getData()['book']);
    }

    public function testUpdateMethod()
    {
        // First, create a new book instance
        $newUserLevel = User::factory()->create(['userlevel' => 'admin'])->first();
        // echo($newAdminLevel);
        $book = Book::factory()->create(['user_id' => $newUserLevel->id]);

        // Next, create an instance of your controller and call the update method
        $controller = new BookController();
        $response = $controller->update(request(), $book);

        // Finally, assert that the book instance was updated with the correct data
        $this->assertEquals('title', $book->title);
        $this->assertEquals('synopsis', $book->synopsis);
        $this->assertEquals(100, $book->no_pages);
        $this->assertEquals('1234567890123', $book->isbn);
        $this->assertEquals('2020-01-01', $book->published_date);
        $this->assertEquals('author', $book->author);
        $this->assertEquals(19, $book->user_id);
        $this->assertEquals('https://test-image.com', $book->cover_image);
    }

}
