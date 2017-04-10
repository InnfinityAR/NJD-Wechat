<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>@yield('title'){{$web['name']}}</title>
        <meta name="description" content="@yield('desc')">
        <meta name="keyword" content="@yield('keywords')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" href="/resources/style/index/css/index.css"/>
        
        <script src="/public/js/app.js"></script>
        <script src="/resources/static/layer/layer.js"></script>
        <script src="/resources/static/js/jquery.dotdotdot.min.js"></script>
        <script src="/resources/style/index/js/common.js"></script>
        <!--[if lt IE 9]> 
   <script> src="http://html5shim.googlecode.com/svn/trunk/html5.js"</script> 
   <![endif]-->
        @yield("head")
    </head>
    <body>
        <!--header开始-->
        @include("index.layout.header")
        <!--header结束-->
        
        <!--content开始-->
        @yield('content')
        <!--content结束-->

        <!--footer结束-->
        @yield('footer')
        @include('index.layout.aside')
        <!--footer结束-->
        
        @yield('script')
        {!!$web['site_bottom_code']!!}
    </body>
</html>