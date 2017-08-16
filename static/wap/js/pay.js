/**
 * 微信支付js
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
	
	module.exports={
			init:function(js_bridge, order_id){
				var obj = this;
				$('#pay').on('click', function(){
					if (typeof WeixinJSBridge == "undefined"){
						if( document.addEventListener ){
							document.addEventListener('WeixinJSBridgeReady', obj.jsApiCall(js_bridge, order_id), false);
						}else if (document.attachEvent){
							document.attachEvent('WeixinJSBridgeReady', obj.jsApiCall(js_bridge, order_id)); 
							document.attachEvent('onWeixinJSBridgeReady', obj.jsApiCall(js_bridge, order_id));
						}
					}else{
						obj.jsApiCall(js_bridge, order_id);
					}
				})
			},
			jsApiCall:function(jsbridge_param, order_id){
		    	WeixinJSBridge.invoke(
					'getBrandWCPayRequest',
					JSON.parse(jsbridge_param),
					function(res){
						if(res.err_msg == "get_brand_wcpay_request:ok"){
							window.location.href="/order/index";
						}else{
							return false;
						}
					}
				);
		    },
	}
})