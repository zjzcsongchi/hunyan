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
<a class="btn btn-primary" style="margin-bottom:10px">商品基本信息</a>
    <table class="table table-bordered table-hover">
        <tr>
            <th class="active">主标题/商品名称</th>
            <td><?php echo $info['title']?></td>
            <th class="active">子标题</th>
            <td><?php echo $info['sub_title']?></td>
        </tr>
        <tr>
            <th class="active">生产厂商</th>
            <td><?php echo $info['firm']?></td>
            <th class="active">单位</th>
            <td><?php echo $info['unit']?></td>
        </tr>
        <tr>
            <th class="active">原价</th>
            <td><?php echo $info['original_price']?></td>
            <th class="active">现价</th>
            <td><?php echo $info['present_price']?></td>
        </tr>
        
        <tr>
            <th class="active">类型</th>
            <td><?php echo $attribute_type[$info['class_id']]?></td>
            <th class="active">排序</th>
            <td><?php echo $info['sort']?></td>
        </tr>
        <tr>
            <th class="active">是否推荐</th>
            <td><?php if($info['is_recommend'] == 1):?>不推荐<?php else:?>推荐<?php endif;?></td>
            <th class="active">是否上架</th>
            <td><?php if($info['is_show'] == 1):?>下架<?php else:?>上架<?php endif;?></td>
        </tr>
        <tr>
            <th class="active">创建时间</th>
            <td><?php echo $info['create_time']?></td>
            <th class="active">修改时间</th>
            <td><?php echo $info['update_time']?></td>
        </tr>
        <tr>
            <th class="active">简介</th>
            <td><?php echo $info['summary']?></td>
            <th class="active">封面图</th>
            <td style="width:400px"><img src="<?php echo get_img_url($info['cover_img'])?>" style="width:400px"></td>
        </tr>
        <?php if(isset($attr_lists) && $attr_lists):?>
        <?php foreach ($attr_lists as $k=>$v):?>
        <?php if(($k+1)%2==1):?>
            <tr>
            <?php endif;?>
                <th class="active"><?php echo $v['attribute']?></th>
                <td><?php echo $v['value']?></td>
                <?php if(($k+1)%2!=1):?>
            </tr>
            <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
    </table>
    
    <?php if(isset($info['img_lists'])):?>
    <table class="table table-bordered hidden-print">
        <tr>
            <th colspan="6" class="text-center">商品相片</th>
        </tr>
    </table>
    <?php foreach($info['img_lists'] as $k => $v):?>
    <?php if($k%6 == 0):?>
        <div class="row hidden-print">
        <?php $i = $k; for ($i;$i<$k+6; $i++):?>
              <div class="col-sm-2">
              <?php if(isset($info['img_lists'][$i])):?>
                 <a href="<?php echo get_img_url($info['img_lists'][$i])?>" target="_blank"><img title="点击查看原图" data="<?php if(!empty($info['img_lists'][$i])){echo get_img_url($info['img_lists'][$i]);}?>" style="width: 100%;" src="<?php if(!empty($info['img_lists'][$i])): echo get_img_url($info['img_lists'][$i]); endif; ?>" class="img-responsive"/></a>
                <?php endif;?>
              </div>
          <?php endfor;?>
        </div>
        <br/>
    <?php endif;?>
    <?php endforeach;?>
    <?php endif;?>
    
    <a class="btn btn-primary" style="margin-bottom:10px">规格型号</a>
        <table class="table table-bordered table-hover">
        <?php if(isset($special_lists) && $special_lists):?>
        <?php foreach ($special_lists as $k=>$v):?>
            <tr>
                <th class="active">型号</th>
                <td><?php echo $v['version_name']?></td>
                <th class="active">价格</th>
                <td><?php echo $v['version_price']?></td>
                <th class="active">参考图片</th>
                <td style="width:400px"><img src= "<?php echo get_img_url($v['version_image'])?>" style="width:400px"></td>
            </tr>
        <?php endforeach;?>
        <?php endif;?>
        </table>
</div>


</body>
</html>
