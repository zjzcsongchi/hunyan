/**
 * 回访记录管理
 */
define(function(require, exports, module){
	
	require('dialog');
	
	module.exports={
			alert:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(150);
				d.showModal();
			},
			//添加回访记录
			add:function(){
				$('#add').click(function(){
					var customer_id = $('#customer_id').val();
					var remark = $("[name='remark']").val();
					var data = {'customer_id':customer_id,'remark':remark};
					$.post('/customer/add_review', data, function(msg){
						if(msg){
							if(msg.code == 1){
								window.location.reload();
							}else{
								module.exports.alert(msg.msg)
							}
						}else{
							module.exports.alert('网络异常')
						}
					})
				})
			},
			//修改
			modify:function(){
				$('.edit').click(function(){
					var id = $(this).attr('data-id');
					var content = '加载中...';
					var d = dialog({
						title:'修改跟踪信息',
						content:content,
						cancel:true,
						cancelValue:'取消',
						okValue:'确定',
						ok:function(){
							
						}
					});
					d.width(320);
					d.showModal();
					
					$.get('/customer/modify_review', {id:id}, function(data){
						if(data.status != 0){
							d.content(data.msg);
							return false;
						}
						d.close().remove();
						var info = data.data;
						content = '';
						content += '<form class="form-horizontal" id="form_modify">';
						content += '<input type="hidden" name="id" value="'+info.id+'">';
						content += '<div class="form-group">';
						content += '<label class="control-label col-sm-2">备注</label>';
						content += '<div class="col-sm-8"><textarea name="remark" class="form-control" rows="3">'+info.remark+'</textarea></div>';
						content += '</div>';
						content += '</form>';
						var d1 = dialog({
							title:'修改跟踪信息',
							content:content,
							cancel:true,
							cancelValue:'取消',
							okValue:'确定',
							ok:function(){
								var data = $('#form_modify').serialize();
								$.post('/customer/modify_review', data, function(data){
									var d2 = dialog({
										title:'提示',
										content:data.msg,
										okValue:'确定',
										ok:function(){
											if(data.status == 0){
												window.location.reload();
											}
										}
									})
									d2.width(320);
									d2.showModal();
								})
								return false;
							}
						})
						d1.width(600);
						d1.showModal();
					})
				})
			},
			//删除跟踪信息
			del:function(){
				$('.del').click(function(){
					var id = $(this).attr('data-id');
					
					var d = dialog({
						title:'提示',
						content:'确认删除？',
						cancel:true,
						cancelValue:'取消',
						okValue:'确定',
						ok:function(){
							$.get('/customer/del_review', {id:id}, function(data){
								window.location.reload();
							})
						}
					})
					d.width(320)
					d.showModal()
				})
			}
	}
})