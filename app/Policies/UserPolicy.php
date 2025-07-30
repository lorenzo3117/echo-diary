<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function update(User $user1, User $user2): bool
    {
        return $user1->id === $user2->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user1, User $user2): bool
    {
        return $user1->id === $user2->id;
    }
}
