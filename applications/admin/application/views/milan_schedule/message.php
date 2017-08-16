<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>米兰国际 - 收件箱</title>

    
    
    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $domain['static']['url'].'/milan_mobile/font-awesome/css/font-awesome.css';?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('animate.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('style-milan.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    

</head>

<body class="pace-done">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu" style="display: block;">
                    <li>
                        <a href="/milanschedule/index"><i class="fa fa-th-large"></i> <span class="nav-label">主页</span> </a>
                    </li>

                    <li>
                        <a href="mailbox.html">
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
							<h5>档期消息 - <?php echo $staff_type;?></h5>
							<div class="ibox-tools">
                                <a href="/milanschedule/index">
                                    <i class="fa fa-mail-reply"></i> 返回
                                </a>
                           </div>
						</div>
						<div class="ibox-content">           
                            <table class="table table-striped">
                            	<thead>
                            		<tr>
                            			<th>场地</th>
                            			<th>时间</th>
                            			<th>档期管理</th>
                            			<th>执行单管理</th>
                            		</tr>
                            	</thead>
                            	<tbody>
                            	<?php if(isset($list)):?>
                                <?php foreach ($list as  $k => $v):?>
                            		<tr>
                            			<td><?php echo $v['venue']?></td>
                            			<td><?php echo $v['schedule_time']?></td>
                            			<td>
<?php switch($v['status']): ?>
<?php case $status['unread']['status']:?>
    <a href="/milanschedule/schedule_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-danger ">档期详情<br>(未 确 认)</a>                  
<?php break;?>

<?php case $status['confirm']['status']:?>
<a href="/milanschedule/schedule_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-primary ">档期详情<br>(已 确 认)</a>
<?php break;?>

<?php case $status['refuse']['status']:?>
<a href="/milanschedule/schedule_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-warning ">档期详情<br>(已 拒 绝)</a>
<?php break;?>
<?php endswitch;?>
                            		    </td>
                            		    
                            		    <td>
                                		    <?php if($v['status'] == $status['confirm']['status'] && $v['receipt']):?>
                                                <?php if($v['receipt']['status'] == $status['unread']['status']):?>
                                                   <a href="/milanschedule/receipt_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-danger" >执行详情<br>(未 确 认)</a>
                                                <?php elseif($v['receipt']['status'] == $status['refuse']['status']):?>
                                                   <a href="/milanschedule/receipt_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-warning" >执行详情<br>(已 拒 绝)</a>
                                                
                                                <?php else:?>
                                                    <?php if($v['receipt']['examination_status'] == $examination_status['checking']['id']):?>
                                                       <a href="/milanschedule/receipt_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-warning" >执行详情<br>(审 核 中)</a>
                                                    <?php elseif($v['receipt']['examination_status'] == $examination_status['confirm']['id']):?>
                                                       <a href="/milanschedule/receipt_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-primary" >执行详情<br>(审核通过)</a>
                                                    <?php else:?>
                                                       <a href="/milanschedule/receipt_detail?menu_id=<?php echo $v['menu_id']?>"  class="btn btn-xs btn-outline btn-danger" >执行详情<br>(审核失败)</a>
                                                    <?php endif?>
                                                <?php endif?>
                            		           
                            		        <?php elseif($v['status'] == $status['confirm']['status']):?>
                            		           <a  href="/milanschedule/add_receipt?menu_id=<?php echo $v['menu_id']?>" class="btn btn-xs btn-outline btn-warning " > 自填<br>执行单 </a>
                            		        <?php endif?>
                                		    
                            		    </td>
                            		</tr>
                            	<?php endforeach;?>
                                <?php endif;?>
                            	</tbody>
                            </table>
                            <!-- 分页 start -->
                        	<div class="text-center">
                        		<div class="row">
                        			<nav >
                        			<ul class="pagination">
                        			    <li class="disabled"><a>共<?php echo isset($count) ? $count: '0';?>条</a></li>
                        			    <?php echo isset($pagestr) ? $pagestr : ''?>
                        			</ul>
                        			</nav>
                        		</div> 
                        	</div>
                            <!-- 分页 end -->
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
    

    <!-- Mainly scripts -->
    <script src="<?php echo css_js_url('jquery-2.1.1.min.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('bootstrap.min.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('plugins/metisMenu/jquery.metisMenu.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('plugins/slimscroll/jquery.slimscroll.min.js','milan_mobile');?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo css_js_url('hplus.js','milan_mobile');?> "></script>


</body>
</html>