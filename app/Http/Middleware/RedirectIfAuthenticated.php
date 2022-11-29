<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (json_decode($request->session()->get('user_data')) && json_decode($request->session()->get('user_token') && property_exists(json_decode($request->session()->get('user_data')), 'role'))) {
            switch (json_decode($request->session()->get('user_data'))->role) {
                case 'admin':
                    return redirect(RouteServiceProvider::ADMIN_DEFAULT);
                    break;
                default:
                    return $next($request);
            }
        }

        return $next($request);
    }
}
