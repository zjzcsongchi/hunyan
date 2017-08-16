/**
 * 场馆页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	require('dialog');
	require('weui');
	require('swiper');
	module.exports = {
			load:function(){
					public.load();
					
					$(".venue-chose .select").click(function(){
						$(this).addClass("act");
						$(this).siblings(".select").removeClass("act");
					})
					
		            $(".venue-list .but").click(function() {
		                $(".page-bg").addClass("act");
		                $(".popup-destine").addClass("act");
		            });
		            $(".popup-destine .close").click(function() {
		                $(".page-bg").removeClass("act");
		                $(".popup-destine").removeClass("act");
		            });
		            
					$(".theme-list li:nth-child(3n)").css("margin-right", "0");
		            $(".out .num").css("right",($(".venue-banner").width()-1100)/2+50);
		            $(".banner-left").css("right",($(".venue-banner").width()-1100)/2+1100);
		            $(".banner-right").css("left",($(".venue-banner").width()-1100)/2+1100);
		            
		            $(".theme-list li img,.theme-list li p").click(function() {
				        $(".page-bg").addClass("act");
				        $(this).parent().children(".theme-img").addClass("act");
				    });

				    $(".theme-list .close").click(function() {
				        $(".page-bg").removeClass("act");
				        $(".theme-img").removeClass("act");
				    });
				    
				    
				    $(".theme-list li:nth-child(3n)").css("margin-right", "0");
		            $(".popup-bespeak li:nth-child(2n)").css("float", "right");

		            $(".bespeak").click(function() {
		                $(".page-bg").addClass("act");
		                $(".popup-bespeak").addClass("act");
		            });
		            $(".close").click(function() {
		                $(".page-bg").removeClass("act");
		                $(".popup-bespeak").removeClass("act");
		            });
				    

				    var mySwiper1 = new Swiper('.swiper-container1',{
				        pagination: '.pagination1',
				        loop:true,
				        grabCursor: true,
				        paginationClickable: true
				    })
				    $('.arrow-left1').on('click', function(e){
				        e.preventDefault()
				        mySwiper1.swipePrev()
				      })
				      $('.arrow-right1').on('click', function(e){
				        e.preventDefault()
				        mySwiper1.swipeNext()
				    })

				    var mySwiper2 = new Swiper('.swiper-container2',{
				        pagination: '.pagination2',
				        loop:true,
				        grabCursor: true,
				        paginationClickable: true
				    })
				    $('.arrow-left2').on('click', function(e){
				        e.preventDefault()
				        mySwiper2.swipePrev()
				      })
				      $('.arrow-right2').on('click', function(e){
				        e.preventDefault()
				        mySwiper2.swipeNext()
				    })

				    var mySwiper3 = new Swiper('.swiper-container3',{
				        pagination: '.pagination3',
				        loop:true,
				        grabCursor: true,
				        paginationClickable: true
				    })
				    $('.arrow-left3').on('click', function(e){
				        e.preventDefault()
				        mySwiper3.swipePrev()
				      })
				      $('.arrow-right3').on('click', function(e){
				        e.preventDefault()
				        mySwiper3.swipeNext()
				    })
		},
		
		show:function(){
			$(document).on("click",'.bespeak',function(){
//			$(".bespeak").click(function() {
				var id = $(this).attr('data-id');
	                $(".page-bg").addClass("act");
	                $(".popup-destine").addClass("act");
	            $(".popup-destine .close").click(function() {
	                $(".page-bg").removeClass("act");
	                $(".popup-destine").removeClass("act");
	            });
	            
	            $("#default_id").text(id);
                //判断是否登录
				$.get('/passport/is_login', function(data){
					if(data.status == 0){
 					var realname = data.realname;
 					var nickname = data.nickname;
 					var mobile_phone = data.mobile_phone;
 					var address = data.address;
					if(!realname){
						realname = nickname;
					}
					$('input[name="name"]').attr('value', realname);
 					$('input[name="phone"]').attr('value', mobile_phone);
 					$('textarea[name="address"]').attr('value', address);
 					$('textarea[name="address"]').text(address);
	 				}
					
				})
            });
		},
		submit:function(){
			$('.submit').click(function(){
				var realname = $('input[name="name"]').val();
				var mobile_phone = $('input[name="phone"]').val();
				var address = $('textarea[name="address"]').val();
				var time = $('input[name="time"]').val();
				var venue = $("#default_id").text();
				var dinner_type = $("#venue").val();
				var menus_count = $("input[name='menus_count']").val();
				if(!realname){
					$(".message").html("用户名不能为空");
					$('input[name="name"]').focus();
					return false;
				}
				
				if(!mobile_phone){
					$(".message").html("电话不能为空");
					$('input[name="phone"]').focus();
					return false;
				}

				
				if(!time){
					$(".message").html("选择预约时间");
					$('input[name="time"]').focus();
					return false;
				}
				
				if(!venue){
					$(".message").html("选择场馆");
					return false;
				}
				
				$.post('/venue/appoint', {realname:realname, mobile_phone:mobile_phone, address:address, venue_id:venue, time:time, dinner_type:dinner_type, menus_count:menus_count}, function(data){
					if(data.status == 0){
						var id = $("#default_id").text(id);
						ajaxDialog(data.msg, '', '/venue/email?mobile_phone='+data.data.mobile_phone+"&realname="+data.data.realname+"&address="+data.data.address+"&customer_id="+data.data.customer_id+"&venue_id="+venue+"&menus_count="+menus_count+"&dinner_type="+dinner_type, '/venue');
					}else{
						showDialog(data.msg)
					}
				})
				
			})
		},
		
		datepick:function(){
		  $('#datePicker').click(function(){
		    var date = new Date();
		    
		    weui.datePicker({
		      start:2016,
		      end:2030,
		      defaultValue:[date.getFullYear(), date.getMonth()+1, date.getDate()],
		      id:'datePicker',
		      onConfirm:function(result){
		        $('#datePicker').val(result[0]+'-'+result[1]+'-'+result[2]);
		      }
		    })
		    
		  })
		},
		
    detail: function(){
       $(function(){
         $(".suspend-but").click(function() {
           $(".page-bg").addClass("act");
           $(".popup-destine").addClass("act");
       });
       $(".popup-destine .close").click(function() {
           $(".page-bg").removeClass("act");
           $(".popup-destine").removeClass("act");
       });
    
       var myVideo=document.getElementById("media");
       $(".venue-detail .video-cont").click(function() {
          $(".venue-detail .video-cont i").removeClass("act");
          $(".venue-detail .video-cont img").removeClass("act");
          myVideo.play();
       });
    
       $(".case-list .video-cont").click(function() {
          $(this).children("i").removeClass("act");
          $(this).children("img").removeClass("act");
          $(this).children("video")[0].play();
           });
       });
    },
    
    	select:function(){
    		$(document).on("click",'.select',function(){
    			var venue_class_id = $(this).attr("data-id");
    			$.post('/venue/ajax_data', {venue_class_id:venue_class_id},function(data){
    				if(data.status == 0){
    					html = '';
    					$.each(data.data.list, function(k,v){
    						html += '<li><a href="'+v.detail_link+'"><i class="click-but" style="top:0.5rem"></i><img src="'+v.cover_img+'"></a>';
    						html += '<p class="name">'+v.name+'</p>';
    						html += '<p class="text">最大桌数：<span>'+v.max_table+'</span>桌&nbsp;&nbsp;楼层/层高：'+v.floor+'/'+v.height+'</p>';
    						html += '<p class="text">场地面积：<span>'+v.area_size+'</span>平&nbsp;&nbsp;低消：<span>'+v.min_consume+'</span>/桌</p>';
    						html += '<p class="text">适合类型：'+v.fit_type+'&nbsp;&nbsp;容纳人数：<span>'+v.container+'</span>人</p>';
    						html += '<p class="text">设备支持：'+v.device+'</p>';
    						html += '<p class="but bespeak" data-id="'+v.id+'">立即预定</p><p class="list-bg"></p></li>';
    					})
    					$(".venue-list").html(html);
    				}else{
    					$(".venue-list").html('');
    				}
    			})
    		})
    	}
	
	}
	
	function showDialog(msg, title, url){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
    	weui.alert(msg, function(){
    	  if(url != ''){
    	    window.location.href=url;
    	  }
      });
    }
	
	//url ajax请求地址   url1跳转地址
	function ajaxDialog(msg, title, url, url1){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
    	var url1 = arguments[3] ? arguments[3] : '';
    	if(url != '')
    	{
    	  $.get(url, function(data){})
    	}
    	weui.alert(msg, function(){
    	  window.location.href=url1;
    	})
    }
	
})