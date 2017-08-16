<?php $this->load->view("common/header");?>
	<div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common/index">首页</a></li>
            <li><a href="#">系统设置</a></li>
        </ul>
    </div>
    <div class="formbody">
    <form  method="post" id="form">
        <div id="usual1" class="usual"> 
            <div class="itab">
              	<ul> 
                    <li><a href="#tab1" class="selected">前台设置</a></li> 
                    <li><a href="#tab2">后台设置</a></li> 
                    <li><a href="#tab3">微信设置</a></li>
              	</ul>
            </div> 
            
          	<div id="tab1" class="tabson">
                <ul class="forminfo" id="ul_1s">
                    <li>
                        <label>网站名称</label>
                        <input name="web_name" type="text" class="dfinput" value="<?php echo $list['web_name']?>"/><i></i>
                    </li>
                    <li>
                        <label>网站标语</label>
                        <input name="web_sign" type="text" class="dfinput" value="<?php echo $list['web_sign']?>"/><i></i>
                    </li>
                    <li>
                        <label>首页SEO标题</label>
                        <input name="seo_title" type="text" class="dfinput" value="<?php echo $list['seo_title']?>"/><i></i>
                    </li>
                    <li>
                        <label>首页SEO关键字</label>
                        <input name="seo_keywords" type="text" class="dfinput" value="<?php echo $list['seo_keywords']?>"/><i></i>
                    </li>
                    <li>
                        <label>首页SEO描述</label>
                        <textarea name="seo_description" class="textinput"><?php echo $list['seo_description']?></textarea>
                    </li>
                    <li>
                        <label>统计代码</label>
                        <textarea name="cnzz" class="textinput"><?php echo $list['cnzz']?></textarea>
                    </li>
                </ul>
                
            </div> 
            
          	<div id="tab2" class="tabson">
                <ul class="forminfo" id="ul_2s" >
                    <li>
                        <label>登录验证码</label>
                        <cite>
                            <input type="radio" name="verify" value="1" <?php if ($list['verify']==1):?>checked<?php endif;?>>启用
            				<input type="radio" name="verify" value="2" <?php if ($list['verify']==2):?>checked<?php endif;?>>禁用
                        </cite>
                    </li>
                </ul>
            </div>  
            <div id="tab3" class="tabson">
                <ul class="forminfo" id="ul_3s" >
                    <li>
                        <label>微信回复</label>
                        <textarea  name="weixin_huifu" class="textinput" /><?php echo $list['weixin_huifu']?></textarea>
                    </li>
                </ul>
            </div>
            <li style="padding-left:105px"><label>&nbsp;</label><input type="submit" class="btn" value="确认保存"/></li>
	    </div> 
    </form>
<?php $this->load->view("common/footer");?>
<script type="text/javascript"> 
    seajs.use("base", function(a) {
        a.initTabs();
    });
</script>
