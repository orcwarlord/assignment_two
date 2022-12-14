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
        // API called in seeder
        return [
            'uuid' => Uuid::uuid4()->toString(),
            'title' => $this->faker->words(rand(1, 10), true),
            'synopsis' => $this->faker->realText(500),
            'isbn' => $this->faker->isbn13(),
            'published_date' => now(),
            'author' => $this->faker->name,
            'id' =>  $this->faker->unique()->randomNumber,
            'user_id' => '1'
        ];
    }
}
