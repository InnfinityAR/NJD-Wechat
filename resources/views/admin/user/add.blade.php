@extends("admin.layout.base")

@section('content')
<div class="alert fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>新增账号</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">账号</label>
                <div class="col-sm-4">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">密码</label>
                <div class="col-sm-4">
                    <input type="password" name="password" placeholder="密码长度为6-20位" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">重复密码</label>
                <div class="col-sm-4">
                    <input type="password" name="repeat_pwd" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">昵称</label>
                <div class="col-sm-4">
                    <input type="text" name="nickname" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">手机号码</label>
                <div class="col-sm-4">
                    <input type="text" name="tel" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">账户角色</label>
                <div class="col-sm-4">
                    @foreach ($roles as $role)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="role_ids[]" value="{{$role->id}}" >{{$role->name}}
                    </label>
                    @endforeach
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

@section('script')
<script>
    $(function(){
        $("input[name=password]").blur(function(){
            var password = $(this).val();
            if(password.length<6||password.length>20){
                layer.tips("密码长度为6-20位",$(this));
            }
        });
        
        $("input[name=repeat_pwd]").blur(function(){
            var repeat_pwd = $(this).val();
            var password = $("input[name=password]").val();
            if(password!=repeat_pwd){
                layer.tips("两次密码输入不一致",$(this));
            }
        });
    })
</script>
@endsection