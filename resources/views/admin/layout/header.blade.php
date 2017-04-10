<!-- header section start-->
<div class="header-section">
    <!--toggle button start-->
    <a class="toggle-btn"><i class="fa fa-bars"></i></a>
    <!--toggle button end-->
    <!--notification menu start -->
    <div class="menu-right">
        <ul class="notification-menu">
            <li>
                <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('resources/style/admin/images/photos/user-avatar.png')}}" alt="" />
                    {{session()->get("user.name")}}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="/{{$admin_prefix}}/changePwd"><i class="fa fa-cog"></i>  修改密码</a></li>
                    <li><a href="javascript:;" class="logout"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!--notification menu end -->

</div>
<!-- header section end-->