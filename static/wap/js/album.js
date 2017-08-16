/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  
  var my_dialog = require('my_dialog');
  require('dropload');
  require('fastclick');
  require('viewer');
  
  var storage = require('storage');
  var attachFastClick  = Origami.fastclick;
  
  var albumId = parseInt($(".max-title").data('id'));    //相册ID
  var totalNum = parseInt($(".num").data('num'));    //相册包含照片数
  var price = parseFloat($("#price").data('price')); //相册总价
  
  var availableQuota = parseInt($("#available_quota").data('available_quota')); //账户剩余免费照片数
  var photosStorage = storage.getSessionStorage('photos') || [];
  var payPrice = 0;
  
  Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
      if (this[i] == val) return i;
    }
    return -1;
  };
  
  Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
      this.splice(index, 1);
    }
  };

  module.exports = {
    load:function(){
        var viewer = new Viewer(document.getElementById('see-big'), {
          viewed: function () {
            var id = $(".viewer-invisible img").data('id'); //获取当前照片id
            if ($(".viewer-invisible img").data('is_purchased') == 1) {
              $("#alread_purchased").show();
              $("#choser").hide();
            }else{
              $("#alread_purchased").hide();
              $("#choser").show();
              if (photosStorage.indexOf(id) != -1) {
                $("#choser").addClass("act")
              } else {
                $("#choser").removeClass("act")
              }
              
              if ($("#choser").hasClass('act')) {
                $("#choser").text('选购('+ photosStorage.length +')') 
              } else {
                $("#choser").text('选购') 
              }

            }
          }
      });
      attachFastClick(document.body);
      photosStorage.forEach(function(v, k){
          $('.album-list .list').each(function(){
            if($(this).data('id') == v)
                $(this).addClass('act');
          });
      })
      
      module.exports.refreshPrice();

      //右侧更多优惠详情
      $(".max-title .right-but").click(function() {
        $(".page-bg").addClass("act");
        $(".rule-popup").addClass("act");
        $(".close").on('click', function() {
            $(".page-bg").removeClass("act");
            $(".rule-popup").removeClass("act");                    
        });
      });
      
      //相册全选事件
      $('#is_album').on('click', function(){
          var is_album = $('#is_album').is(':checked');//是否全选
          if(is_album){

            $('.album-list .list').each(function(){
              if($(this).data('is_purchased')){
                
                return
              }
              $(this).addClass('act');
              photosStorage.remove($(this).data('id'));
              photosStorage.push($(this).data('id'));
              
            });
            
          }else{
            
            $('.album-list .list').each(function(){
              $(this).removeClass('act');
              photosStorage.remove($(this).data('id'));
            });
            
          }
          
          module.exports.refreshPrice();
          
          $('#pay_price').text( payPrice.toFixed(2) );
          $('#available_quota').text( quota ); //剩余免费照片数
      });
      
      $('#check_all').on('click', function(){
        $('#is_album').trigger('click');
      });

    },

    choosePhoto:function(){
        $('.album-list .list').on('click', function(e){
            e.stopPropagation();
            //如果已经购买过此照片 ...
            if($(this).data('is_purchased')){
              window.location.href = $(this).find("p").data('original_img');
              return
            }
          
            var is_album = $('#is_album').is(':checked');
            if(is_album){
              return
            }
            
            $(this).toggleClass('act');
            if($(this).hasClass('act')){
              photosStorage.push($(this).data('id'));
              
            }else{
              photosStorage.remove($(this).data('id'));
            }
            
            module.exports.refreshPrice();

        });
    },
    
    choosePhotoOnPreview:function(){
      $("#choser").on('click', function(){
          var id = $(".viewer-invisible img").data('id'); //获取当前照片id
          $(this).toggleClass("act");
          if($(this).hasClass('act')){
            photosStorage.push(id);
          }else{
            photosStorage.remove(id);
          }
          module.exports.refreshPrice();
          
          $('.album-list .list').each(function(){
            var id = $(this).data('id');
            if (photosStorage.indexOf(id) != -1) {
              $(this).addClass("act")
            } else {
              $(this).removeClass("act")
            }
            
          });


      });

    },
    
    refreshPrice: function(){
      payPrice = (photosStorage.length-availableQuota) * unitPrice ;
      payPrice = payPrice < 0 ? 0 : payPrice;
      
      quota = availableQuota;
      quota -= photosStorage.length;
      quota = quota < 0 ? 0 : quota;
      
      $('#pay_price').text( payPrice.toFixed(2) );
      $('#available_quota').text( quota ); //剩余免费照片数
      $('#car').text( photosStorage.length ); //已选择照片数
      
      if ($("#choser").hasClass('act')) {
        $("#choser").text('选购('+ photosStorage.length +')') 
      } else {
        $("#choser").text('选购') 
      }

      storage.setSessionStorage('photos',photosStorage);
    },
    //选择照片后点击立即结算
    address: function(){
      $('.but').on('click', function(){

        storage.setSessionStorage('dinner_id', $('#dinner_id').val());
        obj = {'ids': photosStorage, 'dinner_id': $('#dinner_id').val()};
        
        var url = '/album/address?para=' + storage.serialize(obj);
        window.location.href = url;
      });
        
    },
    //一键购买全册
    pay_all_image:function(){
      $('#pay_all_image').on('click', function(){
        var dinner_id = $('#dinner_id').val();
        var order_type = $(this).data('order_type');
        var album_id = $(this).data('album_id');
        
        var obj = {'ids':album_id, dinner_id:dinner_id, type:order_type};
        
        window.location.href='/album/address?para=' + JSON.stringify(obj);
      })
    },
    
    switch_album: function(){
      
        $(".album-cont .more").click(function() {
          $(this).next(".more-album").toggleClass("act");
        });
      
        $('.switch_album li').on('click', function(){

            var url = '/album/index?id=' + $(this).data('id');
            window.location.href = url;
        });
    },
    
    preview:function(){
      $('.preview').on('click', function(e){
        e.stopPropagation();
        $(this).parent().find("img").trigger("click");
        $(this).parent().find("img").trigger("click");
        
      })
    }
      

  }
})
