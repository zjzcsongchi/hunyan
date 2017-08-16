<?php
/**
 * 支付状态和送货状态
 * @author chaokai@gz-zc.cn
 */
$config = array(
                //支付状态
                'pay_status' => array(
                                'no_pay' => array(
                                                'id' => 0,
                                                'name' => '未支付'
                                ),
                                'success' => array(
                                                'id' => 1,
                                                'name' => '支付成功'
                                ),
                                'fail' => array(
                                                'id' => 2,
                                                'name' => '支付失败'
                                ) 
                ),
                //订单类型
                'order_type' => array(
                                'image' => array(
                                                'id' => 1,
                                                'name' => '相片订单'
                                ),
                                'album' => array(
                                                'id' => 2,
                                                'name' => '相册订单'
                                ),
                                'drink' => array(
                                                'id' => 3,
                                                'name' => '酒水订单'
                                ),
                                'bless' => array(
                                                'id' => 4,
                                                'name' => '祝福礼物订单'
                                ),
                                'all_image' => array(
                                                'id' => 5,
                                                'name' => '相片整册购买'
                                )
                ),
                //配送状态
                'delivery_status' => array(
                                'no_delivery' => array(
                                                'id' => 0,
                                                'name' => '未配送'
                                ),
                                'success' => array(
                                                'id' => 1,
                                                'name' => '已配送'
                                )
                ),
                //配送类型
                'delivery_type' => array(
                                'express' => array(
                                                'id' => 0,
                                                'name' => '快递送货',
                                                'price' => '30'
                                ),
                                'ziti' => array(
                                                'id' => 1,
                                                'name' => '到百年婚宴自提'
                                )
                ),
                //产品详情表中产品类型
                'product_type' => array(
                                'image' => array(
                                                'id' => 1,
                                                'name' => '相片',
                                                'free_quota' => 10,
                                                'unit_price' => 19
                                ),
                                'album' => array(
                                                'id' => 2,
                                                'name' => '相簿'
                                ),
                                'drink' => array(
                                                'id' => 3,
                                                'name' => '酒水'
                                ),
                                'all_image' => array(
                                                'id' => 5,
                                                'name' => '相片整册购买'
                                
                                )
                ),
    
                'payment' => array(
                    'deposit' => array(
                       'id' => 1,
                       'name' => '定金款'
                    ),
                    'turnover' => array(
                        'id' => 2,
                        'name' => '营业款'
                    ),
                    'remaining' => array(
                        'id' => 3,
                        'name' => '尾款'
                    ),
                ),

                'pay_type' => array(
                    'cash' => [
                        'id' => 1,
                        'name' => '现金支付',
                    ],
                    'credit_card' => [
                        'id' => 2,
                        'name' => '刷卡支付',
                    ],
                    'wechatpay' => [
                        'id' => 3,
                        'name' => '微信支付',
                    ],
                    'alipay' => [
                        'id' => 4,
                        'name' => '支付宝支付',
                    ],
                    'transfer' => [
                        'id' => 5,
                        'name' => '定金转让',
                    ],
                    'unpay' => [
                        'id' => 6,
                        'name' => '未付定金',
                    ],
                ),
    
                'pay_type_archive' => array(
                    'cash' => [
                        'id' => 1,
                        'name' => '现金支付',
                    ],
                    'credit_card' => [
                        'id' => 2,
                        'name' => '刷卡支付',
                    ],
                    'wechatpay' => [
                        'id' => 3,
                        'name' => '微信支付',
                    ],
                    'alipay' => [
                        'id' => 4,
                        'name' => '支付宝支付',
                    ],
                    'coupon' => [
                        'id' => 5,
                        'name' => '代金券支付',
                    ],
    ),
);
