<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Maintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is([
            'register',
            // 'login',
            // 'dashboard', 
            // 'dashboard/kepeminatan', 
            // 'dashboard/profile',
            // 'kepeminatan',
            // 'product-all',
            'dashboard/sinida',  
            'dashboard/add-product',
            'dashboard.investor',
            'dashboard/product-kemitraan',
            ])) {
            return redirect("/maintenance");
        }
        return $next($request);
    }
}
