<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Model\Backmenu;
use App\Http\Model\School;
use App\Http\Model\TradeCate;

class CommonController extends Controller
{
    // 对应的模型
    protected $model;
    protected $controller;
    
    public function __construct() {
        $route = Route::currentRouteAction();
        list($this->controller, $action) = explode('@', $route);

        $this->controller = str_replace("App\Http\Controllers\Admin\\", "", $this->controller);
        $this->controller = strtolower(str_replace("Controller", "", $this->controller));
        
        

        View::share('controller', $this->controller);
        $this->model = 'App\Http\Model\\'.ucfirst($this->controller);
        
        View::share("user", session("user"));
        
        if(isset($_SESSION["menus"])){
            View::share("menus", $_SESSION["menus"]);
        }
        
        // 后台前缀
        $this->admin_prefix = config("app.admin_prefix");
        View::share("admin_prefix", $this->admin_prefix);
        
    }
    

    
    // 改变账号状态
    public function active($id) {
        $map["id"] = $id;
        $model = $this->model;
        $controller = $this->controller;
        $active = $model::where($map)->pluck("is_active")->first();
        if($active){
            $model::where($map)->update(["is_active"=>0]);
        }else{
            $model::where($map)->update(["is_active"=>1]);
        }
        return redirect("/".config("app.admin_prefix")."/" . $controller);
    }
}
