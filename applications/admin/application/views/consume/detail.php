<?php $this->load->view('common/header2') ?>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<head>
    <style>
        .table.table-bordered td:nth-child(2){
            width: 300px;
        }
        .form-group span{
            border:none;
            -webkit-box-shadow:none;
            -moz-box-shadow: none;
            -o-box-shadow: none;
             box-shadow: none;
        }
    </style>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width">
</head>
<?php if(!$is_mobile):?>
<ol class="breadcrumb hidden-print">
	<li><a href="/common" >首页</a>
	<li><a onclick="window.history.go(-1);">合同列表</a></li>
	<li class="active">消费清单</li>
</ol>
<?php endif;?>
<div class="container-fluid" style="margin:10px;">
	<fieldset>
	    <?php if(!$is_mobile):?>
		<legend><button class="btn btn-primary hidden-print" onclick="window.history.go(-1);" >返 回</button>&nbsp;
		<button class="btn btn-primary hidden-print" id="print" onclick="window.print();"><span class="glyphicon glyphicon-print"></span>打 印</button> <span>百年婚宴消费清单</span> </legend>
		<?php else:?>
		<legend>
		<span>百年婚宴消费清单</span>
		</legend>
		<?php endif;?>
		<table class="table table-bordered hidden-print">
		    <?php if(!$is_mobile):?>
			<tr>
			<th class="active">二维码</th>
				<td><img src="/publicservice/qr_code?link=<?php echo $domain['admin']['url'].'/consume/detail?dinner_id='.$consume['dinner_id'] ?>" class="hidden-print"></td>
			</tr>
			<?php endif;?>
			<tr>
				<th class="active">场馆名称:</th>
				<td><?php foreach($info['venue_ids'] as $v) echo $venue[$v].'；'; ?></td>
			</tr>

			<tr>
			<th class="active">宴会信息:</th>
				<td>
                    类型（<?php echo $dinner_type[$info['venue_type']] ?>）；
                    餐标（<?php echo $combo[$info['detail']['menus_id']] ?>/桌）；
                    桌数（预定<?php echo $info['menus_count']; ?>，保证<?php echo $promise_count['promise_count']; ?>）
                </td>
			</tr>
			<tr>
			<th class="active">客户姓名:</th>
				<td><?php echo $info['user']['name'] ?>&nbsp;<?php echo $info['user']['mobile_phone'] ?></td>
			</tr>
			<tr>
			<th class="active">订 金:</th>
				<td><?php echo $info['deposit'] ?></td>
			</tr>
			<tr>
			<th class="active">消费日期:</th>
				<td><?php echo $info['solar_time'] ?></td>
			</tr>
			<tr>
				<th class="active">结账日期:</th>
				<td><?php echo $consume['checkout_time'] ?></td>
			</tr>
			<tr>
				<th class="active">签字日期:</th>
				<td><?php echo $consume['sign_time'] ?></td>
			</tr>

			<tr>
			<th class="active">是否补吃</th>
				<td><?php if($consume['is_addeat'] == 0): echo '否'; else: echo '是'; endif; ?></td>
			</tr>
			<tr>
            <?php if ($consume['is_addeat'] == 1):?>
                    <th class="active">补吃日期</th>
                        <td><?php echo !empty($consume) ? $consume['addeat_date'] : ''; ?></td>
                    </tr>
                    <th class="active">补吃桌数</th>
                    <td><?php echo !empty($consume) ? $consume['addeat_table_num'] : ''; ?></td>
                    </tr>
            <?php endif;?>
            <tr>
                <th class="active">按50%结算桌数</th>
                <td><?php echo $consume['is_half']; ?></td>
            </tr>
			<tr>
			<th class="active">备注</th>
				<td style="width:70%;"><?php echo !empty($consume) ? $consume['remark'] : ''; ?></td>
			</tr>
		</table>
		<!-- 打印 -->
		<div class=" visible-print-block">
			<table class="table table-bordered">
				<tr>
					<th class="active">场馆名称</th>
					<td><?php foreach($info['venue_ids'] as $v) echo $venue[$v].'<br/>'; ?></td>
					<th class="active">宴会类型</th>
					<td><?php echo $dinner_type[$info['venue_type']] ?></td>
                    <th class="active">客户姓名</th>
                    <td><?php echo $info['user']['name'] ?>（<?php echo $info['user']['mobile_phone'] ?>）</td>
				</tr>
				<tr>
					<th>联系电话</th>
					<td><?php echo $consume['mobile_phone'] ?></td>
                    <th class="active">订金</th>
                    <td><?php echo $info['deposit'] ?></td>
                    <th class="active">餐标</th>
                    <td><?php echo $combo[$info['detail']['menus_id']] ?></td>
				</tr>
				<tr>
					<th class="active">预定桌数</th>
					<td><?php echo $info['menus_count']; ?></td>
					<th class="active">保证桌数</th>
					<td><?php echo $promise_count['promise_count']; ?></td>
                    <th class="active">消费日期</th>
                    <td><?php echo $info['solar_time'] ?></td>
				</tr>
				<tr>
					<th class="active">结账日期</th>
					<td><?php echo $consume['checkout_time'] ?></td>
                    <th class="active">签字日期</th>
                    <td><?php echo $consume['sign_time'] ?></td>
                    <th class="active">是否补吃</th>
                    <td><?php if($consume['is_addeat'] == 0): echo '否'; else: echo '是'; endif; ?>；补吃日期<?php echo !empty($consume) ? $consume['addeat_date'] : ''; ?></td>
				</tr>
				<tr>
					<th class="active">备注</th>
					<td colspan="5"><?php echo !empty($consume) ? $consume['remark'] : ''; ?></td>
				</tr>
			</table>
		</div>
        <!--清单-->
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="7" class="text-center">清单列表</th>
				</tr>
				<tr class="active">
					<th>名称</th>
					<th>单位</th>
					<th>数量</th>
					<th>单价</th>
					<th>金额</th>
					<th style="border:1px solid #ddd">收费情况</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach($consume_list as $k => $v): ?>
				<tr>
					<td><?php echo $v['name'] ?></td>
					<td><?php echo $v['unit'] ?></td>
					<td><?php echo $v['count'] ?></td>
					<td><?php echo $v['price'] ?></td>
					<td><?php echo $v['money'] ?></td>
					<td style="border:1px solid #ddd"><?php echo $v['remark'] ?></td>
				</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
		<table class="table table-bordered hidden-print">
			<tr>
				<th class="active">应收:</th>
				<td id="all_fee_id"><?php echo !empty($consume) ? $consume['all_fee'] : ''; ?></td>
				<th class="active">优惠:</th>
				<td><?php echo !empty($consume) ? $consume['preferentail_fee'] : ''; ?></td>
				<th class="active">实收:</th>
				<td><?php echo !empty($consume) ? $consume['actual_fee'] : ''; ?></td>
			</tr>

		</table>
		<div class="visible-print-block">
			<table class="table table-bordered">
				<tr>
					<th class="active">应收:</th>
					<td><?php echo !empty($consume) ? $consume['all_fee'] : ''; ?></td>
					<th class="active">优惠:</th>
					<td><?php echo !empty($consume) ? $consume['preferentail_fee'] : ''; ?></td>
				</tr>
				<tr>
					<th class="active">
						付款金额：
					</th>
					<td>
						<?php echo !empty($consume) ? $consume['actual_fee'] : ''; ?>(<?php echo $consume['is_pay'] ? '已付款' : '未付款' ?>)
					</td>
					<th class="active">
						联系电话：
					</th>
					<td><?php echo $consume['mobile_phone'] ?></td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<th class="text-center">客户签字</th>
					<td class="text-center">
						<img style="width:20%" src="<?php echo get_img_url($consume['customer_sign']) ?>">
					</td>
				</tr>
			</table>
		</div>

		<form class="form-horizontal hidden-print">
            <!--计算价格-->
            <input type="hidden" value="" data-old ="<?php echo $consume['all_fee'];?>" id="all_fee"/>
			<input type="hidden" name="dinner_id" value="<?php echo $consume['dinner_id'] ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">结账时间：</label>
                <div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
                    <input type="date" name="checkout_time" value="<?php if(!empty($consume['checkout_time'])) echo $consume['checkout_time']; ?>" class="form-control">
                </div>
            </div>
            <?php
                $style = $consume['is_addeat'] == 0 ? "style='display:none'": "style='display:block'";
            ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">是否补吃：</label>
                <div class="col-sm-6">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="is_addeat" value="0" <?php if(empty($consume) || $consume['is_addeat'] == 0) echo 'checked';  ?> >否
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="is_addeat" <?php if(!empty($consume) && $consume['is_addeat'] == 1) echo 'checked';  ?> value="1" >是
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group"  id="addeat_date" <?php echo $style;?>>
                <label class="col-sm-3 control-label" >补吃日期：</label>
                <div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
                    <input type="date" name="addeat_date" value="<?php echo !empty($consume) ? $consume['addeat_date'] : ''; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group" <?php echo $style;?> id="addeat_table_num">
                <label class="col-sm-3 control-label">补吃桌数：</label>
                <div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
                    <input type="text" name="addeat_table_num" value="<?php echo isset($consume['addeat_table_num']) ? $consume['addeat_table_num'] : 0; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group"  id="addeat_table_num">
                <label class="col-sm-3 control-label">预留桌数：</label>
                <div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
                    <input type="text" name="reserve_table_num" value="<?php echo !empty($consume) ? $consume['reserve_table_num'] : ''; ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">按50%结算桌数：</label>
                <div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
                    <input type="text" name="is_half" value="<?php echo !empty($consume) ? $consume['is_half'] : ''; ?>" class="form-control">
                </div>
            </div>
			<div class="form-group">
				<label class="col-sm-3 control-label">联系电话：</label>
				<div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
					<input type="tel" name="mobile_phone" value="<?php echo $consume['mobile_phone']?>"  class="form-control" <?php if($consume['is_pay']):?>disabled<?php endif;?>>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">是否付款：</label>
				<div class="col-sm-3" <?php if($is_mobile):?>style="position:absolute;margin-top:-3rem;margin-left:7rem"<?php endif;?>>
					<?php foreach($consume_is_pay as $k => $v): ?>
					<div class="radio-inline">
						<label>
							<input type="radio" name="is_pay" <?php if(!empty($consume) && intval($consume['is_pay']) == $k) echo 'checked'; ?> value="<?php echo $k ?>" ><?php echo $v ?>
						</label>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">客户签字：</label>
				<div class="col-sm-6">
					<input type="hidden" name="customer_sign" value="<?php echo !empty($consume) ? $consume['customer_sign'] : ''; ?>">
					<div class="sign <?php if(!$consume['customer_sign']):?>customer_signature<?php endif;?>" style="width:25rem;height:100px;border: 1px dashed #DCDCDC;">
						<?php if(!empty($consume) && !empty($consume['customer_sign'])): ?>
							<img src="<?php echo get_img_url($consume['customer_sign']) ?>" >
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
			if(!empty($consume['customer_sign']) && !empty($consume['is_pay']) && !empty($consume['mobile_phone'])){
			    $show = 1;
			}else{
			    $show = 2;
			}

		    ?>
		    <?php if($show == 2):?>
			<div class="form-group text-center">
				<button class="btn btn-primary hidden-print" id="save"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
			</div>
			<?php endif;?>
		</form>
	</fieldset>
