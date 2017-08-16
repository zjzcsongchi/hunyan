/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  
  require('dropload');
  require('fastclick');
  require('jaliswall');
  var storage = require('storage');
  var attachFastClick  = Origami.fastclick;
  var my_dialog = require('my_dialog');

  var availableQuota = parseInt($("#available_quota").data('available_quota')); //账户剩余免费照片数
  var photosStorage = storage.getSessionStorage('photos') || [];
  var payPrice = 0;
  var score = parseInt($('#score').text()); //总积分
  
  
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
			attachFastClick(document.body);
			
			$('.album-list').jaliswall({ item: '.list' });
			
			$('.album-list .list').each(function(){
        if(photosStorage.indexOf($(this).attr('id')) == -1){
          $(this).hide();
        }
      });
      
      $('#addr_delivery_type').on('change', function(){
          $('.delivery_type').toggle(); 
      });
      
      $(".album-info .touse").click(function() {
        if(parseInt($('#available_score').text()) == 0){
          my_dialog.alert('你可没有这么多能使用的积分 :)');
          return
        }
        
        $(this).toggleClass("act");
      });
      
      module.exports.refreshPrice();
    },

		deletePhoto:function(){
  			$('.album-list .list').on('click', function(){

            $(this).toggleClass('act');
            if($(this).hasClass('act')){
              
              photosStorage.remove($(this).attr('id'));
            }else{
              photosStorage.push($(this).attr('id'));
            }

        });
    },
    
    removePhoto:function(){
      $('.del').on('click', function(){
        my_dialog.dialog('确认删除所选照片？',function(){
          $('.album-list .list').each(function(){
            if(photosStorage.indexOf($(this).attr('id')) == -1){
              $(this).hide();
              photosStorage.remove($(this).attr('id'));
            }
          });

          module.exports.refreshPrice();
          storage.setSessionStorage('photos', photosStorage);
        })
      });
    },
    
    refreshPrice: function(){
      payPrice = (photosStorage.length-availableQuota) * unitPrice ;
      payPrice = payPrice < 0 ? 0 : payPrice;
      
      quota = availableQuota;
      quota -= photosStorage.length;
      quota = quota < 0 ? 0 : quota;
      
      available_score = payPrice > score ? score : payPrice;

      $('#pay_price').text( payPrice.toFixed(2) );
      $('#available_quota').text( quota ); //剩余免费照片数
      $('#available_score').text( available_score ); //可用积分
      $('#free_num').text( availableQuota - quota ); //已使用免费照片数
      $('#chosen_num').text( photosStorage.length ); //已选择照片数
      $('#car').text( photosStorage.length ); //已选择照片数
      
    },
    
    address: function(){
      $(".bottom-cont .address").click(function(evt) {
        $(".page-bg").css('z-index','9');
        $(".page-bg").addClass('act');
        $(".popup-bottom").addClass("act");
        
        $(".bottom-cont .address").hide();
        $(".bottom-cont .payment").show();
        
        $(".close").click(function() {
            $(".page-bg").removeClass('act');
            $(".popup-bottom").removeClass("act"); 
            
            $(".bottom-cont .address").show();
            $(".bottom-cont .payment").hide();
        });
        
        evt.stopPropagation(); 
      });
    },
    
    payment: function(){

      $('.payment').on("click", function(){

          if(!$('#addr_name').val()){
            my_dialog.alert('请填写收货人姓名');
            return
          }
          
          if(!$('#addr_mobile_phone').val()){
        	  my_dialog.alert('请填写收货人手机号');
            return
          }
          $.ajax({
            type:'post',
            url:'/album/checkout',
            data: {
              dinner_id: $('#dinner_id').val(),
              photo_ids: photosStorage,
              addr_name: $('#addr_name').val(),
              addr_mobile_phone: $('#addr_mobile_phone').val(),
              is_use_score: $('.but.touse').hasClass('act') ? 1 : 0,
            },
            dataType:'json',
            success:function(res){
              if(res.status == 0){
                var url = '/order/payment?id=' + res.data.id;
                window.location.href = url;
                storage.setSessionStorage('photos', []) ;
              }else{
            	my_dialog.alert(res.msg);
              }
            },
            error:function(){
            	my_dialog.alert('网络出错，请稍后再试');
            }
          })
      });
        
    },


  }
})
