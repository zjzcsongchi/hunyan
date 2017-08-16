<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/template/index">模板列表</a></li>
    <li class="active"><a href="#">修改模板</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>页面修改</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">序号*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="sort" value="<?php echo $info['sort']?>" valType="required" msg="排序不能为空">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">备注</label>
                <div class="col-sm-4">
                    <textarea class="form-control" name="remark" rows="4" placeholder="备注信息"><?php echo $info['remark']?></textarea>
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
	var id = "<?php echo $info['id']?>";
    seajs.use(['<?php echo css_js_url('template.js', 'admin')?>', 'jqvalidate'], function(a){
    	a.modify_page();
    })
</script>
</body>
</html>