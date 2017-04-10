@extends("admin.layout.base")

@section('content')
<div class="alert alert-success fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>修改菜单</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">url</label>
                <div class="col-sm-4">
                    <input type="text" name="url" value="{{$field->url}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">路径</label>
                <div class="col-sm-4">
                    <input type="text" name="route" value="{{$field->route}}" class="form-control">
                    <span>格式:IndexController@index</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">图标</label>
                <div class="col-sm-4">
                    <input type="text" name="icon" value="{{$field->icon}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-4">
                    <input type="text" name="sort" value="{{$field->sort}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否隐藏</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="hide" value="0" @if($field->hide==0) checked @endif class=" radio-inline">显示
                    <input type="radio" name="hide" value="1" @if($field->hide==1) checked @endif class="radio-inline">隐藏
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级菜单</label>
                <div class="col-sm-4">
                    <select name="pid" class="form-control">
                        <option @if($field->pid==0) selected @endif value="0">顶级菜单</option>
                        @foreach ($top_menus as $top_menu)
                        <option @if($field->pid==$top_menu->id) selected @endif value="{{$top_menu->id}}">{{$top_menu->name}}</option>
                        @endforeach
                    </select>
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