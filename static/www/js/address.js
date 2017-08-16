/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  var public = require('public');
	var storage = require('storage');
	var my_dialog = require('my_dialog');

	var availableQuota = parseInt($("#available_quota").val()); //账户剩余免费照片数
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
		  public.load();
		  $('.album-list li').each(function(){
        if(photosStorage.indexOf($(this).data('id')) == -1){
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
        module.exports.refreshPrice();
			});
			
			module.exports.refreshPrice();
		},

		deletePhoto:function(){
  			$('.album-list li i').on('click', function(){
  			    _this = $(this);
  			    my_dialog.dialog('确认删除该照片？',function(){
  			      _this.parent().hide();
  			      photosStorage.remove(_this.parent().data('id'));
  			      module.exports.refreshPrice();
  			    });
  			    
            
  			});
		},
		
		removePhoto:function(){
      $('.del').on('click', function(){
        my_dialog.dialog('确认删除所选照片？',function(){
          $('.album-list li').each(function(){
            if(photosStorage.indexOf($(this).data('id')) == -1){
              $(this).hide();
              photosStorage.remove($(this).data('id'));
            }
          });
     
          module.exports.refreshPrice();
        })
      });
		},
		
		refreshPrice: function(){
		  originalPrice = photosStorage.length * unitPrice;
		  
		  //免费张数 减免金额
		  quota = availableQuota;
      quota = quota > photosStorage.length ? photosStorage.length : quota;
		  payPrice = originalPrice - quota * unitPrice ;

      //积分减免金额
		  availableScore = payPrice > score ? score : payPrice;
		  if($('.but.touse').hasClass('act')){
		    payPrice -= availableScore;
		    
		    //freePrice = quota * unitPrice + availableScore;
		  }else{
		    freePrice = quota * unitPrice ;
		  }


      $('#chosen_num').text( photosStorage.length );          //已选择照片数
      $('#original_price').text( originalPrice.toFixed(2) );  //原价
      $('#pay_price').text( payPrice.toFixed(2) );            //应付款
      $('#free_price').text( freePrice.toFixed(2) );          //优惠金额
      $('#free_num').text( quota );                           //已使用免费照片数
      $('#available_quota').text( availableQuota - quota );   //剩余免费照片数
      $('#available_score').text( availableScore );           //可用积分
      
      storage.setSessionStorage('photos', photosStorage);
      
		},
		
		payment: function(){
		  $('.payment').on('click', function(){
		      if(!$('#addr_name').val()){
		    	  my_dialog.alert('请填写联系人姓名');
		        return
		      }
		      
		      if(!$('#addr_mobile_phone').val()){
		    	  my_dialog.alert('请填写联系人手机号');
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
