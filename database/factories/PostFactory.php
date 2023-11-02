<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();
        return [
            'title' => fake()->title(),
            'content' => fake()->paragraph(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }
}
