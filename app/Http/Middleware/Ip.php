<?php namespace App\Http\Middleware;

use App\Http\Models\Country;
use Closure;
use Illuminate\Support\Facades\Auth;


class Ip {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!\Session::get('country')) {
            //$ip = '41.77.185.85';//$request->getClientIp();
            $ip = $request->getClientIp();
            $iptolocation = 'http://ip-api.com/json/' . $ip;
            try {
                $creatorlocation = file_get_contents($iptolocation);
                $country = json_decode($creatorlocation);
                if ($country->status == 'success') {
                    \Session::set('country', $country);
                }
                else {
                    \Session::set('country', null);
                }
            } catch (\Exception $e) {
                \Session::set('country', null);
            }
        }
        return $next($request);
    }

}
