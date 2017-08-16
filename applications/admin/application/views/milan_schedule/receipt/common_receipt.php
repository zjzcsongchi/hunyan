<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="renderer" content="webkit">
    <title>米兰国际 - 收件箱</title>
    
    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $domain['static']['url'].'/milan_mobile/font-awesome/css/font-awesome.css';?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('animate.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('style-milan.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('receipt.css', 'admin')?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('my_dialog.css', 'admin')?>" type="text/css" rel="stylesheet"/>
    
    <style>
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        background-color: #fff;
    }
    </style>
</head>

<body class="pace-done">
    <div id="wrapper" class="receipt">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu" style="display: block;">
                    <li>
                        <a href="/milanschedule/index"><i class="fa fa-th-large"></i> <span class="nav-label">主页</span> </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fa fa-envelope"></i> 
                            <span class="nav-label">档期消息 </span>
                            <?php if($unread_message_count > 0):?>
                            <span class="label label-warning pull-right"><?php echo $unread_message_count;  ?></span>
                            <?php endif?>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/milanschedule/unread_message">新消息</a>
                            </li>
                            <li><a href="/milanschedule/all_message">所有消息</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="/milanschedule/schedule"><i class="fa fa-calendar"></i> <span class="nav-label">档期日历</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" href="/milanschedule/unread_message">
                                <i class="fa fa-bell"></i>  
                                <span class="label label-warning">
                                    <?php echo $unread_message_count;  ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/milanschedule/logout"><i class="fa fa-sign-out"></i> 退出</a>
                        </li>
                    </ul>

                </nav>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>执行单详情</h5>
							<div class="ibox-tools">
                                <a href="javascript:window.history.go(-1)">
                                    <i class="fa fa-mail-reply"></i> 返回
                                </a>
                           </div>
                        </div>
                        <div class="ibox-content">
                            <!-- 模板 start -->
                            <div class="container-fluid">
                                <form class="form-horizontal">
                                	
<?php switch($staff_type_id): ?>
<?php case C('milan_staff_type.emcee.id'):?>
                                    <p class="text-center lead">
                                		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                		<strong>主持人执行单</strong>
                                	</p>
                                	
                                	<p style="text-indent:20px;">
                                    	公司指定委派婚礼主持人<b><?php echo $staff_name?></b> 老师，
                                    	共计 <b> <?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?> </b>人，
                                	          于 于 <b><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</b>，
                                    	
                                    	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	 负责婚礼庆典的彩排、主持仪式服务工作，望按时保质保量圆满完成此项工作。
                                     </p>
	
                            		
<?php break;?>

<?php case C('milan_staff_type.photographer.id'): ?>
                                    <p class="text-center lead">
                                        <strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                        <strong>摄像师执行单</strong>
                                    </p>
                                    
                                    <p style="text-indent:20px;">
                                    	公司委派婚礼摄像师<b><?php echo $staff_name?></b> 老师，
                                    	共计 <b> <?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?> </b>人，
                                	          于 <b><?php echo $receipt['start_time']  ?> </b>
                                    	至<b><?php echo $receipt['end_time'] ?> </b>，
                                    	
                                    	<?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	 负责<b><?php echo $receipt['duty']?></b>摄像及制作工作，望按时保质保量圆满完成此项工作。        
                                     </p>
                                     
                                     <div class="form-group">
                                       <label class="control-label col-sm-3" >机器要求：</label>
                                       <div class="col-sm-9">
                                           <div class="col-sm-6" >
                                    	        
                                    	                    摄像机 <b><?php echo isset($receipt['other']['video_camera']) ? $receipt['other']['video_camera'] : '0';?></b> 台(摄像)
                                            </div>
                                            
                                            <div class="col-sm-6" >
                                    	        
                                    	                    摄影机<b><?php echo isset($receipt['other']['photo_camera']) ? $receipt['other']['photo_camera'] : '0';?></b> 台(拍照)
                                            </div>
                                        </div>
                                    </div>
    
<?php break;?>

<?php case C('milan_staff_type.light_technician.id'): ?>
                                    <p class="text-center lead">
                                        <strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                        <strong>灯光师执行单</strong>
                                    </p>
                                    <p style="text-indent:20px;">
                                    	公司指定灯光技术总监<b><?php echo $staff_name?></b> 老师，
                                    	共计 <b> <?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?> </b>人，
                                	          于 <b><?php echo $receipt['start_time']  ?> </b>
                                    	至<b><?php echo $receipt['end_time'] ?> </b>，
                                    	
                                    	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	 负责<b><?php echo $receipt['duty']?></b>声光电技术工作，望按时保质保量圆满完成此项工作。 
                                     </p>

    
