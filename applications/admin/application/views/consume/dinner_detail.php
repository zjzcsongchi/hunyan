<?php $this->load->view('common/header2')?>
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
    <table class="table table-bordered table-hover">
        <tr>
            <th class="active">客户姓名</th>
            <td><?php echo $info['user']['name']?></td>
            <th class="active">合同编号</th>
            <td><?php echo $info['contract_num']?></td>
        </tr>
        <tr>
            <th class="active">客户电话</th>
            <td><?php echo $info['user']['mobile_phone']?></td>
            <th class="active">宴会类型</th>
            <td><?php echo $info['venue_type_name']?></td>
        </tr>
        <tr>
            <th class="active">接单人</th>
            <td><?php echo $info['receiver']?>
            <th class="active">宴会日期</th>
            <td><?php echo $info['solar_time']?></td>
        </tr>
        
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎姓名</th>
            <td><?php echo $info['roles_main']?></td>
            <?php else:?>
            <th class="active">宴会主角</th>
            <td><?php echo $info['roles_main']?></td>
            <?php endif;?>
            <th class="active">农历</th>
            <td><?php echo $info['lunar_time']?></td>
        </tr>
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新郎电话</th>
            <td><?php echo $info['roles_main_mobile']?></td>
            <?php else:?>
            <th class="active">宴会电话</th>
            <td><?php echo $info['roles_main_mobile']?></td>
            <?php endif;?>
            <th class="active">宴会场馆</th>
            <td><?php echo $info['venue_name']?></td>
        </tr>
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘姓名</th>
            <td><?php echo $info['roles_wife']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐信息</th>
            <td><?php echo $info['detail']['name']?></td>
        </tr>
        <tr>
            <?php if($info['venue_type'] == C('party.wedding.id')):?>
            <th class="active">新娘电话</th>
            <td><?php echo $info['roles_wife_mobile']?></td>
            <?php else:?>
            <th class="active">缺省值</th>
            <td></td>
            <?php endif;?>
            <th class="active">订餐桌数</th>
            <td><?php echo $info['menus_count']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人</th>
            <td><?php echo $info['sign_contract']?></td>
            <th class="active">已交订金</th>
            <td><?php echo $info['deposit']?></td>
        </tr>
        <tr>
            <th class="active">签订合同人电话</th>
            <td><?php echo $info['sign_contract_mobile']?></td>
            <th class="active">婚庆公司</th>
            <td><?php echo $info['company']?></td>
        </tr>
        <tr>
            <th class="active">经办人</th>
            <td><?php echo $info['create_admin']?></td>
            <th class="active">代金券信息</th>
            <td><?php echo $info['coupon_info']?></td>
        </tr>
        <tr>
            <th class="active">微请帖信息</th>
            <td><?php echo $info['card_info']?></td>
            <th class="active">棋牌室信息</th>
            <td><?php echo $info['chess_card']?></td>
        </tr>
        <tr>
            <th class="active">米粉</th>
            <td><?php echo $info['rice_flour']?></td>
            <th class="active" style="border:1px solid #ddd">签订合同日期</th>
            <td style="border:1px solid #ddd"><?php echo $info['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td style="border:1px solid #ddd"><?php echo $info['remark']?></td>
        </tr>
        
    </table>
</div>


 <br>
            
    <div class="row" style="margin-left:2rem;margin-right:2rem">
        <table class="table table-bordered table-striped" style="TABLE-LAYOUT: fixed;">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>变更项目</th>
                    <th>变更前</th>
                    <th>变更后</th>
                    
                    <th>修改时间</th>
                    <th>修改人</th>
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
                        <?php endif;?>

                    </tr>
                    <?php endforeach;?>
                    <?php $j++;?>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>

    </div>
    

</body>
</html>
