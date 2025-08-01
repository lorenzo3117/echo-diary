<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRolesFormRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends Controller
{
    /**
     * Update the roles of a user.
     */
    public function roles(AdminUserRolesFormRequest $request, User $user): RedirectResponse
    {
        // TODO
//        Bouncer::sync($user)->roles($request->validated('roles'));

        return back()->with('success', __('User updated successfully.'));
    }
}
