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
        <h4>水印配置</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" action="/{{$admin_prefix}}/watermark"  id="form">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">水印位置</label>
                <div class="col-sm-4">
                    <input type="radio" name="water_pos" value="1" @if($field->water_pos==1)checked @endif class=" radio-inline">上左
                    <input type="radio" name="water_pos" value="2" @if($field->water_pos==2)checked @endif class="radio-inline">上中
                    <input type="radio" name="water_pos" value="3" @if($field->water_pos==3)checked @endif class="radio-inline">上右<br />
                    <input type="radio" name="water_pos" value="4" @if($field->water_pos==4)checked @endif class="radio-inline">中左
                    <input type="radio" name="water_pos" value="5" @if($field->water_pos==5)checked @endif class="radio-inline">中中
                    <input type="radio" name="water_pos" value="6" @if($field->water_pos==6)checked @endif class="radio-inline">中右<br />
                    <input type="radio" name="water_pos" value="7" @if($field->water_pos==7)checked @endif class="radio-inline">下左
                    <input type="radio" name="water_pos" value="8" @if($field->water_pos==8)checked @endif class="radio-inline">下中
                    <input type="radio" name="water_pos" value="9" @if($field->water_pos==9)checked @endif class="radio-inline">下右
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">图片透明度</label>
                <div class="col-sm-4">
                    <input type="text" name="opacity" value="{{$field->opacity}}" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">水印图片</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="{{$field->img_url or '/resources/static/shearphoto/images/background.jpg'}}" style="width:200px;" >
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
                <label class="col-sm-2 control-label">水印文字内容</label>
                <div class="col-sm-4">
                    <input type="text" name="text_content" value="{{$field->text_content}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">水印文字大小</label>
                <div class="col-sm-4">
                    <input type="text" name="text_size" value="{{$field->text_size}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">水印文字颜色</label>
                <div class="col-sm-4">
                    <input type="color" name="text_color" value="{{$field->text_color}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">水印文字字体</label>
                <div class="col-sm-4">
                    <input type="text" name="text_color" value="{{$field->text_family or '宋体'}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4 ">
                    <a href="javascript:;" id="{{$field->id}}" class="editSubmit btn btn-primary">提 交</a>&nbsp;
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
@include("layout.imageFoot")
<script>
    var saveUrl = "watermark"; //图片存放文件夹
</script>
@endsection