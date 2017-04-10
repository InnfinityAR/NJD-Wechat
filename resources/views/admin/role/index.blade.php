@extends("admin.layout.base")

@section('content')
<section class="panel">
    <div class="page-heading" style="margin-bottom: 50px;">
        <h3>角色列表</h3>
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
                    <th>角色名称</th>
                    <th>角色描述</th>
                    <th>拥有权限</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td class="check-input"><input type="checkbox" id="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->remark}}</td>
                    <td>{{getNodeByRoleId($data->id)}}</td>
                    <td>
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/edit'>编辑</a>
                        @if($data->name!='编辑')<a href='javascript:;' class="del" id="{{$data->id}}">删除</a> @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$datas->links()}}
    </div>
</section>
@endsection