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
        <h4>新增菜单</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
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
                <label class="col-sm-2 control-label">路径</label>
                <div class="col-sm-4">
                    <input type="text" name="route" class="form-control">
                    <span>格式:IndexController@index</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">图标</label>
                <div class="col-sm-4">
                    <input type="text" name="icon" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-4">
                    <input type="text" name="sort" value="0" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否隐藏</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="hide" value="0" checked class=" radio-inline">显示
                    <input type="radio" name="hide" value="1" class="radio-inline">隐藏
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">上级菜单</label>
                <div class="col-sm-4">
                    <select name="pid" class="form-control">
                        <option value="0">顶级菜单</option>
                        @foreach ($top_menus as $top_menu)
                        <option value="{{$top_menu->id}}">{{$top_menu->name}}</option>
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