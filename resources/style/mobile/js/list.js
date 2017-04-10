$(function(){
    var nav_btn = true;
    $(".btn")[0].addEventListener("touchend",function(){
        if(nav_btn){
            $("#indexbox").css({"transform":"translate3d(280px,0,0)"});
        }else{
            $("#indexbox").css({"transform":"translate3d(0,0,0)"});
        };
    });
    $("#indexbox")[0].addEventListener("transitionend",function(){
        if(nav_btn){
            $("#zhezhao").css("display","block");
            $(".nav_btn").addClass("on");
            nav_btn = false;
        }else{
            $("#zhezhao").css("display","none");
            $(".nav_btn").removeClass("on");
            nav_btn = true;
        };
    });
    var oli = $("nav ul li .menuBtn");
    var olil = oli.length;
    for(var i=0;i<olil;i++){
        oli[i].addEventListener("touchend",function(){
            $("nav ul li").removeClass("on");
            $(this).parent().addClass("on").siblings().children(".one_menu").slideUp();
            $(this).parent().children(".one_menu").slideToggle();
        })
    };
    var spanB = $(".menu_title span");
    var spanBl = spanB.length;
    for(var i=0;i<spanBl;i++){
        spanB[i].addEventListener("touchend",function(){
            $(this).addClass("on");
            $(this).siblings(".two_menu").slideToggle();

        })
    };
    /*btnToggle*/

    /*slider*/
})
