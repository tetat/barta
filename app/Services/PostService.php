<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PostService
{
    public function getUserPosts(string $user_id)
    {
        $posts = DB::table('posts')
            ->where('user_id', $user_id)
            ->paginate(10);
        
        return $posts;
    }
}