<?php break;?>

<?php case C('milan_staff_type.cosmetician.id'): ?>
                                    <p class="text-center lead">
                                        <strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                        <strong>化妆师执行单</strong>
                                    </p>
                                    <p style="text-indent:20px;">
                                    	公司指定委派婚礼化妆师<b><?php echo $staff_name?></b> 老师，
                                    	于 <b><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</b>， 
                                    	
                                    	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	负责新娘婚礼彩妆造型的服务工作，望按时保质保量圆满完成此项工作。 
                                     </p>

                                    <div class="form-group">
                            			<ul>
                            			    <li>服务时间：化妆师将于 <b> <?php echo isset($receipt['other']['service_time1'])&&$receipt['other']['service_time1'] ? str_replace('T', ' ', $receipt['other']['service_time1']) : '' ?> </b> 到百年婚宴 <b> <?php echo isset($receipt['other']['service_room'])&&$receipt['other']['service_room'] ? $receipt['other']['service_room'] : '' ?> </b> 化妆间，化妆流程至最后一个妆面至婚宴结束。</li>
                            			    <li>服务时间：化妆师将于 <b> <?php echo isset($receipt['other']['service_time2'])&&$receipt['other']['service_time2'] ? str_replace('T', ' ', $receipt['other']['service_time2']) : '' ?> </b> 到新娘家化妆，化妆流程至最后一个妆面至婚宴结束。</li>
                            			    <li>服务内容：
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_content][home]" <?php echo isset($receipt['other']['service_content']['home']) ? "checked" : '' ;?> >上门化妆</label>
                            			        </div>
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_content][half]" <?php echo isset($receipt['other']['service_content']['half']) ? "checked" : '' ;?> />半程跟妆</label>
                            			        </div>
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_content][whole]" <?php echo isset($receipt['other']['service_content']['half']) ? "checked" : '' ;?> >全程跟妆</label>
                            			        </div>
                            			    </li>
                            			    <li>提供项目：
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][false_eyelash]" <?php echo isset($receipt['other']['service_project']['false_eyelash']) ? "checked" : '' ;?> />假睫毛</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][hair_decorate]" <?php echo isset($receipt['other']['service_project']['hair_decorate']) ? "checked" : '' ;?> />发饰</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][accessory]" <?php echo isset($receipt['other']['service_project']['accessory']) ? "checked" : '' ;?> >配饰</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][powder_puff]" <?php echo isset($receipt['other']['service_project']['powder_puff']) ? "checked" : '' ;?> >粉扑</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][early_makeup]" <?php echo isset($receipt['other']['service_project']['early_makeup']) ? "checked" : '' ;?> >早妆</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][follow_makeup]" <?php echo isset($receipt['other']['service_project']['follow_makeup']) ? "checked" : '' ;?> >跟妆</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][bridesmaid_makeup]" <?php echo isset($receipt['other']['service_project']['bridesmaid_makeup']) ? "checked" : '' ;?> >伴娘妆 
                            			         <b><?php echo isset($receipt['other']['service_project_bridesmaid_count'])&&$receipt['other']['service_project_bridesmaid_count'] ? $receipt['other']['service_project_bridesmaid_count'] : '0' ;?> </b> 个</label> 

                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][ma_makeup]" <?php echo isset($receipt['other']['service_project']['ma_makeup']) ? "checked" : '' ;?> >妈妈妆  
                            			         <b><?php echo isset($receipt['other']['service_project_monther_count'])&&$receipt['other']['service_project_monther_count'] ? $receipt['other']['service_project_monther_count'] : '0' ;?> </b> 个</label>
                            			     </div>
                            			     <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_project][other]" <?php echo isset($receipt['other']['service_project']['other']) ? "checked" : '' ;?> >其他  
                            			         <b><?php echo isset($receipt['other']['service_project_other_count'])&&$receipt['other']['service_project_other_count'] ? $receipt['other']['service_project_other_count'] : '无' ;?> </b> </label>
                            			     </div>
                            			    </li>
                            			    <li>服务地点：
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_place][bainian]" <?php echo isset($receipt['other']['service_place']['bainian']) ? "checked" : '' ;?> >百年婚宴</label>
                            			        </div>
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_place][town]" <?php echo isset($receipt['other']['service_place']['town']) ? "checked" : '' ;?> >市区</label>
                            			        </div>
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_place][suburb]" <?php echo isset($receipt['other']['service_place']['suburb']) ? "checked" : '' ;?> >郊区</label>
                            			        </div>
                            			        <div class="checkbox-inline">
                            			         <label><input type="checkbox"  name="other[service_place][county]" <?php echo isset($receipt['other']['service_content']['county']) ? "checked" : '' ;?> >县城</label>
                            			        </div>
                            			    </li>
                            			</ul>
                            	    </div>

    
