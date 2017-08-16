/**
 * 订单管理js
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	require('datatables');
	var spin = require('spin_lib');
	require('jqvalidate');
	var common = require('public');
	module.exports={
			
			//保存信息
			save:function(){
			  $("input[name=company]").on('click', function(){
			    if($(this).val() == 'milan'){
			      $(".milan_company").show();
			    }else{
			      $(".milan_company").hide();
			    }
			  });
			  
				$('form').submit(function(e){
					e.preventDefault();
					var data = $('#base').serialize();

					if($("input[name=company]:checked").val() == 'milan' && (!$("select[name=menus]").val() || !$("select[name=theme]").val())){
					  common.showDialog('请选择婚礼套餐与主题');
					  return
					}

					var spiner = spin.show();
					$.post('/menu/add', data, function(data){
						if(data.status == 0){
							if(data.data.menu_id){
								var menu_id = data.data.menu_id;
								$.post('/menu/send_message', {menu_id:menu_id}, function(){
									
								})
							}
							
						}
						spin.close(spiner);
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.history.go(-1);
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
						
					})
				})
			},
			
			//取消所选择的单选钮checked 状态
			cancelCheck: function () {
        $(".cancel-checked").on('click', function(){
          $(this).parent()
                 .parent()
                 .parent()
                 .find("input[type='radio']")
                 .removeAttr("checked");
        });
			},
			
			//保存信息
			edit:function(){

			  $("input[name=company]").on('click', function(){
          if($(this).val() == 'milan'){
            $(".milan_company").show();
          }else{
            $(".milan_company").hide();
          }
        });
			  
				$('form').submit(function(e){
					e.preventDefault();
					var data = $('#base').serialize();
					
					if($("input[name=company]:checked").val() == 'milan' && (!$("select[name=menus]").val() || !$("select[name=theme]").val())){
            common.showDialog('请选择婚礼套餐与主题');
            return
          }
					
					var spiner = spin.show();
					$.post('/menu/edit', data, function(data){
						if(data.status == 0){
							if(data.data.menu_id){
								var menu_id = data.data.menu_id;
								$.post('/menu/send_message', {menu_id:menu_id}, function(){
									
								})
							}
						}
						spin.close(spiner);
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.history.go(-1);
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					})
				})
			},
			
			
			//删除预约
			del:function(){
				$(document).on('click', '.del', function(){
					var id = $(this).attr('data-id');
					var d = dialog({
						fixed:true,
						title:'提示',
						content:'确认删除？',
						cancel:function(){},
						cancelValue:'取消',
						ok:function(){
							$.get('/menu/del/'+id, function(data){
								d.content(data.msg);
								if(data.status == 0){
									window.location.reload();
								}
							})
							return false;
						},
						okValue:'确定'
					})
					d.width(320);
					d.showModal()
				})
			},
			//查看档期
			blank:function(){
				$(".blank").click(function(){
					var obj = $(this);
					var id = obj.attr("data-id");
					var type = obj.attr("data-type");
					var schedule_time = $("#schedule_time").val();
					$.post('/menu/blank', {id:id,type:type,schedule_time:schedule_time},function(data){
						$("#blank").html(data);
						$("#blank").show();
					})
				})
			},
			
			close_blank:function(){
				$('body').on('click' , '.close' , function(){
					$("#blank").hide();
				})
			},
			//显示上传pc端封面图
			show:function(){
				$('#pc_').on('click', function(){
					$('#pc').attr('style', 'display:none');
					$('#pc_img').attr('style', 'display:block');
				})
			},
			
			//时间选择器
			datepick:function(){
				$(".Wdate").focus(function(){
					//var date = new Date();
					//$(this).val(date.getFullYear()+'-'+date.getMonth()+'-'+date.getDate());
					if(arguments[0] && arguments[1]){
						WdatePicker({dateFmt:'yyyy-MM-dd', minDate:arguments[0], maxDate:arguments[1]})
					}else{
						WdatePicker({dateFmt:'yyyy-MM-dd'});
					}
					var date = $(this).val().split("-");
		            //计算农历
					if(date.length > 1){
						var link = 'year='+date[0]+'&month='+date[1]+'&day='+date[2];
						$.get('/publicservice/solartolunar?'+link, function(data){
							$('.lunardate').val(data.lunar_time.lunar_time)
							$('.week').val(data.lunar_time.week);
						})
						
					}
		            
		        });
				
				$(".tdate").focus(function(){
					WdatePicker({dateFmt:'HH:mm'})
				});
				$(".Cdate").focus(function(){
					WdatePicker({dateFmt:'yyyy-MM-dd'})
				});
			},
			
			show_tables:function(){
				$('#table').DataTable({
					ordering:true,
					aaSorting:[2, 'asc'],
					fixedHeader:true,
					bPaginate:false,
					bInfo:false,
					sScrollY: "650px",
					autoWidth:false,
					sScrollX:true,
					scrollCollapse:false
				})
			},
			
	}
})
