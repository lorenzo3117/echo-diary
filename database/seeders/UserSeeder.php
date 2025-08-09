<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create();

        User::factory()
            ->moderator()
            ->create();

        if (app()->environment('local')) {
            User::factory()
                ->lorenzo()
                ->create();

            User::factory(10)
                ->has(Post::factory()->count(20))
                ->create();
        }
    }
}
