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
    toggle("online_zx");
    toggle("xqbtn1");
    toggle("xqbtn2");
    toggle("xqbtn3");
    toggle("online_zx2");
    toggle("lx_btn");
	var aside_us2=document.getElementById("asideBox");
	var zzc = document.getElementById("zhezhaoc");
	
	lx_btn.onclick=tanchu;
	function tanchu(){
		zzc.className="";
        aside_us2.style.display="block";
    };
	zzc.onclick=function(){
		zzc.className="none";
        aside_us2.style.display="none";
	};
	
})();
(function(){
    var zxbox = getclass("btn_grop")[0].children;
    var zxCon = getclass("zxBox")[0].children;

    zxbox[1].onclick=function(){
        removeClass(zxbox[0],"on");
        zxCon[0].style.display="none";
        addClass(zxbox[1],"on");
        zxCon[1].style.display="block";

    };

    zxbox[0].onclick=function(){
        removeClass(zxbox[1],"on");
        zxCon[1].style.display="none";
        addClass(zxbox[0],"on");
        zxCon[0].style.display="block";

    };
        var oul2 = document.getElementById("slider");
        var ctrlBtnbox = getclass("controBox");
        var ctrlBtn = ctrlBtnbox[1].getElementsByTagName("span");
        for(var i=0;i<4;i++){
            ctrlBtn[i].index=i;
            ctrlBtn[i].onclick=function(){
                for(var j=0;j<4;j++){
                    ctrlBtn[j].className="";
                }
                this.className="on";
                oul2.style.cssText="transform:translate("+(this.index)*-1200+"px,0)";
            }
        };
    var oul = document.getElementById("sliderBox");
    //var ctrlBtnbox = getclass("controBox");
    var ctrlBtn2 = ctrlBtnbox[0].getElementsByTagName("span");
    for(var i=0;i<4;i++){
        ctrlBtn2[i].index=i;
        ctrlBtn2[i].onclick=function(){
            for(var j=0;j<4;j++){
                ctrlBtn2[j].className="";
            }
            this.className="on";
            oul.style.cssText="transform:translate("+(this.index)*-1200+"px,0)";
        }
    };

    function Slider(id){
        for(var i=0;i<4;i++){
            ctrlBtn[i].index=i;
            ctrlBtn[i].onclick=function(){
                for(var j=0;j<4;j++){
                    ctrlBtn[j].className="";
                }
                this.className="on";
                id.style.cssText="transform:translate("+(this.index)*-1200+"px,0)";
            }
        }
    };
})();
(function(){
	var oli = document.getElementById("fanzhuan").getElementsByTagName("li");
	//var btn = true;
	for(var i=0;i<oli.length;i++){
		oli[i].onmouseenter=function(){
            this.children[1].style.transform="translate3d(0,0,0)";
		}
		oli[i].onmouseleave=function(){
            this.children[1].style.transform="translate3d(0,-360px,0)"
		}
	}
})()
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
function removeClass(obj,cName){
    var classArr = obj.className.split(" ");
    for(var i=classArr.length-1;i>=0;i--){
        if(classArr[i]==cName){
            classArr.splice(i,1)
        }
    }
    obj.className = classArr.join(" ")
};
function toggle(id){
    if(id){
        var btn = document.getElementById(id);
        if(btn){
            btn.onmouseenter=function(){
                this.className="on";
            };
            btn.onmouseleave=function(){
                this.className="";
            };
        }
        
    }
    
};
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
/*

*/