$(function(){
    // 弹窗联系
    // 获取验证码
    $(".quickForm .getCode").click(function () {

        if($(this).hasClass("on")){
            return false;
        }
        var tel = $(".quickForm").find("input[name='tel']").val();
        var telReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

        if (!telReg.test(tel)) {    // 手机号验证失败
            layer.open({
                content:"请输入合法手机号",
                skin:"msg",
                time:2
            });
        } else {  // 发送验证码
            setTime();
            $.ajax({
                type: "get",
                url: "/sendCode?tel=" + tel,
                success: function (res) {
                    if (res) {
                        layer.open({
                            content:"短信验证码发送成功",
                            skin:"msg",
                            time:2
                        });
                    } else {
                        layer.open({
                            content:"网络错误",
                            skin:"msg",
                            time:2
                        });
                    }
                }
            });
        }
    });
    
    // 提交表单
    $(".quickForm .submitBtn").click(function(){
        var data = {};
        var telReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        var nameReg = /^[\u4E00-\u9FA5]{2,4}$/;
        data['name'] = $(".quickForm").find("input[name='name']").val();
        data['tel'] = $(".quickForm").find("input[name='tel']").val();
        var code = $(".quickForm").find("input[name='code']").val();
        
        
        // 验证数据
        if(!nameReg.test(data['name'])){
            layer.open({
                content:"请输入合法中文姓名",
                skin:"msg",
                time:2
            });
        }else if(!telReg.test(data['tel'])){
            layer.open({
                content:"请输入合法手机号",
                skin:"msg",
                time:2
            });
        }else if(!code){
            layer.open({
                content:"请输入验证码",
                skin:"msg",
                time:2
            });
        }else{
            $.ajax({
                type:"get",
                url:"/checkCode?code="+code,
                success:function(res){
                    
                    if(res){
                        $.ajax({
                            type:"post",
                            data:data,
                            url:"/saveUser",
                            success:function(res){
                                if(res){
                                    layer.open({
                                        content:"信息提交成功",
                                        skin:"msg",
                                        time:2
                                    });
                                    $("#tanchuang").hide();
                                    $("#zhezhaobg").hide();
                                }else{
                                    layer.open({
                                        content:"信息提交失败",
                                        skin:"msg",
                                        time:2
                                    });
                                }
                            }
                        })
                    }else{
                        layer.open({
                            content:"网络错误",
                            skin:"msg",
                            time:2
                        });
                    }
                }
            })
        }
        
    });

    // 倒计时函数
    var countTime = 60;
    function setTime() {
        if (countTime == 1) {     // 
            $(".quickForm").find(".getCode").html("获取验证码").removeClass("on");
            countTime = 60;
        } else {
            countTime--;
            $(".quickForm").find(".getCode").html(countTime + "秒后重新获取").addClass("on");
            setTimeout(function () {
                setTime();
            }, 1000);

        }
    }
    
    $("#zhezhaobg").click(function(){
        // 隐藏弹窗和遮罩
        $("#tanchuang").hide();
        $("#zhezhaobg").hide();
    });
    
    // 返回上一页
    $(".goto").click(function(){
        history.go(-1);
    });
})