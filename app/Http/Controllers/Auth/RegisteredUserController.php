<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('register', [
            'title' => 'Register',
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $user = $request->validated();

        $user['password'] = Hash::make($user['password']);

        if (User::create($user)) {
            return to_route('login')->withSuccess(
                'Your account has been created successfully! Please login.'
            );
        }

        return back()->withError('Internal server error!');
    }
}
