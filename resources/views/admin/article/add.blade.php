@extends("admin.layout.base")

@section('head')

@include('layout.imageHead')
<link rel="stylesheet" type="text/css" href="/resources/static/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />

@endsection

@section('content')
<div class="alert fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>新增文章</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-4">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">原图</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="/resources/static/shearphoto/images/background.jpg" style="width:200px;" >
                    <input type="hidden" class="upload-show-input" name="picture"/>
                    <div class="site-demo-upbar" style="top: 45%;left:60%;">
                        <div class="layui-box layui-upload-button upload-check-img" style="margin-top: -30%;">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>查看图片</span>
                        </div>

                        <div class="layui-box layui-upload-button site-upfile-layer">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>上传图片</span>
                        </div>

                        <div class="layui-box layui-upload-button upload-delete-img">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>删除图片</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">缩略图</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="/resources/static/shearphoto/images/background.jpg" style="width:200px;" >
                    <input type="hidden" class="upload-show-input" name="thumbnail"/>
                    <div class="site-demo-upbar" style="top: 45%;left:60%;">
                        <div class="layui-box layui-upload-button upload-check-img" style="margin-top: -30%;">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>查看图片</span>
                        </div>

                        <div class="layui-box layui-upload-button site-upfile-layer">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>上传图片</span>
                        </div>

                        <div class="layui-box layui-upload-button upload-delete-img">
                            <span class="layui-upload-icon"><i class="layui-icon"></i>删除图片</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章分类</label>
                <div class="col-sm-4">
                    <select name="nav_id" class="form-control article_category">
                        <option value="0">请选择</option>
                        @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{getClassification($nav->level)}}{{$nav->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">水印类型</label>
                <div class="col-sm-4">
                    <input type="radio" name="water_type" value="0"  checked="checked">不添加水印
                    <input type="radio" name="water_type" value="1" >添加图片水印
                    <input type="radio" name="water_type" value="2" >添加文字水印
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章关键词</label>
                <div class="col-sm-4">
                    <input type="text" name="keywords" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">浏览量</label>
                <div class="col-sm-4">
                    <input type="text" name="hits" value="0" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">发布时间</label>
                <div class="col-sm-4">
                    <input size="16" type="text" name="publish_time" value="{{date("Y-m-d", time())}}" readonly class="publish_time form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">更新时间</label>
                <div class="col-sm-4">
                    <input size="16" type="text" name="update_time" value="{{date("Y-m-d", time())}}" readonly class="update_time form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章描述</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章摘要</label>
                <div class="col-sm-6">
                    <textarea name="abstract" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">内容</label>
                <div class="col-sm-10">
                    <textarea name="content" id="content" cols="100" rows='8'></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4 ">
                    <a href="javascript:;" class="createSubmit btn btn-primary">提 交</a>&nbsp;
                    <a href="/{{$admin_prefix}}/{{$controller}}" class="btn btn-default">返 回</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section("script")
@include("layout.imageFoot")
<script type="text/javascript" charset="utf-8">
    window.UEDITOR_HOME_URL = "/resources/static/ueditor/";  //UEDITOR_HOME_URL、config、all这三个顺序不能改变
</script>
<script type="text/javascript" charset="utf-8" src="/resources/static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/resources/static/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="/resources/static/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script>
    var saveUrl = controller; //图片存放文件夹
    $(function () {
        // ue编辑器
        UE.getEditor('content', {
            "initialFrameWidth": "100%",
            "initialFrameHeight": 200,
        });

        // 时间选择
        $(".publish_time").datetimepicker({
            format: 'yyyy-mm-dd',
            language: "cn",
            autoclose: "true",
            minView: "month",
            todayBtn: true,
        });
        
        $(".update_time").datetimepicker({
            format: 'yyyy-mm-dd',
            language: "cn",
            autoclose: "true",
            minView: "month",
            todayBtn: true,
        });
        
        
    })

</script>
@endsection