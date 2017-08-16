/**
 * 场馆页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	require('dialog');
	require('wdate');
	require('swiper');
	module.exports = {
			load:function(){
					public.load();
					
					//新版本js start
					 $(window).scroll(function(){
			                if($(window).scrollTop() > 677){
			                     $(".header").addClass("show");
			                }else{
			                    $(".header.show").removeClass("show"); 
			                }
			            });

			            $(".venue-cont .venue-chose li").click(function(){
			                $(this).parent().children("li.act").removeClass("act");
			                $(this).addClass("act");
			                $(this).parent().parent().children(".venue-detail.act").removeClass("act");
			                $(this).parent().parent().children(".venue-detail").eq($(this).index()).addClass("act");
			            });
			        //新版本js end
					
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
				    
				  $(".popup-destine .sum").click(function(){
              $(this).children("ul").toggleClass("act");
          });

          
		},
		detail:function(){
		  var swiper = new Swiper('.wap-banner', {
        pagination: false,
        paginationClickable: true,
        autoplay:4000
      });
      $(".rank-main ul li:last-child").css("border-bottom", "none");
      $(".mark-list li:nth-child(3n)").css("margin-right", "0");
  
      $(".banquet-chose a").click(function(){
          $(".banquet-chose a.act").removeClass("act");
          $(this).addClass("act");
          $(".img-lists li.act").removeClass("act");
          $(".img-lists li").eq($(this).index()).addClass("act");
      });
    },
    
        jump:function(){
        	$(".project-list li").on('click', function(){
        	    window.location.href="/today/detail?id=" + $(this).attr('data-id');
        	})
        },
		
		show:function(){
			$(".bespeak").click(function() {
                $(".page-bg").addClass("act");
                $(".popup-bespeak").addClass("act");
                
                //判断是否登录
				$.get('/passport/is_login', function(data){
					if(data.status == 0){
						var realname = data.realname;
						var nickname = data.nickname;
						var mobile_phone = data.mobile_phone;
						var address = data.address;
						
						$('input[name="name"]').attr('value', realname);
						$('input[name="phone"]').attr('value', mobile_phone);;
						$('input[name="address"]').attr('value', address);;
					}
				})
                
                
                
            });
            $(".close").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-bespeak").removeClass("act");
            });
		},
		submit:function(){
		  
		  $(".destine").click(function(){
        $(".page-bg").addClass("act");
        $(".popup-destine").addClass("act");
        $(".close").click(function(){
            $(".page-bg").removeClass("act");
            $(".popup-destine").removeClass("act");
        });
		  });
		  

      $('.submit').click(function(){
        var realname = $('input[name="name"]').val();
        var mobile_phone = $('input[name="phone"]').val();
        var address = $('textarea[name="address"]').val();
        var time = $('input[name="time"]').val();
        var venue = $("#venue_id").val();
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
			$(".Wdate").focus(function(){
	            WdatePicker({dateFmt:'yyyy-MM-dd'})
	        });
			$(".tdate").focus(function(){
				WdatePicker({dateFmt:'HH:mm'})
			});
		},
	
	}
	
	function showDialog(msg, title, url){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
        var d = dialog({
        	id:'FVASDF',
            title: title,
            content: msg,
            width: 300,
            okValue: '确定',
            ok: function () {
            	if(url != '')
            	{
            		window.location.href=url;
            	}
                return true;
            }
        });
        d.showModal();
    }
	
	//url ajax请求地址   url1跳转地址
	function ajaxDialog(msg, title, url, url1){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
    	var url1 = arguments[3] ? arguments[3] : '';
        var d = dialog({
        	id:'FVASDF',
            title: title,
            content: msg,
            width: 300,
            okValue: '确定',
            ok: function () {
            	
            	if(url1 != '')
            	{
            		window.location.href=url1;
            	}
            }
        });
        d.showModal();
        if(url != '')
    	{
    		$.get(url, function(data){
			})
    	}
    }
	
})