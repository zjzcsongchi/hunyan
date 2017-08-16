<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-<?php echo $title?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
     <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('detail.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('ui-dialog.css', 'admin')?>">
</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container padtop100 padbot150" >     
        <div class="page-main shop-cont">
            <p class="head-title">购物车</p>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="8" class="top">全部商品<a href="javascript:;" style="display:none">结算</a><p class="text1" style="display:none">已选商品<span>0.00</span></p></td>
                </tr>
                <tr class="head">
                    <td width="55" class="t-l"><input type="checkbox" class="all" name="all"></td>
                    <td width="175" class="t-l">全选</td>
                    <td width="430" class="t-l">商品信息</td>
                    <td width="100">规格</td>
                    <td width="100">单价</td>
                    <td width="155">数量</td>
                    <td width="130">小计</td>
                    <td>操作</td>
                </tr>
                
             
            </table>
        </div>
        <div class="page-bg"></div>
        <div class="popup-del">
            <div class="close"></div>
            <p class="title">删除商品</p>
            <p class="text">确认要删除该商品吗？</p>
            <a href="javascript:;">确定</a>
            <a href="javascript:;" class="qx">关闭</a>
        </div>
        <div class="popup-info">
            <div class="close"></div>
            <p class="title">填写收货信息</p>
            <ul>
                <li>
                    <p class="head">收货人：</p>
                    <input name="name" type="text" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x771F;&#x5B9E;&#x59D3;&#x540D;">
                    <p class="text">必填<span>*</span></p>
                </li>
                <li>
                    <p class="head">电话：</p>
                    <input name="tel" type="text" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x8054;&#x7CFB;&#x7535;&#x8BDD;">
                    <p class="text">必填<span>*</span></p>
                </li>
                <li >
                    <p class="head">送货方式：</p>
                    <select name="delivery_type" id="delivery_type">
                    <?php foreach ($delivery_type as $k=>$v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php endforeach;?>
                    </select>
                    <p class="text">邮费:<span><?php echo C('order.delivery_type.express.price')?></span>元</p>
                </li>
                <li id="address">
                    <p class="head">送货地址：</p>
                    <input name="address" type="text" class="width" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x60A8;&#x7684;&#x6536;&#x8D27;&#x5730;&#x5740;">
                    <p class="text">必填<span>*</span></p>
                </li>
            </ul>
            <p class="message"></p>
            <a href="javascript:;" class="but" id="submit">提交信息</a>
        </div>
    </div>
    <div class="bottom-cont">        
        <div class="bottom-con">
            <div class="car"><p class="product_num">0</p></div>
            <p class="text">已选中 <span class="product_num">0</span> 件商品</p>
            <div class="r">
                <p class="price">总计：￥<span id="price">0.00</span></p>
                <a href="javascript:;" class="but" id="pay">立即结算</a>
                <a href="javascript:;" class="but unable" style="display: none;">立即结算</a>
            </div>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    
     <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
    var status = "<?php echo $status?>";
    var sum = 0;
    seajs.use(['<?php echo css_js_url('car.js', 'www')?>'], function(a){
		a.load();
		a.add_reduce();
		a.checkall();
		a.checkone();
		a.del();
		a.submit();
		a.dump();
		a.post();
    })
    </script>
</body>
</html>
