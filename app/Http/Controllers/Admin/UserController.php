<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Model\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\WebApiController;

class UserController extends FormController {

    public function index(Request $request) {
        $models = new $this->model;
        $input = $request->except('_token');
        $has_key = array_key_exists('search', $input);
        if ($has_key) {
            $search = $input["search"];
        } else {
            $search = "";
        }
        if ($search) {
            //分页追加参数
            $datas = $models::orderBy('id', 'desc')->where('name', 'like', '%' . $input['search'] . '%')->where("name", "!=", "admin")->paginate(10);
            $datas->appends(['search' => $input['search']])->render();
        } else {
            $datas = $models::orderBy('id', 'desc')->where("name", "!=", "admin")->paginate(10);
        }
        return view('admin.' . $this->controller . '.index', compact('datas', 'search'));
    }

    public function create() {
        $roles = Role::all();
        return view("admin.user.add", compact("roles"));
    }

    public function store(Request $request) {
        $user["name"] = $request->get("name");
        $user["password"] = md5($request->get("password"));
        $user["is_active"] = 1;
        $user["logins"] = 0;
        $res = User::create($user);

        $data["user_id"] = $res->id;
        $role_ids = $request->get("role_ids");
        if ($role_ids) {
            foreach ($role_ids as $role_id) {
                $data["role_id"] = $role_id;
                DB::table("role_user")->insert($data);
                unset($data["role_id"]);
            }
        }


        if ($res) {
            $back["status"] = true;
            $back["msg"] = "数据插入成功";
            
        } else {
            $back["status"] = false;
            $back["msg"] = "数据插入失败";
        }
        return $back;
    }

    public function edit($id) {
        $roles = Role::all();
        $field = User::find($id);
        return view('admin.' . $this->controller . '.edit', compact('field', "roles"));
    }

    public function update(Request $request, $id) {
        // 更新user表
        $user["name"] = $request->get("name");
        $password = $request->get("password");
        if ($password) {
            $user["password"] = md5($password);
        }
        $res = User::where("id", $id)->update($user);

        // 更新role_user表
        DB::table("role_user")->where("user_id", $id)->delete();
        $role_ids = $request->get("role_ids");
        $data["user_id"] = $id;
        if ($role_ids) {
            foreach ($role_ids as $role_id) {
                $data["role_id"] = $role_id;
                DB::table("role_user")->insert($data);
                unset($data["role_id"]);
            }
        }

        if ($res !== false) {
            $back["status"] = true;
            $back["msg"] = "数据修改成功";
            
        } else {
            $back["status"] = false;
            $back["msg"] = "数据修改失败";
        }
        return $back;
    }

    // 修改密码
    public function changePwd(Request $request) {
        if ($request->isMethod("post")) {
            $input = $request->except("_token");
            $user_id = session("user.id");
            $user = User::find($user_id);

            if ($user['password'] == md5($input['old_pwd'])) {
                // 开启事务
                DB::beginTransaction();
                $res = User::where("id", $user_id)->update(['password' => md5($input['password'])]);

                if ($res !== false) {
                    // 向第三方同步用户信息
                    $webApi = new WebApiController;
                    $update_user = User::where("id", $id)->first();
                    $result = $webApi->syncUser($update_user);
                    
                    if ($result["status"]) {
                        $back["status"] = true;
                        $back["msg"] = "密码修改成功";
                    } else {
                        // 回滚
                        DB::rollBack();
                        $back["status"] = false;
                        $back["msg"] = "向第三方更新数据时出错";
                    }
                    DB::commit();
                } else {
                    $back["status"] = false;
                    $back["msg"] = "密码修改失败";
                }
            } else {
                $back["status"] = false;
                $back["msg"] = "原密码错误";
            }
            return $back;
        } else {
            return view("admin.user.changePwd");
        }
    }

}
