define(function(require, exports, module){
	jQuery.fn.bindAll = function(options) {
	    var $this = this;
	    jQuery.each(options, function(key, val){
	        $this.bind(key, val);
	    });
	    return this;
	}
	require('dialog');
	var listeners = {
	    swfuploadLoaded: function(event){
	        $('.log', this).append('<li>Loaded</li>');
	    },
	    fileQueued: function(event, file){
	        $('.log', this).append('<li>File queued - '+file.name+'</li>');
	        // start the upload once it is queued
	        // but only if this queue is not disabled
	        if (!$('input[name=disabled]:checked', this).length) {
	            $(this).swfupload('startUpload');
	        }
	    },
	    fileQueueError: function(event, file, errorCode, message){
	    	if(errorCode = '-110'){
	    		showDialog('文件过大，请重新上传！');
	    	}
	        $('.log', this).append('<li>File queue error - '+message+'</li>');
	    },
	    fileDialogStart: function(event){
	        $('.log', this).append('<li>File dialog start</li>');
	    },
	    fileDialogComplete: function(event, numFilesSelected, numFilesQueued){
	        $('.log', this).append('<li>File dialog complete</li>');
	    },
	    uploadStart: function(event, file){
	        $('.log', this).append('<li>Upload start - '+file.name+'</li>');
	        // don't start the upload if this queue is disabled
	        if ($('input[name=disabled]:checked', this).length) {
	            event.preventDefault();
	        }
	        if(this.id == 'uploader_rich_text_img'){
	        	var html = "<li id='"+file.id+"' class='pic pro_gre' style=' margin-left: 5px; clear: none'>"+
                "<div class='proCont'>"+
                "<p class='progress'>0%</p>"+
                "<div class='pro_pic'>"+
                    "<i  class='pro_cont' style='width:0%'></i>"+
                "</div>"+
                "</div></li>";
	        	$('#uploader_rich_text_img').append(html);
	        }else{
	        	var html = "<li id='"+file.id+"' class='pic pro_gre' style='margin-right: 20px; clear: none'>"+
	        	"<div class='proCont'>"+
	        	"<p class='progress'>0%</p>"+
	        	"<div class='pro_pic'>"+
	        	"<i  class='pro_cont' style='width:0%'></i>"+
	        	"</div>"+
	        	"</div></li>";
	        	$(this).find(".add-pic").before(html);
	        }

	       
	    },
	    uploadProgress: function(event, file, bytesLoaded){
	        $('.log', this).append('<li>Upload progress - '+bytesLoaded+'</li>');
	        var value = parseInt(bytesLoaded/file.size * 100)+'%';
	        $("#"+file.id).find(".progress").html(value);
	        $("#"+file.id).find(".pro_cont").css({'width':value});
	    },
	    uploadSuccess: function(event, file, serverData){
	        $('.log', this).append('<li>Upload success - '+file.name+'</li>');
	        //1. single image: id = "uploader_xxx"
	        //2. multi- image: id = "uploaders_xxx"
	        var isMultiUploader = this.id.indexOf('_') === 9;
	        var name = '';
	        if(isMultiUploader){
	            name = this.id.slice(10) + '[]'; //如果是多图上传，name 为 id 减去前面的 uploaders ，从字符串的第10个位置截取 
	        }else{
	        	name = this.id.slice(9); //如果是单图上传，name 为 id 减去前面的 uploader ，从字符串的第9个位置截取 
	        }
	        
	        var data = $.parseJSON(serverData);
	        var html = '';
	        if(data.error == 0){
	        	//如果是上传视频提示视频上传成功
	        	if($(this).attr('data-type') == 'video'){
	        		html += "<a class='close del-pic' href='javascript:;'></a>";
	        		html +=     "<p>"+file.name+"上传成功</p>"
	        		html += "<input type='hidden' name='"+name+"' value='"+data.url+"'/>";
	        		$("#"+file.id).html(html);
	        	}else if($(this).attr('data-type') == 'music'){
	        		html += "<a class='close del-pic' href='javascript:;'></a>";
	        		html +=     "<p>"+file.name+"上传成功</p>"
	        		
	        		html += '<audio src="'+data.full_url+'"  controls="controls"/>';
	        		html += '<input type="hidden" name="'+name+'" value="'+data.url+'"/>'
	        		$("#"+file.id).html(html);
	        	}else{
	        		html += "<a class='close del-pic' href='javascript:;'></a>";
	        		html +=     "<p>上传成功</p>"
	        		html += "<img src='"+data.full_url+"' style='width: 100%; height: 100%' />";
	        		html += "<input type='hidden' name='"+name+"' value='"+data.url+"'/>";
	        		$("#"+file.id).html(html);
	        	}
	        }else{
	            html =     "<p>"+file.name+"上传异常</p>"
	        }
	    },
	    uploadComplete: function(event, file){
	        $('.log', this).append('<li>Upload complete - '+file.name+'</li>');
	        // upload has completed, lets try the next one in the queue
	        // but only if this queue is not disabled
	        if (!$('input[name=disabled]:checked', this).length) {
	            $(this).swfupload('startUpload');
	        }
	    },
	    uploadError: function(event, file, errorCode, message){
	    	$('.log', this).append('<li>Upload error - '+message+'</li>');
	    	/*var html =     "<p>"+file.name+"上传异常:"+message+"</p>";
	    	$("#"+file.id).html(html);*/
	        
	    }
	};
	/**
     * 普通提示信息
     * 
     * @param msg
     * @param title
     * @param url 
     */
    function showDialog(msg, title, url){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
        var d = dialog({
        	id:'FVASDF',
            title: title,
            content: msg,
            width: 300,
            okValue: '确定',
            ok: function () {
            	if(url != '')
            	{
            		window.location.href=url;
            	}
                return true;
            }
        });
        d.showModal();
    }
	
	module.exports={
		swfupload: function (object){
			$.each(object, function(key, value) {
		    	$(value.obj).bindAll(listeners); 
		    	value.type = value.type ? value.type : 'image';
		    	if(value.type == 'rich_text'){
		    		$(value.obj).swfupload({
		    			upload_url: uploadUrl+"/file/upload_php",
		    			file_size_limit : max(),
		    			file_types : "*.jpg;*.png;*.gif;*.mp4;*.jpeg;*.mp3",
		    			file_types_description : "All Files",
		    			file_upload_limit : "0",
		    			flash_url : staticUrl+"/common/css/swfupload.swf",
		    			button_image_url : staticUrl+'/www/images/upload-bg.png',
		    			button_width : 120,
		    			button_height : 40,
		    			button_placeholder : $(value.btn)[0],
		    			debug: false,
		    			post_params: {
		    				'type': 'image'
		    			}
		    		});
		    	}else{
		    		$(value.obj).swfupload({
		    			upload_url: uploadUrl+"/file/upload_php",
		    			file_size_limit : max(),
		    			file_types : "*.jpg;*.png;*.gif;*.mp4;*.jpeg;*.mp3",
		    			file_types_description : "All Files",
		    			file_upload_limit : "0",
		    			flash_url : staticUrl+"/common/css/swfupload.swf",
		    			button_image_url : staticUrl+'/admin/images/add_pic.png',
		    			button_width : 232,
		    			button_height : 175,
		    			button_placeholder : $(value.btn)[0],
		    			debug: false,
		    			post_params: {
		    				'type': value.type
		    			}
		    		});
		    	}

		        $(value.obj).on('click', '.del-pic', function(){
		            $(this).parent().remove();
		        });
		        
		        function max(){
					if(value.type == 'video'){
						return '102400';
					}else if(value.type == 'music'){
						return '51200';
					}else{
						return '10240';
					}
					
				} 
		        
		    });
			
			$("#uploader_rich_text_img").on('click', '.del-pic', function(){
		        $(this).parent().remove();
		    });
		    
		    $('#uploader_rich_text_img').unbind('click').on('click', 'img', function(){
		        ue.execCommand( 'insertimage', {
		            src:$(this)[0].src
		        } );
		        $("<span class='checked'></span>").insertAfter($(this));
		    });
		    
		    var edit_img = $(".edit-img");
		    var  uploaderHeight = 0;
		    if (edit_img.length) {
		       
		        uploaderHeight = edit_img.height();
		        $(window).scroll(function(){
		        	var navH = $("#editor").offset().top;
		            var scroH = $(this).scrollTop(); //可视页顶滚动距离
		            var heightGap = $("#edui1_wordcount").offset().top - scroH +20; //富文本编辑器的可视高度
		            if(scroH >= navH){
		                if(heightGap > uploaderHeight){
		                    edit_img.css({"position":"fixed", "top":0, "left":"747px"});
		                }else{
		                    edit_img.css({"position":"fixed", "top":heightGap-uploaderHeight, "left":"747px"});
		                }
		            }else if(scroH<navH){
		                edit_img.css({"position":"static","left":"747px"});
		            }
		           
		        });
		    }
		}
	}

})


  
