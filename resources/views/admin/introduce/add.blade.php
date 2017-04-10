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
        <h4>新增网站介绍信息</h4>
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
                <label class="col-sm-2 control-label">所属导航</label>
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
                <label class="col-sm-2 control-label">关键词</label>
                <div class="col-sm-4">
                    <input type="text" name="keywords" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">描述</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">介绍内容</label>
                <div class="col-sm-10">
                    <textarea name="content" id="content"></textarea>
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

    })

</script>
@endsection