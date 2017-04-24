<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
        <title>南京贷房屋抵押贷快速申请平台</title>
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
            <div class="step">
                <img style="width: 80%" src="/resources/style/index/images/step1.png">
            </div>
            <div class="form">
                <form>
                    <div class="formGroup">
                        <label class="labelTitle">所在区</label>
                        <div class="formControl">
                            <select class="form-control" name="district">
                                <option value="0">请选择房屋所在区</option>
                                @foreach($districts as $district)
                                <option value="{{$district->districtname}}">{{$district->districtname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="formGroup residentialAreaDiv">
                        <label class="labelTitle">房屋地址</label>
                        <div class="formControl">
                            <input type="text" name="house_addr" placeholder="请填写房屋所在小区或地址" class="form-control complete">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">所在楼栋</label>
                        <div class="formControl">
                            <input type="text" name="house_number" placeholder="如：1栋1单元(非必填)" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">所在楼层</label>
                        <div class="formControl">
                            <span>所在</span>
                            <input type="number" name="floor" max="2" style="width:67px"  class="form-control floor-input" placeholder="非必填">
                            <span>层</span>
                            <span class="total-floor-span">共</span>
                            <input type="number" name="total_floor" max="2" style="width:67px"  class="form-control floor-input" placeholder="非必填">
                            <span >层</span>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">房屋面积</label>
                        <div class="formControl">
                            <input type="number" name="house_area" placeholder="请填写房屋面积/㎡" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">姓氏</label>
                        <div class="formControl">
                            <input type="text" name="name" placeholder="请填写您的姓氏"  class="form-control">

                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">性别</label>
                        <div class="formControl">
                            <label><input type="radio" name="sex" checked="checked" value="1">先生</label>
                            <label><input type="radio" name="sex" value="2">女士</label>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">手机号</label>
                        <div class="formControl">
                            <input type="tel" name="tel" placeholder="请填写您的手机号" maxlength="11" class="form-control">
                        </div>
                    </div>
                    <div class="formGroup">
                        <label class="labelTitle">验证码</label>
                        <div class="formControl">
                            <input type="number" name="code" placeholder="验证码" maxlength="4" class="form-control code-input">
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
$(function () {
    tel_num = "";
    district = "";
    
    var telReg = /^1[3|4|5|8][0-9]\d{4,8}$/;    // 手机正则
    var nameReg = /^[\u4e00-\u9fa5]{1,2}$/;     // 中文姓名正则
    // 去除提醒框
    $(".form input").focus(function () {
        $(this).removeClass("invalid");
    })
    $(".form select").change(function () {
        $(this).removeClass("invalid");
    })
    $("select[name='district']").change(function(){
        district = $(this).val();
        console.log(district)
    });

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
            tel_num = tel;
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
        data["house_addr"] = $("input[name='house_addr']").val()||$("input[name='house_addr_id']").val();
        data["house_number"] = $("input[name='house_number']").val();
        data["floor"] = $("input[name='floor']").val();
        data["total_floor"] = $("input[name='total_floor']").val();
        data["house_area"] = $("input[name='house_area']").val();
        data["name"] = $("input[name='name']").val();
        data["sex"] = $("input[name='sex']:checked").val();
        data["tel"] = $("input[name='tel']").val();
        data["code"] = $("input[name='code']").val();
        
        if(data["house_number"] == "")
        {
          data["house_number"] = "1栋1单元";  
        }
        
        if(data["floor"] == "")
        {
          data["floor"] = "1";  
        }
        
        if(data["total_floor"] == "")
        {
          data["total_floor"] = "1";  
        }
        
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
                "content": "请正确填写姓氏",
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
            if(data["tel"]!=tel_num){
                layer.open({
                    "content": "请勿更改手机号",
                    "skin": "msg",
                    "time": 2
                });
                $("input[name='tel']").addClass("invalid");
                return ;
            }
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
                                layer.closeAll();
                                if (result.status) {
                                    location.href = "/access/"+result.id;
                                } else {
                                    layer.open({
                                        "content": result.msg,
                                        "skin": "msg",
                                        "time": 2
                                    });
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
        minLength: 2,
        dataParams:{"district":district}
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
        {!!$wechat!!}
    </body>
</html>
