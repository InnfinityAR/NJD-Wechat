@extends("mobile.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div id="zhezhao"></div>
<div class="serchTop top clear">
    <input type="serch" class="search-input" placeholder="搜索您想学习的课程"/>
</div>
<article class="serchKey">
    <div class="btn_serGrow">
        <span class="on">最近搜索</span><span>热门搜索</span>
    </div>
    <ul class="serGroL">
        @foreach($new_tips as $new_tip)
        <li><a href="/search?search={{$new_tip['name']}}">{{$new_tip['name']}}</a></li>
        @endforeach
    </ul>
    <ul class="none serGroL">
        @foreach($hot_tips as $hot_tip)
        <li><a href="/search?search={{$hot_tip['name']}}">{{$hot_tip['name']}}</a></li>
        @endforeach
    </ul>
</article>
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

        // 切换关键词
        $(".btn_serGrow span").click(function () {
            var index = $(this).index();
            $(this).addClass("on").siblings("span").removeClass("on");
            $(".serGroL").eq(index).removeClass("none").siblings(".serGroL").addClass("none");
        });

        // 输入完成跳转搜索
        $(".search-input").on("blur", function () {
            var search = $(this).val();
            if (search) {
                location.href = "/search?search=" + search;
            }
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