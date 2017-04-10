$(function () {
    // 导航栏样式初始化
    $("#nav li").each(function(k, v){
        console.log($(this).find(".one_menu dd").length)
        if($(this).find(".one_menu").children("dd").length==1){
            $(this).find(".one_menu dd").css("-webkit-border-radius","10px");
        }
    });
    // 搜索文章
    $(".serch_btn").click(function () {
        var search = $(this).prev("input").val();
        if (search) {
            location.href = "/article?search=" + search;
        }
    });
    
    // 回车搜索
    $(".search-input").focus(function(){
        document.onkeydown = function (e) {
            var ev = document.all ? window.event : e;
            if (ev.keyCode == 13) {
                var search = $(".search-input").val();
                if (search != "") {
                    location.href = "/article?search=" + search;
                }
            }
        }
    });

    // 右侧悬浮框居中
    var screenHeight = $(window).height();
    var selfHeight = $(".aside").height();
    $(".aside").css("top", (screenHeight - selfHeight) / 2 + "px");

    // 弹窗联系
    // 获取验证码
    $(".quickForm .getCode").click(function () {
        if($(this).attr("disabled") == "disabled"){
            return false;
        }
        var tel = $(".quickForm").find("input[name='tel']").val();
        var telReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

        if (!telReg.test(tel)) {    // 手机号验证失败
            layer.msg("请输入合法的手机号");
        } else {  // 发送验证码
            setTime();
            $.ajax({
                type: "get",
                url: "/sendCode?tel=" + tel,
                success: function (res) {
                    if (res) {
                        layer.msg("验证码发送成功");
                    } else {
                        layer.msg("网络错误");
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
            layer.msg("请输入合法中文姓名");
        }else if(!telReg.test(data['tel'])){
            layer.msg("请输入合法的手机号");
        }else if(!code){
            layer.msg("请输入验证码");
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
                                    layer.msg("信息提交成功");
                                    $("#asideBox").hide();
                                    $("#zhezhaoc").hide();
                                }else{
                                    layer.msg("信息提交失败");
                                }
                            }
                        })
                    }else{
                        layer.msg("网络错误");
                    }
                }
            })
        }
        
    });

    // 倒计时函数
    var countTime = 60;
    function setTime() {
        if (countTime == 1) {     // 
            $(".quickForm").find(".getCode").html("获取验证码").attr("disabled", "");
            $("#testCod").css("background", "#d82b27");
            countTime = 60;
        } else {
            countTime--;
            $(".quickForm").find(".getCode").html(countTime + "秒后重新获取").attr("disabled", "disabled");
            $("#testCod").css("background", "#999");
            setTimeout(function () {
                setTime();
            }, 1000);

        }
    }

})