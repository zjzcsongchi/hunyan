<?php $this->load->view("common/header");?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#"><?php echo $title[0];?></a></li>
        <li><a href="#"><?php echo $title[1];?></a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span><?php echo $title[1];?></span></div>
    <ul class="forminfo">
        <form action="" method="post">
        <li>
            <label>角色类型:</label>
            <select class="dfinput" name="role_type">
                <?php foreach(C('public.role_type') as $key=>$val){ ?>
                <option value="<?php echo $val['id'];?>" <?php echo $info['role_type'] == $val['id'] ? 'selected' : '';?> ><?php echo $val['name'];?></option>
                <?php } ?>
            </select>
            
            <i id="role-msg" style="color: red"></i>
        </li>
        
        <li>
            <label>角色名：</label><input name="name" value="<?php echo $info['name'];?>" required type="text" class="dfinput" id="name" />
            <i id="name-msg" style="color: red"></i>
        </li>
        <li><label>描述:</label><input name="describe" value="<?php echo $info['describe'];?>" type="text" class="dfinput" id="describe" /><i></i></li>
        <input type="hidden" value="" id="token">
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="编辑"/></li>
        </form>
    </ul>
</div>
<?php $this->load->view("common/footer");?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>