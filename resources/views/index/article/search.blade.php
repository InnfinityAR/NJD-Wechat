@extends("index.layout.base")

@section('title'){{$title}} - @endsection
@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div class="list_ban">
    <img src="/resources/style/index/images/list_ban.jpg" alt="J-pact"/>
</div>
<div class="list_con">
    <div class="list_left">
        <div class="header">
            <ul>
                <li>
                    <a href="/">首页</a>
                </li>
                <li>
                    <a href="/article">&nbsp>>@if($search)文章搜索 @else 文章列表 @endif</a>
                </li>
                @if($search)
                <li>
                    <a href="/article?search={{$search}}">&nbsp>>{{$search}}</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="list_bar">
            <h2><i class="serch_text">{{$search}}</i></h2>
            <ul>
                @foreach($articles as $article)
                <li>
                    <div class="list_img">
                        <a href="/article/{{$article['id']}}"><img src="{{$article['thumbnail'] or '/resources/style/index/images/list_img.png'}}" alt="{{$article['title']}}"/></a>
                    </div>
                    <div class="list_text">
                        <dl>
                            <dt><a href="/article/{{$article['id']}}">{!!$article['title']!!}</a></dt>
                            <dd>
                                <div class="timeshow">
                                    <span class="icon time"></span><i>{{date("Y年m月d日", $article['publish_time'])}}</i>
                                </div>
                                <div class="person">
                                    <span class="icon eye"></span><i>{{$article['hits']}}人浏览</i>
                                </div>
                            </dd>
                            <dd class="dot_area" style="width: 500px;height: 40px;">{!!$article['abstract']!!}</dd>
                        </dl>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="pagebox">
            <ul class="pageList">
                {{$articles->links()}}
            </ul>
        </div>
    </div>
    <div class="list_right">
        @include('index.layout.search')
        @include('index.layout.side_nav')
        @include('index.layout.contact')
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript" src="/resources/style/index/js/list.js"></script>
<script>
    $(function(){
        // 页面初始化
        $(".con_us_art").first().show();
        
        // dot
        $(".dot_area").each(function(){
            $(this).dotdotdot({
                wrap: 'letter'
            });
        });
    })
</script>
@endsection

@section('footer')
@include('index.layout.footer')
@endsection