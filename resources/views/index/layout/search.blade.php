<div class="serchBox">
    <aside class="serch">
        <form action="">
            <input  type="text" class="search-input" value="{{$search or ""}}" placeholder="您想找……"/>
            <input class="serch_btn" readonly="readonly" type="sumbit"/>
        </form>
    </aside>
    <aside class="hotSin">
        <h2>热门标签</h2>
        <ul>
            @foreach($hot_tips as  $hot_tip)
            <li>
                <a href="/article?search={{$hot_tip['name']}}" target="_blank">{{$hot_tip['name']}}</a>
            </li>
            @endforeach
        </ul>
    </aside>
</div>