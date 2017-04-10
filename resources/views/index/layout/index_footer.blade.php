<footer>
    <div class="bottomLogo">
        <a href="#"><img src="/resources/style/index/images/bottom_logo.png" alt="logo"/></a>
    </div>
    <nav class="bottomNav">
        <ul>
            @foreach($bottom_navs as $bottom_nav)
            <li>
                <a @if($bottom_nav['url'])href="{{$bottom_nav['url']}}" @else href="/introduce/{{$bottom_nav['id']}}" @endif>{{$bottom_nav['name']}}</a>
            </li>
            @endforeach
        </ul>
    </nav>
    <div class="botMess">
        <p>
            友情提示：{{$web['tips']}}
        </p>

        <p>
            法律顾问：{{$web['layer_consult']}}
        </p>

        <p>
            {{$web['lience']}} {{$web['record_nunmber']}}  {{$web['copyright']}}
        </p>
    </div>
</footer>