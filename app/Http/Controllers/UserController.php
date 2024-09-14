<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return view('user.profile', [
            'title' => Auth::user()->firstName . ' ' . Auth::user()->lastName,
        ]);
    }

    public function edit()
    {
        return view('user.edit', [
            'title' => 'Edit',
        ]);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        // dd($request->validated());

        $data = $request->validated();

        unset($data['current_password']);
        $data['updated_at'] = now();

        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if (DB::table('users')->where('id', $id)->update($data)) {
            return back()->withSuccess(
                'Your account has been updated successfully.'
            );
        }

        return back()->withError('Update failed! Internal server error.');
    }
}
