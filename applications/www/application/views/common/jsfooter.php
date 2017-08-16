<script src="<?php echo css_js_url('sea.js','common');?>"></script>
<script type="text/javascript">
    seajs.config({
        base: "<?php echo $domain['static']['url'];?>",
        alias: {
          "jquery": "<?php echo css_js_url('jquery.min.js', 'common');?>",
          "dialog": "<?php echo css_js_url('dialog.js','common');?>",
          "my_dialog": "<?php echo css_js_url('my_dialog.js','www');?>",
          'jqueryswf':"<?php echo css_js_url('jquery.swfupload.js', 'common');?>",
          "swfupload" : "<?php echo css_js_url('swfupload.js', 'admin')?>",
          "admin_upload": "<?php echo css_js_url('admin_upload.js', 'admin');?>",
          "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
          "bootstrap" : "<?php echo css_js_url('bootstrap.min.js', 'admin')?>",
          "jqvalidate" :"<?php echo css_js_url('jq.validate.js', 'admin')?>",
          "wdate":"<?php echo $domain['static']['url'];?>/common/js/datepicker/WdatePicker.js",
          "swiper":"<?php echo $domain['static']['url'];?>/common/js/idangerous.swiper.min.js",
          "public":"<?php echo css_js_url('public.js', 'www')?>",
          "wechartQR": "<?php echo css_js_url('wxLogin.js', 'www')?>",
          "fall_jquery":"<?php echo css_js_url('fall.jquery.js', 'www')?>",
          'storage': '<?php echo css_js_url('store.js', 'wap')?>',
          'my_dialog': '<?php echo css_js_url('my_dialog.js', 'wap')?>',
          'media_swiper': '<?php echo css_js_url('swiper.min.js', 'www')?>',
          'animationfly':'<?php echo css_js_url('AnimationFrame.js', 'www')?>',
   		  "cake_up":"<?php echo css_js_url('cake_up.jquery.js', 'www')?>",
        "weui":"<?php echo css_js_url('weui.min.js', 'wap') ?>"
        },
        preload: ["jquery"]
    });
</script>
<script type="text/javascript">

    var staticUrl = "<?php echo $domain['static']['url']?>";
    var uploadUrl = "<?php echo $domain['upload']['url']?>";
</script>
