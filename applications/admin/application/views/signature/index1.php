<?php $this->load->view('common/header2')?>

        <link rel="stylesheet" type="text/css" href="<?php echo css_js_url("s_public.css", "admin"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_js_url("s_css1.css", "admin"); ?>" />
        <link rel="stylesheet" href="<?php echo css_js_url('signature-pad.css', 'admin');?>">
        <link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet"/>

		<div class="top">
			<h2>发&nbsp;票&nbsp;须&nbsp;知</h2>
		</div>
		<div class="main">
			<p>
				您定于<input type="text" name="name3" style="background:#FFFFFF" value="<?php echo '  '.$dinner_solar_time.'在'.$venue_names_str.'  '; ?>" >厅的<span>宴席</span>为不含税价格，如您需要开发票，须按您的开发票的金额另行支付税款。
			</p>
		</div>
		<div class="main2">
			<p>本人完全明白和同意以上全部内容须知</p>
			<div class="qian_M rt">
			<ul>
				<li>客户签名：<div class="sign customer_signature">
				<?php if (isset($signature)): ?>
				<img src="<?php echo get_img_url($signature);?>">
				<?php endif; ?>
				</div></li>
				<input type="hidden" name="customer_signature" value="<?php echo isset($signature)?$signature:''; ?>">
			</ul>
			</div>
		</div>
		<div class="date rt">
			签字日期：<input type="text" name="name3" size="14" class="Wdate" value="<?php echo isset($signature_time) ? $signature_time : ''; ?>" style="background:#FFFFFF;width:150px">
	    </div>
	    <br>
	    <br>
	    <div style="float:right; margin-right:80px"><button type="button" data-id="<?php echo $id; ?>" class="btn btn-primary save_signature">保存</button></div>
	    
	    <!-- 签名画板 -->
	    <div style="display:none"; id="signature-pad" class="m-signature-pad">
	        <div class="pad-close" style="width: 50px;height: 50px;float: right;    position: relative;margin-right: -17px;margin-top: -20px;">
	            <button i="close" style="font-size: 40px;" class="ui-dialog-close" title="关闭">x</button>
	        </div>
	        <div class="m-signature-pad--body">
	            <canvas></canvas>
	        </div>
	        <div class="m-signature-pad--footer">
	            <div class="description"></div>
	            <button type="button" class="button clear" data-action="clear">清除</button>
	            <button type="button" class="button save" data-action="save">保存</button>
	        </div>
	    </div>
	    <!-- 签名画板 -->
	    
	    <?php $this->load->view('common/footer') ?>
	    <script type="text/javascript">
	    var uploadUrl = "<?php echo $domain['upload']['url']?>";
        seajs.use([
			'<?php echo css_js_url('dinner.js', 'admin')?>',
            '<?php echo css_js_url('signature_pad.js', 'admin');?>',
        ], function(a){
    		a.save_signature();     
			a.wdate();
          
            $(function(){
                var wrapper = document.getElementById("signature-pad"),
                clearButton = wrapper.querySelector("[data-action=clear]"),
                saveButton = wrapper.querySelector("[data-action=save]"),
                canvas = wrapper.querySelector("canvas"),
                signaturePad;
            
                // Adjust canvas coordinate space taking into account pixel ratio,
                // to make it look crisp on mobile devices.
                // This also causes canvas to be cleared.
                function resizeCanvas() {
                    // When zoomed out to less than 100%, for some very strange reason,
                    // some browsers report devicePixelRatio as less than 1
                    // and only part of the canvas is cleared then.
                    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext("2d").scale(ratio, ratio);
                }
                
                window.onresize = resizeCanvas;
                resizeCanvas();
                
                signaturePad = new SignaturePad(canvas, {
                  dotSize: 5

                });
                
                clearButton.addEventListener("click", function (event) {
                    signaturePad.clear();
                });
                
                saveButton.addEventListener("click", function (event) {
                    if (signaturePad.isEmpty()) {
                        alert("请签名后再进行保存");
                    } else {
                      var fd = new FormData();
                      var blob = dataURItoBlob(signaturePad.toDataURL());
                      
                      fd.append('Filedata', blob);
                      fd.append('type', 'image');
                      fd.append('file_name', 'image.png');

                      $.ajax({
    						url: uploadUrl+'/file/upload',
    						type:'POST',
    						data:fd,
    						xhrFields: {
                              withCredentials: true
                            },
    						cache: false,
    						contentType: false,    
    						processData: false,
    						dataType:'json',
    						beforeSend:function(){
    						},
    						success:function(res){
    							if (res.error === 0) {
    							  $('#signature-pad').toggle();
    							  $('.page-bg').removeClass('act');
    							  if ($(saveButton).data('target') === 'customer_signature') {
    							    $('.customer_signature').empty();
      							  	$('.customer_signature').append('<img src="'+ res.full_url +'">');
      							  	$('input[name="customer_signature"]').val(res.url);
    							  } else if ($(saveButton).data('target') === 'agent_signature') {
    							    $('.agent_signature').empty();
    							  	$('.agent_signature').append('<img src="'+ res.full_url +'">');
    							  	$('input[name="agent_signature"]').val(res.url);
    							  }
    							}
    						}
    					});
                        
                    }
                });

                $('.customer_signature').on('click', function(){
                  $(saveButton).data('target', 'customer_signature');
                  $('#signature-pad').toggle();
                  $('.page-bg').addClass('act');
                  resizeCanvas();
                });

                $('.agent_signature').on('click', function(){
                  $(saveButton).data('target', 'agent_signature');
                  $('#signature-pad').toggle();
                  $('.page-bg').addClass('act');
                  resizeCanvas();
                });

                $('.page-bg, .pad-close').on('click', function(){
                  $('#signature-pad').toggle();
                  $('.page-bg').removeClass('act');
                });

      			function dataURItoBlob(dataURI) {
                    var byteString = atob(dataURI.split(',')[1]);
                    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                    var ab = new ArrayBuffer(byteString.length);
                    var ia = new Uint8Array(ab);
                    for (var i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }
                    return new Blob([ab], {type: mimeString});
                }

            
      			$('#deposit_digit').on('keyup', function(){
                  
                  var deposit_DX = a.DX($(this).val());
                  $('#deposit_DX').text(deposit_DX);
                });
      			
            });
        })
	    </script>
	    
	</body>
</html>
