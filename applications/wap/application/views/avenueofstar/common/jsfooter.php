
    <script src="<?php echo css_js_url('sea.js','common');?>"></script>
    <script type="text/javascript">
        seajs.config({
            base: "<?php echo $domain['static']['url'];?>",
            alias: {
              "jquery": "<?php echo css_js_url('jquery.min.js', 'common');?>",
              "bootstrap" : "<?php echo css_js_url('bootstrap.min.js', 'milan_mobile')?>",
              'metisMenu' : "<?php echo css_js_url('plugins/metisMenu/jquery.metisMenu.js', 'milan_mobile')?>",
              'slimscroll' : "<?php echo css_js_url('plugins/slimscroll/jquery.slimscroll.min.js', 'milan_mobile')?>",
              'leftMenu': "<?php echo css_js_url('hplus.js', 'milan_mobile');?>",
              'pace' : "<?php echo css_js_url('plugins/pace/pace.min.js', 'milan_mobile')?>",
              
              "validate" : "<?php echo css_js_url('plugins/validate/jquery.validate.min.js', 'milan_mobile')?>",
              "dialog": "<?php echo css_js_url('dialog.js','common');?>",
              
              'jqueryswf':"<?php echo css_js_url('jquery.swfupload.js', 'common');?>",
              "swfupload" : "<?php echo css_js_url('swfupload.js', 'admin')?>",
              "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
        
            },
            preload: ["jquery"]
        });
    </script>