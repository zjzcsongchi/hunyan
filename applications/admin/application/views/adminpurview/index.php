<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>资讯列表</title>
    <link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo css_js_url('jquery.min.js','admin');?>"></script>
    <style>
        td{ border: 1px solid #EDF6FA}
        #son-child td{ border: 0px; text-align: left; padding-left: 5px;}
        #son td{ text-align: left; padding: 0px 10px;}
        span{ text-align: center; float: left;}
    </style>
</head>

<body>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="#">权限类表</a></li>
    </ul>
</div>

<div class="rightinfo" style="position: relative">

            <span style=" position: absolute; right: 10px; top: 15px">
                <a href="/adminspurview/add" class="add-btn">添加</a>
            </span>


    <table class="tablelist">
        <thead>
        <tr>
            <th width="15%">项目</th>
            <th width="85%">
                <table width="100%">
                    <tr>
                        <td style="text-align: center; width: 10%;">权限</td>
                        <td style="text-align: center">子权限</td>
                    </tr>
                </table>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php if($list){?>
            <?php foreach($list as $key=>$val){?>
                <tr>
                    <td>
                        <?php echo $val['name'];?>
                        <a href="/adminspurview/edit/<?php echo $val['id']?>" title="编辑"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_edit.gif" /></a>
                        <a href="/adminspurview/del/<?php echo $val['id']?>" title="删除"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_drop.gif" /></a>
                        <a href="/adminspurview/add/<?php echo $val['id']?>" title="添加"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_add.gif" /></a>
                    </td>
                    <td>
                        <table id="son_child" width="100%">
                            <?php if(@$val['child']){?>
                                <?php foreach(@$val['child'] as $k=>$v){?>
                                    <tr>
                                        <td>
                                            <table id="son">
                                                <tr>
                                                    <td>
                                                        <?php echo $v['name'];?>
                                                        <a href="/adminspurview/edit/<?php echo $v['id']?>" title="编辑"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_edit.gif" /></a>
                                                        <a href="/adminspurview/del/<?php echo $v['id']?>" title="删除"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_drop.gif" /></a>
                                                        <a href="/adminspurview/add/<?php echo $v['id']?>" title="添加"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_add.gif" /></a>
                                                    </td>
                                                    <?php  if(@$v['child']){ ?>
                                                        <td>
                                                            <table id="son-child">
                                                                <tr>
                                                                    <?php
                                                                    if(@$v['child']){foreach(@$v['child'] as $kk=>$vv){  ?>
                                                                        <td>
                                                                            <?php echo $vv['name']?>
                                                                            <a href="/adminspurview/edit/<?php echo $vv['id']?>" title="编辑"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_edit.gif" /></a>
                                                                            <a href="/adminspurview/del/<?php echo $vv['id']?>" title="删除"><img src="<?php echo $domain['static']['url'];?>/admin/images/icon_drop.gif" /></a>
                                                                        </td>
                                                                    <?php }}?>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    <?php }?>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                        </table>
                    </td>

                </tr>
            <?php } }?>
        </tbody>
    </table>

    <div class="tip">
        <div class="tiptop"><span>提示信息</span><a></a></div>
        <div class="tipinfo">
            <span><img src="<?php echo $domain['static']['url'];?>/admin/images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认对信息的修改 ？</p>
                <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
            </div>
        </div>
        <div class="tipbtn">
            <input name="" type="button"  class="sure" value="确定" />&nbsp;
            <input name="" type="button"  class="cancel" value="取消" />
        </div>
    </div>
</div>
</body>
</html>
