/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	module.exports = {
		load:function(){
		    public.load();
		    $(window).scroll(function(){
                if($(window).scrollTop() > 677){
                     $(".header").addClass("show");
                }else{
                    $(".header.show").removeClass("show"); 
                }
            });
            $( '#example' ).sliderPro({
                width: 965,
                height: 555,
                orientation: 'vertical',
                loop: false,
                arrows: true,
                buttons: false,
                thumbnailsPosition: 'right',
                thumbnailPointer: true,
                thumbnailWidth: 210,
                thumbnailHeight: 118,
                breakpoints: {
                    800: {
                        thumbnailsPosition: 'bottom',
                        thumbnailWidth: 210,
                        thumbnailHeight: 100
                    },
                    500: {
                        thumbnailsPosition: 'bottom',
                        thumbnailWidth: 120,
                        thumbnailHeight: 50
                    }
                }
            });
            imgscrool('.follow-shot');

		},
		load_more:function(){
			$(".more_flower").click(function(){
				var next_page = $(this).attr('next_page');
				var new_page = next_page*1+1*1;
				var dinner_id = $("input[name='dinner_id']").val();
				var offset = (next_page-1)*5;
				$.post('/today/more_flower', {next_page:next_page,dinner_id:dinner_id}, function(data){
					if(data.status == 0){
						var html = '';
						$.each(data.data, function(i,v){
							var num = offset + (i+1)*1;
							html += '<li><p class="tip">'+num+'</p>';
							html += '<img src="'+v.head_img+'">';
							html += '<p class="name">'+v.nickname+'</p>';
							html += '<p class="count">'+v.num+'</p></li>';
							
						})
						if(html){
							$('.lw').find('ul').append(html);
							$(".more_flower").attr('next_page', new_page);
						}else{
							$(".more_flower").hide();
							$(".no_data").show();
						}
					}else{
						$(".more_flower").hide();
						$(".no_data").show();
					}
					
				})
			})
		},
		load_more_bless:function(){
			$(".more_bless").click(function(){
				var next_page = $(this).attr('next_page');
				var new_page = next_page*1+1*1;
				var dinner_id = $("input[name='dinner_id']").val();
				var offset = (next_page-1)*5;
				$.post('/today/more_bless', {next_page:next_page,dinner_id:dinner_id}, function(data){
					if(data.status == 0){
						var html = '';
						$.each(data.data, function(i,v){
							var num = offset + (i+1)*1;
							html += '<li><p class="tip">'+num+'</p>';
							html += '<img src="'+v.head_img+'">';
							html += '<div class="cont"><p class="list-title">'+v.nickname+'</p>';
							html += '<p class="text">'+v.content+'</p></div>';
							html += '<p class="count">'+v.zan_count+'</p></li>';
						})
						if(html){
							$('.zf').find('ul').append(html);
							$(".more_bless").attr('next_page', new_page);
						}else{
							$(".more_bless").hide();
							$(".no_bless").show();
						}
						
					}else{
						$(".more_bless").hide();
						$(".no_bless").show();
					}
					
				})
			})
		}
		
	}
})