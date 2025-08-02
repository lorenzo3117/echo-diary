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
        if ($user->isAdmin() && $ability !== 'follow' && $ability !== 'unfollow' && $ability !== 'filter-followings') {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can update the model.
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
        return $user->id !== $model->id;
    }

    /**
     * Determine whether the user can access the admin dashboard.
     */
    public function accessAdminDashboard(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function seeRoles(User $user): bool
    {
        return $user->isModerator();
    }

    /**
     * Determine whether the user can update the roles of the model.
     */
    public function updateRoles(User $user, User $model): bool
    {
        return !$model->isAdmin();
    }

    /**
     * Determine whether the user can follow the model.
     */
    public function follow(User $user, User $model): bool
    {
        return $user->id !== $model->id && !$user->isFollowing($model);
    }

    /**
     * Determine whether the user can unfollow the model.
     */
    public function unfollow(User $user, User $model): bool
    {
        return $user->id !== $model->id && $user->isFollowing($model);
    }

    /**
     * Determine whether the user can filter based on the followings.
     */
    public function filterFollowings(User $user): bool
    {
        return $user->hasFollowings();
    }
}
