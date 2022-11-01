<?php

namespace Database\Factories;

use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        // $client = new Client();
        // $res = $client->request('GET', 'https://api.nytimes.com/svc/books/v3/lists/current/hardcover-fiction.json?api-key=0DKnlFF1aAlhv2bAmho7T3iQVwZy4RI4');
        // //  $res = $client->request('GET', 'https://api.nytimes.com/svc/books/v3/lists/full-overview.json?api-key=0DKnlFF1aAlhv2bAmho7T3iQVwZy4RI4');
        // // echo $res->getStatusCode();
        // // // "200"
        // // echo $res->getHeader('content-type')[0];
        // // // 'application/json; charset=utf8'

        // $body = json_decode($res->getBody()->getContents());

        // // foreach ($body->results->books as $book) {
        // //     echo $book->title;
        // // }

        // return [
        //     'uuid' => Uuid::uuid4()->toString(),
        //     'title' => $body->results->books->title,
        //     'synopsis' => $this->faker->realText(500),
        //     'isbn' => $this->faker->isbn13(),
        //     'published_date' => now(),
        // ];
        return [
            'uuid' => Uuid::uuid4()->toString(),
            'title' => $this->faker->words(rand(1, 10), true),
            'synopsis' => $this->faker->realText(500),
            'isbn' => $this->faker->isbn13(),
            'published_date' => now(),
        ];
    }
}
