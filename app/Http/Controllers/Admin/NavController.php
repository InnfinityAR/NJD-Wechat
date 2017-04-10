<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Nav;

class NavController extends FormController {

    public function index(Request $request, $level = 0) {
        $search = request("search", $default = "");

        $datas = Nav::where(function($query)use($level) {
                    if ($level == 1) {
                        $query->where("pid", 0);
                    }
                })->where(function($query)use($search) {
                    if ($search) {
                        $query->where("name", "like", "%" . $search . "%");
                    }
                })->orderBy("id", "desc")->paginate(10);

        return view("admin.nav.index", compact("datas", "level", "search"));
    }

    public function create() {
        $top_navs = Nav::all();
        return view("admin.nav.add", compact("top_navs"));
    }

    public function store(Request $request) {
        $input = $request->except("_token");

        // 根据上级菜单id获取导航等级
        if ($input["pid"] == 0) {
            $input["level"] = 1;
            $input["top_pid"] = 0;
        } else {
            // 获取上级菜单的level然后加一
            $map["id"] = $input["pid"];
            $plevel = Nav::where($map)->pluck("level")->first();
            $input["level"] = $plevel + 1;
            $input["top_pid"] = getTopNavId($input['pid']);
        }
        $res = Nav::create($input);
        
        if($res){
            $back["status"] = true;
            $back["msg"] = "数据添加成功";
        }else{
            $back["status"] = false;
            $back["msg"] = "数据添加失败!";
        }
        return $back;
    }

    public function edit($id) {
        $field = Nav::find($id);
        $top_navs = Nav::all();

        return view("admin.nav.edit", compact("field", "top_navs"));
    }
    
    public function update(Request $request, $id) {
        $input = $request->except("_token","_method");
        
        // 根据上级菜单id获取导航等级
        if ($input["pid"] == 0) {
            $input["level"] = 1;
            $input["top_pid"] = 0;
        } else {
            // 获取上级菜单的level然后加一
            $map["id"] = $input["pid"];
            $plevel = Nav::where($map)->pluck("level")->first();
            $input["level"] = $plevel + 1;
            $input["top_pid"] = getTopNavId($input['pid']);
        }
        $save_map["id"] = $id;
        $res = Nav::where($save_map)->update($input);
        
        if($res!==false){
            $back["status"] = true;
            $back["msg"] = "数据修改成功";
        }else{
            $back["status"] = false;
            $back["msg"] = "数据修改失败!";
        }
        return $back;
    }

}
