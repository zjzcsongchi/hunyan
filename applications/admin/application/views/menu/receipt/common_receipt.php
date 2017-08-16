<html>
<head>
<link href="<?php echo css_js_url('receipt.css', 'admin')?>" type="text/css" rel="stylesheet"/>
</head>
<body >
<!--startprint-->
<div class="container-fluid receipt">
	<form class="form-horizontal" id="form_receipt">
	
<?php switch($staff_type_id): ?>
<?php case C('milan_staff_type.emcee.id'):?>
        <p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>主持人执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定委派婚礼主持人<mark><?php echo $staff_name?></mark> 老师，
        	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>，
        	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责婚礼庆典的彩排、主持仪式服务工作，望按时保质保量圆满完成此项工作。
    	 </p>

		<p><strong> ◆主持执行执行过程中如有以下问题出现，根据下列情况从当天执行费中扣除：</strong></p>
		<?php if( 0 && isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo C('milan_staff_type.emcee.template');?>

            </textarea>
        <?php endif?>

<?php break;?>

<?php case C('milan_staff_type.photographer.id'):?>
        <p class="text-center lead">
        	<strong>安顺市米兰婚礼策划有限公司</strong><br/>
        	<strong>摄像师执行单</strong>
        </p>
        <p style="text-indent:20px;">
        	公司委派婚礼摄像师<mark><?php echo $staff_name?></mark> 老师，
        	共计  <input type="text" name="other[staff_count]" value="<?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?>" class="input-small" >人，
    	          于 <input type="text" name="start_time" value="<?php echo isset($receipt['start_time'])&&$receipt['start_time'] ? $receipt['start_time'] : '' ?>" class="Wdate-ymd glorify"  >
        	至<input name="end_time" value="<?php echo isset($receipt['end_time'])&&$receipt['end_time'] ? $receipt['end_time'] : '' ?>" class="Wdate-ymd glorify" type="text"  >，
        	
        	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" class="glorify">摄像及制作工作，望按时保质保量圆满完成此项工作。        
         </p>
         
        <div class="form-group small">
           <label class="control-label col-sm-2" >机器要求：</label>
           <div class="col-sm-8">
               <div class="col-sm-6" >
        	        <input type="checkbox" <?php echo isset($receipt['other']['video_camera'])&&$receipt['other']['video_camera']>0 ? 'checked' : '';?>>
        	                    摄像机<input type="text" class="glorify" style="width: 50px;" name="other[video_camera]" value="<?php echo isset($receipt['other']['video_camera']) ? $receipt['other']['video_camera'] : '0';?>" >台(摄像)
                </div>
                
                <div class="col-sm-6" >
        	        <input type="checkbox" <?php echo isset($receipt['other']['video_camera'])&&$receipt['other']['photo_camera']>0 ? 'checked' : '';?> >
        	                    摄影机<input type="text" class="glorify" style="width: 50px;" name="other[photo_camera]" value="<?php echo isset($receipt['other']['photo_camera']) ? $receipt['other']['photo_camera'] : '0';?>" >台(拍照)
                </div>
            </div>
        </div>
        
    	
		<p><strong> ◆摄像执行过程中如有以下问题出现，每项过失处罚，从当天执行费中扣除：</strong></p>
		<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" class="glorify" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" class="glorify" rows="8" name="error_content">
1.摄像画面模糊不清，扣50元
2.视频内容出现画面晃动、倾斜等，扣50元
3.视频内容新人名字打错、日期打错，扣10元
4.摄像师未着工装、仪容仪表不标准，每人每次10元
5.未准时参加下午18:00会议，每人每次扣10元
6.因摄像出现严重失误，被客人投诉或拒绝付费，宋涛负责承担直接经济损失。
            </textarea>
        <?php endif?>
        

<?php break;?>

<?php case C('milan_staff_type.light_technician.id'):?>
<p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>灯光执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定灯光技术总监<mark><?php echo $staff_name?></mark> 老师，
        	共计  <input type="text" name="other[staff_count]" value="<?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?>" class="input-small">人，
        	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>，
        	<?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" >声光电技术工作，望按时保质保量圆满完成此项工作。 
    	 </p>
    	 	
		<p><strong> ◆灯光执行过程中如有以下问题出现，每项过失处罚，从当天执行费中扣除：</strong></p>
		<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content">
1.因舞台背景灯全部聚焦在摄像机镜头前方，影响摄像画面曝光，扣50元
2.因婚礼前未检查灯光、线路、开关，灯光未固定好，影响婚礼庆典效果，扣100元
3.因灯光秀前10分钟未打开烟雾机预热，影响灯光效果，扣50元
4.因烟雾机未在灯光秀结束后关闭，影响摄像效果，扣20元
5.婚礼庆典的灯光秀编排及音乐，须经总经理审核确认后方可使用，私自使用未经总经理审核确认的灯光秀编排及音乐，扣50元
6.第三方婚庆公司进入前，通知后未收回灯具，扣50元
7.灯光师未着工装、仪容仪表不标准，每人每次扣10元
8.未准时参加下午18:00会议，每每人每次扣10元
9.因灯光出现严重失误，被客人投诉或拒绝付费，邱峰负责承担直接经济损失。
            </textarea>
        <?php endif?>

<?php break;?>

<?php case C('milan_staff_type.cosmetician.id'):?>
<p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>化妆师执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定委派婚礼化妆师 <mark><?php echo $staff_name?></mark> 老师，
        	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>， 
        	<?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	负责新娘婚礼彩妆造型的服务工作，望按时保质保量圆满完成此项工作。
    	</p>
    	<div class="form-group">
    	<ul>
    	    <li>服务时间：化妆师将于 <input  type="text" class="Wdate-ymdhm"  name="other[service_time1]" value="<?php echo isset($receipt['other']['service_time1'])&&$receipt['other']['service_time1'] ? str_replace('T', ' ', $receipt['other']['service_time1']) : '' ?>" > 到百年婚宴 <input type="text" name="other[service_room]" value="<?php echo isset($receipt['other']['service_room'])&&$receipt['other']['service_room'] ? $receipt['other']['service_room'] : '' ?>" > 化妆间，化妆流程至最后一个妆面至婚宴结束。</li>
    	    <li>服务时间：化妆师将于 <input  type="text" class="Wdate-ymdhm" name="other[service_time2]" value="<?php echo isset($receipt['other']['service_time2'])&&$receipt['other']['service_time2'] ? str_replace('T', ' ', $receipt['other']['service_time2']) : '' ?>" >到新娘家化妆，化妆流程至最后一个妆面至婚宴结束。</li>
    	    <li>服务内容：
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_content][home]" <?php echo isset($receipt['other']['service_content']['home']) ? "checked" : '' ;?> >上门化妆</label>
    	        </div>
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_content][half]" <?php echo isset($receipt['other']['service_content']['half']) ? "checked" : '' ;?> />半程跟妆</label>
    	        </div>
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_content][whole]" <?php echo isset($receipt['other']['service_content']['half']) ? "checked" : '' ;?> >全程跟妆</label>
    	        </div>
    	    </li>
    	    <li>提供项目：
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][false_eyelash]" <?php echo isset($receipt['other']['service_project']['false_eyelash']) ? "checked" : '' ;?> />假睫毛</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][hair_decorate]" <?php echo isset($receipt['other']['service_project']['hair_decorate']) ? "checked" : '' ;?> />发饰</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][accessory]" <?php echo isset($receipt['other']['service_project']['accessory']) ? "checked" : '' ;?> >配饰</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][powder_puff]" <?php echo isset($receipt['other']['service_project']['powder_puff']) ? "checked" : '' ;?> >粉扑</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][early_makeup]" <?php echo isset($receipt['other']['service_project']['early_makeup']) ? "checked" : '' ;?> >早妆</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][follow_makeup]" <?php echo isset($receipt['other']['service_project']['follow_makeup']) ? "checked" : '' ;?> >跟妆</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label>
    	         <input type="checkbox" name="other[service_project][bridesmaid_makeup]" <?php echo isset($receipt['other']['service_project']['bridesmaid_makeup']) ? "checked" : '' ;?> >伴娘妆 <input type="text" name="other[service_project_bridesmaid_count]" value="<?php echo isset($receipt['other']['service_project_bridesmaid_count']) ? $receipt['other']['service_project_bridesmaid_count'] : '' ;?>" style="width:35px; "> 个
    	         </label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][ma_makeup]" <?php echo isset($receipt['other']['service_project']['ma_makeup']) ? "checked" : '' ;?> >妈妈妆 <input type="text" name="other[service_project_monther_count]" value="<?php echo isset($receipt['other']['service_project_monther_count']) ? $receipt['other']['service_project_monther_count'] : '' ;?>" style="width:35px;"> 个</label>
    	     </div>
    	     <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_project][other]" <?php echo isset($receipt['other']['service_project']['other']) ? "checked" : '' ;?> >其他 <input type="text" name="other['service_project_other_count']" value="<?php echo isset($receipt['other']['service_project_other_count']) ? $receipt['other']['service_project_other_count'] : '' ;?>" style="width:100px;"></label>
    	     </div>
    	    </li>
    	    <li>服务地点：
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_place][bainian]" <?php echo isset($receipt['other']['service_place']['bainian']) ? "checked" : '' ;?> >百年婚宴</label>
    	        </div>
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_place][town]" <?php echo isset($receipt['other']['service_place']['town']) ? "checked" : '' ;?> >市区</label>
    	        </div>
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_place][suburb]" <?php echo isset($receipt['other']['service_place']['suburb']) ? "checked" : '' ;?> >郊区</label>
    	        </div>
    	        <div class="checkbox-inline">
    	         <label><input type="checkbox" name="other[service_place][county]" <?php echo isset($receipt['other']['service_content']['county']) ? "checked" : '' ;?> >县城</label>
    	        </div>
    	    </li>
    	</ul>
    	</div>
    	
    	<p><strong> ◆化妆执行过程中如有以下问题出现，每项10元过失处罚，从当天执行费中扣除：</strong></p>
    	<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content">
