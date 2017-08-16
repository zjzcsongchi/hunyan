/**
 * 管理员详细信息js
 * @author chaokai@gz-zc.cn
 */
define(function(require, exports, module){
  require('dialog');
  
  module.exports = {
      del:function(){
        $('.del').click(function(){
          var id = $(this).data('id');
          var d = dialog({
            title:'提示',
            content : '确认删除？',
            cancel:function(){},
            cancelValue:'取消',
            okValue:'确认',
            ok:function(){
              $.get('/adminresume/del', {id:id}, function(data){
                if(data.status == 0){
                  window.location.reload();
                }
              })
            }
          })
          d.width(320)
          d.showModal();
          
        })
      }
  }
})
