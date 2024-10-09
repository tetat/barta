<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(PostService $postService)
    {
        $user = Auth::user();
        $posts = $postService->getUserPosts($user->id);
        
        return view('users.profile', [
            'title' => $user->first_name . ' ' . $user->last_name,
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', [
            'title' => 'Edit',
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();

        unset($data['current_password']);

        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if (User::where('id', Auth::user()->id)
            ->update($data)) {
            return back()->withSuccess(
                'Your account has been updated successfully.'
            );
        }

        return back()->withError('Update failed! Internal server error.');
    }
}
