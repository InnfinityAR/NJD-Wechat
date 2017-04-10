<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>南京微贷</title>
        <link rel="stylesheet" href="/resources/static/bootstrap/bootstrap.css"/>
        <link rel="stylesheet" href="/resources/style/index/css/index.css"/>
        <script src="/resources/static/js/app.js"></script>
        <script src="/resources/static/bootstrap/bootstrap.min.js"></script>
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
                            <input type="text" name="name" placeholder="请输入姓氏" class="form-control sex-input">
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
        
    </body>
</html>