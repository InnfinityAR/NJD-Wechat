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
            <div class="step">
                <img style="width: 80%" src="/resources/style/index/images/step2.png">
            </div>
            <div class="accessResult">
                <div class="result">
                    您的房产价值为:<span>{{$price}}</span>万元
                </div>
                <div class="houseImg">
                    <img style="width: 70%" src="/resources/style/index/images/house.png">
                </div>
                <div class="loan">
                    您的期望贷款金额为:<input class="form-control" type="number" name="loan_price">万元
                </div>
                <div class="tips">
                    温馨提示:最终贷款金额以合同为准
                </div>
                <div class="apply">
                    <a href="javascript:;" class="applyBtn">我要申请</a>
                </div>
                <input type="hidden" name="client_id" value="{{$client_id}}">
            </div>
        </div>
        <script>
            $(function(){
                $(".applyBtn").click(function(){
                    var client_id = $("input[name='client_id']").val();
                    var loan_price = $("input[name='loan_price']").val();
                    
                    if(!loan_price){
                        layer.open({
                            "content": "请填写您的期望贷款金额",
                            "skin": "msg",
                            "time": 2
                        })
                    }else{
                        location.href="/apply/"+client_id+"?loan_price="+loan_price;
                    }
                });
            })
        </script>
    </body>
</html>