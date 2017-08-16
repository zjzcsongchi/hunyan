/**
 * 公共js，控制头部动态效果及登录注册
 * 
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
  
  require('dialog');
  require('wdate');
  module.exports={
    load:function(){
      var obj = this;
        // 头部动态效果
        obj.head_move();
        // 显示登录框
        obj.show_login_box();
        // 显示微信登录框
        obj.show_weixin_box();
        // 显示返回账号登录
        obj.return_account_login();
        // 显示注册框
        obj.show_reg_box();
        // 关闭弹框
        obj.close_box();
        // 找回密码弹框
        obj.show_repass_box();
        // 获取注册验证码
        obj.get_reg_code();
        // 获取找回密码验证码
        obj.get_repass_code();
        // 注册
        obj.reg();
        // 登录
        obj.login();
        // 找回密码操作
        obj.repass();
        // 回车登录
        obj.enterlogin();
        // 修改资料时间选择器
        obj.datepicker();
        //修改用户资料
        obj.user_load();
    },
    // 头部动态效果
    head_move:function(){
      $(".menu li a").hover(function() {
        $(".out", this).stop().animate({'top':  '135px'},  300); 
        $(".over",  this).stop().animate({'top':  '0px'},   300); 
      }, function() {
        $(".out", this).stop().animate({'top':  '0px'},   300); 
        $(".over",  this).stop().animate({'top':  '-135px'}, 300); 
      });
      
      $(".popup-login .text").click(function() {
        $(this).find('i').toggleClass("act");
      });
    },
    // 显示登录框
    show_login_box:function(){
      $(".user-center").click(function(){
        // 判断是否登录
        $.get('/passport/is_login', function(data){
          if(data.status == 0){
            window.location.href="/usercenter/user";
          }else{
            $(".page-bg").addClass("act");
            $.get('/passport/get_wechat_token', function(data){
              var state = data.data;
              $("#weixin_QR").attr("src","/passport/wechat_login_QR?state=" + state);
              $('#weixin_box').addClass('act');
              setInterval(function(){
                is_wechat_login(state)
              }, 2500);
            })
            
            var is_wechat_login = function(state){
              $.get('/passport/is_wechat_login', {state: state}, function(response){
                if(response.status == 0){
                  window.location.href="/usercenter/user";
                }
              })
            };
          }
        })
      });
    },
  // 返回账号登录
    return_account_login:function(){
      $(".to-login").click(function(){
        $(".page-bg").addClass("act");
        $(".popup-login.login").addClass("act");
        $('#weixin_box').removeClass('act');
      });
    },
    // 显示微信登录框
    show_weixin_box:function(){
      $('#weixin').click(function(){
        $.get('/passport/get_wechat_token', function(data){
          var state = data.data;
          $("#weixin_QR").attr("src","/passport/wechat_login_QR?state=" + state);
          $('.popup-login').removeClass('act');
          $('#weixin_box').addClass('act');
          setInterval(function(){
            is_wechat_login(state)
          }, 2500);
        })
        
        var is_wechat_login = function(state){
          $.get('/passport/is_wechat_login', {state: state}, function(response){
            if(response.status == 0){
              window.location.href="/usercenter/user";
            }
          })
        };
        
      })
    },
    // 显示注册框
    show_reg_box:function(){
      $('#reg').click(function(){
        // 获取token
        $.get('/passport/get_token', function(data){
          $('#reg_form input[name=token]').val(data.data);
        })
        $('.popup-login').removeClass('act');
        $('#reg_box').addClass('act');
      })
    },
    // 关闭弹框
    close_box:function(){
      $(".popup-login .close").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-login").removeClass("act");
            });
    },
    // 显示找回密码
    show_repass_box:function(){
      $('#repass').click(function(){
        // 获取token
        $.get('/passport/get_token', function(data){
          $('#repass_form input[name=token]').val(data.data);
        })
        $('.popup-login').removeClass('act');
        $('#repass_box').addClass('act');
      })
    },
    // 获取注册验证码
    get_reg_code:function(){
      $('#reg_code').click(function(e){
        e.preventDefault();
        // 验证手机号
        var mobile = $('#reg_form input[name=mobile]').val();
        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#reg_msg').text('手机号格式不正确');
          return false;
        }
        var token = $('#reg_form input[name=token]').val();
        var obj = $(this);
        $.post('/publicservice/mobile_code', {token:token,mobile:mobile}, function(data){
          if(data.status == 0){
            obj.prop('disabled', true);
            var time = 60; var t;
            t = setInterval(function(){
              obj.text(--time + '后重新获取');
              if(time<1){
                clearInterval(t);
                obj.prop('disabled', false);
                obj.text('获取验证码');
              }
            }, 1000);
          }else{
            $('#reg_msg').text(data.msg);
          }
        })
      })
    },
    // 获取找回密码验证码
    get_repass_code:function(){
      $('#repass_code').click(function(e){
        e.preventDefault();
        // 验证手机号
        var mobile = $('#repass_form input[name=mobile]').val();
        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#repass_msg').text('手机号格式不正确');
          return false;
        }
        var token = $('#repass_form input[name=token]').val();
        var obj = $(this);
        $.post('/publicservice/mobile_code', {token:token,mobile:mobile}, function(data){
          if(data.status == 0){
            obj.prop('disabled', true);
            var time = 60; var t;
            t = setInterval(function(){
              obj.text(--time + '后重新获取');
              if(time<1){
                clearInterval(t);
                obj.prop('disabled', false);
                obj.text('获取验证码');
              }
            }, 1000);
          }else{
            $('#repass_msg').text(data.msg);
          }
        })
      })
    },
    // 注册操作
    reg:function(){
      $("#reg_btn").click(function(){
        var mobile = $('#reg_form input[name=mobile]').val();
        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#reg_msg').text('手机号格式不正确');
          return false;
        }
        var code = $('#reg_form input[name=code]').val();
        if(code == ''){
          $('#reg_msg').text('验证码不能为空');
          return false;
        }
        var password = $('#reg_form input[name=password]').val();
        if(password == ''){
          $('#reg_msg').text('密码不能为空');
          return false;
        }
        var is_agree = 0;
        if($('#reg_agree').hasClass('act')){
          is_agree = 1;
        }else{
          $('#reg_msg').text('请阅读并同意注册协议');
          return false;
        }
        $.post('/passport/reg', {mobile:mobile,code:code,password:password}, function(data){
          if(data.status == 0){
            $('#reg_msg').text('注册成功，3秒后登录');
            setTimeout(function(){
              $('.popup-login').removeClass('act');
              $('#login_box').addClass('act');
            }, 3000);
          }else{
            $('#reg_msg').text(data.msg);
          }
        })
      })
    },
    // 登录
    login:function(){
      $('#login_btn').click(function(){
        var mobile = $('#login_form input[name=mobile]').val();
        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#login_msg').text('手机号格式不正确');
          return false;
        }
        var password = $('#login_form input[name=password]').val();
        if(password == ''){
          $('#login_msg').text('密码不能为空');
          return false;
        }
        var is_auto = 0;
        if($('#login_auto').hasClass('act')){
          is_auto = 1;
        }
        $.post('/passport/login', {mobile:mobile,password:password,is_auto:is_auto}, function(data){
          if(data.status == 0){
            window.location.href="/usercenter/user";
            
          }else{
            $('#login_msg').text(data.msg);
          }
        })
      })
    },
    // 找回密码
    repass:function(){
      $('#repass_btn').click(function(){
        var mobile = $('#repass_form input[name=mobile]').val();
        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#repass_msg').text('手机号格式不正确');
          return false;
        }
        var code = $('#repass_form input[name=code]').val();
        if(code == ''){
          $('#repass_msg').text('验证码不能为空');
          return false;
        }
        var password = $('#repass_form input[name=password]').val();
        if(password == ''){
          $('#repass_msg').text('密码不能为空');
          return false;
        }
        $.post('/passport/repass', {mobile:mobile,code:code,password:password}, function(data){
          if(data.status == 0){
            $('#repass_msg').text('操作成功，3秒后登录');
            setTimeout(function(){
              $('.popup-login').removeClass('act');
              $('#login_box').addClass('act');
            }, 3000);
          }else{
            $('#repass_msg').text(data.msg);
          }
        })
      })
    },
    // 回车登录
    enterlogin:function(){
      $("body").keydown(function(event) {
        if (event.keyCode == "13") {
            $("#login_btn").click();
        }
      });
    },
    // 时间选择器
    datepicker:function(){
      $('#birthday').click(function(){
        WdatePicker({dateFmt:'yyyy-MM-dd'})
      })
    },
    // 编辑用户信息
    user_load : function() {
      $(".user-banner .edit").click(function() {
        $(".page-bg").addClass("act");
        $(".popup-userinfo").addClass("act");
      });
      $(".popup-userinfo .cancel,.popup-userinfo .close").click(function() {
        $(".page-bg").removeClass("act");
        $(".popup-userinfo").removeClass("act");
      });

      module.exports.upload_img();
      module.exports.submit();

    },
    //上传用户头像
    upload_img : function() {
      $("#uploadbtn img").click(function() {
        $("#uploadImg").trigger('click');
        $('#uploadImg').unbind().on('change', function(e) {
          data = new FormData();
          $.each($('#uploadImg')[0].files, function(i, file) {
            data.append('Filedata', file);
          });
          data.append('type', 'image');
          $.ajax({
            url : uploadUrl + '/file/upload',
            type : 'POST',
            data : data,
            cache : false,
            contentType : false,
            processData : false,
            dataType : 'json',
            beforeSend : function() {
              e.stopPropagation();
            },
            success : function(data) {
              $('#uploadbtn').children('input').val(data.url);
              $('#uploadbtn').children('img').attr('src', data.full_url);
              e.stopPropagation();
            }
          });
        })
      })
    },

    //提交保存用户信息
    submit : function() {
      $("#userinfo .but").click(function() {
        $.ajax({
          url : '/usercenter/edit_info',
          type : 'POST',
          data : $("#userinfo").serialize(),
          dataType : 'json',
          success : function(res) {
            if (res.status == 0) {
              $("#userinfo .message").text(res.msg);
              setTimeout(function(){
                $(".page-bg").removeClass("act");
                $(".popup-userinfo").removeClass("act");
              }, 2000)
            } else {
              $("#userinfo .message").text(res.msg);
            }
          }
        });
        

      })
    },
  }
})
