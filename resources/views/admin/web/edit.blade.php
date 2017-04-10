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
        <h4>网站基本信息</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" action="/{{$admin_prefix}}/web"  id="form">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">网站名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站英文全称</label>
                <div class="col-sm-4">
                    <input type="text" name="name_en" value="{{$field->name_en}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">客服QQ</label>
                <div class="col-sm-4">
                    <input type="text" name="qq" value="{{$field->qq}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站联系电话</label>
                <div class="col-sm-4">
                    <input type="text" name="tel" value="{{$field->tel}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站邮箱</label>
                <div class="col-sm-4">
                    <input type="text" name="email" value="{{$field->email}}" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">友情提示</label>
                <div class="col-sm-4">
                    <input type="text" name="tips" value="{{$field->tips}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">法律顾问</label>
                <div class="col-sm-4">
                    <input type="text" name="layer_consult" value="{{$field->layer_consult}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">许可证</label>
                <div class="col-sm-4">
                    <input type="text" name="licence" value="{{$field->licence}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">备案号</label>
                <div class="col-sm-4">
                    <input type="text" name="record_number" value="{{$field->record_number}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">版权</label>
                <div class="col-sm-4">
                    <input type="text" name="copyright" value="{{$field->copyright}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站标题</label>
                <div class="col-sm-4">
                    <input type="text" name="title" value="{{$field->title}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站描述</label>
                <div class="col-sm-4">
                    <input type="text" name="desc" value="{{$field->desc}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站关键词</label>
                <div class="col-sm-4">
                    <input type="text" name="keywords" value="{{$field->keywords}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">网站logo</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="{{$field->logo_url or '/resources/static/shearphoto/images/background.jpg'}}" style="width:200px;" >
                    <input type="hidden" class="upload-show-input" value="{{$field->logo_url}}" name="logo_url"/>
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
                <label class="col-sm-2 control-label">首页底部logo</label>
                <div class="col-sm-4 site-demo-upload">
                    <img class="upload-show-img"  src="{{$field->bottom_logo_url or '/resources/static/shearphoto/images/background.jpg'}}" style="width:200px;" >
                    <input type="hidden" class="upload-show-input" value="{{$field->bottom_logo_url}}" name="bottom_logo_url"/>
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
                <label class="col-sm-2 control-label">网站底部代码(沟通代码、百度统计等)</label>
                <div class="col-sm-6">
                    <textarea name="site_bottom_code" class="form-control">{{$field->site_bottom_code}}</textarea>
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

@section('script')
@include("layout.imageFoot")
<script>
    var saveUrl = "web"; //图片存放文件夹
</script>
@endsection