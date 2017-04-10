@extends("admin.layout.base")

@section('content')
<div class="alert alert-success fade in hide">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong class="alert-msg"></strong> <span class="alert-tip">页面即将跳转~~</span>
</div>
<section class="panel">
    <header class="panel-heading">
        <h4>修改联系信息</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">所在地区</label>
                <div class="col-sm-4">
                    <input type="text" name="area" value="{{$field->area}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">客服热线</label>
                <div class="col-sm-4">
                    <input type="text" name="hotline" value="{{$field->hotline}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-4">
                    <input type="text" name="tel" value="{{$field->tel}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">地址</label>
                <div class="col-sm-4">
                    <input type="text" name="addr" value="{{$field->addr}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序(升序排列)</label>
                <div class="col-sm-4">
                    <input type="text" name="sort" value="{{$field->sort}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否显示</label>
                <div class="col-sm-4 radio-group">
                    <input type="radio" name="is_show" value="1" @if($field->is_show ==1)checked @endif class=" radio-inline">是
                    <input type="radio" name="is_show" value="0" @if($field->is_show ==1)checked @endif class="radio-inline">否
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-4 ">
                    <a href="javascript:;" id="{{$field->id}}" class="editSubmit btn btn-primary">提 交</a>&nbsp;
                    <a href="/{{$admin_prefix}}/{{$controller}}" class="btn btn-default">返 回</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection