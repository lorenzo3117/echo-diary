<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin
        Bouncer::allow('superadmin')->everything();

        // Routes
        Bouncer::allow('moderator')->to('admin-dashboard');
        Bouncer::allow('admin')->to('admin-dashboard');

        // User
        Bouncer::allow('user')->toOwn(User::class)->to(['edit', 'delete']);
        Bouncer::allow('moderator')->to(['ban'], User::class);
        Bouncer::allow('admin')->to(['ban', 'edit-roles'], User::class);
    }
}
