<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/album/index">客户列表</a></li>
    <li class="active"><a href="#">添加客户</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    
    <ul class="nav nav-tabs">
		<li><a href="#customer_case" data-toggle="tab">商品属性</a></li>
	</ul>
	<br>   

        <form class="form-horizontal " >
        <input type="hidden" data-id="<?php echo $products_id?>" id="products_id" name="products_id" value="<?php echo $products_id?>"> 
            <div class="tab-pane" id="customer_case">
            <div class="form-group dinner_marry">
                <label class="col-sm-2 control-label">属性名称</label>
                <div class="col-sm-2">
                    <input type="text"  name="attr_name[]" class="form-control" placeholder="属性名称"  valType="required" msg="名称不能为空">
                </div>
                
                <div class="col-sm-1">
                    <input type="text"  name="attr_value[]" class="form-control" placeholder="属性值"  valType="required" msg="值不能为空">
                </div>
                <div class="col-sm-1 text-center">
                <input  value="添 加" class="btn btn-danger" style="width:80px" id="load_attr">
                </div>
            </div>
            <?php if(isset($attr_lists) && $attr_lists):?>
            <?php foreach ($attr_lists as $k=>$v):?>
                <div class="form-group dinner_marry">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                        <input type="text"  name="attr_name[]" class="form-control" placeholder="型号"  valType="required" msg="名称不能为空" value="<?php echo $v['attribute']?>">
                    </div>
                    <div class="col-sm-1">
                        <input type="text"  name="attr_value[]" class="form-control" placeholder="价格"  valType="required" msg="名称不能为空" value="<?php echo $v['value']?>">
                    </div>
                    <div class="col-sm-1 text-center">
                    <input  value="删 除" class="btn btn-danger version_del" style="width:80px" >
                    </div>
                </div>
            <?php endforeach;?>
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

seajs.use(['<?php echo css_js_url('album.js', 'admin')?>','admin_uploader','jqvalidate','bootstrap','jqueryswf'], function(a){
	a.version_del();
	a.load_attr();
	a.save_attr();
})


</script>
</body>
</html>