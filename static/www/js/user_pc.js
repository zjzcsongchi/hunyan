/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	var my_dialog = require('my_dialog');
	module.exports = {
		hidden:function(){
			$('.cancel').click(function(){
				$('.popup-userinfo').removeClass('act');
				$('.page-bg').removeClass('act');
			})
		},
		set_cover_img:function(){
			$(document).on('click','#set_cover_img_id',function(){
	        	$('#cover_img_id').val($(this).attr('data-id'));
	        	$(".page-bg").removeClass("act");
                $(".see-bigimg").removeClass("act");
	        })
		},
		see:function(){
			$('.see').on('click',function(event) {
				event.stopPropagation();
				$(".page-bg").addClass("act");
	            $(".see-bigimg").addClass("act");
	            $(".close").click(function() {
	                $(".page-bg").removeClass("act");
	                $(".see-bigimg").removeClass("act");
	            });
	            $('#bigimg').attr('src', $(this).data('img'));
	            $('#set_cover_img_id').attr('data-id', $(this).data('id'));
	            //获得本次图片的宽和高
	            $('#bigimg').on('load', function(){
	            	var height = $(this).height();
		            var width = $(this).width();
		            $(".see-bigimg img").css("margin-top",'-'+parseInt(height)/2+'px');
		            $(".see-bigimg img").css("margin-left",'-'+parseInt(width)/2+'px');
	            })
	        });
		},
		num:function(){
	    	//数量增加
	    	$('#more').on('click', function(){
	    		var k = $('#num').val();
	    		var num = parseInt(k)+1
	    		$('#num').val(num);	
	    		$('.buy-but').attr('data', num);
	    	});
	    	//数量减少
	    	$('#less').on('click', function(){
	    		var k = $('#num').val();
	    		var num = parseInt(k)-1
	    		if(k >1){
		    		$('#num').val(num);
		    		$('.buy-but').attr('data', num);
	    		}else{
	    			$(this).val(1);
	    			$('.buy-but').attr('data', 1);
	    			return false;
	    		}
	    	});
	    	//输入框失去焦点时间
	    	$('#num').blur(function(){
	    		var k = $(this).val();
	    		var num = parseInt(k)
	    		if(k >=1){
		    		$(this).val(parseInt(num));
		    		$('.buy-but').attr('data', num);
	    		}else{
	    			$(this).val(1);
	    			$('.buy-but').attr('data', 1);
	    		}
	    	})
	    },
	    
	    select:function(){
	    	$('[name="delivery_type"]').change(function(){
	    		delivery_type = $(this).val();
	    		if(delivery_type == 1){
	    			var o = $('.count').attr('data');
	    			$('.count').text('￥'+o);
	    			$('#post_price').hide();
	    			$('#post_title').hide();
	    			$('#addr').hide();
	    		}else{
	    			$('#post_price').show();
	    			$('#post_title').show();
	    			$('#addr').show();
	    			var p = $('#post_price').attr('data');
	    			var o = $('.count').attr('data');
	    			var total = parseFloat(o)+parseFloat(p);
	    			$('.count').text('￥'+total);
	    		}
	    	});

	    },
	    
	    jump:function(){
	    	$('.buy-but').click(function(){
	    		if(parseInt($(this).attr('data')) >= 1 && parseInt($(this).attr('dataid')) > 0){
	    			var num = $(this).attr('data');
	    			var product_id = $(this).attr('dataid');
	    			var type_id = $(this).attr('type');
	    			$.ajax({
		                type:'post',
		                url:'/usercenter/is_have_photo_order',
		                dataType:'json',
		                success:function(res){
		                  if(res.status == 0){
		                    window.location.href='/usercenter/album_detail_info?product_id='+ product_id +'&num='+ num+'&type_id='+type_id;
		                  }else{
		                    my_dialog.alert(res.msg);
		                  }
		                },
		                error:function(){
		                  my_dialog.alert('网络出错，请稍后再试');
		                }
		              })
	    		}
	    	})
	    },
	    
	    submit:function(){
	    	$("#but-buy").click(function() {
	    		image_order_ids = [];
	    		//统计收货信息
	    	    $('.album-list li').each(function(){
		            if($(this).hasClass('act')){
		              image_order_ids.push($(this).data('id'));
		            }
		        });
	    	    if(!image_order_ids.length){
	    	        my_dialog.alert('请选择照片');
	    	        return false;
	    	    }
	    	    var type_id = $('#type_id').val();
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
	    		}else{
	    			address = '到百年婚宴自提'
	    		}
	    		var cover_img_id = $('#cover_img_id').val();
	    		if(cover_img_id == '' || !cover_img_id ){
	    			my_dialog.alert('请查看一张相片并设置为封面图');
	    			return false;
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
		              mobile_phone: mobile_phone,
		              address: address,
		              type_id : type_id,
		              cover_img : cover_img_id,
		              delivery_type: delivery_type,
		              addr_delivery_type: $('#addr_delivery_type').val(),
		            },
		            dataType:'json',
		            success:function(res){
		              if(res.status == 0){
		            	  window.location.href='/order/payment?id='+res.data.order_id;
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
	    alert:function(msg){
			var d = dialog({
				title:"提示",
				content:msg,
				cancelValue:"确定",
				cancel:function(){},
			})
			d.width(300);
			d.showModal();
		},
	    del:function(){
			$('#cancel').on('click', function(){
				var id = $(this).attr('data');
				my_dialog.alert(id);return false;
				$.post('/order/del_order',{'id':id}, function(data){
					if(data){
						if(data.code == 1){
							//success
							$(".page-bg").removeClass("act");
			                $(".to-cancel").removeClass("act");
			                $('#o_'+id).remove();
						}else{
							module.exports.alert(data.msg);
						}
					}else{
						module.exports.alert('网络异常');
					}
				})
			})
		}
	    
	}
})