@extends("mobile.layout.base")

@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('head')
<script src="/resources/style/mobile/js/index.js"></script>
@endsection
@section("content")

<div id="zhezhao"></div>
<div class="top clear">
    <div class="btn">
        <ul class="nav_btn">
            <li></li><li></li><li></li>
        </ul>
    </div>
    <a href="/" class="logo"><img src="/resources/style/mobile/images/logo.png" alt="logo"/></a>
    <a href="/search" class="serch"><i class="icon"></i></a>
</div>
<div class="banner">
    <h1>新加坡初级学院入学考试</h1>
    <span class="line"></span>
    <h3>通往新加坡优质教育的最佳途径</h3>
    <a href="#" class="line_btn">在线咨询</a>
</div>
<article>
    <h2 class="title">教育体系介绍</h2>
    <span class="line red"></span>
    <div class="imglist">
        <ul class="clear">
            @foreach($systems as $key=>$system)
            <li>
                <a href="/introduce/{{$system['nav_id']}}">
                    <img src="/resources/style/mobile/images/a{{$key+1}}.png" alt=""/>
                    <div class="contentimg">
                        <h2>{{$system['title']}}</h2>
                        <p>{!!$system['abstract']!!}</p>
                        <a href="/introduce/{{$system['nav_id']}}"><span>了解详情</span></a>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</article>
<article>
    <div class="bg1">
        <h2 class="title">J-PACT考试介绍</h2>
        <span class="line red"></span>
    </div>
    @foreach($exams as $key=>$exam)
    <div class="proD clear">
        <div class="fl no1">
            <img src="/resources/style/mobile/images/t{{$key+1}}.png" alt=""/>
        </div>
        <div class="fr no2">
            <h2 class="proTitle">{{$exam['title']}}</h2>
            <p>{{$exam['abstract']}}</p>
            <a href="/introduce/{{$exam['nav_id']}}" class="detail">查看详情</a>
        </div>
    </div>
    @endforeach
    
</article>
<article class="onlineJoy">
    <div class="onlineBox">
        <h2 class="title">新加坡初级学院入学考试</h2>
        <span class="line"></span>
        <h3>通往新加坡优质教育的最佳途径</h3>
    </div>
    <div class="onlineS">
        <img src="/resources/style/mobile/images/onlinezx.png" alt=""/>
        <h3>现在联系考试顾问，即可获得专业的留学建议</h3>
        <a href="#" class="online_zx">在线咨询</a>
    </div>
</article>
<article class="newStatu">
    <h2 class="title">最新动态</h2>
    <span class="line red"></span>
    <div class="btnGrow">
        <span class="btnGrowOne on">教育资讯</span>
        <span class="btnGrowTwo">留学资讯</span>
    </div>
    <div class="conGrowOne clear">
        @foreach($educations as $education)
        <a href="/article/{{$education['id']}}">
            <!--<span class="list_img">
                <img src="/resources/style/mobile/images/list.png" alt=""/>
            </span>-->
            <span class="listCon">
                <h3 class="list_title">{{$education['title']}}</h3>
                <span class="list_mess">
                    <i class="time">{{date('Y年m月d日',$education['publish_time'])}}</i>
                    <i class="eyes">{{$education['hits']}}人浏览</i>
                </span>
                <p style="font-size: 14px;">{{$education['abstract']}}</p>
            </span>
        </a>
        @endforeach
        
        <a href="/article/education" class="more_zx">查看更多</a>
    </div>
    <div class="conGrowTwo clear">
        @foreach($abords as $abord)
        <a href="/article/{{$abord['id']}}">
            <!--<span class="list_img">
                <img src="/resources/style/mobile/images/list.png" alt=""/>
            </span>-->
            <span class="listCon">
                <h3 class="list_title">{{$abord['title']}}</h3>
                <span class="list_mess">
                    <i class="time">{{date('Y年m月d日',$abord['publish_time'])}}</i>
                    <i class="eyes">{{$abord['hits']}}人浏览</i>
                </span>
                <p style="font-size: 14px;">{{$abord['abstract']}}</p>
            </span>
        </a>
        @endforeach
        <a href="/article/abord" class="more_zx">查看更多</a>
    </div>
</article>
<article>
    <h2 class="title">名师团队</h2>
    <span class="line red"></span>
    <ul class="team">
        @foreach($teachers as $teacher)
        <li>
            <span class="team_img">
                <img src="{{$teacher['img_url']}}" alt=""/>
            </span>
            <span class="team_con">
                <h3 class="name"><i>{{$teacher['name']}}</i><i>{{$teacher['name_en']}}</i></h3>
                <p>{{$teacher['job']}}</p>
                <p>{{$teacher['desc']}}</p>
            </span>
        </li>
        @endforeach
        
    </ul>
</article>
<article>
    <i class="onlinebg">
        <img src="/resources/style/mobile/images/online.png" alt=""/>
        <div class="onCon">
            <h2 class="title">新加坡入学初级学院考试</h2>
            <span class="line"></span>
            <span>通往新加坡优质教育的最佳途径</span>

            <a id="btnonline">获得定制留学方案</a>

        </div>
    </i>
</article>
<article style="width:100%;padding:0">
    <div class="contact">
        <div class="contactT">
            <h2 class="title">联系我们</h2>
            <span class="line red"></span>
        </div>
        <div class="contactbg"></div>
    </div>
    <div class="conpany">
        <ul>
            @foreach ($contacts as $contact)
            <li>
                {{$contact['area']}}
            </li>
            @endforeach
            
        </ul>
        @foreach ($contacts as $contact)
        <div class="conMes">
            <p>{{$contact['name']}}</p>
            @if($contact['hotline'])<p>客服热线：{{$contact['hotline']}}</p>@endif
            @if($contact['tel'])<p>电话：{{$contact['tel']}}</p>@endif
            @if($contact['addr'])<p>地址：{{$contact['addr']}}</p>@endif
        </div>
        @endforeach
        
    </div>
</article>
@endsection

@section('footer')
@include("mobile.layout.index_footer")
@endsection

@section('script')
<script>
$(function(){
    // 页面初始化
    $(".conpany ul li:first").addClass("on");
    $(".conMes").first().show().siblings(".conMes").hide();
})
</script>
@endsection