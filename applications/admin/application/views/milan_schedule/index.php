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
                        <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">档期消息 </span><span class="label label-warning pull-right"><?php echo $unread_message_count;  ?></span></a>
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
                            <a href="/milanschedule/logout">
                                <i class="fa fa-sign-out"></i> 退出
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>主页</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            
            <div class="row">
                <?php if ($unread_message_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=schedule_unread'>
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 未确认档期消息 </span>
                                    <h2 class="font-bold">
                                        <?php echo $unread_message_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($read_message_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=schedule_confirm'>
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 已确认档期消息 </span>
                                    <h2 class="font-bold">
                                        <?php echo $read_message_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($refuse_message_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=schedule_refuse'>
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 已拒绝档期消息 </span>
                                    <h2 class="font-bold">
                                        <?php echo $refuse_message_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($unread_receipt_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=receipt_unread'>
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 未确认执行单 </span>
                                    <h2 class="font-bold">
                                        <?php echo $unread_receipt_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($refuse_receipt_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=receipt_refuse'>
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 已拒绝执行单 </span>
                                    <h2 class="font-bold">
                                        <?php echo $refuse_receipt_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($checking_examination_receipt_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=receipt_examination_checking'>
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 待审核执行单 </span>
                                    <h2 class="font-bold">
                                        <?php echo $checking_examination_receipt_count;  ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($confirm_examination_receipt_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=receipt_examination_confirm'>
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 审核成功执行单 </span>
                                    <h2 class="font-bold">
                                        <?php echo $confirm_examination_receipt_count;?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                
                <?php if ($refuse_examination_receipt_count != 0):?>
                <div class="col-lg-3">
                    <a href='/milanschedule/message_by_kinds_of_if?condition=receipt_examination_refuse'>
                        <div class="widget style1 red-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-bell fa-4x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 审核失败执行单 </span>
                                    <h2 class="font-bold">
                                        <?php echo $refuse_examination_receipt_count;?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif;?>
                

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
    <script src="<?php echo css_js_url('plugins/pace/pace.min.js','milan_mobile');?>"></script>

    <!-- iCheck -->
    <script src="<?php echo css_js_url('plugins/iCheck/icheck.min.js','milan_mobile');?>"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

</body>
</html>