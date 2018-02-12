<?php namespace App\Http\Middleware;

use Closure;


class Editeur {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!\Auth::check() || \Auth::user()->droit < config('application.editeur'))
            return view('auth.login')->withErrors("Page reservée aux éditeurs");
        return $next($request);
    }

}
