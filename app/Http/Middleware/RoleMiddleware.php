<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $userRole = Auth::user()->role;

        $allowedRoles = is_string($roles) ? explode('|', $roles) : $roles;
        
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        return redirect('/unauthorized')->with('error', 'You do not have access to this page.');
    }
}
