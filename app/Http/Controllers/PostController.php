<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(PostStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::user()->id;

        $post = Post::create($validated);
        
        if (!$post) {
            return back()->withError('Internal server error!');
        }

        if ($request->hasFile('picture')) {
            $post->addMedia($request->file('picture'))
                ->toMediaCollection('picture');
        }
        
        return back()->withSuccess(
            'Your post has been created successfully.'
        );
    }

    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        
        $postKey = 'post_' . $id;
        if (!session()->has($postKey)) { // Prevent duplicate view
            $post->increment('views');
            session()->put($postKey, true);  // Mark as viewed in the session
        }

        return view('posts.show', [
            'title' => Auth::user()->firstName,
            'user' => Auth::user(),
            'post' => $post,
        ]);
    }

    public function edit(string $id)
    {
        $post = $post = Post::with('user')->findOrFail($id);

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
        $post = Post::findOrFail($id);

        $post->clearMediaCollection('picture');

        if ($post->delete()) {
            return to_route('profile')->withSuccess(
                'Your post has been deleted successfully.'
            );
        }
    
        return back()->withError('Internal server error.');
    }
}
