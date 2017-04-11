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
            $code = rand(1000, 9999);
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
        if (Code::where($map)->first()) {
            $back["status"] = 1;
        }else{
            $back["status"] = 0;
            $back["msg"] = "验证码错误";
        }
        return $back;
    }
    
}
