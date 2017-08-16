/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	module.exports = {
		load:function(){
		    public.load();
		    
        $(".venue-list li:nth-child(5n)").css("margin-right", "0");
        $(window).scroll(function(){
            if($(window).scrollTop() > 677){
                 $(".header").addClass("show");
            }else{
                $(".header.show").removeClass("show"); 
            }
        });

        $(".drink-chose a").click(function(){
            $(".drink-chose a.act").removeClass("act");
            $(this).addClass("act");
            $(".venue-list").eq($(this).index()).removeClass("hiden");
        });
        
        //酒水跳转
        $("body").on('click', ".venue-list li", function(){
          window.location.href="/drink/detail?id=" + $(this).attr('data_id');
        });

		},
		
		drink_class:function(){
			$(".drink_class").click(function(){
				var class_id = $(this).attr('data-id');
				$.post('/drink/lists', {class_id:class_id}, function(data){
					if(data == 'nodata'){
						$(".venue-list").hide();
					}else{
						$(".venue-list").show();
						$(".venue-list").html(data);
//						addEvent();
					}
				})
			})
		}
		
	}
})