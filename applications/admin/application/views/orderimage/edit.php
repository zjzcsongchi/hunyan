<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/orderimage">相册订单管理</a></li>
    <li class="active">修改相册订单</li>
</ol>

<div class="container-fluid" style="margin:10px; margin-bottom: 250px;">
    <fieldset>
        <legend>修改相册订单信息</legend>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label">客户姓名：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['realname']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">客户手机号：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['mobile_phone']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">订单号：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['order_id']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">支付方式：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['pay_type_text']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">支付金额：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['need_pay']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">优惠金额：</label>
                <div class="col-sm-4">
                    <input type="text" disabled class="form-control" value="<?php echo $info['favorable']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">送货方式：</label>
                <div class="col-sm-4">
                    <select name="delivery_type" class="form-control">
                        <option value="0" <?php if($info['delivery_type'] == 0) echo 'selected';?>>快递送货</option>
                        <option value="1" <?php if($info['delivery_type'] == 1) echo 'selected';?>>上门自提</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">收货人姓名：</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="address_name" value="<?php if($info['address']) echo $info['address']['name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">收货人手机号：</label>
                <div class="col-sm-4">
                    <input type="text" name="address_mobile_phone" class="form-control" value="<?php if($info['address']) echo $info['address']['mobile_phone'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">收货地址：</label>
                <div class="col-sm-4">
                    <input type="text" name="address" class="form-control" value="<?php if($info['address']) echo $info['address']['address'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">快递公司：</label>
                <div class="col-sm-4">
                    <input type="text" name="express_company" class="form-control" value="<?php echo $info['express_company']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">快递单号：</label>
                <div class="col-sm-4">
                    <input type="text" name="express_number" class="form-control" value="<?php echo $info['express_number']?>">
                </div>
            </div>
            <input type="hidden" name="product_type" value="<?php echo $info['detail'][0]['product_type']?>">
            <!-- 订单中为相片产品 -->
            <?php if($info['detail'][0]['product_type'] == C('order.product_type.image.id')):?>
            <div class="form-group">
                <label class="col-sm-2 control-label">所选相片：</label>
                <div class="col-sm-10">
                    <!-- nav tab -->
                    <ul class="nav nav-tabs" role="tablist">
                      <?php if($images):?>
                      <?php foreach ($images as $k => $v):?>
                      <li role="presentation" class="<?php if($k == 0) echo 'active';?>"><a href="#image_<?php echo $k?>" role="tab" data-toggle="tab"><?php echo $v['name']?></a></li>
                      <?php endforeach;?>
                      <?php endif;?>
                    </ul>
                    <!-- nav panes -->
                    <div class="tab-content">
                      <?php if($images):?>
                      <?php foreach ($images as $k => $v):?>
                      <div role="tabpanel" class="tab-pane <?php if($k == 0) echo 'active';?>" id="image_<?php echo $k?>">
                        <?php for($i = 0; $i < ceil(count($v['images'])/6); $i++):?>
                        <div class="row">
                        <?php for($j = $i*6; $j < ($i+1)*6 && $j < count($v['images']); $j++):?>
                        <div class="col-sm-2">
                            <label>
                            <input type="checkbox" name="image_id[]" <?php if(array_key_exists($v['images'][$j]['id'], $buy_images)) echo 'checked'?> value="<?php echo $v['images'][$j]['id']?>"><img style="width:100%" src="<?php echo get_img_url($v['images'][$j]['sy_img'])?>">
                            </label>
                        </div>
                        <?php endfor;?>
                        </div>
                        <?php endfor;?>
                      </div>
                      <?php endforeach;?>
                      <?php endif;?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            
            <!-- 订单中为相册产品 -->
            <?php if($info['detail'][0]['product_type'] == C('order.product_type.album.id')):?>
            <div class="form-group">
                <label class="col-sm-2 control-label">所选相册：</label>
                <div class="col-sm-10">
                    <?php if($album):?>
                        <?php for($i = 0; $i < ceil(count($album)/6); $i++):?>
                        <div class="row">
                        <?php for($j = $i*6; $j < ($i+1)*6 && $j < count($album); $j++):?>
                        <div class="col-sm-2">
                            <label>
                            <input type="checkbox" name="image_id[]" <?php if(array_key_exists($album[$j]['id'], $buy_images)) echo 'checked'?> value="<?php echo $album[$j]['id']?>"><img style="width:100%" src="<?php echo get_img_url($album[$j]['cover_img'])?>">
                            <?php echo $album[$j]['title']?>
                            <input type="text" name="image_id_count[]" value="<?php if(isset($buy_images[$album[$j]['id']])) echo $buy_images[$album[$j]['id']]?>" class="form-control">
                            </label>
                        </div>
                        <?php endfor;?>
                        </div>
                        <?php endfor;?>
                    <?php endif;?>
                </div>
            </div>
            <?php endif;?>
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">
	seajs.use(['bootstrap'])
</script>
</body>
</html>