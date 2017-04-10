var wh;
var Top;
$(function(){
    var nav_btn = true;
    $(".btn")[0].addEventListener("touchend",function(e){
        if(nav_btn){
            $("#indexbox").css({"transform":"translate3d(280px,0,0)"});
        }else{
            $("#indexbox").css({"transform":"translate3d(0,0,0)","position":"absolute"});
        };
        e.stopPropagation();
    });
    $("#indexbox")[0].addEventListener("transitionend",function(){
        if(nav_btn){
            $("#zhezhao").css("display","block");
		$("#indexbox").css({"position":"fixed"});
            $(".nav_btn").addClass("on");
            nav_btn = false;
        }else{
            $("#zhezhao").css("display","none");
            $(".nav_btn").removeClass("on");
            nav_btn = true;
        };
    });
    // 隐藏nav
    $("#zhezhao").click(function(){
        $("#indexbox").css({"transform":"translate3d(0,0,0)"});
        $("#zhezhao").css("display","none");
        $(".nav_btn").removeClass("on");
        nav_btn = false;
    });
    var oli = $("nav ul li .menuBtn");
    var olil = oli.length;
    var btnbb = true;
    var btnbb2 = true;
    var or = $(".menuBtn").siblings(".down");
    for(var i=0;i<olil;i++){
        oli[i].addEventListener("touchend",function(){
            var This = $(this);
            var arro = $(this).siblings(".down");
            $("nav ul li").removeClass("on");
            $(this).parent().addClass("on").siblings().children(".one_menu").slideUp();
            or.html("&or;").css("color","#333");
            if(btnbb2){
                $(this).parent().children(".one_menu").slideDown("normal",function(){
                    arro.css("color","#fff").html("&and;")
                });
                btnbb2=false
            }else{
                $(this).parent().children(".one_menu").slideUp("normal",function(){
                    arro.css("color","#fff").html("&or;")
                });
                btnbb2=true
            }

        })
    };
    var spanB = $(".menu_title span");
    var spanBl = spanB.length;
    for(var i=0;i<spanBl;i++){
        spanB[i].addEventListener("touchend",function(){
            var This = $(this);
            if(btnbb){
                $(".two_menu").prev().removeClass("on");
                $(this).addClass("on");
                /*$(this).children("i.down").css("color","#d82b27").html("&and;")*/
                $(this).siblings(".two_menu").slideDown("normal",function(){
                    This.children("i.down").css("color","#d82b27").html("&and;");
                });
                btnbb =false;
            }else{
                $(this).removeClass("on");
                $(this).siblings(".two_menu").slideUp("normal",function(){
                    This.children("i.down").css("color","#333").html("&or;");
                });
                btnbb =true;
            }

        })
    };
    /*btnToggle*/
    $(".btnGrowOne")[0].addEventListener("touchend",function(){
        $(this).addClass("on").siblings().removeClass("on");
        $(".conGrowOne").css("display","block").next().css("display","none")
    });
    $(".btnGrowTwo")[0].addEventListener("touchend",function(){
        $(this).addClass("on").siblings().removeClass("on");
        $(".conGrowTwo").css("display","block").prev().css("display","none")
    });
    $(".conpany ul li").click(function(){
        $(this).addClass("on").siblings().removeClass("on");
        $(".conMes").hide().eq($(this).index()).show()
    });
    /*slider*/
    $(".imglist ul")[0].addEventListener("touchstart",function(e){
        var sX = e.changedTouches[0].pageX;
        var yx = parseInt($(".imglist ul").css("marginLeft"));
        var w = (parseInt($(".imglist ul li").css("width")))*2.5;
        $(".imglist ul")[0].addEventListener("touchmove",function(e){
            var nX = e.changedTouches[0].pageX;
            var scroll =yx+ (nX - sX);
            $(this).css("marginLeft",""+scroll+"px");
        });
        $(".imglist ul")[0].addEventListener("touchend",function(e){
            var nX = e.changedTouches[0].pageX;
            var scroll =yx+ (nX - sX);
            if(scroll<-w){
                scroll=-w;
            }else if(scroll>=0){
                scroll=0
            }
            $(this).css("marginLeft",""+scroll+"px");
            //console.log(yx)
            $(".imglist ul")[0].removeEventListener("touchstart",function(e){
                event.preventDefault();
            });
            $(".imglist ul")[0].removeEventListener("touchmove",function(e){
                event.preventDefault();
            });
        });
    });
	$("#closeBtn").click(function(){
	   $("#tanchuang").hide();
	   $("#zhezhaobg").hide();
	})
	
	$('body').bind('touchmove', function(){
           wh = $(this).scrollTop();
       console.log(wh);
	   Top = (wh+($(window).height())/4) + "px";
	   if(wh>568){
		   $("#asideIcon").show()
	   }else{
		   $("#asideIcon").hide()
	   };
    });
	$("#charWer").next().click(function(e){
		e=e||event;
		e.preventDefault();
		pageScroll()
	});
	
	$("#charWer").click(function(e){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
                e.stopPropagation();
	});
	$("#btnonline").click(function(e){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
                e.stopPropagation();
	});
	$(".bottom_serch_on").click(function(e){
		$("#tanchuang").show().css("top",Top);
		$("#zhezhaobg").show();
                e.stopPropagation();
	});
	
});
function pageScroll(){
    window.scrollBy(0,-100);
    scrolldelay = setTimeout('pageScroll()',10);
    var sTop=document.documentElement.scrollTop+document.body.scrollTop;
    if(sTop==0) clearTimeout(scrolldelay);
	$("#asideIcon").hide()
};
