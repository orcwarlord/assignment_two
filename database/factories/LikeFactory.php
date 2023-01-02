<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



     public function definition()
    {
        $bookIds = Book::pluck('id')->all();
        $randomBookId = Arr::random($bookIds);
        $userIds = User::pluck('id')->all();
        $randomUserId = Arr::random($userIds);
        return [
            'book_id' => $randomBookId,
            'user_id' => $randomUserId,
            // 'type' => $this->faker->realText(500),
            'type' => $this->faker->randomElement(['like','dislike']),

        ];
    }
}
