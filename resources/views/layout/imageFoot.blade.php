<script src="/resources/static/layui/layui.js" charset="utf-8"></script>
<script>
    var $,
            layer,
            defaultImg = "/resources/static/shearphoto/images/background.jpg", //默认背景图片
            deleteImgUrl = "/resources/static/shearphoto/php/delete.php", //删除图片
            uploadImgUrl = "/resources/static/shearphoto/php/upload.php", //上传图片
            cropImgUrl = "/resources/static/shearphoto/php/shearphoto.php", //裁剪图片
            relativeUrl = "", //图片存放顶级文件
            styleUrl = "shearphoto", //js css images 存放相对路径
            cropwidth = 500,//图片裁剪生成宽度
            uploads_url = "/upload";
            layui.config({
                base: '/resources/static/shearphoto/js/'
            }).use('cropper');
</script>