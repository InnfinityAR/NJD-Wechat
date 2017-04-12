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
use App\Http\Model\Record;

class IndexController extends CommonController {

    public function index() {
        // 获取小区
        $districts = District::all();
        return view("index.index.index", compact("districts"));
    }

    // 保存用户信息
    public function storeClientInfo(Request $request) {
        $input = $request->except("_token", "code");
        $input["status"] = 1;
        $input['create_time'] = time();

        // 存入数据库
        $res = Client::create($input);
        if ($res) {
            // 获取token
            $username = config("api.fang_username");
            $password = config("api.fang_password");
            $appkey = config("api.fang_appkey");
            $token_url = "http://open.fangjia.com/accessToken?username=$username&password=$password&appKey=$appkey";
            $token_result = json_decode(file_get_contents($token_url), true);
            $token = $token_result["result"]["token"];

            if ($token) {
                // 第三方评估
                $url = "http://open.fangjia.com/property/transaction";
                $url .= "?token=$token";
                $url .= "&serviceCode=S001";
                $url .= "&city=南京";
                $url .= "&district=" . $input["district"];
                $url .= "&buildingNumber=" . $input["house_number"];
                $url .= "&size=" . $input["house_area"];
                $url .= "&floor=" . $input["floor"];
                $url .= "&maxFloor=" . $input["total_floor"];
                $url .= "&name=" . $input["house_addr"];
                $result = file_get_contents($url);
                dd($result);
                if ($result["code"] == 200) {     // 请求成功
                    // 更新用户房屋数据
                    $update_data["price"] = $result["result"]["totalPrice"];
                    $update_data["average_price"] = $result["result"]["avgPrice"];
                    Client::where("id", $res->id)->update($update_data);
                    
                }
            } else {
                $back["status"] = false;
                $back["msg"] = "查询失败！";
            }
        } else {
            $back["status"] = false;
            $back["msg"] = "信息操作失败！";
        }
        return $back;
    }
    
    // 展示评估结果
    public function assessResult($client_id) {
        
    }
    
    // 提交申请
    public function apply($client_id) {
        // 将用户分配给客户经理同时status改为已申请
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
            $this->sendMsgToManager($client_id);
            $back["status"] = true;
        } else {
            $back["status"] = false;
        }
        return $back;
    }


    // 动态获取地址
    public function getAddr(Request $request) {
        $search = urldecode($request->get("query"));
        $addrs = Residentialarea::where("residentialname", "like", "%" . $search . "%")->take(10)->get()->toArray();
        foreach ($addrs as $addr) {
            $arr["id"] = $addr["residentialname"];
            $arr["label"] = $addr["residentialname"];
            $data[] = $arr;
        }
        return $data;
    }
    
    public function sendMsgToManager($client_id) {
        // 存入record
        $client = Client::where("id", $id)->first();
        $record_data["send_tel"] = getField($client->user_id, "user", "tel");
        $record_data["create_time"] = $record_data["send_time"] = time();
        $record_data["client_tel"] = $client->tel;
        $sex = $client->sex == 1 ? "先生" : "女士";
        $record_data["client_name"] = $client->name . $sex;
        
        // 发送手机短信
        if($res){
            
        }
    }

}
