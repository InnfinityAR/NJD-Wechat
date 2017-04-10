@extends("admin.layout.base")

@section('content')
<section class="panel">
    <div class="page-heading" style="margin-bottom: 50px;">
        <h3>客户列表</h3>
        <div style="padding-left: 0" class="col-lg-6">
            
            <a class="btn btn-primary deleteAll" >批量删除<i class="fa fa-trash-o"></i></a>
            <select onchange="window.location = this.value" class="form-control index_select" >
                <option @if ($status == 0) selected @endif value="/{{$admin_prefix}}/{{$controller}}/">全部</option>
                <option @if ($status == 1) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/1">已评估</option>
                <option @if ($status == 2) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/2">已申请</option>
                <option @if ($status == 3) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/3">有效客户</option>
                <option @if ($status == 4) selected @endif value="/{{$admin_prefix}}/{{$controller}}/status/4">无效客户</option>
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
                    <th>用户姓名</th>
                    <th>联系方式</th>
                    <th>房屋性质</th>
                    <th>房屋地址</th>
                    <th>住房面积</th>
                    <th>房屋估价</th>
                    <th>状态</th>
                    <th>备注信息</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td class="check-input"><input type="checkbox" id="{{$data->id}}"></td>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}@if($data->sex==1)先生 @else 女士@endif</td>
                    <td>{{$data->tel}}</td>
                    <td>@if($data->house_type==1) 住宅 @else 商用 @endif</td>
                    <th>{{$data->house_addr}}</th>
                    <td>{{$data->house_area}}/㎡</td>
                    <td>{{$data->price}}</td>
                    <td>{{getStatus($data->status)}}</td>
                    <td>{{$data->remark or "暂无备注"}}</td>
                    <td>
                        @if($data->status==1||$data->status==2)
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/changeStatus/3'>有效客户</a>
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/changeStatus/4'>无效客户</a>
                        @elseif($data->status==3)
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/changeStatus/4'>无效客户</a>
                        @elseif($data->status==4)
                        <a href='/{{$admin_prefix}}/{{$controller}}/{{$data->id}}/changeStatus/3'>有效客户</a>
                        @endif
                        <a href="javascript:;" data-id="{{$data->id}}" class="remark">@if($data->remark)修改备注 @else 添加备注@endif</a>
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
        // 添加备注
        $(".remark").click(function(){
            var data = {};
            data['id'] = $(this).attr("data-id");
            layer.prompt({
                "title":"请输入备注信息",
                "formType":2
            },function(pass,index){
                if(!pass){
                    layer.close(index);
                }
                // ajax传值
                
                data['remark'] = pass;
                data['_token'] = csrf_token;
                $.ajax({
                    type:"post",
                    url:"/"+admin_prefix+"/"+controller+"/remark",
                    data:data,
                    success:function(res){
                        if(res.status){
                            layer.msg("添加备注成功!",{icon:6});
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }else{
                            layer.msg("添加备注失败!",{icon:5});
                        }
                    }
                })
            });
        });
    })
</script>
@endsection