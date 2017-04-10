<footer class="list_footer">
    <div class="footTop">
        <div class="foot_title">
            <span>现在联系考试顾问，即可获得专业的留学建议</span>
            <a id="footer_btn" class="footer_btn">免费获得</a>
        </div>
        <div class="foot_con_b clear">
            <div class="logo">
                <a href="{{route('/')}}"><img src="/resources/style/index/images/bottom_logo.png" alt="logo"/></a>
            </div>
            <div class="foot_nav_box">
                <ul class="foot_nav clear">
                    @foreach($bottom_navs as $bottom_nav)
                    <li>
                        <a @if($bottom_nav['url'])href="{{$bottom_nav['url']}}" @else href="/introduce/{{$bottom_nav['id']}}" @endif>{{$bottom_nav['name']}}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="foot_mess">
                    <p>友情提示：{{$web['tips']}}</p>
                    <p>法律顾问：{{$web['layer_consult']}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_botom_de">
        <p>
            {{$web['lience']}} {{$web['record_number']}}  {{$web['copyright']}}</p>
    </div>
</footer>