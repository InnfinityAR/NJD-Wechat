<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>南京贷微信</title>
        <link rel="stylesheet" href="/resources/static/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" href="/resources/style/index/css/index.css"/>
        <script src="/resources/static/js/app.js"></script>
        <script src="/resources/static/bootstrap/bootstrap.min.js"></script>
        <script src="/resources/static/layer_mobile/layer.js"></script>
    </head>
    <body>
        <div class="wrap">
            <div class="logo">
                
            </div>
            <div class="step">
                
            </div>
            <div class="form">
                <form>
                    <div class="formGroup">
                        <label class="labelTitle">房屋性质</label>
                        <div class="formControl">
                            <select class="form-control" name="house_type">
                                <option value="0">请选择房屋性质</option>
                                <option value="1">住宅</option>
                                <option value="2">商用</option>
                            </select>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">房屋地址</label>
                        <div class="formControl">
                            <input type="text" name="house_addr" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">房屋面积</label>
                        <div class="formControl">
                            <input type="text" name="house_area" placeholder="请填写房屋面积/㎡" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">姓</label>
                        <div class="formControl">
                            <input type="text" name="name" placeholder="请输入姓氏"  class="form-control sex-input">
                            <span class="sex-span">
                                <label><input type="radio" name="sex" checked="checked" value="1">先生</label>
                                <label><input type="radio" name="sex" value="2">女士</label>
                            </span>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">手机号</label>
                        <div class="formControl">
                            <input type="tel" name="tel" placeholder="请输入申请者手机号" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">验证码</label>
                        <div class="formControl">
                            <input type="text" name="code" placeholder="请输入验证码" class="form-control code-input">
                            <span class="code-span">
                                <a class="getCode">获取验证码</a>
                            </span>
                        </div>
                    </div>
                    <div class="formGroup assessDiv">
                        <a class="assess">马上评估</a>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(function(){
                var telReg = /^1[3|4|5|8][0-9]\d{4,8}$/;    // 手机正则
                var nameReg = /^[\u4e00-\u9fa5]{2,4}$/;     // 中文姓名正则
                // 去除提醒框
                $(".form input").focus(function(){
                    $(this).removeClass("invalid");
                })
                $(".form select").change(function(){
                    $(this).removeClass("invalid");
                })
                
                // 点击获取验证码
                $(".getCode").click(function(){
                    if($(this).hasClass("disabled")){
                        return ;
                    }
                    var tel = $("input[name='tel']").val();
                    
                    // 验证手机号是否合法
                    if(!telReg.test(tel)){  // 无效手机号
                        layer.open({
                            "content":"请输入合法手机号",
                            "skin":"msg",
                            "time":2
                        })
                        $("input[name='tel']").addClass("invalid");     // 改变input框颜色
                    }else{      // 发送验证码
                        $.ajax({
                            type:"get",
                            url:"/sendCode?tel="+tel,
                            success:function(res){
                                setTime();
                                layer.open({
                                    "content":res.msg,
                                    "skin":"msg",
                                    "time":2
                                })
                            }
                        });
                    }
                });
                
                // 点击提交表单
                $(".assess").click(function(){
                    var data = {};
                    data["house_type"] = $("select[name='house_type']").val();
                    data["house_addr"] = $("input[name='house_addr']").val();
                    data["house_area"] = $("input[name='house_area']").val();
                    data["name"] = $("input[name='name']").val();
                    data["tel"] = $("input[name='tel']").val();
                    data["code"] = $("input[name='code']").val();
                    // 验证表单信息
                    if( !data['house_type']){
                        $("select[name='house_type']").addClass("invalid");
                        layer.open({
                            "content":"请选择房屋性质",
                            "skin":"msg",
                            "time":2
                        });
                    }else if(!data['house_addr']){
                        $("input[name='house_addr']").addClass("invalid");
                        layer.open({
                            "content":"请填写房屋地址",
                            "skin":"msg",
                            "time":2
                        });
                    }else if(!data['house_area']){
                        $("input[name='house_area']").addClass("invalid");
                        layer.open({
                            "content":"请填写房屋面积",
                            "skin":"msg",
                            "time":2
                        });
                    }else if(!nameReg.test(data['name'])){
                        $("input[name='name']").addClass("invalid");
                        layer.open({
                            "content":"请填写姓氏",
                            "skin":"msg",
                            "time":2
                        });
                    }else if(!telReg.test(data['tel'])){
                        $("input[name='tel']").addClass("invalid");
                        layer.open({
                            "content":"请填写合法手机号",
                            "skin":"msg",
                            "time":2
                        });
                    }else if(!data["code"]){
                        $("input[name='code']").addClass("invalid");
                        layer.open({
                            "content":"请填写手机验证码",
                            "skin":"msg",
                            "time":2
                        });
                    }else{
                        // 判断验证码
                        $.ajax({
                            type:"get",
                            url:"/checkCode?tel="+data['tel']+"&code="+data['code'],
                            success:function(res){
                                if(res.status){     // 验证码正确，提交表单
                                    
                                }else{      // 验证码错误
                                    layer.open({
                                        "content":res.msg,
                                        "skin":"msg",
                                        "time":2
                                    });
                                }
                            }
                        });
                    }
                });
                
                // 倒计时函数
                var countTime = 60;
                function setTime(){
                    if(countTime==0){   // 倒计时结束
                        $(".getCode").html("获取验证码").removeClass("disabled");
                        countTime = 60;
                    }else{      // 倒计时
                        $(".getCode").addClass("disabled");
                        $(".getCode").html(countTime+"秒后重新获取");
                        countTime--;
                        setTimeout(function(){
                            setTime();
                        },1000);
                        
                    }
                }
                
            })
        </script>
    </body>
</html>