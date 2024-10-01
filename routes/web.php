<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [
        AuthenticatedSessionController::class, 'create'
    ])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('register', [
        RegisteredUserController::class, 'create'
    ])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/users/{id}', [UserController::class, 'show'])
        ->middleware('checkUserExists')
        ->name('users.show');

    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::middleware('authorizeOwnPost')->group(function () {
        Route::get('posts/{id}/edit', [PostController::class, 'edit'])
            ->name('posts.edit');
        Route::post('posts/{id}', [PostController::class, 'update'])
            ->name('posts.update');
        Route::delete('posts/{id}', [PostController::class, 'destroy'])
            ->name('posts.destroy');
    });
});

Route::post('logout', [
    AuthenticatedSessionController::class,
    'destroy'
])->middleware('auth')->name('logout');