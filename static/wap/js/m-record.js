/**
 * 婚礼档案js
 * @author yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	
	var my_dialog = require('my_dialog');
	module.exports = {
		start:function(){
			$('body').height($('body')[0].clientHeight);  
			      document.addEventListener('touchstart', function(){ 
			      document.getElementById('media').play();
			  }, false);
			
			scaleW=window.innerWidth/320;
		    scaleH=window.innerHeight/480;
		    var resizes = document.querySelectorAll('.resize');
		          for (var j=0; j<resizes.length; j++) {
		           resizes[j].style.width=parseInt(resizes[j].style.width)*scaleW+'px';
		           resizes[j].style.height=parseInt(resizes[j].style.height)*scaleH+'px';
		           resizes[j].style.top=parseInt(resizes[j].style.top)*scaleH+'px';
		           resizes[j].style.left=parseInt(resizes[j].style.left)*scaleW+'px'; 
		          }
		          
		    var mySwiper = new Swiper ('.swiper-container', {
		        direction : 'vertical',
		        pagination: false,
		        mousewheelControl : true,
		        onInit: function(swiper){
		        swiperAnimateCache(swiper);
		        swiperAnimate(swiper);
		    },
		    onSlideChangeEnd: function(swiper){
		        swiperAnimate(swiper);
		    },
		    onTransitionEnd: function(swiper){
		        swiperAnimate(swiper);
		    },  
		    
		    watchSlidesProgress: true,
		        onProgress: function(swiper){
		        for (var i = 0; i < swiper.slides.length; i++){
		            var slide = swiper.slides[i];
		            var progress = slide.progress;
		            var translate = progress*swiper.height/4;  
		            scale = 1 - Math.min(Math.abs(progress * 0.5), 1);
		            var opacity = 1 - Math.min(Math.abs(progress/2),0.5);
		            slide.style.opacity = opacity;
		            es = slide.style;
		            es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate3d(0,'+translate+'px,-'+translate+'px) scaleY(' + scale + ')';
		        }
		    },
		    
		    onSetTransition: function(swiper, speed) {
		        for (var i = 0; i < swiper.slides.length; i++){
		            es = swiper.slides[i].style;
		            es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = speed + 'ms';
		            }
		        },
		    })  

		    var myVideo=document.getElementById("media");
		    $(".audio_btn").click(function() {
		        $(this).toggleClass("rotate");
		        if($(".audio_btn").hasClass("rotate")){
		            myVideo.play();
		            $('#media').attr('status', 1);
		        }
		        else{
		           myVideo.pause(); 
		           $('#media').attr('status', 0);
		        }
		    });
		},
		
		save:function(){
			$('#save').on('click', function(e){
				e.preventDefault();
				var info = $("form").serialize();
				$.post("/record/index",info,function(data){
					if(data){
						if(data.code == 1){
							my_dialog.alert(data.msg);
						}else{
							my_dialog.alert(data.msg);
						}
					}else{
						my_dialog.alert('网络异常，请稍后再试！');
					}
				});
			})
		}
	}
});
