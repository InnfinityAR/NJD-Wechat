<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Contact;
use App\Http\Model\Nav;
use App\Http\Model\Article;
use App\Http\Model\Articlekeyword;
use Illuminate\Support\Facades\View;
use App\Http\Model\Area;

class ArticleController extends CommonController {

    public function __construct() {
        parent::__construct();

        // 猜你喜欢
        $top_pid = Nav::where("name", "最新动态")->pluck("id")->first();
        $like_nav_ids = Nav::where("top_pid", $top_pid)->pluck("id");
        $likes = Article::where("nav_id", $like_nav_ids)->orderBy("hits")->limit(5)->get();
        View::share("likes", $likes);
    }

    // 普通文章列表页
    public function index($category) {
        $p = request("p", $default = 1);
        $limit = 5;
        $skip = ($p - 1) * $limit;
        
        // 根据url获取nav_id
        $map["url"] = "article/" . $category;
        $this_nav = Nav::where($map)->first();
        $article_map["nav_id"] = $this_nav->id;
        $articles = Article::where($article_map)->orderBy("publish_time","desc")->skip($skip)->take($limit)->get();
        // 获取总页数
        $all_article_num = Article::where($article_map)->count();
        $all_pages = ceil($all_article_num / $limit);
        
        // TDK
        $title = $this_nav['name'];
        $desc = $this->web['desc'];
        $keywords = $this->web['keywords'];
        
        return view("mobile.article.index", compact("articles", "nav_id", "p", "all_pages", "category", "this_nav", "title", "desc", "keywords"));
    }

    // 搜索列表页
    public function search(Request $request) {
        $search = $request->get("search");

        if ($search) {  // 搜索列表页
            $p = request("p", $default = 1);
            $limit = 5;
            $skip = ($p - 1) * $limit;
            $articles = Article::where("title", "like", "%" . $search . "%")->orderBy("publish_time","desc")->skip($skip)->take($limit)->get();
            
            // 计算总页数
            $all_article_num = Article::where("title", "like", "%" . $search . "%")->count();
            $all_pages = ceil($all_article_num / $limit);
            
            // 关键词存储和更新
            if(Articlekeyword::where("name", $search)->first()){    // 搜索关键词已存在,搜索次数加一
                Articlekeyword::where("name", $search)->increment("search_num");
            }else{  // 搜索关键词不存在,新增
                $data["name"] = $search;
                $data["search_num"] = 1;
                $data["is_show"] = 0;
                $data["ctime"] = time();
                Articlekeyword::create($data);
            }
            
            // TDK
            $title = $search;
            $desc = $this->web['desc'];
            $keywords = $this->web['keywords'];

            return view("mobile.article.search_list", compact("search", "articles", "p", "all_pages", "title", "desc", "keywords"));
        } else {    // 搜索页
            // 最新标签
            $new_tip_map["is_show"] = 1;
            $new_tips = Articlekeyword::where($new_tip_map)->orderBy("ctime", "desc")->limit(8)->get();

            // 热门标签
            $hot_tip_map["is_show"] = 1;
            $hot_tips = Articlekeyword::where($hot_tip_map)->orderBy("search_num", "desc")->limit(8)->get();

            // TDK
            $title = "文章搜索页";
            $desc = $this->web['desc'];
            $keywords = $this->web['keywords'];
            
            return view("mobile.article.search", compact("hot_tips", "new_tips", "title", "desc", "keywords"));
        }
    }

    // 文章详情页
    public function detail($id) {
        $article = Article::find($id);
        if (!$article) {    // 文章不存在
            return redirect("error")->with("msg", "您访问的资源不存在");
        }

        // 浏览次数加一
        Article::where("id", $id)->increment("hits");

        // 相关推荐(随机获取)
        $recommend_articles = Article::orderByRaw('RAND()')->limit(5)->get();
        
        // TDK
        $title = $article['title'];
        $desc = $article['description'];
        $keywords = $article['keywords'];

        return view("mobile.article.detail", compact("article", "recommend_articles", "title", "desc", "keywords"));
    }

    // 网站介绍文章页面
    public function introduce($nav_id) {
        // 根据导航栏id获取其下文章
        $introduce_map["nav_id"] = $nav_id;

        $introduce = Article::where($introduce_map)->first();
        if ($introduce) {
            // 获取同级分类
            $nav = Nav::find($nav_id);
            if ($nav->level == 3) {   // 最低一级导航,直接获取同级分类
                $pid = $nav->pid;
                $navs = Nav::where("pid", $pid)->get();
            } else if ($nav->level == 2) {       // 中间一级导航,排除有子菜单的导航
                $pid = $nav->pid;
                $navs = Nav::where("pid", $pid)->get();
                unset($nav);

                foreach ($navs as $key => $nav) {
                    if (hasChildNav($nav['id'])) {
                        unset($navs[$key]);
                    }
                }
            }
        } else {
            return redirect("error")->with("msg", "未找到该资源");
        }
        $this_nav = Nav::where("id", $nav_id)->first();

        // TDK
        $title = $introduce['title'];
        $desc = $introduce['description'];
        $keywords = $introduce['keywords'];

        return view("mobile.article.introduce", compact("introduce", "navs", "this_nav", "title", "desc", "keywords"));
    }

}
