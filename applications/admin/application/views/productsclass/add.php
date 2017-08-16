<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="">客户列表</a></li>
    <li class="active"><a href="#">添加商品类型</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加商品类型</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">分类*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="parent_id" >
                        <option value="0">顶级分类</option>
                        <?php foreach ($class as $k => $v):?>
                        <option value="<?php echo $v['id']?>" <?php if(isset($info['parent_id']) && $info['parent_id'] == $v['id']):?>selected<?php endif;?> ><?php echo str_repeat('——', $v['level']).$v['name'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分类名称*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" valType="required" msg="名称不能为空" placeholder="请输入名称" value="<?php echo isset($info['name']) && $info['name']?$info['name']:''?>">
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label><input type="radio" name="is_del" value="0" checked>正常</label>
                        <label><input type="radio" name="is_del" value="1">删除</label>
                    </div>
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
seajs.use(['<?php echo css_js_url('album.js', 'admin')?>', 'jqvalidate'], function(a){
	a.add_attributeclass();
})
</script>
</body>
</html>