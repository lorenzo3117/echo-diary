<?php

namespace App\Policies;

use App\Enum\PostStatus;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
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
    public function viewStatus(?User $user, Post $post): bool
    {
        if ($user === null) {
            return false;
        }

        return $user->isAdmin() || $user->isModerator() || $user->id === $post->user_id;
    }
}
