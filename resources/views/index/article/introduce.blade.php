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
                    <a href="{{route("introduce", ['nav_id'=>$this_nav['id']])}}">{{$this_nav['name']}}</a>
                </li>
                
            </ul>
        </div>
        <div class="list_bar">
            <h2>{{$introduce['title']}}</h2>
            {!!htmlspecialchars_decode($introduce['content'])!!}    
        </div>
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
    var togg = getclass("toggle")[0].children;
    var odl = getclass("toggle")[0].getElementsByTagName("dl");
    var odd = getclass("toggle")[0].getElementsByTagName("dd");
    var odlBtn = true;
    for (var i = 1; i < togg.length; i++) {
        togg[i].onclick = function () {
            for (var j = 1; j < togg.length; j++) {
                removeClass(togg[j].children[0].children[1], "arrowU");
                removeClass(togg[j], "on");
            }
            for (var k = 0; k < odl.length; k++) {
                odl[k].style.display = "none"
            }
            if (odlBtn) {
                this.children[1].style.display = "block";
                addClass(this.children[0].children[1], "arrowU");
                addClass(this, "on");
                odlBtn = false;
            } else {
                this.children[1].style.display = "none";
                odlBtn = true;
            }
        };
    }
    ;
    for (var i = 0; i < odd.length; i++) {
        odd[i].onmouseover = function () {
            removeClass(this);
            for (var k = 0; k < odd.length; k++) {
                removeClass(odd[k], "on");
            }
            addClass(this, "on");
        }
    }
    
    $(function(){
        // 页面初始化
        $(".con_us_art").first().show();
    })
</script>
@endsection