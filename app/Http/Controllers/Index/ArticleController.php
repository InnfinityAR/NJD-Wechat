<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Contact;
use App\Http\Model\Nav;
use App\Http\Model\Article;
use App\Http\Model\Articlekeyword;
use Illuminate\Support\Facades\View;
use App\Http\Model\Area;

class ArticleController extends CommonController
{
    public function __construct() {
        parent::__construct();
        // 热门标签
        $hot_tip_map["is_show"] = 1;
        $hot_tips = Articlekeyword::where($hot_tip_map)->orderBy("search_num", "desc")->limit(8)->get();
        
        // 网站联系信息
        $contact_map["is_show"] = 1;
        $contacts = Contact::where($contact_map)->orderBy("sort", "asc")->get();
        
        // 右边导航栏
        $top_nav_map["name"] = "最新动态";
        $this->top_nav_id = Nav::where($top_nav_map)->pluck("id")->first();
        $right_navs = getMenuTree(Nav::where("is_show", 1)->get()->toArray(), $this->top_nav_id);
        $right_navs[] = Nav::find($this->top_nav_id)->toArray();
        if ($right_navs) {
            $right_navs = list_to_tree($right_navs);
        }
        View::share("hot_tips", $hot_tips);
        View::share("contacts", $contacts);
        View::share("right_navs", $right_navs);
    }
    
    // 普通文章列表页
    public function index($category) {
        // 根据路由查找nav_id
        $map["url"] = "article/".$category;
        $nav = Nav::where($map)->first();
        
        $article_map["nav_id"] = $nav['id'];
        $articles = Article::where($article_map)->orderBy("publish_time", "desc")->paginate(10);
        $articles->appends(['nav_id'=>$nav['id']])->render();
        
        // TDK
        $title = $nav['name'];
        $desc = $this->web['desc'];
        $keywords = $this->web['keywords'];
        
        return view("index.article.index", compact("articles", "nav", "title", "desc", "keywords"));
    }
    
    // 搜索列表页
    public function search(Request $request) {
        $search = request("search");
        
        $articles = Article::where(function($query)use($search){
            if($search){
                $query->where("title", "like", "%".$search."%")->orWhere("abstract", "like", "%".$search."%");
            }
        })->orderBy("publish_time", "desc")->paginate(10);
        // 搜索关键词高亮
        foreach($articles as $key=>$article){
            $article['title'] = str_replace($search, "<i class='serch_text'>".$search."</i>", $article['title']);
            $article['abstract'] = str_replace($search, "<i class='serch_text'>".$search."</i>", $article['abstract']);
            $articles[$key] = $article;
        }
        $articles->appends(['search' => $search])->render();
        
        // 关键词更新
        if(Articlekeyword::where("name", $search)->first()){    // 搜索关键字已存在,搜索次数加一
            Articlekeyword::where("name", $search)->increment("search_num");
        }else{  // 关键词不存在,新增
            $data["name"] = $search;
            $data["search_num"] = 1;
            $data["is_show"] = 0;
            $data["ctime"] = time();
            Articlekeyword::create($data);
        }
        
        // TDK
        $title = $search ? $search : "文章列表";
        $desc = $this->web['desc'];
        $keywords = $this->web['keywords'];
        
        return view("index.article.search", compact("articles", "search", "title", "desc", "keywords"));
    }
    
    // 文章详情页
    public function detail($id) {
        $article = Article::find($id);
        if(!$article){    // 文章不存在
            return redirect("error")->with("msg", "您访问的资源不存在");
        }
        
        // 浏览次数加一
        Article::where("id", $id)->increment("hits");
        
        // 上一篇和下一篇
        $prev_article = (new Article)->getPrevArticle($id);
        $next_article = (new Article)->getNextArticle($id);
        
        //猜你喜欢,随机抽选五条
        $num = Article::where("nav_id", $article["nav_id"])->where("id", "!=", $article["id"])->count();
        if ($num > 5) {
            $num = 5;
        }
        if ($num) {
            $likes = Article::where("nav_id", $article["nav_id"])->where("id", "!=", $article["id"])->get()->random($num);
        } else {
            $likes = null;
        }
        
        // 省
        $province_map["pid"] = 1;
        $provinces = Area::where($province_map)->get();
        
        // 获取相关分类
        $top_pid = getTopNavId($article["nav_id"]);
        $middle_map["pid"] = $top_pid;
        $middle_map["level"] = 2;
        $middle_navs = Nav::where($middle_map)->get();
        
        // TDK
        $title = $article['title'];
        $desc = $article['description'];
        $keywords = $article['keywords'];
        
        return view("index.article.detail", compact("article", "prev_article", "next_article", "likes", "provinces", "middle_navs", "title", "desc", "keywords"));
    }
    
    // 网站介绍文章页面
    public function introduce($nav_id) {
        // 根据导航栏id获取其下文章
        $introduce_map["nav_id"] = $nav_id;
        
        $introduce = Article::where($introduce_map)->first();
        if(!$introduce){
            if(hasChildNav($nav_id)){       // 获取该分类下的第一个子分类对应的文章
                $first_child_id = Nav::where("pid", $nav_id)->pluck("id")->first();
                $introduce = Article::where("nav_id", $first_child_id)->first();
            }else{
                return redirect("error")->with("msg", "未找到该资源");
            }
        }
        
        // 右边导航栏
        $this->top_nav_id = getTopNavId($nav_id);
        $right_navs = getMenuTree(Nav::where("is_show", 1)->get()->toArray(), $this->top_nav_id);
        $right_navs[] = Nav::find($this->top_nav_id)->toArray();
        if ($right_navs) {
            $right_navs = list_to_tree($right_navs);
        }
        
        $this_nav = Nav::where("id", $nav_id)->first();
        
        // TDK
        $title = $introduce['title'];
        $desc = $introduce['description'];
        $keywords = $introduce['keywords'];
        
        return view("index.article.introduce", compact("crumbs", "introduce", "hot_tips", "contacts", "right_navs", "this_nav", "title", "desc", "keywords"));
    }
}
