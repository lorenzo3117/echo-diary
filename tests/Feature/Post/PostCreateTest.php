<?php

namespace Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $moderator;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->moderator = User::factory()->moderator()->create();
        $this->admin = User::factory()->admin()->create();
    }

    public function test_create_post_screen_redirect_to_login_for_guest(): void
    {
        $this->get(route('post.create'))
            ->assertRedirectToRoute('login');
    }

    public function test_create_post_screen_is_displayed_for_all_roles(): void
    {
        $this->assertSuccessfulCreatePostScreenForUser($this->user);
        $this->assertSuccessfulCreatePostScreenForUser($this->moderator);
        $this->assertSuccessfulCreatePostScreenForUser($this->admin);
    }

    // TODO fix this test, problem with the rich text library
//    public function test_store_valid_post_is_ok_for_all_roles(): void
//    {
//        $this->assertSuccessfulStoreValidPostForUser($this->user);
//        $this->assertSuccessfulStoreValidPostForUser($this->moderator);
//        $this->assertSuccessfulStoreValidPostForUser($this->admin);
//    }

    public function test_store_invalid_post_is_not_ok_for_all_roles(): void
    {
        $this->assertErrorCreateInvalidPostForUser($this->user);
        $this->assertErrorCreateInvalidPostForUser($this->moderator);
        $this->assertErrorCreateInvalidPostForUser($this->admin);
    }

    // TODO fix this test, problem with the rich text library
//    public function test_store_post_without_unique_title_is_not_ok_for_all_roles(): void
//    {
//        $this->assertErrorCreatePostWithoutUniqueTitleForUser($this->user);
//        $this->assertErrorCreatePostWithoutUniqueTitleForUser($this->moderator);
//        $this->assertErrorCreatePostWithoutUniqueTitleForUser($this->admin);
//    }

    private function assertSuccessfulCreatePostScreenForUser(User $user): void
    {
        $this->actingAs($user)
            ->get(route('post.create'))
            ->assertSuccessful();
    }

    private function assertSuccessfulStoreValidPostForUser(User $user): void
    {
        $post = Post::factory()->make();

        $this->actingAs($user)
            ->post(route('post.store'), $post->toArray())
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    private function assertErrorCreateInvalidPostForUser(User $user): void
    {
        $post = Post::factory()->invalid()->make(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('post.store'), $post->toArray())
            ->assertRedirectBack()
            ->assertSessionHasErrors(['title', 'content']);

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    private function assertErrorCreatePostWithoutUniqueTitleForUser(User $user): void
    {
        $post = Post::factory()->create(['user_id' => $this->user->id]);
        $post = Post::factory()->make(['user_id' => $this->user->id, 'title' => $post->title]);

        $this->actingAs($user)
            ->post(route('post.store'), $post->toArray())
            ->assertRedirectBack()
            ->assertSessionHasErrors(['title']);

        $this->assertDatabaseMissing('posts', $post->toArray());
    }
}
