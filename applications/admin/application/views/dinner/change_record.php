<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li class="active">变更记录</li>
</ol>

<div class="container-fluid" style="margin:10px">

    <!-- search -->
    <div class="row">
        <h2><?php echo $dinner['solar_time'].' - 好合厅' ;?></h2>
    </div>
    <hr>
    <!-- list -->
    
    <div class="row">
        <table class="table table-bordered table-striped" style="TABLE-LAYOUT: fixed" >
            <thead>
                <tr>
                    <th>序号</th>
                    <th>变更项目</th>
                    <th>变更前</th>
                    <th>变更后</th>
                    
                    <th>修改时间</th>
                    
                    <th>凭证</th>

                </tr>
            </thead>
            <tbody>
                <?php $i=1; if($list):?>
                <?php foreach ($list as $k => $v):?>
                    <?php foreach ($v as $k2 => $v2):?>
                    <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $v2['key_text']?></td>
                        <td style="word-break:break-all;">
                        <?php if($v2['key'] == 'is_show'):?>
                            <?php if($v2['old_value'] == 0):?>显示<?php else:?>隐藏 <?php endif;?>
                        <?php elseif($v2['key'] == 'dinner_time'):?>
                            <?php if($v2['old_value'] == 1):?>晚餐<?php else:?>午餐 <?php endif;?>
                        <?php elseif($v2['key'] == 'menus'):?>
                            <?php echo $combo_menu[$v2['old_value']]?>
                            
                        <?php elseif($v2['key'] == 'pianjiu' || $v2['key'] == 'daping'):?>
                            <?php if(!$v2['old_value']):?>
                                                                            不需要
                            <?php else:?>
                            <?php echo $v2['old_value']?>
                            <?php endif;?>
                        <?php elseif($v2['key'] == 'invition'):?>
                            <?php if($v2['old_value'] == 0):?>
                                                                      不需要
                            <?php elseif ($v2['old_value'] == 4):?>    
                                                                      不确定                                      
                            <?php else:?>
                            <?php echo $invitation[$v2['old_value']]?>
                            <?php endif;?>
                        <?php else:?>
                            <?php echo $v2['old_value']?>
                        <?php endif;?>
                        </td>
                        
                        <td style="word-break:break-all;">
                        <?php if($v2['key'] == 'is_show'):?>
                            <?php if($v2['new_value'] == 0):?>显示<?php else:?>隐藏 <?php endif;?>
                        <?php elseif($v2['key'] == 'dinner_time'):?>
                            <?php if($v2['new_value'] == 1):?>晚餐<?php else:?>午餐 <?php endif;?>
                        <?php elseif($v2['key'] == 'menus'):?>
                            <?php echo $combo_menu[$v2['new_value']]?>
                         <?php elseif($v2['key'] == 'pianjiu' || $v2['key'] == 'daping'):?>
                            <?php if(!$v2['new_value']):?>
                                                                            不需要
                            <?php else:?>
                            <?php echo $v2['new_value']?>
                            <?php endif;?>
                        <?php elseif($v2['key'] == 'invition'):?>
                            <?php if($v2['new_value'] == 0):?>
                                                                      不需要
                            <?php elseif ($v2['new_value'] == 4):?>    
                                                                      不确定                                   
                            <?php else:?>
                            <?php echo $invitation[$v2['new_value']]?>
                            <?php endif;?>
                        <?php else:?> 
                            <?php echo $v2['new_value']?>
                        <?php endif;?>
                        </td>
                        
                        <?php if($k2 == 0):?>
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <p><?php echo $v2['create_time']?></p>
                            </td>
                            <td style="vertical-align: middle;text-align: center;" rowspan="<?php echo count($v)?>">
                                <?php if($v2['attachment']):?>
                                    <a target="_blank" href="<?php echo get_img_url($v2['attachment'])?>"><img  src="<?php echo get_img_url($v2['attachment'])?>" style="width:100px"></a>
                                <?php else :?>
                                    <a class="btn btn-primary btn-xs"  href="/dinner/upload_attachment?id=<?php echo $v2['id']?>&dinner_id=<?php echo $v2['dinner_id']?>">上传凭证</a>
                                <?php endif;?>
                            </td>
                        <?php endif;?>

                    </tr>
                    <?php endforeach;?>
                    
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>

   
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('customer.js', 'admin')?>'], function(a){
	a.del();
		})
</script>
</body>
</html>
