/**
 * 订单管理js
 */
define(function(require, exports, module){
	
	require('dialog');
	require('datatables');
	var spin = require('spin_lib');
	require('jqvalidate');
	var coupon_index = 1;
	var my_dialog = require('my_dialog');
	module.exports={
			//保存预约信息
			save:function(){
				$('#save').click(function(e){
					e.preventDefault();
					var data = $('#form').serialize();
					var spiner = spin.show();
					$.post('/dinner/contract_add', data, function(res){
						spin.close(spiner);
						if (res.status == 0){
						  my_dialog.alert('合同签订成功!', function(){
						    window.location.href = res.data.pdf_url;
						  });
						}else {
						  my_dialog.alert(res.msg);
						}
						
					})
				})
			},

			//时间选择器
			datepick:function(){
				$(".Wdate").change(function(){
					//var date = new Date();
					//$(this).val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate());
					
					var date = $(this).val().split("-");
		            //计算农历
					if(date.length > 1){
						var link = 'year='+date[0]+'&month='+date[1]+'&day='+date[2];
						$.get('/publicservice/solartolunar?'+link, function(data){
							$('.lunardate').val(data.lunar_time.lunar_time)
							$('.week').val(data.lunar_time.week);
						})
						
					}
		            
		    });
			},

			
			//宴会类型选择
			dinner_type:function(){
				$('input[name="venue_type"]').change(function(){
					var val = $(this).val();
					if(val == 1){
						$('.dinner_other').hide();
						$('.parent_info').hide();
						$('.dinner_marry').show();
					}else if(val == 3 || val == 4 || val == 5) {
						$('.dinner_marry').hide();
						$('.dinner_other').show();
						$('.parent_info').show();
					}else{
						$('.dinner_other').show();
						$('.dinner_marry').hide();
						$('.parent_info').hide();
					}
				})
			},
			

		//宴会类型选择
    combo_type:function(){
      $('input[name="menus"]').change(function(){
        var id = $(this).val();
        $.get('/dinner/get_combo?id='+id, function(res){
          
          $('#combo_name').text(res.data.name);
          $('#combo_old_price').text(res.data.old_price+" 元");
          $('#combo_price').text((res.data.old_price - res.data.price)+' 元');
          $('#menus').empty();
          
          var tr = '';
          $(res.data.dishes).each(function(){
            tr += '<tr>';
            tr += '<td width="85">'+ this.name +'</td>';
            tr += '<td width="85">￥'+ this.price +'元</td>';
            tr += '</tr>';
          })
          
          $('#menus').append(tr);
        })
        
      })
    },
    
  //宴会类型选择
    combo_type_new:function(){
      $('input[name="menus"]').change(function(){
        var id = $(this).val();
        
        if (id == 0) {
          $(".combo_menu").hide();
        } else {
          $(".combo_menu").show();
        }
        $.get('/dinner/get_combo?id='+id, function(res){
          
          $('#combo_name').text(res.data.name);
          $('#combo_old_price').text(res.data.old_price+" 元");
          $('#combo_price').text(res.data.favorable+' 元');
          $('#menus').empty();
          
          var tr = '';
          $(res.data.dishes).each(function(){
            tr += '<li>';
            tr += '<p>'+ this.name +'</p>';
            tr += '<p>￥'+ this.price +'元</p>';
            tr += '</li>';
          })
          
          $('#menus').append(tr);
        })
        
      })
    },
    
    //身份证上传
    upload_img:function(_self){
      $(".card").on('click', function(){
        var _this = $(this);
        $("#uploadImg").trigger('click');
        $('#uploadImg').unbind().on('change',function(e){
          _self = $(_self);
          data = new FormData();
          $.each($('#uploadImg')[0].files, function(i, file) {
            data.append('Filedata', file);
          });
          data.append('type', 'image');
          
          //前端直接预览图片，等待上传成功后修改input标签的 value值
          _this.children('img').attr('src', window.URL.createObjectURL($('#uploadImg')[0].files[0]));
          
          var spiner;
          $.ajax({
            url:uploadUrl+'/file/upload',
            type:'POST',
            data:data,
            xhrFields: {
              withCredentials: true
            },
            cache: false,
            contentType: false,    
            processData: false,
            dataType:'json',
            beforeSend:function(){
              spiner = spin.show(); 
            },
            success:function(data){
              
              _this.children('input').val(data.url);
              
              e.stopPropagation();
              spin.close(spiner);
            }
          });
        })
        
      })
    },
    
    DX: function (num) {
      var strOutput = "";  
      var strUnit = '仟佰拾亿仟佰拾万仟佰拾元角分';  
      num += "00";  
      var intPos = num.indexOf('.');  
      if (intPos >= 0)  
        num = num.substring(0, intPos) + num.substr(intPos + 1, 2);  
      strUnit = strUnit.substr(strUnit.length - num.length);  
      for (var i=0; i < num.length; i++)  
        strOutput += '零壹贰叁肆伍陆柒捌玖'.substr(num.substr(i,1),1) + strUnit.substr(i,1);  
      return strOutput.replace(/零角零分$/, '整').replace(/零[仟佰拾]/g, '零').replace(/零{2,}/g, '零').replace(/零([亿|万])/g, '$1').replace(/零+元/, '元').replace(/亿零{0,3}万/, '亿').replace(/^元/, "零元");  
    },
    
    //增加优惠券
    add_coupon: function() {
      $('.form-coupon .add').on('click', function(){
          var li = '';
          li += '<li>';
          li +=   '<span>';
          li +=     '编号：<input  name="coupon['+ coupon_index +'][number]"  type="text" />';
          li +=   '</span>';
          li +=   '<span>';
          li +=     '金额：<input  name="coupon['+ coupon_index +'][money]"  type="text" /> 元 ';
          li +=   '</span>';
          li +=   '<span class="del"></span>';
          li += '</li>';

          coupon_index ++;
          if($('.form-coupon ul').children().length>5){
             my_dialog.alert('请勿继续添加！');
             return
          }
          $('.form-coupon ul').append(li);
        })
    },
    //删除优惠券
    remove_coupon: function() {
      $(document).on('click', '.form-coupon .del', function(){
       
        $(this).parent().remove();
      })
    },
    
    //自動補全打屏信息
    auto_full_daping: function() {
      $('input[name="screen"]').on('change', function(){
        var is_need_screen = $(this).val();
        if (is_need_screen == 1) {
          var text = '';
          var venue_type = $('input[name="venue_type"]:checked').val();
          if (venue_type == 1) {
            text = '新郎：' + $('input[name="roles_main"]').val() + '，  新娘：' + $('input[name="roles_wife"]').val();
          } else {
            text = '宴会主角：' + $('input[name="roles_main_other"]').val();
          }
          
          $('input[name="screen_remark"]').val(text);
        } else {
          $('input[name="screen_remark"]').val('');
        }
        
      })
    }
    

	}
})
