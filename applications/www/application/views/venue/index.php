<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-婚宴场馆</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('venue.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">
        <div class="page-main">
            <ul class="venue-list">
                <?php foreach($list as $k => $v):?>
                <a href="/venue/detail?id=<?php echo $v['id']?>">
                <li>
                    <div class="img-cont"><span><i></i><?php echo count($v['images']);?>张</span><img src="<?php echo $v['cover_img']?>"></div>
                    <div class="info">
                        <p><?php echo $v['name']?><i></i></p>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th>最大桌数</th>
                                <td><?php echo $v['max_table']?>桌</td>
                                <th>容纳人数</th>
                                <td><?php echo $v['container']?>人</td>
                            </tr>
                            <tr>
                                <th>场地面积</th>
                                <td><?php echo intval($v['area_size'])?>平</td>
                                <th>楼层/层高</th>
                                <td><?php echo $v['floor']?>层/<?php echo $v['height']?>米</td>
                            </tr>
                            <tr>
                                <th>适合类型</th>
                                <td><?php echo $v['fit_type']?></td>
                                <th>低消</th>
                                <td><?php echo intval($v['min_consume'])?>/桌</td>
                            </tr>
                            <tr>
                                <th>设备支持</th>
                                <td colspan="3"><?php echo $v['device']?></td>
                            </tr>
                        </table>
                    </div>
                </li>
                </a>
                <?php endforeach;?>
            </ul>
        </div>
        
    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use('public',function(a){
         a.load()
        })
    </script>
</body>
</html>
