<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Closure;

class Admin
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
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'You need to log in to access this page.');
        }

        // Check if the user has admin privileges
        if (!Auth::user()->admin) {
            Session::flash('info', 'You do not have permissions to perform this action.');

            // Redirect to the intended route or a default route
            return redirect()->route('home'); // or another route you want to redirect to
        }

        return $next($request);
    }
}
