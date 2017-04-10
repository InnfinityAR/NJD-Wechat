@extends("admin.layout.base")

@section('content')
<div id="alert" class="alert fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>新增导航</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">导航名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">url</label>
                <div class="col-sm-4">
                    <input type="text" name="url" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否显示</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="is_show" value="1" checked class=" radio-inline">是
                    <input type="radio" name="is_show" value="0" class="radio-inline">否
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">手机端是否显示</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="mobile_show" value="1" checked class=" radio-inline">是
                    <input type="radio" name="mobile_show" value="0" class="radio-inline">否
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">导航显示位置</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="position" value="1" checked class=" radio-inline">网站顶部
                    <input type="radio" name="position" value="0" class="radio-inline">网站底部
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-4">
                    <input type="text" name="sort" value="0" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级导航</label>
                <div class="col-sm-4">
                    <select name="pid" class="form-control">
                        <option value="0">顶级导航</option>
                        @foreach ($top_navs as $top_nav)
                        <option value="{{$top_nav->id}}">{{getClassification($top_nav->level)}}{{$top_nav->name}}</option>
                        @endforeach
                    </select>
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