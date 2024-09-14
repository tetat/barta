<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}