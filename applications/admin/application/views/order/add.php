<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/order">预定添加</a></li>
        <li><a href="/order/add">添加</a></li>
    </ul>
</div>  

<div class="formbody">
    <div class="formtitle"><span>添加</span></div>
    <form action="" method="post">
        <ul class="forminfo">
            <li><label>商品分类</label>
                <select id="class_id" class="dfinput selects" valType="required" msg="分类不能为空">
                    <option value="">---请选择酒水分类---</option>
                    <?php foreach ($type as $k => $v): ?>
                    <option value="<?php echo $v['id'];?>"><?php echo $v['cn_name']?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li><label>商品列表</label>
                <select id="goods" class="dfinput selects" name="drink_id" valType="required" msg="分类不能为空">
                    <option value="">---请选择酒水---</option>
                </select>
            </li>
            <li><label>收货人</label><input name="user_name" type="text" class="dfinput" valType="required" msg="收货人不能为空"  /><b>*</b></li>
            <li><label>收货电话</label><input type="text" name="user_mobile" class="dfinput" valType="MOBILE" msg="请填写正确的手机号" /><b>*</b></li>
            <li><label>收货地址</label><input type="text" name="user_addr" class="dfinput" valType="required" msg="收货地址不能为空" /><b>*</b></li>
            <li><label>数量<b></b></label><input type="text" name="num" value="1" class="dfinput" /></li>
            <li><label>配送方式</label>
                <select id="goods" class="dfinput selects" name="post_method" valType="required" msg="必须选择一个配送方式">
                    <option value="">---请选择配送方式---</option>
                    <?php foreach (C('post_method') as $k => $v):?>
                        <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
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
        })
    </script>
 
</body>
</html>