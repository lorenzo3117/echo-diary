<?php

namespace Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFollowingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_follow_themselves(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('user.follow', $user))
            ->assertForbidden();
    }

    public function test_user_cannot_follow_if_already_following(): void
    {
        $follower = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($follower)
            ->followingRedirects()
            ->post(route('user.follow', $following))
            ->assertSuccessful();

        $follower->refresh();

        $this->actingAs($follower)
            ->post(route('user.follow', $following))
            ->assertForbidden();
    }

    public function test_following_user_successful(): void
    {
        $follower = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($follower)
            ->post(route('user.follow', $following))
            ->assertSessionDoesntHaveErrors();

        $this->assertDatabaseHas('user_followings', [
            'follower_id' => $follower->id,
            'following_id' => $following->id,
        ]);
    }

    public function test_user_cannot_unfollow_themselves(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('user.unfollow', $user))
            ->assertForbidden();
    }

    public function test_user_cannot_unfollow_if_not_following(): void
    {
        $follower = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($follower)
            ->delete(route('user.unfollow', $following))
            ->assertForbidden();
    }

    public function test_unfollowing_user_successful(): void
    {
        $follower = User::factory()->create();
        $following = User::factory()->create();

        $this->actingAs($follower)
            ->post(route('user.follow', $following))
            ->assertSessionDoesntHaveErrors();

        $follower->refresh();

        $this->actingAs($follower)
            ->delete(route('user.unfollow', $following))
            ->assertSessionDoesntHaveErrors();

        $this->assertDatabaseMissing('user_followings', [
            'follower_id' => $follower->id,
            'following_id' => $following->id,
        ]);
    }
}
