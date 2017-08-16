<?php $this->load->view("common/header");?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href=/milanstaff><?php echo $title[0];?></a></li>
        <li><a href="#"><?php echo $title[1];?></a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span><?php echo $title[1];?></span></div>
    <ul class="forminfo">
        <li>
            <label>职员类型</label>
            <select class="dfinput selects" name="type">
                <?php foreach(C('milan_staff_type') as $key=>$val){ ?>
                <option value="<?php echo $val['id'];?>" <?php echo $info['type']==$val['id'] ? 'selected' : ''?> ><?php echo $val['name'];?></option>
                <?php } ?>
            </select>
           <i> <b>*</b></i>
        </li>
        
        <input type="hidden" id="id" value="<?php echo $info['id'];?>">
        
        <li>
            <label>登录名：</label><input name="name" type="text" class="dfinput" id="name" value="<?php echo $info['name'];?>"/>
            <i id="name-msg" style="color: red">*</i>
        </li>
        <li>
            <label>密码:</label><input name="password" type="password" class="dfinput" id="password" />
            <i  style="color: red">*</i>
        </li>
        <li><label>重复密码:</label><input name="confirpassword" type="password" class="dfinput" id="confirpassword" />
            <i id="confirpassword-msg" style="color: red">*</i>
        </li>
        <li><label>姓名:</label><input name="fullname" type="text" class="dfinput" id="fullname" value="<?php echo $info['fullname'];?>"/>
            <i  style="color: red">*</i>
        </li>
        <li>
            <label>手机:</label><input name="tel" type="text" class="dfinput" id="tel" value="<?php echo $info['tel'];?>" />
            <i id="tel-msg" style="color: red">*</i>
        </li>
        <li><label>Email:</label><input name="email" type="text" class="dfinput" id="email" value="<?php echo $info['email'];?>" /><i></i></li>
        
        <li><label>描述:</label><input name="describe" type="text" class="dfinput" id="describe" value="<?php echo $info['describe'];?>" /><i></i></li>
        <li><label>状态:</label>
            <input type="radio" value="1" name="disabled" checked>正常 &nbsp;&nbsp;
            <input type="radio" value="2" name="disabled" <?php echo $info['disabled'] == 2 ? 'checked' : ''; ?>>禁用</li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="修改"/></li>
    </ul>
</div>
<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js','common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('dialog.js','common');?>"></script>
<script type="text/javascript">
	$(function(){

		$(".btn").click(function(){
		
			var id = $("#id").val();
			var name = $('#name').val();
			var password = $('#password').val();
			var confirpassword = $('#confirpassword').val();
			var fullname = $('#fullname').val();
			var email = $('#email').val();
			var tel = $('#tel').val();
			var describe = $('#describe').val();
			var disabled = $("input:checked").val();
			var type=$('select[name=type]').val();
			if(name == ''){
				error('登陆名不能为空！');
				return false;
			}

			if(password != confirpassword){
				error('两次密码不一致！');
				return false;
			}
			if(fullname == ''){
				error('姓名不能为空！');
				return false;
			}
			if(tel == ''){
				error('手机号不能为空！');
				return false;
			}
			$.post(
				'/milanstaff/edit', 
				{
				  	'id':id,
					'name':name,
					'password':password,
					'confirpassword':confirpassword,
					'fullname':fullname,
					'email':email,
					'tel':tel,
					'describe':describe,
					'disabled':disabled,
					'type': type
				}, 
				function(data){
                    if(data){
						if(data.code == 1){
							success(data.msg);
						}else{
							error(data.msg);
						}
                    }else{
						error('网络异常！');
                    }
			   });
		});
  	})
  	function error(msg){
  		var d = dialog({
				id : 'FADO',
				title: '系统提示',
				content: msg,
	            width: 300,
	            okValue: '确定',
	            ok : function(){
					return true;
			    }		
  	  		})
  	  	  	d.showModal();
	}
	function success(msg){
  		var d = dialog({
				id : 'FADO',
				title: '系统提示',
				content: msg,
	            width: 300,
	            okValue: '确定',
	            ok : function(){
	            	window.location.href='/milanstaff';
					return true;
			    }		
  	  		})
  	  	  	d.showModal();
	}
</script>
<?php $this->load->view("common/footer");?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>
