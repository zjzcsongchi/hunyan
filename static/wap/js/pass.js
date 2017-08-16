/**
 * 公共js，控制头部动态效果及登录注册
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
	
	require('dialog');
	
	module.exports={
			//绑定微信号操作
		    bind_account:function(){
		      $("#bind_account_btn").on('click', function(){
		        var open_id = $('#reg_form input[name=open_id]').val();
		        var mobile = $('#reg_form input[name=mobile]').val();
		        var id = $('#reg_form input[name=id]').val();
		        var head_img = $('#reg_form input[name=head_img]').val();
		        var address = $('#reg_form input[name=address]').val();
		        var sex = $('#reg_form input[name=sex]').val();
		        var nickname = $('#reg_form input[name=nickname]').val();
		        
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

		        $.post('/passport/bind', {id:id,mobile:mobile,code:code,password:password,open_id:open_id,sex:sex,nickname:nickname,head_img:head_img,address:address}, function(data){
		          if(data.status == 0){
		            window.location.href=data.data.url;
		          }else{
		            $('#reg_msg').text(data.msg);
		          }
		        })
		      })
		    },
		  //获取注册验证码
		    get_reg_code:function(){
		      $('#reg_code').click(function(e){
		        e.preventDefault();
		        //验证手机号
		        var mobile = $('input[name=mobile]').val();
		        if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile)){
		          $('#reg_msg').text('手机号格式不正确');
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
		            $('#reg_msg').text(data.msg);
		          }
		        })
		      })
		    },
		    agree_protocol: function(){
		        $(".info").click(function() {
		            $(".info i").toggleClass("act");
		        });
		      },
	}
})