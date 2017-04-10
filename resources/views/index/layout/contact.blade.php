<aside class="con_us">
    <h2>联系方式</h2>
    @foreach ($contacts as $contact)
    <div class="con_us_art">
        <div class="con">
            <p>{{$contact['name']}}</p>
            <p>——{{$contact['area']}}</p>
        </div>
        <dl style="min-height: 115px;">
            @if($contact['hotline'])<dd>客服热线：{{$contact['hotline']}}</dd> @endif
            @if($contact['tel'])<dd>电话：{{$contact['tel']}}</dd> @endif
            @if($contact['addr'])<dd>地址：{{$contact['addr']}}</dd> @endif
        </dl>
        <a target="_blank" href="http://p.qiao.baidu.com/im/index?siteid=10499207&ucid=18675436" class="online_btn">在线咨询</a>
    </div>
    @endforeach
    <div id="con_us_ctrl" class="con_us_ctrl">
        <span class="line"></span><i class="on curl"></i><span class="line"></span><i class="curl"></i><span class="line"></span><i class="curl"></i><span class="line"></span>
    </div>
</aside>