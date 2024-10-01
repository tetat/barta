<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeOwnPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = DB::table('posts')->select('user_id')->where('id', $request->id)->first();
        
        if ($post->user_id != Auth::user()->id) {
            return to_route('home')
                ->withError('Your are not authorize for this request!');
        }
        return $next($request);
    }
}
