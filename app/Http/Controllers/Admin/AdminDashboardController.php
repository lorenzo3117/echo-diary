<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDashboardFormRequest;
use App\Models\User;
use Illuminate\View\View;
use Silber\Bouncer\Database\Role;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard(AdminDashboardFormRequest $request): View
    {
        $roles = Role::all()->pluck('name', 'id');

        $users = User::query()
            ->when($request->validated('username'), function ($query) use ($request) {
                $query->where('username', 'ilike', '%' . $request->validated('username') . '%');
            })->when($request->validated('email'), function ($query) use ($request) {
                $query->where('email', 'ilike', '%' . $request->validated('email') . '%');
            })->when($request->validated('role'), function ($query) use ($request) {
                $query->whereHas('roles', function ($query) use ($request) {
                    $query->where('roles.id', $request->input('role'));
                });
            })->paginate(10);

        return view('admin.dashboard', [
            'roles' => $roles,
            'users' => $users,
            'input' => $request->validated(),
        ]);
    }
}
