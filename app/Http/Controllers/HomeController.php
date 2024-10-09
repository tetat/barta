<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);

        return view('home', [
            'title' => 'Home',
            'user' => Auth::user(),
            'posts' => $posts
        ]);
    }
}
