<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class Annonceur {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!Auth::check() || Auth::user()->droit < config('application.annonceur'))
            return redirect('nous-contacter')->with('message','Vous souhaiter publier des offres emplois. Merci de nous contacter');
        return $next($request);
    }

}
