/** 
 * 登录js文件
 * @author: jianming@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    require('dialog');

    module.exports = {
      //刷新验证码
      reflashCode: function() {
          $('#verify_img').click(function(){
            $('#verify_img').attr('src',$('#verify_img').attr('src')+'?');
          });
      },

      //登录
      doLogin: function() {
    	  $("body").keydown(function(event) {
    	        if (event.keyCode == "13") {
    	            $(".loginbtn").click();
    	        }
    	    });
    	  
          $(".loginbtn").click(function(){
            var loginuser = $(".loginuser").val();
            var loginpwd = $(".loginpwd").val();
         
            if(loginuser == "" ){
                error_msg("J_loginuser", "请输入用户名");
                $(".loginuser").focus();
                return false;
            }
            if(loginpwd == "" ){
                error_msg("J_loginpwd", "请输入密码");
                $(".loginpwd").focus();
                return false;
            }
            
            var verify_type  = $(".verify_type").val();
            var  verify = "";
           
           if(verify_type == "1"){
        	  verify = $(".verify").val();
               if(verify == "" ){
                   error_msg("J_yzm", "验证码不能为空")
                   $(".verify").focus();
                   return false;
               }
           }
            

            $.ajax({
                url:'/login/login',
                data: {
                    'name':loginuser,
                    'password':loginpwd,
                    'verify':verify
                },
                type:'POST',
                dataType:'json',
                beforeSend:function(){
                      $(".loginbtn").val("登录中...");
                },
                success:function(data) {
                
                  $(".loginbtn").val("登录");
                  if(data.code == 1){
                      error_msg("J_yzm", data.msg);
                      $(".verify").focus();
                  }else if(data.code == 2){
                      error_msg("J_loginuser", data.msg);
                      $(".loginuser").focus();
                  }
                  else if(data.code == 3){
                      error_msg("J_loginpwd", data.msg);
                      $(".loginpwd").focus();
                  }
                  else if(data.code == 0){
                    
                     if (data.return_url) {
                       window.location.href = data.return_url;
                     } else {
                     //跳转
                       window.location.href="/home";
                     }
                	
                     
                  }else{
                      alert("未知错误");
                      $(".loginuser").focus();
                  }

                },
                error : function() {
                    alert("网络异常！");
                }
            });
          });
      }

      
    }

    //错误提示
    function error_msg(obj, msg) {
      var d = dialog({
          align: 'right',
          content: msg,
          quickClose: true
      });
      d.show(document.getElementById(obj));
    }
     
});