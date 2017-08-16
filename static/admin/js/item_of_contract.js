/** 
 * 婚礼服务js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			alert:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(320);
				d.showModal();
			},
			
			//添加分类
			add_pid:function(){
				$(document).on('click', '#addpid', function(){
					var name = $('#class_name').val();
					var desc = $('#item_class_desc').val();
					
					if(!name || name == ''){
						module.exports.alert('请填写产品类型名称');
						return false;
					}
					
					if(!desc || desc == ''){
            module.exports.alert('请填写产品类型描述');
            return false;
          }
					
					$.post('/contract/add_pid', {'name':name, 'desc':desc}, function(data){
						if(data){
							if(data.code == 1){
							  $('#class_name').val('');
							  $('#item_class_desc').val('');
							  
								var html = '<option value="'+data.id+'">'+name+'</option>';
								$('#pid').append(html);
								
								var str = '';
								str += '<tr class="pid" id="p_'+data.id+'" style="border-bottom: 1px solid #c7c7c7;border-top:1px solid #c7c7c7">';
								str +=    '<th id="name_pid_'+data.id+'" colspan="3" style="text-align: center">'+name+'</th>';
								str +=    '<th>'
								str +=        '<a type="edit_pid" data="'+data.id+'" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;';
								str +=        '<a type="del_pid" data="'+data.id+'" class="tablelink">删除</a>';
								str +=    '</th>';
								str += '</tr>';
								str += '<tr>';
								str +=    '<td colspan="4">';
								str +=    desc;
								str +=    '<td>';
								str += '</tr>';
								$('#service').append(str);
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
				})
			},
			
			/**
       * 删除婚礼类别
       */
      del_pid:function(){
        $(document).on('click', '[type="del_pid"]', function(){
          var _obj = $(this);
          var id = _obj.attr('data');//要删除的id
          $.post('/contract/del_service_pid', {'id': id}, function(data){
            if(data){
              if(data.code == 1){
                $('#p_'+id).remove();
                $('#desc_pid_'+id).remove();

              }else{
                module.exports.alert(data.msg);
                return false;
              }
            }else{
              module.exports.alert('网络异常');
              return false;
            }
          })
          
        })
      },
      
      edit_pid:function(){
        $(document).on('click', '[type="edit_pid"]', function(){
          var _ojb = $(this);
          var id = _ojb.attr('data');
          var status = _ojb.attr('status');
          if(status == 0){
            var name = $('#name_pid_'+id).text();
            var html = '<input type="text" id="pid_name_'+id+'" class="dfinput" value="'+name+'" />';
            $('#name_pid_'+id).html(html);
            
            var desc = $('#desc_pid_'+id).text();
            var html = '<textarea id="pid_desc_'+id+'" type="text" class="textinput">'+ desc +'</textarea>';
            $('#desc_pid_'+id).html(html);

            //将编辑更改为保存
            _ojb.text('保存');
            _ojb.attr('status', 1);
          }else{
            //进入待保存状态
            var name = $("#pid_name_"+id).val();
            var desc = $("#pid_desc_"+id).val();
            
            if(name && desc){
              $.post('/contract/update_pid_service', {'id':id, 'name':name, 'desc':desc}, function(data){
                if(data){
                  if(data.code == 1){
                    //恢复表格状态
                    _ojb.attr('status', 0);
                    _ojb.text('编辑');
                   
                    $('#name_pid_'+id).text(name);
                    $('#desc_pid_'+id).text(desc);
                  }else{
                    module.exports.alert(data.msg);
                    return false;
                  }
                }else{
                  module.exports.alert('网络异常');
                  return false;
                }
              })
            }
          }
        })
      },
      
			/**
			 * 删除婚礼的服务
			 */
			del:function(){
				$(document).on('click', '[type="del"]', function(){
					var _obj = $(this);
					var id = _obj.attr('data');
					$.post('/contract/del_service', {'id':id}, function(data){
						if(data){
							if(data.code == 1){
								$('.'+_obj.attr('pid')+'[data="'+_obj.attr('kid')+'"]').remove();
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
					
				})
			},
			
			
			edit:function(){
				$(document).on('click', '[type="edit"]', function(){
					var _ojb = $(this);
					var id = _ojb.attr('data');
					var status = _ojb.attr('status');
					if(status == 0){
						//如果是编辑状态
						var name = $('#item_name_'+id).text();
						var html = '<input type="text" id="name_'+id+'" class="dfinput" value="'+name+'" />';
						$('#item_name_'+id).html(html);
						
						var price = $('#item_price_'+id).text();
						var html = '<input type="text" style="width: 136px;" id="price_'+id+'" class="dfinput" value="'+price+'" />';
						$('#item_price_'+id).html(html);

						//将编辑更改为保存
						_ojb.text('保存');
						_ojb.attr('status', 1);
					}else{
						//待保存状态，可以保存
						var name = $("#name_"+id).val();
						var price = $("#price_"+id).val();
						
						if(name && price){
							$.post('/contract/update_service', {'id':id, 'name':name, 'price':price}, function(data){
								if(data){
									if(data.code == 1){
										//恢复表格状态
										_ojb.attr('status', 0);
										_ojb.text('编辑');
										
										$('#item_name_'+id).text(name);
										$('#item_price_'+id).text(price);
									}else{
										module.exports.alert(data.msg);
										return false;
									}
								}else{
									module.exports.alert('网络异常');
									return false;
								}
							})
						}
					}
					
				})
			},
			
			//添加内容
			add:function(){
				$(document).on('click', '#add', function(){

					var pid = $('#pid').val();
					if(pid == 0){
						module.exports.alert('请选择产品类型');
						return false;
					}
					var names = $('#item_name').val();
					var price = $('#item_price').val();
					if(!names || names == ''){
						module.exports.alert('请输入产品名称');
						return false;
					}
					if(!price || price == ''){
						module.exports.alert('请输入产品价格');
						return false;
					}
					$.post('/contract/add_service', {'pid':pid, 'name':names, 'price':price}, function(data){
						if(data){
							if(data.code == 1){
								//获得改类别的最后一个记录的排序值
								if($('.p_'+pid).last().length !=0){
									var last_id = $('.p_'+pid).last().attr('data');
									var insert_id = parseInt(last_id)+1; //插入的序号id
								}else{
									var insert_id = 1;
								}
								var html = '';
								html += '<tr class="p_'+pid+'" data="'+insert_id+'" style="border-top:1px solid #c7c7c7">';
								html += '<td style="border-right:1px solid #c7c7c7;">'+insert_id+'</td>';
								html += '<td id="item_name_'+data.id+'">'+names+'</td>';
								html += '<td id="item_price_'+data.id+'">'+price+'</td>';
								html += '<td><a type="edit" data="'+data.id+'" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;<a type="del" pid="p_'+pid+'" kid="'+insert_id+'" data="'+data.id+'" class="tablelink">删除</a></td>';
								html += '</tr>';
								if($('.p_'+pid).last().length !=0){
									$('.p_'+pid).last().after(html);
								}else{
									$('#p_'+pid).next().after(html);
								}
								$('#desc').val('');
							}else{
								module.exports.alert(data.msg);
								return false;
							}
						}else{
							module.exports.alert('网络异常');
							return false;
						}
					})
				})
			},
			
			//显示添加产品类型的表单
			show_add_product_type: function () {
				$(document).on('click', '#add_product_type', function () {
					$('#product_type').toggle();
				});
			},

      //显示添加产品的表单
      show_add_product: function () {
        $(document).on('click', '#add_product', function() {
          $('#product').toggle();
        });
      },
	}
})
















