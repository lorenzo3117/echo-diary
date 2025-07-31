<?php

namespace Feature\Post;

use App\Enum\PostStatus;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostViewTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $moderator;
    private User $admin;

    private Post $draftPost;
    private Post $publishedPost;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        $this->user = User::factory()->create();
        $this->moderator = User::factory()->moderator()->create();
        $this->admin = User::factory()->admin()->create();

        $this->draftPost = Post::factory()->withStatus(PostStatus::DRAFT)->create(['user_id' => $this->user->id]);
        $this->publishedPost = Post::factory()->withStatus(PostStatus::PUBLISHED)->create(['user_id' => $this->user->id]);
    }

    public function test_view_post_successful_if_published_for_all(): void
    {
        $this->get(route('post.show', $this->publishedPost))->assertSuccessful();
        $this->assertSuccessfulViewPostForUser($this->publishedPost, $this->user);
        $this->assertSuccessfulViewPostForUser($this->publishedPost, $this->moderator);
        $this->assertSuccessfulViewPostForUser($this->publishedPost, $this->admin);
    }

    public function test_view_post_not_published_successful_for_owner(): void
    {
        $this->assertSuccessfulViewPostForUser($this->draftPost, $this->user);
    }

    public function test_view_post_not_published_forbidden_for_guest(): void
    {
        $this->get(route('post.show', $this->draftPost))->assertForbidden();
    }

    public function test_view_post_not_published_successful_for_moderator(): void
    {
        $this->assertSuccessfulViewPostForUser($this->draftPost, $this->moderator);
    }

    public function test_view_post_not_published_successful_for_admin(): void
    {
        $this->assertSuccessfulViewPostForUser($this->draftPost, $this->admin);
    }

    private function assertSuccessfulViewPostForUser(Post $post, User $user): void
    {
        $this->actingAs($user)
            ->get(route('post.show', $post))
            ->assertSuccessful();
    }

    private function assertForbiddenViewPostForUser(Post $post, User $user): void
    {
        $this->actingAs($user)
            ->get(route('post.show', $post))
            ->assertForbidden();
    }
}
