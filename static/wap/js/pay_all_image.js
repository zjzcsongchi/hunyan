/**
 * 购买全册js
 * @author chaokai@gz-zc.cn
 * 
 */
define(function(require, exports, module){
  
  var my_dialog = require('my_dialog');
  require('fastclick');
  var attachFastClick  = Origami.fastclick;
  
  var score = parseInt($('#score').text()); //总积分
  
  module.exports={
      load:function(){
        
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
                photo_ids: [album_id],
                type:type,
                addr_name: $('#addr_name').val(),
                addr_mobile_phone: $('#addr_mobile_phone').val(),
                is_use_score: $('.but.touse').hasClass('act') ? 1 : 0,
              },
              dataType:'json',
              success:function(res){
                if(res.status == 0){
                  var url = '/order/payment?id=' + res.data.id;
                  window.location.href = url;
                }else{
                my_dialog.alert(res.msg);
                }
              },
              error:function(){
                my_dialog.alert('网络出错，请稍后再试');
              }
            })
        });
          
      }
  }
})