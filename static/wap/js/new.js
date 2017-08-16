/**
 * 资讯页js
 * @author yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('weui');
	module.exports = {
			load:function(){
//				$(window).scroll(function(){
//	                if($(window).scrollTop() > 0){
//	                     $(".detail-video").addClass("act");
//	                }else{
//	                    $(".detail-video").removeClass("act"); 
//	                }
//	            });
				
//				var nav = document.querySelector('.detail-video');
//				if(nav){
//					var navOffsetY = nav.offsetTop;
//					function onScroll(e) {
//						window.scrollY >= navOffsetY ? nav.classList.add('act') : nav.classList.remove('act'); 
//					}
//					window.addEventListener('scroll', onScroll);
//				}
	  			
			},
			
			start:function(){

				$('.media-detail').on('click',".coment-list .but", function(){
					$(this).parent().next(".coment-cont").toggleClass("act");
				});
				$(".coment-list .icon1,.coment-list .icon2").click(function() {
	                $(this).addClass("act")
	            });
			},
			
			//公共提示框
			msg:function(msg){
				weui.alert(msg);
			},
			zan:function(){
				$(".land").on('click', function(){
			        var _obj = $(this);
			        var number = parseInt(_obj.attr("data-num"));
			        $.ajax( {
			            url:'/news/get_ajax_zan',
			            data: {
			                'id': id
			            },
			            type:'POST',
			            dataType:'json',
			            success:function(da) {
			                if(da.status == 0){
			                    _obj.attr("data-num",number+1);
			                    $(".l i").html(number+1);
			                    $(".add").animate({
			                		  top:'3px',
			                	      opacity:'0',
			                	      height:'150px',
			                	      width:'150px'},2000);
			                    _obj.addClass('act');
			                }else if(da.status == -1){
			                	module.exports.msg('你已经顶过了');
			                }
			            }

			        });
			    });
			},
			
			//显示全文
			all_click:function(){
				$('.all').on('click', function(){
					var status = $(this).attr('data');
					if(status == 0){
						var status = $(this).attr('data',1);
						$(this).html('收起内容');
						$('#text').removeClass('detail-con');
					}else{
						$('#text').addClass('detail-con');
						var status = $(this).attr('data',0);
						$(this).html('余下全文');
					}
				})
			},
			
			//文章留言
			say:function(){
				$('.say').on('click', function(){
					//coment-list
					var id = $('#art_id').attr('data');
					var user_id = $('#user_id').val();
					var user_name = $('#user_id').attr('data');
					var head_img = $('#user_id').attr('img');
					var say = $('#say').val();
					if(say == ''){
						module.exports.msg('评论内容不能为空');
						return false;
					}
					$.post('/news/say',{'news_id':id,'user_id':user_id,'content':say}, function(m){
						if(m.code == 1){
							var html = '';
						 	html += '<li>';
						 	html +='<img src="'+head_img+'">';
						 	html +='<div class="cont">';
						 	html +='<p class="name">'+user_name+'</p>';
						 	html +='<p class="text">'+say+'</p>';
						 	html +='<div class="con">';
						 	html +='<span class="l">刚刚</span>';
						 	html += '<span class="r icon1  but">回复</span>';
						 	html +='<span dataid="p_zan" num="0" data="'+m.id+'" class="r icon2">0</span> ';
						 	html +='</div>';
						 	html +='<div class="coment-cont" id="erji_'+m.id+'">';
						 	html +='<p>回复Ta：</p>';
						 	html +='<input type="hidden" class="er_news_id" value="'+m.id+'" />';
						 	html += '<input type="hidden" class="news_comment_id" value="'+m.id+'" />';
						 	html += '<input type="hidden" class="er_user_id" data="'+user_name+'" value="'+user_id+'"/>'
						 	html +='<textarea class="msg"></textarea>';
						 	html +='<a href="javascript:;" class="send">发表</a>';
						 	html += '</div>';
						 	html +='</div>';
						 	html +='</li>';
						$('.coment-list').prepend(html);
							$('#say').val('');
						}else{
							module.exports.msg(m.info);
						}
					})
				})
			},
			
			//二级评论
			say_er:function(){
				$('.coment-list').on('click', '.send', function(){
					var news_id = $('#art_id').attr('data');
					var user_id = $(this).parent().children('.er_user_id').val();
					var name = $(this).parent().children('.er_user_id').attr('data');
					var content = $(this).parent().children('.msg').val();
					var news_comment_id = $(this).parent().children('.news_comment_id').val();
					if(content == ''){
						module.exports.msg('评论内容不能为空');
						return false;
					}
					$.post('/news/say',{'news_id':news_id,'user_id':user_id,'content':content,'news_comment_id':news_comment_id}, function(m){
						if(m.code == 1){
							var html = '<p class="text"><span class="user">'+name+'：</span>'+content+'<span class="time">'+m.info+'</span></p>';
							$('#erji_'+news_comment_id).parent().append(html);
							$('#erji_'+news_comment_id).removeClass('act');
							$('.msg').val('');
						}else{
							module.exports.msg(m.info);
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
						module.exports.msg('无效的参数');
						return false;
					}
					var obj = $(this);
					$.post('/news/p_zan',{'id':id}, function(m){
						if(m.code == 1){
							obj.addClass("act")
							obj.html(parseInt(num)+1);
						}else{
							module.exports.msg(m.info);
						}
					})
				})
			},
			
			more:function(){
				$('#more').on('click',function(){
					var next_page = $(this).attr('next_page');
					var class_id = $('p.act').attr('data-id');
					$.post("/news/ajax_data", {
						class_id : class_id,
						next_page : next_page
					}, function(data) {
						html = '';
						$.each(data, function(i, v) {
						  html += '<li>';
              html += '<a href="/news/detail?id='+ v.id +'"><i class="click-but"></i></a>';
              html += '<img src="'+ v.cover_img +'">';
              html += '<p class="media-title">' + v.title + '</p>';
              html += '<p class="media-text">' + v.summary + '</p>';
              html += '<p class="list-bg"></p>';
              html += '</li>';
						})
						if (!html) {
							$('.more').text("没有更多了");
						}
						$("#more").before(html);
						$('#more').attr('next_page', ++next_page);

					})
				})
				
				$(".media-chose p").click(function(){
					$(".media-chose").toggleClass("act");
					var class_id = $(this).attr('data-id');
					var hasclass = $(this).attr('class');
					$(this).toggleClass("act");
					if(hasclass == 'act'){
						return false;
					}
					$(this).prependTo('.media-chose');
					$('.more').attr('next_page','1');
					$.post("", {class_id:class_id}, function(data){
						html = '';
						$.each(data, function(i, v){
							html += '<li>';
							html += '<a href="/news/detail?id='+v.id+'"><i class="click-but"></i></a>';
							html += '<img src="'+ v.cover_img +'">';
							html += '<p class="media-title">' + v.title + '</p>';
							html += '<p class="media-text">' + v.summary + '</p>';
							html += '<p class="list-bg"></p>';
							html += '</li>';
					})
  				$(".venue-list").find('li').remove();
  				$("#more").before(html);
  			})

        })
			}
	}
});






