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
}
