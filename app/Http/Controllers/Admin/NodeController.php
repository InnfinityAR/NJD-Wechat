<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Node;
use App\Http\Model\Backmenu;
use Illuminate\Support\Facades\DB;

class NodeController extends FormController
{
    public function create() {
        $backmenus = Backmenu::all();
        return view("admin.node.add", compact("backmenus"));
    }
    
    public function store(Request $request) {
        $input = $request->except("_token");
        
        // 先将节点信息存入节点表
        $node["name"] = $input["name"];
        $node["remark"] = $input["remark"];
        $backmenu_ids = $input["backmenu_ids"];
        $node_id = Node::create($node);
        
        // 将节点和菜单关系存入node_backmenu表
        $data["node_id"] = $node_id->id;
        foreach ($backmenu_ids as $backmenu_id){
            $data["backmenu_id"] = $backmenu_id;
            DB::table("node_backmenu")->insert($data);
            unset($data["backmenu_id"]);
        }
        if($node_id){
            $back["status"] = true;
            $back["msg"] = "数据插入成功";
        }else{
            $back["status"] = false;
            $back["msg"] = "数据插入失败";
        }
        return $back;
    }
    
    public function edit($id) {
        $backmenus = Backmenu::all();
        $field = Node::find($id);
        return view('admin.' . $this->controller . '.edit', compact('field',"backmenus"));
    }
    
    public function update(Request $request, $id) {
        // 更新node表
        $node["name"] = $request->get("name");
        $node["remark"] = $request->get("remark");
        $res = Node::where("id",$id)->update($node);
        
        // 更新node_backmenu表
        DB::table("node_backmenu")->where("node_id",$id)->delete();
        $backmenu_ids = $request->get("backmenu_ids");
        $data["node_id"] = $id;
        foreach ($backmenu_ids as $backmenu_id){
            $data["backmenu_id"] = $backmenu_id;
            DB::table("node_backmenu")->insert($data);
            unset($data["backmenu_id"]);
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
