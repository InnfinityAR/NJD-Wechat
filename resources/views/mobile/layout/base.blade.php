<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>@yield('title'){{$web['name']}}</title>
        <meta name="description" content="@yield('desc')">
        <meta name="keyword" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta http-equiv="Cache-Control" content="no-transform" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />

        <link rel="stylesheet" href="/resources/style/mobile/css/index.css"/>
        <script src="/resources/static/js/app.js"></script>
        <script src="/resources/static/layer_mobile/layer.js"></script>
        <script src="/resources/style/mobile/js/common.js"></script>
        @yield("head")
        <!--[if lt IE 9]> 
   <script> src="http://html5shim.googlecode.com/svn/trunk/html5.js"</script> 
   <![endif]-->
        
    </head>
    <body>
        @include("mobile.layout.nav")
        <div id="indexbox" class="index">
            @yield("content")
            
            @yield('footer')
        </div>
        @include("mobile.layout.aside")
        
        
        @yield('script')
    </body>
</html>