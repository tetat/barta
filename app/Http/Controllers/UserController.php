<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $posts = $user->posts()->paginate(10);

        return view('users.profile', [
            'title' => $user->firstName,
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
