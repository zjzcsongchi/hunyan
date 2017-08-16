<table class="table table-bordered">
  <tbody>
    <tr>
      <td>名称：</td>
      <td><?php echo $info['name']?></td>
    </tr>
    <tr>
      <td>封面图：</td>
      <td><img src="<?php echo get_img_url($info['cover_img'])?>" style="width:200px; height:180px;"></td>
    </tr>
    <tr>
      <td>价格：</td>
      <td><?php echo $info['price']?></td>
    </tr>
    <tr>
      <td>分类：</td>
      <td><?php echo $dish_class[$info['class_id']]?></td>
    </tr>
    <tr>
      <td>是否推荐：</td>
      <td><?php echo $info['is_recommend'] ? '是' : '否'?></td>
    </tr>
    <tr>
      <td>是否删除：</td>
      <td><?php echo $info['is_del'] ? '是' : '否'?></td>
    </tr>
  </tbody>
</table>