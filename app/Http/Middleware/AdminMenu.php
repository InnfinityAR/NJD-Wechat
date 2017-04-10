<?php

namespace App\Http\Middleware;

use App\Http\Model\Backmenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Closure;

class AdminMenu {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        return $next($request);
    }

    // 后置操作
    public function terminate($request, $response) {
        
        if (session("user") != null) {      // 超级管理员
            if (session("user")->name == config("auth.superAdmin")) {
                $datas = Backmenu::where("hide", 0)->get()->toArray();
                
            } else {      // 其他身份用户        
                $user_id = session("user")->id;
                // 获取角色
                $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id")->toArray();
                if ($role_ids) {
                    $node_ids = DB::table("role_node")->whereIn("role_id", $role_ids)->pluck("node_id")->toArray();

                    // 获取节点
                    $node_ids = array_unique($node_ids);
                    if ($node_ids) {
                        $backmenu_ids = DB::table("node_backmenu")->whereIn("node_id", $node_ids)->pluck("backmenu_id")->toArray();
                        // 获取菜单
                        if ($backmenu_ids) {
                            $datas = Backmenu::where("hide", 0)->whereIn("id", $backmenu_ids)->get()->toArray();
                        }
                    }
                }
            }
            
            // 转换成2维数组
            foreach ($datas as $data) {
                if ($data["pid"] == 0) {
                    $menus[$data["id"]] = $data;
                } else {
                    $menus[$data["pid"]]["sub"][] = $data;
                }
            }
            $_SESSION["menus"] = $menus;
        }
    }

}
