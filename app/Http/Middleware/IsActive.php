<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\UserHelper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IsActive
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
        if (Auth::check() && UserHelper::isActive(Auth::user())) {
            return $next($request);

        }
        else {
            Auth::logout();

            return new Response(view("unauthorized"));
        }
    }
}