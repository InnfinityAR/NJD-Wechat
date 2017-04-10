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
                    <a href="/">首页</a>&nbsp>>
                </li>
                
                <li>
                    <a href="/article/{{$article['id']}}">{{$article['title']}}</a>
                </li>
            </ul>
        </div>
        <div class="list_bar">
            <h1>{{$article['title']}}</h1>
        </div>
        <div class="content clear">
            <div class="iconList" style="margin-right: 240px;">
                <div class="timeshow">
                    <span class="icon time"></span><i>{{date("Y年m月d日",$article['publish_time'])}}</i>
                </div>
                <div class="person">
                    <span class="icon eye"></span><i>{{$article['hits']}}人浏览</i>
                </div>
            </div>
            <div class="bshare-custom icon-medium" >
                <a title="分享到QQ空间" class="bshare-qzone"></a>
                <a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
                <a title="分享到人人网" class="bshare-renren"></a>
                <a title="分享到腾讯微博" class="bshare-qqmb"></a>
                <a title="分享到网易微博" class="bshare-neteasemb"></a>
                <a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
            </div>
        </div>
        <div class="article">
            {!!$article['content']!!}
        </div>
        <div class="page_art">
            <dl>
                <dt>上一篇：</dt><dd>@if($prev_article)<a href="{{route("articleDetail", ["id"=>$prev_article['id']])}}">{{$prev_article['title']}}</a> @else 暂无文章 @endif</dd>
            </dl>
            <dl>
                <dt>下一篇：</dt><dd>@if($next_article)<a href="{{route("articleDetail", ["id"=>$next_article['id']])}}">{{$next_article['title']}}</a> @else 暂无文章 @endif</dd>
            </dl>
        </div>
        <a class="art_more">了解更多关于新加坡初级学院入学考试相关情况，请点击：</a>
        <ul class="list_bar_botom">
            @foreach($middle_navs as $middle_nav)
            <li>
                <i></i>
                <a href="/introduce/{{$middle_nav['id']}}">
                    {{$middle_nav['name']}}
                </a>
            </li>
            @endforeach
            
        </ul>
        <div class="aasicBox clear">
            <div class="codeImg fl">
                <h2>AASIC</h2>
                <img src="/resources/style/index/images/ercode.png" alt=""/>
                <a href="#" class="online">留学咨询</a>
            </div>
            <div class="aasicCon fl">
                <h2>新加坡初级学院入学考试留学网免责声明</h2>
                <p>（一）大和留学网有大量转载的留学文章，仅代表作者个人观点，与100留学网无关。其原创性以及文中陈述文字和内容未经本站证实，对本文以及其中全部或者部分内容、文字的真实性、完整性、及时性本站不作任何保证或承诺，请读者仅作参考，并请自行核实相关内容</p>
                <p>（二）免费转载出于非商业性学习目的，出国留学文章版权归原作者所有。如有任何文章内容涉及版权问题，请在30日内与100留学网联系。</p>
            </div>
        </div>
        <div class="formBox">
            <h2>我要提问 - 让专家主动与你联系！</h2>
            <span>为了节省您的查找时间，请将您要找的信息填写在表格里，留下您的联系方式并提交，我们的顾问会主动与您联系。</span>
            <form class="form">
                <input class="normal" name="name" type="text" placeholder="姓名"/>
                <input class="normal" name="age" type="text" placeholder="年龄"/>
                <input type="text" name="education" class="normal" placeholder="当前学历"/>
                <select id="sheng" name="province" class="small province" style="outline:none">
                    <option value="0">所在省份</option>
                    @foreach($provinces as $province)
                    <option value="{{$province['id']}}">{{$province['name']}}</option>
                    @endforeach
                </select>
                <select id="shi" name="city" class="small city" style="outline:none">
                    <option value="0">所在市级</option>
                </select>
                <input type="text" name="tel" class="normal" placeholder="联系电话"/>
                <input type="text" name="code" class="small" placeholder="请输入验证码"/>
                <a class="small getCode" >获取验证码</a>
                <input type="text" name="nation" class="normal" placeholder="请选择意向国家"/>
                <input type="text" name="qq" class="normal" placeholder="QQ号码"/>
                <textarea name="content" placeholder="提问内容"></textarea>
                <input type="" readonly="readonly" class="submitBtn" value="确认提交"/>
            </form>
        </div>
    </div>
    <div class="list_right">
        @include('index.layout.search')
        @include('index.layout.side_nav')
        @include('index.layout.contact')
        @if($likes)
        <aside class="new_box">
            <h2 class="on">猜您喜欢</h2>
            @foreach($likes as $like)
            <h2 style="white-space: nowrap;width: 90%;text-overflow:ellipsis;overflow: hidden"><a href="{{route('articleDetail', ["id"=>$like['id']])}}">{{$like['title']}}</a></h2>
            @endforeach
        </aside>
        @endif
    </div>
