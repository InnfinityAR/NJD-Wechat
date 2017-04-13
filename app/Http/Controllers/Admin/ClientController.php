<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Model\User;

class ClientController extends FormController {

    public function index(Request $request, $status = 0) {
        $search = request("search", $default = "");
        
        $user_ids = DB::table("role_user")->where("role_id", 3)->distinct("user_id")->pluck("user_id")->toArray();
        $users = User::whereIn("id", $user_ids)->get();
        
        // 判断用户角色
        $user_id = session("user")->id;
        $role_ids = DB::table("role_user")->where("user_id", $user_id)->pluck("role_id")->toArray();
        if(in_array(3, $role_ids)){
            $flag = false;
        }else{
            $flag = true;
        }
        
        $datas = Client::where(function($query)use($status) {
                    if ($status) {
                        $query->where("status", $status);
                    }
                })->where(function($query)use($search) {
                    if ($search) {
                        $query->where("tel", "like", "%" . $search . "%");
                    }
                })->where(function($query)use($role_ids, $user_id) {
                    if (in_array(3, $role_ids)) {
                        $query->where("user_id", $user_id);
                    }
                })->orderBy("id", "desc")->paginate(10);
        $datas->appends(['search' => $search])->render();
        
        return view("admin.client.index", compact("datas", "status", "search", "flag","users"));
    }

    // 添加备注
    public function remark(Request $request) {
        $input = $request->except("_token");
        
        $res = Client::where("id", $input["id"])->update($input);
        if($res){
            $return['status'] = true;
        }else{
            $return['status'] = false;
        }
        
        return $return;
    }
    
    // 更改客户状态
    public function changeStatus($id, $status) {
        $res = Client::where("id", $id)->update(["status"=>$status]);
        
        return redirect()->back();
    }
    
    // 分配客户
    public function assign(Request $request) {
        // 获取要分配的客户经理id
        $user_id = $request->get("user_id");
        
        // 分配
        if($user_id){
            $client_ids = $request->get("client_ids");
            $res = Client::whereIn("id", $client_ids)->update(["user_id"=>$user_id]);
            if($res!==false){
                $back["status"] = true;
                $back["msg"] = "分配成功";
            }else{
                $back["status"] = false;
                $back["msg"] = "分配失败";
            }
        }else{
            $back["status"] = false;
            $back["msg"] = "无此客户经理";
        }
        return $back;
    }
    
}
