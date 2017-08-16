<?php $this->load->view('common/header');?>
<div class="place">
	<span>位置：</span>
	<ul class="placeul">
		<li><a href="/common/index">首页</a></li>
		<li><a href="#">列表页</a></li>
	</ul>
</div>


<div class="rightinfo">
	<div class="tools">
		<ul class="toolbar">
			<li><a href='/combo/add'><span><img
						src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加套餐</a></li>
		</ul>
		<form  method="post">
			<ul>
				<li>套餐名称：
                <input name="combo_name" type="text" placeholder="" <?php if(isset($combo_name)):?> value="<?php echo $combo_name?>" <?php endif;?>class="dfinput" style="height:32px;width:184px" />
				<input type="submit" value="搜索" class="btn" />
				</li>
			</ul>
		</form>
	</div>
	<ul class="foods-lists" >
	<?php foreach ($list as $k => $v) :?>
	   <li>
	        <img src="<?php echo get_img_url($v['cover_img'])?>">
			<div class="detail">	
			<?php if($v['foods']) :?>	
			<?php foreach($v['foods'][0] as $kk => $vv): ?>			
					<div class="list"><img src="<?php echo get_img_url($vv['cover_img']);?>" class="show_big_img"><?php echo $vv['name'];?></div>
			<?php endforeach;?>
			<?php endif;?>	
				
			</div>
			<div class="bot">
			     <p class="title">
					<span class="cont"><?php echo $v['combo_name']?></span><span
						class="price"><?php echo $v['price']?></span>
				</p>
				<a href="/combo/edit/<?php echo $v['id']?>" class="destine">编辑</a><a class="destine delete" data_id="<?php echo $v['id']?>" >删除</a>
			</div>
		</li>
		
		<?php endforeach;?>
		
	
	</ul>
	<div class="pagin">
		<ul class="paginList">
          <?php echo $pagestr;?>
        </ul>
	</div>
</div>
<script src="<?php echo css_js_url('jquery.min.js','common');?>"></script>
<script src="<?php echo css_js_url('jquery.bxslider.js','common');?>"></script>
<script src="<?php echo css_js_url('index.js','common');?>"></script>
<script src="<?php echo css_js_url('dialog.js','admin');?>"></script>
<script type="text/javascript" src="<?php echo $domain['static']['url'];?>/common/js/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
          $('.slider').bxSlider({
            slideWidth: 80,
            minSlides: 1,
            maxSlides: 12,
            moveSlides: 1,
            slideMargin: 10,
            nextText: '',
            prevText: '',
            pager: false
          });
        });
        $(".Wdate").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM-dd'})
        });
        $(".delete").click(function(){
        	var id = $(this).attr('data_id');
        	showDialog("是否确定删除此信息", '删除','/combo/del?id='+id);
        	
        	
        });

		$(document).on('click', '.show_big_img', function(){
			var url = $(this).attr('src');
			var d = dialog({
				content:'<img src="'+url+'" class="close_big_img" title="点击关闭" style="width:100%">'
			})
			d.width(500);
			d.showModal();
			$('.close_big_img').one('click', function(){
				d.close().remove();
			})
		})
        
        
        function showDialog(msg, title, url){
            var title = arguments[1] ? arguments[1] : '提示信息';
            var url = arguments[2] ? arguments[2] : '';
            var d = dialog({
                title: title,
                content: msg,
                modal:false,
                okValue: '确定',
                ok: function () {
                    if(url != '')
                    {
                        window.location.href=url;
                    }
                    return true;
                },
                cancel: function(){
                    d.close();
                },
                cancelValue: '取消'
            });
            d.width(320);
            d.showModal();
//             d.show();
        }

        
    </script>
</body>
</html>
