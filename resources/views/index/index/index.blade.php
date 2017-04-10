@extends("index.layout.base")

@section('desc'){{$desc}}@endsection
@section('keywords'){{$keywords}}@endsection

@section('content')
<div class="bannerBox">
    <div class="bannerCon">
        <h1>新加坡初级学院入学考试</h1>
        <span class="line co1"></span>
        <i>通往新加坡优质教育的最佳途径</i>
        <a id="online_zx" class="" target="_blank" href="http://p.qiao.baidu.com/im/index?siteid=10499207&ucid=18675436">在线咨询</a>
    </div>
</div>
<article>
    <div class="headerTitle">
        <h2>教育体系介绍</h2>
        <span class="line col2"></span>
        <p>在新加坡教育制度中，初级学院就相当于中国国内的高中教育学院。现在在新加坡共有16所初级学院，初级学院提供的教育分为理科与文科，商科则在2000年被废除。</p>
        <div class="reduce">
            <ul class="clear">
                @foreach($systems as $system)
                <li>
                    <span>
                        <h3>{{$system['title']}}</h3>
                        <p>{{$system['abstract']}}</p>
                        <a href="/introduce/{{$system['nav_id']}}" target="_blank">了解详情</a>
                    </span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</article>
<article>
    <div class="pactReduce">
        <div class="title">
            <h2>J-PACT考试介绍</h2>
            <span class="line col2"></span>
        </div>
        @foreach($exams as $key=>$exam)
        <div class="pactConBox clear">
            <div class="w600 fl">
                <img src="/resources/style/index/images/p{{$key+1}}.png" alt="J-PACT考试介绍"/>
            </div>
            <div class="w600 fr">
                <div class="text">
                    <h3>{{$exam['title']}}</h3>
                    <p>{{$exam['abstract']}}</p>
                    <a id="xqbtn{{$key+1}}" target="_blank" href="/introduce/{{$exam['nav_id']}}"><i>查看详情</i><i>&rarr;</i></a>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</article>
<div class="banBox">
    <div class="banBg">
        <div class="banText">
            <h2>新加坡初级学院入学考试</h2>
            <span class="line co3"></span>
            <h5>通往新加坡优质教育的最佳途径</h5>
        </div>
        <div class="online_ban">
            <span>现在联系考试顾问，即可获得专业的留学建议</span>
            <a id="online_zx2" target="_blank" href="http://p.qiao.baidu.com/im/index?siteid=10499207&ucid=18675436">在线咨询</a>
        </div>
        <div class="newest">
            <div class="new_title">
                <h2>最新动态</h2>
                <span class="line col2"></span>
            </div>
            <div class="btn_grop clear">
                <span id="jyzx" class="fl jyzx on">
                    教育资讯
                </span>
                <span id="lxzx" class="fr lxzx">
                    留学资讯
                </span>
            </div>
            <div class="zxBox">
                <div class="jyzxBox">
                    <ul id="sliderBox" class="sliderBox clear">
                        @foreach($educations as $education)
@if($loop->index%4==0)
                        <li>
                            
                            <ul class="slider">
                            @endif
                                <li>
                                    <h4>{{$education['title']}}</h4>
                                    <p>{{$education['abstract']}}</p>
                                    <a target="_blank" href="/article/{{$education['id']}}">查看详情</a>
                                </li>
                                
                            @if($loop->index%4==3)    
                            </ul>
                            
                        </li>
@endif
                        @endforeach
                        
                    </ul>
                    <div class="controlSlider">
                        <div class="controBox clear">
                            <i></i><span class="on"></span><i></i><span></span><i></i><span></span><i></i><span></span><i></i>
                        </div>
                    </div>
                </div>
                <div class="lxzxBox">
                    <ul id="slider" class="sliderBox clear">
                        @foreach($abords as $abord)
                        <li>
                            @if($loop->index%4==0)
                            <ul class="slider">
                            @endif
                                <li>
                                    <h4>{{$abord['title']}}</h4>
                                    <p>{{$abord['abstract']}}</p>
                                    <a href="/article/{{$abord['id']}}">查看详情</a>
                                </li>
                                
                            @if($loop->index%4==0)    
                            </ul>
                            @endif
                        </li>
                        @endforeach
                        
                    </ul>
                    <div class="controlSlider">
                        <div class="controBox clear">
                            <i></i><span class="on"></span><i></i><span></span><i></i><span></span><i></i><span></span><i></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="teacherTop">
    <div class="teacherBg">
        <h2>名师团队</h2>
        <span class="line co3"></span>
    </div>
    <ul id="fanzhuan" class="teacherLine clear">
        @foreach($teachers as $teacher)
        <li>
            <span>
                <img style="width: 100%;height: 100%" src="{{$teacher['img_url']}}" alt=""/>
                <i>{{$teacher['name']}}</i>
            </span>
            <span class="showBox">
                <h2>{{$teacher['name']}} {{$teacher['name_en']}}</h2>
                <p>{{$teacher['job']}}</p>
                <p>{{$teacher['desc']}}</p>
            </span>
        </li>
        @endforeach
        
    </ul>
</div>
<div class="contact_ban">
    <h2>新加坡初级学院入学考试</h2>
    <span class="line co3"></span>
    <h5>通往新加坡优质教育的最佳途径</h5>
    <div class="phoneBox">


        <input id="lx_btn" type="button" url="http://p.qiao.baidu.com/im/index?siteid=10499207&ucid=18675436" value="获得定制留学方案"/>

    </div>
</div>
<article class="ours">
    <div class="new_title">
        <h2>联系我们</h2>
        <span class="line col2"></span>
    </div>
    <img src="/resources/style/index/images/map.png" alt=""/>
    <div class="addressBox">
        <ul>
            @foreach($contacts as $contact)
            <li>
                <h3>{{$contact['name']}}</h3>

                <h3>—— {{$contact['area']}}</h3>
                <dl>
                    @if($contact['hotline'])<dd>客服热线：{{$contact['hotline']}}</dd> @endif
                    @if($contact['tel'])<dd>电话：{{$contact['tel']}}</dd> @endif
                    @if($contact['addr'])<dd>地址：{{$contact['addr']}}</dd> @endif
                </dl>
            </li>
            @endforeach
        </ul>
    </div>
</article>
@endsection

@section('footer')
    @include('index.layout.index_footer')
@endsection

@section('script')
<script src="/resources/style/index/js/index.js"></script>
<script>
$(function(){
    $("#lx_btn").click(function(){
        var url = $(this).attr("url");
        window.open(url);
    });
})
</script>
@endsection