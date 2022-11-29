<?php

namespace App\Http\Middleware;

use Closure;

class Authorization
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!property_exists(json_decode($request->session()->get('user_data')), 'role') || json_decode($request->session()->get('user_data'))->role != $role) {
            abort(404);
        }

        return $next($request);
    }
}
