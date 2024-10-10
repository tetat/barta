<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $posts = $user->posts()->paginate(10);

        return view('users.profile', [
            'title' => $user->firstName,
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3',
        ]);

        $user = User::where('firstName', 'like', '%' . $request->search . '%')
            ->orWhere('lastName', 'like', '%' . $request->search . '%')
            ->orWhere(DB::raw("CONCAT(firstName, ' ', lastName)"), 'like', '%' . $request->search . '%')
            ->orWhere('handle', 'like', '%' . $request->search . '%')
            ->orWhere('email', $request->search)
            ->pluck('id');
        
        if (!isset($user[0])) {
            return back()->withError('Request user not found!');
        }
        return to_route('users.show', $user[0]);
    }
}
