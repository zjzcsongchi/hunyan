/**
 * 全景图说一说js
 * @author chaokai@gz-zc.cn 
 */
define(function(require, exports, module){

	require('dialog')

	module.exports = {
		talk:function(){
			var obj = this;
			$('#talk').click(function(){
				krpano.set('autorotate.enabled', false);

				
		        //热点唯一name
		        var date = new Date();
        		var hotspot_name = 'h_'+date.getTime();

		        krpano.call('div(now_x, stagewidth, 2); div(now_y, stageheight, 2); screentosphere(now_x, now_y, now_ath, now_atv);')
				var ath = krpano.get("now_ath")
	        	var atv = krpano.get("now_atv")
				var post_data = {
					vtour_id:id,
					content:"请输入评论内容",
					hotspot_name:hotspot_name,
					ath:ath,
					atv:atv,
					scene_name:krpano.get('xml.scene'),
					headurl:krpano.get('data[head_img].content')
				}
				obj.create_talk(post_data)

				var comment_length = comment_data.length
				comment_data[comment_length] = post_data;

				obj.set_hotspot_move(hotspot_name, comment_length)
				var d = dialog({
					title:'评论',
					content:'<textarea class="form-control" style="display:block;width:100%;" rows="3" id="comment"></textarea><span id="comment_help" class="help-block"></span>',
					cancelValue:'取消',
					cancel:function(){
						krpano.call('removehotspot('+hotspot_name+')')
						delete comment_data[comment_length]
					},
					okValue:'评 论',
					zIndex:30002,
					ok:function(){
						var comment = $('#comment').val();
						if(comment == ''){
							$('#comment_help').text('请输入评论内容')
							return false;
						}
						if(comment.length > 20){
							$('#comment_help').text('请限制在20字以内')
							return false;
						}
						comment_data[comment_length].content = comment;
						
						$.post('/vtour/talk', comment_data[comment_length], function(data){
							if(data.status == 0){
								krpano.set('autorotate.enabled', true);
								krpano.call('removehotspot('+hotspot_name+')')
								obj.create_talk(comment_data[comment_length])
								krpano.set('hotspot['+hotspot_name+'].ondown', '')
								krpano.set('hotspot['+hotspot_name+'].onup', '')
								krpano.set('layer[imgtip_'+hotspot_name+'].onup', '')
								krpano.set('layer[imgtip_'+hotspot_name+'].ondown', '')
								krpano.set('plugin[tooltip_'+hotspot_name+'].ondown', '')
								krpano.set('plugin[tooltip_'+hotspot_name+'].onup', '')
							}else{
								$('#comment_help').text(data.msg)
								return false;
							}
						})
					}

				})

				d.show();
			})
		},
		//控制评论热点显示/隐藏
		show_hide_talk:function(){
			
			$('#talk_manage').click(function(){
				if(is_show){
					$(this).removeClass('talk_hide').addClass('talk_show')
				}else{
					$(this).removeClass('talk_show').addClass('talk_hide')
				}
				is_show = !is_show;
				parse_comment(is_show)
			})
		},
		//设置热点可移动
		set_hotspot_move:function(hotspot_name, comment_length){
			krpano.set('layer[imgtip_'+hotspot_name+'].enabled', 'true')
			krpano.set('plugin[tooltip_'+hotspot_name+'].enabled', 'true')

			//设置热点可移动
			krpano.set('hotspot['+hotspot_name+'].ondown', "spheretoscreen(ath, atv, hotspotcenterx, hotspotcentery, 'l'); sub(drag_adjustx, mouse.stagex, hotspotcenterx); sub(drag_adjusty, mouse.stagey, hotspotcentery); asyncloop(pressed, sub(dx, mouse.stagex, drag_adjustx); sub(dy, mouse.stagey, drag_adjusty); screentosphere(dx, dy, ath, atv); );")
	        krpano.set('hotspot['+hotspot_name+'].onup', "jscall(comment_data["+comment_length+"].ath=krpano.get('hotspot["+hotspot_name+"].ath');comment_data["+comment_length+"].atv=krpano.get('hotspot["+hotspot_name+"].atv');)")
	        //设置热点头像可移动
	        krpano.set('layer[imgtip_'+hotspot_name+'].ondown', "spheretoscreen(hotspot["+hotspot_name+"].ath, hotspot["+hotspot_name+"].atv, hotspotcenterx, hotspotcentery, 'l'); sub(drag_adjustx, mouse.stagex, hotspotcenterx); sub(drag_adjusty, mouse.stagey, hotspotcentery); asyncloop(pressed, sub(dx, mouse.stagex, drag_adjustx); sub(dy, mouse.stagey, drag_adjusty); screentosphere(dx, dy, hotspot["+hotspot_name+"].ath, hotspot["+hotspot_name+"].atv); );")
	        krpano.set('layer[imgtip_'+hotspot_name+'].onup', "jscall(comment_data["+comment_length+"].ath=krpano.get('hotspot["+hotspot_name+"].ath');comment_data["+comment_length+"].atv=krpano.get('hotspot["+hotspot_name+"].atv');)")
	        //设置热点文字可移动
	        krpano.set('plugin[tooltip_'+hotspot_name+'].ondown', "spheretoscreen(hotspot["+hotspot_name+"].ath, hotspot["+hotspot_name+"].atv, hotspotcenterx, hotspotcentery, 'l'); sub(drag_adjustx, mouse.stagex, hotspotcenterx); sub(drag_adjusty, mouse.stagey, hotspotcentery); asyncloop(pressed, sub(dx, mouse.stagex, drag_adjustx); sub(dy, mouse.stagey, drag_adjusty); screentosphere(dx, dy, hotspot["+hotspot_name+"].ath, hotspot["+hotspot_name+"].atv); );")
	        krpano.set('plugin[tooltip_'+hotspot_name+'].onup', "jscall(comment_data["+comment_length+"].ath=krpano.get('hotspot["+hotspot_name+"].ath');comment_data["+comment_length+"].atv=krpano.get('hotspot["+hotspot_name+"].atv');)")
		},
		//创建评论热点
		create_talk:function(post_data){
			krpano.call("addhotspot("+post_data.hotspot_name+")")
			var hotspot = 'hotspot['+post_data.hotspot_name+'].'
			krpano.set(hotspot+"url", "%SWFPATH%/skin/talk_ico.png")
			krpano.set(hotspot+"headurl", (post_data.headurl == '') ? null : post_data.headurl)
			krpano.set(hotspot+"ath", post_data.ath)
			krpano.set(hotspot+"atv", post_data.atv)
			krpano.set(hotspot+"scale", 0.7)
			krpano.set(hotspot+"tooltip", post_data.content)
			krpano.set(hotspot+"onloaded", "if(!webvr.isenabled,add_img();add_comment_tooltip());")
			

		},
		//判断是否登录
		is_login:function(){
			// 判断是否登录
	        $.get('/passport/is_login', function(data){
	          if(data.status != 0){
	            $(".page-bg").addClass("act");
	            $.get('/passport/get_wechat_token', function(data){
	              var state = data.data;
	              $("#weixin_QR").attr("src","/passport/wechat_login_QR?state=" + state);
	              $('#weixin_box').addClass('act');
	              setInterval(function(){
	                is_wechat_login(state)
	              }, 2500);
	            })
	            
	            var is_wechat_login = function(state){
	              $.get('/passport/is_wechat_login', {state: state}, function(response){
	                if(response.status == 0){
	                  window.location.reload();
	                }
	              })
	            };
	          }
	        })
	        $(".popup-login .close").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-login").removeClass("act");
            });
		}
	}
});