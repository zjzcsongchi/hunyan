/**
 * 资讯页js
 * @author yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	var my_dialog = require('my_dialog');
	module.exports = {			
			//页面初始化
			start:function(){
				$(".hot-list li:nth-child(4n)").css("margin-right", "0");
	            $(".media-nav li:last-child").css("border-right", "none");
	            $(".coment-list li:last-child").css("border-bottom", "none");
	            $(document).on('click',".coment-list .icon2",function() {
	            	$('.list-detail').removeClass('act');
	                $(this).parent().parent().children(".list-detail").addClass("act");
	                var id = $(this).attr('data');
	                $('#sec_code_'+id).attr('src','/news/code/'+id+'/say');
	                //判断是否满足填写验证码的条件
	                $.post('/news/check_sec_code', {'id':id}, function(data){
	                	if(data != 0){
	                		$('#have_two_'+id).html(data);
	                	}
	                });
	                $(document).on('click',".coment-list .cancel",function() {
	                    $(this).parent().parent(".list-detail").removeClass("act");
	                });
	            });
	            
	            var $backtotop = $(".to-top");
	            function backTotop() {
	                t = $(document).scrollTop();
	                if (t > 200 || $(window).width > 480) {
	                    $backtotop.addClass("show");
	                } else {
	                    $backtotop.removeClass("show");
	                }
	            }
	            backTotop();
	            $(window).scroll(function () {
	                backTotop();
	            });
	            $backtotop.click(function () {
	                $("body,html").animate({scrollTop:0},500);
	               return false;
	            });
	            var myVideo=document.getElementById("media");
	            $(".video-cont i").click(function() {
	                $(".video-cont video").addClass("act");
	                myVideo.play();
	            });
			},
			
			//获取文章、评论的验证码
			get_article_code:function(){
				$('#article').on('click', function(){
					var id = $(this).attr('data');
					$(this).attr('src','/news/code/'+id);
				});
				$(document).on('click', '.sec_code',function(){
					var id = $(this).attr('data');
					$(this).attr('src','/news/code/'+id+'/say');
				})
				
			},
			zan:function(){
				$(document).on('click', '.coment-list .icon1', function(){
			        var _obj = $(this);
			        var number = _obj.text();
			        var id = _obj.attr('data');
			        $.ajax( {
			            url:'/news/get_ajax_zan',
			            data: {
			                'id': id
			            },
			            type:'POST',
			            dataType:'json',
			            success:function(da) {
			                if(da.status == 0){
			                	var total = parseInt(number)+1;
			                    _obj.text(total);
			                    _obj.addClass('act');
			                }else if(da.status == -1){
			                	my_dialog.alert('你已经顶过了');
			                }
			            }

			        });
			    });
			},
			
			//文章留言
			say:function(){
				$('#say').on('click', function(){
					//coment-list
					var id = $('#user_id').attr('newsid');
					var user_id = $('#user_id').val();
					if(!user_id || user_id == ''){
						my_dialog.alert('请先登陆再来评论！');
						return false;
					}
					if($('#article_code').val() == ''){
						my_dialog.alert('请填写验证码！');
						return false;
			        }else{
			        	var article_code = $('#article_code').val();
			        }
					var user_name = $('#user_id').attr('data');
					var head_img = $('#user_id').attr('img');
					var say = $('#content').val();
					if(say == ''){
						my_dialog.alert('评论内容不能为空');
						return false;
					}
					var post_data ={
							'news_id':id,
							'user_id':user_id,
							'content':say,
							'user_name':user_name,
							'head_img':head_img,
							'article_code' : article_code 
					}
					$.post('/news/say',post_data, function(data){
						if(!data.info){
						$('.coment-list').prepend(data);
							$('#content').val('');
							$('#article_code').val('');
							$('#article').attr('src','/news/code/'+id);
							//检查评论次数是否已经到达打开验证码的条件
							$.post('/news/check_code_status',{'id':id}, function(data){
								if(data != 0){
									$('#p_code').html(data);
								}
							})
						}else{
							my_dialog.alert(data.info);
						}
					})
				})
			},
			
			//二级评论
			say_er:function(){
				$(document).on('click', '[type="sec"]', function(){
					var news_comment_id = $(this).data('id');
					var id = $('#user_id').attr('newsid');
					var user_id = $('#user_id').val();
					if(!user_id || user_id == ''){
						my_dialog.alert('请先登陆再来评论！');
						return false;
					}
					if($('#say_code_'+news_comment_id).length > 0){
						var sec_code = $('#say_code_'+news_comment_id).val();
						if(sec_code == ''){
							my_dialog.alert('请填写验证码！');
							return false;
						}
			        }
					var user_name = $('#user_id').attr('data');
					var head_img = $('#user_id').attr('img');
					var say = $('#sec_'+news_comment_id).val();
					if(say == ''){
						my_dialog.alert('评论内容不能为空');
						return false;
					}
					var post_data ={
							'news_id':id,
							'user_id':user_id,
							'content':say,
							'user_name':user_name,
							'head_img':head_img,
							'news_comment_id':news_comment_id,
							'sec_code':sec_code
					}
					$.post('/news/say',post_data, function(data){
						if(!data.info){
							$('#p_'+news_comment_id).prepend(data);
							$('#sec_'+news_comment_id).val('');
							//判断是否满足填写验证码的条件
			                $.post('/news/check_sec_code', {'id':news_comment_id}, function(data){
			                	if(data != 0){
			                		$('#have_two_'+news_comment_id).html(data);
			                	}
			                });
							}else{
								my_dialog.alert(data.info);
						}
					})
				})
			},
			
			article_zan:function(){
				$('.laud').on('click', function(){
					var id = $(this).attr('data');
					if(!id || id == ''){
						my_dialog.alert('点赞失败！');
						return false;
					}
					id = parseInt(id);
					$.post('/news/article_zan',{'id':id}, function(data){
						if(data.status == 0){
							my_dialog.alert('点赞成功！');
						}else if(data.status == -1){
							my_dialog.alert('您已经顶过了！');
							return false;
						}else{
							my_dialog.alert('网络异常！');
							return false;
						}
					})
				})
			},
			
			//评论点赞
			p_zan:function(){
				$('.coment-list').on('click',"span[dataid='p_zan']" , function(){
					var id = $(this).attr('data');
					var num = $(this).attr('num');
					if(id == ''){
						my_dialog.alert('无效的参数');
						return false;
					}
					var obj = $(this);
					$.post('/news/p_zan',{'id':id}, function(m){
						if(m.code == 1){
							obj.addClass("act")
							obj.html(parseInt(num)+1);
						}else{
							my_dialog.alert(m.info);
						}
					})
				})
			},
			
			//一级评论ajax分页
			get_page:function(){
				$(document).on('click', '.get-page',function(){
					var _obj = $(this);
					var page = _obj.text();
					if(!page || page ==''){
						page = 1;
					}
					var id = $('#user_id').attr('newsid');
					if(!id || id== ''){
						my_dialog.alert('参数错误！');
						return false;
					}
					$.get('/news/get_page', {'id':id,'page':page}, function(data){
						if(data != 'nodata'){
							$('.coment-list').html(data);
							_obj.addClass('act');
							_obj.siblings().removeClass('act');
							_obj.parent().attr('data',page);
							_obj.parent().children('.flag').text('第'+page+'页');
						}else{
							my_dialog.alert('没有数据了');
						}
					})
				})
			},
			
			//二级评论分页
			sec_page:function(){
				$(document).on('click', '.sec-page',function(){
					var _obj = $(this);
					var page = _obj.text();
					if(!page || page ==''){
						page = 1;
					}
					var id = _obj.attr('data');
					if(!id || id== ''){
						my_dialog.alert('参数错误！');
						return false;
					}
					$.get('/news/sec_page', {'id':id,'page':page}, function(data){
						if(data != 'nodata'){
							$('#p_'+id).html(data);
							_obj.addClass('act');
							_obj.siblings().removeClass('act');
							_obj.parent().attr('data', page);
							_obj.parent().parent().children('.flag').text('第'+page+'页');
						}else{
							my_dialog.alert('没有数据了');
						}
					})
				})
			},
			
			
			back_go:function(){
				//一级，上一页
				$(document).on('click','[type="p_back"]', function(){
					var _obj = $(this);
					var page = parseInt(_obj.parent().attr('data'));
					if(!page || page <=1){
						return false;
					}else{
						var id = $('#user_id').attr('newsid');
						if(!id || id== ''){
							my_dialog.alert('参数错误！');
							return false;
						}
						page = parseInt(page)-1;//page-1
						$.get('/news/get_page', {'id':id,'page':page}, function(data){
							if(data != 'nodata'){
								$('.coment-list').html(data);
								_obj.addClass('act');
								_obj.siblings().removeClass('act');
								_obj.parent().attr('data',page);
								_obj.parent().children('.flag').text('第'+page+'页');
								//页码得到标识act
								_obj.parent().children('.get-page').removeClass('act');
								_obj.parent().children('.get-page').each(function(i,v){ 
									if($(v).text() == page){
										$(v).addClass('act');
									}
								})
							}else{
								my_dialog.alert('没有数据了');
							}
						})
					}
				});
				//一级，下一页
				$(document).on('click','[type="p_go"]', function(){
					var _obj = $(this);
					var page = parseInt(_obj.parent().attr('data'));
					if(!page || page < 1){
						return false;
					}else{
						var id = $('#user_id').attr('newsid');
						if(!id || id== ''){
							my_dialog.alert('参数错误！');
							return false;
						}
						var page = parseInt(page)+1;//+1
						$.get('/news/get_page', {'id':id,'page':page}, function(data){
							if(data != 'nodata'){
								$('.coment-list').html(data);
								_obj.addClass('act');
								_obj.siblings().removeClass('act');
								_obj.parent().attr('data',page);
								_obj.parent().children('.flag').text('第'+page+'页');
								//页码得到标识act
								_obj.parent().children('.get-page').removeClass('act');
								_obj.parent().children('.get-page').each(function(i,v){
									if($(v).text() == page){
										$(v).addClass('act');
									}
								})
							}else{
								my_dialog.alert('没有数据了');
							}
						})
					}
				});
				
				//二级 上页功能
				$(document).on('click','[type="back"]', function(){
					var _obj = $(this);
					var page = parseInt(_obj.parent().attr('data'));
					if(!page || page <=1){
						return false;
					}else{
						var id = _obj.attr('data');
						if(!id || id== ''){
							my_dialog.alert('参数错误！');
							return false;
						}
						page = parseInt(page)-1;//page-1
						$.get('/news/sec_page', {'id':id,'page':page}, function(data){
							if(data != 'nodata'){
								$('#p_'+id).html(data);
								_obj.addClass('act');
								_obj.siblings().removeClass('act');
								_obj.parent().attr('data',page);
								_obj.parent().parent().children('.flag').text('第'+page+'页');
								//页码得到标识act
								_obj.parent().children('.sec-page').removeClass('act');
								_obj.parent().children('.sec-page').each(function(i,v){
									if($(v).text() == page){
										$(v).addClass('act');
									}
								})
							}else{
								my_dialog.alert('没有数据了');
							}
						})
					}
				});
				//二级，下一页
				$(document).on('click','[type="go"]', function(){
					var _obj = $(this);
					var page = parseInt(_obj.parent().attr('data'));
					if(!page || page < 1){
						return false;
					}else{
						var id = _obj.attr('data');
						if(!id || id== ''){
							my_dialog.alert('参数错误！');
							return false;
						}
						var page = parseInt(page)+1;//+1
						$.get('/news/sec_page', {'id':id,'page':page}, function(data){
							if(data != 'nodata'){
								$('#p_'+id).html(data);
								_obj.addClass('act');
								_obj.siblings().removeClass('act');
								_obj.parent().attr('data',page);
								_obj.parent().parent().children('.flag').text('第'+page+'页');
								//页码得到标识act
								_obj.parent().children('.sec-page').removeClass('act');
								_obj.parent().children('.sec-page').each(function(i,v){
									if($(v).text() == page){
										$(v).addClass('act');
									}
								})
							}else{
								my_dialog.alert('没有数据了');
							}
						})
					}
				});
			}
	}
});






