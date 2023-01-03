<?php

use Faker\Factory;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;

use function GuzzleHttp\json_decode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/books', BookController::class)->middleware(['auth']);

// Testing Faker - uncomment adn go to localhost/fakertest (Faker/Factory - Class must be imported)
// Route::get('/fakertest', function () {
//     $faker = Factory::create();
//     $limit = 10;
//     for ($i = 0; $i < $limit; $i++) {
//         echo nl2br('Name: ' . $faker->name . ', Email Address: ' . $faker->unique()->email . ', Contact No: ' . $faker->phoneNumber . "\n");
//     }
// });

Route::get('/apitest', function () {


    $client = new GuzzleHttp\Client();

    $res = $client->request('GET', 'https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=0DKnlFF1aAlhv2bAmho7T3iQVwZy4RI4');

    $body = json_decode($res->getBody()->getContents());

    // dd($res->getBody());
    echo $res->getBody();


});

// Route::post('/comments/store', 'CommentController@store')->name('comment.add');

Route::resource('books.comments', 'App\Http\Controllers\CommentController')->only(['store', 'update', 'destroy'])->middleware('auth');

// Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

require __DIR__.'/auth.php';

Route::post('/books/{book}/up-vote', [BookController::class, 'upVote'])->name('books.upvote')->middleware('auth');

Route::post('/books/{book}/down-vote', [BookController::class, 'downVote'])->name('books.downvote')->middleware('auth');
