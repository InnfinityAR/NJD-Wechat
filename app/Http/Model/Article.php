<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";        // 清除复数
    public $timestamps = False;         // 取消自动插入时间
    protected $guarded = [];            // 去除黑名单
    
    // 获取上一篇文章
    public function getPrevArticle($id) {
        $now_id = $this->where("id", "<", $id)->max("id");
        if ($now_id) {
            return $this->find($now_id);
        } else {
            return false;
        }
    }
    
    // 获取下一篇文章
    public function getNextArticle($id) {
        $now_id = $this->where("id", ">", $id)->min("id");
        if ($now_id) {
            return $this->find($now_id);
        } else {
            return false;
        }
    }
}