<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">资讯管理</a></li>
        <li><a href="#">添加资讯类别</a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span>添加资讯类别</span></div>
    <form action="" method="post">
        <ul class="forminfo">
            <li>
                <label>父级分类<b>*</b></label>
                <?php if(isset($id)):?>
                <input type="hidden" name="id" value="<?php echo $id;?>" />
                <?php endif;?>
                <select class="dfinput selects" name="parent_id" required>
                    <option value="">---请选择父级分类---</option>
                    <option value="0" <?php if(isset($info) && $info['parent_id'] == 0){ echo "selected"; }?>>一级分类</option>
                    <?php foreach($parent_class as $val):?>
                    <option value="<?php echo $val['id']?>" <?php if(isset($info) && $val['id'] == $info['parent_id']) { echo "selected"; } ?>><?php echo $val['name'];?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li>
                <label>类别名称<b>*</b></label>
                <input type="text" name="name" class="dfinput" value="<?php if(isset($info)) { echo $info['name']; } ?>" required />
            </li>
            <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
        </ul>
    </form>
</div>
<?php $this->load->view('common/footer');?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>