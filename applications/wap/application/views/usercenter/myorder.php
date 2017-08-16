<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $seo['title']?></title>
<meta name="keywords" content="<?php echo $seo['keywords']?>">
<meta name="description" content="<?php echo $seo['description']?>">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="format-detection" content="telephone=no">

<!-- 引入项目css资源文件,并配置构建地址演示 -->
<link href="<?php echo css_js_url('wap.css', 'wap');?>" type="text/css"
	rel="stylesheet" />
<link href="<?php echo css_js_url('m-user.css', 'wap');?>"
	type="text/css" rel="stylesheet" />
<link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet" />	
<?php $this->load->view('common/tongji')?>
</head>
<body class="grey">
	<div class="outerWrap">
		<div class="innerWrap">
			<!-- 头部 -->
            <?php $this->load->view('common/header')?>
            <div class="mainContainer">
				<div class="mainfix">
					<!--会员公共头部 -->
                    <?php $this->load->view('common/user_header')?>

                    <div class="user-cont">
                        <?php if(isset($order)):?>
                        <?php foreach ($order as $k => $v):?>
                        <table id="t_<?php echo $v['id']?>" border="0" cellspacing="0"
							cellpadding="0">
							<tr>
								<td colspan="2" class="t-head">编号 <?php echo $v['id']?><a id="<?php echo $v['id']?>" data="<?php echo $v['user_id']?>" href="javascript:;"
									class="del"></a></td>
							</tr>
							<tr>
								<td><img src="<?php echo $v['cover_img']?>"></td>
								<td><span><?php echo $v['venue_name']?></span></td>
							</tr>
							<tr>
								<td>类型</td>
								<td>
                                <?php 
                                    if($v['dinner_type'] == C('party.wedding.id')){
                                        echo C('party.wedding.name');
                                    }elseif ($v['dinner_type'] == C('party.birthday.id')){
                                        echo C('party.birthday.name');
                                    } elseif ($v['dinner_type'] == C('party.champion.id')) {
                                        echo C('party.champion.name');
                                    }
                                ?></td>
							</tr>
							<tr>
								<td>预约时间</td>
								<td><?php echo $v['dinner_time']?></td>
							</tr>
							<tr>
								<td>联系人</td>
								<td><?php echo $v['name']?></td>
							</tr>
							<tr>
								<td>地址</td>
								<td><?php echo $v['address']?></td>
							</tr>
						</table>
                        <?php endforeach;?>
                        <?php else:?>
                            <div style="text-align:center;" >
                                <img style="width: 3rem;height:3rem;" src="<?php echo $domain['static']['url']?>/www/images/user.png"><p>您目前还没有预约哦~</p>
                            </div>
                        <?php endif;?>
                    </div>

                    <?php $this->load->view('common/footer')?>
                </div>
			</div>
		</div>
		<!-- 左边栏 -->
        <?php $this->load->view('common/scoller')?>
    </div>
	<!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
 		seajs.use(['<?php echo css_js_url('myorder.js', 'www')?>','<?php echo css_js_url('iscroll.min.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>']],function(a,b,c){
 	        b.del();
 	        c.load();
 	 	})
        
    </script>
</body>
</html>