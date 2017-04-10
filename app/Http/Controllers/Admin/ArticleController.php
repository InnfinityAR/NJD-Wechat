<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;
use App\Http\Model\Nav;
use App\Http\Model\Watermark;
use App\Http\Controllers\Api\WebApiController;
use Illuminate\Support\Facades\DB;

class ArticleController extends FormController {

    public function create() {
        // 获取文章分类
        $navs = Nav::all();
        return view("admin.article.add", compact("navs"));
    }

    public function edit($id) {
        // 获取文章分类
        $navs = Nav::all();
        $field = Article::where("id", $id)->first();
        return view("admin.article.edit", compact("field", "navs"));
    }

    public function store(Request $request) {

        if ($input = $request->except("_token", "water_type")) {
            // 将获取到的时间或当期时间转化为时间戳
            $input["publish_time"] = strtotime($input["publish_time"]);
            $input["update_time"] = strtotime($input["update_time"]);
            
            $water_type = $request->get("water_type");      // 添加水印类型
            
            if ($water_type) {          // 添加水印
                // 图片加水印
                $config = Watermark::first();
                $watermark = new WatermarkController($config);
                // 原图
                if ($input["picture"]) {    
                    $input["picture"] = $watermark->watermark($water_type, $input["picture"]);
                }
                // 缩略图
                if ($input["thumbnail"]) {
                    $input["thumbnail"] = $watermark->watermark($water_type, $input["thumbnail"]);
                }
                // 内容中的图片
                $content = $input["content"];
                //img标签正则
                $pattern = '/src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"]/i';
                //匹配出所有图片加水印并替换回去
                preg_match_all($pattern, $content, $img_urls);
                if ($img_urls[1]) {
                    for ($i = 0; $i < count($img_urls['1']); $i++) {
                        $newpath = $watermark->watermark($water_type, $img_urls["1"][$i]);
                        $content = str_replace($img_urls["1"][$i], $newpath, $content);
                    }
                }
                $input['content'] = $content;
            }
            
            DB::beginTransaction();
            $user_id = session("user")->id;
            $input["openid"] = getField($user_id, "user", "openid");
            $res = Article::create($input);

            if ($res) {
                // 向第三方发送文章信息
                $webApi = new WebApiController();
                $result = $webApi->record($res);
                if($result["status"]){
                    $back["status"] = true;
                    $back["msg"] = "数据添加成功";
                }else{
                    DB::rollback();
                    $back["status"] = false;
                    $back["msg"] = "与第三方数据同步失败";
                }
                DB::commit();
                
            } else {
                $back["status"] = false;
                $back["msg"] = "数据添加失败";
            }

            return $back;
        }
    }

    public function update(Request $request, $id) {

        if ($input = $request->except("_token", "_method")) {

            // 将获取到的时间或当期时间转化为时间戳
            $input["publish_time"] = strtotime($input["publish_time"]);
            $input["update_time"] = strtotime($input["update_time"]);

            $res = Article::where("id", $id)->update($input);

            if ($res) {
                $back["status"] = true;
                $back["msg"] = "数据修改成功";
            } else {
                $back["status"] = false;
                $back["msg"] = "数据修改失败";
            }

            return $back;
        }
    }

    public function destroy($id) {
        $model = new $this->model;

        $ids = explode(",", $id);

        // 删除图片
        if (count($ids) > 1) {
            $img_urls = $model->whereIn("id", $ids)->select("picture", "thumbnail")->get()->toArray();
        } else {
            $img_urls = $model->where("id", $ids)->select("picture", "thumbnail")->get()->toArray();
        }

        if ($img_urls) {
            $res = true;
            foreach ($img_urls as $img_url) {
                if ($img_url['picture']) {
                    $res = unlink("." . $img_url['picture']);
                }
                if ($img_url['thumbnail']) {
                    $res = unlink("." . $img_url['thumbnail']);
                }
                if (!$res) {
                    continue;
                }
            }
        } else {
            $res = true;
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
