<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['title' => 'Home'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login/create', [SessionController::class, 'create'])->name('login');
    Route::post('/login/store', [SessionController::class, 'store'])->name('login.store');
    
    Route::get('/register/create', [
        RegisterController::class, 'create'
    ])->name('register.create');
    Route::post('/register/store', [
        RegisterController::class, 'store'
    ])->name('register.store');
});

Route::middleware('guest')->group(function () {
    Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
});
