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
                    <a href="{{route('/')}}">首页</a>&nbsp>>
                </li>
                <li>
                    <a href="{{route('link')}}">友情链接</a>
                </li>
            </ul>
        </div>
        <div class="list_bar">
            <h2 class="partner">合作伙伴</h2>
        </div>
        <ul class="partnerCon">
            @foreach($cooperations as $cooperation)
            <li>
                <a href="{{$cooperation['url']}}" target="_blank">{{$cooperation['name']}}</a>
            </li>
            @endforeach
        </ul>

    </div>
    <div class="list_right">
        @include('index.layout.search')
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