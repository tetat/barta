<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = DB::table('users')->select([
            'id',
            'first_name',
            'last_name',
            'email',
            'gender',
            'bio',
            'created_at'
        ])->where('id', $id)->first();

        return view('user.profile', [
            'title' => $user->first_name . ' ' . $user->last_name,
            'user' => $user,
        ]);
    }
}
