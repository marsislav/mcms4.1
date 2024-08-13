<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // Check if the request expects a JSON response (e.g., for API requests)
        if (! $request->expectsJson()) {
            // Redirect to the login route if the user is not authenticated
            return route('login');
        }

        // Return null if the request expects JSON, as no redirection is needed
        return null;
    }
}
