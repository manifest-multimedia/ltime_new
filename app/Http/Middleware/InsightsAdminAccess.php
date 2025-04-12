<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InsightsAdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Add any additional permission checks here
        // For example, checking if user has admin role or specific permissions
        // if (!auth()->user()->hasRole('admin')) {
        //     abort(403);
        // }

        return $next($request);
    }
}