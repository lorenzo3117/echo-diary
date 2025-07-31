<?php

namespace Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostUpdateTest extends TestCase
{
    use RefreshDatabase;

    private User $dummy;
    private User $user;
    private User $moderator;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dummy = User::factory()->create();
        $this->user = User::factory()->create();
        $this->moderator = User::factory()->moderator()->create();
        $this->admin = User::factory()->admin()->create();
    }

    public function test_edit_post_screen_redirect_to_login_for_guest(): void
    {
        $this->get(route('post.edit', 1))
            ->assertRedirectToRoute('login');
    }

    public function test_edit_post_screen_is_displayed_for_all_roles_if_owned(): void
    {
        $this->assertOkEditPostScreenForOwner($this->user);
        $this->assertOkEditPostScreenForOwner($this->moderator);
        $this->assertOkEditPostScreenForOwner($this->admin);
    }

    public function test_edit_post_screen_is_not_displayed_for_all_roles_if_not_owned_except_admin(): void
    {
        $post = Post::factory()->create(['user_id' => $this->dummy->id]);

        $this->assertForbiddenEditPostScreenForNonOwner($post, $this->user);
        $this->assertForbiddenEditPostScreenForNonOwner($post, $this->moderator);
        $this->assertSuccessfulEditPostScreenForNonOwnerAdmin($post, $this->admin);
    }

    public function test_update_valid_post_is_ok_for_all_roles_if_owned(): void
    {
        $this->assertOkUpdatePostForOwner($this->user);
        $this->assertOkUpdatePostForOwner($this->moderator);
        $this->assertOkUpdatePostForOwner($this->admin);
    }

    public function test_update_valid_post_is_not_ok_for_not_owned_except_admin(): void
    {
        $post = Post::factory()->create(['user_id' => $this->dummy->id]);

        $this->assertForbiddenUpdatePostForNonOwner($post, $this->user);
        $this->assertForbiddenUpdatePostForNonOwner($post, $this->moderator);
        $this->assertSuccessfulUpdatePostForNonOwnerAdmin($post, $this->admin);
    }

    public function test_update_post_without_unique_title_is_not_ok_for_all_roles(): void
    {
        $this->assertErrorUpdatePostWithoutUniqueTitleForUser($this->user);
        $this->assertErrorUpdatePostWithoutUniqueTitleForUser($this->moderator);
        $this->assertErrorUpdatePostWithoutUniqueTitleForUser($this->admin);
    }

    private function assertOkEditPostScreenForOwner(User $user): void
    {
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('post.edit', $post))
            ->assertOk();
    }

    private function assertForbiddenEditPostScreenForNonOwner(Post $post, User $user): void
    {
        $this->actingAs($user)
            ->get(route('post.edit', $post))
            ->assertForbidden();
    }

    private function assertSuccessfulEditPostScreenForNonOwnerAdmin(Post $post, User $admin): void
    {
        $this->actingAs($admin)
            ->get(route('post.edit', $post))
            ->assertSuccessful();
    }

    private function assertOkUpdatePostForOwner(User $user): void
    {
        $post = Post::factory()->create(['user_id' => $user->id]);
        $post->title = 'New title';

        $this->actingAs($user)
            ->followingRedirects()
            ->put(route('post.update', $post), $post->toArray())
            ->assertSuccessful();

        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    private function assertForbiddenUpdatePostForNonOwner(Post $post, User $user): void
    {
        $post->title = 'New title';

        $this->actingAs($user)
            ->put(route('post.update', $post), $post->toArray())
            ->assertForbidden();
    }

    private function assertSuccessfulUpdatePostForNonOwnerAdmin(Post $post, User $admin): void
    {
        $post->title = 'New title';

        $this->actingAs($admin)
            ->followingRedirects()
            ->put(route('post.update', $post), $post->toArray())
            ->assertSuccessful();
    }

    private function assertErrorUpdatePostWithoutUniqueTitleForUser(User $user): void
    {
        $post1 = Post::factory()->create(['user_id' => $this->user->id]);
        $post2 = Post::factory()->create(['user_id' => $this->user->id]);
        $post2->title = $post1->title;

        $this->actingAs($user)
            ->put(route('post.update', $post2), $post2->toArray())
            ->assertRedirectBack()
            ->assertSessionHasErrors(['title']);
    }
}
