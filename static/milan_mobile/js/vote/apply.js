/** 
 * 登录js文件
 * @author: jianming@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
<<<<<<< HEAD
    require('dialog');

    var family_index = $('.family_members').children().length;
    module.exports = {
        dialogAlert: function(msg, url, fn ){
          var d = dialog({
            id : 'FADO',
            title: '系统提示',
            content: msg,
            width: 220,
            okValue: '确定',
            cancelValue: '取消',
            ok : function(){
               if( fn ){
                 fn();
               }
               if( url && url != ''){
                 window.location.href = url;
               }
               return true;
            },
            
         })
         d.show();
      },
=======
    var my_dialog =require('my_dialog');

    var family_index = $('.family_members').children().length;
    module.exports = {

>>>>>>> 1aaa50d
      apply1: function() {

          // validate signup form on keyup and submit
          $("#applyForm1").validate({
              rules: {
                  realname: "required",
                  nation: "required",
                  birthday: "required",
                  height: {
                    required: true,
                    number: true,
                  },
                  weight: {
                    required: true,
                    number: true,
                  },
                  birthday: "required",
                  native_place: "required",
                  id_number: {
                    required: true,
                    maxlength: 18,
                  },
                  mobile_phone: 'required',
                  
                  program_1: true,
                  program_2: true,
                  program_3: true,
                  program_4: true,
                  
              },
              messages: {
<<<<<<< HEAD
                  realname: "请输入您的名字",
                  nation: "请输入您的民族（如：汉族）",
                  birthday: "请选择您的生日",
                  id_number: {
                      required: "请输入身份证号",
                      maxlength: "请输入正确的身份证号",
                  },
=======
                title: "请输入作品标题",
                desc: "请输入作品描述"
>>>>>>> 1aaa50d
                  
              },
              submitHandler: function() {
                var param = $("#applyForm1").serialize();  
                
                $.ajax({  
                   url : "/avenueofstar/apply1",  
                   type : "post",  
                   dataType : "json",  
                   data: param,  
                   success : function(res) {
                     if(res.status == 0) {  
<<<<<<< HEAD
                       window.location.href = '/avenueofstar/apply2';
                     } else {
                       module.exports.dialogAlert(res.msg);
                     }  
                   },
                   error: function() {
                     module.exports.dialogAlert('网络异常！');
=======
                       //window.location.href = '/avenueofstar/apply2';
                       my_dialog.alert('保存成功');
                     } else {
                       my_dialog.alert(res.msg);
                     }  
                   },
                   error: function() {
                     my_dialog.alert('网络异常！');
>>>>>>> 1aaa50d
                   }
                });
              }  
        });

      },
      
      add_family_member: function() {
          $('.add_family_member').on('click', function(){
              var tr = '';
              tr += '<tr>';
              tr +=   '<td>';
              tr +=     '<input id="program_4" name="family['+ family_index +'][0]" class="form-control" type="text" placeholder="" required>';
              tr +=   '</td>';
              tr +=   '<td>';
              tr +=     '<input id="program_4" name="family['+ family_index +'][1]" class="form-control" type="text" placeholder="" required>';
              tr +=   '</td>';
              tr +=   '<td>';
              tr +=     '<input id="program_4" name="family['+ family_index +'][2]" class="form-control" type="text" placeholder="" required>';
              tr +=   '</td>';
              tr +=   '<td>';
              tr +=     '<a href="javascript:" class="remove_family_member">';
              tr +=       '<i class="fa fa-times"></i> 删除';
              tr +=     '</a>';
              tr +=   '</td>';
              tr += '</tr>';
              family_index ++;
              if($('.family_members').children().length>5){
<<<<<<< HEAD
                 module.exports.dialogAlert('请勿继续添加！');
=======
                 my_dialog.alert('请勿继续添加！');
>>>>>>> 1aaa50d
                 return
              }
              $('.family_members').append(tr);
          })
      },
      
      remove_family_member: function() {
        $(document).on('click', '.remove_family_member', function(){
          $(this).parent().parent().remove();
        })
      },
      
      apply2: function() {

        
        // validate signup form on keyup and submit
        $("#applyForm2").validate({
            rules: {
                growth_exprience: "required",
                nation: "required",
                birthday: "required",
                height: {
                  required: true,
                  number: true,
                },
                weight: {
                  required: true,
                  number: true,
                },
                birthday: "required",
            },
            messages: {
                realname: "请输入您的名字",
                nation: "请输入您的民族（如：汉族）",
                birthday: "请选择您的生日",
                confirm_password: {
                    required: "请再次输入密码",
                    minlength: "密码必须5个字符以上~",
                    equalTo: "两次输入的密码不一致"
                },
                email: "请输入您的E-mail"
            },
            submitHandler: function() {
              var param = $("#applyForm2").serialize();  
              
              $.ajax({  
                 url : "/avenueofstar/apply2",  
                 type : "post",  
                 dataType : "json",  
                 data: param,  
                 success : function(res) {
                   if(res.status == 0) {  
<<<<<<< HEAD
                     module.exports.dialogAlert('申请成功!', '/avenueofstar/index');
                   } else {
                     module.exports.dialogAlert(res.msg);
                   }
                 },
                 error: function() {
                   module.exports.dialogAlert('网络异常！');
=======
                     my_dialog.alert('申请成功!', '/avenueofstar/index');
                   } else {
                     my_dialog.alert(res.msg);
                   }
                 },
                 error: function() {
                   my_dialog.alert('网络异常！');
>>>>>>> 1aaa50d
                 }
              });
            }  
        });
  
      },
      
      upload_img:function(_self){
        $("#uploadbtn img").click(function(){
          $("#uploadImg").trigger('click');
          $('#uploadImg').unbind().on('change',function(e){
            _self = $(_self);
            data = new FormData();
            $.each($('#uploadImg')[0].files, function(i, file) {
              data.append('Filedata', file);
            });
              data.append('type', 'image');
            $.ajax({
              url:uploadUrl+'/file/upload',
              type:'POST',
              data:data,
              cache: false,
              contentType: false,    
              processData: false,
              dataType:'json',
              beforeSend:function(){
                $('#uploadbtn').children('img').attr('src', loadingImg);
                e.stopPropagation();
              },
              success:function(data){
                  $('#uploadbtn').children('input').val(data.url);
                  $('#uploadbtn').children('img').attr('src', data.full_url);
                  e.stopPropagation();
              }
            });
          })
        })
      },
        
      
      
    
    }
});