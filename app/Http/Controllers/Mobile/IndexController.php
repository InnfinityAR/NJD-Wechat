<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Contact;
use App\Http\Model\Teacher;
use App\Http\Model\Article;
use App\Http\Model\Nav;
use App\Http\Model\Articlekeyword;
use App\Http\Model\Cooperation;
use App\Http\Model\Consult;

class IndexController extends CommonController {

    public function index() {
        // 联系我们
        $contact_map["is_show"] = 1;
        $contacts = Contact::where($contact_map)->orderBy("sort", "asc")->get();

        // 教师
        $teacher_map["is_show"] = 1;
        $teachers = Teacher::where($teacher_map)->orderBy("sort", "asc")->get();
        
        // 教育体系
        $system_id = Nav::where("name", "教育体系")->pluck("id")->first();
        // 其下四个子导航
        $system_sub_map["top_pid"] = $system_id;
        $system_sub_map["level"] = 3;
        $system_sub_ids = Nav::where($system_sub_map)->limit(4)->pluck("id");
        // 对应文章
        $systems = Article::whereIn("nav_id", $system_sub_ids)->get();
        
        // 考试介绍
        $exam_id = Nav::where("name", "关于考试")->pluck("id")->first();
        // 其下三个子导航
        $exam_sub_map["top_pid"] = $exam_id;
        $exam_sub_map["level"] = 3;
        $exam_sub_ids = Nav::where($exam_sub_map)->limit(3)->pluck("id");
        // 对应文章
        $exams = Article::whereIn("nav_id", $exam_sub_ids)->get();
        
        // 教育资讯
        $education_id = Nav::where("name", "教育资讯")->pluck("id")->first();
        $educations = Article::where("nav_id", $education_id)->limit(5)->get();
        
        // 留学资讯
        $abord_id = Nav::where("name", "留学资讯")->pluck("id")->first();
        $abords = Article::where("nav_id", $abord_id)->limit(5)->get();
        
        // TDK
        $desc = $this->web['desc'];
        $keywords = $this->web['keywords'];
        
        return view("mobile.index.index", compact("contacts", "teachers", "systems", "exams", "educations", "abords", "desc", "keywords"));
    }

    // 网站地图
    public function map() {
        // 网站地图
        $top_nav_map["is_show"] = 1;
        $top_nav_map["pid"] = 0;
        $top_nav_map["position"] = 1;
        $top_navs = Nav::where($top_nav_map)->orderBy("sort", "asc")->get()->toArray();
        foreach ($top_navs as $key => $top_nav) {
            $sub_nav_map["top_pid"] = $top_nav["id"];
            $top_navs[$key]["sub_navs"] = Nav::where($sub_nav_map)->get();
        }
        
        // TDK
        $title = "网站地图";
        $desc = $this->web['desc'];
        $keywords = $this->web["keywords"];

        return view("mobile.index.map", compact("top_navs", "title", "desc", "keywords"));
    }

//    // 友情链接
//    public function link() {
//        // 合作伙伴
//        $cooperation_map["is_show"] = 1;
//        $cooperations = Cooperation::where($cooperation_map)->orderBy("sort", "asc")->get();
//        
//        // 热门标签
//        $hot_tip_map["is_show"] = 1;
//        $hot_tips = Articlekeyword::where($hot_tip_map)->orderBy("search_num", "desc")->limit(8)->get();
//
//        // 网站联系信息
//        $contact_map["is_show"] = 1;
//        $contacts = Contact::where($contact_map)->orderBy("sort", "asc")->get();
//
//        // 右边导航栏
//        $right_navs = getMenuTree(Nav::where("is_show", 1)->get()->toArray(), $this->top_nav_id);
//        $right_navs[] = Nav::find($this->top_nav_id)->toArray();
//        if ($right_navs) {
//            $right_navs = list_to_tree($right_navs);
//        }
//        
//        return view("index.index.link", compact("cooperations", "hot_tips", "contacts", "right_navs"));
//    }
    
    // 保存用户提交的表单信息
    public function saveUser(Request $request) {
        $input = $request->all();
        $res = Consult::create($input);
        
        if($res){
            // 向user_center传递用户信息
            $url = "http://user_center.app.hw2006.org/index.php/Home/User/record?access_token=".sha1("wemax001");
            $postFields["name"] = $input["name"];
            $postFields["domain"] = $_SERVER["HTTP_HOST"];
            $postFields["cellphone"] = $input["tel"];
            
            $result = curl_post($url, $postFields);
            $back["status"] = true;
            $back["msg"] = "信息保存成功";
            return $back;
        }else{
            $back["status"] = false;
            $back["msg"] = "信息保存失败";
            return $back;
        }
        
    }
}
