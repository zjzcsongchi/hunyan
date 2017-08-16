/**
 * 全景图制作js
 * @author chaokai@gz-zc.cn 
 */
define(function(require, exports, module){
  
  var spin = require('spin_lib')
  var common = require('public')
  require('weui')
  require('dragula')
  module.exports = {
      make:function(){
        $('#make_vtour').click(function(){
          var data = $('form').serialize();
          var spiner = spin.show();
          
          $.post('/vtourscene/add', data, function(data){
            spin.close(spiner)
            if(data.status != 0){
              common.showDialog(data.msg)
            }else{
              common.showDialog('制作成功', '提示信息', '/vtourscene');
            }
          })
        })
      },
      //修改场景
      edit_scene:function(){
        $('#make_vtour').click(function(){
          var data = $('form').serialize();
          var spiner = spin.show();
          
          $.post('/vtourscene/edit', data, function(data){
            spin.close(spiner)
            if(data.status != 0){
              common.showDialog(data.msg)
            }else{
              common.showDialog('制作成功', '提示信息', '/vtourscene');
            }
          })
        })
      },
      //合成场景
      add:function(){
        $('#add_vtour').click(function(){
          var data = $('form').serialize();
          var spiner = spin.show();
          
          $.post('/vtour/add', data, function(data){
            spin.close(spiner)
            if(data.status != 0){
              common.showDialog(data.msg)
            }else{
              common.showDialog('制作成功', '提示信息', '/vtour');
            }
          })
        })
      },
      //ajax加载场景列表
      ajax_scene:function(){
        var data = {};
        if(arguments.length > 0){
          data.id = arguments[0]
        }
        $('#scene_type').on('change', function(){
          data.type = $(this).val();
          $.get('/vtour/ajax_scene', data, function(data){
            if(data.status == 0){
              $('#scene_list').html(data.data)
            }
          })
        })
      },
      //删除场景操作
      del:function(){
        $('.del').click(function(){
          var id = $(this).data('id')
          var d = dialog({
            title:'提示',
            content:'确认删除？',
            okValue:'确认',
            cancelValue:'取消',
            cancel:function(){},
            ok:function(){
              $.get('/vtourscene/del', {id:id}, function(data){
                if(data.status == 0){
                  window.location.href="/vtourscene/index";
                }
              })
            }
          })
          d.width(320)
          d.showModal()
        })
      },
      //删除全景
      del_vtour:function(){
        $('.del').click(function(){
          var id = $(this).data('id')
          var d = dialog({
            title:'提示',
            content:'确认删除？',
            okValue:'确认',
            cancelValue:'取消',
            cancel:function(){},
            ok:function(){
              $.get('/vtour/del', {id:id}, function(data){
                if(data.status == 0){
                  window.location.href="/vtour/index";
                }
              })
            }
          })
          d.width(320)
          d.showModal()
        })
      },
      
      //删除场景评论
      del_comment:function(){
        $('.del').click(function(){
          var id = $(this).data('id')
          var d = dialog({
            title:'提示',
            content:'确认删除？',
            okValue:'确认',
            cancelValue:'取消',
            cancel:function(){},
            ok:function(){
              $.get('/vtourcomment/del', {id:id}, function(data){
                if(data.status == 0){
                  window.location.href="/vtourcomment/index";
                }
              })
            }
          })
          d.width(320)
          d.showModal()
        })
      },
      //控制背景音乐播放
      bgmusic_btn:function(){
        var isplay = true;
        if('function' == typeof document.addEventListener){
          
        document.addEventListener("WeixinJSBridgeReady", function () {
          document.getElementById('audioplay').play();
        }, false);
        document.addEventListener('touchstart', function(){ 
          if(isplay){
            document.getElementById('audioplay').play();
          }
        }, false);
        }
        $('.bgmusic_btn').click(function(event, source){
          vtour_data.hotspot.forEach(function(v, k){
            if(v.hotspot_type == 'video'){
              ispaused = krpano.get('hotspot['+v.name+'].ispaused')
              if(ispaused && source == 'video'){
                isplay = true;
              }else if(source == 'mobile'){
                isplay = true;
              }else{
                return false;
              }
              
            }
          })

          if(isplay){
            document.getElementById('audioplay').pause();
            $(this).css({"background-position": "-64.5px -299.031px"})
            isplay = false;
          }else{
            document.getElementById('audioplay').play();
            isplay = true;
            $(this).css({"background-position": "-64.5px -334.569px"})
          }
        })
      },
      //按钮位置控制
      onresize:function(){
        
        var resize = function(){
          var height = $(window).height();
          var width = $(window).width();
          var offset_x = width/2 - 65;
          var offset_y = height - 150;
          $('.voice_btn').css({transform:'translate('+offset_x+'px,'+offset_y+'px) scale(0.5, 0.5) translate(-131px, -41px)  translate(0px, -41px)'});
        }
        resize();
        
        $(window).on('resize', function(){
          resize();
        })
        
        $('.voice_btn').click(function(){
          var name = $(this).data('name')
          krpano.call('stopsound('+name+');')
          $(this).hide();
        })
      },
      //控制自动巡游
      auto_scan:function(){
        $('.autoscan_btn').click(function(){
          if(krpano.get('autorotate.enabled')){
            krpano.set('autorotate.enabled', 'false')
            $(this).css({'background-position':'-130px -299px'})
          }else{
            $(this).css({'background-position':'-130px -334px'})
            krpano.set('autorotate.enabled', 'true')
          }
        })
      },
      //场景可拖拽改变顺序
      dragula:function(){
        dragula([document.getElementById('scene_list')])
        .on('drag', function (el) {
          el.className = el.className.replace('ex-moved', '');
        }).on('drop', function (el) {
          el.className += ' ex-moved';
        }).on('over', function (el, container) {
          container.className += ' ex-over';
        }).on('out', function (el, container) {
          container.className = container.className.replace('ex-over', '');
        });
      },
      //点赞
      zan:function(){
        $('.zaned_btn').click(function(){
          return false;
        })
        $('.zan_btn').click(function(){
          $(this).removeClass('zan_btn').addClass('zaned_btn');
          var id = $(this).data('id');
          $.get('/vtour/zan',{id:id}, function(data){})
        })
      },
      tel:function(){
        $(".tel_btn").click(function(){
          var tel = $(this).data('tel')
          weui.alert("电话："+tel)
        })
      }
  }
  
})