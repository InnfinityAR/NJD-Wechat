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
Route::any(".env", function() {                                                    // 禁止访问.env
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
    Route::match(["get", "post"], "backmenu/insert", "BackmenuController@insert");
    Route::resource("backmenu", "BackmenuController");                                                          // 后台菜单管理
    Route::get("backmenu/level/{level?}", "BackmenuController@index")->where("level", "[0-9]+");                 // 菜单管理列表
    Route::resource("user", "UserController");                                                                  // 后台账户管理
    Route::get("user/active/{id}", "UserController@active")->where("id", "[0-9]+");                              // 更改账户状态
    Route::match(['get', 'post'], "user/changePwd", "UserController@changepwd");                                 // 修改账号密码
    Route::resource("role", "RoleController");                                                                  // 角色管理
    Route::resource("node", "NodeController");                                                                  // 权限管理
    Route::get("client/status/{id}", "ClientController@index");                                                 // 客户列表
    Route::get("client/{id}/changeStatus/{status}", "ClientController@changeStatus")->where("id","[0-9]+");// 更改客户状态
    Route::post("client/remark", "ClientController@remark");                                                    // 添加备注
    Route::post("client/assign", "ClientController@assign");                                                    // 分配客户
    Route::resource("client", "ClientController");                                                              // 客户管理
    Route::resource("residentialarea", "ResidentialareaController");                                            // 小区管理
    Route::resource("district", "DistrictController");                                                          // 南京区域管理
    
});
/* * 后台路由* */

/* * 前台路由* */
Route::group(["namespace"=>"Index"], function() {
    Route::get("/", "IndexController@index");
    Route::post("/storeClientInfo", "IndexController@storeClientInfo");                                     // 保存用户信息
    Route::get("assignClient", "IndexController@assignClient");                                             // 自动分配客户
    Route::get("getAddr", "IndexController@getAddr");                                                       // 动态获取地址
});
