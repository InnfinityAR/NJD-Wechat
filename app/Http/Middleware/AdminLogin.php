<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\View;

use Closure;

class AdminLogin
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
        
        if(!session("user")||!isset($_SESSION["menus"])||$_SESSION["menus"]==null){
            return redirect("/".config("app.admin_prefix")."/login");
        }
        
        return $next($request);
    }
}
