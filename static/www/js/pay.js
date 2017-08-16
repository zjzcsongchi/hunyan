/**
 * 订单微信支付
 */
define(function(require, exports, module){

	module.exports={
			pay_status:function(is_pay){
				if(is_pay){
					return false;
				}
				var intval;
				intval = setInterval(function(){
					$.post('/order/status', {order_id:order_id}, function(data){
						if(data.status != 0){
							console.log(data.msg);
							return false;
						}
						if(data.data.status == 1){
							clearInterval(intval);
							$('#pay img').attr('src', staticUrl+'/www/images/pay_success.jpg');
							$('#pay .text').text('支付成功');
						}
					})
				}, 1000);
			}
	}
})