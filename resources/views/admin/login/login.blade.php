<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="#" type="image/png">

        <title>Login</title>

        <link href="{{asset('resources/style/admin/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('resources/style/admin/css/style-responsive.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <form class="form-signin" method="post" >
                <div class="form-signin-heading text-center">
                    <h1 class="sign-title">登 录</h1>
                    <img src="{{asset('resources/style/admin/images/login-logo.png')}}" alt=""/>
                </div>
                <div class="login-wrap">
                    <input type="text" class="form-control" name="name" placeholder="用户名" autofocus>
                    <input type="password" class="form-control" name="password" placeholder="密码长度6-20位">
                    <input type="text" style="display: inline-block;width: 50%" class="form-control" name="code" placeholder="输入验证码">
                    <a style="float: right;display: inline-block;margin-right: 10px;" onclick="javascript:;" ><img class="captcha_img" src="/{{config('app.admin_prefix')}}/captcha"></a>
                    <a class="btn btn-lg btn-login btn-block submit">
                        <i class="fa fa-check"></i>
                    </a>

                </div>

            </form>

        </div>



        <!-- Placed js at the end of the document so the pages load faster -->

        <!-- Placed js at the end of the document so the pages load faster -->
        <script src="{{asset('resources/style/admin/js/jquery-1.10.2.min.js')}}"></script>
        <script src="{{asset('resources/static/layer/layer.js')}}"></script>
        <script>
                        $(function () {
                            // 提交表单
                            $(".submit").click(function () {
                                var name = $("input[name='name']").val();
                                var password = $("input[name='password']").val();
                                var code = $("input[name='code']").val();
                                if (name == '') {
                                    layer.tips("用户名不能为空", $("input[name='name']"));
                                } else if (password.length < 6 || password.length > 20) {
                                    layer.tips("密码长度不符合要求", $("input[name='password']"));
                                } else if(!code){
                                    layer.tips("验证码不能为空", $("input[name='code']"));
                                } else {
                                    var data = {};
                                    data["_token"] = "{{csrf_token()}}";
                                    data["name"] = name;
                                    data["password"] = password;
                                    data["code"] = code;
                                    $.ajax({
                                        type: "post",
                                        url: "/" + "{{config('app.admin_prefix')}}" + "/login",
                                        data: data,
                                        success: function (res) {
                                            if (res.status) {
                                                location.href = "/" + "{{config('app.admin_prefix')}}";
                                            } else {
                                                layer.msg(res["msg"], {icon: 5});
                                            }
                                        }
                                    });
                                }
                            });

                            // 回车事件
                            document.onkeydown = function (e) {
                                var ev = document.all ? window.event : e;
                                if (ev.keyCode == 13) {
                                    $(".submit").click();
                                }
                            }

                            // 刷新验证码
                            $(".captcha_img").click(function(){
                                var url = "/" + "{{config('app.admin_prefix')}}" + "/captcha/";
                                $(this).attr("src", url);
                            })
                        })
        </script>

    </body>
</html>
