<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/admin">管理员列表</a></li>
    <li><a href="<?php echo $_SERVER['HTTP_REFERER']?>">员工信息</a>
    <li class="active">履历照片</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend>
        <?php echo $info['admin_name']?>&nbsp; <?php echo $info['occur_time']?> &nbsp; <?php echo $info['title']?>
        <a class="pull-right btn btn-primary" onclick="history.go(-1)">返 回</a>
        </legend>
        <?php if(!empty($info['images'])):?>
        <?php for($i = 0; $i < count($info['images'])/6; $i++):?>
        <div class="row">
            <?php for($j = $i*6; $j < 6*($i+1) and $j<count($info['images']); $j++):?>
            <div class="col-sm-2">
                <a target="_blank" href="<?php echo get_img_url($info['images'][$j])?>"><img title="点击查看大图" class="img-responsive" src="<?php echo get_img_url($info['images'][$j])?>"/></a>
            </div>
            <?php endfor;?>
        </div>
        <hr>
        <?php endfor;?>
        <?php endif;?>
    </fieldset>
</div>

