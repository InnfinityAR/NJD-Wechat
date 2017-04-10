<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Backmenu;
use Illuminate\Support\Facades\DB;

class User extends Model {

    protected $table = "user";           // 清除复数
    public $timestamps = False;         // 取消自动插入时间
    protected $guarded = [];            // 去除黑名单

    // 判断用户是否有权限进行某项操作

    public static function hasAction($uri, $user_id) {
        $backmenu_id = Backmenu::where("route", $uri)->pluck("id")->first();
        if ($backmenu_id) {
            $node_ids = array_unique(DB::table("node_backmenu")->where("backmenu_id", $backmenu_id)->pluck("node_id")->toArray());
            if ($node_ids) {
                $role_ids = array_unique(DB::table("role_node")->whereIn("node_id", $node_ids)->pluck("role_id")->toArray());
                if ($role_ids) {
                    $res = DB::table("role_user")->where("user_id", $user_id)->whereIn("role_id", $role_ids)->first();
                    if ($res) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
