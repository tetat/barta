<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\PostService;

class UserController extends Controller
{
    public function show(string $id, PostService $postService)
    {
        $user = DB::table('users')
            ->select([
                'id',
                'firstName',
                'lastName',
                'handle',
                'bio',
            ])
            ->where('id', $id)
            ->first();

        $posts = $postService->getUserPosts($user->id);

        return view('users.profile', [
            'title' => $user->firstName . ' ' . $user->lastName,
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
