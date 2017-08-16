

<?php if(isset($car_lists) && $car_lists):?>
<?php foreach ($car_lists as $k=>$v):?>
<?php if(isset($lists[$v['product_id']]) && $lists[$v['product_id']]):?>



<tr>

        <?php if(isset($special_lists[$v['special_id']])):?>
        <?php $price = $special_lists[$v['special_id']]['version_price']?>
        <?php else:?>
        <?php $price = $lists[$v['product_id']]['present_price']?>
        <?php endif;?>
        
    <td><input type="checkbox" class="product" data-price="<?php echo $price?>"></td>
    <td>
        <p class="order"></p>
        
        <?php if(isset($special_lists[$v['special_id']])):?>
        <?php if($special_lists[$v['special_id']]['version_image'] && $special_lists[$v['special_id']]['version_image']):?>
        <a href="/drink/detail?id=<?php echo $v['product_id']?>" target="_blank">
        <img src="<?php echo get_img_url($special_lists[$v['special_id']]['version_image'])?>">
        </a>
        <?php else:?>
        <a href="/drink/detail?id=<?php echo $v['product_id']?>" target="_blank">
        <img src="<?php echo get_img_url($lists[$v['product_id']]['cover_img'])?>">
        </a>
        <?php endif;?>
        <?php else:?>
        <a href="/drink/detail?id=<?php echo $v['product_id']?>" target="_blank">
        <img src="<?php echo get_img_url($lists[$v['product_id']]['cover_img'])?>">
        </a>
        <?php endif;?>
        
        
    </td>
    <td>
        <p class="title"><span><?php echo $lists[$v['product_id']]['title']?></span></p>
        <p class="text">生产厂家<span><?php echo $lists[$v['product_id']]['firm']?></span></p>
        <?php if(isset($attr_lists[$v['product_id']]) && $attr_lists[$v['product_id']]):?>
        <?php foreach ($attr_lists[$v['product_id']] as $key=>$val):?>
        <p class="text"><?php echo $key?><span><?php echo $val?></span></p>
        <?php endforeach;?>
        <?php endif;?>
    </td>
    <td style="text-align:center">
        <?php if(isset($special_lists[$v['special_id']])):?>
        <?php echo $special_lists[$v['special_id']]['version_name']?>
        <?php else:?>
        <?php echo "原装"?>
        <?php endif;?>
    
    </td>
    <td><p class="price">￥
    <span class="present_price">
        <?php if(isset($special_lists[$v['special_id']])):?>
        <?php echo $special_lists[$v['special_id']]['version_price']?>
        <?php else:?>
        <?php echo $lists[$v['product_id']]['present_price']?>
        <?php endif;?>
        
    </span></p></td>
    <td>
        <a href="javascript:;" class="but reduce">-</a>
        <input type="text" value="1">
        <a href="javascript:;" class="but add">+</a>
    </td>
    <td><p class="price">￥
    <span class="money" >
    <?php if(isset($special_lists[$v['special_id']])):?>
        <?php echo $special_lists[$v['special_id']]['version_price']?>
        <?php else:?>
        <?php echo $lists[$v['product_id']]['present_price']?>
        <?php endif;?>
    </span></p></td>
    
    <input type="hidden" data-special-id="<?php echo $v['special_id']?>" data-product-id="<?php echo $v['product_id']?>">
    <td><p class="del">删除</p></td>
</tr>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>