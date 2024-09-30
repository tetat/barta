<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = DB::table('users')
            ->select([
                'id',
                'firstName',
                'lastName',
                'handle',
                'email',
                'gender',
                'bio',
                'created_at'
            ])
            ->where('id', $id)
            ->first();

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.firstName', 'users.lastName', 'users.handle')
            ->where('user_id', $id)
            ->get();

        return view('users.profile', [
            'title' => $user->firstName . ' ' . $user->lastName,
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
