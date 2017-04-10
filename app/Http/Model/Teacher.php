<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";        // 清除复数
    public $timestamps = False;         // 取消自动插入时间
    protected $guarded = [];            // 去除黑名单
}
?>