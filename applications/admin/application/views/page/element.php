<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
                
                <thead>
                <tr >
                    <th>序号</th>
                    <th>元素类型</th>
                    <th>排序</th>
                    <th style="width:30%">内容</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($element) && $element): ?>
                <?php foreach ($element as $key=>$val):?>
                    <tr>
                    
                         <td><?php echo $key+1?></td>
                         
                         <td class="element_type" data-id="<?php echo $val['element_type']?>">
                            <?php if($val['element_type'] == 0):?>
                                                                          图片
                            <?php else:?>
                                                                          文字
                            <?php endif;?>
                         </td>
                         <td class="sort" data-id="<?php echo $val['sort']?>"><?php echo $val['sort']?></td>
                         <td class="default" data-id="<?php echo get_img_url($val['default'])?>" data-image="<?php echo $val['default']?>">
                            <?php if($val['element_type'] == 0):?>
                            <img src="<?php echo get_img_url($val['default'])?>" style="width: 150px">
                            <?php else:?>
                            <?php echo $val['default'];?>
                            <?php endif;?>
                         </td>
                         <td class="remark" data-id="<?php echo $val['remark']?>">
                         <?php echo $val['remark']?>
                         </td>
                         
                         <td >
                            <a class="btn btn-primary btn-xs element" data-id="<?php echo $val['id']?>" data-flag="<?php echo $val['flag']?>">修改</a>
                            <a class="btn btn-primary btn-xs del" data-id="<?php echo $val['id']?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </tbody>
        </table>
    </div>
    
    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php echo $count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>

<script>
var page_id = "<?php echo $page_id?>";
	seajs.use(['<?php echo css_js_url('template.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
		a.del_element();
		a.edit_element();
		a.change();
	})
</script>
</body>
</html>
