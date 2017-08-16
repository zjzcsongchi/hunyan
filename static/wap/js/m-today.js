/** 
 * 宴会详情js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			//公共提示框
			msg:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					ok:function(){},
					okValue:"确定"
				})
				d.width(200);
				d.showModal();
			},
			
			more:function(id){
				//送花
				$("a[dataid='more1']").on('click', function(){
					var page = $(this).attr('data');
					$.post('/today/get_flowers', {'id':id, 'page':page}, function(data){
						if(data !=0){
							var html = '';
							$.each(data, function(i, v){
								html +='<li>';
								html +='<p class="tip">'+( (parseInt(page)-1)*5 + (parseInt(i)+1) )+'</p>';
							    html +='<img src="'+v.head_img+'">';
								html +='<p class="list-name">'+v.nickname+'</p>';
								html +='<p class="count">'+v.num+'</p>';
							    html +='</li>';
							})
							$('#more1').append(html);
							$("a[dataid='more1']").attr('data', parseInt(page)+1);
						}else{
							$("a[dataid='more1']").html('没有数据了');
						}
					})
					
				});
				//评论
				$("a[dataid='more2']").on('click', function(){
					var page = $(this).attr('data');
					$.post('/today/get_bless', {'id':id, 'page':page}, function(data){
						if(data !=0){
							var html = '';
							$.each(data, function(i, v){
								html +='<li id="t_'+v.id+'" data="'+( (parseInt(page)-1)*5 + (parseInt(i)+1) )+'">';
								html +='<p class="tip">'+( (parseInt(page)-1)*5 + (parseInt(i)+1) )+'</p>';
								html +='<img src="'+v.head_img+'">';
								html +='<div class="cont">';
								html +='<p class="list-title">'+v.nickname+'</p>';
								html +='<p class="list-text">'+v.content+'</p>';
								html +='</div>';
								html +='<p class="count" num="'+v.zan_count+'" data="'+v.id+'"><i>+1</i>'+v.zan_count+'</p>';
							    html +='</li>';
							})
							$('#more2').append(html);
							$("a[dataid='more2']").attr('data', parseInt(page)+1);
						}else{
							$("a[dataid='more2']").html('没有数据了');
						}
					})
				});
				
				//评论排行榜点赞
				$('#more2').on('click', 'p.count', function(){
					var _obj = $(this);
					var id = _obj.attr('data');
				    if(id == ''){
				    	module.exports.msg('系统拒绝操作');
				    }
				    $.post('/today/zan_bless', {'bless_id':id}, function(m){
				    	if(m){
				    		if(m == 1){
				    			var num = parseInt(_obj.attr('num'))+1;
				    			_obj.html('<i>+1</i>'+num);
				                _obj.addClass("act");
				    		}else{
				    			module.exports.msg(m);
				    		}
				    	}else{
				    		module.exports.msg('网络错误');
				    	}
				    })
				})
			}
	}
})