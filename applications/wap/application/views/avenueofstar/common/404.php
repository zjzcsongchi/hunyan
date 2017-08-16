<?php $this->load->view('common/public_top');?>
                <!-- right main -->
                 <div class="row">
                  <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                      <div class="middle-box text-center animated fadeInRightBig">
                        <h3 class="font-bold">这里是页面内容</h3>
                
                        <div class="error-desc">
                                                                            您可以在这里添加栅格，参考首页及其他页面完成不同的布局
                          <br><a href="index.html" class="btn btn-primary m-t">打开主页</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- right main -->
                <?php $this->load->view('common/footers');?>
            </div>

        </div>
    </div>
    <?php $this->load->view('common/footer')?>
    <script type="text/javascript">
        //Mainly scripts
	    seajs.use(['bootstrap', 'metisMenu', 'slimscroll'], function() {	
        });
        //Custom and plugin javascript
		seajs.use(['<?php echo css_js_url('hplus.js', 'admin');?>', '<?php echo css_js_url('/plugins/pace/pace.min.js', 'admin');?>'], function() {
			
        });
    </script>

</body>

</html>


