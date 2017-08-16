/** 
 * order.js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	var my_dialog = require('my_dialog');
	module.exports = {
		 venue:function(){
			 $('.venue_id').click(function(){
				 $('#cg').text($(this).text());
				 $('#cg').attr('data-id', $(this).attr('data'));
				 $('#page').val(1);//选择场馆后，页码要初始化
				 module.exports.find_new();
				 $('#load_more').text('加载更多');
			 })
		 },
		 find:function(){
			 $('#find').click(function(){
				module.exports.find_new();
				$('#load_more').text('加载更多');
			 })
		 },
		 
		 time:function(){
			 //时间图标被点击
			 $(document).on('click','.cont.l i',function(){
				 $('#solar_time').focus();
			 });
			 $('#solar_time').on('onchange', function(){
				 module.exports.find_new();
				 $('#page').val(1);//选择时间后，页码要初始化
				 $('#load_more').text('加载更多');
			 })
		 },
		 //查询
		 find_new:function(){
    		 var name = $('#name').val();
			 var venue_id = $('#cg').attr('data-id');
			 var solar_time = $('#solar_time').val();
			 var page = 1;
			 $.get('/wall/search',{'name':name,'venue':venue_id, 'time':solar_time, 'page':page}, function(data){
				 if(data){
					if(data == 'nodata'){
						$('.project-list').empty();
						$('#load_more').text('暂无更多数据');
					}else{
						$('.project-list').html(data);
						page = parseInt(page)+1;
						$('#page').val(page);
						
						$(".project-list li:nth-child(3n)").css("margin-right", "0");
			            $(".project-list li").hover3d({
			               selector: ".project_card",
			               shine: true,
			            });
					}
				 }
			 })	 
	    },
		 
	    load_ajax:function(){
	    	 var scrollToBottom = {
			    getScrollTop:function(){
			        var scrollTop = 0, bodyScrollTop = 0, documentScrollTop = 0;
			        if(document.body){
			            bodyScrollTop = document.body.scrollTop;
			        }
			        if(document.documentElement){
			            documentScrollTop = document.documentElement.scrollTop;
			        }
			        scrollTop = (bodyScrollTop - documentScrollTop > 0) ? bodyScrollTop : documentScrollTop;
			        return scrollTop;
			    },
			    getScrollHeight:function(){
			        var scrollHeight = 0, bodyScrollHeight = 0, documentScrollHeight = 0;
			        if(document.body){
			            bodyScrollHeight = document.body.scrollHeight;
			        }
			        if(document.documentElement){
			            documentScrollHeight = document.documentElement.scrollHeight;
			        }
			        scrollHeight = (bodyScrollHeight - documentScrollHeight > 0) ? bodyScrollHeight : documentScrollHeight;
			        return scrollHeight;
			    },
			    getClientHeight:function(){
			        var windowHeight = 0;
			        if(document.compatMode == "CSS1Compat"){
			            windowHeight = document.documentElement.clientHeight;
			        }else{
			            windowHeight = document.body.clientHeight;
			        }
			        return windowHeight;
			    },
			    onScrollEvent:function(callback){
			        var This = this;
			        window.onscroll = function(){
			            if(This.getScrollTop() + This.getClientHeight() >= This.getScrollHeight()){
			                typeof callback == "function" && callback.call(this);
			            }
			        }
			    }
			};

			//我们来在 window 上注册onscroll事件来测试一下
			scrollToBottom.onScrollEvent(function(){
				 var name = $('#name').val();
   				 var venue_id = $('#cg').attr('data-id');
   				 var solar_time = $('#solar_time').val();
   				 var page = $('#page').val();
   				 if(page == 1){
   					 page = parseInt(page)+1;
   				 }
   				 $.get('/wall/search',{'name':name,'venue':venue_id, 'time':solar_time, 'page':page}, function(data){
   					 if(data){
   						if(data == 'nodata'){
   							$('#load_more').text('暂无更多数据');
   						}else{
   							$('.project-list').append(data);
   							page = parseInt(page)+1;
   							$('#page').val(page);
   							$(".project-list li:nth-child(3n)").css("margin-right", "0");
   				            $(".project-list li").hover3d({
   				               selector: ".project_card",
   				               shine: true,
   				            });
   						}
   					 }
   				 })
			});
	    	
	    },
	    
		 load_more:function(){
	    	$('#load_more').on('click', function(){
	    		 var name = $('#name').val();
				 var venue_id = $('#cg').attr('data-id');
				 var solar_time = $('#solar_time').val();
				 var page = $('#page').val();
				 if(page == 1){
					 page = parseInt(page)+1;
				 }
				 $.get('/wall/search',{'name':name,'venue':venue_id, 'time':solar_time, 'page':page}, function(data){
					 if(data){
						if(data == 'nodata'){
							$('#load_more').text('暂无更多数据');
						}else{
							$('.project-list').append(data);
							page = parseInt(page)+1;
							$('#page').val(page);
							$(".project-list li:nth-child(3n)").css("margin-right", "0");
				            $(".project-list li").hover3d({
				               selector: ".project_card",
				               shine: true,
				            });
						}
					 }
				 })
	    	}) 			 
		 }
	}
})