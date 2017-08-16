/** 
 * order.js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	var my_dialog = require('my_dialog');
	module.exports = {
		hidden:function(){
			$('.no').click(function(){
				$('.order-popup').removeClass('act');
				$('.page-bg').removeClass('act');
			})
		},
		jump:function(){
			$('.jump').on('click', function(){
				var id = $(this).attr('data');
				window.location.href='/order/order_detail?id='+id;
			})
		},

		del:function(){
			$('.order-list .cancel').on('click', function(e){
				e.stopPropagation();
				_this = $(this);
  			    my_dialog.dialog('确认删除该订单？',function(){
  			    	var id = _this.attr('data');				
  					$.post('/order/del_order',{'id':id}, function(data){
  						if(data){
  							if(data.code == 1){
  				                $('#t_'+id).remove();
  							}else{
  								my_dialog.alert(data.msg);
  							}
  						}else{
  							my_dialog.alert('网络异常');
  						}
  					})
  			    });
				
			})
		}
	}
})