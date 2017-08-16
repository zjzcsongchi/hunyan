/**
 *购买全册 
 */
define(function(require, exports, module){
  
  var public = require('public');
  var my_dialog = require('my_dialog');
  
  module.exports={
      load:function(){
        public.load();
        //是否使用积分
        $(".album-info .touse").click(function() {
          if(parseInt($('#available_score').text()) == 0){
            my_dialog.alert('你可没有这么多能使用的积分 :)');
            return
          }
          
          $(this).toggleClass("act");
        });
      //提交订单
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