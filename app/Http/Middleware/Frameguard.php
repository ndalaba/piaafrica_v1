<?php

namespace App\Http\Middleware;

use Closure;

class Frameguard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('X-Frame-Options', 'SAMEORIGIN');

        return $next($request);
    }
}
