/**
 * 场馆管理js
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	module.exports={
		//保存场馆
		save:function(){
			$('form').submit(function(e){
				e.preventDefault();
				var data = $('form').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"/venue/add",
					dataType:"json",
					success:function(data){
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.location.reload();
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					}
				})
			})
			
		},
		//时间选择器
		datepick:function(){
			$(".Wdate").focus(function(){
	            WdatePicker({dateFmt:'yyyy-MM-dd'})
	        });
			$(".tdate").focus(function(){
				WdatePicker({dateFmt:'HH:mm'})
			});
		},
		//修改保存信息
		edit:function(){
			$('form').submit(function(e){
				e.preventDefault();
				var data = $('form').serialize();
				$.ajax({
					type:"POST",
					data:data,
					url:"/venue/modify",
					dataType:"json",
					success:function(data){
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.location.href="/venue/index";
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					}
				})
			})
		},
		//首页高度调整
		height_auto:function(){
			$('.contain').each(function(){
				var left_height = $(this).children('.left').height();
				var right_height = $(this).children('.right').height();
				if(left_height > right_height){
					$(this).children('.right').css({height:left_height});
				}else if(right_height > left_height){
					$(this).children('.left').css({height:right_height});
				}
			})
		},
		//列表页时间选择器
		index_datepick:function(){
			$(".Wdate").focus(function(){
	            WdatePicker({dateFmt:'yyyy-MM'})
	        });
		},
		//切换场馆月份显示
		change_date:function(){
			$('.date_search').click(function(){
				var date = $(this).siblings('.date').val();
				var data_arr = date.split('-');
				var year = data_arr[0];
				var month = data_arr[1];
				var venue_id = $(this).siblings('.venue_id').val();
				
				var obj = $(this);
				$.ajax({
					url:'/venue/change_date',
					data:{year:year,month:month,venue_id:venue_id},
					type:'POST',
					dataType:'html',
					beforeSend:function(){
						var wait_data = '<tr><td colspan="6">加载中</td></tr>';
						obj.parents('thead').next('tbody').html(wait_data);
					},
					success:function(data){
						obj.parents('thead').next('tbody').html(data);
					}
				})
			})
		},
		//显示场馆相册
		show_images:function(){
			$('.show_images').click(function(){
				var id = $(this).attr('data-id');
				$.post('/venue/show_images', {id:id}, function(data){
					var content = '';
					if(data.data.length == 0){
						content = '暂无相册';
					}else{
						content += '<div class="container-fluid">';
						$.each(data.data,function(k, v){
							content += '<div class="col-sm-3">';
							content += '<img src="'+v.img_url+'" class="img-rounded show_big_img" style="height:180px; width:100%;">';
							content += '</div>';
						})
						content += '</div>';
					}
					var d = dialog({
						title:'场馆相册',
						content:content,
						okValue:'关闭',
						ok:function(){}
					})
					d.width(800);
					d.showModal();
				})
			})
		},
		//显示大图
		show_big_img:function(){
			$(document).on('click', '.show_big_img', function(){
				var url = $(this).attr('src');
				var d = dialog({
					content:'<img style="width:100%" src="'+url+'" class="close_big_img" title="点击关闭">'
				})
				d.width(500);
				d.showModal();
				$('.close_big_img').one('click', function(){
					d.close().remove();
				})
			})
		},
		//删除场馆
		del_venue:function(){
			$('.del_venue').click(function(){
				var id = $(this).attr('data-id');
				var d = dialog({
					fixed:true,
					title:'提示',
					content:'确认删除？',
					cancel:function(){},
					cancelValue:'取消',
					ok:function(){
						$.get('/venue/del_venue/'+id, function(data){
							d.content(data.msg);
							if(data.status == 0){
								window.location.reload();
							}
						})
						return false;
					},
					okValue:'确定'
				})
				d.width(320);
				d.showModal()
			})
		},
		//显示订单详情
		show_detail:function(){
			$(document).on('click', '.detail', function(){
				var id = $(this).attr('data-id');
				$.get('/dinner/show_detail/'+id, function(data){
					var d = dialog({
						title:'宴会详情',
						content:data,
						ok:true,
						okValue:'确认'
					})
					d.width(500);
					d.showModal();
				})
			})
		}
	}
})