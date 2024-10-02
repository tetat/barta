<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', 'users.id')
            ->select('posts.*', 'users.firstName', 'users.lastName', 'users.handle')
            ->paginate(10);

        return view('home', [
            'title' => 'Home',
            'user' => Auth::user(),
            'posts' => $posts
        ]);
    }
}
