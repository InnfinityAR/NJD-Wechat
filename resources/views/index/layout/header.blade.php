<header>
    <div class="navBox">
        <span class="top"></span>
        <nav class="clear">
            <ul id="nav" class="clear">
                @foreach($navs as $top_nav)
                @if($loop->index<3)
                <li >
                     <a @if($top_nav['url'])href="{{$top_nav['url']}}" @endif>{{$top_nav['name']}}</a>
                     @if(isset($top_nav['_child']))
                     <dl class="none one_menu">
                        @foreach ($top_nav['_child'] as $middle_nav)
                        <dd>
                            <a href="{{getUrl($middle_nav['id'])}}">{{$middle_nav['name']}}</a>
                            @if(isset($middle_nav['_child']))
                            <dl class="none two_menu">
                                @foreach($middle_nav['_child'] as $bottom_nav)
                                <dd>
                                    <a href="{{getUrl($bottom_nav['id'])}}">{{$bottom_nav['name']}}</a>
                                </dd>
                                @endforeach

                            </dl>
                            @endif
                        </dd>
                        @endforeach
                    </dl>
                    @endif
                </li>
                @endif
                @endforeach

                <li class="logo"><a href="{{route('/')}}"><img src="{{$web['logo_url']}}" alt="logo"/></a></li>

                @foreach($navs as $top_nav)
                @if($loop->index>2)
                <li >
                     <a @if($top_nav['url'])href="{{$top_nav['url']}}" @endif>{{$top_nav['name']}}</a>
                     @if(isset($top_nav['_child']))
                     <dl class="none one_menu">
                        @foreach ($top_nav['_child'] as $middle_nav)
                        <dd>
                            <a href="{{getUrl($middle_nav['id'])}}">{{$middle_nav['name']}}</a>
                            @if(isset($middle_nav['_child']))
                            <dl class="none two_menu">
                                @foreach($middle_nav['_child'] as $bottom_nav)
                                <dd>
                                    <a href="{{getUrl($bottom_nav['id'])}}">{{$bottom_nav['name']}}</a>
                                </dd>
                                @endforeach
                            </dl>
                            @endif
                        </dd>
                        @endforeach
                    </dl>
                    @endif
                </li>
                @endif
                @endforeach
            </ul>
        </nav>
    </div>
</header>