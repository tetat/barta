<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['title' => 'Home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);
    
    Route::get('register', [
        RegisterController::class, 'create'
    ])->name('register');
    Route::post('register', [
        RegisterController::class, 'store'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
});
