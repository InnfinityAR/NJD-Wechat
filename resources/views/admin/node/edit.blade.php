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
        <h4>修改权限</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">权限名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">权限描述</label>
                <div class="col-sm-4">
                    <input type="text" name="remark" value="{{$field->remark}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">管理菜单</label>
                <div class="col-sm-6">
                    @foreach ($backmenus as $backmenu)
                    @if($backmenu->pid ==0 )
                    <label class="checkbox" style="font-size:20px;">
                        <input class="check_all" type="checkbox" name="backmenu_ids[]" @if(hasBackmenu($field->id,$backmenu->id)) checked @endif value="{{$backmenu->id}}" >{{$backmenu->name}} <br />
                        @foreach ($backmenus as $menu)
                        @if($menu->pid == $backmenu->id )
                        <label class="checkbox-inline" style="font-size: 14px;width: 32%;display: inline-block;margin-left: 0px;">
                            <input style="float: none" type="checkbox" name="backmenu_ids[]" @if(hasBackmenu($field->id,$menu->id)) checked @endif value="{{$menu->id}}" >{{$menu->name}}
                        </label>
                        @endif
                        @endforeach
                    </label>
                    @endif
                    @endforeach
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
<script>
    $(function () {
        $(".check_all").click(function () {
            $(this).siblings("label").find("input").prop("checked", $(this).prop("checked"));
        });
    })
</script>
@endsection