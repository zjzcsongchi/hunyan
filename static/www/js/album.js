/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  var public = require('public');
	var my_dialog = require('my_dialog');
	var storage = require('storage');
	
	var albumId = parseInt($(".max-title").data('id'));    //相册ID
	var totalNum = parseInt($(".num").data('num'));    //相册包含照片数
	var price = parseFloat($("#price").data('price')); //相册总价
	
	var availableQuota = parseInt($("#available_quota").data('available_quota')); //账户剩余免费照片数
	var photosStorage = storage.getSessionStorage('photos') || [];
	var payPrice = 0;
	var isCheckAll = $('#is_album').is(':checked');
	
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
		  public.load();
		  //CSS样式调整
      $(".album-list li:nth-child(3n)").css("margin-right", "0");
  			
			photosStorage.forEach(function(v, k){
  			  $('.album-list li').each(function(){
            if($(this).data('id') == v)
                $(this).addClass('act');
          });
			})
			
	    module.exports.refreshPrice();

		},

		choosePhoto:function(){
  			$('.album-list li').on('click', function(){
    			  isCheckAll = $('#is_album').is(':checked');

    			  if(isCheckAll){
    			    return
    			  }

    			  //如果已经购买过此照片 ...
    			  if($(this).data('is_purchased')){
    			    my_dialog.alert('您已购买过该照片!');
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
		//相册全选事件
		checkAll: function(){
      $('#is_album').on('click', function(){
          isCheckAll = $('#is_album').is(':checked');//是否全选
          if(isCheckAll){
            $('.album-list li').each(function(){
              if($(this).data('is_purchased')){
                return
              }
              $(this).addClass('act');
              photosStorage.remove($(this).data('id'));
              photosStorage.push($(this).data('id'));
              
            });
          }else{
            $('.album-list li').each(function(){
              $(this).removeClass('act');
              photosStorage.remove($(this).data('id'));
            });
          }

          module.exports.refreshPrice();
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
      $('#allChosePhotoNum').text( photosStorage.length ); //所有相册已选择照片数
      $('#current_chosen_count').text( $('.album-list .act').length ); //当前相册已选择照片数
      
      storage.setSessionStorage('photos',photosStorage);
		},
		
		address: function(){
      $('.address').on('click', function(){
        storage.setSessionStorage('photos', photosStorage);
        storage.setSessionStorage('dinner_id', $('#dinner_id').val());
        obj = {'ids': photosStorage, 'dinner_id': $('#dinner_id').val()};
        
        var url = '/album/address?para=' + storage.serialize(obj);
        window.location.href = url;
      });
        
    },
		
		switch_album: function(){
		  
        $(".album-cont .more").click(function() {
          $(".page-bg").addClass("act");
          $(".morealbum-popup").addClass("act");
          $(".close").click(function() {
              $(".page-bg").removeClass("act");
              $(".morealbum-popup").removeClass("act");                    
          });
        });
		  
        $('.switch_album li').on('click', function(){
            storage.setSessionStorage('photos',photosStorage);
            var url = '/album/index?id=' + $(this).data('id');
            window.location.href = url;
        });
		},
		//购买全册
		pay_all:function(){
		  $('#all_image').click(function(){
		    var dinner_id = $('#dinner_id').val();
		    var order_type = $(this).data('order_type');
		    var album_id = $(this).data('album_id');
		    
		    var obj = {'ids':album_id, dinner_id:dinner_id, type:order_type};
		    
		    window.location.href='/album/address?para=' + JSON.stringify(obj);
		  })
		}

	}
})
