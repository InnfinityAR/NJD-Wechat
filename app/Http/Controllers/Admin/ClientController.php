<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Client;
use Illuminate\Support\Facades\DB;

class ClientController extends FormController {

    public function index(Request $request, $status = 0) {
        $search = request("search", $default = "");

        $datas = Client::where(function($query)use($status) {
                    if ($status) {
                        $query->where("status", $status);
                    }
                })->where(function($query)use($search) {
                    if ($search) {
                        $query->where("name", "like", "%" . $search . "%");
                    }
                })->orderBy("id", "desc")->paginate(10);

        return view("admin.client.index", compact("datas", "status", "search"));
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
    
}
