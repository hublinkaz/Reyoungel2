<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roles)
    {
//        return collect($roles)->contains(auth()->user()->role_id) ? $next($request) : back();


        if (Auth::user()->role_id !== 1) {
            return redirect()->back();
        }
        return $next($request);

    }
}
