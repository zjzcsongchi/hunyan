/**
 * 管理员管理js
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
  require('dialog');
  require('datepicker')
  
  module.exports = {
      load:function(){
        $(function(){
          //管理员联动
          var role_type = {
            common_admin: 0,
            venue_admin: 1,
            milan_staff: 2,
          };
          var role_lists = $(Array.prototype.slice.call($('select[name="group_id"]')[0]));
          role_lists.each(function(){
            if($(this).data('role_type') == 1){
              $(this).attr("disabled",true);
            }else{
              $(this).attr("disabled",false);
            }
            })
              $("#type").on('change', function(){
              if($(this).val() == role_type.venue_admin){
                $("#venue").show()
              }else{
                $("#venue").hide()
              }
          
              if($(this).val() == role_type.milan_staff){
                role_lists.each(function(){
                  if($(this).data('role_type') == 1){
                    $(this).attr("disabled",false);
                  }else{
                    $(this).attr("disabled",true);
                  }
                })
              }else{
                role_lists.each(function(){
                  if($(this).data('role_type') == 1){
                    $(this).attr("disabled",true);
                  }else{
                    $(this).attr("disabled",false);
                  }
                })
              }
              });
          
          $('#name').focusout(function(){
            var name = $(this).val();
            if(name == ''){
              return false;
            }else{
              $.post('/admin/add_check',{'name':name}, function(data){
                if(data){
                  if(data.code == 0){
                    error(data.msg);
                  }
                }else{
                  error('网络异常');
                }
              })
            } 
          });
          $(".btn").click(function(event){
            event.preventDefault();
            
            var group_id = $("select[name='group_id']").val();
            var venue_id = $("select[name='type']").val();
            var name = $('#name').val();
            var password = $('#password').val();
            var confirpassword = $('#confirpassword').val();
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var tel = $('#tel').val();
            var describe = $('#describe').val();
            var disabled = $("input:checked").val();
            var type=$('select[name=type]').val();
            var birthday = $('#birthday').val();

            if(!group_id){
              error('请选择管理员角色！');
              return false;
            }
            if(name == ''){
              error('登陆名不能为空！');
              return false;
            }
            if(password == ''){
              error('密码不能为空！');
              return false;
            }
            if(confirpassword == ''){
              error('重复密码不能为空！');
              return false;
            }
            if(password != confirpassword){
              error('两次密码不一致！');
              return false;
            }
            if(fullname == ''){
              error('姓名不能为空！');
              return false;
            }
            if(fullname == ''){
              error('手机号不能为空');
              return false;
            }
            $.post(
              '/admin/add', 
              {
                'group_id':group_id,
                'venue_id':venue_id,
                'name':name,
                'password':password,
                'confirpassword':confirpassword,
                'fullname':fullname,
                'email':email,
                'tel':tel,
                'describe':describe,
                'disabled':disabled,
                'birthday':birthday,
                'type': type
              }, 
              function(data){
                  if(data){
                    if(data.code == 1){
                      success(data.msg);
                    }else{
                      error(data.msg);
                    }
                  }else{
                    error('网络异常！');
                  }
               });
          });
          })
          
      },
      //时间选择器
      datepicker:function(){
        $('.date').focus(function(){
          WdatePicker({dateFmt:'yyyy-MM-dd'})
        })
      }
      
  }
  
  function error(msg){
    var d = dialog({
      id : 'FADO',
      title: '系统提示',
      content: msg,
            width: 300,
            okValue: '确定',
            ok : function(){
        return true;
        }   
        })
          d.showModal();
  }
  function success(msg){
      var d = dialog({
        id : 'FADO1',
        title: '系统提示',
        content: msg,
        width: 300,
        okValue: '确定',
        ok : function(){
          window.location.href='/admin';
        }   
      })
      d.showModal();
  }
})