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



    public function getLikeData()
    {

        $book = Book::all()->random();
        $user = User::all()->random();

        return [
            'book_id' => $book->{$book->getKeyName()},
            'user_id' => $user->{$user->getKeyName()},
            'is_up' => $this->faker->boolean
        ];

    }

    public function likeExists($likeData)
    {
        return Like::where([
            'book_id' => $likeData['book_id'],
            'user_id' => $likeData['user_id']
        ])->exists();
    }

    public function getValidLikeData()
    {
        $likeData = false;

        while ($likeData === false) {
            $likeData = $this->getLikeData();

            if ($this->likeExists($likeData)) {
                $likeData = false;
            }
        }

        return $likeData;
    }

    public function definition()
    {
        return $this->getValidLikeData();
    }

}
