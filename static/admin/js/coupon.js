/**
 * 优惠卷js文件
 * 
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	require('datatables');
	var spin = require('spin_lib');
    var pub = require('public');
	
	module.exports = {
			changestatus:function(){
				$("a[name='change']").click(function(){
					var is_del = $(this).attr('data');
					var id = $(this).attr('id');
					$.get('/coupon/change',{'is_del':is_del,'id':id}, function(data){
						if(data == 1){
							window.location.reload()
						}else{
                           return false;
						}
					});
				})
			},
			
			typechange:function(){
				$("a[name='typechange']").click(function(){
					var is_del = $(this).attr('data');
					var id = $(this).attr('id');
					$.get('/coupon/typechange',{'is_del':is_del,'id':id}, function(data){
						if(data == 1){
							window.location.reload()
						}else{
                           return false;
						}
					});
				})
			},
			//删除代金券
			delete:function(){
				$(".delete").click(function(){
					var url=$(this).attr("url");
					var d = dialog({
				        title: '删除',
				        content: '是否删除',
				        modal:false,
				        okValue: '确定',
				        ok: function () {
				            if(url != '')
				            {
				                window.location.href=url;
				            }
				            return true;
				        }
				    });
				    d.width(320);
				    d.show();
					
				})
			},
			
		    //时间选择器
		    wdate: function () {  
		        $(function(){
		            $(".Wdate").focus(function(){
		                WdatePicker({dateFmt:'yyyy-MM-dd'})
		            });
		        });
		    },
		    
		    //保存
			save:function(){
				$('form').submit(function(e){
					e.preventDefault();
					var data = $('#form').serialize();
					var spiner = spin.show();
					$.post('/coupon/manually_add', data, function(data){
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
	}
})