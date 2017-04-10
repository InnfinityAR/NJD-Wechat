@extends("mobile.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div id="zhezhao"></div>
<div class="serchTop top clear">
    <a href="/search" class="goto"><img src="/resources/style/mobile/images/go.png" alt=""/></a>
    <h1 class="serchT">搜索结果</h1>
</div>
<div class="position">
    <ul>
        <li><a href="/">首页</a>>></li><li><a href="/search?search={{$search}}">{{$search}}</a></li>
    </ul>
</div>
<article class="serchList">
    @foreach($articles as $article)
    <dl>
        <dt><a href="/article/{{$article['id']}}">{{$article['title']}}</a></dt>
        <dd>{{date("Y年m月d日", $article['publish_time'])}}</dd>
    </dl>
    @endforeach
    <ul class="page">
        @if($p>1)<li class="fl"><a href="/search?search={{$search}}&p={{$p-1}}">上一页</a> </li>@endif

        @if($p!=$all_pages)<li class="fr"><a href="/search?search={{$search}}&p={{$p+1}}">下一页</a></li>@endif
    </ul>
</article>
<article class="serch_list">
    <div class="onlinebg">
        <img src="/resources/style/mobile/images/online.png" alt=""/>
        <div class="onCon">
            <h2 class="title">新加坡入学初级学院考试</h2>
            <span class="line"></span>
            <span>通往新加坡优质教育的最佳途径</span>
            <a class="bottom_serch_on">立即查看</a>
        </div>
    </div>
</article>
@endsection

@section('footer')
@include("mobile.layout.footer")
@endsection

@section('script')
<script>
    $(function () {
        $(".about_usBtn ul li").click(function () {
            $(this).addClass("on").siblings().removeClass("on");
            $(".oursCon").eq($(this).index()).removeClass("none").siblings(".oursCon").addClass("none")
        });
        $("#closeBtn").click(function () {
            $("#tanchuang").hide();
            $("#zhezhaobg").hide();
        })
        var wh;
        var Top;
        $("#charWer").next().click(function (e) {
            e = e || event;
            e.preventDefault();
            pageScroll()
        });
        $('body').bind('touchmove', function () {
            wh = $(this).scrollTop();
            Top = (wh + ($(window).height()) / 4) + "px";
            if (wh > 168) {
                $("#asideIcon").show()
            } else {
                $("#asideIcon").hide()
            }
            ;
        });
        $("#charWer").click(function () {
            $("#tanchuang").show().css("top", Top);
            $("#zhezhaobg").show();
        });
        $("#btnonline").click(function () {
            $("#tanchuang").show().css("top", Top);
            $("#zhezhaobg").show();
        });
        $(".bottom_serch_on").click(function () {
            $("#tanchuang").show().css("top", Top);
            $("#zhezhaobg").show();
        });
    })
    function pageScroll() {
        window.scrollBy(0, -100);
        scrolldelay = setTimeout('pageScroll()', 10);
        var sTop = document.documentElement.scrollTop + document.body.scrollTop;
        if (sTop == 0)
            clearTimeout(scrolldelay);
        $("#asideIcon").hide()
    }
    ;
</script>
@endsection