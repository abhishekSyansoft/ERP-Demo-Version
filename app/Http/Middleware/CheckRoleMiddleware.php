<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Auth;
use App\Models\mapping;
use DB;
use Illuminate\Support\HtmlString;

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
        return abort(401, 'Oops! Unauthorized Action. Please contact your administrator for assistance.');
    }
}
