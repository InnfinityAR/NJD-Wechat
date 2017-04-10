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
        <h4>修改文章分类</h4>
    </header>

    <div class="panel-body">
        <form class="form-horizontal adminex-form" id="form" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">关键词名称</label>
                <div class="col-sm-4">
                    <input type="text" name="name" value="{{$field->name}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">搜索次数</label>
                <div class="col-sm-4">
                    <input type="text" name="search_num" value="{{$field->search_num}}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">是否显示</label>
                <div class="col-sm-4">
                    <input type="radio" name="is_show" value="1" @if($field->is_show==1)checked @endif  >显示
                    <input type="radio" name="is_show" value="0" @if($field->is_show==0)checked @endif>不显示
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