<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $commentable = $this->commentable();
        return [
            'model_id' => $commentable::factory(),
            'model_type' => $commentable,
            'content' => fake()->paragraph(),
        ];
    }

    /**
     * @return mixed
     */
    public function commentable(): mixed
    {
        return $this->faker->randomElement([
            Post::class,
            User::class,
        ]);
    }
}