</div>
@endsection

@section('footer')
@include('index.layout.footer')
@endsection

@section('script')
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
<script type="text/javascript" src="/resources/style/index/js/content.js"></script>
<script>
$(function () {
    // 页面初始化
    $(".con_us_art").first().show();

    // 地区联动
    $(".province").change(function () {
        var province_id = $(this).val();
        if (province_id != 0) {
            $.ajax({
                type: "get",
                url: "/getCity?province_id=" + province_id,
                success: function (res) {
                    if (res) {
                        $(".city").html("");
                        var html = "";
                        $.each(res, function (k, v) {
                            html += "<option value='" + v.id + "'>" + v.name + "</option>"
                        });
                        $(".city").html(html);
                    }
                }
            });
        } else {      // 重置
            $(".city").html("<option value='0'>所在市级</option>");
        }
    });

    // 获取验证码
    $(".form").find(".getCode").click(function () {
        var tel = $(".form").find("input[name='tel']");
        var telReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

        if (!telReg.test(tel)) {    // 手机号验证失败
            layer.msg("请输入合法的手机号");
        } else {  // 发送验证码
            setTime();
            $.ajax({
                type: "get",
                url: "/sendCode?tel=" + tel,
                success: function (res) {
                    if (res) {
                        layer.msg("验证码发送成功");
                    } else {
                        layer.msg("网络错误");
                    }
                }
            });
        }
    });
    
    // 提交表单
    $(".form .submitBtn").click(function(){
        var data = {};
        var telReg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        var nameReg = /^[\u4E00-\u9FA5]{2,4}$/;
        data["name"] = $(".form").find("input[name='name']").val();
        data["tel"] = $(".form").find("input[name='tel']").val();
        data["age"] = $(".form").find("input[name='age']").val();
        data["qq"] = $(".form").find("input[name='qq']").val();
        data["education"] = $(".form").find("input[name='education']").val();
        data["nation"] = $(".form").find("input[name='nation']").val();
        data["content"] = $(".form").find("input[name='content']").val();
        data["province"] = $(".form").find(".province").val();
        data["city"] = $(".form").find(".city").val();
        var code = $(".form").find("input[name='code']").val();
        
        // 验证数据
        if(!nameReg.test(data['name'])){
            layer.msg("请输入合法中文姓名");
        }else if(!telReg.test(data['tel'])){
            layer.msg("请输入合法的手机号");
        }else if(!data["age"]){
            layer.msg("请输入年龄");
        }else if(!data["qq"]){
            layer.msg("请输入QQ号码");
        }else if(!data["education"]){
            layer.msg("请输入当前学历");
        }else if(data["province"]==0||data["city"]==0){
            layer.msg("请选择省份和城市");
        }else if(data["nation"]){
            layer.msg("请输入意向国家");
        }else if(data["content"]){
            layer.msg("请输入提问内容");
        }else if(!code){
            layer.msg("请输入验证码");
        }else{
            $.ajax({
                type:"get",
                url:"/checkCode?code="+code,
                success:function(res){
                    if(res){
                        $.ajax({
                            type:"post",
                            data:data,
                            url:"/saveUser",
                            success:function(res){
                                if(res){
                                    layer.msg("信息提交成功");
                                    $(".form").find("input").val("");
                                    $(".form").find(".province").html("<option value='0'>所在省份</option>");
                                    $(".form").find(".city").html("<option value='0'>所在市级</option>");
                                }else{
                                    layer.msg("信息提交失败");
                                }
                            }
                        })
                    }else{
                        layer.msg("网络错误");
                    }
                }
            })
        }
    });
    

})
</script>
@endsection