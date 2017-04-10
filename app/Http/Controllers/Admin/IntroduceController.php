<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Introduce;
use App\Http\Model\Nav;

class IntroduceController extends FormController {

    public function create() {
        // 获取文章分类
        $navs = Nav::all();
        return view("admin.introduce.add", compact("navs"));
    }

    public function edit($id) {
        // 获取文章分类
        $navs = Nav::all();
        $field = Introduce::where("id", $id)->first();
        return view("admin.introduce.edit", compact("field", "navs"));
    }
}
