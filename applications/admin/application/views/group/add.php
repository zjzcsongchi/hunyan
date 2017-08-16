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
        <li>
            
            <label>角色类型:</label>
            <select class="dfinput" name="role_type" id="role_type">
                <option value="-1">请选择</option>
                <?php foreach(C('public.role_type') as $key=>$val){ ?>
                <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                <?php } ?>
            </select>
            
            <i id="role-msg" style="color: red"></i>
        </li>
        
        <li>
            <label>角色名：</label><input name="name" required type="text" class="dfinput" id="name" />
            <i id="name-msg" style="color: red"></i>
        </li>
        
        <li><label>描述:</label><input name="describe" type="text" class="dfinput" id="describe" /><i></i></li>
        <input type="hidden" value="" id="token">
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="添加"/></li>
    </ul>
</div>
<?php $this->load->view("common/footer");?>
<script type="text/javascript">
    seajs.use(["<?php echo css_js_url('admingroup.js','admin');?>"], function(a){
        a.save();
        a.checkGroup();
        
    });
</script>

	</body>
</html>