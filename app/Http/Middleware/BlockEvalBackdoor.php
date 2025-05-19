<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockEvalBackdoor
{   
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = json_encode($request->all());
        if (preg_match('/eval|base64_decode|system|shell_exec|exec/i', $input)) {
            abort(403, 'Diblokir: Potensi backdoor');
        }
        return $next($request);
    }
}
