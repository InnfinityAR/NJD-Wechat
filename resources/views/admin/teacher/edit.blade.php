@extends("admin.layout.base")

@section('head')

@include('layout.imageHead')
<link rel="stylesheet" type="text/css" href="/resources/static/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />

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
        <h4>修改教师</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form"  id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">英文名</label>
                <div class="col-sm-4">
                    <input type="text" name="name_en" value="{{$field->name_en}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">教师职称</label>
                <div class="col-sm-4">
                    <input type="text" name="job" value="{{$field->job}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序(升序排列)</label>
                <div class="col-sm-4">
                    <input type="text" name="sort" value="{{$field->sort}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否隐藏</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="is_show" value="1" @if($field->is_show==1)checked @endif class=" radio-inline">显示
                    <input type="radio" name="is_show" value="0" @if($field->is_show==0)checked @endif class="radio-inline">隐藏
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">教师图片</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="{{$field->img_url}}" style="width:200px;" >
                    <input type="hidden" class="upload-show-input" value="{{$field->img_url}}" name="img_url"/>
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
                <label class="col-sm-2 control-label">教师描述</label>
                <div class="col-sm-6">
                    <textarea name="desc" class="form-control">{{$field->desc}}</textarea>
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
<script>
    var saveUrl = controller; //图片存放文件夹
</script>
@endsection