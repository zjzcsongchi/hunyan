<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/milancombo/index">婚礼套餐</a></li>
        <li><a href="javascript:;">服务</a></li>
    </ul>
</div>

<div class="formbody">
    <table id="service" class="tablelist" style="width: 50%;margin-left: 22px;">
        <thead>
            <tr><th colspan="3" style="text-align: center"><?php echo $info['name']?> 【<?php echo $info['desc']?>】<th></tr>
            <tr><td colspan="3"><br/></td></tr>
            <?php if(!empty($info['feature'])):?>
            <tr style="border-top:1px solid #c7c7c7;text-align: center">
                <td>特色</td>
                <td colspan="2"><?php echo $info['feature']?></td>
            </tr>
            <?php endif;?>
            <tr style="border-top:1px solid #c7c7c7;text-align: center">
                <td>套餐价</td>
                <td colspan="2"><?php echo $info['price']?> 元</td>
            </tr>
        </thead>
        <?php if(isset($list)):?>
        <?php foreach ($list as $k => $v):?>
            <tr  style="border-bottom: 1px solid #c7c7c7;border-top:1px solid #c7c7c7"><th colspan="3" style="text-align: center"><?php echo $v['name']?></th></tr>
            <?php if(isset($v['child'])):?>
            <?php foreach ($v['child'] as $kk => $vv):?>
                <tr style="border-top:1px solid #c7c7c7">
                    <td style="border-right:1px solid #c7c7c7;"><?php echo $kk+1?></td>
                    <td colspan="2"><?php echo $vv['name']?></td>
                </tr>
                <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
        <tr><td style="border-top:1px solid #c7c7c7;text-align: center" colspan="3">备注：<?php echo $info['info']?></td></tr>
    </table>
</div>
</body>
</html>