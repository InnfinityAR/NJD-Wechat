<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Introduce;

class Nav extends Model {

    protected $table = "nav";           // 清除复数
    public $timestamps = False;         // 取消自动插入时间
    protected $guarded = [];            // 去除黑名单

    // 判断该导航下是否存在网站介绍,存在返回介绍id
    public function hasIntroduce() {
        $map["nav_id"] = $this->id;
        $introduce = Introduce::where($map)->first();

        if ($introduce) {
            return $introduce->id;
        } else {
            return false;
        }
    }
    
    

}
