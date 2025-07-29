<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::factory()->create([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
        ]);
        $superadmin->assign('superadmin');

        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assign('admin');

        $moderator = User::factory()->create([
            'username' => 'moderator',
            'email' => 'moderator@gmail.com',
        ]);
        $moderator->assign('moderator');

        $user = User::factory()->create([
            'username' => 'lorenzo3117',
            'email' => 'lorenzocatalano37@gmail.com',
        ]);
        $user->assign('user');

        User::factory(100)->create()->each(function ($user) {
            $user->assign('user');
        });
    }
}
