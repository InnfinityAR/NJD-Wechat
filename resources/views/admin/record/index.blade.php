@extends("admin.layout.base")

@section('content')
<section class="panel">
    <div class="page-heading" style="margin-bottom: 50px;">
        <h3>短信记录列表</h3>
        <div style="padding-left: 0" class="col-lg-6">
            <a class="btn btn-primary deleteAll" >批量删除<i class="fa fa-trash-o"></i></a>
            <select onchange="window.location = this.value" class="form-control index_select" >
                <option @if ($status == 0) selected @endif value="/{{$admin_prefix}}/{{$controller}}/">全部</option>
                <option @if ($status == 1) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/1">未发送</option>
                <option @if ($status == 2) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/2">已发送</option>
            </select>
        </div>
        <div style="padding-right:0" class="col-lg-6">
            <label class="searchLabel">Search: <input type="text" aria-controls="editable-sample" value="{{$search}}" placeholder="输入发送手机号查询" class="form-control medium search" id="search-input"></label>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th class="check-input "><input class="checkAll" type="checkbox"></th>
                    <th class="id">Id</th>
                    <th>发送手机号</th>
                    <th>客户姓名</th>
                    <th>客户手机号</th>
                    <th>客户房屋所在位置</th>
                    <th>房屋估价</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>发送时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td class="check-input"><input type="checkbox" id="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->send_tel}}</td>
                    <td>{{$data->client_name}}</td>
                    <td>{{$data->client_tel}}</td>
                    <th>{{$data->house_addr}}</th>
                    <td>{{$data->price}}</td>
                    <td>@if($data->status==1)未发送 @else 已发送 @endif</td>
                    <td>{{date("Y-m-d H:i:s", $data->create_time)}}</td>
                    <td>@if($data->send_time){{date("Y-m-d H:i:s", $data->send_time)}} @else 未发送 @endif</td>
                    <td>
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
