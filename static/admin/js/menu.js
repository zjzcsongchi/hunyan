/**
 * 订单管理js
 */
define(function(require, exports, module){
	
	require('dialog');
	require('wdate');
	require('datatables');
	var spin = require('spin_lib');
	require('jqvalidate');
	module.exports={
			//保存预约信息
			save:function(){
				$('form').submit(function(e){
					e.preventDefault();
					var data = $('#base').serialize();
					var spiner = spin.show();
					$.post('/dinner/add', data, function(data){
						spin.close(spiner);
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.history.go(-1);
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					})
				})
			},
			//显示上传pc端封面图
			show:function(){
				$('#pc_').on('click', function(){
					$('#pc').attr('style', 'display:none');
					$('#pc_img').attr('style', 'display:block');
				})
			},
			
			//修改保存预约信息
			edit:function(){
				$('form').submit(function(e){
					e.preventDefault();
					var spiner = spin.show();
					var data = $('#base').serialize();
					$.post('/dinner/edit', data, function(data){
						spin.close(spiner);
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.history.go(-1);
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					})
				})
			},
			//时间选择器
			datepick:function(){
				$(".tdate").focus(function(){
					WdatePicker({dateFmt:'HH:mm'})
				});
				$(".Cdate").focus(function(){
					WdatePicker({dateFmt:'yyyy-MM-dd'})
				});
//				$(".Cdate").focus(function(){
//					WdatePicker({dateFmt:'yyyy-MM-dd'})
//				});
			},
			//删除预约
			del:function(){
				$(document).on('click', '.del', function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						fixed:true,
						title:'提示',
						content:'确认删除？',
						cancel:function(){},
						cancelValue:'取消',
						ok:function(){
							$.get('/dinner/del/'+id, function(data){
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
			//选择显示单份菜还是套餐
			choose_menus:function(){
				$('#choose_menus').click(function(){
					var type = $('input:checked[name=menus_type]').attr('data-type');
					var content = '<form id="'+type+'_dialog" class="form-horizontal">';
					content += $('#'+type).html();
					content += '</form>';
					var d = dialog({
						title:'选择菜品',
						content:content,
						cancel:true,
						cancelValue:'取消',
						okValue:'确定',
						ok:function(){
							var content = '';
							$('#'+type+'_dialog').find('input:checked[type=checkbox]').each(function(k,v){
								var id = $(this).val();
								var text = $(this).parent().text();
								var count = $(this).parents('.checkbox').next('div').children('input').val();
								
								content += '<li>*'+text+count+'份<input type="hidden" value="'+id+','+count+'" name="menus[]"></li>';
							})
							$('#all_menus').html(content);
						}
					})
					d.width(500);
					d.showModal();
				})
			},
			//宴会类型选择
			dinner_type:function(){
				$('#dinnertype').change(function(){
					if($(this).val() != 1){
						$('.dinner_other').removeClass('hide').addClass('show');
						$('.dinner_marry').each(function(k, v){
							$(v).removeClass('show').addClass('hide');
						})
					}else{
						$('.dinner_other').removeClass('show').addClass('hide');
						$('.dinner_marry').each(function(k, v){
							$(v).removeClass('hide').addClass('show');
						})
					}
				})
			},
			show_tables:function(){
				$('#table').DataTable({
					ordering:true,
					aaSorting:[2, 'asc'],
					fixedHeader:true,
					bPaginate:false,
					bInfo:false,
					sScrollY: "650px",
					autoWidth:false,
					sScrollX:true,
					scrollCollapse:false
				})
			},
			//更改排序，置顶显示
			up_show:function(){
				$('.up_order').click(function(){
					var id = $(this).attr('data-id');
					$.post('/dinner/up_show', {id:id}, function(data){
						var d = dialog({
							title:'提示',
							okValue:'确定',
							ok:function(){
								
							}
						})
						if(data.status == 0){
							d.content('置顶成功');
						}else{
							d.content('置顶失败');
						}
						d.width(320);
						d.showModal();
					})
				})
			}
			
	}
})
