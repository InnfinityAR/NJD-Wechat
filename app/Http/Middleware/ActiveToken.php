<?php

namespace App\Http\Middleware;

use Closure;

class ActiveToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $input = $request->input();
        if (!isset($input["token"])) {
            return response()->json(["status" => 0, "info" => "token验证失败"]);
        }
        list($app_key, $time) = str_split($input["token"], 32);
        $web = md5(config("api.api_key"));
        if (($time < time() - 1600) || ($app_key !== $web)) {                    //10分钟内，正确请求
            return response()->json(["status" => 0, "info" => "请求失败"]);
        }
        return $next($request);
    }

}
