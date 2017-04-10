<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Article;
use App\Http\Controllers\Admin\ReplaceController;
use Intervention\Image\ImageManager;
use App\Http\Model\Watermark;

/**
 * 内容处理控制器;
 *
 * @author MehrLicht
 */
class WatermarkController extends FormController {

    public $config;

    public function __construct($config = array()) {
        parent::__construct();
        $this->config = $config;
    }

    public function modify(Request $request) {
        if ($request->isMethod("put")) {
            $input = $request->except("_token", "_method");
            $old_img_url = Watermark::first(["img_url"])->toArray();

            $res = Watermark::where("id", 1)->update($input);

            if ($res !== false) {
                // 删除原图片
                if (($old_img_url['img_url'] != $input["img_url"]) && ($old_img_url['img_url'] != null)) {
                    unlink("." . $old_img_url);
                }
                $back["status"] = true;
                $back["msg"] = "数据保存成功";
            } else {
                $back["status"] = false;
                $back["msg"] = "数据保存失败";
            }
            return $back;
        } else {
            $field = Watermark::first();
            return view("admin.watermark.watermark", compact("field"));
        }
    }

    /*
      |--------------------------------------------------------------------------
      | Article
      |--------------------------------------------------------------------------
     */

    /**
     * 处理水印
     * @param int $water_type 水印类型 0不需要水印 1图片水印 2文字水印
     * @param type $path  需要处理的原文件的路径
     * return $newpath 加完水印的图片路径
     */
    public function watermark($water_type = 0, $path) {
        //先判断当前列是否需要开启水印

        switch ($water_type) {
            case '0':
                //不处理水印,直接返回;
                $newpath = $path;
                break;

            case '1':
                // 图片水印
                $newpath = $this->imgMark($path);
                break;

            case '2':
                // 文字水印
                $newpath = $this->textMark($path);
                break;
        }
        return substr($newpath, 1);
    }

    /**
     * 图片水印处理
     * @param type $config
     * @param string $path
     * @return newpath
     */
    public function imgMark($path) {
        $water = new ImageManager();
        //准备水印位置
        switch ($this->config['water_pos']) {
            //顶部居左
            case '1':
                $a = 'top-left';
                $b = 5;
                $c = 5;
                break;
            //顶部居中
            case '2':
                $a = 'top-center';
                $b = 0;
                $c = 5;
                break;
            //顶部居右
            case '3':
                $a = 'top-right';
                $b = 5;
                $c = 5;
                break;
            //左部居左
            case '4':
                $a = 'center-left';
                $b = 5;
                $c = 0;
                break;
            //左部居中
            case '5':
                $a = 'center-center';
                $b = 0;
                $c = 0;
                break;
            //左部居右
            case '6':
                $a = 'center-right';
                $b = 5;
                $c = 0;
                break;
            //下部居左
            case '7':
                $a = 'bottom-left';
                $b = 5;
                $c = 5;
                break;
            //下部居中
            case '8':
                $a = 'bottom-center';
                $b = 0;
                $c = 5;
                break;
            //下部居右
            case '9':
                $a = 'bottom-right';
                $b = 5;
                $c = 5;
                break;
        }
        //准备新文件地址
        $newpath = './public/uploads/article/' . config("api.site_uniqid") . '/';
        if (!is_dir($newpath)) {
            mkdir($newpath, 0777, true);
        }
        $imgpath = $newpath . md5(date('YmdHis') . mt_rand(10000, 99999)) . '.jpg';
        if (strpos($path, ".") === 0) {
            $oldpath = $path;
        } else {
            $oldpath = '.' . $path;
        }


        if (strpos($this->config['img_url'], ".") === 0) {
            $markimg = $this->config['img_url'];
        } else {
            $markimg = "." . $this->config['img_url'];
        }

        //处理图片
        $water->make($oldpath)
                ->insert($markimg, $a, $b, $c)
                ->save($imgpath);
        return $imgpath;
    }

    /**
     * 文字水印处理
     * @param type $config
     * @param type $path
     * @return newpath
     */
    public function textMark($path) {
        $water = new ImageManager();
        $oldpath = '.' . $path;
        $water = $water->make($oldpath);
        $width = $water->width();
        $height = $water->height();

        switch ($this->config["water_pos"]) {
            //顶左
            case '1':
                $x = 5;
                $y = 5;
                $a = 'left';
                $v = 'top';
                break;
            //顶中
            case '2':
                $x = $width * 0.5;
                $y = 5;
                $a = 'center';
                $v = 'top';
                break;
            //顶右
            case '3':
                $x = $width - 5;
                $y = 5;
                $a = 'right';
                $v = 'top';
                break;
            //中左
            case '4':
                $x = 5;
                $y = $height * 0.5;
                $a = 'left';
                $v = 'center';
                break;
            //中中
            case '5':
                $x = $width * 0.5;
                $y = $height * 0.5;
                $a = 'center';
                $v = 'center';
                break;
            //中右
            case '6':
                $x = $width - 5;
                $y = $height * 0.5;
                $a = 'right';
                $v = 'center';
                break;
            //底左
            case '7':
                $x = 5;
                $y = $height - 5;
                $a = 'left';
                $v = 'bottoom';
                break;
            //底中
            case '8':
                $x = $width * 0.5;
                $y = $height - 5;
                $a = 'center';
                $v = 'bottom';
                break;
            //底右
            case '9':
                $x = $width - 5;
                $y = $height - 5;
                $a = 'right';
                $v = 'bottom';
                break;
        }



        //图宽-10;图高-10;
        $water->text($this->config["text_content"], $x, $y, function($font)use($a,$v) {
            $font->file('./public/font/simsun.ttc');
            $font->size($this->config["text_size"]);        // 文字大小
            $font->color($this->config["text_color"]);      // 文字颜色
            // 固定位置
            $font->align($a);           
            $font->valign($v);
        });
        //准备新文件地址
        $newpath = './public/uploads/article/' . config("api.site_uniqid") . '/';
        if (!is_dir($newpath)) {
            mkdir($newpath, 0777, true);
        }
        $imgpath = $newpath . md5(date('YmdHis') . mt_rand(10000, 99999)) . '.jpg';
        $water->save($imgpath);

        return $imgpath;
    }

    
}
