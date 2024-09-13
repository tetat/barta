<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return view('user.profile', [
            'title' => 'Profile',
        ]);
    }

    public function edit()
    {
        return view('user.edit', [
            'title' => 'Edit',
        ]);
    }

    public function update()
    {

    }
}
