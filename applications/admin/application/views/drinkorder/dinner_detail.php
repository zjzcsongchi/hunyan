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
            <td><?php echo $info['roles_wife_mobile']?></td>
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
            <th class="active">签订合同日期</th>
            <td><?php echo $info['contract_date']?></td>
        </tr>
        <tr>
            <th class="active">备注</th>
            <td><?php echo $info['remark']?></td>
        </tr>
        
    </table>
    <a class="btn btn-primary" href="/drinkorder/add/<?php echo $info['id']?>">添加酒水</a>
</div>


</body>
</html>
