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

    // 选择城市页面
    public function form() {
        // 获取区
        $districts = District::all();
        return view("index.index.index", compact("districts"));
    }
    
    public function index() {
        return view("index.index.city");
        
    }

    // 保存用户信息
    public function storeClientInfo(Request $request) {
        
        $input = $request->except("_token", "code");
        $input["status"] = 1;
        $input['create_time'] = time();
        
        $map["district"] = $input["district"];
        $map["house_number"] = $input["house_number"];
        $map["house_area"] = $input["house_area"];
        $map["floor"] = $input["floor"];
        $map["house_addr"] = $input["house_addr"];

        if ($client = Client::where($map)->first()) {       // 如果房屋信息已存在数据库则直接读取
            if($client->price){
                $back["status"] = true;
                $back["id"] = $client->id;
            }else{
                $back["status"] = false;
                $back["msg"] = "查询失败！";
            }
        } else {
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
                    $url .= "&city=". urlencode("南京");
                    $url .= "&district=" . urlencode($input["district"]);
                    $url .= "&size=" . $input["house_area"];
                    $url .= "&address=" . urlencode($input["house_addr"]);
                    if($input["house_number"]){
                        $url .= "&buildingNumber=" . urlencode($input["house_number"]);
                    }
                    if($input["floor"]){
                        $url .= "&floor=" . $input["floor"];
                    }
                    if($input["total_floor"]){
                        $url .= "&maxFloor=" . $input["total_floor"];
                    }
                    $result = json_decode(file_get_contents($url), true);
                    
                    if ($result["code"] == 200) {     // 请求成功
                        // 更新用户房屋数据
                        $update_data["price"] = $result["result"]["totalPrice"] / 10000;
                        Client::where("id", $res->id)->update($update_data);
                        
                        $back["id"] = $res->id;
                        $back["status"] = true;
                    }else{
                        $back["status"] = false;
                        $back["msg"] = "暂不支持该小区估价！";
                    }
                } else {
                    $back["status"] = false;
                    $back["msg"] = "第三方验证失败！";
                }
            } else {
                $back["status"] = false;
                $back["msg"] = "信息操作失败！";
            }
        }

        return $back;
    }

    // 展示评估结果
    public function access($client_id) {
        $client = Client::where("id", $client_id)->first();
        $price = $client->price;
        return view("index.index.access", compact("price", "client_id"));
    }

    // 提交申请
    public function apply($client_id, Request $request) {
        // 更新客户期望贷款金额
        $loan_price = $request->get("loan_price");
        Client::where("id", $client_id)->update(["loan_price"=>$loan_price]);
        
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
        // 分配客户
        $update_data["user_id"] = $assign_user_id;
        $update_data["status"] = 2;
        $res = Client::where("id", $client_id)->update($update_data);

        if ($res) {
            // 向客户经理发送短信
            $this->sendMsgToManager($client_id);
            
        } else {
            $back["status"] = false;
        }
        return redirect("/success");
    }
    
    // 申请成功页面
    public function success() {
        return view("index.index.success");
    }

    // 动态获取地址
    public function getAddr(Request $request) {
        
        $search = urldecode($request->get("query"));
        $addrs = Residentialarea::where("residentialname", "like", $search . "%")->distinct()->take(10)->get()->toArray();
        $data = array();
        foreach ($addrs as $addr) {
            $arr["id"] = $addr["residentialname"];
            $arr["label"] = $addr["residentialname"];
            $data[] = $arr;
        }
        return $data;
    }

    // 向客户经理发送信息
    public function sendMsgToManager($client_id) {
        // 存入record
        $client = Client::where("id", $client_id)->first();
        $record_data["send_tel"] = getField($client->user_id, "user", "tel");
        $record_data["create_time"] = $record_data["send_time"] = time();
        $record_data["client_tel"] = $client->tel;
        $sex = $client->sex == 1 ? "先生" : "女士";
        $record_data["client_name"] = $client->name . $sex;
        $record_data["house_addr"] = $client->house_addr;
        $record_data["house_area"] = $client->house_area;
        $record_data["price"] = $client->price."万元";
        $record_data["loan_price"] = $client->loan_price;
        $record_data["status"] = 1;
        $res = Record::create($record_data);

        // 发送手机短信
        if ($res) {
            $datas = array(
                $record_data["client_name"],
                $record_data["house_addr"],
                $record_data["house_area"],
                $record_data["price"],
                $record_data["loan_price"],
                $record_data["client_tel"],
            );
            sendTemplateSMS($record_data["send_tel"], $datas, "167103");
        }
    }

}
