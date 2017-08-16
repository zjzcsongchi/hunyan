


<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>上传凭证</h1></legend>
        <form class="form-horizontal" method="post" action="#">
            
            <!-- 封面图 -->
            <div class="tab-pane" id="images">
                <div class="form-group">
                    <div class="col-sm-12" id="photo">
                        <div class="card" id="uploadbtn" style="">
                    		<img style="width: 200px ;" src="<?php echo $domain['static']['url']?>/admin/images/plus2.png" style="max-width: 50%">
                            <input type="hidden" name="attachment">
                    	</div>
                    	<input type="file" id="uploadImg" style="display: none;">
                    </div>
                </div>
            </div>

            <input type="hidden" name="record_id" value="<?php echo $record_id?>" >


            <div class="form-group">
                <div class="col-sm-12">
                    <botton  id="submit" value="保  存" class="btn btn-primary">保  存</botton>
                </div>
            </div>
        </form>
    </fieldset>

</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">

seajs.use([
    'public',
	'<?php echo css_js_url('contract.js', 'admin')?>',
], function(my_public, contract){
  	contract.upload_img();

	$("#submit").on('click', function(){
	  $.post('/dinner/upload_attachment', 
	  {
	    'attachment': $('input[name="attachment"]').val(),
	    'record_id': $('input[name="record_id"]').val()
	  }, 
	  function(res){
		  if (res.status == 0) {
		    my_public.showDialog('保存成功','',function(){
			    window.location.href = '/dinner/show_detail/' + res.data.dinner_id;
			});
		  } else {
		    my_public.showDialog('保存失败');
		  }
	  })
	})

})
</script>
</body>
</html>