</div>

 <!-- 签名画板 -->
    <div style="display:none;" id="signature-pad" class="m-signature-pad">
        <div class="pad-close" style="width: 50px;height: 50px;float: right;    position: relative;margin-right: -17px;margin-top: -20px;">
            <button i="close" style="font-size: 40px;" class="ui-dialog-close" title="关闭">x</button>
        </div>
        <div class="m-signature-pad--body">
            <canvas></canvas>
        </div>
        <div class="m-signature-pad--footer">
            <div class="description"></div>
            <button type="button" class="button clear" data-action="clear" >清除</button>
            <button type="button" class="button save" data-action="save">保存</button>
        </div>
    </div>
    <!-- 签名画板 -->

    <div class="page-bg"></div>

<?php $this->load->view('common/footer') ?>
<script>
    var id="<?php echo $info['id']?>";
    console.log(id);
seajs.use([
    '<?php echo css_js_url('consume.js', 'admin') ?>',
    '<?php echo css_js_url('dinner.js', 'admin')?>',
    '<?php echo css_js_url('signature_pad.js', 'admin');?>'],
    function(consume, dinner){
    console.log(dinner);
	consume.save_sign();
    dinner.upload_attachment();
    dinner.show_ewm();
    dinner.pop_consume_detail();

        var wrapper = document.getElementById("signature-pad"),
        clearButton = wrapper.querySelector("[data-action=clear]"),
        saveButton = wrapper.querySelector("[data-action=save]"),
        canvas = wrapper.querySelector("canvas"),
        signaturePad;

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        var resizeCanvas = function () {
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
							  	$('input[name="customer_sign"]').val(res.url);
						  } else if ($(saveButton).data('target') === 'agent_signature') {
						    $('.agent_signature').empty();
						  	$('.agent_signature').append('<img src="'+ res.full_url +'">');
						  	$('input[name="customer_sign"]').val(res.url);
						  }
						}
					}
				});

            }
        });

        $("[name=is_addeat][value=1]").on('click', function () {
            $("#addeat_date").css("display", "block");
            $("#addeat_table_num").css("display", "block");
            $(this).attr('checked','checked');
            $("[name=is_addeat][value=0]").removeAttr("checked");
        });
        $("[name=is_addeat][value=0]").on('click', function () {
            $("#addeat_date").css("display", "none");
            $("#addeat_table_num").css("display", "none");
            $(this).attr('checked','checked');
            $("[name=is_addeat][value=1]").removeAttr("checked");
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

		var dataURItoBlob = function (dataURI) {
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

})
</script>

</body>
</html>