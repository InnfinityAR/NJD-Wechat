<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Model\Code;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // 发送手机验证码
    public function sendCode(Request $request) {
        $mobile = $request->input("tel");
        if ($mobile) {
            $code = rand(100000, 999999);
            $res = sendTemplateSMS($mobile, array($code, '5'), "1");
            if(!$res){
                $back['status'] = 0;
                $back['msg'] = "短信发送失败";
            }else{
                // 存入数据库
                $code_data['tel'] = $mobile;
                $code_data['code'] = $code;
                $code_data['create_time'] = time();
                Code::create($code_data);
                
                // 删除一天前的记录
                $yesterday = strtotime(date('Y-m-d',strtotime('-1 day')));
                Code::where("create_time", "<=", $yesterday)->delete();
                
                $back["status"] = 1;
                $back["msg"] = "短信发送成功";
            }
            
            return $back;
        }
        return false;
    }

    // 检查手机验证码是否正确
    public function checkCode(Request $request) {
        $map["code"] = $request->input("code");
        $map["tel"] = $request->input("tel");
        $code = Code::where($map)->orderBy("id","desc")->first();
        if(!$code){
            $back["status"] = 0;
            $back["msg"] = "验证码错误";
        }elseif ($code->create_time+180< time()) {       // 3分钟内有效
            $back["status"] = 0;
            $back["msg"] = "验证码已过期";
        }else{
            $back["status"] = 1;
        }
        return $back;
    }
    
    // 限定次数
    public function checkCodeTimes(Request $request) {
        $tel = $request->get("tel");
        // 获取当天已发送数量
        $today = strtotime(date('Y-m-d'));
        $tomorrow = strtotime(date('Y-m-d',strtotime('+1 day')));
        $times = Code::where("tel", $tel)->whereBetween("create_time",[$today, $tomorrow])->count();
        
        if($times>=3){
            $back["status"] = false;
            $back["msg"] = "已超过今日查询上限";
        }else{
            $back["status"] = true;
        }
        return $back;
    }
    
}
