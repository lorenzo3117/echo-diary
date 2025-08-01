<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Follow a user.
     */
    public function follow(User $user): RedirectResponse
    {
        Gate::authorize('follow', $user);

        $user->followers()->attach(Auth::user());

        return redirect()
            ->route('profile.show', $user)
            ->with('success', 'You are now following ' . $user->username . '.');
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(User $user): RedirectResponse
    {
         Gate::authorize('unfollow', $user);

        $user->followers()->detach(Auth::user());

        return redirect()
            ->route('profile.show', $user)
            ->with('success', 'You are no longer following ' . $user->username . '.');
    }
}
