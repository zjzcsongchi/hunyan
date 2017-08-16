<!-- 弹出层 -->
<div id="back_bg"></div>
<!-- 弹出框 -->
    <script src="<?php echo css_js_url('sea.js','common');?>"></script>
    <script type="text/javascript">
        seajs.config({
            base: "<?php echo $domain['static']['url'];?>",
            alias: {
              "jquery": "<?php echo css_js_url('jquery.min.js', 'common');?>",
              "base": "<?php echo css_js_url('base.js','admin');?>",
              "form": "<?php echo css_js_url('jquery.form.js','admin');?>",
              "rooms": "<?php echo css_js_url('rooms.js','admin');?>",
              "datepicker": "<?php echo css_js_url('datepicker/WdatePicker.js', 'common');?>",
              "dialog": "<?php echo css_js_url('dialog.js','common');?>",
              "tabs": "<?php echo css_js_url('jquery.idTabs.min.js', 'admin');?>",
              'jqueryswf':"<?php echo css_js_url('jquery.swfupload.js', 'common');?>",
              "swfupload" : "<?php echo css_js_url('swfupload.js', 'admin')?>",
              "admin_upload": "<?php echo css_js_url('admin_upload.js', 'admin');?>",
              "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
              "admin_upload_shuiyin": "<?php echo css_js_url('admin_upload_shuiyin.js', 'admin');?>",
              "public":"<?php echo css_js_url('public.cmd.js', 'admin');?>",
              "bootstrap" : "<?php echo css_js_url('bootstrap.min.js', 'admin')?>",
              "jqvalidate" :"<?php echo css_js_url('jq.validate.js', 'admin')?>",
              "wdate":"<?php echo $domain['static']['url'];?>/common/js/datepicker/WdatePicker.js",
              "datatables":'<?php echo css_js_url('jquery.dataTables.min.js', 'admin')?>',
              "spin":"<?php echo css_js_url('spin.min.js', 'admin')?>",
              "spin_lib": "<?php echo css_js_url('spin_lib.js', 'admin')?>",
              "wangeditor":"<?php echo $domain['static']['url']?>/admin/wangeditor/js/wangEditor.min.js",
              "wangeditor_api":"<?php echo css_js_url('wangeditor.js', 'admin')?>",
              "my_dialog":"<?php echo css_js_url('my_dialog.js', 'admin')?>",
              'weui':"<?php echo css_js_url('weui.min.js', 'wap')?>",
              "dragula":"<?php echo css_js_url('dragula.min.js', 'admin')?>"
            },
            preload: ["jquery"]
        });
    </script>
