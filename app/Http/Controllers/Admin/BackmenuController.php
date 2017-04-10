<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Backmenu;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class BackmenuController extends FormController {

    public function index(Request $request, $level = 0) {
        $search = request("search", $default = "");

        $datas = Backmenu::where(function($query)use($level) {
                    if ($level == 1) {
                        $query->where("pid", 0);
                    }
                })->where(function($query)use($search) {
                    if ($search) {
                        $query->where("name", "like", "%" . $search . "%");
                    }
                })->orderBy("id", "desc")->paginate(10);

        return view("admin.backmenu.index", compact("datas", "level", "search"));
    }

    public function create() {
        // 获取顶级菜单
        $map["pid"] = 0;
        $top_menus = Backmenu::where($map)->get();

        return view("admin.backmenu.add", compact("top_menus"));
    }

    public function store(Request $request) {
        if ($input = $request->except("_token")) {
            $res = Backmenu::create($input);

            if ($res) {
                $back["status"] = 1;
                $back["msg"] = "数据添加成功!";

                // 更新存储在session中的backmenu
                if (session("user")->name == config("auth.superAdmin")) {
                    $datas = Backmenu::where("hide", 0)->get()->toArray();
                } else {      // 其他身份用户        
                    $user_id = session("user")->id;
                    // 获取角色
                    $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id");
                    foreach ($role_ids as $role_id) {
                        $node_id = DB::table("role_node")->where("role_id", $role_id)->pluck("node_id");
                        $node_ids[] = $node_id;
                    }
                    unset($node_id);
                    // 获取节点
                    $node_ids = array_unique($node_ids);
                    foreach ($node_ids as $node_id) {
                        $backmenu_id = DB::table("node_backmenu")->where("node_id", $node_id)->pluck("backmenu_id");
                        $backmenu_ids[] = $backmenu_id;
                    }
                    // 获取菜单
                    $backmenu_ids = array_flatten(array_unique($backmenu_ids));
                    $datas = Backmenu::where("hide", 0)->whereIn("id", $backmenu_ids)->orderBy("sort","asc")->get()->toArray();
                }

                // 转换成2维数组
                foreach ($datas as $data) {
                    if ($data["pid"] == 0) {
                        $menus[$data["id"]] = $data;
                    } else {
                        $menus[$data["pid"]]["sub"][] = $data;
                    }
                }
                // 更新session中的menus
                $_SESSION["menus"] = $menus;
            } else {
                $back["status"] = 0;
                $back["msg"] = "数据添加失败!";
            }
            return $back;
        }
    }

    public function edit($id) {
        // 获取顶级分类
        $map["pid"] = 0;
        $top_menus = Backmenu::where($map)->get();

        $field = Backmenu::find($id);
        return view("admin.backmenu.edit", compact("field", "top_menus"));
    }
    

    public function update(Request $request, $id) {
        if ($input = $request->except("_token", "_method")) {
            $res = Backmenu::where("id", $id)->update($input);

            if ($res) {
                $back["status"] = 1;
                $back["msg"] = "数据修改成功!";

                // 更新存储在session中的backmenu
                if (session("user")->name == config("auth.superAdmin")) {
                    $datas = Backmenu::where("hide", 0)->get()->toArray();
                } else {      // 其他身份用户        
                    $user_id = session("user")->id;
                    // 获取角色
                    $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id");
                    foreach ($role_ids as $role_id) {
                        $node_id = DB::table("role_node")->where("role_id", $role_id)->pluck("node_id");
                        $node_ids[] = $node_id;
                    }
                    unset($node_id);
                    // 获取节点
                    $node_ids = array_unique($node_ids);
                    foreach ($node_ids as $node_id) {
                        $backmenu_id = DB::table("node_backmenu")->where("node_id", $node_id)->pluck("backmenu_id");
                        $backmenu_ids[] = $backmenu_id;
                    }
                    // 获取菜单
                    $backmenu_ids = array_flatten(array_unique($backmenu_ids));
                    $datas = Backmenu::where("hide", 0)->whereIn("id", $backmenu_ids)->orderBy("sort","asc")->get()->toArray();
                }

                // 转换成2维数组
                foreach ($datas as $data) {
                    if ($data["pid"] == 0) {
                        $menus[$data["id"]] = $data;
                    } else {
                        $menus[$data["pid"]]["sub"][] = $data;
                    }
                }
                // 更新session中的menus
                $_SESSION["menus"] = $menus;
            } else {
                $back["status"] = 0;
                $back["msg"] = "数据修改失败!";
            }
            return $back;
        }
    }

    public function destroy($id) {
        if (is_string($id)) {
            $id = explode(",", $id);
            $re = Backmenu::whereIn('id', $id)->delete();
        } else {
            $re = Backmenu::where('id', $id)->delete();
        }
        if ($re) {

            // 更新存储在session中的backmenu
            if (session("user")->name == config("auth.superAdmin")) {
                $datas = Backmenu::where("hide", 0)->get()->toArray();
            } else {      // 其他身份用户        
                $user_id = session("user")->id;
                // 获取角色
                $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id");
                foreach ($role_ids as $role_id) {
                    $node_id = DB::table("role_node")->where("role_id", $role_id)->pluck("node_id");
                    $node_ids[] = $node_id;
                }
                unset($node_id);
                // 获取节点
                $node_ids = array_unique($node_ids);
                foreach ($node_ids as $node_id) {
                    $backmenu_id = DB::table("node_backmenu")->where("node_id", $node_id)->pluck("backmenu_id");
                    $backmenu_ids[] = $backmenu_id;
                }
                // 获取菜单
                $backmenu_ids = array_flatten(array_unique($backmenu_ids));
                $datas = Backmenu::where("hide", 0)->whereIn("id", $backmenu_ids)->orderBy("sort","asc")->get()->toArray();
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
            unset($data);

            $data = [
                'status' => 1,
                'msg' => '删除成功！',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    public function insert(Request $request) {
        if ($request->isMethod("post")) {
            $input = $request->except("_token");

            $name = $input["name"];
            $controller_name = ucfirst($input["controller_name"]);
            // 方法数组
            $arr = array(
                array("method" => "index", "name" => "列表"),
                array("method" => "create", "name" => "新增"),
                array("method" => "store", "name" => "新增处理"),
                array("method" => "edit", "name" => "修改"),
                array("method" => "update", "name" => "修改处理"),
                array("method" => "destroy", "name" => "删除"),
            );

            DB::beginTransaction();
            foreach ($arr as $value) {
                $data["name"] = $name . $value["name"];
                $data["pid"] = $input["pid"];
                $data["sort"] = 1;
                if ($value["method"] == "index") {
                    $data["url"] = strtolower($controller_name);
                    $data["hide"] = 0;
                } else {
                    $data["url"] = "";
                    $data["hide"] = 1;
                }
                $data["route"] = $controller_name . "Controller@" . $value["method"];
                $res = Backmenu::create($data);

                if (!$res) {
                    DB::rollback();
                    $back["status"] = false;
                    $back["msg"] = "数据添加失败";
                    return $back;
                }
            }
            DB::commit();
            $back["status"] = true;
            $back["msg"] = "数据添加成功";
            
            // 更新存储在session中的backmenu
            if (session("user")->name == config("auth.superAdmin")) {
                $datas = Backmenu::where("hide", 0)->get()->toArray();
            } else {      // 其他身份用户        
                $user_id = session("user")->id;
                // 获取角色
                $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id");
                foreach ($role_ids as $role_id) {
                    $node_id = DB::table("role_node")->where("role_id", $role_id)->pluck("node_id");
                    $node_ids[] = $node_id;
                }
                unset($node_id);
                // 获取节点
                $node_ids = array_unique($node_ids);
                foreach ($node_ids as $node_id) {
                    $backmenu_id = DB::table("node_backmenu")->where("node_id", $node_id)->pluck("backmenu_id");
                    $backmenu_ids[] = $backmenu_id;
                }
                // 获取菜单
                $backmenu_ids = array_flatten(array_unique($backmenu_ids));
                $datas = Backmenu::where("hide", 0)->whereIn("id", $backmenu_ids)->get()->toArray();
            }

            // 转换成2维数组
            foreach ($datas as $data) {
                if ($data["pid"] == 0) {
                    $menus[$data["id"]] = $data;
                } else {
                    $menus[$data["pid"]]["sub"][] = $data;
                }
            }
            // 更新session中的menus
            $_SESSION["menus"] = $menus;
            
            return $back;
        } else {
            // 获取顶级菜单
            $map["pid"] = 0;
            $top_menus = Backmenu::where($map)->get();

            return view("admin.backmenu.insert", compact("top_menus"));
        }
    }
    
//    // 通过反射类自动获取backmenu
//    public function auto() {
//        // 获取Admin文件夹下的所以文件
//        $dir = dirname(__FILE__);
//        $files = scandir($dir);
//        $namespace = __NAMESPACE__;
//        
//        foreach ($files as $key=>$file){
//            if($key>1){
//                $class_name = $namespace."\\". substr($file, 0, -4);
//                $reflect_class = new ReflectionClass($class_name);
//                $all_methods = $reflect_class->getMethods();
//                foreach ($all_methods as $method){
//                    
//                    if(($method->class == $class_name || $method->class == $namespace."\\FormController" || $method->class == $namespace."\\CommonController")&&(strpos($method->name, "_")===false)){
//                        
//                    }
//                }
//            }
//        }
//        $class = new ReflectionClass("App\Http\Controllers\Admin\UserController");
//    }
    

}
