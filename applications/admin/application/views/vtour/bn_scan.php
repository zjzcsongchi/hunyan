<!DOCTYPE html>
<html>
<head>
	<title>VR全景--<?php echo $info['name']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
	<style>
		@-ms-viewport { width:device-width; }
		@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
		html { height:100%; }
		body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }
	</style>
	<link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    </style>
	<link href="<?php echo css_js_url('bn_vtour.css', 'admin')?>" type="text/css" rel="stylesheet" />
</head>
<body>

<script src="<?php echo $domain['static']['url']?>/krpano/tour.js"></script>
<div class="textfield">
  <span>人气：<?php echo $info['scan_count'] ?></span>
  <br>
  <span>点赞：<?php echo $info['zan'] ?></span>
</div>
<?php if(!empty($info['logo'])):?>
<img class="logo" src="<?php echo get_img_url($info['logo'])?>"/>
<?php else:?>
<img class="logo" src="<?php echo $domain['static']['url']?>/admin/images/bainian_vr_logo.png"/>
<?php endif;?>

<!-- 控制背景音乐按钮 -->
<?php if(!empty($info['bgmusic'])):?>
<div class="bgmusic_btn"></div>
<audio id="audioplay" loop src="<?php echo get_img_url($info['bgmusic']) ?>" autoplay style="display:none;"></audio>
<?php endif;?>
<!-- 控制自动巡游按钮 -->
<div class="autoscan_btn"></div>
<!-- 关闭热点语音按钮 -->
<div class="voice_btn"></div>
<!-- 点赞按钮 -->
<div class="zan_cover">
<div class="<?php echo $is_zan ? 'zaned_btn' : 'zan_btn'?>" data-id="<?php echo $id ?>"></div>
</div>
<!-- 二维码显示 -->
<div class="qrcode">
    <p>扫码二维码查看</p>
    <img src="/publicservice/qr_code?link=<?php echo urlencode($domain['admin']['url'].'/vtour/scan/'.$id);?>" />
    <p>浏览数：<?php echo $info['scan_count']?></p>
</div>
<!-- 预定场馆按钮 -->
<div class="reserve">
    <button class="bespeak"  id="submit" data-id="<?php echo $info['venue_id']?>">立即预定</button>
</div>
<!-- 预定弹框-->
<div><p id="default_id" style="display:none"></p></div>
<div class="page-bg"></div>
<div class="popup-destine">
    <p class="close"></p>
    <p class="title">场馆预约</p>
    <input type="text" name="name" placeholder="&#x59D3;&#x540D;">
    <input type="tel" name="phone" placeholder="&#x7535;&#x8BDD;">
    <input type="text" name="time" class="time date" readonly id="datePicker" placeholder="&#x9884;&#x7EA6;&#x65F6;&#x95F4;">
    
    <select name="venue" id="venue">
    <?php if(isset($venue)):?>
    <?php foreach ($venue as $k=>$v):?>
       <option <?php if($k == $wedding):?>selected<?php endif;?> value="<?php echo $k?>"><?php echo $v?></option>
    <?php endforeach;?>
    <?php endif;?>
    </select>
    <input type="tel" name="menus_count" placeholder="预约桌数">
    <textarea name="address" placeholder="备注"></textarea>
    <p class="message"></p>
    <a href="javascript:;" class="but submit">立即预约</a>
</div>

<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
<?php $this->load->view('common/footer')?>
<script>
var m_domain = '<?php echo $domain['mobile']['url']?>';
var vtour_data = <?php echo $info['json']?>;
var imgUrl = "<?php echo $domain['img']['url']?>";
function krpano_ready(krpano){
    seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', '<?php echo css_js_url('vtour_venue.js', 'admin')?>'], function(vtour, venue){
      vtour.bgmusic_btn();
      vtour.onresize();
      vtour.auto_scan();
      venue.show();
      venue.submit();
      venue.datepick();
      venue.zan();
    })
}
//解析json为全景操作
//写在外面方便krpano js函数调用
function parse_json(){
    if(vtour_data.hotspot.length > 0){
        vtour_data.hotspot.forEach(function(value, key){
          if(value.scene == krpano.get('xml.scene')){
            value.attr.forEach(function(v, k){
              krpano.call("addhotspot("+v.name+")")
              var hotspot_name = "hotspot["+v.name+"].";
              for(var i in v){
                if(i == 'url' && v[i].indexOf('bai-nian.com') === -1){
                    krpano.set(hotspot_name+i, imgUrl+'/image/'+v[i])
                }else{
                    krpano.set(hotspot_name+i, v[i])
                }
              }
              
              return false;
            })
          }
        })
    }
}
//删除热点上的文字
function drop_font(){
  if(vtour_data.hotspot.length > 0){
    vtour_data.hotspot.forEach(function(value, key){
      if(value.scene == krpano.get('xml.scene')){
        value.attr.forEach(function(v, k){
          krpano.call("removehotspot("+v.name+")")
          krpano.call("addhotspot("+v.name+")")
          var hotspot_name = "hotspot["+v.name+"].";
          for(var i in v){
            if(i == 'url' && v[i].indexOf('bai-nian.com') === -1){
                krpano.set(hotspot_name+i, imgUrl+'/image/'+v[i])
            }else{
                krpano.set(hotspot_name+i, v[i])
            }
          }
          
          return false;
        })
      }
    })
  }
  //不显示预定按钮
  var ele = document.getElementById('submit');
  if(ele.style.getPropertyValue('display') == 'none'){
	ele.style.display = 'inline-block';
  }else{
    ele.style.display = 'none';
  }
}
</script>
	<script>
		embedpano({id:"krpano", swf:"<?php echo $domain['static']['url']?>/krpano/tour.swf", xml:"/vtour/load_xml/<?php echo $id?>",onready:krpano_ready, target:"pano", html5:"prefer", mobilescale:1.0, passQueryParameters:true, });
	</script>
</div>

</body>
</html>