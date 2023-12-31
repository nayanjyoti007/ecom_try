<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $authRole): Response
    {
        // dd($request->user()->role,$authRole);

        if($request->user()->role != $authRole){
            return redirect('dashboard');
        }

        return $next($request);
    }
}
