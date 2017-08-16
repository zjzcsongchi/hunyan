<?php $this->load->view('common/header2')?>
<ol class="breadcrumb no_print">
    <?php foreach ($title as $k => $v):?>
    <?php if($k+1 == count($title)):?>
    <li class="active"><?php echo $v['text']?></li>
    <?php else:?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endif;?>
    <?php endforeach;?>
</ol>
<div class="container-fluid" style="margin:10px;">

    <table class="table table-bordered table-hover">
        <tr>
            <th colspan="4" class="text-center active">
                                百年订单
            </th>
        </tr>
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $dinner['user']['name']?></td>
            <th class="active">合同编号</th>
            <td><?php echo $dinner['contract_num']?></td>
        </tr>
        <tr>
            <th class="active">客户电话</th>
            <td><?php echo $dinner['user']['mobile_phone']?></td>
            <th class="active">宴会类型</th>
            <td><?php echo $dinner['venue_type_name']?></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $dinner['receiver']?>
            <th class="active">宴会日期</th>
            <td><?php echo $dinner['solar_time']?></td>
        </tr>
        
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎姓名</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $dinner['roles_main']?></td>
            <?php endif;?>
            <th class="active">农历</th>
            <td><?php echo $dinner['lunar_time']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎电话</th>
            <td><?php echo $dinner['roles_main_mobile']?></td>
            <?php else:?>
            <th class="active">宴会电话</th>
            <td><?php echo $dinner['roles_main_mobile']?></td>
            <?php endif;?>
            <th class="active">宴会场馆</th>
            <td><?php echo $dinner['venue_name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘姓名</th>
            <td><?php echo $dinner['roles_wife']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐信息</th>
            <td><?php echo $dinner['detail']['name']?></td>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘电话</th>
            <td><?php echo $dinner['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐桌数</th>
            <td><?php echo $dinner['menus_count']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $dinner['sign_contract']?></td>
            <th class="active">已交订金</th>
            <td><?php echo $dinner['deposit']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人电话</th>
            <td><?php echo $dinner['sign_contract_mobile']?></td>
            <th class="active">婚庆公司</th>
            <td><?php echo $dinner['company']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $dinner['create_admin']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $dinner['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">微请帖信息</th>
            <td><?php echo $dinner['card_info']?></td>
            <th class="active">棋牌室信息</th>
            <td><?php echo $dinner['chess_card']?></td>
        </tr>
        <tr>
            <th class="active">米粉</th>
            <td><?php echo $dinner['rice_flour']?></td>
            <th class="active">签订合同日期</th>
            <td><?php echo $dinner['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td><?php echo $dinner['remark']?></td>
        </tr>
        
    </table>


    <table class="table table-bordered table-hover">
        <tr>
            <th colspan="4" class="text-center active">米兰订单</th>
        </tr>
        <tr>
            <?php if($dinner['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎</th>
            <td><?php echo $info['roles_main']?></td>
            <th class="active">新娘</th>
            <td><?php echo $info['roles_wife']?></td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $info['roles_main']?></td>
            <th class="active"></th>
            <td></td>
            <?php endif;?>
        </tr>
        <tr>
            <th class="active">联系电话</th>
            <td><?php echo $dinner['user']['mobile_phone']?></td>
            <th class="active">签订合同日期</th>
            <td><?php echo $info['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">宴会日期</th>
            <td><?php echo $info['solar_time']?></td>
            <th class="active">大厅</th>
            <td><?php echo $info['venue_name']?></td>
            
        </tr>
        <?php foreach ($staffs as $k => $v):?>
        
        <tr>
            <?php foreach ($v as $k2 => $v2):?>
            <th class="active"><?php echo $v2['group']?></th>
            <td style="padding: 0px;">
                <div class="col-md-6">
                    <span style="float: left;"><?php echo $v2['fullname']?> </span>
                    <div> (档期状态：<?php echo $v2['schedule_status']?>)</div>
                </div>
                
                <div class="col-md-6" style="float: left; border-left: 2px #ddd solid;padding-top: 10px;padding-bottom: 10px;padding-left: 4px;">
                    <a class="btn btn-primary btn-xs no_print btn-receipt" style="float: left;" data-staff="<?php echo $v2['group_id'];?>">生成执行单</a>
                    <a class="btn btn-primary btn-xs no_print send_message" style="float: left;" data-menu_id="<?php echo $menu_id;?>" data-id="<?php echo $v2['id'];?>">短信通知</a>
                    
                    <?php if($v2['receipt_status']):?>
                    <div>执行单状态：<?php echo $v2['receipt_status']?> </div>
                    <?php endif;?>
                </div>

            </td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>

        <tr>
            <th class="active">套餐</th>
            <td><?php echo $info['menus']?><?php if(isset($info['price'])){echo '【'.$info['price'].'元】';}?></td>
            <th class="active">主题</th>
            <td><?php echo $info['theme']?></td>
        </tr>
        
        <tr>
            <th class="active">备注</th>
            <td><?php echo $info['remark']?></td>
            <th class="active">客户经理</th>
            <td><?php echo $info['manager']?></td>
        </tr>
        
    </table>
    <input type="hidden" name="menu_id" value="<?php echo $info['id']?>" >
    <div class="col-sm-12 text-center">
        <a class="btn btn-primary no_print" onclick="window.print();" style="margin-bottom:5px">打印</a>
    </div>
    
        

</div>

<?php $this->load->view('common/footer')?>
<script>

seajs.use(['<?php echo css_js_url('milan_receipt.js', 'admin')?>'], function(milan_receipt){
  milan_receipt.load();
  milan_receipt.send_message();
})
</script>
</body>
</html>
