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
                    <a href="{{route("/")}}">首页</a>&nbsp>>
                </li>
                <li>
                    <a href="{{route("map")}}">网站地图</a>
                </li>

            </ul>
        </div>
        <div class="list_bar">
            <h2>网站地图</h2>
        </div>
        @foreach($top_navs as $top_nav)
        <dl class="web_map">
            <dt>
                {{$top_nav['name']}}
            </dt>
            @foreach($top_nav["sub_navs"] as $sub_nav)
            <dd>
                <a href="{{getUrl($sub_nav['id'])}}">{{$sub_nav['name']}}</a>
            </dd>
            @endforeach
        </dl>
        @endforeach

    </div>
    <div class="list_right">
        @include('index.layout.search')
        @include('index.layout.side_nav')
        @include('index.layout.contact')
    </div>
</div>
@endsection

@section('footer')
@include('index.layout.footer')
@endsection

@section('script')
<script type="text/javascript" src="/resources/style/index/js/list.js"></script>
<script>
    $(function(){
        // 页面初始化
        $(".con_us_art").first().show();
    })
</script>
@endsection
