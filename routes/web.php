<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication routes
require __DIR__ . '/auth.php';

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::prefix('profile/settings')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // User
    Route::post('/user/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
    Route::delete('/user/{user}/unfollow', [UserController::class, 'unfollow'])->name('user.unfollow');

    // Post
    Route::resource('post', PostController::class)
        ->except('show');

    // Admin
    Route::middleware('can:access-admin-dashboard')->prefix('admin')->name("admin.")->group(function () {
        Route::get('', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('/user/{user}/roles', [AdminUserController::class, 'roles'])->name('user.roles');
    });
});

// Unauthenticated routes
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/profile/{user:username}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
