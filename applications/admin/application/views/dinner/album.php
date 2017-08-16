<?php $this->load->view('common/header2');?>
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/dinner">订单管理</a></li>
  <li class="active">相册管理</li>
</ol>
<style>
.row .col-sm-2 img{border-radius:3px;box-shadow:1px 1px 2px 3px #ccc;}
.list-inline{margin:10px 0;}
</style>

<div class="container-fluid" style="margin:10px;">
<div class="row">
    <div class="form-group">
        <button class="btn btn-primary" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</button>
        <a class="btn btn-primary" href="/dinner/album_add?dinner_id=<?php echo $dinner_id;?>" style="margin-left: 10px"><span class="glyphicon glyphicon-plus-sign"></span> 添加相册</a>
        <a class="btn btn-primary" href="/dinner/following_effect/<?php echo $dinner_id?>"><span class="glyphicon glyphicon-camera"></span> 跟拍效果</a>
        <a class="btn btn-primary" href="/dinner/dinner_article?dinner_id=<?php echo $dinner_id?>"><span class="glyphicon glyphicon-font"></span> 关联文章</a>
    </div>
</div>
<hr/>
    <?php foreach($list as $k => $v):?>
    <?php if($k%5 == 0):?>
    <div class="row">
      <?php $i = $k; for ($i;$i<$k+5; $i++):?>
      <div class="col-sm-2">
      <?php if(isset($list[$i])):?>
         <a href="/dinner/album_detail?album_id=<?php echo $list[$i]['id']?>&dinner_id=<?php echo $dinner_id;?>">
         <img style="width: 100%;max-height:165px;" src="<?php if(!empty($list[$i]['cover_img'])): echo get_img_url($list[$i]['cover_img']); else: echo $domain['static']['url'].'/admin/images/no_img.png'; endif; ?>" class="img-responsive"/>
         </a>
        <ul class="list-inline">
          <li> <?php echo $list[$i]['name']?></li>
          <li><?php echo $list[$i]['price']?>元</li>
        </ul>
        <ul class="list-inline">
          <li>  <a class="btn btn-primary btn-xs" href="/dinner/edit_album?id=<?php echo $list[$i]['id']?>&dinner_id=<?php echo $dinner_id;?>">修改</a></li>
          <li>  <a class="btn btn-primary btn-xs del" href="/dinner/del_album?id=<?php echo $list[$i]['id']?>&dinner_id=<?php echo $dinner_id;?>">删除</a></li>
          <li>  <a class="btn btn-primary btn-xs" href="/dinner/album_detail?album_id=<?php echo $list[$i]['id']?>&dinner_id=<?php echo $dinner_id;?>" class="detail">查看</a>
          <li>  <a class="btn btn-primary btn-xs" href="/dinner/add_file/<?php echo $dinner_id;?>/<?php echo $list[$i]['id']?>" class="detail">管理相片</a>
        </ul>
        <?php endif;?>
      </div>
      <?php endfor;?>
    </div>
    <hr/>
    <?php endif;?>
    <?php endforeach;?>
</div>

<?php $this->load->view('common/footer')?>
</body>
</html>


