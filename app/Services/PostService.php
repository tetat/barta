<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function getUserPosts(string $user_id)
    {
        $posts = Post::where('user_id', $user_id)
            ->paginate(10);
        
        return $posts;
    }
}