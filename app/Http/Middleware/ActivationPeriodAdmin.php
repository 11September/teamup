<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Helpers\SubscribeHelper;
use Illuminate\Support\Facades\Auth;

class ActivationPeriodAdmin
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
        if (Auth::check() && SubscribeHelper::IsSubscriber(Auth::user())) {
            return $next($request);
        }
        else {
            Auth::logout();

            return new Response(view("unauthorized"));
        }
    }
}
