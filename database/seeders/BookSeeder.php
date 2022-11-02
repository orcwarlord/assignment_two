<?php

namespace Database\Seeders;

use Faker\Factory;

use App\Models\Book;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        function seedJson($res, $faker)
        {
            $body = json_decode($res->getBody()->getContents());

            $books = $body->results->books;

            foreach ($books as $book) {
                Book::query()->updateOrCreate([
                    'title' => $book->title,
                    'synopsis' => $book->description,
                    'published_date' => $faker->dateTimeBetween($startDate = '-30 year', $endDate = 'now -1 month'),
                    'uuid' => $faker->uuid(),
                    'no_pages' => $faker->numberBetween($min = 150, $max = 1000),
                    'isbn' => $book->primary_isbn13,
                    'cover_image' => $book->book_image,
                    'author' => $book->author,
                    'user_id' => 1
                ]);
            }
        }
        // Book::factory()
        //     ->count(50)
        //     ->create();

        //Get the results from 2 fiction lists and seed

        $faker = Factory::create();

        $clientHB = new Client();
        $clientTPB = new Client();


        $resHB = $clientHB->request('GET', 'https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=0DKnlFF1aAlhv2bAmho7T3iQVwZy4RI4');

        seedJson($resHB,$faker);

        $resTPB = $clientTPB->request('GET', 'https://api.nytimes.com/svc/books/v3/lists/current/trade-fiction-paperback.json?&api-key=0DKnlFF1aAlhv2bAmho7T3iQVwZy4RI4');

        seedJson($resTPB, $faker);




       //Original using Factory - do not selete.

        // return [
        //     'uuid' => Uuid::uuid4()->toString(),
        //     'title' => $body->results->books->title,
        //     'synopsis' => $this->faker->realText(500),
        //     'isbn' => $this->faker->isbn13(),
        //     'published_date' => now(),
        // ];
    }
}

