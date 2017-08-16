<script src="<?php echo css_js_url('sea.js','common');?>"></script>
<script type="text/javascript">
    seajs.config({
        base: "<?php echo $domain['static']['url'];?>",
        alias: {
          "jquery": "<?php echo css_js_url('jquery2.0.min.js', 'wap');?>",
          "dialog": "<?php echo css_js_url('dialog.js','common');?>",
          'jqueryswf':"<?php echo css_js_url('jquery.swfupload.js', 'common');?>",
          "swfupload" : "<?php echo css_js_url('swfupload.js', 'admin')?>",
          "admin_upload": "<?php echo css_js_url('admin_upload.js', 'admin');?>",
          "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
          "bootstrap" : "<?php echo css_js_url('bootstrap.min.js', 'admin')?>",
          "jqvalidate" :"<?php echo css_js_url('jq.validate.js', 'admin')?>",
          "wdate":"<?php echo $domain['static']['url'];?>/common/js/datepicker/WdatePicker.js",
          "public":"<?php echo css_js_url('public.js', 'www')?>",
          "swiper":"<?php echo $domain['static']['url'];?>/common/js/idangerous.swiper.min.js",
          "dropload":"<?php echo css_js_url('dropload.min.js', 'wap')?>",
          "fastclick":"<?php echo css_js_url('fastclick.min.js', 'wap')?>",
          'storage': '<?php echo css_js_url('store.js', 'wap')?>',
          'my_dialog': '<?php echo css_js_url('my_dialog.js', 'wap')?>',
          'jaliswall': '<?php echo css_js_url('jaliswall.js', 'wap')?>',
          'weui': '<?php echo css_js_url('weui.min.js', 'wap')?>',
          'viewer': '<?php echo css_js_url('viewer.min.js', 'wap')?>',
          'jweixin': '<?php echo css_js_url('jweixin-1.2.0.js', 'wap')?>',
        },
        preload: ["jquery"]
    });
</script>
