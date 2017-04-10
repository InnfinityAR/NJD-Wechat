$(function(){
	$("#nav li>a").mouseenter(function(){
		$(this).siblings("dl").css({"display":"block","z-index":"1"}).parent().siblings().children("dl").hide()
	});
	$("#nav li").mouseleave(function(){
		$(this).children("dl").css({"display":"none","z-index":"-1"})
	})
});
(function(){
//    var navbox = document.getElementById("nav");
//    var navboxLi = navbox.children;
//    var navboxLiLength = navboxLi.length;
//    for(var i= 0;i<navboxLiLength;i++){
//        navboxLi[i].index = i;
//        navboxLi[i].onmouseenter = function(){
//            for(var j=0;j<navboxLiLength;j++){
//                navboxLi[j].style.color = "";
//            }
//            navboxLi[this.index].style.color = "#d82b27";
//            var thisLiC = navboxLi[this.index].children[0];
//            if(thisLiC.className.indexOf("one_menu")>-1){
//                thisLiC.style.display="block";
//            }
//        };
//        navboxLi[i].onmouseleave = function(){
//            for(var j=0;j<navboxLiLength;j++){
//                navboxLi[j].style.color = "";
//            }
//            navboxLi[this.index].style.color = "#d82b27";
//            var thisLiC = navboxLi[this.index].children[0];
//            if(thisLiC.className.indexOf("one_menu")>-1){
//                thisLiC.style.display="none";
//            }
//        }
//    };
    function Mouse(one_menu){
        var oneMenu = getclass(one_menu);
        var oneMlength = oneMenu.length;
        for(var i=0;i<oneMlength;i++){
            var menudd = oneMenu[i].children;
            var menuddlength = menudd.length;
            for(var j=0;j<menuddlength;j++){
                menudd[j].onmouseenter = function(){
                    this.className = "on";
                };
                menudd[j].onmouseleave = function(){
                    this.className = "";
                };
            }
        }
    };
    function Mouse(oneObj,twoObj){
        var oneMenu = getclass(oneObj);
        var oneMlength = oneMenu.length;
        for(var i=0;i<oneMlength;i++){
            var menudd = oneMenu[i].children;
            var menuddlength = menudd.length;
            for(var j=0;j<menuddlength;j++){
                menudd[j].onmouseenter = function(){
                    this.className = "on";
                    var two = this.children;
                    var twoLength = two.length;
                    for(var k=0;k<twoLength;k++){
                        if(two[k]){
                            if(two[k].className.indexOf(twoObj)>-1){
                                two[k].style.display="block"
                            };
                        }
                    }
                };
                menudd[j].onmouseleave = function(){
                    this.className = "";
                    var two = this.children;
                    var twoLength = two.length;
                    for(var k=0;k<twoLength;k++){
                        if(two[k]){
                            if(two[k].className.indexOf(twoObj)>-1){
                                two[k].style.display="none"
                            };
                        }
                    }
                };
            }
        }
    };
    Mouse("one_menu","two_menu");
    onMouse("two_menu");
    var oli = getclass("curl");
    var olilen = oli.length;
    var part = getclass("con_us_art");
    for(var i=0;i<olilen;i++){
        oli[i].index=i;
        oli[i].onclick=function(){
            for(var k=0;k<olilen;k++){
                removeClass(oli[k],"on");
                part[k].style.display="none"
            }
            addClass(oli[this.index],"on");
            part[this.index].style.display="block";
        }
    }
    var aside_us=document.getElementById("aside_us");
    var aside_us2=document.getElementById("asideBox");
	var zzc = document.getElementById("zhezhaoc");
    var testCod=document.getElementById("testCod");
    var num=document.getElementById("num");
    var nummess=document.getElementById("nummess");
    //var codetime = true;
	
    aside_us.onclick=tanchu;
	function tanchu(){
		zzc.className="";
        aside_us2.style.display="block";
    };
	zzc.onclick=function(){
		zzc.className="none";
        aside_us2.style.display="none";
	}
	var footer_btn = document.getElementById("footer_btn");
	footer_btn.onclick=tanchu;
    /*testCod.onclick=yanz;
        function yanz(){
        if(!codetime){
            this.className="";
            codetime=true;
        }else{
            this.className = "timeCode";
            nummess.innerHTML="";
            var number = 60;
            var mm = setInterval(function(){
                number --;
                num.innerHTML=""+number+"秒后重新获得";
                testCod.onclick = null;
                if(number<=0){
                    clearInterval(mm);
                    testCod.className="";
                    num.innerHTML="";
                    nummess.innerHTML="再次发送";
                    codetime=true;
                    testCod.onclick = yanz;
                };
            },1000)
            codetime=false;
        }
    }*/
})();
function onMouse(menu2){
    var oneMenu2 = getclass(menu2);
    var oneMlength2 = oneMenu2.length;
    for(var i=0;i<oneMlength2;i++){
        var menudd2 = oneMenu2[i].children;
        var menuddlength2 = menudd2.length;
        for(var j=0;j<menuddlength2;j++){
            menudd2[j].onmouseenter = function(){
                this.className = "on";
            };
            menudd2[j].onmouseleave = function(){
                this.className = "";
            };
        }
    }
};
function getclass(cName){
    var obj = [];
    if(document.getElementsByClassName){
        var arr = document.getElementsByClassName(cName);
        for(var i=0;i<arr.length;i++){
            obj[i] = arr[i]
        }
    }
    else{
        var all = document.getElementsByTagName("*");
        for(var i=0;i<all.length;i++){
            var allArr = all[i].className.split(" ");
            for(var i=0;i<allArr.length;i++){
                if(allArr[i]==cName){
                    obj.push(all[i]);
                    break
                }
            }
        }
    }
    return obj;
};
function removeClass(obj,cName){
    var classArr = obj.className.split(" ");
    for(var i=classArr.length-1;i>=0;i--){
        if(classArr[i]==cName){
            classArr.splice(i,1)
        }
    }
    obj.className = classArr.join(" ")
};
function addClass(obj,cName){
    if(obj.className){
        var classArr = obj.className.split(" ");
        for(var i=0;i<classArr.length;i++){
            if(classArr[i]==cName){
                return
            }
        }
        obj.className += ' '+cName;
    }
    else{
        obj.className=cName;
    }
};