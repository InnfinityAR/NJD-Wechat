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
        <h4>修改密码</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">原密码</label>
                <div class="col-sm-4">
                    <input type="text" name="old_pwd" placeholder="此账号原密码" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">新密码</label>
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
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4 ">
                    <a href="javascript:;" class="changePwd btn btn-primary">提 交</a>&nbsp;
                    <a href="/{{$admin_prefix}}" class="btn btn-default">返 回</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    $(function(){
        $("input[name=password],input[name=old_pwd]").blur(function(){
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
        
        // 提交表单
        $(".changePwd").click(function(){
            var data = {};
            data["old_pwd"] = $("input[name='old_pwd']").val();
            data["password"] = $("input[name='password']").val();
            data["repeat_pwd"] = $("input[name='repeat_pwd']").val();
            data["_token"] = csrf_token;
            if(!data["old_pwd"]||!data["password"]||!data["repeat_pwd"]){
                layer.msg("请输入完整的表单信息");
            }else if(data["password"]!=data["repeat_pwd"]){
                layer.msg("两次密码输入不一致");
            }else{
                $.ajax({
                    type:"post",
                    url:"/"+admin_prefix+"/changePwd",
                    data:data,
                    success:function(res){
                        if(res.status){
                            $("#form input").val("");
                            layer.msg("重置密码成功!");
                            setTimeout(function(){
                                location.href="/"+admin_prefix+"/logout";
                            },1500);
                        }else{
                            layer.msg(res.msg);
                        }
                    }
                })
            }
        });
    })
</script>
@endsection