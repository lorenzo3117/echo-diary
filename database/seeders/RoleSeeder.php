<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        Bouncer::allow('admin')->everything();

        // Banned
        Bouncer::forbid('banned')->everything();

        // Routes
        Bouncer::allow('moderator')->to('admin-dashboard');

        // User
        Bouncer::allow('user')->toOwn(User::class)->to(['update', 'delete']);
        Bouncer::allow('moderator')->to(['ban'], User::class);
        Bouncer::allow('admin')->to(['roles'], User::class);
    }
}
