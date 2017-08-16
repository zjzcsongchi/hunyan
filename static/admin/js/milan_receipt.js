/**
 * 订单管理js
 */
define(function(require, exports, module){
  require('dialog');
  var pub = require('public');
  var common = require('public');

	module.exports={
			//保存预约信息
			load: function(){

               //module.exports.conversion_money();

			  $("input[name='money']").on('keyup', function(){
			    var res = module.exports.DX($(this).val()) ;
			    $("input[name='chinese_money']").val(res);
			  })
			  $("input[name='money']").on('blur', function(){
			    var res = module.exports.DX($(this).val()) ;
			    $("input[name='chinese_money']").val(res);
			  })

			  $('.btn-receipt').on('click', function(){

			    var menu_id = $("input[name='menu_id']").val() || $(this).data('menu_id');
			    var staff_type_id = $(this).data('staff');
			    var is_onlyread = $(this).data('is_onlyread') || 0;

			    $.ajax({
                    type:'get',
                    url:'/menu/get_receipt',
                    data: {
                      'menu_id': menu_id,
                      'staff_type_id': staff_type_id,
                      'is_onlyread': is_onlyread,
                    },
                    dataType:'html',
                    success:function(res){
                      if(res){

                        var d = dialog({
                            zIndex:109,
                            title:'执行单',
                            content:res,
                            cancelValue:'关闭',
                            cancel:function(){}
                        })
                        d.width(600);
                        d.showModal();

                      }else{
                        alert(res.msg);
                      }
                    },
                    error:function(){
                      alert('网络出错，请稍后再试');
                    }
                  })

			  });
			},



			print: function() {
			  $('.print-preview').on('click', function(){

          bdhtml = window.document.body.innerHTML;
          sprnstr = "<!--startprint-->";
          eprnstr = "<!--endprint-->";
          prnhtml = bdhtml.substr(bdhtml.indexOf(sprnstr) + 17);
          prnhtml = prnhtml.substring(0, prnhtml.indexOf(eprnstr));
          window.document.body.innerHTML = prnhtml;
          var target = $(window.document.body);
          target.find("p").each(function(){
            $(this).css("font-size", "17px");
          })

          target.find("div").each(function(){
            $(this).css("font-size", "17px");
          })

          target.find(".lead strong").each(function(){
            $(this).css("font-size", "20px");
            $(this).css("font-weight", "900");
          })

          target.find("textarea").each(function(){
            $(this).css("font-size", "17px");
            var height = 20;
            number_of_characters_line = 55 || parseInt(target.css("width"))/parseInt(target.css("font-size"));
            line_height = 26;
            lines = $(this).text().split(/\r?\n/);
            linefeed = lines.length;
            height += linefeed * line_height;
            $(lines).each(function(){
              if ($(this).length > number_of_characters_line) {
                height += Math.floor($(this).length/number_of_characters_line) * line_height
              }
            });

            $(this).css("height", height + "px");

            if($(this).attr('name') == 'error_content'){
              $(this).css("border","none");
            }

            if($(this).attr('name') == 'remark'){
              $(this).css("border","1px solid #000");
            }

          })

          target.find("o").each(function(){
            $(this).css("border-bottom","2px solid #333");
          })

          window.print();
          window.location.reload();
        });

			},

      conversion_money: function(){
        $("input[name='money']").on('keyup', function(){
          var res = module.exports.DX($(this).val()) ;
          $("input[name='chinese_money']").val(res);
        })
        $("input[name='money']").on('blur', function(){
          var res = module.exports.DX($(this).val()) ;
          $("input[name='chinese_money']").val(res);
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

	examination: function() {
        $(".examination").click(function(){
            var receipt_id = $(this).data('receipt_id');
            var examination_suatus = $(this).data('examination_suatus') != 2 ? '' : 'checked="checked"';
            var examination_reson = $(this).data('examination_reson');
            var html = '<div class="forminfo small-size">';
            html += '<label class="col-sm-6"><input name="examination_status" type="radio" value="1" checked="checked">审核通过</label> <label class="col-sm-6"><input name="examination_status" type="radio" ' + examination_suatus + 'value="2" >审核失败</label>';
            html += '审核理由：<br/><textarea id="remark" class="textinput" style="width:342px; height: 100px">' + examination_reson +'</textarea>';
            html += '</div>';
            var d = dialog({
                title: '审核',
                content: html,
                okValue: '确定',
                ok: function () {
                    this.title('提交中…');
                    var params = {
                      'id': receipt_id,
                      'examination_status': $("input[name='examination_status']:checked").val(),
                      'examination_reson': $("#remark").val()
                    };
                    $.post('/receipt/examination', params, function(res) {
                      if(res.status == 0){
                        pub.showDialog(res.msg, '', function(){
                          window.location.reload();
                        });
                      }else if(res.status){
                        pub.showDialog(res.msg);
                      }else{
                        pub.showDialog('网络错误或您没有权限做此操作!');
                      }
                    });

                },
                cancelValue: '取消',
                cancel: function () {}
            });
            // d.width(400);
            // d.height(200);
            d.showModal();
        });
	},
	//删除
	del:function(){
	  $('.del').click(function(){
	    var id = $(this).data('id');
	    var d = dialog({
	      content:'确认删除？',
	      title:'提示',
	      okValue:'确认',
	      cancelValue:'取消',
	      cancel:function(){},
	      ok:function(){
	        $.get('/receipt/del', {id:id}, function(data){
	          if(data.status == 0){
	            window.location.reload();
	          }
	        })
	      }
	    })
	    d.width(320)
	    d.showModal();
	  })
	},
	//发送短信
	send_message:function(){
		$(".send_message").click(function(){
			var menu_id = parseInt($(this).data('menu_id'));
			var staff_id = parseInt($(this).data('id'));
			var data = {menu_id: menu_id, staff_id: staff_id};
			$.post('/menu/per_send_message', data,function(data){
				if(data.status == 0){
					 common.showDialog('短信发送成功');
				}else{
					common.showDialog('短信发送失败');
				}
			})
			
		});
	},

	}
})