<?php break;?>

<?php case C('milan_staff_type.following_photographer.id'): ?>
                                    <p class="text-center lead">
                                        <strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                        <strong>跟拍师执行单</strong>
                                    </p>
                                    <p style="text-indent:20px;">
                                    	公司指定委派婚礼跟拍师<b><?php echo $staff_name?></b> 老师，
                                    	共计 <b> <?php echo isset($receipt['other']['staff_count']) ? $receipt['other']['staff_count'] : '';?> </b>人，
                                	          于 <b><?php echo $receipt['start_time']  ?> </b>
                                    	至<b><?php echo $receipt['end_time'] ?>  </b>，
                                    	
                                    	 <?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	 负责<b><?php echo $receipt['duty']?></b>跟拍及制作工作，望按时保质保量圆满完成此项工作。 
                                     </p>
                                     
                                    <div class="form-group">
                                       <label class="control-label col-sm-3" >机器要求：</label>
                                       <div class="col-sm-9">
                                           <div class="col-sm-6" >
                                    	                    数码相机：<b><?php echo isset($receipt['other']['video_camera']) ? $receipt['other']['video_camera'] : '0';?> </b> 台
                                            </div>
                                    
                                        </div>
                                    </div>

    
<?php break;?>

<?php case C('milan_staff_type.layout.id'): ?>
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

    
<?php break;?>

<?php case C('milan_staff_type.florist.id'): ?>
                                    <p class="text-center lead">
                                		<strong>安顺市米兰婚礼策划有限公司</strong><br/>
                                		<strong>金美花艺执行单</strong>
                                	</p>
                                	<p style="text-indent:20px;">
                                    	公司指定金美花艺<mark><?php echo $staff_name?></mark> 老师，
                                    	于 <mark><?php echo $menu['year']?>年<?php echo $menu['month']?>月<?php echo $menu['day']?>日</mark>，
                                    	<?php $this->load->view('milan_schedule/receipt/venue_info_by_type')?>
                                    	 负责<input type="text" name="duty" value="<?php echo isset($receipt['duty']) ? $receipt['duty'] : '';?>" >
                                    	 花艺工作（手捧花、胸花、手腕花、主婚车头花），望按时保质保量圆满完成。 
                                	 </p>
   
