<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>米兰国际 - 收件箱</title>

    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $domain['static']['url'].'/milan_mobile/font-awesome/css/font-awesome.css';?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('animate.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('style-milan.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('my_dialog.css', 'admin')?>" type="text/css" rel="stylesheet"/>

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
                            <h5>档期详情</h5>
							<div class="ibox-tools">
                                <a href="/milanschedule/index">
                                    <i class="fa fa-mail-reply"></i> 返回
                                </a>
                           </div>
                        </div>
                        <div class="ibox-content">
                             <table class="table table-bordered table-hover">
                                <tr>
                                    <th class="active">新郎</th>
                                    <td><?php echo $info['roles_main']?></td>
                                    <th class="active">新娘</th>
                                    <td><?php echo $info['roles_wife']?></td>
                                </tr>

                                <tr>
                                    <th class="active">大厅</th>
                                    <td><?php echo $info['venue_name']?></td>
                                    
                                    <th class="active">宴会日期</th>
                                    <td><?php echo $info['solar_time']?></td>
                                </tr>
                                
                                <?php foreach ($staffs as $k => $v):?>
                                <tr>
                                    <?php if($v['id'] == $userInfo['id']):?>
                                    <th class="active"><?php echo $v['group']?></th>
                                    <td> <?php echo $v['fullname']?></td>
                                    <?php endif;?>
                                    
                                </tr>
                                <?php endforeach;?>

                                <tr>
                                    <th class="active">套餐</th>
                                    <td><?php echo $info['menus']?><?php if(isset($info['price'])){echo '【'.$info['price'].'元】';}?></td>
                                    <th class="active">主题</th>
                                    <td><?php echo $info['theme']?></td>
                                </tr>
                                
                            </table>
                            <div class="text-center">
                            <?php if($schedule_info['status']==0):?>
                		        <a href="javascript:;" data-id="<?php echo $schedule_info['id']?>" data-status="<?php echo $status['confirm']['status']?>" class="confirm_schedule btn btn-outline btn-primary">确认档期</a>
                		        <a href="javascript:;" data-id="<?php echo $schedule_info['id']?>" data-status="<?php echo $status['refuse']['status']?>" class="confirm_schedule btn btn-outline btn-warning">拒绝档期</a>
                            <?php endif?>
                            </div>
                            
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
            $('.confirm_schedule').on('click',function(){
                _this = $(this);
                $.ajax({  
                url : "/milanschedule/confirm_schedule",
                type : "post",  
                dataType : "json",
                data: {'id': _this.data('id'), 'status': _this.data('status')},  
                success : function(res) {
                  if(res.status == 0) {
                    my_dialog.alert('操作成功', function(){
                      window.location.href = document.referrer;
                    });
                    _this.addClass('disabled');

                  } else {
                    my_dialog.alert('档期操作失败, 请重新确认!');
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