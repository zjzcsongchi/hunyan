<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/add">客户列表</a></li>
        <li><a href="javascript:;">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>添加客户</span></div>
    <ul class="forminfo">
        <li><label>真实姓名</label><input name="realname" type="text" class="dfinput" required/><b>*</b></li>
        <li><label>昵称</label><input name="nickname" type="text" class="dfinput" /><i></i></li>
        <li><label>电话</label><input name="mobile_phone" type="text" class="dfinput" required/><b>*</b></li>
        <li><label>身份证号</label><input name="id_number" type="text" class="dfinput" /></li>
        <li><label>居住地址</label><input name="address" type="text" class="dfinput" /></li>
        <li><label>性别</label><input name="sex" type="radio"  value="1" checked="checked"  required />男
            <input name="sex" type="radio" value="2" required />女
        <li>
            <label>头像</label>
            <ul id="uploader_img_url">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_img_url"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li><label>&nbsp;</label><input  type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
</div>
<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jquery.swfupload.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('swfupload.js', 'admin')?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('admin_upload.js', 'admin');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('dialog.js', 'admin');?>"></script>
<script src="<?php echo css_js_url('jq.validate.js','admin');?>"></script>

<?php $this->load->view('common/footer');?>
<script>
     $("form").submit(function(e){
    	 e.preventDefault();
    	 var post_arr_data = $("form").serializeArray();
    	 $.post("",{arr:post_arr_data},function(data){
  			if(data.status == 0){
  				showDialog(data.msg, '', '/user');
  			}else{
  				showDialog(data.msg);
  			}
  			
  		  });
     })
     
     //电话判断
     $("input[name='mobile_phone']").blur(function(){
	     var mobile = $("input[name='mobile_phone']").val();
	     var isMobile=/^1[3|4|5|8|7][0-9]\d{8}$/;

         if(!isMobile.test(mobile)){
             $('input[name="mobile_phone"]').next("b").html("手机号码格式不正确");
             $('input[name="mobile_phone"]').focus();
             return false;
         }else{
        	 $('input[name="mobile_phone"]').next("b").html("*");
         }

     })
     
     //弹框函数
function showDialog(msg, title, url){
    var title = arguments[1] ? arguments[1] : '提示信息';
    var url = arguments[2] ? arguments[2] : '';
    var d = dialog({
        title: title,
        content: msg,
        modal:false,
        okValue: '确定',
        ok: function () {
            if(url != '')
            {
                window.location.href=url;
            }
            return true;
        }
    });
    d.width(320);
    d.show();
}
</script>
</body>
</html>