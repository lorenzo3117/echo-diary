<?php

namespace Database\Factories;

use App\Enum\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => UserRole::USER->value,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's username and email address should be that of the test user lorenzo.
     */
    public function lorenzo(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'lorenzo',
            'email' => 'lorenzocatalano37@gmail.com',
        ]);
    }

    /**
     * Indicate that the model's username and email address should be that of a moderator.
     */
    public function moderator(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'moderator',
            'email' => 'moderator@gmail.com',
            'role' => UserRole::MODERATOR->value,
        ]);
    }

    /**
     * Indicate that the model's username and email address should be that of an admin.
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => UserRole::ADMIN->value,
        ]);
    }
}
