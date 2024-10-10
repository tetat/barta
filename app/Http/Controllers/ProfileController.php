<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->paginate();
        
        return view('users.profile', [
            'title' => $user->first_name,
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

        $user = User::findOrFail(Auth::user()->id);

        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->bio = $data['bio'];
        if ($data['password']) {
            $user->password = Hash::make($data['password']);
        }
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->file('avatar'))
                ->toMediaCollection('avatar');
        }

        if (!$user->save()) {
            return back()->withError(
                'Update failed! Internal server error.'
            );
        }

        return back()->withSuccess(
            'Your account has been updated successfully.'
        );

    }
}
