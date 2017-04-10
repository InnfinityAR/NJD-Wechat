<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>404</title>
        <style>
            body{
                font-family:"Microsoft YaHei";
            }
            .container{
                margin:auto;
                position: absolute;
                overflow: hidden;
                width:50%;
                height:285px;
                top:0;left:0;right:0;bottom:0;
            }
            img{
                display: block;
                margin:0 auto;
            }
            p{
                text-align: center;
                font-size: 16px;
            }
            span{
                font-size: 16px;
                color:#d62a2f;
            }
            .error{
                font-size: 24px;
                margin:65px auto 20px auto;
                color:#d62a2f
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img src="/resources/style/index/images/404.png" alt=""/>
            <p class="error">抱歉，{{$msg or '页面没有找到'}} T_T</p>
            <p><span>5</span>秒钟之后将带您进入<a href="/">首页</a></p>
        </div>
        <script src="/public/js/app.js"></script>
        <script>
            $(function () {
                var second = $(".container").find("span").html();
                setInterval(function () {
                    if (second > 1) {
                        second--;
                        $(".container").find("span").html(second);
                    } else {
                        location.href = "/";
                    }
                }, 1000)
            })
        </script>
    </body>
</html>