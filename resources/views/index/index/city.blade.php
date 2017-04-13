<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>南京贷微信</title>
        <link rel="stylesheet" href="/resources/static/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" href="/resources/static/bootcomplete/dist/bootcomplete.css"/>
        <link rel="stylesheet" href="/resources/style/index/css/index.css"/>
        <script src="/resources/static/js/app.js"></script>
        <script src="/resources/static/bootstrap/bootstrap.min.js"></script>
        <script src="/resources/static/layer_mobile/layer.js"></script>
        <script src="/resources/static/bootcomplete/dist/jquery.bootcomplete.js"></script>
    </head>
    <body>
        <div class="wrap">
            <div class="logo">
                <img style="width: 40%" src="/resources/style/index/images/logo.png">
            </div>
            <div class="tip">
                <div class="line"></div>
                <span class="choose">请选择您所在的城市</span>
                <div class="line"></div>
            </div>
            <div class="cityList">
                <ul>
                    <li>
                        <span>南京</span>
                        <a href="/">立即申请</a>
                    </li>
                    <li>
                        <span>北京</span>
                        <a href="javascript:;">立即申请</a>
                    </li>
                    <li>
                        <span>上海</span>
                        <a href="javascript:;">立即申请</a>
                    </li>
                    <li>
                        <span>广州</span>
                        <a href="javascript:;">立即申请</a>
                    </li>
                </ul>
            </div>
        </div>
        <script>
$(function () {


    var telReg = /^1[3|4|5|8][0-9]\d{4,8}$/;    // 手机正则
    var nameReg = /^[\u4e00-\u9fa5]{2,4}$/;     // 中文姓名正则
    // 去除提醒框
    $(".form input").focus(function () {
        $(this).removeClass("invalid");
    })
    $(".form select").change(function () {
        $(this).removeClass("invalid");
    })

    // 点击获取验证码
    $(".getCode").click(function () {
        if ($(this).hasClass("disabled")) {
            return;
        }
        var tel = $("input[name='tel']").val();

        // 验证手机号是否合法
        if (!telReg.test(tel)) {  // 无效手机号
            layer.open({
                "content": "请输入合法手机号",
                "skin": "msg",
                "time": 2
            })
            $("input[name='tel']").addClass("invalid");     // 改变input框颜色
        } else {
            $.ajax({
                type: "get",
                url: "/checkCodeTimes?tel=" + tel,
                success: function (result) {
                    if (result.status) {   // 发送验证码
                        $.ajax({
                            type: "get",
                            url: "/sendCode?tel=" + tel,
                            success: function (res) {
                                setTime();
                                layer.open({
                                    "content": res.msg,
                                    "skin": "msg",
                                    "time": 2
                                })
                            }
                        });
                    } else {
                        layer.open({
                            "content": result.msg,
                            "skin": "msg",
                            "time": 2
                        })
                    }
                }
            });

        }
    });

    // 点击提交表单
    $(".assess").click(function () {
        var data = {};
        data["house_type"] = $("select[name='house_type']").val();
        data["district"] = $("select[name='district']").val()
        data["house_addr"] = $("input[name='house_addr']").val();
        data["house_number"] = $("input[name='house_number']").val();
        data["floor"] = $("input[name='floor']").val();
        data["total_floor"] = $("input[name='total_floor']").val();
        data["house_area"] = $("input[name='house_area']").val();
        data["name"] = $("input[name='name']").val();
        data["sex"] = $("input[name='sex']:checked").val();
        data["tel"] = $("input[name='tel']").val();
        data["code"] = $("input[name='code']").val();
        // 验证表单信息
        if (data['district'] == 0) {
            $("select[name='district']").addClass("invalid");
            layer.open({
                "content": "请选择区域",
                "skin": "msg",
                "time": 2
            });
        } else if (data['house_type'] == 0) {
            $("select[name='house_type']").addClass("invalid");
            layer.open({
                "content": "请选择房屋性质",
                "skin": "msg",
                "time": 2
            });
        } else if (!data['house_addr']) {
            $("input[name='house_addr']").addClass("invalid");
            layer.open({
                "content": "请填写房屋地址",
                "skin": "msg",
                "time": 2
            });
        } else if (!/^[0-9]{1,}\.?[0-9]{1,}$/.test(data['house_area'])) {
            $("input[name='house_area']").addClass("invalid");
            layer.open({
                "content": "请正确填写房屋面积",
                "skin": "msg",
                "time": 2
            });
        } else if (!nameReg.test(data['name'])) {
            $("input[name='name']").addClass("invalid");
            layer.open({
                "content": "请正确填写姓名",
                "skin": "msg",
                "time": 2
            });
        } else if (!telReg.test(data['tel'])) {
            $("input[name='tel']").addClass("invalid");
            layer.open({
                "content": "请填写合法手机号",
                "skin": "msg",
                "time": 2
            });
        } else if (!data["code"]) {
            $("input[name='code']").addClass("invalid");
            layer.open({
                "content": "请填写手机验证码",
                "skin": "msg",
                "time": 2
            });
        } else {
            layer.open({type: 2});
            // 判断验证码
            $.ajax({
                type: "get",
                url: "/checkCode?tel=" + data['tel'] + "&code=" + data['code'],
                success: function (res) {
                    if (res.status) {     // 验证码正确，提交表单
                        $.ajax({
                            type: "post",
                            data: data,
                            url: "/storeClientInfo",
                            success: function (result) {
                                console.log(result);
                                if (result.status) {
                                    layer.closeAll();
                                } else {

                                }
                            }
                        })
                    } else {      // 验证码错误
                        layer.open({
                            "content": res.msg,
                            "skin": "msg",
                            "time": 2
                        });
                    }
                }
            });
        }
    });

    // 自动补全
    $(".complete").bootcomplete({
        url: "/getAddr",
        method: "get",
        minLength: 2
    });


    // 倒计时函数
    var countTime = 60;
    function setTime() {
        if (countTime == 0) {   // 倒计时结束
            $(".getCode").html("获取验证码").removeClass("disabled");
            countTime = 60;
        } else {      // 倒计时
            $(".getCode").addClass("disabled");
            $(".getCode").html(countTime + "秒后重新获取");
            countTime--;
            setTimeout(function () {
                setTime();
            }, 1000);

        }
    }


})
        </script>
    </body>
</html>