<?php

namespace App\Http\Controllers\Mobile;

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
        
        // 导航栏
        $nav_map["mobile_show"] = 1;
        $navs = list_to_tree(Nav::where($nav_map)->orderBy("sort", "asc")->get()->toArray());
        unset($navs_map);
        View::share("navs", $navs);
        
    }
    
    // 动态获取城市
    public function getCity(Request $request) {
        $province_id = $request->get("province_id");
        $province_map["pid"] = $province_id;
        
        $cities = Area::where($province_map)->get();
        
        return $cities;
    }
    
    
}
