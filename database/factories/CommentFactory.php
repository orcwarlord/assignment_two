<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;


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
            'body' => $this->faker->realText(500),

        ];
    }
}
