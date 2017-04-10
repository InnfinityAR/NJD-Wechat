@extends("mobile.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div id="zhezhao"></div>
<div class="serchTop top clear">
    <a href="/" class="goto"><img src="/resources/style/mobile/images/go.png" alt=""/></a>
    <h1 class="serchT">{{$introduce['title']}}</h1>
    <a href="/search" class="serch"><i class="icon"></i></a>
</div>
<img src="/resources/style/mobile/images/about.png" alt=""/>
<div class="position">
    <ul>
        <li><a href="/">首页</a>>></li><li><a href="/introduce/{{$introduce['id']}}">{{$introduce['title']}}</a></li>
    </ul>
</div>

<article @if(count($navs)<=1)style='padding:0;' @endif class="aboutUS">

          <div class="about_usBtn">
        <ul>
            @if(count($navs)>1)
            @foreach($navs as $nav)
            <a style="color: #fff" href="/introduce/{{$nav['id']}}"><li @if($nav['id']==$this_nav['id'])class='on' @endif>{{$nav['name']}}</li></a>
            @endforeach
            @endif
        </ul>
    </div>
</article>

<div class="oursCon">
    <h2>{{$introduce['title']}}</h2>
    {!!$introduce['content']!!}
</div>

<article>
    <h2 class="title">猜你喜欢</h2>
    <span class="line red"></span>
    <div class="like">
        @foreach($likes as $key=>$like)
        <div class="messbox">
            <i class="index_icon">{{$key+1}}</i>
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
            <a  class="bottom_serch_on">立即查看</a>
        </div>
    </div>
</article>
@endsection

@section('footer')
@include('mobile.layout.footer')
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