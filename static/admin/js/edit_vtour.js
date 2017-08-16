/**
 * 编辑VR全景
 * @author chaokai@gz-zc.cn 
 */
define(function(require, exports, module){
  require('dialog')
  require('jqueryswf')
  require('swfupload')
  require('bootstrap')
  var spin = require('spin_lib');
  var swfupload = require('admin_uploader')
  var edit_article = require("vtour_edit_article")
  var edit_vtour = require("vtour_edit_vtour")
  var edit_link = require("vtour_edit_link")
  var edit_voice = require("vtour_edit_voice")
  var edit_video = require("vtour_edit_video")
  module.exports = {
      
      template:{
        vtour:{
          url:static_domain+"/krpano/skin/vtourskin_hotspot.png",
          scale:0.5,
        },
        link:{
          url:static_domain+"/krpano/skin/link_hotspot.png",
          scale:0.5,
        },
        voice:{
          url:static_domain+"/krpano/skin/static_music.png",
          scale:0.5,
        },
        video:{
          
        },
        article:{
          scale:0.5,
        }
      },
      //热点类型对应数据
      hotspot_type:{
        vtour:{name:'全景切换'},
        link:{name:'超链接'},
        voice:{name:'语音热点'},
        video:{name:'视频热点'},
        article:{name:'图文列表'}
      },
      //初始化页面数据； 场景列表
      //热点可拖动
      init:function(){
        this.set_hotspot_click();
      },
      //添加热点
      add_hotspot:function(hotspot_val){
        var obj = this;
        var hotspot_count = 0;
        var hotspot_index = vtour_data.hotspot.length;
        var is_exist = false;
        krpano.call('div(now_x, stagewidth, 2); div(now_y, stageheight, 2); screentosphere(now_x, now_y, now_ath, now_atv);')
        var hotspot_value = obj.template[hotspot_val.hotspot_type];
        hotspot_value.name = obj.get_uuname();
        hotspot_value.ath = krpano.get("now_ath")
        hotspot_value.atv = krpano.get("now_atv")
        hotspot_value.scene = krpano.get("xml.scene")

        $.extend(hotspot_value, hotspot_val)

        hotspot_value = JSON.parse(JSON.stringify(hotspot_value))
        vtour_data.hotspot.push(hotspot_value); 
        //显示热点箭头
        if(hotspot_value.hotspot_type == 'video'){
          var id = $('#id').val();
          trip_attr('ondown')
          trip_attr('onclick')
          trip_attr('onload')
          trip_attr('onout')
          trip_attr('onover')
          $.post('/vtour/edit', {id:id, data:vtour_data}, function(data){
            if(data.status == 0){
              window.location.href="/vtour/edit/"+id;
            }else{
              var d = dialog({
              title:'提示',
              content:data.msg,
              okValue:'确定',
              zIndex:10001,
              ok:function(){

              }
            })
            d.width(320);
            d.showModal();
            }
          })
        }
        parse_json(vtour_data)
        
        obj.show_hotspot_list(hotspot_value.hotspot_type);
        obj.set_hotspot_move(hotspot_value.name);
      },
      update_hotspot:function(hotspot){
        var hs_key;
        vtour_data.hotspot.forEach(function(value, key){
            if(value.id == hotspot.id){
              hs_key = key;
            }
        })
        vtour_data.hotspot[hs_key] = hotspot;
        if(hotspot.hotspot_type == 'video'){
          var id = $('#id').val();
          trip_attr('ondown')
          trip_attr('onclick')
          trip_attr('onload')
          trip_attr('onout')
          trip_attr('onover')
          $.post('/vtour/edit', {id:id, data:vtour_data}, function(data){
            if(data.status == 0){
              window.location.href="/vtour/edit/"+id;
            }else{
              var d = dialog({
              title:'提示',
              content:data.msg,
              okValue:'确定',
              zIndex:10001,
              ok:function(){

              }
            })
            d.width(320);
            d.showModal();
            }
          })
        }
        //更新界面
        parse_json(vtour_data)
        
        this.show_hotspot_list(hotspot.hotspot_type);//更新列表
      },
      //点击保存热点，选择指向的场景
      select_scene:function(){
        $("#save_hotspot").click(function(){
          if(!now_hotspot){
            alert('未选择热点')
            return false;
          }
          
          var scene = $('#select_scene').val();
          var hotspot_text = $('#hotspot_text').val();
          vtour_data.hotspot.forEach(function(v, k){
              if(v.name == now_hotspot){
                vtour_data.hotspot[k].linkedscene = scene;
                krpano.set('hotspot['+now_hotspot+'].linkedscene', scene)
                return false;
              }
          })
          //按钮样式控制
          $('#select_scene').css({display:'none'})
          $('#hotspot_text').css({display:'none'})
          $(this).css({display:'none'})
          $('#hotspot').prop('disabled', false)
        })
      },
      //场景切换
      scene_change:function(){
        var scene_count;
        var intv;
        intv = setInterval(function(){
          scene_count = krpano.get('scene.count')
          if(scene_count > 0){
            for(i=0; i<scene_count; i++){
              krpano.set("scene[scene"+i+"].onstart", "jscall(if(vtour_data){ parse_json(vtour_data); console.log(vtour_data)})")
            }
            clearInterval(intv)
          }
        }, 100)
      },
      //保存所有修改
      save:function(){
        $('#save').click(function(){
          var id = $('#id').val();
          trip_attr('ondown')
          trip_attr('onclick')
          trip_attr('onload')
          trip_attr('onout')
          trip_attr('onover')
          var spiner = spin.show();
          $.post('/vtour/edit', {id:id, data:vtour_data}, function(data){
            var d = dialog({
              title:'提示',
              content:data.msg,
              okValue:'确定',
              zIndex:10001,
              ok:function(){
                spin.close(spiner);
              }
            })
            d.width(320);
            d.showModal();
          })
        })
      },
      //不同类型热点切换
      hotspot_change:function(){
        var obj = this;
        $('.hotspot_type').click(function(){
          var hotspot_type = $(this).data('type')
          $('#hotspot_list .panel-heading').text('已添加热点（'+obj.hotspot_type[hotspot_type].name+'）')
          $('#hotspot_type_value').val(hotspot_type);
          obj.show_hotspot_list(hotspot_type)
          
          $('#hotspot_list').removeClass('hide').addClass('show')
          obj.change_to_noedit();
        })
      },
      //点击添加热点操作
      add_hotspot_act:function(){
        var obj = this;
        $('.add_hotspot').click(function(){
          var hotspot_type = $('#hotspot_type_value').val();
         
          switch(hotspot_type){
          case 'vtour':
            //如果是全景切换，
            edit_vtour.add(obj)
            break;
          case 'link':
            edit_link.add(obj)
            break;
          case 'voice':
            edit_voice.add(obj)
            break;
          case 'video':
            edit_video.add(obj)
            break;
          case 'article':
            edit_article.add(obj);
            break;
          }
        })
        //点击选中热点后对应热点可移动
        $(document).on('click', '.select_hotspot', function(){
          var hotspot = $(this).find('input').val();
          obj.change_to_noedit();//其余热点为不可移动
          obj.set_hotspot_move(hotspot)
          krpano.call('looktohotspot('+hotspot+')')
        })
      },
      //设置热点为可移动状态
      set_hotspot_move:function(hotspot){
        krpano.set('hotspot['+hotspot+'].ondown', "spheretoscreen(ath, atv, hotspotcenterx, hotspotcentery, 'l'); sub(drag_adjustx, mouse.stagex, hotspotcenterx); sub(drag_adjusty, mouse.stagey, hotspotcentery); asyncloop(pressed, sub(dx, mouse.stagex, drag_adjustx); sub(dy, mouse.stagey, drag_adjusty); screentosphere(dx, dy, ath, atv); );")
        vtour_data.hotspot.forEach(function(value, key){
          if(value.name == hotspot){
            krpano.set('hotspot['+hotspot+'].onup', "jscall(vtour_data.hotspot["+key+"].ath=krpano.get('hotspot["+value.name+"].ath');vtour_data.hotspot["+key+"].atv=krpano.get('hotspot["+value.name+"].atv');)")
          }
        })
      },
      //设置所有热点为不可修改状态
      change_to_noedit:function(){
        vtour_data.hotspot.forEach(function(value, key){
            krpano.set('hotspot['+value.name+'].ondown', '')
            krpano.set('hotspot['+value.name+'].onup', '')
        })
      },
      //设置所有热点点击事件
      set_hotspot_click:function(){
        var obj = this;
        vtour_data.hotspot.forEach(function(value, key){
            krpano.set('hotspot['+value.name+'].onclick', '')
        })
      },
      //根据不同热点类型显示列表
      show_hotspot_list:function(hotspot_type){
        var hotspot_list=[];
        //查找当前场景下的热点
        vtour_data.hotspot.forEach(function(v, k){
          if(v.scene == krpano.get('xml.scene')){
            if(v.hotspot_type == hotspot_type){
              hotspot_list.push(v)
            }
            return false;
          }
        })

        hotspot_list = JSON.parse(JSON.stringify(hotspot_list))
        hotspot_list.forEach(function(v,k){
          if(typeof v.ico_url != 'undefined' && v.ico_url != ''){
            v.url = v.ico_url;
          }
          if(typeof v.url != 'undefined' && v.url.indexOf('bai-nian.com') === -1){
            v.url = imgUrl+'/image/'+v.url;
          }
        })
        var list_content = '<ul class="list-unstyled">'
        switch(hotspot_type){
        case 'vtour':
          hotspot_list.forEach(function(v, k){
            list_content += '<li><div class="radio select_hotspot"><label style="color:#000"><input type="radio" name="hotspot_list" value="'+v.name+'">'+
            '<img src="'+v.url+'" style="width:30px;height:30px;"> '+v.hotspot_name+'</label>'+
            '<button class="btn btn-info btn-xs pull-right del_hotspot">删除</button>'+
            '<button class="btn btn-info btn-xs pull-right edit_hotspot">修改</button></li>';
          })
          break;
        case 'link':
          hotspot_list.forEach(function(v, k){
            list_content += '<li><div class="radio select_hotspot"><label style="color:#000"><input type="radio" name="hotspot_list" value="'+v.name+'">'+
            '<img src="'+v.url+'" style="width:30px;height:30px;"> '+v.hotspot_name+'</label>'+
            '<button class="btn btn-info btn-xs pull-right del_hotspot">删除</button>'+
            '<button class="btn btn-info btn-xs pull-right edit_hotspot">修改</button></li>';
          })
          break;
        case 'voice':
          hotspot_list.forEach(function(v, k){
            list_content += '<li><div class="radio select_hotspot"><label style="color:#000"><input type="radio" name="hotspot_list" value="'+v.name+'">'+
            '<img src="'+v.url+'" style="width:30px;height:30px;"> '+v.hotspot_name+'</label>'+
            '<button class="btn btn-info btn-xs pull-right del_hotspot">删除</button>'+
            '<button class="btn btn-info btn-xs pull-right edit_hotspot">修改</button></li>';
          })
          break;
        case 'video':
          hotspot_list.forEach(function(v, k){
            list_content += '<li><div class="radio select_hotspot"><label style="color:#000"><input type="radio" name="hotspot_list" value="'+v.name+'">'+
            '<img src="'+v.posterurl+'" style="width:30px;height:30px;"> '+v.hotspot_name+'</label>'+
            '<button class="btn btn-info btn-xs pull-right del_hotspot">删除</button>'+
            '<button class="btn btn-info btn-xs pull-right edit_hotspot">修改</button></li>';
          })
          break;
        case 'article':
          hotspot_list.forEach(function(v, k){
            list_content += '<li><div class="radio select_hotspot"><label style="color:#000"><input type="radio" name="hotspot_list" value="'+v.name+'">'+
            '<img src="'+v.url+'" style="width:30px;height:30px;"> '+v.hotspot_name+'</label>'+
            '<button class="btn btn-info btn-xs pull-right del_hotspot">删除</button>'+
            '<button class="btn btn-info btn-xs pull-right edit_hotspot">修改</button></li>';
          })
        }
        
        list_content += '</ul>'
        $('#hotspot_list .panel-body').html(list_content)
      },
      //修改热点
      edit_hotspot:function(){
        var obj = this;
        $(document).on('click', '.edit_hotspot', function(){
          var hotspot = $(this).parent().find('input').val();
          var hotspot_arr;
          vtour_data.hotspot.forEach(function(v, k){
              if(v.name == hotspot){
                hotspot_arr = v;
                return false;
              }
          })
          switch(hotspot_arr.hotspot_type){
            case 'vtour':
              edit_vtour.edit(obj, hotspot_arr)
              break;
            case 'link':
              edit_link.edit(obj, hotspot_arr)
              break;
            case 'voice':
              edit_voice.edit(obj, hotspot_arr)
              break;
            case 'video':
              edit_video.edit(obj, hotspot_arr)
              break;
            case 'article':
              edit_article.edit(obj, hotspot_arr)
              break;
          }
          
        })
      },
      //删除热点
      del_hotspot:function(){
        var obj = this;
        $(document).on('click', '.del_hotspot', function(){
          var hotspot = $(this).parent().find('input').val();
          var d = dialog({
            title:'提示',
            content:'确认删除？',
            okValue:'确认',
            zIndex:10001,
            calcelValue:'取消',
            cancel:function(){},
            ok:function(){
              var hotspot_type = $('#hotspot_type_value').val();
              vtour_data.hotspot.forEach(function(value, key){
                  if(value.name == hotspot){
                    vtour_data.hotspot.splice(key, 1);
                    if(typeof vtour_data.delete == 'undefined'){
                      vtour_data.delete = [];
                    }
                    vtour_data.delete.push(value.id)
                    return false;
                  }
              })
              //刷新界面
              krpano.call('removehotspot('+hotspot+')')
              parse_json(vtour_data)
              
              obj.show_hotspot_list(hotspot_type)
            }
          })
          
          d.width(320)
          d.showModal();
        })
      },
      //切换显示热点设置及视角设置
      change_set:function(){
        $('#hotspot').click(function(){
          $('#hotspot_panel').removeClass('hide').addClass('show');
          $('#view_panel').addClass('hide').removeClass('show');
        })
        $('#view').click(function(){
          $('#hotspot_panel').removeClass('show').addClass('hide');
          $('#view_panel').addClass('show').removeClass('hide');
        })
      },
      //设置初始视角 
      set_current_view:function(){
        $('#current_view').click(function(){
          krpano.call('div(now_x, stagewidth, 2); div(now_y, stageheight, 2); screentosphere(now_x, now_y, now_ath, now_atv);')
          var hlookat = krpano.get("now_ath")
          var vlookat = krpano.get("now_atv")
          
          var view_index = 0;
          if(typeof vtour_data.view != 'undefined' && vtour_data.view.length > 0){
            vtour_data.view.forEach(function(value, key){
              if(value.scene == krpano.get('xml.scene')){
                view_index = key;
                return false;
              }
            })
          }
          vtour_data.view[view_index].hlookat = hlookat;
          vtour_data.view[view_index].vlookat = vlookat;
        })
      },
      //回到初始视角
      backto_current_view:function(){
        $('#backto_current_view').click(function(){
          //当前显示的初始视角
          var ath = krpano.get('view.hlookat');
          var atv = krpano.get('view.vlookat');
          //保存的初始视角
          vtour_data.view.forEach(function(value, key){
            if(value.scene == krpano.get('xml.scene')){
              var s_ath = value.hlookat;
              var s_atv = value.vlookat;
              if(s_ath != ath && s_atv != atv){
                ath = s_ath;
                atv = s_atv;
              }
            }
          })
          
          krpano.call('lookto('+ath+','+atv+')');
        })
      },
      //初始视角设置和FOV设置切换
      view_fov_change:function(){
        var obj = this;

        var view_set_show = function(){
          $("#view_set").addClass("show").removeClass("hide")
        }
        var view_set_hide = function(){
          $('#view_set').addClass('hide').removeClass('show')
        }
        var fov_set_show = function(){
          $('#fov_set').addClass("show").removeClass('hide')
        }
        var fov_set_hide = function(){
          $("#fov_set").addClass("hide").removeClass("show")
        }

        $('.view_set_wrap').click(function(){
          if($(this).data("type") == 'view'){
            view_set_show();
            fov_set_hide();
          }else if($(this).data('type') == 'fov'){
            fov_set_show();
            view_set_hide();

            var view = obj.get_current_fov();
            $("input[name=fov_default]").val(view.fov)
            $("input[name=fov_min]").val(view.fovmin)
            $("input[name=fov_max]").val(view.fovmax)
          }
        })
        //点击保存fov设置
        $("#fov_save").click(function(e){
          e.preventDefault();
          var fov = $("input[name=fov_default]").val()
          var fovmin = $("input[name=fov_min]").val()
          var fovmax = $("input[name=fov_max]").val()

          if(!fov || !fovmin || !fovmax){
            $(".help-block").text("所有值不能为空");
            return false;
          }

          var view = obj.get_current_fov();
          view.fov = fov;
          view.fovmin = fovmin;
          view.fovmax = fovmax;

          obj.set_current_fov(view)

          //保存到数据库
          $("#save").trigger("click");
        })
      },
      get_current_fov:function(){
        var view = {};
          vtour_data.view.forEach(function(v, k){
            if(v.scene == krpano.get('xml.scene')){
              view = v;
              return false
            }
          })
          return view;
      },
      set_current_fov:function(view){
        vtour_data.view.forEach(function(v, k){
          if(v.scene == krpano.get('xml.scene')){
            v = view;
            return false;
          }
        })
      },
      //判断热点是默认图标还是自定义添加，参数为一个热点配置
      ico_is_default:function(hotspot){
        var is_default = false;
        if(typeof hotspot.ico_url != 'undefined' && hotspot.ico_url != ''){
          return true;
        }
        default_ico.forEach(function(v, k){
          if(v.url == hotspot.url){
            is_default = true;
            return false;
          }
        })

        return is_default;
      },
      get_uuname:function(){
        var date = new Date();
        return 'h_'+date.getTime();
      },
      //获取图片地址
      get_img_url:function(url){
        if(url.indexOf(imgUrl) !== -1){
          return url;
        }
        return imgUrl+'/image/'+url;
      },
      //获取图片地址
      get_video_url:function(url){
        if(url.indexOf(imgUrl) !== -1){
          return url;
        }
        return imgUrl+'/video/'+url;
      }
  }
  
})
//保存当前热点名称
var now_hotspot;

//去除不需要保存的属性
function trip_attr(attr){
  if(vtour_data.hotspot.length > 0){
    vtour_data.hotspot.forEach(function(value, key){
        vtour_data.hotspot[key][attr] = '';
    })
  }
}
