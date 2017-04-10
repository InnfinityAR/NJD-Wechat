<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Model\Web;
use App\Http\Model\Nav;
use App\Http\Model\Article;
use App\Http\Model\User;

class WebApiController extends Controller {
    
    // 获取网站配置信息
    public function getConfig(Request $request) {

        $version = $request->get("version");
        
        switch ($version) {
            case 1:
                $web = Web::first();
                $data = array();
                // 网站名称
                $arr['key'] = "name";
                $arr['value'] = $web["name"];
                $arr['desc'] = "网站名称";
                $arr['type'] = "input";
                $data[] = $arr;
                unset($arr);

                // 网站英文名称
                $arr['key'] = "name_en";
                $arr['value'] = $web["name_en"];
                $arr['desc'] = "网站英文名称";
                $arr['type'] = "input";
                $data[] = $arr;
                unset($arr);

                // 客服qq
                $arr['key'] = "qq";
                $arr['value'] = $web["qq"];
                $arr['desc'] = "客服qq";
                $arr['type'] = "input";
                $data[] = $arr;
                unset($arr);

                // 网站热线
                $arr['key'] = "tel";
                $arr['value'] = $web["tel"];
                $arr['desc'] = "网站热线";
                $arr['type'] = "input";
                $data[] = $arr;
                unset($arr);

                if ($data) {
                    $return["status"] = true;
                    $return["info"] = $data;
                } else {
                    $return["status"] = false;
                    $return["info"] = "未获取到该网站配置";
                }

                break;

            default:
                $return['status'] = false;
                $return['info'] = "未知版本";
                break;
        }

        return $return;
    }

    // 设置网站配置
    public function setConfig(Request $request) {
        $version = $request->get("version");
        switch ($version) {
            case 1:
                $data = $request->get("input");
                if ($data) {
                    $res = Web::where("id", 1)->update($data);

                    if ($res !== false) {
                        $return["status"] = true;
                        $return["info"] = "数据更新成功";
                    } else {
                        $return["status"] = false;
                        $return["info"] = "数据更新失败";
                    }
                } else {
                    $return["status"] = false;
                    $return["info"] = "未获取到提交的表单信息";
                }

                break;

            default:
                $return['status'] = false;
                $return['info'] = "未知版本";
                break;
        }

        return $return;
    }

    // 获取文章分类
    public function getCategory(Request $request) {
        $version = $request->get("version");
        switch ($version) {
            case 1:
                $data = Nav::all(["id", "name"]);
                if ($data) {
                    $return["status"] = true;
                    $return["info"] = $data;
                } else {
                    $return["status"] = false;
                    $return["info"] = "未获取到文章分类";
                }

                break;

            default:
                $return['status'] = false;
                $return['info'] = "未知版本";
                break;
        }

        return $return;
    }

    // 接受文章
    public function addArticle(Request $request) {
        $version = $request->get("version");
        switch ($version) {
            case 1:
                // 存入数据库
                $data = $request->get("input");

                if ($data) {
                    // 原图
                    if(isset($data['picture'])){
                        downloadImage($data['picture'], dirname($data['picture']));
                    
                    }
                    // 缩略图
                    if(isset($data['thumbnail'])){
                        downloadImage($data['thumbnail'], dirname($data['thumbnail']));
                    }
                    
                    
                    // 匹配图片
                    $content = $data['content'];
                    $img_pattern = "/src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"]/i";
                    preg_match_all($img_pattern, $content, $img_urls);

                    // 遍历下载图片
                    if ($img_urls) {

                        foreach ($img_urls[1] as $img_url) {
                            // 保存图片目录
                            $dir_name = dirname($img_url);
                            // 拼接图片地址
                            $img_url = config("api.web_url") . $img_url;
                            // 下载图片到本地
                            $img = downloadImage($img_url, $dir_name);
                            if (!$img) {      // 保存失败
                                $return["status"] = false;
                                $return["info"] = "图片保存到本地失败";
                                return $return;
                            }
                        }
                    }
                    
                    // 图片保存成功,插入数据
                    $res = Article::create($data);
                    
                    if($res){       // 数据插入成功
                        $return["status"] = true;
                        $return["info"] = array("url" => $res->id);
                    }else{
                        $return["status"] = false;
                        $return["info"] = "文章录入失败";
                    }
                    
                } else {
                    $return["status"] = false;
                    $return["info"] = "未获取到文章信息";
                }
                
                break;

            default :
                $return['status'] = false;
                $return['info'] = "未知版本";
                break;
        }
        return $return;
    }
    
    // 向第三方传送发布的文章记录
    public function record($articleObj) {
        $url = config("api.web_url")."api/web/record";
        $postFields["version"] = 1;
        // 获取token
        $postFields["token"] = getApiToken();
        $postFields["site_uniqid"] = config("api.site_uniqid");
        
        // 组装文章信息
        $postFields["title"] = $articleObj->title;
        $postFields["url"] = $articleObj->id;
        $postFields["openid"] = $articleObj->openid;
        $postFields["cate_id"] = $articleObj->nav_id;
        $postFields["cate_name"] = getField($articleObj->nav_id, "nav");
        $result = curl_post($url, $postFields);
        
        return $result;
    }

    // 向第三方站点同步用户信息
    public function syncUser($userObj) {
        $url = config("api.web_url")."api/web/syncUser";
        $postFields["version"] = 1;
        // 组装用户信息
        $postFields["name"] = $userObj->name;
        $postFields["password"] = $userObj->password;
        if($userObj->openid){
            $postFields["openid"] = $userObj->openid;
        }
        // 获取token
        $postFields["token"] = getApiToken();
        $postFields["site_uniqid"] = config("api.site_uniqid");
        

        $result = curl_post($url, $postFields);
        
        return $result;
    }
    
    // 第三方向本地更新
    public function updateUser(Request $request) {
        $version = $request->get("version");
        
        switch ($version) {
            case 0: 
                $return["info"] = $request->get("input");
                break;
            
            case 1:
                $data = $request->get("input");
                $map["openid"] = $data["openid"];
                
                
                if(User::where($map)->first()){     // 更新数据
                    $res = User::where($map)->update($data);
                }else{
                    $res = User::create($data);
                    // 给用户加上编辑角色
                    $add_data["user_id"] = $res->id;
                    $add_data["role_id"] = 1;
                    DB::table("role_user")->insert($add_data);
                }
                
                if($res){
                    $return["status"] = true;
                    $return["info"] = "数据操作成功";
                }else{
                    $return["status"] = false;
                    $return["info"] = "数据操作失败";
                }

                break;

            default:
                $return['status'] = false;
                $return['info'] = "未知版本";
                break;
        }
        return $return;
    }

}
