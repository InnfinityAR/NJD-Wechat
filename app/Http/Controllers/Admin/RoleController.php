<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Role;
use App\Http\Model\Node;

class RoleController extends FormController
{
    public function create() {
        $nodes = Node::all();
        return view("admin.role.add", compact("nodes"));
    }
    
    public function store(Request $request) {
        $role["name"] = $request->get("name");
        $role["remark"] = $request->get("remark");
        $res = Role::create($role);
        $data["role_id"] = $res->id;
        $node_ids = $request->get("node_ids");
        foreach ($node_ids as $node_id){
            $data["node_id"] = $node_id;
            DB::table("role_node")->insert($data);
            unset($data["node_id"]);
        }
        
        if($res){
            $back["status"] = true;
            $back["msg"] = "数据插入成功";
        }else{
            $back["status"] = false;
            $back["msg"] = "数据插入失败";
        }
        return $back;
    }
    
    public function edit($id) {
        $nodes = Node::all();
        $field = Role::find($id);
        return view('admin.' . $this->controller . '.edit', compact('field',"nodes"));
    }
    
    public function update(Request $request, $id) {
        // 更新role表
        $role["name"] = $request->get("name");
        $role["remark"] = $request->get("remark");
        $res = Role::where("id",$id)->update($role);
        
        // 更新role_node表
        DB::table("role_node")->where("role_id",$id)->delete();
        $node_ids = $request->get("node_ids");
        $data["role_id"] = $id;
        foreach ($node_ids as $node_id){
            $data["node_id"] = $node_id;
            DB::table("role_node")->insert($data);
            unset($data["node_id"]);
        }
        
        if($res!==false){
            $back["status"] = true;
            $back["msg"] = "数据修改成功";
        }else{
            $back["status"] = false;
            $back["msg"] = "数据修改失败";
        }
        return $back;
    }
}
