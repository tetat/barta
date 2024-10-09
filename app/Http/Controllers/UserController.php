<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PostService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(string $id, PostService $postService)
    {
        $user = User::find($id);

        $posts = $postService->getUserPosts($user->id);

        return view('users.profile', [
            'title' => $user->firstName . ' ' . $user->lastName,
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
