<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|min:10',
        ]);

        $validated['user_id'] = Auth::user()->id;

        if (Post::create($validated)) {
            return back()->withSuccess(
                'Your post has been created successfully.'
            );
        }

        return back()->withError('Internal server error!');
    }

    public function edit(string $id)
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'title' => 'Edit Post',
            'user' => Auth::user(),
            'post' => $post
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'body' => 'required|min:10',
        ]);

        if (Post::where('id', $id)
         ->where('user_id', Auth::user()->id)
         ->update($validated)) {
            return back()->withSuccess(
                'Your post has been updated successfully.'
            );
        }
    
        return back()->withError('Update failed! Internal server error.');
    }

    public function destroy(string $id)
    {
        if (Post::where('id', $id)
         ->where('user_id', Auth::user()->id)
         ->delete()) {
            return back()->withSuccess(
                'Your post has been deleted successfully.'
            );
        }
    
        return back()->withError('Internal server error.');
    }
}
