<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/dinner/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin:10px">

<!-- 
<a class="btn btn-primary" href="/dinner/add?year=<?php echo isset($year) ? $year : ''?>&month=<?php echo isset($month) ? $month : ''?>">添加订单</a>
-->

    <!-- search -->
    <div class="row">
        <form class="form-inline">
            <div class="form-group">
                <label>场馆：</label>
                <select class="form-control" name="venue_id" >
                     <option value="">请选择场馆</option>
                     <?php foreach ($venue as $k => $v):?>
                     <option value="<?php echo $k?>"   <?php echo $k==$venue_id?'selected':''  ?> ><?php echo $v?></option>
                     <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label>宴会日期：</label>
                <input type="text" name="create_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期" value="<?php if(isset($create_time)){echo $create_time;}?>">
            </div>
            
            <div class="form-group">
                <label>客户姓名：</label>
                <input type="text" name="name" class="form-control" style="height: 34px;" value="<?php if(isset($name)){echo $name;}?>">
            </div>
            
            <div class="form-group">
                <label>手机号：</label>
                <input type="text" name="mobile" class="form-control" style="height: 34px;" value="<?php if(isset($mobile)){echo $mobile;}?>">
            </div>
            
            <button class="btn btn-primary" type="submit">搜索</button>
        </form>
    </div>
    <hr>

    <!-- list -->
    
    <!-- 
        <legend><?php echo isset($year) ? $year : ''?>年<?php echo isset($month) ? $month : ''?>月 所有订单</legend>        
    -->
        <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><div style="width:100px">合同编号</div></th>
                    <th><div style="width:80px">订单类型</div></th>
                    <th><div style="width:70px">日期</div></th>
                    <th><div style="width:60px">农历</div></th>
                    <th><div style="width:60px">星期</div></th>
                    <th>姓名</th>
                    <th><div style="width:40px">桌数</div></th>
                    <th>类型</th>
                    <th>餐标</th>
                    <th><div style="width:100px">宴会厅</div></th>
                    <th><div style="width:90px">联系方式</div></th>
                    <th>订金</th>
                    <!--<th><div style="width:60px">备注</div></th>-->
                    <th>麻将</th>
                    <th>接单人</th>
                    <th>签订合同日期</th>
                    <?php if ( !isset($is_unusual) ): ?>
                    <th>审核状态</th>
                    <?php else: ?>
                    <th>异常状态</th>
                    <?php endif; ?>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo isset($v['contract_num']) ? $v['contract_num'] : ''?></td>
                    <td><?php echo $v['contract_type_text']?></td>
                    <td><?php echo isset($v['solar_time']) ? $v['solar_time'] : ''?></td>
                    <td><?php echo isset($v['lunar_time']) ? $v['lunar_time'] : ''?></td>
                    <td><?php echo isset($v['week']) ? $v['week'] : ''?></td>
                    <td><?php echo isset($v['customer_name']) ? $v['customer_name'] : ''?></td>
                    <td><?php echo isset($v['menus_count']) ? $v['menus_count'] : ''?></td>
                    <td>
                        <?php
                            foreach (C('party') as $key => $val){
                                if($v['venue_type'] == $val['id']){
                                    echo $val['name'];
                                }
                            }
                        ?>
                    </td>
                    <td><?php echo isset($v['menus_name']) ? $v['menus_name'] : ''?></td>
                    <td><?php echo isset($v['venue_name']) ? $v['venue_name'] : ''?></td>
                    <td><?php echo isset($v['customer_mobile']) ? $v['customer_mobile'] : ''?></td>
                    <td><?php echo isset($v['deposit']) ? $v['deposit'] : ''?></td>
        		    <!--<td><?php echo isset($v['remark']) ? $v['remark'] : ''?></td>-->
        		    <td><?php echo isset($v['chess_card']) ? $v['chess_card'] : ''?></td>
                    <td><?php echo isset($v['receiver']) ? $v['receiver'] : ''?></td>
                    <td><?php echo isset($v['contract_date']) ? $v['contract_date'] : ''?></td>
                    <?php if ( !isset($is_unusual) ): ?>
                    <td><?php echo $color_name[$v['is_examined']] ;?></td>
                    <?php else: ?>
                    <td><?php echo $is_del[$v['is_del']]; ?></td>
                    <?php endif; ?>
                    <td>
                    <?php if(isset($v['id'])):?>
                        <!--<a class="btn btn-primary btn-xs" href="/dinner/show_detail/<?php echo $v['id']?>">详情</a>-->
                        <!--<a class="btn btn-primary btn-xs" href="/dinner/album?dinner_id=<?php echo $v['id']?>">相册</a>-->
                        <!--<a class="btn btn-primary btn-xs" href="/dinner/add_video/<?php echo $v['id']?>">视频</a>-->
                        <!--<a class="btn btn-primary btn-xs up_order" data-id="<?php echo $v['id']?>">置顶</a>-->
                        <!--<a href="/dinner/edit/<?php echo $v['id']?>" class="btn btn-primary btn-xs">修改</a>-->
                        <!--<a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>-->
                        <!--<a class="btn btn-primary btn-xs change_record"  href="/dinner/change_record/<?php echo $v['id']?>">变更记录</a>-->
                        <!--<a class="btn btn-primary btn-xs examination" data-id="<?php echo $v['id']; ?>" data-examination_suatus="<?php echo $v['is_examined']; ?>" data-examination_reason="<?php echo $v['examined_reason']; ?>">审核</a> -->
                   
                        <a class="btn btn-primary btn-xs" href="/dinner/show_detail/<?php echo $v['id']?>">详情</a>
                        <?php if( !isset($is_unusual) ): ?>
                            <?php if( $v['is_examined'] != C('dinner.examine.backend_add.id') ): ?>
                                <a class="btn btn-primary btn-xs" href="/dinner/view_contract_PDF/<?php echo $v['id']?>">查看合同原件</a>
                            <?php endif; ?>
                            <?php if(in_array($v['is_examined'], [C('dinner.examine.to_archive.id'), C('dinner.examine.archived.id'), C('dinner.examine.backend_add.id')])): ?>
                                <a class="btn btn-primary btn-xs" href="/consume/detail?dinner_id=<?php echo $v['id'] ?>">消费清单</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        </div>
        <!-- page -->
        <div class="row">
            <nav style="float: right">
                <ul class="pagination">
                    <li class="disabled"><a>共<?php if(isset($count)){echo $count;}else{echo 0;}?>条</a></li>
                    <?php echo isset($pagestr) ? $pagestr : ''?>
                </ul>
            </nav>
        </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('dinner.js', 'admin')?>'], function(a){
		a.del();
		a.show_tables();
		a.up_show();
        a.examination();
        a.wdate();
	})
</script>
</body>
</html>