1.睫毛脱落。
2.未使用一线品牌化妆品（RMK、阿玛尼、 香奈儿、蜜丝佛陀、3CE、贝玲妃、纪梵希、露华浓、樱之朗、迪奥、艾米尔、MAC、芭比布朗）。
3. 对客微笑服务，须着工装，仪容仪表。
4. 迟到1-10分钟10元，迟到10分钟以上（含10分钟）100元。
5. 遭客人投诉造成损失，承担直接经济损失。
            </textarea>
        <?php endif?>

<?php break;?>

<?php case C('milan_staff_type.following_photographer.id'):?>
        <p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>最美婚礼跟拍师执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定委派婚礼跟拍师<mark><?php echo $staff_name?></mark> 老师，
        	共计  <input type="text" name="other[staff_count]" value="<?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?>" class="input-small">人，
        	于 <input type="text" class="Wdate-ymd" name="start_time" value="<?php echo isset($receipt['start_time'])&&$receipt['start_time'] ? $receipt['start_time'] : '' ?>" >
        	至<input type="text" class="Wdate-ymd" name="end_time" value="<?php echo isset($receipt['end_time'])&&$receipt['end_time'] ? $receipt['end_time'] : '' ?>"  >，

        	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" >跟拍及制作工作，望按时保质保量圆满完成此项工作。        
    	 </p>
    	 
        <div class="form-group small">
           <label class="control-label col-sm-2" >机器要求：</label>
           <div class="col-sm-8">
               <div class="col-sm-6" >
        	        <input type="checkbox" <?php echo isset($receipt['other']['video_camera'])&&$receipt['other']['video_camera']>0 ? 'checked' : '';?>>
        	                    数码相机<input type="text" style="width: 50px;" name="other[video_camera]" value="<?php echo isset($receipt['other']['video_camera']) ? $receipt['other']['video_camera'] : '0';?>" >台
                </div>

            </div>
        </div>
        		
		<p><strong> ◆跟拍执行过程中如有以下问题出现，根据下列情况从当天执行费中扣除：</strong></p>
		<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content">
