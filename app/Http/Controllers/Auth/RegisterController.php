<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register', [
            'title' => 'Register',
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $user = $request->validated();

        $user['password'] = Hash::make($user['password']);
        $user['created_at'] = now();
        $user['updated_at'] = now();

        if (DB::table('users')->insert($user)) {
            return to_route('login')->withSuccess(
                'Your account has been created successfully! Please login.'
            );
        }

        return back()->withError('Internal server error!');
    }
}
