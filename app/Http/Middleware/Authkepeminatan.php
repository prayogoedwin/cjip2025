<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authkepeminatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRoles = Auth::user()->roles->pluck('name')->toArray();

        if (in_array('perusahaan', $userRoles) || in_array('role_lain', $userRoles)) {
            return $next($request);
        }

        return redirect('/');
    }
}
