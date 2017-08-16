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
					$.post('/paystatus/add?dinner_id='+dinner_id, data, function(data){
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
			
			//修改保存预约信息
			edit:function(){
				$('form').submit(function(e){
					e.preventDefault();
					var spiner = spin.show();
					var data = $('#base').serialize();
					$.post('/paystatus/edit/'+id, data, function(data){
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
				$(".Wdate").focus(function(){
					//var date = new Date();
					//$(this).val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate());
					if(arguments[0] && arguments[1]){
						WdatePicker({dateFmt:'yyyy-MM-dd', minDate:arguments[0], maxDate:arguments[1]})
					}else{
						WdatePicker({dateFmt:'yyyy-MM-dd'});
					}
					var date = $(this).val().split("-");
		            //计算农历
					if(date.length > 1){
						var link = 'year='+date[0]+'&month='+date[1]+'&day='+date[2];
						$.get('/publicservice/solartolunar?'+link, function(data){
							$('.lunardate').val(data.lunar_time.lunar_time)
							$('.week').val(data.lunar_time.week);
						})
						
					}
		            
		        });
				
				$(".tdate").focus(function(){
					WdatePicker({dateFmt:'HH:mm'})
				});
				$(".Cdate").focus(function(){
					WdatePicker({dateFmt:'yyyy-MM-dd'})
				});
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
							$.get('/paystatus/del/'+id, function(data){
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
	}
})
