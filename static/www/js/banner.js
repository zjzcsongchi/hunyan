// JavaScript Document
$(function(){
    /*图片轮播*/
    //初始化
    var size = $(".img li").size();  
    for(var i=1;i<=size;i++){   
        var li="<li></li>"; 
        $(".num").append(li);
    }
    
    //手动控制图片轮播
    $(".img li").eq(0).show();  
    $(".num li").eq(0).addClass("active");  
    $(".num li").mouseover(function(){
        $(this).addClass("active").siblings().removeClass("active");  
        var index=$(this).index();  
        i=index;  
        $(".img li").eq(index).stop().fadeIn(800).siblings().stop().fadeOut(800);   
    })
    
    //自动控制图片轮播
    var i=0;  
    var t=setInterval(move,3000);  
    //向左切换函数
    function moveL(){
        i--;
        if(i==-1){
            i=size-1;  
        }
        $(".num li").eq(i).addClass("active").siblings().removeClass("active");  
        $(".img li").eq(i).fadeIn(800).siblings().fadeOut(800);  
    }
    //向右切换函数
    function move(){
        i++;
        if(i==size){
            i=0;  
        }
        $(".num li").eq(i).addClass("active").siblings().removeClass("active");  
        $(".img li").eq(i).fadeIn(800).siblings().fadeOut(800);  
    }
    //定时器开始与结束
    $(".out").hover(function(){
        clearInterval(t);   
    },function(){
        t=setInterval(move,3000);  
    })
    
});
