@extends("mobile.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div id="zhezhao"></div>
<div class="serchTop top clear">
    <a href="javascript:;" class="goto"><img src="/resources/style/mobile/images/go.png" alt=""/></a>
    <h1 class="serchT">考试介绍</h1>
    <a href="/search" class="serch"><i class="icon"></i></a>
</div>
<img src="/resources/style/mobile/images/about.png" alt=""/>
<div class="position">
    <ul>
        <li><a href="/">首页</a>>></li><li><a href="{{$this_nav->url}}">{{$this_nav->name}}</a></li>
    </ul>
</div>
<article class="aboutUS">
    <div class="about_usBtn">
        <ul>
            <a style="color: #fff" href="/article/education"><li @if($this_nav->url=='article/education') class="on" @endif>教育资讯</li></a>
            <a style="color: #fff" href="/article/abord"><li @if($this_nav->url=='article/abord') class="on" @endif>留学资讯</li></a>
        </ul>
    </div>
</article>
<div class="oursCon statu">
    <div class="conGrowOne clear">
        @foreach($articles as $article)
        <a href="/article/{{$article['id']}}">
            <!--<span class="list_img">
                <img src="/resources/style/mobile/images/list.png" alt=""/>
            </span>-->
            <span class="listCon">
                <h3 class="list_title">{{$article['title']}}</h3>
                <span class="list_mess">
                    <i class="time">{{date("Y年m月d日", $article['publish_time'])}}</i>
                    <i class="eyes">{{$article['hits']}}人浏览</i>
                </span>
                <p>{{$article['abstract']}}</p>
            </span>
        </a>
        @endforeach

        <ul class="page">
            <ul class="page">
                @if($p>1)<li class="fl"><a href="/article/{{$category}}?p={{$p-1}}">上一页</a> </li>@endif

                @if($p!=$all_pages)<li class="fr"><a href="/article/{{$category}}?p={{$p+1}}">下一页</a></li>@endif
            </ul>
        </ul>
    </div>
</div>
<article>
    <h2 class="title">猜你喜欢</h2>
    <span class="line red"></span>
    <div class="like">
        @foreach($likes as $key=>$like)
        <div class="messbox">
            <i class="index_icon"></i>
            <dl>
                <dt><a href="/article/{{$like['id']}}">{{$like['title']}}</a></dt>
                <dd>
                    <span class="list_mess">
                        <i class="time">{{date("Y年m月d日", $like['publish_time'])}}</i>
                        <i class="eyes">{{$like['hits']}}人浏览</i>
                    </span>
                </dd>
            </dl>
        </div>
        @endforeach
    </div>
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
@include('mobile.layout.footer')
@endsection

@section('script')

<script type="text/javascript" src="/resources/style/index/js/list.js"></script>
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
        if (wh > 568) {
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

@section('footer')
@include('index.layout.footer')
@endsection