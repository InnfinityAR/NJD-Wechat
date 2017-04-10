<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/* * 公共路由* */
Route::any("upload", "Controller@upload");                                       // 原图上传
Route::any("sendCode", "Controller@sendCode");                                   // 发送验证码
Route::any("checkCode", "Controller@checkCode");                                 // 检验验证码
Route::any(".env", function(){                                                    // 禁止访问.env
    return view("index.error.404");
});
/* * 公共路由* */


/* * 后台路由* */
Route::get(config('app.admin_prefix') . "/login", "Admin\LoginController@index");                                        // 后台登录
Route::any(config('app.admin_prefix') . "/captcha/{random?}", "Admin\LoginController@captcha");                                    // 后台验证码
Route::post(config('app.admin_prefix') . "/login", "Admin\LoginController@login")->middleware("AdminMenu");              // 后台登录处理
Route::match(["get", "post"], config('app.admin_prefix') . "/changePwd", "Admin\UserController@changePwd");             // 修改密码  
Route::get(config('app.admin_prefix') . "/logout", "Admin\LoginController@logout");                                      // 后台登出

Route::group(["namespace" => "Admin", "prefix" => config("app.admin_prefix"), "middleware" => ["AdminLogin", "AdminAuth"]], function() {
    Route::get("/", "IndexController@index");                                                                   // 后台首页
    Route::match(["get", "put", "post"], "web", "WebController@modify");                                          // 网站信息修改
    Route::match(["get", "post"], "backmenu/insert", "BackmenuController@insert");
    Route::resource("backmenu", "BackmenuController");                                                          // 后台菜单管理
    Route::get("backmenu/level/{level?}", "BackmenuController@index")->where("level", "[0-9]+");                 // 菜单管理列表
    Route::resource("nav", "NavController");                                                                    // 前台导航管理
    Route::get("nav/level/{level?}", "NavController@index")->where("level", "[0-9]+");                          // 前台导航列表
    Route::resource("banner", "BannerController");                                                              // 轮播图管理
    Route::resource("user", "UserController");                                                                  // 后台账户管理
    Route::get("user/active/{id}", "UserController@active")->where("id", "[0-9]+");                              // 更改账户状态
    Route::match(['get', 'post'], "user/changePwd", "UserController@changepwd");                                 // 修改账号密码
    Route::resource("role", "RoleController");                                                                  // 角色管理
    Route::resource("node", "NodeController");                                                                  // 权限管理
    Route::resource("article", "ArticleController");                                                            // 文章管理
    Route::resource("articlecategory", "ArticleCategoryController");                                             // 文章分类
    Route::resource("contact", "ContactController");                                                            // 网站联系方式
    Route::any("watermark", "WatermarkController@modify");                                                      // 水印管理
    Route::resource("teacher", "TeacherController");                                                            // 教师管理
    Route::resource("articlekeyword", "ArticleKeywordController");                                              // 文章关键词
    Route::resource("introduce", "IntroduceController");                                                        // 网站介绍信息管理
    Route::resource("cooperation", "CooperationController");                                                    // 合作伙伴
});
/* * 后台路由* */

/* * 手机路由* */
Route::group(["namespace" => "Mobile", "domain" => config("app.mobile_url"), "middleware" => ["DeviceJudge"]], function(){
    Route::get("/", "IndexController@index");                                                   // 首页
    Route::get("search", "ArticleController@search");                                           // 搜索
    Route::get("map", "IndexController@map");                                                   // 网站地图
    Route::get("link", "IndexController@link");                                                 // 友情链接
    Route::get("introduce/{nav_id}", "ArticleController@introduce")->where("nav_id","[0-9]+");   // 介绍页
    Route::get("article/{id}", "ArticleController@detail")->name("articleDetail")->where("id", "[0-9]+");          // 文章详情页
    Route::get("article/{category}", "ArticleController@index");                            // 文章分类列表
    Route::post("saveUser", "IndexController@saveUser");                                    // 保存用户信息
});
/* * 手机路由* */

/* * 前台路由* */
Route::group(["namespace" => "Index", "middleware" => ["DeviceJudge"]], function() {
    Route::get("/", "IndexController@index")->name("/");                            // 首页
    Route::get("introduce/{nav_id}", "ArticleController@introduce")->name("introduce");     // 网站介绍页
    Route::get("map", "IndexController@map")->name("map");                                  // 网站地图
    Route::get("link", "IndexController@link")->name("link");                               // 友情链接
    Route::get("article/{id}", "ArticleController@detail")->name("articleDetail")->where("id", "[0-9]+");          // 文章详情页
    Route::get("article/{category}", "ArticleController@index");                            // 文章分类列表
    Route::get("article", "ArticleController@search")->name("article");                      // 文章搜索列表
    Route::post("saveUser", "IndexController@saveUser");                                    // 保存用户信息
    Route::get("getCity", "CommonController@getCity");                                      // 动态获取城市
    Route::get("error", function() {                                                         // 错误页面
        return view("index.error.404");
    });
});

/* * 前台路由* */


/* * 接口路由* */
Route::group(["namespace" => "Api", 'prefix' => 'api/web', "middleware" => ['ActiveToken']], function() {
    Route::match(['get', 'post'], 'getConfig', "WebApiController@getConfig");                        // 获取网站配置
    Route::match(['get', 'post'], 'setConfig', "WebApiController@setConfig");                        // 设置网站配置
    Route::match(['get', 'post'], 'getCategory', "WebApiController@getCategory");                        // 设置网站配置
    Route::match(['get', 'post'], 'addArticle', "WebApiController@addArticle");                      // 增加文章
    Route::match(['get', 'post'], 'updateUser', "WebApiController@updateUser");                      // 增加文章
});
/**接口路由**/