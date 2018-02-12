<?php namespace App\Http\Middleware;

use Closure;


class Administration {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!\Auth::check() || \Auth::user()->droit < config('application.administrateur')) {
           // \Auth::logout();
            return view('auth.login')->withErrors("Page reservée aux administrateurs");
        }
        return $next($request);
    }

}
