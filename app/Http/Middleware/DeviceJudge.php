<?php

/**
 * 判断用户登录设备并跳转对应url
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\View;
use Closure;

class DeviceJudge {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (isMobile() && (strpos($_SERVER['HTTP_HOST'], "m.") === false)) {    // 手机访问PC站
            $url = "http://" . config("app.mobile_url") . $_SERVER['REQUEST_URI'];
            
            return redirect($url);
        }


        return $next($request);
    }

}
