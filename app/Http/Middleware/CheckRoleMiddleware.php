<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;


class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login or return unauthorized response
            return redirect('/login');
        }

        // Check if the user has one of the specified roles
        foreach ($roles as $role) {
            if (Auth::user()->admin == $role) {
                // User has the required role, allow access
                return $next($request);
            }
        }

        // User does not have the required role, return unauthorized response
        return abort(403, 'Oops! Unauthorized Action. Please contact your administrator for assistance.');
    }
}