<?php break;?>
<?php endswitch;?>


                            		<p><strong>◆执行过程中如有以下问题出现，根据下列情况从当天执行费中扣除：</strong></p>
                            		<?php if( isset($receipt['error_content'])):?>
                                        <textarea class="form-control" rows="8" readonly name="error_content"><?php echo $receipt['error_content'];?></textarea>
                                    <?php endif?>
                                    
                                    <p><strong>◆备注：</strong></p>
                        		    <textarea rows="3" class="form-control" readonly name="remark"><?php echo isset($receipt['remark']) ? $receipt['remark'] : '';?></textarea>

                        		    <div class="form-group">
                                    	<ul>
                                    	    <li>米兰套餐：<?php echo $menu['menus']?>。</li>
                                    	    <li>婚宴主题：<?php echo $menu['theme']?>。</li>
                                        </ul>  
                                    </div>
                                    
                                    <div class="form-group">
                                    	<ul>
                                    	    <li class="col-sm-6">宴会负责人： <?php echo $menu['responsible_person']?> </li>
                                    	    <li class="col-sm-6">套系价格：<?php echo $menu['menus']?> </li>
                                        </ul>
                                    </div>
                                        
                                	<p>此次执行费用共计￥<b> <?php echo isset($receipt['money']) ? $receipt['money'] : '';?></b> 元；
                                	大写人民币 <b><?php echo isset($receipt['chinese_money']) ? $receipt['chinese_money'] : '';?></b> 元整</p>
                                    
                                   
                                    <div class="cont" style="margin-top:10px; font-size: small;">
                                        <div class="cont50">经办人签字：<mark><?php echo isset($receipt['operator']) ? $receipt['operator'] : ''; ?></mark></div>
                                        <div class="cont50">执行人签字：<mark><?php echo isset($receipt['status']) && $receipt['status']!=0 ? $staff_name : ''; ?></mark></div>
                                        
                                        <div class="cont50">开单日期：<mark><?php echo isset($receipt['create_time']) ? $receipt['create_time'] : ''; ?></mark></div>
                                        <div class="cont50">签字日期：<mark><?php echo isset($receipt['confirm_time']) ? $receipt['confirm_time'] : ''; ?></mark></div>
                                    </div>

                                    <input type="hidden" name="menu_id" value="<?php echo $menu_id;?>"/>
                                    <input type="hidden" name="staff_type_id" value="<?php echo $staff_type_id;?>"/>
                                </form>
                               
                                    <p class="text-center row" style="margin-top:10px;">
                                        <?php if($receipt['status'] == $status['unread']['status']):?>
                            		        <a href="javascript:;" data-id="<?php echo $receipt['id'];?>" data-status="<?php echo $status['confirm']['status']?>" class="confirm_receipt btn btn-outline btn-primary">确认执行</a>
                            		        <a href="javascript:;" data-id="<?php echo $receipt['id'];?>" data-status="<?php echo $status['refuse']['status']?>" class="confirm_receipt btn btn-outline btn-warning">拒绝执行</a>
                                        <?php elseif($receipt['status'] == $status['refuse']['status']):?>
                                             <a href="javascript:;" data-id="<?php echo $menu_id;?>" class="btn btn-outline btn-warning disabled" style="color:white">已拒绝</a>
                                        <?php else:?>
                                                <?php if($receipt['examination_status'] == $examination_status['checking']['id']):?>
                                                   <a href="javascript:;" data-id="<?php echo $menu_id;?>" class="btn btn-outline btn-primary disabled" style="color:white">审核中...</a>

                                                <?php elseif($receipt['examination_status']  == $examination_status['confirm']['id']):?>
                                                  
                                                   <a href="javascript:;" data-id="<?php echo $menu_id;?>" class="btn btn-outline btn-primary disabled" style="color:white">审核通过</a>
                                                <?php else:?>

                                                   <a href="javascript:;" data-id="<?php echo $menu_id;?>" class="btn btn-outline btn-danger disabled" style="color:white">审核失败</a>
                                                   <a href="/milanschedule/add_receipt?menu_id=<?php echo $menu_id?>" class="btn btn-outline btn-primary" >重新填写 </a>
                                                   <p><strong>◆审核不通过原因：</strong></p>
                        		                   <textarea rows="3" class="form-control" readonly name="remark"><?php echo isset($receipt['examination_reson']) ? $receipt['examination_reson'] : '';?></textarea>
                                                   
                                                  
                                                <?php endif?>
                                        <?php endif?>
                                    </p>  
                                
                                
                            </div>
                            <!-- 模板 end -->
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="footer">
                <div class="pull-right">
                   
                </div>
                <div>
                    <strong>Copyright</strong> H+ © 2014
                </div>
            </div>

        </div>
    </div>
    

   <?php $this->load->view('common/footer')?>
   <script>
        seajs.use([ 
		   '<?php echo css_js_url('milan_receipt.js', 'admin')?>',
		   '<?php echo css_js_url('my_dialog.js', 'admin')?>',
           'wdate',
           'bootstrap',
           '<?php echo css_js_url('plugins/metisMenu/jquery.metisMenu.js','milan_mobile');?>',
           '<?php echo css_js_url('plugins/slimscroll/jquery.slimscroll.min.js','milan_mobile');?>',
           '<?php echo css_js_url('hplus.js','milan_mobile');?>'
        ], function(milan_receipt, my_dialog){

          $(document).ready(function () {
            $('.confirm_receipt').on('click',function(){
                _this = $(this);
                $.ajax({  
                url : "/milanschedule/confirm_receipt",
                type : "post",  
                dataType : "json",
                data: {id: _this.data('id'), status: _this.data('status')},  
                success : function(res) {
                  if(res.status == 0) {
                    my_dialog.alert('执行单操作成功', function(){
                      window.location.href = document.referrer;
                    });
                    _this.addClass('disabled');

                  } else {
                    my_dialog.alert('操作失败, 请重新确认!');
                  }
                },
                error: function() {
                  my_dialog.alert('网络异常, 请重新确认!');
                }
                });
            });
          });
             
        })
    </script>

</body>
</html>