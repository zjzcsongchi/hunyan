<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/drinkappoint/index">酒水预定</a></li>
    <li class="active"><a href="#">修改预定</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>修改酒水预定</h1></legend>
        <form class="form-horizontal" action="/drinkappoint/edit?id=<?php echo $info['id']?>" method="post">
        <input type="hidden" name="products_id" value="<?php echo $info['id']?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">酒水类型 *</label>
                <div class="col-sm-4">
                    <select id="class_id" class="form-control input-lg" valType="required" msg="选择酒水类型" name="class_id">
                    <option value="">---请选择酒水分类---</option>
                    <?php foreach ($drink_class as $k=>$v):?>
                    <option value="<?php echo $k?>" <?php if($k == $class_id):?>selected<?php endif;?>><?php echo $v?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">酒水列表 *</label>
                <div class="col-sm-4">
                    <select class="form-control input-lg" valType="required" msg="选择酒水类型" name="drink_id" id="goods">
                    <option value="">---请选择酒水---</option>
                    <?php foreach ($products_lists as $k=>$v):?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['drink_id']):?>selected<?php endif;?>><?php echo $v['title']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">商品规格 </label>
                <div class="col-sm-4">
                    <select class="form-control input-lg" name="special_id" id="special">
                    <option value="">---请选择规格---</option>
                    <?php foreach ($special_lists as $k=>$v):?>
                    <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['special_id']):?>selected<?php endif;?>><?php echo $v['version_name']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
        
            <div class="form-group">
                <label class="col-sm-2 control-label">收货人*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="user_name" valType="required" msg="请填写收货人" placeholder="请填写收货人" value="<?php echo $info['user_name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">收货电话</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="user_mobile" valType="required" msg="请填写联系电话" placeholder="请填写联系电话" value="<?php echo $info['user_mobile']?>">
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">收货地址</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="user_addr" valType="required" msg="请填写收货地址" placeholder="请输入收货地址" value="<?php echo $info['user_addr']?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">数量</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="num"  value="<?php echo $info['num']?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">配送方式 *</label>
                <div class="col-sm-4">
                    <select  class="form-control input-lg" valType="required" msg="选择配送方式" name="post_method">
                    <option value="">---请选择配送方式---</option>
                    <?php foreach (C('post_method') as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['post_method']):?>selected<?php endif;?>><?php echo $v['name']?></option>
                    <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('jsdd.js', 'admin')?>','<?php echo css_js_url('jq.validate.js', 'admin')?>'], function(a){
			a.erji();
			a.autoadd();
			a.special();
        })
    </script>

</body>
</html>