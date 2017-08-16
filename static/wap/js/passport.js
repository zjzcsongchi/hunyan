/**
 * 公共js，控制头部动态效果及登录注册
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
  
  require('dialog');
  module.exports={
    load:function(){
      var obj = this;
      //获取注册验证码
      obj.get_reg_code();
      //获取找回密码验证码
      obj.get_repass_code();
      //注册
      obj.reg();
      //绑定微信
      obj.bind_account();
      //登录
      obj.login();
      //找回密码操作
      obj.repass();
      //回车登录
      obj.enterlogin();
      //同意协议
      obj.agree_protocol();
    },

    
    //显示登录框
    show_login_box:function(){
      $(".user-center").on('click', function(){
        console.log('asd');
        var obj = new WxLogin({
          id:"wechart_login_container", 
          appid: "wx3643f674fbdf0f8f", 
          scope: "snsapi_login", 
          redirect_uri: "/",
          state: "wechart",
          
        });
        //判断是否登录
        $.get('/passport/is_login', function(data){
          if(data.status == 0){
            window.location.href="/usercenter/index";
          }else{
            $(".page-bg").addClass("act");
            $(".popup-login.login").addClass("act");
          }
        })
      });
    },

    //获取注册验证码
    get_reg_code:function(){
      $('#reg_code').on('click', function(e){
        e.preventDefault();
        //验证手机号
        var mobile = $('input[name=mobile]').val();
        if(!/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#reg_msg').text('手机号格式不正确');
          return false;
        }
        var token = $('input[name=token]').val();
        var obj = $(this);
        $.post('/publicservice/mobile_code', {token:token,mobile:mobile}, function(data){
          if(data.status == 0){
            $('input[name=token]').val(data.data.token);
            obj.prop('disabled', true);
            var time = 30; var t;
            t = setInterval(function(){
              obj.text(--time + '后重新获取');
              if(time<1){
                clearInterval(t);
                obj.prop('disabled', false);
                obj.text('获取验证码');
              }
            }, 1000);
          }else{
            $('input[name=token]').val(data.data.token);
            $('#reg_msg').text(data.msg);
          }
        })
      })
    },
    //获取找回密码验证码
    get_repass_code:function(){
      $('#repass_code').on('click', function(e){
        e.preventDefault();
        //验证手机号
        var mobile = $('input[name=mobile]').val();
        console.log(mobile)
        if(!/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
          $('#repass_msg').text('手机号格式不正确');
          return false;
        }
        var token = $('input[name=token]').val();
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
    agree_protocol: function(){
      $(".info i").on('click', function() {
          $(".info i").toggleClass("act");
      });
    },
    //注册操作
    reg:function(){
      $("#reg_btn").on('click', function(){
        var mobile = $('#reg_form input[name=mobile]').val();
        if(!/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
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
              window.location.href="/passport/login";
            }, 3000);
          }else{
            $('#reg_msg').text(data.msg);
          }
        })
      })
    },
    
    //绑定微信号操作
    bind_account:function(){
      $("#bind_account_btn").on('click', function(){
        var open_id = $('#reg_form input[name=open_id]').val();
        var state = $('#reg_form input[name=state]').val();
        var mobile = $('#reg_form input[name=mobile]').val();
        var head_img = $('#reg_form input[name=head_img]').val();
        var address = $('#reg_form input[name=address]').val();
        var sex = $('#reg_form input[name=sex]').val();
        var nickname = $('#reg_form input[name=nickname]').val();
        
        if(!/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
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

        $.post('/passport/bind_account', {
          mobile:mobile,
          code:code,
          password:password,
          open_id:open_id,
          state:state,
          head_img:head_img,
          address:address,
          sex:sex,
          nickname:nickname
        }, function(data){
          if(data.status == 0){
            $('#reg_msg').text(data.msg);
            setTimeout(function(){
              window.location.href = data.data.url;
            }, 2500);
          }else{
            $('#reg_msg').text(data.msg);
          }
        })
      })
    },
    //登录
    login:function(){
      $('#login_btn').on('click', function(){
        var mobile = $('#login_form input[name=mobile]').val();
        if(!/^1(3[0-9]|4[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
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
            window.location.href="/usercenter/index";
          }else{
            $('#login_msg').text(data.msg);
          }
        })
      })
    },
    //找回密码
    repass:function(){
      $('#repass_btn').on('click', function(){
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
              window.location.href="/passport/login_page";
            }, 3000);
          }else{
            $('#repass_msg').text(data.msg);
          }
        })
      })
    },
    //回车登录
    enterlogin:function(){
      $("body").keydown(function(event) {
              if (event.keyCode == "13") {
                  $("#login_btn").click();
              }
          });
    }
  }
})
