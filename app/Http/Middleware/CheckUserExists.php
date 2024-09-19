<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckUserExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = (int) $request->id;
        
        if ($id != $request->id || str_contains($request->id, '.')) {
            return to_route('home')
                ->withError('The requested user is not exists in Database!');
        }
        if (!DB::table('users')->select(['id'])->where('id', $request->id)->count()) {
            return to_route('home')
                ->withError('The requested user is not exists in Database!');
        }
        return $next($request);
    }
}
