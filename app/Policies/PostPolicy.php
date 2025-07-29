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
    public function view(User $user, Post $post): bool
    {
        if ($post->status == PostStatus::PUBLISHED->value) {
            return true;
        }

        return $user->isAdmin() || $user->isModerator() || $user->id === $post->user_id;
    }
}
