(function($){
    $.extend({
        comfirmModal:function(content,hasBtn, callback){
            if(hasBtn===false){
                $(".sure").hide();
                $(".cancel").val("我知道了");
                $(".cancel").attr("class","sure");
            }else{
                $(".sure").show();
                $(".cancel").attr("class","cancel");
                $(".cancel").val("取消");

            }

            $(".content").html(content);
            $(".tip").fadeIn(200);
        }
        
    });
})(jQuery);


$(function(){
    $(".tiptop a").click(function(){
        $(".tip").fadeOut(200);
    });

    $(".sure").click(function(){
        $(".tip").fadeOut(100);
    });

    $(".cancel").click(function(){
        $(".tip").fadeOut(100);
    });

    

});


/* 上传文件 */
function uploadFile(show,save,type,save_title){
    KindEditor.ready(function(K) {
        var editor = K.editor({
            //指定上传文件的服务器端程序。
            uploadJson : baseUrl + '/File/upload',
            //true时显示浏览远程服务器按钮。
            allowFileManager : false
             
        });
        
        $(show).click(function() {
            if(type == 'image') {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                    	showRemote : false, //不允许网络图片
                        clickFn : function(url, title, width, height, border, align) {
                            editor.hideDialog();
                            if(save) {
                                K(save).val(url);
                                K(save).attr('src',url);
                                K(save).attr('href',url);
                                K(save_title).attr('src',url);
                            } else {
                                window.location.reload();
                            }
                        }
                    });
                });
            }
            if(type == 'file') {
                editor.loadPlugin('insertfile', function() {
                    editor.plugin.fileDialog({
                        fileUrl : K('#url').val(),
                        clickFn : function(url, title) {
                            editor.hideDialog();
                            if(save){
                                K(save).val(url);
                                K(save).attr('src',url);
                                K(save).attr('href',url);
                                K(save_title).val(title);
                            } else {
                                window.location.reload();
                            }
                        }
                    });
                });
            }
        });
    });
}

//更具拓展性的文件上传
//param show 触发上传按钮
//param type 文件类型
//param callback 上传成功回调函数
function upload_file(show,type,callback){
    KindEditor.ready(function(K) {
        var editor = K.editor({
            //指定上传文件的服务器端程序。
            uploadJson : baseUrl + '/File/upload',
            //truel时显示浏览远程服务器按钮。
            allowFileManager : false
             
        });
        
        $(show).click(function() {
            if(type == 'image') {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        clickFn : function(url, title, width, height, border, align) {
                            editor.hideDialog();
                                callback(url);
                        }
                    });
                });
            }
            if(type == 'file') {
                editor.loadPlugin('insertfile', function() {
                    editor.plugin.fileDialog({
                        fileUrl : K('#url').val(),
                        clickFn : function(url, title) {
                            editor.hideDialog();
                                callback();
                        }
                    });
                });
            }
        });
    });
}

/* 加载编辑器 */
function reloadEdit(content){
    KindEditor.ready(function(K) {
        var editor = K.create(content, {
            width :'700px',
            height:'400px',
            //指定上传文件的服务器端程序。
            uploadJson : baseUrl + '/file/upload',
            //true时显示浏览远程服务器按钮。
            allowFileManager : false,
        	filterMode:false,
            pasteType: 1,  //自动清除格式
            items:[
				'source', '|', 'undo', 'redo', '|', 'preview', 'cut', 'copy', 'paste',
				'plainpaste',  '|', 'justifyleft', 'justifycenter', 'justifyright',
				'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
				'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
				'flash', 'media', 'insertfile', 'table', 'hr','anchor', 'link', 'unlink'
			],
            afterBlur: function(){this.sync();}
            //syncType:'form'
        });

        //设置摘要
        K('#setSummary').click(function(e) {
            $('#summary').val(Clear(K.formatHtml(editor.selectedHtml(), { 'q' : ['q']})));
        });

    });
}
