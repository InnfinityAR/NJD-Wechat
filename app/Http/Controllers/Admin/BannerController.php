<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Banner;
use App\Http\Model\Nav;

class BannerController extends FormController {

    public function create() {
        // 获取导航信息
        $map["pid"] = 0;
        $navs = Nav::where($map)->get();
        return view("admin.banner.add", compact("navs"));
    }
    
    public function edit($id) {
        // 获取导航信息
        $map["pid"] = 0;
        $navs = Nav::where($map)->get();
        
        $field = Banner::find($id);
        
        return view("admin.banner.edit", compact("navs", "field"));
    }
    
    public function destroy($id) {
        $model = new $this->model;

        $ids = explode(",", $id);

        // 删除图片
        if (count($ids) > 1) {
            $img_urls = $model->whereIn("id", $ids)->pluck("img_url")->toArray();
        } else {
            $img_urls = $model->where("id", $ids)->pluck("img_url")->toArray();
        }

        foreach ($img_urls as $img_url) {
            $res = unlink("." . $img_url);

            if (!$res) {
                continue;
            }
        }

        $re = $model::whereIn('id', $ids)->delete();

        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '删除成功！',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}
