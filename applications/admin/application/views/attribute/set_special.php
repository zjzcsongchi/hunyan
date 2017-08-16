<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/album/index">客户列表</a></li>
    <li class="active"><a href="#">添加客户</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    
    <ul class="nav nav-tabs">
		<li><a href="#customer_case" data-toggle="tab">商品规格</a></li>
	</ul>
	<br>   

        <form class="form-horizontal " >
        <input type="hidden" data-id="<?php echo $products_id?>" id="products_id" name="products_id" value="<?php echo $products_id?>"> 
            <div class="tab-pane" id="customer_case">
                            <?php if(isset($specifications_lists) && $specifications_lists):?>
                <?php foreach ($specifications_lists as $k=>$v):?>
                <div class="form-group dinner_marry" sort="<?php echo $k?>">
                        <label class="col-sm-2 control-label"><?php if($k == 0):?>规格型号<?php endif;?></label>
                        <div class="col-sm-2">
                            <input type="text" id="version_name[]" name="version_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空" value="<?php echo $v['version_name']?>">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" id="version_price[]" name="version_price[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空" value="<?php echo $v['version_price']?>">
                        </div>
                        
                        <div class="col-sm-4">
                			<ul id="uploader_version_image_<?php echo $k?>">
                				<?php if($v['version_image']):?>
                                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                                        <a class='close del-pic' href='javascript:;'></a>
                                        <a href="<?php echo get_img_url($v['version_image'])?>" target="_blank"><img src="<?php echo get_img_url($v['version_image'])?>" style='width:100%;height:100%'/></a>
                                    </li>
                                <?php endif;?>
                                <input type="hidden" value="<?php echo $v['version_image']?>" name="version_image_<?php echo $k?>">
                                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                                    <a href="javascript:;" class="up-img"  id="btn_version_image_<?php echo $k?>"><span>+</span><br>添加照片</a>
                                </li>
                            </ul>
                		</div>
                        
                        <div class="col-sm-1 text-center">
                        <?php if($k == 0):?>
                        <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_special">
                        <?php else:?>
                        <input  value="删 除" class="btn btn-danger special_del" style="width:80px">
                        <?php endif;?>
                        </div>
                    </div>
                <?php endforeach;?>
                <?php else:?>
                <div class="form-group dinner_marry" sort="0">
                        <label class="col-sm-2 control-label">规格型号</label>
                        <div class="col-sm-2">
                            <input type="text" id="version_name[]" name="version_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空">
                        </div>
                        <div class="col-sm-1">
                            <input type="text" id="version_price[]" name="version_price[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空">
                        </div>
                        
                		<div class="col-sm-4">
                			<ul id="uploader_version_image_0">
                                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                                    <a href="javascript:;" class="up-img"  id="btn_version_image_0"><span>+</span><br>添加照片</a>
                                </li>
                            </ul>
                		</div>
                        <div class="col-sm-1 text-center">
                            <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_special">
                        </div>
                    </div>
                <?php endif;?>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">
var object2 = [];
for(var i=0;i<5;i++){
	object2[i] = {"obj": "#uploader_version_image_"+i, "btn": "#btn_version_image_"+i}
}
seajs.use(['<?php echo css_js_url('album.js', 'admin')?>','admin_uploader','jqvalidate','bootstrap','jqueryswf','swfupload'], function(a,swfUploader){
	a.save_special();
	a.special_del();
	a.version_del();
	a.load_special();
	swfUploader.swfupload(object2);
})


</script>
</body>
</html>