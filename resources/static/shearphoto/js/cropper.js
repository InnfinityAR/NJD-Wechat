/**
  截图主要功能
  依赖layer
**/    
layui.define(['layer'], function(exports){
  $ = layui.jquery, layer = layui.layer;
  
  //查看是否已有图片
  $(".site-demo-upload").each(function (e,index) {
	  if($(this).find('.upload-show-input').val()){
		  $(this).find(".upload-check-img,.upload-delete-img").show();
	  } else {
		  $(this).find(".upload-check-img,.upload-delete-img").hide();
	  }
  })
  
  //上传图片
  function layUpload() {
	  layer.open({
        type: 2 
        ,title: '选择图片'
        ,area: ['70%', '70%']
        ,shade: 0.5
        ,maxmin: true
        ,content: '/resources/views/layout/cropper.html'
        ,btn: ['关闭']
        ,yes: function(){
          layer.closeAll();
        }
      });
  }
  
  //点击上传
  $(document).on('click', ".site-upfile-layer", function(){
      var that = this;
	  $(".upload-show-img").removeClass("upload-show-img-now");	
	  $(".upload-show-input").removeClass("upload-show-input-now");	
	  $(that).parents('.site-demo-upload').find('.upload-show-img').addClass("upload-show-img-now");
	  $(that).parents('.site-demo-upload').find('.upload-show-input').addClass("upload-show-input-now");
	  
	  var picPath=$(that).parents('.site-demo-upload').find('.upload-show-input-now').val();
	  if(picPath){
		layer.msg('请注意！<br>该操作会直接删除原图片，不可恢复！', {
		  time: 20000, //20s后自动关闭
		  btn: ['继续上传', '不上传'],
		  yes: function(){
				 layUpload();
				}
		  });  
	  } else {
		 layUpload(); 
	  }
	  
	  
  });
  
  //点击删除
  $(document).on("click", ".upload-delete-img" ,function () {
	  var _this=$(this);
	var delPath= $(this).parents('.site-demo-upload').find(".upload-show-input").val();
        var that = $(this)
	if(delPath){
		layer.msg('请注意！<br>该操作会直接删除原图片，不可恢复！', {
		  time: 20000, //20s后自动关闭
		  btn: ['还是要删', '不删了'],
		  yes: function(){
				  $.post(deleteImgUrl,{'url':delPath},function(data){
					  layer.closeAll();
					  layer.msg("该图片已删除！");
					  _this.parents('.site-demo-upload').find(".upload-check-img,.upload-delete-img").hide();
					  _this.parents('.site-demo-upload').find(".upload-show-img").attr('src',defaultImg);
					  _this.parents('.site-demo-upload').find(".upload-show-input").val('');
					});
                                    if($(".site-demo-upload").length>1){
                                        that.parents(".site-demo-upload").remove();
                                    }
				}
		  });
	}
        
  
  })
  
  //点击查看图片
  $(document).on("click", ".upload-check-img", function () {
	  var showPath= $(this).parents('.site-demo-upload').find(".upload-show-img").attr('src');
	  var photopath={
		  "title": "", //相册标题
		  "id": 123, //相册id
		  "start": 0, //初始显示的图片序号，默认0
		  "data": [   //相册包含的图片，数组格式
			{
			  "alt": "",
			  "pid": 666, //图片id
			  "src": showPath, //原图地址
			  "thumb": showPath //缩略图地址
			}
		  ]
		}
	  layer.photos({
		photos: photopath //格式见API文档手册页
		,anim: 1 //0-6的选择，指定弹出图片动画类型，默认随机
	  });
  })
  
  exports('cropper', {}); //模块输出
});