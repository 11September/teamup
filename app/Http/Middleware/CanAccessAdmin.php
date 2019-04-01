<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CanAccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->type == 'admin' || Auth::user()->type == 'coach')) {
            return $next($request);
        }
        else {
            Auth::logout();

            return new Response(view("unauthorized"));
        }
    }
}
