@extends("mobile.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div id="zhezhao"></div>
<div class="serchTop top clear">
    <a href="javascript:;" class="goto"><img src="/resources/style/mobile/images/go.png" alt=""/></a>
    <h1 class="serchT">文章详情</h1>
    <a href="/search" class="serch"><i class="icon"></i></a>
</div>
<img src="/resources/style/mobile/images/about.png" alt=""/>
<div class="position">
    <ul>
        <li><a href="/">首页</a>>></li><li><a href="/article/{{$article['id']}}">{{$article['title']}}</a></li>
    </ul>
</div>
<div class="article">
    <h2>{{$article['title']}}</h2>
    <span>发布时间：{{date("Y-m-d", $article['publish_time'])}}</span>
    <span>分享到:</span>
    <div class="art_share bshare-custom icon-medium">
        <div class="bsPromo bsPromo2"></div>
        
        <a title="分享到新浪微博" class="bshare-sinaminiblog" href="javascript:void(0);" ></a>
        <a title="分享到微信" class="bshare-weixin" href="javascript:void(0);"></a>
        <a title="分享到QQ空间" class="bshare-qzone" href="javascript:void(0);"></a>
        <a title="分享到i贴吧" class="bshare-itieba" href="javascript:void(0);"></a>
        <!--    <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>-->
    </div>
    
    {!!$article['content']!!}
</div>
<article>
    <div class="tuijian">
        <h2 class="tuij"><i class="bgicon"></i>相关推荐</h2>
        <ul>
            @foreach($recommend_articles as $recommend_article)
            <li>
                <a href="/article/{{$recommend_article['id']}}">{{$recommend_article['title']}}</a>
            </li>
            @endforeach
        </ul>
    </div>
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
@include('mobile.layout.footer')
@endsection

@section('script')
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>

<script>
    $(function(){
        
        $(".about_usBtn ul li").click(function(){
            $(this).addClass("on").siblings().removeClass("on");
            $(".oursCon").eq($(this).index()).removeClass("none").siblings(".oursCon").addClass("none")
        });
	$("#closeBtn").click(function(){
	   $("#tanchuang").hide();
	   $("#zhezhaobg").hide();
	})
	var wh;
	var Top;
	$("#charWer").next().click(function(e){
		e=e||event;
		e.preventDefault();
		pageScroll()
	});
	$('body').bind('touchmove', function(){ 
       wh = $(this).scrollTop(); 
	   Top = (wh+($(window).height())/4) + "px";
	   if(wh>568){
		   $("#asideIcon").show()
	   }else{
		   $("#asideIcon").hide()
	   };
    });
	$("#charWer").click(function(){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
	});
	$("#btnonline").click(function(){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
	});
	$(".bottom_serch_on").click(function(){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
	});
    })
	function pageScroll(){
    window.scrollBy(0,-100);
    scrolldelay = setTimeout('pageScroll()',10);
    var sTop=document.documentElement.scrollTop+document.body.scrollTop;
    if(sTop==0) clearTimeout(scrolldelay);
	$("#asideIcon").hide()
};
</script>
@endsection