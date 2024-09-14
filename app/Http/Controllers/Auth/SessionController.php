<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionStoreRequest;

class SessionController extends Controller
{
    public function create()
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function store(SessionStoreRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
 
            return to_route('home');
        }
        
        return back()->withError('The provided credentials do not match our records.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return to_route('home');
    }
}