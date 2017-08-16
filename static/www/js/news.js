/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	module.exports = {
			load:function(){
				$(document).ready(function(){
					public.load();
		            
		            //套餐页面样式
		            $(".pckage-list li:last-child").css("border-bottom", "none");
		            
		            var myVideo=document.getElementById("media");
		            $(".video-cont i").click(function() {
		                $(".video-cont video").addClass("act");
		                myVideo.play();
		            });
			})
		},
		
		more:function(){
			$('.more').click(function(){
				var next_page = $(this).attr("next_page");
				var new_page = parseInt(next_page)+1;
				$(this).attr("next_page", new_page);
				$.post("", {page:next_page}, function(data){
					if(data){
						html = '';
						$.each(data, function(i, v){
							html += '<li><a href="/news/detail/'+v.id+'"><img src="'+v.cover_img+'">';
							if(v.video_url != ''){
							  html += '<i></i>';
							}
							html += '<div class="info">';
							html += '<p class="title">'+v.title+'</p>';
							html += '<p class="text">'+v.summary+'</p>';
							html += '<p class="bot">';
							html += '<span class="l">发布者：'+v.publisher+' '+v.publish_time+'</span><span class="r">阅读 '+v.read+' </span></p>';
							html += '</div></a></li>';
							
						})
						$('#load_more').before(html);
					}
					if(data.length <= 0){
						$("#load_more").text('没有更多了');
						$("#load_more").css("background", "#CDC5BF");
					}

				})
				
				
	        })
		},
		
		zan:function(){
			$(".zan").click(function(){
		        var _obj = $(this);
		        var number = parseInt(_obj.attr("data-num"));
		        var id = "<?php echo $info['id']?>";
		        $.ajax( {
		            url:'/news/get_ajax_zan',
		            data: {
		                'id': id,
		                'number': number
		            },
		            type:'POST',
		            dataType:'json',
		            success:function(da) {
		                if(da.status == 0){
		                    _obj.attr("data-num",number+1);
		                    $(".l i").html(number+1);
		                }
		            }

		        });
		    });
		}
	
	}
})