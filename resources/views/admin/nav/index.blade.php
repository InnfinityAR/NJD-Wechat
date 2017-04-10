@extends("admin.layout.base")

@section('content')
<section class="panel">
    <div class="page-heading" style="margin-bottom: 50px;">
        <h3>导航列表</h3>
        <div style="padding-left: 0" class="col-lg-6">
            <a class="btn btn-success" href="/{{$admin_prefix}}/{{$controller}}/create">新 增<i class="fa fa-plus"></i></a>&nbsp;
            <a class="btn btn-primary deleteAll" >批量删除<i class="fa fa-trash-o"></i></a>
            <select onchange="window.location = this.value" class="form-control index_select" >
                <option @if ($level == 0) selected @endif value="/{{$admin_prefix}}/{{$controller}}/">全部</option>
                <option @if ($level == 1) selected @endif value="/{{$admin_prefix}}/{{$controller}}/level/1">顶级菜单</option>
            </select>
        </div>
        <div style="padding-right:0" class="col-lg-6">
            <label class="searchLabel">Search: <input type="text" aria-controls="editable-sample" value="{{$search}}" class="form-control medium search" id="search-input"></label>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th class="check-input "><input class="checkAll" type="checkbox"></th>
                    <th class="id">Id</th>
                    <th>导航名称</th>
                    <th>上级导航</th>
                    <th>url</th>
                    <th>导航显示位置</th>
                    <th>显示/隐藏</th>
                    <th>是否手机端显示</th>
                    <th>导航栏等级</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td class="check-input"><input type="checkbox" id="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>@if($data->pid==0)顶级菜单 @else {{getField($data->pid,"nav")}} @endif</td>
                    <td>@if($data->url=='') 无 @else {{$data->url}} @endif</td>
                    <td>@if($data->position==1)顶部 @else 底部 @endif</td>
                    <td>@if($data->is_show==1)显示 @else 隐藏 @endif</td>
                    <td>@if($data->mobile_show==1)显示 @else 隐藏 @endif</td>
                    <td>{{$data->level}}</td>
                    <td>{{$data->sort}}</td>
                    <td>
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/edit'>编辑</a>
                        <a href='javascript:;' class="del" id="{{$data->id}}">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$datas->links()}}
    </div>
</section>
@endsection

@section("script")
<script>
    $(function(){
        
    })
</script>
@endsection