1.照片画面模糊不清，扣50元
2.照片张数未达到打包价含的数量， 扣100元                 
3.上交照片的新人名字打错、日期打错，扣30元
3.跟拍师未着工装、仪容仪表不标准，每人每次10元
4.未准时参加下午18:00会议，每人每次扣10元
6.因跟拍出现严重失误，被客人投诉或拒绝付费，最美跟拍负责人承担直接经济损失。
            </textarea>
        <?php endif?>

<?php break;?>

<?php case C('milan_staff_type.layout.id'):?>
        <p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>场布师执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定场布师 <mark><?php echo $staff_name?></mark> 老师，
        	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>，
        	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" > 场景布置和现场执行工作，望按时保质保量圆满完成此项工作
    	 </p>
    	 		
		<p><strong>◆执行过程中如有以下问题出现，根据下列情况从当天执行费中扣除：</strong></p>
		<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content">
1.场布师未着工装、仪容仪表不标准，每人每次扣10元
2.每场婚礼场布13:00未交场，扣20元
3.每个厅舞台上的道具、布艺、花艺卫生不合格，每场扣30元
4.场布的风格、颜色未根据客人要求搭建，扣50元
6.泡泡机、追光灯、帕灯、舞台灯主持中途出现故障，扣60元
7.未按照撤场标准撤场，扣100元
8.细节中出现问题，督导通知整改，未执行，扣100元
9.舞台周围摆放杂物，扣200元
10.因场布出现严重失误，被客人投诉或拒绝付费，负责承担直接经济损失
            </textarea>
        <?php endif?>

<?php break;?>

