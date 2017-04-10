<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>南京微贷后台</title>
        <!--common-->
        <link href="{{asset('resources/style/admin/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('resources/style/admin/css/style-responsive.css')}}" rel="stylesheet">
        <link href="{{asset('resources/style/admin/js/DataTables/media/css/jquery.dataTable.css')}}" rel="stylesheet">
        
        @yield("head")

    </head>

    <body class="sticky-header">

        <section>
            @include("admin.layout.sidebar")

            <!-- main content start-->
            <div class="main-content" >
                @include("admin.layout.header")
                @yield('pagehead')
                <!--body wrapper start-->
                <div class="wrapper">
                    @yield('content')
                </div>
                <!--body wrapper end-->

            </div>
            <!-- main content end-->
        </section>

        <!-- Placed js at the end of the document so the pages load faster -->
        <script src="{{asset('resources/style/admin/js/jquery-1.10.2.min.js')}}"></script>
        <script src="{{asset('resources/style/admin/js/jquery-ui-1.9.2.custom.min.js')}}"></script>
        <script src="{{asset('resources/style/admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('resources/style/admin/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('resources/style/admin/js/DataTables/media/js/jquery.dataTables.js')}}"></script>

        <!--common scripts for all pages-->
        <script src="{{asset('resources/style/admin/js/scripts.js')}}"></script>
        <script src="{{asset('resources/static/layer/layer.js')}}"></script>
        <script>
            var csrf_token = "{{csrf_token()}}";
            var controller = "{{$controller}}";
            var admin_prefix = "{{$admin_prefix}}";
            $(function(){
                $(".sticky-header .main-content").css("min-height",$(window).height());
            })
        </script>
        <script src="{{asset('resources/style/admin/js/common.js')}}"></script>
        @yield('script')
    </body>
</html>
