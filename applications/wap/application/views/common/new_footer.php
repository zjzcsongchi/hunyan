<div class="footer" style="display:none">
    <?php if(isset($wap_menus)):?>
    <?php foreach ($wap_menus as $k => $v):?>
	<?php if($k <= 2):?>
	<div class="first-list">
	<div class="list" <?php if(!isset($v['child'])):?>onclick="window.open('<?php echo $v['url']?>', '_self');"<?php endif;?> >
	    <i></i>
	    <?php echo $v['title'];?></div>
		<?php if(isset($v['child'])):?>
		<div class="second-list">
		<i></i>
		    <?php foreach ($v['child'] as $key => $val):?>
		    <?php if($key <= 4):?>
			<a href="<?php echo $val['url']?>"><?php echo $val['title']?></a>
			<?php endif;?>
			<?php endforeach;?>
		</div>
		<?php endif;?>
	</div>
	<?php endif;?>
	<?php endforeach;?>
	<?php endif;?>
</div>