<?php case C('milan_staff_type.florist.id'):?>
        <p class="text-center lead">
    		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
    		<strong>金美花艺执行单</strong>
    	</p>
    	<p style="text-indent:20px;">
        	公司指定金美花艺 <mark><?php echo $staff_name?></mark> 老师，
        	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>，
        	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
        	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" > 
        	 花艺工作（手捧花、胸花、手腕花、主婚车头花），望按时保质保量圆满完成。 
    	 </p>
    	 		
		<p><strong>◆执行过程中如有以下问题出现，根据下列情况从当天执行费中扣除：</strong></p>
		<?php if( isset($receipt['error_content'])):?>
            <textarea class="form-control" rows="8" name="error_content"><?php echo $receipt['error_content'];?></textarea>
        <?php else:?>
            <textarea class="form-control" rows="8" name="error_content">
1.花艺颜色未能符合大厅主题颜色的标准，扣5元；
2.花材未能保证新鲜度，扣10元；
3.接亲主婚车头未能按客人提出的标准执行，扣30元；
4.与客人约定的扎花时间未准时到达酒店指定地方、迟到10分钟以下扣5元，迟到10分钟以上，扣50元；
5.出现以上任何一项问题，除了扣费而外，必须按照客人要求标准重新执行，如未能及时执行，扣除100元。出现相同情况3次以上，自动取消合作关系；
6.因花艺上出现严重失误，被客人投诉或拒绝付费，由邓礼鑫负责承担直接经济损失
            </textarea>
        <?php endif?>

<?php break;?>
<?php endswitch;?>	
    	
    	<div class="form-group">
    	    <label class="col-sm-12" >备注：</label>
    	    <div class="col-sm-12">
    		    <textarea rows="3" class="form-control" name="remark"><?php echo isset($receipt['remark']) ? $receipt['remark'] : '';?></textarea>
    	    </div>
    	</div>
    	
    	<div class="cont" style="margin-top:10px; font-size: small;">
            <div class="cont50">米兰套餐：<mark><?php echo $menu['menus']?></mark></div>
            <div class="cont50">婚宴主题：<mark><?php echo $menu['theme']?></mark></div>
            
            <div class="cont50">宴会负责人：<mark><?php echo $menu['responsible_person']?></mark></div>
            <div class="cont50">套系价格：<mark><?php echo $menu['menus']?></mark></div>
        </div>
        
        <div class="cont" style="margin-top:10px; font-size: small;">
            <div class="cont50">此次费用共计￥：<input type="text" name="money" value="<?php echo isset($receipt['money']) ? $receipt['money'] : '';?>">元</div>
            <div class="cont50">大写人民币： <input type="text" name="chinese_money" value="<?php echo isset($receipt['chinese_money']) ? $receipt['chinese_money'] : '';?>"></div>
        </div>
    	

    	<div class="cont" style="margin-top:10px; font-size: small;">
                <div class="cont50">经办人签字：<mark><?php echo isset($receipt['operator']) ? $receipt['operator'] : ''; ?></mark></div>
                <div class="cont50">执行人签字：<mark><?php echo isset($receipt['status']) && $receipt['status']!=0 ? $staff_name : ''; ?></mark></div>
                
                <div class="cont50">开单日期：<mark><?php echo isset($receipt['create_time']) ? $receipt['create_time'] : ''; ?></mark></div>
                <div class="cont50">签字日期：<mark><?php echo isset($receipt['confirm_time']) ? $receipt['confirm_time'] : ''; ?></mark></div>
        </div>

    	<div class="col-sm-12 text-center" style="margin-top:10px;">
            <a class="btn btn-primary btn-receipt-save no_print" style="margin-bottom:5px">保存</a>
        </div>
        
        <input type="hidden" name="menu_id" value="<?php echo $menu_id;?>"/>
        <input type="hidden" name="staff_type_id" value="<?php echo $staff_type_id;?>"/>
    </form>
</div>
<!--endprint-->
<?php $this->load->view('common/footer')?>
<script>
    seajs.use([ '<?php echo css_js_url('public.cmd.js', 'admin')?>', 'spin_lib', '<?php echo css_js_url('milan_receipt.js', 'admin')?>', 'wdate'], function(pub,spin,receipt){
        receipt.print();
        receipt.conversion_money();

    	$(function(){
    	  $(".Wdate-ymdhm").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})
   	  	  });

     	  $(".Wdate-ymd").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM-dd'})
     	  });

          $(".btn-receipt-save").on("click", function(){
              var spiner = spin.show();
              var para = $("#form_receipt").serialize();
              $.ajax({
                type:'post',
                url:'/menu/save_receipt',
                data: para,
                dataType:'json',
                success:function(res){
                  spin.close(spiner);
                  if(res.status == 0){
                    pub.showDialog(res.msg, '', function(){
                      window.location.reload();
                    });
                  }else{
                    pub.showDialog(res.msg);
                  }
                },
                error:function(){
                  spin.close(spiner);
                  pub.showDialog('网络出错，请稍后再试');
                }
              })
          });

      	});

    })
</script>
</body>
</html>

