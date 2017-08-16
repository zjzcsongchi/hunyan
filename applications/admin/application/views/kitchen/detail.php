<?php $this->load->view('common/header2')?>

<link rel="stylesheet" href="<?php echo css_js_url('signature-pad.css', 'admin');?>">
<style>
    strong {
        color: #ff0000;
    }
</style>
<ol class="breadcrumb hidden-print">
    <?php foreach ($title as $k => $v):?>
    <?php if($k+1 == count($title)):?>
    <li class="active"><?php echo $v['text']?></li>
    <?php else:?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endif;?>
    <?php endforeach;?>
</ol>
<div class="container-fluid" style="margin:10px;">
<button class="btn btn-primary pull-right hidden-print" onclick="window.print();" id="print"><span class="glyphicon glyphicon-print"></span> 打 印</button>

    <table class="table table-bordered table-hover hidden-print">
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
            <th class="active">合同编号</th>
            <td><strong><?php echo $info['contract_num']?> <?php echo $info['venue_type_name']?></strong></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $info['receiver']?>
            <th class="active">宴会日期</th>
            <td><strong><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></strong></td>
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
            <td><strong ><?php echo $info['venue_name']?></strong></td>
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
            <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $info['sign_contract']?>（<?php echo $info['sign_contract_mobile']?>）</td>
            <th class="active">已交订金</th>
            <td><?php echo $info['deposit']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $info['create_admin']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $info['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td><?php echo $info['remark']?></td>
            <th class="active">米粉</th>
            <td><?php echo $rice_noodle ? $rice_noodle['num'] .  "【备注：" . $rice_noodle['remark'] . "】" : '不需要';?></td>
        </tr>
        <tr>
            <th class="active">鸡蛋</th>
            <td><?php echo $egg ? $egg['num'] .  "【备注：" . $egg['remark'] . "】" : '不需要';?></td>
            <th class="active">偏酒</th>
            <td><?php echo $pianjiu ? $pianjiu['num'] . "【备注：" . $pianjiu['remark'] . "】" : '不需要' ?></td>
        </tr>
        
    </table>
    <!-- 打印区域 -->
    <?php if($order_type == 'egg'): ?>
    <div class="container-fluid visible-print-block" style="margin:0;padding:0">
        <div style="width:49%;display:inline-block;">
            <table class="table table-bordered">
                <tr>
                    <th class="active" style="width:70px;">客户姓名</th>
                    <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
                </tr>
                <tr>
                    <th class="active">接单人</th>
                    <td><?php echo $info['receiver'] ?></td>
                </tr>
                <tr>
                    <th class="active">经办人</th>
                    <td><?php echo $info['create_admin'] ?>（<?php echo $info['create_admin_tel'] ?>）</td>
                </tr>
                <?php if($info['venue_type'] == C('party.wedding.id')):?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
                </tr>
                <?php else:?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
                </tr>
                <?php endif;?>
                <tr>
                    <th class="active">宴会日期</th>
                    <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
                </tr>
                <tr>
                    <th class="active">宴会场馆</th>
                    <td><?php echo $info['venue_name']?></td>
                </tr>
                
                <tr>
                    <th class="active">订餐信息</th>
                    <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
                </tr>
                <tr>
                    <th class="active">鸡蛋</th>
                    <td class="active"><?php echo $egg ? $egg['num'] : '不需要';?></td>
                </tr>
                <tr>
                    <th class="active">备注</th>
                    <td><?php echo $info['remark']?></td>
                </tr>
            </table>
        </div>
        <div style="width:49%;display:inline-block;">
            <table class="table table-bordered">
                <tr>
                    <th class="active" style="width:70px;">客户姓名</th>
                    <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
                </tr>
                <tr>
                    <th class="active">接单人</th>
                    <td><?php echo $info['receiver'] ?></td>
                </tr>
                <tr>
                    <th class="active">经办人</th>
                    <td><?php echo $info['create_admin'] ?>（<?php echo $info['create_admin_tel'] ?>）</td>
                </tr>
                <?php if($info['venue_type'] == C('party.wedding.id')):?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
                </tr>
                <?php else:?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
                </tr>
                <?php endif;?>
                <tr>
                    <th class="active">宴会日期</th>
                    <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
                </tr>
                <tr>
                    <th class="active">宴会场馆</th>
                    <td><?php echo $info['venue_name']?></td>
                </tr>
                
                <tr>
                    <th class="active">订餐信息</th>
                    <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
                </tr>
                <tr>
                    <th class="active">鸡蛋</th>
                    <td class="active"><?php echo $egg ? $egg['num'] : '不需要';?></td>
                </tr>
                <tr>
                    <th class="active">备注</th>
                    <td><?php echo $info['remark']?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php elseif($order_type == 'rice_noodle'): ?>
    <div class="container-fluid visible-print-block" style="margin:0;padding:0">
        <div style="width:49%;display:inline-block;">
            <table class="table table-bordered">
                <tr>
                    <th class="active" style="width:70px;">客户姓名</th>
                    <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
                </tr>
                <tr>
                    <th class="active">接单人</th>
                    <td><?php echo $info['receiver'] ?></td>
                </tr>
                <tr>
                    <th class="active">经办人</th>
                    <td><?php echo $info['create_admin'] ?>（<?php echo $info['create_admin_tel'] ?>）</td>
                </tr>
                <?php if($info['venue_type'] == C('party.wedding.id')):?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
                </tr>
                <?php else:?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
                </tr>
                <?php endif;?>
                <tr>
                    <th class="active">宴会日期</th>
                    <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
                </tr>
                <tr>
                    <th class="active">宴会场馆</th>
                    <td><?php echo $info['venue_name']?></td>
                </tr>
                
                <tr>
                    <th class="active">订餐信息</th>
                    <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
                </tr>
                <tr>
                    <th class="active">米粉</th>
                    <td class="active"><?php echo $rice_noodle ? $rice_noodle['num'] : '不需要';?></td>
                </tr>
                <tr>
                    <th class="active">备注</th>
                    <td><?php echo $info['remark']?></td>
                </tr>
            </table>
        </div>
        <div style="width:49%;display:inline-block;">
            <table class="table table-bordered">
                <tr>
                    <th class="active" style="width:70px;">客户姓名</th>
                    <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
                </tr>
                <tr>
                    <th class="active">接单人</th>
                    <td><?php echo $info['receiver'] ?></td>
                </tr>
                <tr>
                    <th class="active">经办人</th>
                    <td><?php echo $info['create_admin'] ?>（<?php echo $info['create_admin_tel'] ?>）</td>
                </tr>
                <?php if($info['venue_type'] == C('party.wedding.id')):?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
                </tr>
                <?php else:?>
                <tr>
                    <th class="active">宴席类型</th>
                    <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
                </tr>
                <?php endif;?>
                <tr>
                    <th class="active">宴会日期</th>
                    <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
                </tr>
                <tr>
                    <th class="active">宴会场馆</th>
                    <td><?php echo $info['venue_name']?></td>
                </tr>
                
                <tr>
                    <th class="active">订餐信息</th>
                    <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
                </tr>
                <tr>
                    <th class="active">米粉</th>
                    <td class="active"><?php echo $rice_noodle ? $rice_noodle['num'] : '不需要';?></td>
                </tr>
                <tr>
                    <th class="active">备注</th>
                    <td><?php echo $info['remark']?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php else: ?>
    <div class="container-fluid visible-print-block" style="margin:0;padding:0">
    <div style="width:49%;display:inline-block;">
        <table class="table table-bordered table-hover table_padding" style="margin-bottom:2px;">
            <tr>
                <th class="active" style="width:70px;">客户姓名</th>
                <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
            </tr>
            <tr>
                <th class="active">接单人</th>
                <td><?php echo $info['receiver'] ?></td>
            </tr>
            <tr>
                <th class="active">经办人</th>
                <td><?php echo $info['create_admin'] ?>（<?php echo $info['create_admin_tel'] ?>）</td>
            </tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <tr>
                <th class="active">宴席类型</th>
                <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
            </tr>
            <?php else:?>
            <tr>
                <th class="active">宴席类型</th>
                <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
            </tr>
            <?php endif;?>
            <tr>
                <th class="active">宴会日期</th>
                <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
            </tr>
            <tr>
                <th class="active">宴会场馆</th>
                <td><?php echo $info['venue_name']?></td>
            </tr>
            
            <tr>
                <th class="active">订餐信息</th>
                <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
            </tr>
            <tr>
                <th class="active">备注</th>
                <td><?php echo $info['remark']?></td>
            </tr>
        </table>
        <table class="table table-bordered table-hover table_padding" style="margin-bottom:2px;">
            <tr>
                <th colspan="2" class="text-center active"><?php echo $combo['name'];?></th>
            </tr>
            <?php foreach($combo['dishes'] as $k => $v):?>
            <tr>
                <th class="active" ><?php echo $v['name'];?></th>
                <td style="text-indent:10px;"><?php echo $v['price'];?> 元</td>
                
            </tr>
            <?php endforeach;?>
            <tr>
                <th class="active" style="text-indent:10px;">餐标</th>
                <td style="text-indent:10px;"><?php echo $combo['name'];?></td>
            </tr>
            <tr>
                <th class=" active" style="text-indent:10px;">菜单备注</th>
                <td style="width:200px;"><?php echo $info['menu_remark'] ? : '无' ?></td>
            </tr>
        </table>
            
    </div>
    <div style="width:49%;display:inline-block;float:right;">
        <table class="table table-bordered table-hover table_padding" style="margin-bottom:2px;">
            <tr>
                <th class="active" style="width:70px;">客户姓名</th>
                <td><?php echo $info['user']['name']?>（<?php echo $info['user']['mobile_phone']?>）</td>
            </tr>
            <tr>
                <th class="active">接单人</th>
                <td><?php echo $info['receiver'] ?></td>
            </tr>
            <tr>
                <th class="active">经办人</th>
                <td><?php echo $info['create_admin'] ?>(<?php echo $info['create_admin_tel'] ?>)</td>
            </tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <tr>
                <th class="active">宴席类型</th>
                <td><?php echo $info['venue_type_name']?>（新郎：<?php echo $info['roles_main'] ?> 新娘：<?php echo $info['roles_wife'] ?>）</td>
            </tr>
            <?php else:?>
            <tr>
                <th class="active">宴席类型</th>
                <td><?php echo $info['venue_type_name']?>（主角：<?php echo $info['roles_main'] ?>）</td>
            </tr>
            <?php endif;?>
            <tr>
                <th class="active">宴会日期</th>
                <td><?php echo $info['solar_time']?> <strong><?php echo $dinner_time[$info['dinner_time']]?></strong> 农历：<?php echo $info['lunar_time']?></td>
            </tr>
            <tr>
                <th class="active">宴会场馆</th>
                <td><?php echo $info['venue_name']?></td>
            </tr>
            
            <tr>
                <th class="active">订餐信息</th>
                <td><?php echo $info['detail']['name']?> （<?php echo $info['menus_count']?>桌，保证<?php echo $info['promise_count'] ?>桌）</td>
            </tr>
            <tr>
                <th class="active">备注</th>
                <td><?php echo $info['remark']?></td>
            </tr>
            
        </table>
        <table class="table table-bordered table-hover table_padding" style="margin-bottom:2px;">
            <tr>
                <th colspan="2" class="text-center active"><?php echo $combo['name'];?></th>
            </tr>
            <?php foreach($combo['dishes'] as $k => $v):?>
            <tr>
                <th class="active"><?php echo $v['name'];?></th>
                <td style="text-indent:10px;"><?php echo $v['price'];?> 元</td>
                
            </tr>
            <?php endforeach;?>
            <tr>
                <th class="active" >餐标</th>
                <td style="text-indent:10px;"><?php echo $combo['name'];?></td>
            </tr>
            <tr>
                <th class=" active" >菜单备注</th>
                <td style="width:200px;"><?php echo $info['menu_remark'] ? : '无' ?></td>
            </tr>
        </table>
        
    </div>
    </div>
    <?php endif; ?>
    <!-- 打印区域end -->
    
    <table class="table table-bordered table-hover hidden-print">
        <tr>
            <th colspan="2" class="text-center active"><?php echo $combo['name'];?></th>
        </tr>
        <?php foreach($combo['dishes'] as $k => $v):?>
        <tr>
            <th class="active"><?php echo $v['name'];?></th>
            <td><?php echo $v['price'];?> 元</td>
            
        </tr>
        <?php endforeach;?>
        
    </table>
    <!--菜单备注-->
    <?php if(!empty($info['menu_remark'])): ?>
    <table class="table table-bordered table-hover table_padding">
        <tr>
            <th class="text-center active">菜单备注</th>
        </tr>
        <tr>
            <td><?php echo $info['menu_remark'] ?></td>
        </tr>
    </table>
    <?php endif; ?>
    
   

    <?php if($list):?>
    <div class="row hidden-print">
        <table class="table table-bordered table-striped" style="TABLE-LAYOUT: fixed" >
            <thead>
                <tr>
                    <th>序号</th>
                    <th>变更项目</th>
                    <th>变更前</th>
                    <th>变更后</th>
                    <th>修改人</th>
                    <th>修改时间</th>
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
                                <p><?php echo $v2['create_user']?></p>
                            </td>
                            
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <p><?php echo $v2['create_time']?></p>
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
    <?php endif;?>
    
    

</div>

<?php $this->load->view('common/footer')?>
<script>
var id="<?php echo $info['id']?>";
    seajs.use([
       '<?php echo css_js_url('dinner.js', 'admin')?>',
       'public',
       '<?php echo css_js_url('signature_pad.js', 'admin');?>',
    ], function(dinner, my_public){
      dinner.upload_attachment();
      dinner.show_ewm();
      var order_type = "<?php echo $order_type?>";
        console.log(order_type);
      if (order_type == "egg") {
          dinner.pop_egg();
      }else if(order_type == 'rice_noodle'){
          dinner.pop_noddles();
      } else if (order_type == 'all') {
          dinner.pop();
      }
      //js代码
  	if ('matchMedia' in window) {
          window.matchMedia('print').addListener(function (media) {
          	changestatus();
          //do before-printing stuff
          });
      } else {
          window.onbeforeprint = function () {
          	changestatus();
          //do before-printing stuff
          }
      }
       
      function changestatus(){
  		$.post('', {id:id}, function(){
  				
  		})
      }
      
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
				  		    my_public.showDialog('上传成功','',function(){
				  			    window.location.href = '/dinner/show_detail/' + res.data.dinner_id;
				  			});
				  		  } else {
				  		    my_public.showDialog('上传失败');
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


        $('.page-bg').on('click', function(){
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
