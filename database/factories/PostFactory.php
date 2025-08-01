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
            'content' => fake()->randomHtml(10, 10),
            'status' => fake()->randomElement(PostStatus::toArray()),
        ];
    }

    /**
     * Indicate an invalid model.
     */
    public function invalid(): static
    {
        return $this->state(fn(array $attributes) => [
            'title' => null,
            'description' => null,
            'content' => null,
            'status' => null,
        ]);
    }

    /**
     * Indicate a model with a status.
     */
    public function withStatus(PostStatus $status): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => $status->value,
        ]);
    }
}
