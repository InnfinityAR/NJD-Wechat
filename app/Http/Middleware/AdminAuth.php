<?php

namespace App\Http\Middleware;
use App\Http\Model\User;
use Illuminate\Support\Facades\Route;

use Closure;

class AdminAuth
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
        // 不是超级管理员
        if(session("user")->name != config("auth.superAdmin")){
            $user_id = session("user")->id;
            // 获取当前路径
            $route = Route::currentRouteAction();
            $uri = str_replace("App\Http\Controllers\Admin\\", "", $route);
            $res = User::hasAction($uri, $user_id);
            if(!$res){
               return redirect("error");
            }
        }
        return $next($request);
    }
}
