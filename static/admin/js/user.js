/** 
 * 会员管理js文件
 * @author: jianming@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    require('dialog');

    module.exports = {
        //模态框
        dialogModal: function() {
            $(".audit").click(function(){
                var obj = $(this);
                var html = '<ul class="forminfo">';
                html += '<li><label><input name="auth_status" type="radio" value="2" checked="checked">审核通过</label><label><input name="auth_status" type="radio" value="3">审核未通过</label></li>';
                html += '<li>备注：<br/><textarea id="remark" class="textinput" style="width:342px; height: 100px"></textarea></li>';
                html += '</ul>';
                var d = dialog({
                    title: '审核',
                    content: html,
                    okValue: '确定',
                    ok: function () {
                        this.title('提交中…');
                        var params = {
                            'user_id': obj.attr('data-id'),
                            'auth_status': $("input[name='auth_status']:checked").val(),
                            'remark': $("#remark").val()
                        }
                        $.post('/user/audit', params, function(data) {
                            if (data.flag) {
                                window.location.href = "/user";
                            };
                        });

                    },
                    cancelValue: '取消',
                    cancel: function () {}
                });
                // d.width(400);
                // d.height(200);
                d.showModal();
            });
        }

    }
     
});