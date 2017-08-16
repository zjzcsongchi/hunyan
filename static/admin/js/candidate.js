/**
 * 客户管理js
 */
define(function(require, exports, module){
	require('dialog');
	var swfUploader = require('admin_uploader');
	module.exports={
			//保存
//			save:function(){
//				$('#submit').click(function(e){
//					e.preventDefault();
//					
//					var data = $('form').serialize();
//					
//					$.post('/activity/add', data, function(data){
//						var content = data.msg;
//						var d = dialog({
//							title:"提示",
//							content:content,
//							ok:function(){
//								if(data.status == 0){
//									window.location.href="/activity/index";
//									return false;
//								}
//							},
//							okValue:"确定"
//						});
//						d.width(320);
//						d.showModal();
//					})
//				})
//			},
			//修改
			modify:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					var data = $('form').serialize();
					
					$.post('/candidate/modify/'+id, data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/candidate/index";
								}
								return false;
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			
			check:function(){
				$('.check').click(function(){
					var id = $(this).attr("data-id");
					
					var content = '<form class="form-horizontal">'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4" style="margin-left:-20px">审核:</label>'
						+ '<div class="col-sm-4">'
						+ '<select name="auth_status" class="form-control ">'
						+ '<option value="1">通过</option>'
						+ '<option value="2">不通过</option>'
						+ '</select>'
						+ '</div>'
						+ '</div>'
						
						+ '<div class="form-group">'
						+ '<label class="col-sm-4 control-label" style="margin-left:-20px">备注</label>'
						+ '<div class="col-sm-8"><textarea class="form-control" name="remark" rows="4" placeholder="备注信息" ></textarea>'
						+ '</div></div>'
						+ '</form>';

						var d = dialog({
								title:'填写审核信息',
								content:content,
								okValue:'确定',
								cancelValue:'取消',
								ok:function(){
									var post_data = $('form').serialize();
									var dialog_param = {
											title:'提示',
											okValue:'确定',
											cancelValue:'取消',
											ok:function(){},
											cancel:'',
											width:320
									};
									var d1 = dialog(dialog_param);
									
									$.post('/candidate/check/'+id, post_data, function(data){
										if(data.status != 0){
											d1.content(data.msg);
										}else{
											var d = dialog({
												title:'提示',
												content:'审核成功',
												ok:function(){
													window.location.reload();
												},
												okValue:"确定"
											})
											d.width(320);
											d.showModal();
										}
									})
								},
								cancel:function(){}
						});
						d.width(500)
						d.height(300)
						d.showModal()
						
				})
			},
			
			//删除
			del:function(){
				$('.del').click(function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						title:'提示',
						content:"确认删除？",
						cancelValue:'取消',
						cancel:true,
						okValue:'确定',
						ok:function(){
							var obj = this;
							$.post('/candidate/del', {id:id}, function(data){
								if(data.status != 0){
									obj.content = data.msg;
								}else{
									window.location.reload();
								}
							})
							return false;
						}
					})
					d.width(320);
					d.showModal();
				})
			},
			
			
	}
})