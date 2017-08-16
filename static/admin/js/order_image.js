/**
 * 相册订单js
 * @author chaokai@gz-zc.cn
 * 
 */
define(function(require, exports, module){
	require('dialog');
	
	module.exports={
			//填写运单号
			input_express:function(){
				$('#express_btn').click(function(){
					var id = $('#order_id').val();
					var content = '<form class="form-horizontal">'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4">快递公司:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_company" placeholder="请输入快递公司">'
						+ '</div>'
						+ '</div>'
						+ '<div class="form-group">'
						+ '<label class="control-label col-sm-4">运单号:</label>'
						+ '<div class=" col-sm-8">'
						+ '<input type="text" class="form-control" name="express_number" placeholder="请输入快递单号">'
						+ '</div>'
						+ '</div>'
						+ '</form>';
					var d = dialog({
							title:'填写快递信息',
							content:content,
							okValue:'确定',
							cancelValue:'取消',
							ok:function(){
								var express_company = $('input[name=express_company]').val();
								var express_number = $('input[name=express_number]').val();
								var dialog_param = {
										title:'提示',
										okValue:'确定',
										cancelValue:'取消',
										ok:function(){},
										cancel:'',
										width:320
								};
								var d1 = dialog(dialog_param);
								if(express_company == '' || express_number == ''){
									d1.content('请填写所有字段');
									d1.showModal();
									return false;
								}
								var post_data = {id:id,express_company:express_company,express_number:express_number};
								$.post('/orderimage/input_express', post_data, function(data){
									if(data.status != 0){
										d1.content(data.msg);
									}else{
										window.location.reload();
									}
								})
							},
							cancel:function(){}
					});
					d.width(400)
					d.showModal()
				})
			},
			//删除订单
			del:function(){
			  $('.del').click(function(){
			    var id = $(this).data('id');
			    var d = dialog({
			      title:'警告',
			      content:'确认删除？',
			      ok:function(){
			        $.get('/orderimage/del', {id:id}, function(data){
			          if(data.status == 0){
			            window.location.reload();
			          }
			        })
			      },
			      okValue:'确认',
			      cancel:function(){},
			      cancelValue:'取消'
			    })
			    d.width(320);
			    d.showModal();
			  })
			}
	}
})