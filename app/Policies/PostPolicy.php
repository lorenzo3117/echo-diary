<?php

namespace App\Policies;

use App\Enum\PostStatus;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        if (
            $user->isAdmin()
            && $ability !== 'delete'
            && $ability !== 'favorite'
            && $ability !== 'comment'
        ) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can create a post.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Post $post): bool
    {
        if ($post->status == PostStatus::PUBLISHED->value) {
            return true;
        }

        if ($user === null) {
            return false;
        }

        return $user->isAdmin() || $user->isModerator() || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can view the status of the post.
     */
    public function viewStatus(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->isModerator() || $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can update a post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete a post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can favorite a post.
     */
    public function favorite(User $user, Post $post): bool
    {
        return $post->isPublished();
    }

    /**
     * Determine whether the user can comment on a post.
     */
    public function comment(User $user, Post $post): bool
    {
        return $post->isPublished();
    }
}
