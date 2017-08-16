<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/order">预定列表</a></li>
        <li><a href="/order/edit">编辑</a></li>
    </ul>
</div>  

<div class="formbody">
    <div class="formtitle"><span>编辑</span></div>
    <form action="" method="post">
        <ul class="forminfo">
            <li><label>商品名称</label><input type="hidden" name="id" value="<?php echo $info['id'];?>"/><input disabled="disabled" type="text"  value="<?php echo $info['drink_title']?>" class="dfinput"  /><b>已锁定</b></li>
            <li><label>预定单号</label><input disabled="disabled" type="text"  value="<?php echo $info['order_num']?>" class="dfinput"  /><b>已锁定</b></li>
            <li><label>收货人</label><input type="text" name="user_name" value="<?php echo $info['user_name']?>" class="dfinput" valType="required" msg="收货人不能为空"  /><b>*</b></li>
            <li><label>收货电话</label><input type="text" name="user_mobile" value="<?php echo $info['user_mobile']?>" class="dfinput" valType="MOBILE" msg="请填写正确的手机号"  /><b>*</b></li>
            <li><label>收货地址</label><input type="text" name="user_addr" value="<?php echo $info['user_addr']?>" class="dfinput" valType="required" msg="收货地址不能为空" /><b>*</b></li>
            <li><label>单价<b></b></label><input type="text" id="unit_price" name="unit_price"  value="<?php echo $info['unit_price']?>" class="dfinput" valType="required" msg="单价必须填写" /></li>
            <li><label>数量<b></b></label><input type="text" id="num" name="num" value="<?php echo $info['num']?>" class="dfinput" valType="required" msg="数量必须填写" /></li>
            <li><label>总价<b></b></label><input type="text" id="price" name="price"  value="<?php echo $info['price']?>" class="dfinput" /></li>
            <li><label>配送方式</label>
                <select id="goods" class="dfinput selects" name="post_method" valType="required" msg="必须选择一个配送方式">
                    <option value="">---请选择配送方式---</option>
                    <?php foreach (C('post_method') as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['post_method']){echo 'selected';}?>><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li><label>预定状态</label>
                <select id="goods" class="dfinput selects" name="status" valType="required" msg="必须选择一个状态">
                    <option value="">---请选择状态---</option>
                    <?php foreach (C('order_status') as $k => $v):?>
                        <option value="<?php echo $v['id'] ?>" <?php if($v['id'] == $info['status']){echo 'selected';}?>><?php echo $v['name']?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
        </ul>
    </form>
</div>

<!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('jsdd.js', 'admin')?>','<?php echo css_js_url('jq.validate.js', 'admin')?>'], function(a){
			a.erji();
			a.autoadd()
        })
    </script>
 
</body>
</html>