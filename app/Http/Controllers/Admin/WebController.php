<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Web;

class WebController extends FormController {

    public function modify(Request $request) {
        
        
        if ($input = $request->except("_token", "_method")) {
            $res = Web::where("id", 1)->update($input);
            if ($res !== false) {
                $back["status"] = 1;
                $back["msg"] = "数据修改成功";
            } else {
                $back["status"] = 0;
                $back["msg"] = "数据修改失败";
            }
            return $back;
        } else {
            $field = Web::find(1);
            return view("admin.web.edit", compact("field"));
        }
    }


}
