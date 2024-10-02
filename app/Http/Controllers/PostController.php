<?php

namespace App\Http\Controllers;

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
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        if (DB::table('posts')->insert($validated)) {
            return back()->withSuccess(
                'Your post has been created successfully.'
            );
        }

        return back()->withError('Internal server error!');
    }

    public function edit(string $id)
    {
        $post = DB::table('posts')
            ->select('id', 'body', 'user_id', 'updated_at')
            ->where('id', $id)
            ->first();

        return view('posts.edit', [
            'title' => 'Edit Post',
            'post' => $post
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'body' => 'required|min:10',
        ]);

        $validated['updated_at'] = now();

        if (DB::table('posts')
            ->where('posts.id', $id)
            ->where('posts.user_id', Auth::user()->id)
            ->update($validated)) {
            return back()->withSuccess(
                'Your post has been updated successfully.'
            );
        }
    
        return back()->withError('Update failed! Internal server error.');
    }

    public function destroy(string $id)
    {
        if (DB::table('posts')->where('id', $id)->delete()) {
            return back()->withSuccess(
                'Your post has been deleted successfully.'
            );
        }
    
        return back()->withError('Internal server error.');
    }
}
