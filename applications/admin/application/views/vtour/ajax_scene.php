<!-- 加载场景列表 -->
<?php foreach ($list as $v):?>
<li>
  <div class="checkbox">
      <label>
          <input type="checkbox" <?php if(!empty($v['is_checked'])) echo 'checked';?> value="<?php echo $v['id']?>" name="scene[]" />
          <img title="<?php echo $v['name']?>" style="max-width:100px;max-height:100px;" src="<?php echo get_img_url($v['thumb_img'])?>" class="img-thumbnail"/>
          <p class="text-center"><?php echo $v['name']?></p>
      </label>
  </div>
</li>
<?php endforeach;?>