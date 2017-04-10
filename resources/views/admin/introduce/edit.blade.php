@extends("admin.layout.base")

@section('head')

@include('layout.imageHead')

@endsection

@section('content')
<div class="alert alert-success fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>修改文章</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form"  id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-4">
                    <input type="text" name="title" value="{{$field->title}}" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">文章分类</label>
                <div class="col-sm-4">
                    <select name="nav_id" class="form-control article_category">
                        <option value="0">请选择</option>
                        @foreach($navs as $nav)
                        <option @if($field->nav_id == $nav->id)selected @endif value="{{$nav->id}}">{{getClassification($nav->level)}}{{$nav->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">文章关键词</label>
                <div class="col-sm-4">
                    <input type="text" name="keywords" value="{{$field->keywords}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">文章描述</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control">{{$field->description}}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">内容</label>
                <div class="col-sm-10">
                    <textarea name="content" id="content" cols="100" rows='8'>{{$field->content}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4 ">
                    <a href="javascript:;" id="{{$field->id}}" class="editSubmit btn btn-primary">提 交</a>&nbsp;
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