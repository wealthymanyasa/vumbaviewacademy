<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check if user is authenticated and has role admin a
        if(!auth()->check() || !auth()->user()->is_admin){
            //if not then return 403
            return abort(403);
        }

        return $next($request);
    }
}
