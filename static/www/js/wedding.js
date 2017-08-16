/** 
 * 我的婚礼js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			
			//点击图片事件
	        showbigimg:function(){
	        	$(document).on("click", 'li > img',function(){
	        		$("#showimg").attr('class','popup-bespeak act');
	        		var img = $(this).attr('src');
	        		$("#showimg > img").attr('src',img);
	        	})
	        	
	        	$(".close").click(function(){
	        		$("#showimg").attr('class','popup-bespeak');
	        	})
	        },

			msg:function(msg){
	    	var d = dialog({
	    	    content: msg,
	    	    id: 'EF893L'
	    	});
	    	d.show();
	    	setTimeout(function () {
	    	    d.close().remove();
	    	}, 3000)
	    },
		//修改视频的是否共享
		changevideo:function(id){
			$("#video_yes").click(function(){
				$.get('/usercenter/change', {'k':1, 'id':id,'field':'is_video_share'}, function(data){
					if(data == 1){
						module.exports.msg('您已经分享了婚宴视频');
						$("#video_status").html('您已经共享了婚礼视频');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
			$("#video_no").click(function(){
				$.get('/usercenter/change', {'k':0, 'id':id,'field':'is_video_share'}, function(data){
					if(data == 1){
						module.exports.msg('您取消了婚宴视频的分享');
						$("#video_status").html('是否共享婚礼视频：');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
		},
		//修改相册的是否共享
		changeimage:function(id){
			$("#image_yes").click(function(){
				$.get('/usercenter/change', {'k':1, 'id':id,'field':'is_images_share'}, function(data){
					if(data == 1){
						module.exports.msg('您已经分享了婚宴相册');
						$("#image_status").html('您已经共享了婚礼相册');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
			$("#image_no").click(function(){
				$.get('/usercenter/change', {'k':0, 'id':id,'field':'is_images_share'}, function(data){
					if(data == 1){
						module.exports.msg('您取消了婚宴相册的分享');
						$("#image_status").html('是否共享婚礼相册：');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
			
		},
		//修改菜谱的是否共享
		changedish:function(id){
			$("#dish_yes").click(function(){
				$.get('/usercenter/change', {'k':1, 'id':id,'field':'is_dish_share'}, function(data){
					if(data == 1){
						module.exports.msg('您已经分享了婚宴菜单');
						$("#dish_status").html('您已经共享了婚礼菜单');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
			$("#dish_no").click(function(){
				$.get('/usercenter/change', {'k':0, 'id':id,'field':'is_dish_share'}, function(data){
					if(data == 1){
						module.exports.msg('您取消了婚宴菜单的分享');
						$("#dish_status").html('是否共享婚礼菜单：');
					}else if(data ==0){
						module.exports.msg('操作失败，请稍后再试');
					}else{
						module.exports.msg('网络错误，请稍后再试');
					}
				});
			});
		},
		
		//相册分页
		image_go:function(){
			$(".image_p").click(function(){
				var start = $(this).attr('data');
				module.exports.image_ajax(start);
				$("#image").attr('data',start);
			})
		},
		//菜谱分页
		dish_go:function(){
			$(".dish_p").click(function(){
				var dstart = $(this).attr('data');
				module.exports.dish_ajax(dstart);
				$("#dish").attr('data',dstart);
			})
		},
		//相册上下页
		next_back: function(max){
			//上一页
			$('#back').click(function(){
				var start = $('#image').attr('data');
				//如果当前是第一页
				if( start== 1){
					return false;
				}else{
					module.exports.image_ajax(parseInt(start)-1);
					$('#image').attr('data', parseInt(start)-1);
				}
			});
			//下一页
			$('#next').click(function(){
				var start = $('#image').attr('data');
				//如果当前是最后一页
				if($('#image').attr('data') == max){
					return false;
				}else{
					module.exports.image_ajax(parseInt(start)+1);
					$('#image').attr('data', parseInt(start)+1);
				}
			});
		},
		//食谱上下页
		d_next_back: function(max){
			//上一页
			$('#d_back').click(function(){
				var dstart = $('#dish').attr('data');
				//如果当前是第一页
				if( dstart== 1){
					return false;
				}else{
					module.exports.dish_ajax(parseInt(dstart)-1);
					$('#dish').attr('data', parseInt(dstart)-1);
				}
			});
			//下一页
			$('#d_next').click(function(){
				var dstart = $('#image').attr('data');
				//如果当前是最后一页
				if($('#dish').attr('data') == max){
					return false;
				}else{
					module.exports.dish_ajax(parseInt(dstart)+1);
					$('#dish').attr('data', parseInt(dstart)+1);
				}
			});
		},
		//image_ajax
		image_ajax:function(start){
			$.get('/usercenter/get_image',{'start':start},function(data){
				if(data){
					$("#image").html();
					var html = '';
					$.each(data,function(k,v){
						if((k+1)%4 == 0){
							html += "<li style='margin-right:0;'><img src="+v+"></li>";
						}else{
							html += "<li><img src="+v+"></li>";
						}
						
					})
					$("#image").html(html);
				}
			});
		}
		,
		//dish_ajax
		dish_ajax:function(dstart){
			$.get('/usercenter/get_dish',{'dstart':dstart},function(data){
				if(data){
					$("#dish").html();
					var html = '';
					$.each(data,function(k,v){
						if((k+1)%4 == 0){
							html += "<li style='margin-right:0;'>";
						}else{
							html += "<li>";
						}
						html += "<img src="+v.cover_img+">";
						html += '<p class="bg"></p>';
                        html += '<div class="info">';
						html += "<p class='title'>"+v.name+"</p>";
						html += "<p class='text'>"+v.description+"</p>";
						html += "</div></li>";
					})
					$("#dish").html(html);
				}
			});
		}
	}
});