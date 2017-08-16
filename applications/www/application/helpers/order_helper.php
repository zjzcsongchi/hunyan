<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Global28.com order Helpers
 *
 * @package Global28.com
 * @subpackage Helpers
 * @category Helpers
 * @author logan@global28.com
 */

// ------------------------------------------------------------------------

if (! function_exists ( 'orderpaystatus' )) {
	/**
	 * 转换订单说明
	 *
	 * @param
	 *        	array 订单信息
	 * @return string 订单状态说明
	 */
	function orderpaystatus($order) {
		//积分支付
		if($order['pay_type'] == 1){
			$paystatus = $order ["total_price"] > $order ["cost_score"] ? "部分支付" : "已支付";
		}
		
		//支付宝或微信支付
		if($order['pay_type'] == 2 || $order['pay_type'] == 3 || $order['pay_type'] == 6){
			$paystatus = $order ["total_price"] > $order ["cost_cash"] ? "部分支付" : "已支付";
		}
		
		//积分+支付宝支付或积分+微信支付
		if($order['pay_type'] == 4 || $order['pay_type'] == 5){
			$paystatus = $order ["pay_status"] == 1 ? "已支付" : "部分支付";
		}
		
		switch ($order ["order_status"]) {
			case 0 :
				echo "订单已取消";
				break;
			case 1 :
				switch ($order['pay_status']) {
					case 0 :
						echo "等待支付";
						break;
					case 1 :
						echo $paystatus . "/" . "待确认";
						break;
					default :
						echo "支付失败";
				}
				break;
			case 2 :
				echo $paystatus . "/" . "已确认";
				break;
			case 3 :
				echo $paystatus . "/" . "已成功";
				break;
			default :
		}
	}
}

if (! function_exists ( 'orderstatus' )) {
	/**
	 * 转换订单说明
	 * @param int
	 * @return string 状态说明
	 */
	function orderstatus($status) {
		foreach ( C ( "order.status" ) as $value ) {
			
			if ($value ["value"] == $status)
				return $value ["name"];
		}
	}
}

if (! function_exists ( 'paystatus' )) {
	/**
	 * 转换支付说明
	 * @param int
	 * @return string 状态说明
	 */
	function paystatus($status) {
		foreach ( C ( "order.pay.status" ) as $value ) {
			if ($value ["value"] == $status)
				
				return $value ["name"];
		}
	}
}

if (! function_exists ( 'paytype' )) {
	/**
	 * 转换支付说明
	 * @param int
	 * @return string 状态说明
	 */
	function paytype($status) {
		foreach ( C ( "order.pay.type" ) as $value ) {
			if ($value ["value"] == $status)
				return $value ["name"];
		}
	}
}





