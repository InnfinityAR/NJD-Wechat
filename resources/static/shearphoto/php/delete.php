<?php
/*删除图片*/
header('Content-type:text/html;charset=utf-8');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

/*获取图片路径并删除*/
$imgPath=$_POST['url'];
echo('{"success":"'  .unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR.$imgPath). '"}');
?>