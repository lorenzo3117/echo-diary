<?php

namespace App\Http\Controllers\Admin;

use App\Enum\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminDashboardFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard(AdminDashboardFormRequest $request): View
    {
        Gate::authorize('access-admin-dashboard', User::class);

        $roles = [UserRole::USER->value, UserRole::MODERATOR->value];

        $users = User::query()
            ->when($request->validated('username'), function ($query) use ($request) {
                $query->where('username', 'ilike', '%' . $request->validated('username') . '%');
            })->when($request->validated('email'), function ($query) use ($request) {
                $query->where('email', 'ilike', '%' . $request->validated('email') . '%');
            })->when($request->validated('role'), function ($query) use ($request) {
                $query->whereHas('roles', function ($query) use ($request) {
                    $query->where('roles.id', $request->validated('role'));
                });
            })
            ->orderBy('id')
            ->paginate(10);

        return view('admin.dashboard', [
            'roles' => $roles,
            'users' => $users,
            'input' => $request->validated(),
        ]);
    }
}
