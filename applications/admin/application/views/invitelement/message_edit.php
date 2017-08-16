<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a>留言修改</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>留言修改</h1></legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">客户姓名*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php echo $info['name']?>" name="name" valType="required" msg="客户姓名不能为空" placeholder="请输入客户姓名">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">留言内容</label>
                <div class="col-sm-4">
                    <textarea rows="3" name="content" class="form-control" placeholder="请输入留言内容"><?php echo $info['content']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">出席人数*</label>
                <div class="col-sm-4">
                    <select class="form-control" name="wall_num" >
                        <?php foreach ($attend_num as $k => $v):?>
                        <option value="<?php echo $k?>" <?php if($info['wall_num'] == $k):?>selected="selected"<?php endif;?> ><?php if($k == 10):?>不出席<?php else:?> <?php echo $attend_num[$k]?>人 <?php endif;?></option>
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
var id="<?php echo $id?>"; 
var host_id="<?php echo $info['host_id']?>"; 
seajs.use(['<?php echo css_js_url('invitelement.js', 'admin')?>', 'jqvalidate'], function(a){
	a.message_edit();
})
</script>
</body>
</html>