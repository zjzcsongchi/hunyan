//场景解析公共js
//解析json为全景操作
//写在外面方便krpano js函数调用
function parse_json(){
  if(vtour_data.hotspot.length > 0){
      vtour_data.hotspot.forEach(function(value, key){
        if(value.scene == krpano.get('xml.scene') && value.hotspot_type != 'video'){
          krpano.call("addhotspot("+value.name+")")
          var hotspot_name = "hotspot["+value.name+"].";

          value.onloaded = ''; 
          if(value.tooltip){
            value.onloaded += 'if(!webvr.isenabled,add_all_the_time_tooltip());';
          }
          if(value.dynamic_param){
            value.onloaded += 'do_crop_animation('+value.dynamic_param+');'
          }
          //如果是场景切换
          if(value.hotspot_type == 'vtour'){
            value.onclick="if(linkedscene, if(linkedscene_lookat, txtsplit(linkedscene_lookat, ',', hs_lookat_h, hs_lookat_v, hs_lookat_fov); ); set(enabled, false); skin_hidetooltips(); tween(depth|alpha|oy|rx, 4000|0.0|-50|-60, 0.5, default, skin_loadscene(get(linkedscene), get(skin_settings.loadscene_blend)); if(hs_lookat_h !== null, skin_lookat(get(hs_lookat_h), get(hs_lookat_v), get(hs_lookat_fov)); delete(hs_lookat_h, hs_lookat_v, hs_lookat_fov); ); skin_updatescroll(); ); );jscall(if(vtour_data){ parse_json(vtour_data);})";
            value.onover = "tween(scale, 0.6)"
            value.onout = "tween(scale, 0.5)"
          }else if(value.hotspot_type == 'link'){
            value.onclick = "jscall(self.location='"+value.source_url+"')"
          }else if(value.hotspot_type == 'article'){
            value.onclick="js(show_layer("+value.id+", 'showarticle'))"
          }else if(value.hotspot_type == 'voice'){
            value.onclick = 'playsound('+value.name+','+imgUrl+'/image/'+value.source_url+'); jscall($(".voice_btn").show();$(".voice_btn").attr("data-name", "'+value.name+'"));)'
          }
          
          for(var i in value){
            if((i == 'url') && value[i].indexOf('bai-nian.com') === -1){
                krpano.set(hotspot_name+i, imgUrl+'/image/'+value[i])
            }else{
                krpano.set(hotspot_name+i, value[i])
            }
          }
          delete value.onclick;
          delete value.onloaded;
          delete value.onout;
          delete value.onover;
        }
      })
  }
  parse_comment(is_show);
  pause();
}
function parse_comment(is_show){
  if(typeof comment_data == 'undefined'){
    return false;
  }
  comment_data.forEach(function(v, k){
    if(is_show && v.scene_name == krpano.get('xml.scene')){
      krpano.call("addhotspot("+v.hotspot_name+")")
      var hotspot = 'hotspot['+v.hotspot_name+'].'
      krpano.set(hotspot+"url", "%SWFPATH%/skin/talk_ico.png")
      krpano.set(hotspot+"headurl", (typeof v.headurl == 'undefined') ? null : v.headurl)
      krpano.set(hotspot+"ath", v.ath)
      krpano.set(hotspot+"atv", v.atv)
      krpano.set(hotspot+"scale", 0.5)
      krpano.set(hotspot+"tooltip", v.content)
      krpano.set(hotspot+"onloaded", "if(!webvr.isenabled,add_img();add_comment_tooltip(););")
    }else{
      krpano.call("removehotspot("+v.hotspot_name+")")
    }
  })
}
//删除热点上的文字
function drop_font(){
  if(vtour_data.hotspot.length > 0){
    vtour_data.hotspot.forEach(function(value, key){
      if(value.scene == krpano.get('xml.scene')){
          krpano.call("removehotspot("+value.name+")")
          krpano.call("addhotspot("+value.name+")")
          var hotspot_name = "hotspot["+value.name+"].";

          value.onloaded = ''; 
          // if(value.tooltip != ''){
          //   value.onloaded += 'if(!plugin[webvr].isenabled,add_all_the_time_tooltip());';
          // }
          if(value.dynamic_param != ''){
            value.onloaded += 'do_crop_animation('+value.dynamic_param+');'
          }
          //如果是场景切换
          if(value.hotspot_type == 'vtour'){
            value.onclick="if(linkedscene, if(linkedscene_lookat, txtsplit(linkedscene_lookat, ',', hs_lookat_h, hs_lookat_v, hs_lookat_fov); ); set(enabled, false); skin_hidetooltips(); tween(depth|alpha|oy|rx, 4000|0.0|-50|-60, 0.5, default, skin_loadscene(get(linkedscene), get(skin_settings.loadscene_blend)); if(hs_lookat_h !== null, skin_lookat(get(hs_lookat_h), get(hs_lookat_v), get(hs_lookat_fov)); delete(hs_lookat_h, hs_lookat_v, hs_lookat_fov); ); skin_updatescroll(); ); );jscall(if(vtour_data){ parse_json(vtour_data);})";
            value.onover = "tween(scale, 0.6)"
            value.onout = "tween(scale, 0.5)"
          }else if(value.hotspot_type == 'link'){
            value.onclick = "jscall(self.location='"+value.source_url+"')"
          }
          
          for(var i in value){
            if((i == 'url') && value[i].indexOf('bai-nian.com') === -1){
                krpano.set(hotspot_name+i, imgUrl+'/image/'+value[i])
            }else{
                krpano.set(hotspot_name+i, value[i])
            }
          }
          delete value.onclick;
          delete value.onloaded;
          delete value.onout;
          delete value.onover;
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

//显示一个弹框层，用于展示图文或者播放视频
//id 热点id
//action 动作 playvideo：播放视频 showarticle:显示图文
function show_layer(id, action){
  //弹框背景层
  var layer = $("<div></div>")
  layer.attr("id", "show_layer")
  layer.css({"position":"absolute", "z-index":"10001", "width":"100%", "height":"100%", "top":"0", "opacity":"1"})

  //关闭弹窗按钮
  var close_btn = $("<div></div>")
  close_btn.css({"position":"absolute", "top":"4px", "right":"4px", "width":"40px", "height":"40px", "cursor":"pointer"})
  //关闭按钮图片
  var btn_img = $("<img>")
  btn_img.attr("src", staticUrl+"/krpano/skin/close.png")
  btn_img.css({"width":"100%", "height":"100%"})
  //关闭事件
  btn_img.click(function(){
    close_layer();
  })

  //弹框内容
  var content = $("<div></div>")
  content.css({"position":"absolute", "width":"100%", "height":"auto", "vertical-align":"middle", "border":"none", "overflow-y":"auto", "-webkit-overflow-scrolling":"touch"})

  close_btn.append(btn_img)
  layer.append(content)
  layer.append(close_btn)
  $("body").append(layer)

  //显示加载进度
  var loading = weui.loading("加载中...");

  //关闭弹框
  var close_layer = function(){
    layer.remove();
  }
  //显示弹框背景
  var show_layer_bg = function(){
    layer.css({"background":"rgba(0,0,0,0.7)"})
  }

  //加载视频
  var playvideo_action = function(){
    $.get("/vtour/playvideo", {id:id}, function(data){
      show_layer_bg()
      loading.hide()
      if(data.status != 0){
        weui.alert(data.msg, close_layer)
      }else{
        content.html(data.data)
        content.css({"top":"50%", "margin-top":"-100px"})
      }
    })
  }
  //加载文章内容
  var load_article = function(){
    show_layer_bg()
    loading.hide()
    var window_height = $(window).height();
    var height = window_height-110;
    vtour_data.hotspot.forEach(function(value, key){
      if(value.id == id){
        content.css({"position":"relative", "background":"#fff", "height":height+"px", "padding-left":"5px", "padding-right":"5px", "max-width":"820px", "margin":"50px auto"})
        content.html(value.article_content)
        return false;
      }
    })
  }

  switch(action)
  {
    case 'playvideo':
      playvideo_action();
      break;
    case 'showarticle':
      load_article()
      break;
  }


}