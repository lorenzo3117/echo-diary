<?php

namespace Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_displayed_for_guest(): void
    {

        $response = $this
            ->get('/');

        $response->assertOk();
    }

    public function test_home_page_is_displayed_for_user(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/');

        $response->assertOk();
    }
}
