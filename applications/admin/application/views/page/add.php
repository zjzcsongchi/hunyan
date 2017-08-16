<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/template/index">页面列表</a></li>
    <li class="active"><a href="#">添加页面</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加页面</h1></legend>
        <form class="form-horizontal">
        
            <div class="form-group">
                <label class="col-sm-2 control-label">序号*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sort" value="0" valType="required" msg="排序不能为空">
                    <input type="hidden" class="form-control" name="template_id" value="<?php echo $template_id?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"></textarea>
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
	var template_id = "<?php echo $template_id?>";
    seajs.use(['<?php echo css_js_url('template.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.save_page();
    })
</script>
</body>
</html>