<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Model\Web;
use App\Http\Model\Nav;
use App\Http\Model\Area;

class CommonController extends Controller
{
    public $web;
    
    public function __construct() {
        // 网站基本信息
        $this->web = $web = Web::first();
        View::share("web", $web);
        
        // 顶部导航栏
        $nav_map["is_show"] = 1;
        $nav_map["position"] = 1;
        $navs = list_to_tree(Nav::where($nav_map)->orderBy("sort", "asc")->get()->toArray());
        unset($navs_map);
        View::share("navs", $navs);
        
        // 底部导航
        $bottom_nav_map["is_show"] = 1;
        $bottom_nav_map["position"] = 0;
        $bottom_navs = Nav::where($bottom_nav_map)->orderBy("sort", "asc")->get()->toArray();
        View::share("bottom_navs", $bottom_navs);
        
        // 根据当前路由获取高亮导航id
        $route = Route::getCurrentRoute();
        $uri = $route->uri;
        if(strpos($uri, "introduce")!==false){
            $nav_id = $route->parameters['nav_id'];
            $this->top_nav_id = getTopNavId($nav_id);
        }else{
            $nav_map["url"] = $uri;
            $nav_id = Nav::where($nav_map)->pluck('id')->first();
            $this->top_nav_id = getTopNavId($nav_id);
        }
        View::share("top_nav_id", $this->top_nav_id);
        
    }
    
    // 动态获取城市
    public function getCity(Request $request) {
        $province_id = $request->get("province_id");
        $province_map["pid"] = $province_id;
        
        $cities = Area::where($province_map)->get();
        
        return $cities;
    }
    
    
}
