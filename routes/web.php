<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home'
    ]);
})->name('home');

Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
