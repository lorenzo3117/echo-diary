<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRolesFormRequest;
use App\Models\User;
use Bouncer;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    /**
     * Update the roles of a user.
     */
    public function roles(AdminUserRolesFormRequest $request, User $user): RedirectResponse
    {
        Bouncer::sync($user)->roles($request->validated('roles'));

        return back()->with('success', __('User updated successfully.'));
    }
}
