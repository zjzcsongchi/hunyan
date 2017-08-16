/**
 * 手机端 相册页面js
 * @author louhang@gz-zc.cn
 */
define(function(require, exports, module){
  var public = require('public');
	var my_dialog = require('my_dialog');
	module.exports = {
	    
		load:function(){
		  
		  public.load();

			$('.coupon-chose li').on('click', function(){
			  
			  $('.coupon-chose li').each(function(){
			    $(this).removeClass('act');
	      });
			  
			  $(this).addClass('act');
			});
			
			//all
			$('.coupon-chose .all').on('click', function(){
        $('.coupon-list li').each(function(){
          $(this).show();
        });
      });
			
			//to-use
			$('.coupon-chose .to-use').on('click', function(){
        $('.coupon-list li').each(function(){
          if($(this).hasClass('to-use')){
            $(this).show();
          }else{
            $(this).hide();
          }
        });
      });
			
		 //to-use
      $('.coupon-chose .timeout').on('click', function(){
        $('.coupon-list li').each(function(){
          if(!$(this).hasClass('to-use')){
            $(this).show();
          }else{
            $(this).hide();
          }
        });
      });
		},

		

	}
})
