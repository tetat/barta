<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = DB::table('users')
            ->select([
                'id',
                'firstName',
                'lastName',
                'email',
                'bio'
            ])->where('id', $id)
            ->first();

        return view('user.profile', [
            'title' => $user->firstName . ' ' . $user->lastName,
            'user' => $user,
        ]);
    }

    public function edit(string $id)
    {
        return view('user.edit', [
            'title' => 'Edit',
            'id' => $id,
        ]);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
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
