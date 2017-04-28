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

    public function __construct() {

        $timestamp = time();

        $wxticket = $this->wx_get_jsapi_ticket();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        $string = "jsapi_ticket=$wxticket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);


        $share = "<script type='text/javascript' src='http://res.wx.qq.com/open/js/jweixin-1.0.0.js'></script>

        <script type='text/javascript'>

        // 微信配置

        wx.config({

            debug: false, 

            appId: 'wx38c340857b01b091', 

            timestamp: '{$timestamp}', 

            nonceStr: '{$nonceStr}', 

            signature: '{$signature}',

            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage'] 

        });

        wx.ready(function(){
            
            wx.onMenuShareTimeline({
                title: '南京贷房屋抵押贷快速申请平台', // 分享标题

                link:'http://wechat.yiyuling.com',

                imgUrl: 'http://wechat.yiyuling.com/njd.png' // 分享图标

            });

            // 获取“分享给朋友”按钮点击状态及自定义分享内容接口

            wx.onMenuShareAppMessage({

                title: '南京贷房屋抵押贷快速申请平台', // 分享标题

                desc: '南京贷房屋抵押贷款快速申请平台;填写房屋地址,预测房屋价值,线上申请额度,快速实现下款', // 分享描述

                link: 'http://wechat.yiyuling.com',

                imgUrl: 'http://wechat.yiyuling.com/njd.png', // 分享图标

                type: 'link', // 分享类型,music、video或link，不填默认为link

            });

        });

        </script>";

        View::share("wechat", $share);
    }

    private function wx_get_token() {

        $token = "";

        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        } else {
            $res = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx38c340857b01b091&secret=bbfd9a759caf80803de607a04954090c', false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
            

            $res = json_decode($res, true);

            $token = $res['access_token'];


            $_SESSION['token'] = $token;
        }

        return $token;
    }

    private function createNonceStr($length = 16) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function wx_get_jsapi_ticket() {

        $ticket = "";

        do {

            if (isset($_SESSION['wx_ticket'])) {

                $ticket = $_SESSION['wx_ticket'];
                
                if (!empty($ticket)) {

                    break;
                }
            }

            $token = "";
            if (isset($_SESSION['token'])) {
                $this->wx_get_token();
                $token = $_SESSION['token'];
            } else {
                $token = $_SESSION['token'];
            }

            if (empty($token)) {

                logErr("get access token error.");

                break;
            }

            $url2 = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token}&type=jsapi";

            $res = file_get_contents($url2, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));

            $res = json_decode($res, true);

            $ticket = $res['ticket'];

            $_SESSION['wx_ticket'] = $ticket;
        } while (0);

        return $ticket;
    }

    // 选择城市页面
    public function form() {
        // 获取区
        $districts = District::all();
        return view("index.index.form", compact("districts"));
    }

    public function index() {
        return view("index.index.index");
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
            if ($client->price) {
                $back["status"] = true;
                $back["id"] = $client->id;
            } else {
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
                    $url .= "&city=" . urlencode("南京");
                    $url .= "&district=" . urlencode($input["district"]);
                    $url .= "&size=" . $input["house_area"];
                    $url .= "&address=" . urlencode($input["house_addr"]);
                    if ($input["house_number"]) {
                        $url .= "&buildingNumber=" . urlencode($input["house_number"]);
                    }
                    if ($input["floor"]) {
                        $url .= "&floor=" . $input["floor"];
                    }
                    if ($input["total_floor"]) {
                        $url .= "&maxFloor=" . $input["total_floor"];
                    }
                    $result = json_decode(file_get_contents($url), true);

                    if ($result["code"] == 200) {     // 请求成功
                        // 更新用户房屋数据
                        $update_data["price"] = $result["result"]["totalPrice"] / 10000;
                        Client::where("id", $res->id)->update($update_data);

                        $back["id"] = $res->id;
                        $back["status"] = true;
                    } else {
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
        Client::where("id", $client_id)->update(["loan_price" => $loan_price]);

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
        $record_data["price"] = $client->price . "万元";
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
