<nav>
    <div class="nav_logo"></div>
    <ul>
        @foreach($navs as $top_nav)
        <li>
            <a class="menuBtn">{{$top_nav['name']}}</a>
            @if(isset($top_nav['_child']))
            <i class="down">&or;</i>
            <dl class="none one_menu">
                @foreach($top_nav["_child"] as $middle_nav)
                @if(!isset($middle_nav['_child']))
                <dd class="rat">
                    <a href="{{getUrl($middle_nav['id'])}}">{{$middle_nav['name']}}</a>
                </dd>
                @else
                <dd class="menu_title rat">
                    <span>{{$middle_nav['name']}}<i class="down">&or;</i></span>
                    <dl class="none two_menu">
                        @foreach($middle_nav['_child'] as $bottom_nav)
                        <dd>
                            <a href="{{getUrl($bottom_nav['id'])}}">{{$bottom_nav['name']}}</a>
                        </dd>
                        @endforeach
                    </dl>
                </dd>
                @endif
                @endforeach
            </dl>
            @endif
        </li>
        @endforeach
    </ul>
</nav>