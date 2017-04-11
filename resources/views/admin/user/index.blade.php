@extends("admin.layout.base")

@section('content')
<section class="panel">
    <div class="page-heading" style="margin-bottom: 50px;">
        <h3>后台账号列表</h3>
        <div style="padding-left: 0" class="col-lg-6">
            <a class="btn btn-success" href="/{{$admin_prefix}}/{{$controller}}/create">新 增<i class="fa fa-plus"></i></a>&nbsp;
            <a class="btn btn-primary deleteAll" >批量删除<i class="fa fa-trash-o"></i></a>
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
                    <th>用户名</th>
                    <th>联系方式</th>
                    <th>用户昵称</th>
                    <th>用户角色</th>
                    <th>登录次数</th>
                    <th>最近一次登录时间</th>
                    <th>账号状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td class="check-input"><input type="checkbox" id="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->tel}}</td>
                    <td>{{$data->nickname}}</td>
                    <td>{{getRoleByUserId($data->id)}}</td>
                    <td>{{$data->logins}}</td>
                    <td>@if ($data->last_login=='')暂未登录 @else {{date("Y-m-d H:i:s",$data->last_login)}} @endif</td>
                    <td>@if ($data->is_active==1) 正常 @else 冻结中 @endif</td>
                    <td>
                        <a href='/{{$admin_prefix}}/{{$controller}}/active/{{$data->id}}'>@if ($data->is_active==1) 冻结账号@else 解除冻结@endif</a>
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/edit'>修改</a>
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