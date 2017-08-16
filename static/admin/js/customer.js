/**
 * 客户管理js
 */
define(function(require, exports, module){
	require('wdate');
	require('dialog');
	module.exports={
			datepicker:function(){
				$('.tdate').focus(function(){
		            WdatePicker({dateFmt:'yyyy-MM-dd'})
		        });
			},
			//保存
			save:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					
					$.post('/customer/add', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/customer/index";
									return false;
								}
							},
							okValue:"确定"
						});
						d.width(320);
						d.showModal();
					})
				})
			},
			//修改
			modify:function(){
				$('#submit').click(function(e){
					e.preventDefault();
					
					var data = $('form').serialize();
					
					$.post('/customer/modify', data, function(data){
						var content = data.msg;
						var d = dialog({
							title:"提示",
							content:content,
							ok:function(){
								if(data.status == 0){
									window.location.href="/customer/index";
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
							$.post('/customer/del', {id:id}, function(data){
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
			}
	}
})