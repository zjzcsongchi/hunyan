define(function(require, exports, module){
  module.exports = {
      dialog:function(content, callback, sure, cancle){
        if(!sure){
          sure = '确认';
        }
        if(!cancle){
          cancle = '取消';
        }

        var html = '<div>';
        html += '<div class="page-bg"></div>';
        html += '<div class="order-popup to-cancel">';
        html +=   '<p class="title1">'+ content +'</p>';
        html +=   '<a href="javascript:;" act="cancle" class="no">' + cancle + '</a>';
        html +=   '<a href="javascript:;" act="sure" data="" class="yes">'+ sure +'</a>';
        html += '</div>';
        html += '</div>';

        var dialog = $(html).appendTo(document.body);
        
        setTimeout(function(){
          dialog.find('div').addClass('act');
        }, 100);

        dialog.find('a[act=cancle]').one('click', function(){
          dialog.hide().remove();
          return false;
        });
        
        dialog.find('a[act=sure]').one('click', function(){
          dialog.hide().remove();
          if (callback){
            callback.apply(this);
          }
        });
      },
      

      alert:function(content, callback, sure){
        if(!sure){
          sure = '确认'
        }
        var html = '<div>';
        html += '<div class="page-bg"></div>';
        html += '<div class="order-popup cancel-succes">';
        html += '<p class="title2" style="color: #666;" >'+ content +'</p>';
        html +=   '<a href="javascript:;" act="sure" class="succes">' + sure +'</a>';
        html += '</div>';
        html += '</div>';

        var dialog = $(html).appendTo(document.body);
        
        setTimeout(function(){
          dialog.find('div').addClass('act');
        }, 100);
        
        dialog.find('a[act=sure]').one('click', function(){
          dialog.hide().remove();
          if (callback){
            callback.apply(this);
          }
        });
      }
  }
})
