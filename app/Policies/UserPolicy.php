<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user1, User $model): bool
    {
        return $user1->id === $model->id;
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function seeRoles(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function updateRoles(User $user, User $model): bool
    {
        return $user->isAdmin() && !$model->isAdmin();
    }
}
