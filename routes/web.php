<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Authentication routes
require __DIR__ . '/auth.php';

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Admin
    Route::prefix('admin')->name("admin.")->group(function () {
        Route::get('', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    });
});

// Unauthenticated routes
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile.show');
