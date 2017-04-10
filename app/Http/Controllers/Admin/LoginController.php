<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Support\Facades\View;

require_once 'resources/org/code/Code.class.php';

class LoginController extends Controller
{
    
    
    public function index() {
        
        return view("admin.login.login");
        
    }
    
    public function login(Request $request) {
        
        if ($input = $request->except("_token")) {
            $code = new \Code();
            // 判断验证码是否正确
            if(strtolower($input['code'])!= strtolower($code->get())){
                $back["status"] = 0;
                $back["msg"] = "验证码错误";
                return $back;
            }
            
            $user = User::where("name", $input["name"])->first();
            
            // 验证用户名或密码
            if (!$user || $user->password != md5($input["password"])) {
                $back["status"] = 0;
                $back["msg"] = "用户名或密码错误";
            // 验证账号是否冻结
            } elseif ($user["is_active"] == 0) {
                $back["status"] = 0;
                $back["msg"] = "该账号已被冻结，请联系网站管理员";
                
            } else {
                $back["status"] = 1;
                
                // 存储用户信息
                session(["user" => $user]);
                User::where("id", $user->id)->update(["last_login" => time()]);
                User::where("id", $user->id)->increment("logins");
            }
            return $back;
        }
    }

    // 退出登录
    public function logout() {
        session()->forget("user");
        return redirect("/".config("app.admin_prefix")."/login");
    }
    
    public function captcha($random = "") {
        ob_clean();
        $code = new \Code();
        $code->make();
    }
}
