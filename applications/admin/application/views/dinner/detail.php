<?php $this->load->view('common/header2')?>

<link rel="stylesheet" href="<?php echo css_js_url('signature-pad.css', 'admin');?>">
<ol class="breadcrumb">
    <?php foreach ($title as $k => $v):?>
    <?php if($k+1 == count($title)):?>
    <li class="active"><?php echo $v['text']?></li>
    <?php else:?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endif;?>
    <?php endforeach;?>
</ol>
<div class="container-fluid" style="margin:10px;">

<div style="position: absolute;top: 57px;right: 26px;width: 150px; box-shadow: 3px 5px 23px;">
    <img id="qr_img" src="/publicservice/qr_code?link=<?php echo $domain['admin']['url'].'/dinner/show_detail/'.$dinner_id;?>" style="width: 100%;">
</div>

    <table class="table table-bordered table-hover">
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
            <th class="active">合同编号</th>
            <td><?php echo $info['contract_num']?>&nbsp;&nbsp;<?php echo $info['venue_type_name']?></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $info['receiver']?>
            <th class="active">宴会日期</th>
            <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong>&nbsp;农历：<?php echo $info['lunar_time']?></td>
        </tr>
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎姓名</th>
            <td><?php echo $info['roles_main']?>（<?php echo $info['roles_main_mobile']?>）</td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $info['roles_main']?>（<?php echo $info['roles_main_mobile']?>）</td>
            <?php endif;?>
            <th class="active">宴会场馆</th>
            <td><?php echo $info['venue_name']?></td>
            
        </tr>
        
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘姓名</th>
            <td><?php echo $info['roles_wife']?>（<?php echo $info['roles_wife_mobile']?>）</td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐信息</th>
            <td><?php echo isset($info['detail']['name']) ? $info['detail']['name'] : ''?></td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $info['sign_contract']?>（<?php echo $info['sign_contract_mobile']?>）</td>
            <th class="active">菜单备注</th>
            <td><?php echo $info['menu_remark']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $info['create_admin']?></td>
            <th class="active">订餐桌数</th>
            <td><?php echo $info['menus_count']?>&nbsp;保证：<?php echo $info['promise_count']?>桌</td>
        </tr>
        <tr>
            <th class="active">微请帖信息</th>
            <td><?php echo $info['card_info']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $info['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">婚庆公司</th>
            <td><?php echo $info['company']?></td>
            <th class="active">已交订金</th>
            <td><?php echo $info['deposit']?></td>
        </tr>
        <tr>
            <th class="active">米粉</th>
            <td><?php echo $info['rice_flour']?></td>
            <th class="active">棋牌室信息</th>
            <td><?php echo $info['chess_card']?></td>
        </tr>
        <tr>
            <th class="active">是否需要发票</th>
            <td><?php echo $info['is_invoice'] ? '是' : '否' ?></td> 
            <th class="active">手机端详情地址</th>
            <td><?php echo $domain['mobile']['url']?>/today/detail?id=<?php echo $info['id']?></td>
        </tr>
        <tr>
            <th class="active">家庭住址</th>
            <td><?php echo $info['customer_address'] ?></td>
            <th class="active">客户单位地址</th>
            <td><?php echo $info['customer_company'] ?></td>
        </tr>
        <tr>
            <th class="active">身份证（正面）</th>
            <td><?php if($info['id_card_photo']):?><img src="<?php echo get_img_url($info['id_card_photo']); ?>" style="width:400px;height:300px" /><?php endif;?></td>
            <th class="active">身份证（背面）</th>
            <td><?php if($info['id_card_back_photo']):?><img src="<?php echo get_img_url($info['id_card_back_photo']); ?>" style="width:400px;height:300px" /><?php endif;?></td>
        </tr>
        <tr>
            <th class="active">签订合同日期</th>
            <td><?php echo $info['contract_date']?> 
            <a target="_blank" href="/dinner/view_contract_PDF/<?php echo $info['id'] ?>">点击查看合同</a>
            <a class="resend_msg btn btn-primary" data-id="<?php echo $info['id']?>">发送短信</a>
            </td>
            <th class="active">备注</th>
            <td><?php echo $info['remark']?></td>
        </tr>
        
        <?php foreach ($dinner_extend as $k => $v):?>
        <tr>
            <?php foreach ($v as $k2 => $v2):?>
            <th class="active"><?php echo $v2['key_text']?></th>
            <td>
                <?php echo $v2['outstr']?>
            </td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
       
        
    </table>
    
    <div class="row">
        <a href="/dinner/invoice_notice/<?php echo $info['id']?>" target="_blank" class="btn btn-primary" role="button">发票须知</a>
        <!-- <a href="/dinner/power_attorney/<?php echo $info['id']?>" target="_blank" class="btn btn-primary" role="button">个人授权委托书</a>  -->
        
    </div>
    <br>
            
    <div class="row">
        <table class="table table-bordered table-striped" style="TABLE-LAYOUT: fixed" >
            <thead>
                <tr>
                    <th>序号</th>
                    <th>变更项目</th>
                    <th>变更前</th>
                    <th>变更后</th>
                    
                    <th>修改时间</th>
                    <th>修改人</th>
                    
                    <th>凭证</th>

                </tr>
            </thead>
            <tbody>
                <?php $i=1; $j = 1;if($list):?>
                <?php foreach ($list as $k => $v):?>
                    <?php foreach ($v as $k2 => $v2):?>
                    <tr>
                        <?php if($k2 == 0):?>
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <p><?php echo $j?></p>
                            </td>
                        <?php endif;?>
                        <td><?php echo $v2['key_text']?></td>
                        <td style="word-break:break-all;">
                        <?php if($v2['key'] == 'is_show'):?>
                            <?php if($v2['old_value'] == 0):?>显示<?php else:?>隐藏 <?php endif;?>
                        <?php elseif($v2['key'] == 'dinner_time'):?>
                            <?php if($v2['old_value'] == 1):?>晚餐<?php else:?>午餐 <?php endif;?>
                        <?php elseif($v2['key'] == 'menus'):?>
                            <?php echo $combo_menu[$v2['old_value']]?>
                            
                        <?php elseif($v2['key'] == 'pianjiu' || $v2['key'] == 'daping'):?>
                            <?php if(!$v2['old_value']):?>
                                                                            不需要
                            <?php else:?>
                            <?php echo $v2['old_value']?>
                            <?php endif;?>
                        <?php elseif($v2['key'] == 'invition'):?>
                            <?php if($v2['old_value'] == 0):?>
                                                                      不需要
                            <?php else:?>
                            <?php echo $invitation[$v2['old_value']]?>
                            <?php endif;?>
                        <?php else:?>
                            <?php echo $v2['old_value']?>
                        <?php endif;?>
                        </td>
                        
                        <td style="word-break:break-all;">
                        <?php if($v2['key'] == 'is_show'):?>
                            <?php if($v2['new_value'] == 0):?>显示<?php else:?>隐藏 <?php endif;?>
                        <?php elseif($v2['key'] == 'dinner_time'):?>
                            <?php if($v2['new_value'] == 1):?>晚餐<?php else:?>午餐 <?php endif;?>
                        <?php elseif($v2['key'] == 'menus'):?>
                            <?php echo $combo_menu[$v2['new_value']]?>
                         <?php elseif($v2['key'] == 'pianjiu' || $v2['key'] == 'daping'):?>
                            <?php if(!$v2['new_value']):?>
                                                                            不需要
                            <?php else:?>
                            <?php echo $v2['new_value']?>
                            <?php endif;?>
                        <?php elseif($v2['key'] == 'invition'):?>
                            <?php if($v2['new_value'] == 0):?>
                                                                      不需要
                            <?php else:?>
                            <?php echo $invitation[$v2['new_value']]?>
                            <?php endif;?>
                        <?php else:?> 
                            <?php echo $v2['new_value']?>
                        <?php endif;?>
                        </td>
                        
                        <?php if($k2 == 0):?>
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <p><?php echo $v2['create_time']?></p>
                            </td>
                            
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <p><?php echo $v2['create_user']?></p>
                            </td>
                            
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <?php if($v2['attachment']):?>
                                    <a target="_blank" href="<?php echo get_img_url($v2['attachment'])?>"><img  src="<?php echo get_img_url($v2['attachment'])?>" style="width:100px"></a>
                                <?php else :?>
                                    <a class="btn btn-primary btn-xs upload_attachment" style="margin: 5px auto;" data-id="<?php echo $v2['id']?>" data-dinner_id="<?php echo $v2['dinner_id']?>" >上传凭证</a>
                                    
                                    <a class="btn btn-primary btn-xs customer_signature " style="margin: 5px auto;" data-id="<?php echo $v2['id']?>" >手写签名</a>
                                <?php endif;?>
                            
                            </td>
                        <?php endif;?>

                    </tr>
                    <?php endforeach;?>
                    <?php $j++;?>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>

    </div>
    
    <div style="text-align: center;">
    <?php if (isset($info['is_examined'])): ?>
        <?php if ($info['is_examined'] == C('dinner.examine.to_recheck.id')): ?>
        <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $info['id']; ?>" data-examination_suatus="<?php echo $info['is_examined']; ?>" data-examination_reason="<?php echo $info['examined_reason']; ?>">审核</a>
        <?php elseif ($info['is_examined'] == C('dinner.examine.not.id')): ?>
        <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $info['id']; ?>" data-examination_suatus="<?php echo $info['is_examined']; ?>" data-examination_reason="<?php echo $info['examined_reason']; ?>">审核</a>
        <?php elseif ($info['is_examined'] == C('dinner.examine.to_archive.id')): ?>
        <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $info['id']; ?>" data-examination_suatus="<?php echo $info['is_examined']; ?>" data-examination_reason="<?php echo $info['examined_reason']; ?>">归档</a>
        <?php elseif ($info['is_examined'] == C('dinner.examine.archived.id')): ?>
        <p>该合同已归档</p>
        <?php elseif ($info['is_examined'] == C('dinner.examine.backend_add.id')): ?>
        <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $info['id']; ?>" data-examination_suatus="<?php echo $info['is_examined']; ?>" data-examination_reason="<?php echo $info['examined_reason']; ?>">审核</a>
        <?php elseif ($info['is_examined'] == C('dinner.examine.failure.id')): ?>
        <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $info['id']; ?>" data-examination_suatus="<?php echo $info['is_examined']; ?>" data-examination_reason="<?php echo $info['examined_reason']; ?>">归档</a>
        <?php endif; ?>
    <?php endif;?>
    </div>
    
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
    <div class="page-bg"></div>
    <!-- 签名画板 -->

</div>

<?php $this->load->view('common/footer')?>
<script>
    seajs.use([
       '<?php echo css_js_url('dinner.js', 'admin')?>',
       'public',
       '<?php echo css_js_url('signature_pad.js', 'admin');?>',
       ], function(dinner, my_public){
           dinner.examination();
      dinner.upload_attachment();
      dinner.show_ewm();
      dinner.prevent_repeat_click();
      dinner.resend_msg();
      
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
        
        signaturePad = new SignaturePad(canvas);
        
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
				success:function(res) {
    				if (res.error === 0) {
    				  $('#signature-pad').toggle();
    				  $('.page-bg').removeClass('act');

    				  $.post('/dinner/upload_attachment', {
				  	    'attachment': res.url,
				  	    'record_id': $(saveButton).data('id')
				  	  }, function(res) {
				  		  if (res.status == 0) {
				  		    my_public.showDialog('保存成功','',function(){
				  			    window.location.href = '/dinner/show_detail/' + res.data.dinner_id;
				  			});
				  		  } else {
				  		    my_public.showDialog('保存失败');
				  		  }
				  	  })
    				}
				}
			  });
                
            }
        });

        $('.customer_signature').on('click', function(){
          $(saveButton).data('id', $(this).data('id'));
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
      });


      

    })

</script>
</body>
</html>
