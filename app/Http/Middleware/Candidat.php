<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class Candidat {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!Auth::check() || Auth::user()->droit < config('application.candidat'))
            return redirect('se-connecter');
        return $next($request);
    }

}
