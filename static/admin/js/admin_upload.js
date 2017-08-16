jQuery.fn.bindAll = function(options) {
    var $this = this;
    jQuery.each(options, function(key, val){
        $this.bind(key, val);
    });
    return this;
}

$(function(){
    
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
            var value = parseInt(bytesLoaded/file.size*100)+'%';
            $("#"+file.id).find(".progress").html(value);
            $("#"+file.id).find(".pro_cont").css({'width':value});
        },
        uploadSuccess: function(event, file, serverData){
            $('.log', this).append('<li>Upload success - '+file.name+'</li>');
            if(this.id == 'uploader_cover_img'){
                var name = 'cover_img';
            } else if(this.id == 'uploader_img_url') {
                var name = 'head_img';
            } else if(this.id == 'uploader_img_url1') {
                var name = 'img';
            } else if(this.id == 'uploader_img_url2') {
                var name = 'img_url2';
            } else if(this.id == 'uploader_vedio_img') {
                var name = 'vedio_img';
            } else if (this.id == 'uploader_card_front') {
                var name = 'applicant_card_front';
            } else if (this.id == 'uploader_card_back') {
                var name = 'applicant_card_back';
            } else
            if(this.id == 'uploader_loupan_files'){
                var name = 'cover_img[]';
            } else
            if(this.id == 'uploader_contract_img'){
                var name = 'contract_img[]';
            } else
            if(this.id == 'uploader_venue_img'){
                var name = 'images[]';
            } else
            if(this.id == 'uploader_theme_img'){
                var name = 'images';
            }else
            if(this.id == 'uploader_house_card_front'){
                var name = 'card_front';
            } else
            if(this.id == 'uploader_house_card_back'){
                var name = 'card_back';
            } else
            if(this.id == 'uploader_business_license') {
                var name = 'business_license';
            } else
        	if(this.id == 'uploader_rich_text_img'){
                var name = 'rich_text_img';
            }
            
            var data = $.parseJSON(serverData);
            if(data.error == 0){
                var html = '';
                html += "<a class='close del-pic' href='javascript:;'></a>";
                html += "<img src='"+data.full_url+"' style='width: 100%; height: 100%' />";
                html += "<input type='hidden' name='"+name+"' value='"+data.url+"'/>";
            }else{
                var html =     "<p>"+file.name+"上传异常</p>"
            }
            $("#"+file.id).html(html);
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

    $('#uploader_cover_img').bindAll(listeners);
    $('#uploader_img_url').bindAll(listeners);
    $('#uploader_img_url1').bindAll(listeners);
    $('#uploader_img_url2').bindAll(listeners);
    $('#uploader_vedio_img').bindAll(listeners);
    $('#uploader_card_front').bindAll(listeners);
    $('#uploader_card_back').bindAll(listeners);
    $('#uploader_business_license').bindAll(listeners);
    $('#uploader_loupan_files').bindAll(listeners);
    $('#uploader_contract_img').bindAll(listeners);
    $('#uploader_venue_img').bindAll(listeners);
    $('#uploader_theme_img').bindAll(listeners);
    $('#uploader_house_card_front').bindAll(listeners);
    $('#uploader_house_card_back').bindAll(listeners);
    $('#uploader_rich_text_img').bindAll(listeners); 
});
        
$(function(){
    var object =[
        {"obj":"#uploader_cover_img", "btn":"#file_cover_img"},                  //资讯文章封面图
        {"obj":"#uploader_img_url", "btn":"#file_img_url"},                      //手工位导读图
        {"obj":"#uploader_img_url1", "btn":"#file_img_url1"},                    //手工位导读描述图
        {"obj":"#uploader_img_url2", "btn":"#file_img_url2"},                    //手工位导读背景图
        {"obj":"#uploader_vedio_img", "btn":"#file_vedio_img"},                  //视频预览图
        {"obj":"#uploader_card_front", "btn":"#file_card_front"},                //身份证正面
        {"obj":"#uploader_card_back", "btn":"#file_card_back"},                  //身份证背面
        {"obj":"#uploader_business_license", "btn":"#file_business_license"} ,    //营业执照
        {"obj":"#uploader_loupan_files", "btn":"#uploader_loupan_file"},     //上传楼盘附件
        {"obj":"#uploader_contract_img", "btn":"#file_contract_img"} ,//合同扫描件
        {"obj":"#uploader_venue_img", "btn":"#file_venue_img"}, //认购书扫描件
        {"obj":"#uploader_theme_img", "btn":"#file_theme_img"}, //主题相册
        {"obj":"#uploader_house_card_front", "btn":"#house_file_card_front"},
        {"obj":"#uploader_house_card_back", "btn":"#house_file_card_back"}
    ];

    $.each(object,function(key,value) {   
        $(value.obj).swfupload({
            upload_url: uploadUrl+"/file/upload",
            file_size_limit : "10240",
            file_types : "*.jpg;*.png;*.gif",
            file_types_description : "All Files",
            file_upload_limit : "0",
            flash_url : staticUrl+"/common/css/swfupload.swf",
            button_image_url : staticUrl+'/admin/images/add_pic.png',
            button_width : 232,
            button_height : 175,
            button_placeholder : $(value.btn)[0],
            debug: false,
            post_params: {
                'type': 'image'
            }
        });

        $(value.obj).on('click', '.del-pic', function(){
            $(this).parent().remove();
        });
    });
    
    $("#uploader_rich_text_img").swfupload({
        upload_url: uploadUrl+"/file/upload",
        file_size_limit : "10240",
        file_types : "*.jpg;*.png;*.gif",
        file_types_description : "All Files",
        file_upload_limit : "0",
        flash_url : staticUrl+"/common/css/swfupload.swf",
        button_image_url : staticUrl+'/www/images/upload-bg.png',
        button_width : 120,
        button_height : 40,
        button_placeholder : $("#file_rich_text_img")[0],
        debug: false,
        post_params: {
            'type': 'image'
        }
    });
    
    $("#uploader_rich_text_img").on('click', '.del-pic', function(){
        $(this).parent().remove();
    });
    
    $('#uploader_rich_text_img').on('click', 'img', function(){
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
    

  
   
});    
