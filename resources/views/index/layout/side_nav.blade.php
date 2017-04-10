<aside class="new_box toggle">
    @foreach($right_navs as $top_nav)
        <h2>{{$top_nav['name']}}</h2>
        @if(isset($top_nav['_child']))
            @foreach($top_nav['_child'] as $middle_nav)
            <h2>
                <a href="{{getUrl($middle_nav['id'])}}"><span style="display: inline-block;min-width: 210px" >{{$middle_nav['name']}}</span><span class="icon {{hasChildNav($middle_nav['id'])?'arrowD':''}}"></span></a>
                @if(isset($middle_nav['_child']))
                <dl>
                    @foreach($middle_nav['_child'] as $bottom_nav)
                    <dd><a href="{{getUrl($bottom_nav['id'])}}">{{$bottom_nav['name']}}</a></dd>
                    @endforeach
                </dl>
                @endif
            </h2>
            @endforeach
        @endif
    @endforeach
</aside>