<?php $this->load->view('avenueofstar/common/header');?>
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="row">
                <?php if($is_applied):?>
                    <div class="col-lg-3">
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                     <a href="/avenueofstar/apply1" style="color:#ffffff;"><i class="fa fa-pencil-square-o fa-2x"></i>修改</a>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span> 审核状态</span>
                                    <h2 class="font-bold"><?php echo $auth_status_res ?></h2>
                                </div>
                                 <?php if($auth_status != 0):?>
                                    <div class="col-xs-4">
                                        <h5>审核建议：</h5>
                                    </div>
                                    <div class="col-xs-12">
                                        <span><?php echo $auth_suggestion ?></span>
                                    </div>
                                <?php endif?>
                                
                            </div>
                        </div>
                    </div>
                    
                   
                <?php else:?>
                    <div class="col-lg-4">
                        <a href="/avenueofstar/apply1">
                            <div class="widget navy-bg p-lg text-center">
                                <div class="m-b-md">
                                    <i class="fa fa-sign-in fa-4x"></i>
                                    <h1 class="m-xs">点击报名</h1>
                                    <h3 class="font-bold no-margins">星光大道报名入口 :)</h3>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif?>
            </div>
            <!-- footer -->
            <?php $this->load->view('avenueofstar/common/footer');?>
            <!-- footer -->
            
        </div>
    </div>
    <?php $this->load->view('avenueofstar/common/jsfooter');?>
    <script type="text/javascript">
    	var object = [
		      {"obj": "#uploader_profile", "btn": "#btn_profile"},
        ];
        seajs.use([
           '<?php echo css_js_url('avenueofstar/apply.js', 'milan_mobile');?>', 
           'admin_uploader',
           'jqueryswf',
           'swfupload', 
           'bootstrap', 
           'metisMenu', 
           'slimscroll', 
           'leftMenu', 
           'pace', 
           'validate', 
           '<?php echo css_js_url('plugins/validate/messages_zh.min.js', 'milan_mobile');?>', 
        ], function(apply, swfupload){
          apply.apply1();
          swfupload.swfupload(object);
        })
    </script>
    <!-- layerDate plugin javascript -->
    <script src="http://static.dev.yuecheke.com/admin/js//plugins/layer/laydate/laydate.js?v=201604051059"></script>
    <script>
        //外部js调用
        laydate({
            elem: '#birthday', //目标元素。由于laydate.js封装了一个轻量级的选择器引擎，因此elem还允许你传入class、tag但必须按照这种方式 '#id .class'
            event: 'focus' //响应事件。如果没有传入event，则按照默认的click
        });
      
    </script>
    
    

</body>
</html>