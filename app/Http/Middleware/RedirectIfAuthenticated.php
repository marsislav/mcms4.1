<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if the user is authenticated for the given guard
        if (Auth::guard($guard)->check()) {
            // Redirect to the specified route if authenticated
            return redirect('/admin/home');
        }

        // Proceed with the request if the user is not authenticated
        return $next($request);
    }
}
