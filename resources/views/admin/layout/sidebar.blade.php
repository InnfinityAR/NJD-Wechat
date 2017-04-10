<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="/{{$admin_prefix}}"><img src="{{asset('resources/style/admin/images/logo.png')}}" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="/{{$admin_prefix}}"><img src="{{asset('resources/style/admin/images/logo_icon.png')}}" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            @foreach ($menus as $menu)
            @if (isset($menu['sub']))
            <li class="menu-list"><a href="/{{$admin_prefix}}/{{$menu['url']}}"><i class="fa {{$menu["icon"]}}"></i> <span>{{$menu['name']}}</span></a>
                
                <ul class="sub-menu-list">
                    @foreach ($menu['sub'] as $sub_menu)
                    <li><a href="/{{$admin_prefix}}/{{$sub_menu["url"]}}"> {{$sub_menu['name']}}</a></li>
                    @endforeach
                </ul>
            </li>
            @else 
            <li><a href="/{{$admin_prefix}}/{{$menu['url']}}"><i class="fa {{$menu['icon']}}"></i> <span>{{$menu["name"]}}</span></a></li>
            @endif
            @endforeach

            <li><a href="javascript:;" class="logout"><i class="fa fa-sign-out"></i> <span>退出登录</span></a></li>

        </ul>
        <!--sidebar nav end-->

    </div>
</div>
<!-- left side end-->