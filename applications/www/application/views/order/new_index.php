<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目名称</title>
    <meta name="keywords" content="&#x9879;&#x76EE;&#x5173;&#x952E;&#x8BCD;">
    <meta name="description" content="&#x9879;&#x76EE;&#x63CF;&#x8FF0;">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('pc-public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('pc-user.css', 'www');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body class="grey">
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <?php $this->load->view('common/user_banner')?>
        <div class="page-main padbot200">
            <?php $this->load->view('common/user_leftmenu')?>
            <div class="user-right">
                <p class="max-title">我的订单</p>
                <ul class="order-nav">
                    <li><a href="/order/index" <?php if($type == 0):?>class="act" <?php endif;?>>全部订单</a></li>
                    <li><a href="/order/index/<?php echo C('order.product_type.image.id')?>" <?php if($type == C('order.product_type.image.id')):?>class="act"<?php endif;?>>相片</a></li>
                    <li><a href="/order/index/<?php echo C('order.product_type.album.id')?>" <?php if($type == C('order.product_type.album.id')):?>class="act"<?php endif;?>>相册</a></li>
                    <li><a href="/order/index/<?php echo C('order.product_type.drink.id')?>" <?php if($type == C('order.product_type.drink.id')):?>class="act"<?php endif;?>>酒水</a></li>
                </ul>
                <ul class="order-list">
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k => $v):?>
                        <?php if($v['order_type'] == C('order.product_type.image.id')):?>
                        <li>
                            <div class="cont1">
                                <p class="title">订单号  <?php echo $v['order_id']?></p>
                                <p class="price"><del>原价￥<?php echo $v['favorable']+$v['need_pay'];?></del>￥<?php echo $v['need_pay']?></p>
                            </div>
                            <div class="img-comt"><img src="<?php if(isset($v['cover_img'])){echo get_img_url($v['cover_img']);}?>"><p class="num"><?php if(isset($v['num']) && $v['num'] >0){echo $v['num'];}?></p></div>
                            <div class="cont">                            
                                <div class="text1"><p class="z">总</p>共有<span> <?php echo $v['num']?></span> 张照片</div>
                                <div class="text1"><p class="h">惠</p>百年婚宴免费赠送<span> 10 </span>张  </div>
                            </div>                           
                            
                            <div class="but">
                                <?php if(C('order.pay_status.success.id') != $v['status']):?>
                                    <a href="javascript:;" id="del_order" data="<?php echo $v['id']?>" class="cancel">取消订单</a>
                                <?php endif;?>
                                
                                <a href="/order/order_detail?id=<?php echo $v['id']?>" class="detail">订单详情</a>
                                <a href="javascript:;" class="topay <?php if(C('order.pay_status.success.id') == $v['status']){echo 'unable';}elseif(C('order.pay_status.fail.id') == $v['status']){echo 'error';}else{echo 'use';}?>">
                                    <?php foreach (C('order.pay_status') as $kk => $vv):?>
                                        <?php if($v['status'] == $vv['id']):?>
                                        <?php echo $vv['name']?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </a>
                            </div>
                            
                            
                        </li>
                        <?php elseif ($v['order_type'] == C('order.product_type.album.id')):?>
                        <li>
                            <div class="cont1">
                                <p class="title">订单号  <?php echo $v['order_id']?></p>
                                <p class="price">￥<?php echo $v['need_pay']?></p>
                            </div>
                            <div class="img-comt">
                            <img src="<?php if(isset($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                            </div>
                            <div class="cont">
                                <p class="text2"><?php echo isset($v['name']) ?$v['name']:'' ?></p>
                                    <?php if(isset($products[$v['id']]) && $products[$v['id']]):?>
                                    <?php foreach ($products[$v['id']] as $key=>$val):?>
                                        <?php if(isset($special_name[$val['special_id']])):?>
                                        <div class="text1"><?php echo $special_name[$val['special_id']]?></div>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                <div class="text1">数量：<?php echo $v['count']?></div>
                                
                            </div>
                             <div class="but">
                                <?php if(C('order.pay_status.success.id') != $v['status']):?>
                                    <a href="javascript:;" id="del_order" data="<?php echo $v['id']?>" class="cancel">取消订单</a>
                                <?php endif;?>
                                
                                <a href="/order/order_detail?id=<?php echo $v['id']?>" class="detail">订单详情</a>
                                <a href="javascript:;" class="topay <?php if(C('order.pay_status.success.id') == $v['status']){echo 'unable';}elseif(C('order.pay_status.fail.id') == $v['status']){echo 'error';}else{echo 'use';}?>">
                                    <?php foreach (C('order.pay_status') as $kk => $vv):?>
                                        <?php if($v['status'] == $vv['id']):?>
                                        <?php echo $vv['name']?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </a>
                            </div>
                        </li>
                        
                        <?php elseif ($v['order_type'] == C('order.product_type.drink.id')):?>
                        <li>
                            <div class="cont1">
                                <p class="title">订单号  <?php echo $v['order_id']?></p>
                                <p class="price">￥<?php echo $v['need_pay']?></p>
                            </div>
                            <?php if(isset($products[$v['id']])):?>
                            <?php foreach ($products[$v['id']] as $kk=>$vv):?>
                            <div class="cont1">
                                <div class="img-comt">
                                <?php if(isset($special[$vv['special_id']]['version_image'])):?>
                                <img src="<?php echo get_img_url($special[$vv['special_id']]['version_image'])?>">
                                <?php else:?>
                                <img src="<?php if(isset($products_img[$vv['product_id']])){echo get_img_url($products_img[$vv['product_id']]);}?>">
                                <?php endif;?>
                                </div>
                                <div class="cont">
                                    <p class="text2">
                                    <?php if(isset($products_name[$vv['product_id']]) && $products_name[$vv['product_id']]):?>
                                    <?php echo $products_name[$vv['product_id']]?>
                                    <?php endif;?>
                                    </p>
                                    <?php if(isset($special_name[$vv['special_id']])):?>
                                        <div class="text1">规格：<?php echo $special_name[$vv['special_id']]?></div>
                                    <?php endif;?>
                                    <div class="text1">数量：<?php echo $vv['count']?></div>
                                </div>
                                <p class="unit">￥
                                <?php if(isset($special[$vv['special_id']]['version_price'])):?>
                                <?php echo $special[$vv['special_id']]['version_price']?>
                                <?php else:?>
                                <?php echo $present_price[$vv['product_id']]?>
                                <?php endif;?>
                                </p>
                            </div>
                            <?php endforeach;?>
                            <?php endif;?>
                            <div class="cont1" style="display:none">
                                <div class="img-comt"><img src="temp/p15.jpg"></div>
                                <div class="cont">
                                    <p class="text2">茅台迎宾酒</p>
                                    <div class="text1">规格：500ml（2瓶装）</div>
                                    <div class="text1">数量：1</div>
                                </div>
                                <p class="unit">￥20.00</p>
                            </div>
                            <div class="but">
                                <?php if(C('order.pay_status.success.id') != $v['status']):?>
                                    <a href="javascript:;" id="del_order" data="<?php echo $v['id']?>" class="cancel">取消订单</a>
                                <?php endif;?>
                                
                                <a href="/order/order_detail?id=<?php echo $v['id']?>" class="detail">订单详情</a>
                                <a href="javascript:;" class="topay <?php if(C('order.pay_status.success.id') == $v['status']){echo 'unable';}elseif(C('order.pay_status.fail.id') == $v['status']){echo 'error';}else{echo 'use';}?>">
                                    <?php foreach (C('order.pay_status') as $kk => $vv):?>
                                        <?php if($v['status'] == $vv['id']):?>
                                        <?php echo $vv['name']?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </a>
                            </div>
                        </li>
                        
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                    <li style="display:none">
                        <div class="cont1"></div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>

    
    <div class="popup-userinfo">
        <p class="title"><span>会员基本信息</span>（百年婚宴将会对您的所有信息严格保密，请放心填写）</p>
        <div class="close"></div>
        <div class="head-cont">
            <div class="head"><img src="temp/head.jpg"></div>
            <p>点击头像更换</p>
        </div>
        <ul>
            <li>
                <p>姓名</p>
                <input type="text" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x59D3;&#x540D;">
            </li>
            <li>
                <p>用户名</p>
                <input type="text" value="&#x94BB;&#x77F3;&#x5973;&#x58EB;">
            </li>
            <li>
                <p>性别</p>
                <select>
                    <option value="1">男</option>
                    <option value="2">女</option>
                </select>
            </li>
            <li>
                <p>出生日期</p>
                <input type="text" placeholder="1990-00-00">
            </li>
            <li>
                <p>手机号</p>
                <input type="text" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x624B;&#x673A;&#x53F7;">
            </li>
            <li>
                <p>现居地址</p>
                <textarea placeholder="&#x8BF7;&#x8F93;&#x5165;&#x73B0;&#x5C45;&#x5730;&#x5740;"></textarea>
            </li>
        </ul>
        <p class="message">错误提示</p>
        <div class="but-cont">
            <a href="javascript:;">取消</a>
            <a href="javascript:;" class="but">保持提交</a>
        </div>
    </div>

    <div class="page-bg"></div>
    <div class="order-popup to-cancel">
        <p class="title1">确定要取消当前订单吗？</p>
        <a href="javascript:;" class="no">否</a>
        <a href="javascript:;" class="yes">是</a>
    </div>
    <div class="order-popup">
        <p class="title2">订单已取消</p>
        <a href="javascript:;" class="succes">完成</a>
    </div>
    

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public', '<?php echo css_js_url('order_pc.js', 'www')?>'], function(a,b){
		a.load();
		b.del();
		b.hidden();
		$(".user-banner .edit").click(function() {
            $(".page-bg").addClass("act");
            $(".popup-userinfo").addClass("act");
        });
        $(".popup-userinfo .close").click(function() {
            $(".page-bg").removeClass("act");
            $(".popup-userinfo").removeClass("act");
        });
		b.jump();
    })
    </script>
   
</body>
</html>
