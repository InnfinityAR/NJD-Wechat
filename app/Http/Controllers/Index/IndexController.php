<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Model\District;
use App\Http\Model\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Residentialarea;

class IndexController extends CommonController {

    public function index() {
        // 获取小区
        $districts = District::all();
        return view("index.index.index", compact("districts"));
    }

    // 保存用户信息
    public function storeClientInfo(Request $request) {
        $input = $request->except("_token", "code");
        $input['create_time'] = time();

        // 存入数据库
        $res = Client::create($input);
        if ($res) {
            // 第三方评估
            // 自动分配客户
            $result = $this->assignClient($res->id);
            dd($result);
        } else {
            $back["status"] = false;
            $back["msg"] = "信息操作失败！";
        }
        return $back;
    }

    // 自动分配客户给经理
    public function assignClient($client_id) {
        // 获取所有的客户经理
        $user_ids = DB::table("role_user")->where("role_id", 3)->pluck("user_id");

        // 获取提交数量最少的客户经理的id
        foreach ($user_ids as $user_id) {
            $map["user_id"] = $user_id;
            $map["status"] = 2;
            $client_num = Client::where($map)->count();
            $data[] = array("user_id" => $user_id, "client_num" => $client_num);
        }
        $data = array_sort_recursive($data);
        $assign_user_id = $data[0]['user_id'];
        //  分配客户
        $res = Client::where("id", $client_id)->update(["user_id" => $assign_user_id]);

        if ($res) {
            // 发送手机短信
            return true;
        }else{
            return false;
        }
    }
    
    // 动态获取地址
    public function getAddr(Request $request) {
        $search = urldecode($request->get("query"));
        $addrs = Residentialarea::where("residentialname", "like", "%".$search."%")->take(10)->get()->toArray();
        foreach ($addrs as $addr){
            $arr["id"] = $addr["residentialname"];
            $arr["label"] = $addr["residentialname"];
            $data[] = $arr;
        }
        return $data;
    }

}
