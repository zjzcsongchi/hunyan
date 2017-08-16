<?php $this->load->view('avenueofstar/common/header');?>
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 animated fadeInRight">
                    <div class="mail-box-header">
                        <div class="pull-right tooltip-demo">
                            <a href="javascript:window.history.go(-1)" class="btn btn-white btn-sm"  data-placement="top" title="回复"><i class="fa fa-reply"></i> 返回</a>

                        </div>
                        <h2>审核结果</h2>
                        <div class="mail-tools tooltip-demo m-t-md">


                            <h3>
                                <span class="font-noraml">您的报名申请,<?php echo $res['auth_status_res']?>
                            </h3>

                        </div>
                    </div>
                    <div class="mail-box">


                        <div class="mail-body">
                            <h4>尊敬的朋友：</h4>
                            <p>
                                <?php echo $res['auth_suggestion']?>
                            </p>

                            <p class="text-right">
                                
                            </p>
                        </div>

                        <div class="clearfix"></div>

                    </div>
                </div>
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