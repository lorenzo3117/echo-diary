<?php

namespace Database\Factories;

use App\Enum\PostStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(fake()->numberBetween(3, 10), true),
            'description' => fake()->words(fake()->numberBetween(5, 20), true),
            'content' => fake()->sentences(fake()->numberBetween(10, 50), true),
            'status' => fake()->randomElement(PostStatus::toArray()),
        ];
    }
}
