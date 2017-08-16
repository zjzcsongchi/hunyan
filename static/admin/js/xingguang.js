/**
 * 星光大道js
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	
	module.exports={
			//审核
			auth:function(){
				$('#auth').click(function(){
					var id = $(this).attr('data-id');
					var content = '';
					content += '<div class="container-fluid" style="margin:10px">'
					content += '<form class="form-horizontal" id="auth_submit">';
					content += '<div class="form-group">';
					content += '<label class="radio-inline">';
					content += '<input type="radio" name="auth_status" value="1" checked>审核通过';
					content += '</label>';
					content += '<label class="radio-inline">';
					content += '<input type="radio" name="auth_status" value="2">审核不通过';
					content += '</label>';
					content += '</div>'
					content += '<div class="form-group">'
					content += '<label>审核意见</label>'
					content += '<textarea name="auth_suggestion" class="form-control"></textarea>'
					content += '</div>';
					content += '</form>'
					content += '</div>';
					
					var d = dialog({
						title:'审核',
						content:content,
						okValue:'确认',
						cancelValue:'取消',
						ok:function(){
							var post_data = $('#auth_submit').serialize();
							post_data = post_data+'&id='+id;
							$.post('/xingguang/auth', post_data, function(data){
								if(data.status == 0){
									window.location.reload();
								}else{
									var d2 = dialog({
										title:'错误',
										content:data.msg,
										okValue:'确认',
										ok:function(){}
									})
									d2.showModal();
								}
							})
						},
						cancel:function(){
							
						}
						
					})
					d.width(400)
					d.showModal();
					
				})
			},
			//删除家庭成员
			del_family:function(){
				$('.del_family').click(function(){
					var obj = this;
					var d = dialog({
						title:'提示',
						content:'确认删除？',
						okValue:'确认',
						cancelValue:'取消',
						cancel:function(){},
						ok:function(){
							$(obj).parent().parent().remove();
						}
					})
					d.width(320)
					d.showModal();
				})
			},
			datepicker:function(){
				$('.date').focus(function(){
		            WdatePicker({dateFmt:'yyyy-MM-dd'})
		        });
			}
	}
})