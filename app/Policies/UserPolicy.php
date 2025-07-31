<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function update(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can see the admin dashboard.
     */
    public function accessAdminDashboard(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function seeRoles(User $user): bool
    {
        return $user->isModerator() && $user->isAdmin();
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function updateRoles(User $user, User $model): bool
    {
        return $user->isAdmin() && !$model->isAdmin();
    }
}
