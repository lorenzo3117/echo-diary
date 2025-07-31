<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(User $user): View
    {
        $posts = Post::forUser($user);

        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        Gate::authorize('update', User::class);

        $user = Auth::user();

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        Gate::authorize('update', User::class);

        $user = Auth::user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('success', __('Profile updated successfully.'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();
        Gate::authorize('delete', $user);

        $request->validate([
            'password-deletion' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
