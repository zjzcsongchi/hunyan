<?php $this->load->view('common/header2');?>
<link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo css_js_url('admin.css', 'admin');?>" type="text/css" rel="stylesheet" />
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/dinner/album?dinner_id=<?php echo $dinner_id?>">相册列表</a></li>
</ol>
<style>
.row .col-sm-2 img{border-radius:3px;box-shadow:1px 1px 2px 3px #ccc;}
.list-inline{margin:10px 0;}
</style>

<div class="rightinfo">
    <div class="container-fluid">
    <hr/><?php if(isset($list)):?>
        <?php foreach($list as $k => $v):?>
        <?php if($k%5 == 0):?>
        <div class="row">
          <?php $i = $k; for ($i;$i<$k+5; $i++):?>
          <div class="col-sm-2">
          <?php if(isset($list[$i])):?>
             <img style="width: 100%;max-height:165px;" data="<?php if(!empty($list[$i]['img'])): echo get_img_url($list[$i]['img']); endif; ?>" class="show_big_img" src="<?php if(!empty($list[$i]['thumb'])): echo get_img_url($list[$i]['thumb']); endif; ?>" class="img-responsive"/>
            <ul class="list-inline">
              <!--  li>删除</li-->
            </ul>
            
            <?php endif;?>
          </div>
          <?php endfor;?>
        </div>
        <hr/>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php if(isset($count)){echo $count;}?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
    </div>
</div>

<script src="<?php echo css_js_url('jquery.min.js','common');?>"></script>
<script src="<?php echo css_js_url('dialog.js','admin');?>"></script>
<script type="text/javascript">
            $('.row').on('click', '.show_big_img', function(){
			var url = $(this).attr('data');
			var d = dialog({
				content:'<img src="'+url+'" class="close_big_img" style="width:100%;height:auto;" title="点击关闭">'
			})
			d.width(500)
			d.showModal();
			$('.close_big_img').one('click', function(){
				d.close().remove();
			})
		})
</script>
</body>
</html>


