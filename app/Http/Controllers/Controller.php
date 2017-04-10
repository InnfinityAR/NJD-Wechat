<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
     //图片上传
    public function upload() {
        $file = Input::file('Filedata');
        $url = Input::get("file_path");
        $url = $url ? $url : "";
        if ($file->isValid()) {
            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis') . mt_rand(10000, 99999) . '.' . $entension;
            $path = $file->move(base_path() . '/public/uploads/' . $url, $newName);
            $filepath = '/public/uploads/' . $url . "/" . $newName;
            return $filepath;
        }
    }
    
    // 发送手机验证码
    public function sendCode(Request $request) {
        $mobile = $request->input("tel");
        if ($mobile) {
            $code = rand(1000, 9999);
            session(['mobileCode' => md5($code) . time()]);
            sendTemplateSMS($mobile, array($code, '5'), "1");
            $back["status"] = 1;
            $back["msg"] = "短信发送成功";
            return $back;
        }
        return false;
    }

    // 检查手机验证码是否正确
    public function checkCode(Request $request) {
        $code = $request->input("code");
        $mobileCode = session('mobileCode');
        $temp = md5($code);
        if ((substr($mobileCode, 32) > time() - 900) && $temp == (substr($mobileCode, 0, 32))) {
            $back["status"] = 1;
            $back["msg"] = "操作成功";
            return $back;
        }
        $back["status"] = 0;
        $back["msg"] = "操作失败";
        return $back;
    }
    
}
