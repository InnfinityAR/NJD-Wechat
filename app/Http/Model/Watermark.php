<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Watermark extends Model
{
    protected $table = "watermark";           // 清除复数
    public $timestamps = False;         // 取消自动插入时间
    protected $guarded = [];            // 去除黑名单
}
