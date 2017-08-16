/**
 * 册子详情页js
 * @author yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	var public = require('public');
	var storage = require('storage');
	var my_dialog = require('my_dialog');
	var albumStorage = storage.getSessionStorage('album') || [];
	var num = $('#num');
	var delivery_type = 1;
	module.exports = {
			alert:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(150);
				d.showModal();
			},

			num:function(){
	    	//数量增加
	    	$('#more').on('click', function(){
	    		var k = $('#num').val();
	    		var num = parseInt(k)+1
	    		$('#num').val(num);
	    		var price = $('.r').attr('data');
	    		$('.price').text('￥'+parseFloat(price)*parseInt(num))
	    		
	    	});
	    	//数量减少
	    	$('#less').on('click', function(){
	    		var k = $('#num').val();
	    		var num = parseInt(k)-1
	    		if(k >1){
	    			var price = $('.r').attr('data');
		    		$('.price').text('￥'+parseFloat(price)*parseInt(num));
		    		$('#num').val(num);
	    		}else{
	    			$(this).val(1);
	    			return false;
	    		}
	    	});
	    	//输入框失去焦点时间
	    	$('#num').blur(function(){
	    		var k = $(this).val();
	    		var num = parseInt(k)
	    		var price = $('.r').attr('data');
	    		if(k >=1){
		    		$('.price').text('￥'+parseFloat(price)*parseInt(num));
		    		$(this).val(parseInt(num));
	    		}else{
	    			$('.price').text('￥'+parseFloat(price));
	    			$(this).val(1);
	    		}
	    	})
	    },
	    //提交订单
	    submit:function(){
	    	$('.but').on('click', function(){
	    		//获取数量
	    		var num = parseInt($('#num').val());
	    		if(!num || num <= 0){
	    			return false;
	    		}
	    		//产品id
	    		var p_id = parseInt($('#num').attr('data'));
	    		if(!p_id || p_id <= 0){
	    			return false;
	    		}
	    		var type_id = $(this).attr('type_id');
	    		//保存购物车数据
	    		albumStorage = {
	    		    'product_id': p_id,
	    		    'num': num,
	    		};
	    		storage.setSessionStorage('album', albumStorage);
	    		
	    	//订单的相关参数
          $.ajax({
            type:'post',
            url:'/usercenter/is_have_photo_order',
            dataType:'json',
            success:function(res){
              if(res.status == 0){
                window.location.href='/usercenter/album_detail_info?product_id='+ p_id +'&num='+ num+'&type_id='+type_id;
              }else{
                my_dialog.alert(res.msg);
              }
            },
            error:function(){
              my_dialog.alert('网络出错，请稍后再试');
            }
          })
	    	})
	    },
	    select:function(){
	    	$('[name="delivery_type"]').change(function(){
	    		delivery_type = $(this).val();
	    		if(delivery_type == 1){
	    			$('.post_method').hide();
	    			$('#addr').hide();
	    			var price = $('#price').attr('data');
	    			$('#price').html('￥'+price);
	    		}else{
	    			$('.post_method').show();
	    			$('#addr').show();
	    			var price = $('#price').attr('data');
	    			var post = $(this).attr('data');
	    			var total = parseFloat(price)+parseFloat(post);
	    			$('#price').html('￥'+total);
	    		}
	    	});

	    },
	    
	    //查看图片
	    see:function(){
	    	$(".see").on("click",function(e){
	    		e.stopPropagation();
	    		var imgurl = $(this).data('fullimg');
	    		var img_id = $(this).data('img_id')
	    		$('.see-bigimg').addClass('act');
	    		$('.see-bigimg img').attr('src', imgurl);
	    		$('#set_cover_img').attr('data', img_id);
	    	})
	    	$('.see-bigimg img').on('load', function(){
	    	  var img_height = $(this).height();
	    	  var window_height = $(window).height();
	    	  var offset_height = window_height/2 - img_height/2;
	    	  $(this).css({'margin-top':offset_height+'px'});
	    	  
	    	})
	    },
	    
	    //设为封面图
	    set_cover_img:function(){
	    	$('#set_cover_img').on('click', function(){
	    		var cover_img_id = $(this).attr('data');
	    		if(cover_img !== ''){
	    			$('#cover_img').val(cover_img_id);
	    			$(this).hide();
	    			$('.see-bigimg').removeClass('act');
	    		}
	    	})
	    },
	    
	    //添加完整的订单信息
	    add:function(){

	    	$(document).on('click', '.bottom-cont .but', function(){
	    	  if($(this).attr('status') == 0){
	    		  $(this).attr('status', 1);
	    		  $(".popup-bottom").addClass("act");
	              $(this).html("去付款");
	              return false;
	    	  }
	    	  image_order_ids = [];
	    	  
	    	  //统计收货信息
	    	  $('.wall-column .list').each(function(){
		          if($(this).hasClass('act')){
		        	var id = $(this).children('img').data('id');
		            image_order_ids.push(id);
		          }
	    	  });
	    	  if(!image_order_ids.length){
	    	    my_dialog.alert('请选择照片');
	    	    return false;
	    	  }
                var type_id = $('#type_id').val();
	    		var order_id = $(this).attr('data');
	    		var cover_img = $('#cover_img').val();
	    		if(cover_img == '' || !cover_img){
	    			my_dialog.alert('请查看一张相片并设置为封面图');
	    			return false;
	    		}
	    		var name = $('#name').val();
	    		if(name ==''){
	    		  my_dialog.alert('收货人姓名不能为空');
	    			return false;
	    		}
	    		var mobile_phone = $('#mobile_phone').val();
	    		if(mobile_phone == ''){
	    		  my_dialog.alert('手机号不能为空');
	    			return false;
	    		}
	    		var delivery_type = $('[name="delivery_type"]').val();
	    		var address = $('#address').val();
	    		if(delivery_type == 0){
	    			if(address == ''){
	    			  my_dialog.alert('收货地址不能为空');
		    			return false;
	    			}
	    		}
	    		//订单的相关参数
	    		$.ajax({
            type:'post',
            url:'/usercenter/album_detail_info',
            data: {
              product_id: $('#product_id').val(),
              num: $('#num').val(),
              image_order_ids: image_order_ids,
              name: name,
              type_id:type_id,
              mobile_phone: mobile_phone,
              address: address,
              delivery_type: delivery_type,
              cover_img :cover_img,
              addr_delivery_type: $('#addr_delivery_type').val(),
            },
            dataType:'json',
            success:function(res){
              if(res.status == 0){
                var url = '/order/payment?id=' + res.data.order_id;
                window.location.href = url;
              }else{
                my_dialog.alert(res.msg);
              }
            },
            error:function(){
              my_dialog.alert('网络出错，请稍后再试');
              
            }
          })
          
	    	})
	    },
	    //为相册选择照片订单
      select_order:function(){
        $('.frame-order li').on('click', function(){
          $(this).toggleClass('act');
        });
      },
	  
	  select_all:function(){
		  $('#all').on('click',function(){
			  if($(this).prop("checked")){
				  //所有的图片得到act样式
				  $('.list').addClass('act');
			  }else{
				//所有的图片移除act样式
				  $('.list').removeClass('act');
			  }
		  })
	  }
	}
});