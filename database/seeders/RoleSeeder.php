<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Bouncer::allow('admin')->everything();

        // Routes
        Bouncer::allow('moderator')->to('admin-dashboard');

        // User
        Bouncer::allow('moderator')->to(['ban'], User::class);
        Bouncer::allow('admin')->to(['roles'], User::class);

        // Post
        Bouncer::allow('user')->to(['create'], Post::class);
        Bouncer::allow('user')->toOwn(Post::class)->to(['status', 'update', 'delete']);
        Bouncer::allow('moderator')->to(['create', 'status'], Post::class);
        Bouncer::allow('moderator')->toOwn(Post::class)->to(['update', 'delete']);
    }
}
