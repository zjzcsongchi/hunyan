<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <button class="btn btn-primary" onclick="window.history.go(-1);">返回</button>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>联系人(电话)</th>
                    <th>场馆</th>
                    <th>宴席日期(农历)</th>
                    <th>餐标</th>
                    <th>经办人(电话)</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list) && $list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <?php if(isset($v['customer_name']) && $v['customer_name']):?>
                    <td><?php echo $v['customer_name']?>
                    <?php echo $v['customer_mobile']?></td>
                    <?php else:?>
                    <td>
                    <?php echo $v['roles_main']?>
                    <?php echo $v['roles_main_mobile']?>
                    </td>
                    <?php endif;?>
                    <td><?php echo $venue_name[$v['id']]?></td>
                    <td><?php echo $v['solar_time']?>(<?php echo $v['lunar_time']?>)</td>
                    <td><?php echo $v['menus_name']?></td>
                    <td><?php echo $admins[$v['create_admin']]?>
                        <?php echo $admins_tel[$v['create_admin']]?>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/consume/dinner_detail/<?php echo $v['id']?>">详情</a>
                        <a class="btn btn-primary btn-xs" href="/consume/edit?dinner_id=<?php echo $v['id']?>">添加消费清单</a>
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
                <li class="disabled"><a>共<?php echo $data_count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
