<?php

namespace Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostDeleteTest extends TestCase
{
    use RefreshDatabase;

    private User $dummyUser;
    private User $user;
    private User $moderator;
    private User $admin;
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dummyUser = User::factory()->create();
        $this->user = User::factory()->create();
        $this->moderator = User::factory()->moderator()->create();
        $this->admin = User::factory()->admin()->create();

        $this->post = Post::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_guest_cannot_delete_post(): void
    {
        $this->delete(route('post.destroy', $this->post))
            ->assertRedirectToRoute('login');

        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
    }

    public function test_owner_can_delete_own_post(): void
    {
        $this->actingAs($this->user)
            ->delete(route('post.destroy', $this->post))
            ->assertRedirect();

        $this->assertDatabaseMissing('posts', ['id' => $this->post->id]);
    }

    public function test_another_user_cannot_delete_post(): void
    {
        $this->actingAs($this->dummyUser)
            ->delete(route('post.destroy', $this->post))
            ->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
    }

    public function test_moderator_cannot_delete_other_users_post(): void
    {
        $this->actingAs($this->moderator)
            ->delete(route('post.destroy', $this->post))
            ->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
    }

    public function test_admin_cannot_delete_other_users_post(): void
    {
        $this->actingAs($this->admin)
            ->delete(route('post.destroy', $this->post))
            ->assertForbidden();

        $this->assertDatabaseHas('posts', ['id' => $this->post->id]);
    }

    public function test_moderator_can_delete_own_post(): void
    {
        $moderatorPost = Post::factory()->create(['user_id' => $this->moderator->id]);

        $this->actingAs($this->moderator)
            ->delete(route('post.destroy', $moderatorPost))
            ->assertRedirect();

        $this->assertDatabaseMissing('posts', ['id' => $moderatorPost->id]);
    }

    public function test_admin_can_delete_own_post(): void
    {
        $adminPost = Post::factory()->create(['user_id' => $this->admin->id]);

        $this->actingAs($this->admin)
            ->delete(route('post.destroy', $adminPost))
            ->assertRedirect();

        $this->assertDatabaseMissing('posts', ['id' => $adminPost->id]);
    }
}
