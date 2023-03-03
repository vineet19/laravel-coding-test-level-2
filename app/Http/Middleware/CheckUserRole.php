<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    { 
        if (! in_array(auth()->user()->Role(), $role)) {
            return 'You do not have a permission to access this content';

        }
        return $next($request);
    }
}
