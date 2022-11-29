<?php

namespace App\Http\Middleware;
use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!json_decode($request->session()->get('user_data')) || !json_decode($request->session()->get('user_token'))) {
            return redirect()->route('login')->with('danger', 'Need to login to continue');
        }

        return $next($request);
    }
}
