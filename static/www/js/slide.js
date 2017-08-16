
$(function(){
  //轮播
  $(function(){
   var w=645;
    var l=0;
    var timer=null;
    var len=$(".scroll ul li").length*2; 
   $(".scroll ul").append($(".scroll ul").html()).css({'width':len*w, 'left': -len*w/2});
  timer=setInterval(init,3500);
  function init(){
       $(".scroll .next").trigger('click');
  }
  $(".scroll ul li").hover(function(){
       clearInterval(timer);
      },function(){
          timer=setInterval(init,3500);
     });
    $(".prev").click(function(){
        l=parseInt($(".scroll ul").css("left"))+w; 
           showCurrent(l); 
        });
        $(".next").click(function(){
           l=parseInt($(".scroll ul").css("left"))-w;
          showCurrent(l);
    });
     function showCurrent(l){ 
     if($(".scroll ul").is(':animated')){ 
        return;
     }
     $(".scroll ul").animate({"left":l},1000,function(){
              if(l==0){ 
             $(".scroll ul").css("left",-len*w/2);   
           }else if(l==(1-len)*w){ 
               $(".scroll ul").css('left',(1-len/2)*w); 
              }
          }); 
       }
  });
});