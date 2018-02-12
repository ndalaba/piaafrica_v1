<?php namespace App\Http\Middleware;

use Closure;


class Professionnel {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!\Auth::check() || \Auth::user()->droit < 50)
            return  redirect('se-connecter'); //view('auth.login')->withErrors("Page reservée aux professionnels");
        return $next($request);
    }

}
