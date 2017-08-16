/**
 * 场馆页js
 * 
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module) {

  var public = require('public');
  require('dialog');
  require('weui');
  module.exports = {
    show : function() {
      $(document).on("click", '.bespeak', function() {
        var id = $(this).attr('data-id');
        $(".page-bg").addClass("act");
        $(".popup-destine").addClass("act");
        $(".popup-destine .close").click(function() {
          $(".page-bg").removeClass("act");
          $(".popup-destine").removeClass("act");
        });

        $("#default_id").text(id);
      });
    },
    submit : function() {
      $('.submit').click(
          function() {
            var realname = $('input[name="name"]').val();
            var mobile_phone = $('input[name="phone"]').val();
            var address = $('textarea[name="address"]').val();
            var time = $('input[name="time"]').val();
            var venue = $("#default_id").text();
            var dinner_type = $("#venue").val();
            var menus_count = $("input[name='menus_count']").val();
            if (!realname) {
              $(".message").html("用户名不能为空");
              $('input[name="name"]').focus();
              return false;
            }

            if (!mobile_phone) {
              $(".message").html("电话不能为空");
              $('input[name="phone"]').focus();
              return false;
            }

            if (!time) {
              $(".message").html("选择预约时间");
              $('input[name="time"]').focus();
              return false;
            }

            if (!venue) {
              $(".message").html("选择场馆");
              return false;
            }

            $.post(m_domain+'/venue/appoint', {
              realname : realname,
              mobile_phone : mobile_phone,
              address : address,
              venue_id : venue,
              time : time,
              dinner_type : dinner_type,
              menus_count : menus_count
            }, function(data) {
              if (data.status == 0) {
                var id = $("#default_id").text(id);
                showDialog('预定成功', function(){
                  $(".popup-destine .close").trigger('click')
                  $.get(m_domain+'/venue/email?mobile_phone='+data.data.mobile_phone+"&realname="+data.data.realname+"&address="+data.data.address+"&customer_id="+data.data.customer_id+"&venue_id="+venue+"&menus_count="+menus_count+"&dinner_type="+dinner_type);
                })
              } else {
                $(".message").html(data.msg)
              }
            })

          })
    },
    datepick : function() {
      $('#datePicker').click(
          function() {
            var date = new Date();

            weui.datePicker({
              start : 2016,
              end : 2030,
              defaultValue : [ date.getFullYear(), date.getMonth() + 1,
                  date.getDate() ],
              id : 'datePicker',
              onConfirm : function(result) {
                $('#datePicker').val(
                    result[0] + '-' + result[1] + '-' + result[2]);
              }
            })

          })
    },
    zan:function(){
      $('.zaned_btn').click(function(){
        weui.alert('您已经点过赞了！');
        return false;
      })
      $('.zan_btn').click(function(){
        $(this).removeClass('zan_btn').addClass('zaned_btn');
        var id = $(this).data('id');
        $.get('/vtour/zan',{id:id}, function(data){
          if(data.status != 0){
            weui.alert(data.msg)
          }
        })
      })
    }
  }

  function showDialog(msg, callback) {

    var title = arguments[1] ? arguments[1] : '提示信息';
    var url = arguments[2] ? arguments[2] : '';
    weui.alert(msg, function() {
      callback.apply(this)
    });
  }

  // url ajax请求地址 url1跳转地址
  function ajaxDialog(msg, title, url, url1) {

    var title = arguments[1] ? arguments[1] : '提示信息';
    var url = arguments[2] ? arguments[2] : '';
    var url1 = arguments[3] ? arguments[3] : '';
    if (url != '') {
      $.get(url, function(data) {
      })
    }
    weui.alert(msg, function() {
      window.location.href = url1;
    })
  }

})