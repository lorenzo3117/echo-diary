<?php

namespace Database\Factories;

use App\Models\User;
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
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            switch ($user->username) {
                case 'admin':
                    $user->assign('admin');
                    break;
                case 'moderator':
                    $user->assign('moderator');
                    break;
                default:
                    $user->assign('user');
                    break;
            }
        });
    }

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
        ];
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
        ]);
    }
}
