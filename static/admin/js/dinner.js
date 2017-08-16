/**
 * 订单管理js
 */
define(function(require, exports, module){

	require('dialog');
	require('wdate');
	require('datatables');
	var spin = require('spin_lib');
    var pub = require('public');
	//require('jqvalidate');
	module.exports={
			//保存预约信息
			save:function(){
				$('form').submit(function(e){
					e.preventDefault();
					var data = $('#base').serialize();
					var spiner = spin.show();
					$.post('/dinner/add', data, function(data){
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
			//显示上传pc端封面图
			show:function(){
				$('#pc_').on('click', function(){
					$('#pc').attr('style', 'display:none');
					$('#pc_img').attr('style', 'display:block');
				})
			},

			//修改保存预约信息
			edit:function(){
				$('form').submit(function(e){

					e.preventDefault();
					var spiner = spin.show();
					var data = $('#base').serialize();
					$.post('/dinner/edit', data, function(data){
						spin.close(spiner);
						var d = dialog({
							title:"提示",
							content:data.msg,
							cancelValue:"取消",
							cancel:function(){},
							ok:function(){
								if(data.status == 0){
									window.location.href = '/dinner/show_detail/' + data.data.id;
								}
							},
							okValue:"确定"
						})
						d.width(320);
						d.showModal();
					})
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
			//删除预约
			del:function(){
				$(document).on('click', '.del', function(){
					var id = $(this).attr('data-id');
                    var html  = '<form><select  class="form-control" name="unusual">' +
						'<option  value="1" selected>删除订单</option>' +
						'<option  value="2" >定金延期</option>' +
						'<option  value="3" >已退定金</option>' +
						'<option  value="4" >其他异常</option></select><br/><br/>' +
						'备注：<textarea class="form-control" name="unusual_remark"></textarea>' +
						'<span name="remark_error" style="color:red"></span>' +
						'</form>';
					var d = dialog({
						fixed:true,
						title:'操作',
						content:html,
						cancel:function(){},
						cancelValue:'取消',
						ok:function(){
                            var unusual = $.trim($("select[name='unusual']").val());
                            var unusual_remark = $.trim($("textarea[name='unusual_remark']").val());
                            if (!unusual_remark) {
                                console.log('ok');
                                $("span[name='remark_error']").text('备注信息不能为空');
                                return false;
                            }
                            var data = {unusual:unusual,remark:unusual_remark};
							$.post('/dinner/del/'+id, data, function(data){
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
			//彻底删除
			thorough_del:function(){
				$(".thorough_del").click(function(){
					var id = $(this).data('id')
					var d = dialog({
						title:'提示',
						content:'彻底删除将无法恢复，确定吗？',
						cancelValue:'取消',
						cancel:function(){},
						okValue:'确认',
						ok:function(){
							$.post('/contract/thorough_del', {id:id}, function(data){
								try
								{
									if(data.status == 0){
										window.location.reload()
									}else{
										throw data.msg
									}
								}catch(err){
									var d1 = dialog({
										title:'错误',
										content:err,
										okValue:'确认',
										ok:function(){}
									})
									d1.width(320)
									d1.showModal()
								}
							})
						}
					})
					d.width(320)
					d.showModal()
				})
			},
			//选择显示单份菜还是套餐
			choose_menus:function(){
				$('#choose_menus').click(function(){
					var type = $('input:checked[name=menus_type]').attr('data-type');
					var content = '<form id="'+type+'_dialog" class="form-horizontal">';
					content += $('#'+type).html();
					content += '</form>';
					var d = dialog({
						title:'选择菜品',
						content:content,
						cancel:true,
						cancelValue:'取消',
						okValue:'确定',
						ok:function(){
							var content = '';
							$('#'+type+'_dialog').find('input:checked[type=checkbox]').each(function(k,v){
								var id = $(this).val();
								var text = $(this).parent().text();
								var count = $(this).parents('.checkbox').next('div').children('input').val();

								content += '<li>*'+text+count+'份<input type="hidden" value="'+id+','+count+'" name="menus[]"></li>';
							})
							$('#all_menus').html(content);
						}
					})
					d.width(500);
					d.showModal();
				})
			},

			extend_show:function(){
				$("input[class='drink']").change(function(){
					var is_show = $(this).val();
					if(is_show == 0){
						$(this).parent().parent().siblings("div").hide();
					}else{
						$(this).parent().parent().siblings("div").show();
						$(this).parent().parent().parent().find(".hide").hide();
					}
				})
			},

			//宴会类型选择
			dinner_type:function(){
				$('#dinnertype').change(function(){
					if($(this).val() != 1){
						$('.dinner_other').removeClass('hide').addClass('show');
						$('.dinner_marry').each(function(k, v){
							$(v).removeClass('show').addClass('hide');
						})
					}else{
						$('.dinner_other').removeClass('show').addClass('hide');
						$('.dinner_marry').each(function(k, v){
							$(v).removeClass('hide').addClass('show');
						})
					}

					if ($(this).val() == 2 || $(this).val() == 3 || $(this).val() == 4 || $(this).val() == 5) {
					  $('.dinner_parent').removeClass('hide').addClass('show');
					} else {
					  $('.dinner_parent').removeClass('show').addClass('hide');
					}

				})
			},
			show_tables:function(){
				$('#table').DataTable({
					ordering:true,
					aaSorting:[1, 'asc'],
					fixedHeader:true,
					bPaginate:false,
					bInfo:false,
					sScrollY: "650px",
					autoWidth:false,
					sScrollX:true,
					scrollCollapse:false
				})
			},
			show_tables2:function(){
        $('#table').DataTable({
          ordering:true,
          aaSorting:[1, 'asc'],
          fixedHeader:true,
          bPaginate:false,
          bInfo:false,
          sScrollY: "650px",
          autoWidth:false,
          sScrollX:true,
          scrollCollapse:false
        })
      },
			//更改排序，置顶显示
			up_show:function(){
				$('.up_order').click(function(){
					var id = $(this).attr('data-id');
					$.post('/dinner/up_show', {id:id}, function(data){
						var d = dialog({
							title:'提示',
							okValue:'确定',
							ok:function(){

							}
						})
						if(data.status == 0){
							d.content('置顶成功');
						}else{
							d.content('置顶失败');
						}
						d.width(320);
						d.showModal();
					})
				})
			},

			/*
			//订单归档
			archive:function(){
				$(".archive").click(function(){
					var id = $(this).data('id');
					var post_url='/dinner/order_review_archive';
					$.ajax({
                		type: 'get',
                		url: '/dinner/get_contract_archive_html',
                		data: {'id': receipt_id},
                		dataType: 'html',
                		success: function(res){
                			if (res) {
                				var d = dialog({
                                    title: '归档',
                                    content: res,
                                    okValue: '确定',
                                    ok: function () {
                                        this.title('提交中…');
                                        var params = {
                                          'id': id,
                                          'final_payment': $('#final_payment').val(),
                                          'method_payment': $("#method_payment option:selected").val(),
                                          'coupon': '',
                                        };
                                        $.post('/dinner/order_review_archive', params, function(res) {
                                          if(res.status == 0){
                                            pub.showDialog(res.msg, '', function(){
                                              window.location.reload();
                                            });
                                          }else if(res.status){
                                            pub.showDialog(res.msg);
                                          }else{
                                            pub.showDialog('网络错误或您没有权限做此操作!');
                                          }
                                        });
                                    },
                                    cancelValue: '取消',
                                    cancel: function () {}
                                });
                                d.showModal();
                			}
                		},
                        error: function(){
                            window.alert('网络出错，请稍后再试');
                        },
                	});
				});
			},
			*/

			//增加优惠券
		    add_coupon: function() {
		    	coupon_index = 10;
		      $('#add').on('click', function(){



		          var li = '';
		          li += '<div class="form-group dinner_marry "><label class="col-sm-3 control-label"></label>';
		          li +=   '<div class="col-sm-3">';
		          li +=     '<input type="text" name="coupon['+ coupon_index +'][number]" class="form-control" placeholder="请输入代金券编号" value="" >';
		          li +=   '</div>';
		          li +=   '<div class="col-sm-3">';
		          li +=     '<input type="text" name="coupon['+ coupon_index +'][money]" class="form-control" placeholder="请输入代金券金额" value="" >';
		          li +=   '</div>';
		          li +=   '<a class="coupon_del btn btn-primary btn-xs">删除</a>';
		          li += '</div>';
		          coupon_index  = coupon_index*2;
		          $('#coupon').after(li);
		        })
		    },

		  //删除优惠券
		    remove_coupon: function() {
		      $("body").on('click', '.coupon_del', function(){
		        $(this).parent().remove();
		      })
		    },

        //订单审核
        examination: function() {
            $(".examination").click(function(){
                var id = $(this).data('id');
                var post_url = '/dinner/order_review';
                //判断订单是否为审核失败订单（状态为1）
                var examination_code = $(this).data('examination_suatus');
                var examination_suatus = examination_code == 1 ? 'checked="checked"' : '';
                var examination_reason = $(this).data('examination_reason');
                var title = '审核';
                var html = '<div class="forminfo small-size">';
                html += '<label class="col-sm-6"><input  name="examination_status" type="radio" value="1" checked="checked">审核通过</label> <label class="col-sm-6"><input name="examination_status" type="radio" ' + examination_suatus + 'value="2" >审核失败</label>';
                html += '审核理由：<br/><textarea class="form-control" id="remark" class="textinput" style="width:342px; height: 100px">' + examination_reason +'</textarea>';
                html += '</div>';
                //如果订单未待归档订单，添加尾款
                if (examination_code == 2) {
                	title = '归档';
                    post_url = '/dinner/order_review_archive';
                	$.ajax({
                		type: 'get',
                		url: '/contract/get_contract_archive_html',
                		async: false,
                		data: {'id': id},
                		dataType: 'html',
                		success: function(res){
                			html = res;
                		},
						error: function(){
						    html = '';
						},
                	});
                }
                if (! html) {
                	window.alert('网络出错，请稍后再试');
                	return;
                }
                var d = dialog({
                    title: title,
                    content: html,
                    okValue: '确定',
                    ok: function () {
                        this.title('提交中…');
                        //使用代金券
                        var coupon = '';
                        $("input[name=coupons]").each(function(){
                        	if ($(this).prop("checked")) {
                        		coupon += $(this).val();
                        		coupon += ",";
                        	}
                        });
                        var params = {
                          'id': id,
                          'examination_status': $("input[name='examination_status']:checked").val() ? $("input[name='examination_status']:checked").val() : '',
                          'examination_reason': $("#remark").val() ? $("#remark").val() : '',
                          'final_payment': $('#final_payment').val() ? $('#final_payment').val() : '',
                          'method_payment': $("#method_payment option:selected").val() ? $("#method_payment option:selected").val() : '',
                          'coupon_num': $('#coupon_num').val() ? $('#coupon_num').val() : '',
                          'remark': $('#remark').val() ? $('#remark').val() : '',
                          'coupon': coupon ? coupon : '',
                        };
                        $.post(post_url, params, function(res) {
                          if(res.status == 0){
                            pub.showDialog(res.msg, '', function(){
                              window.location.reload();
                            });
                          }else if(res.status){
                            pub.showDialog(res.msg);
                          }else{
                            pub.showDialog('网络错误或您没有权限做此操作!');
                          }
                        });
                    },
                    cancelValue: '取消',
                    cancel: function () {}
                });
                // d.width(400);
                // d.height(200);
                d.showModal();
            });
      },

			show_ewm:function(){
	        	$('.ewm').on('click', function(){
	        		var url = $(this).attr('data-url');
	                var d = dialog({
	                	id: 'EF893Ls',
	        		    title: '请扫描屏幕二维码查看',
	        		    width:200,
	        		    cancelValue: '取消',
	        		    content: '<img style="width:200px" src="/publicservice/qr_code?link='+url+'">'
	        		});
	        		d.showModal();
	        	});
	        },

			//上传凭证
			upload_attachment: function(){
        $('.upload_attachment').on('click', function(){

          var change_record_id = $(this).data('id');
          var dinner_id = $(this).data('dinner_id');

          $.ajax({
            type:'get',
            url:'/dinner/get_upload_attachment',
            data: {
              'id': change_record_id,
              'dinner_id': dinner_id
            },
            dataType:'html',
            success:function(res){
              if(res){
                var d = dialog({
                    zIndex:109,
                    title:'执行单',
                    content: res,
                    cancelValue:'关闭',
                    cancel:function(){}
                })
                d.width(600);
                d.showModal();

              }else{
                alert(res.msg);
              }
            },
            error:function(){
              alert('网络出错，请稍后再试');
            }
          })

        });
      },

    //时间选择器
    wdate: function () {
        $(function(){
            $(".Wdate").focus(function(){
                WdatePicker({dateFmt:'yyyy-MM-dd'})
            });
        });
    },
    //判断是否为PC端
    isPC: function() {
      var userAgentInfo = window.navigator.userAgent;
      var Agents = ["Android", "iPhone",
                  "SymbianOS", "Windows Phone",
                  "iPad", "iPod"];
      var flag = true;
      for (var v = 0; v < Agents.length; v++) {
          if (userAgentInfo.indexOf(Agents[v]) > 0) {
              flag = false;
              break;
          }
      }
      return flag;
    },
    //判断是否为PC端，新窗口打开 or 本页面打开
    go_to_edit: function() {
      var is_PC = module.exports.isPC();
      $('.edit').on('click', function(){
        var id = $(this).data('id');
        if (is_PC) {
          window.location.href = '/dinner/edit/' + id;
        }else {
          window.open('/dinner/edit/' + id);
        }

      })
    },

   //判断是否为PC端，新窗口打开 or 本页面打开
    go_to_detail: function() {
      var is_PC = module.exports.isPC();
      $('.detail').on('click', function(){
        var id = $(this).data('id');
        if (is_PC) {
          window.location.href = '/dinner/show_detail/' + id;
        }else {
          window.open('/dinner/show_detail/' + id);
        }

      })
    },

    //防止按钮连续点击
    prevent_repeat_click: function () {
      $('.btn, .button').on('click', function() {
        _this = $(this);
        _this.addClass('disabled');
        _this.attr('disabled','true');
        var closetimer = window.setTimeout(function() {
          _this.removeClass('disabled');
          _this.removeAttr('disabled')
          window.clearTimeout(closetimer);
        }, 1500);
      })
    },
    //推送订单到厨房
    push:function(){
    	$(".push").click(function(){

    		var id = $(this).data('id')
    		var is_send_menu = parseInt($(this).data('is_send_menu'))
    		var is_send_egg = parseInt($(this).data('is_send_egg'))
    		var is_send_noodle = parseInt($(this).data('is_send_noodle'))

    		//获取弹框内容
    		$.get('/dinner/push_ajax', {id:id}, function(data){
    			try
    			{
    			if(data.status == 0){
    				var content = data.data;
    				var d = dialog({
		    			title:'选择需要推送的订单类型',
		    			content:content,
		    			cancel:function(){},
		    			cancelValue:'取消',
		    			okValue:'确认',
		    			ok:function(){
		    				var post_data = $("#push_form").serialize();
		    				$.post('/dinner/push', post_data, function(data){
		    					if(data.status == 0){
		    						window.location.reload()
		    					}else{
		    						throw new Error('推送失败')
		    					}
		    				})
		    			}
		    		})
    			}else{
    				throw new Error(data.msg)
    			}
    			d.width(500)
    			d.showModal();
    			}catch(err){
		    		var d_err = dialog({
						title:'提示',
						content:err.message,
						okValue:'确定',
						ok:function(){}
					})
					d_err.width(320)
					d_err.showModal()
		    	}
    		})

    	})

    	$(document).on('focus', '.check_show', function(){

    		if($(this).find("input[type=checkbox]").attr("is_check") == undefined){
	    		var remark = $(this).data('remark')

	    		remark_html = '<p>'+remark+'</p><hr>';
	    		$('#push_form').append(remark_html)

    			$(this).find("input[type=checkbox]").attr('is_check', 1)
    		}
    	})
    },
    //恢复已删除订单
    restore:function(){
    	$(".restore").click(function(){
			var id = $(this).data('id')
			var dia = dialog({
				title:'提示',
				content:'确认恢复？',
				cancelValue:'取消',
				cancel:function(){},
				okValue:'确认',
				ok:function(){
					$.post('/dinner/restore', {id:id}, function(data){
						try
			    		{
			    			if(data.status == 0){
			    				window.location.reload()
			    			}else{
			    				throw data.msg
			    			}
			    		}
			    		catch(err){
			    			var d = dialog({
			    				title:'错误',
			    				content:err,
			    				okValue:'确认',
			    				ok:function(){}
			    			})
			    			d.width(320)
			    			d.showModal()
			    		}
					})
				}
			})
			dia.width(320)
			dia.showModal()

    	})
    },
    //保存签字
    save_signature:function(){
    	$(".save_signature").click(function(){
    		var id = parseInt($(this).data('id'));
    		var signature = $.trim($("input[name='customer_signature']").val());
    		$.post('/dinner/save_invoice_notice',{id:id,signature:signature},function(data){	
				console.log(data);
    			var content = data.msg;
				var d = dialog({
	    			title:'提示',
	    			content:content,
	    			okValue:'确认',
	    			ok:function(){}
	    		});
    			
    			d.width(320);
    			d.showModal();
    		})
    	})
    },
        pop_consume_detail:function(){
            $("#print").click(function(){
                var html = '<div class="form-group"><label class="col-sm-5 control-label">是否打印</label>';
                html += '<div class="col-sm-8" style="float:left;margin-left: 100px;margin-top: -26px;">';
                html += '<label class="radio-inline"><input type="radio" name="is_print" checked="" value="1">已打印</label>';
                html += '<label class="radio-inline"><input type="radio" name="is_print"  value="0">未打印</label>';
                html += '</div></div>';
                var d = dialog({
                    title:"提示",
                    content:html,
                    ok:function(){
                        var is_print=$('input:radio[name="is_print"]:checked').val();
                        $.post('', {id:id,is_print:is_print}, function(){

                        })
                    },
                    okValue:"确定"
                });
                d.width(320);
                d.showModal();
            })
        },
    pop:function(){
            $("#print").click(function(){
                var html = '<div class="form-group"><label class="col-sm-5 control-label">是否打印</label>';
                html += '<div class="col-sm-8" style="float:left;margin-left: 100px;margin-top: -26px;">';
                html += '<label class="radio-inline"><input type="radio" name="is_print" checked="" value="1">已打印</label>';
                html += '<label class="radio-inline"><input type="radio" name="is_print"  value="0">未打印</label>';
                html += '</div></div>';
                var d = dialog({
                    title:"提示",
                    content:html,
                    ok:function(){
                        var is_print=$('input:radio[name="is_print"]:checked').val();
                        $.post('', {id:id,is_print:is_print}, function(){

                        })
                    },
                    okValue:"确定"
                });
                d.width(320);
                d.showModal();
            })
        },
        pop_egg:function(){
            $("#print").click(function(){
                var html = '<div class="form-group"><label class="col-sm-5 control-label">是否打印</label>';
                html += '<div class="col-sm-8" style="float:left;margin-left: 100px;margin-top: -26px;">';
                html += '<label class="radio-inline"><input type="radio" name="is_egg_print" checked="" value="1">已打印</label>';
                html += '<label class="radio-inline"><input type="radio" name="is_egg_print"  value="0">未打印</label>';
                html += '</div></div>';
                var d = dialog({
                    title:"提示",
                    content:html,
                    ok:function(){
                        var is_print=$('input:radio[name="is_egg_print"]:checked').val();
                        $.post('/kitchen/egg', {id:id,is_print:is_print}, function(){

                        })
                    },
                    okValue:"确定"
                });
                d.width(320);
                d.showModal();
            })
        },
        pop_noddles:function(){
            $("#print").click(function(){
                var html = '<div class="form-group"><label class="col-sm-5 control-label">是否打印</label>';
                html += '<div class="col-sm-8" style="float:left;margin-left: 100px;margin-top: -26px;">';
                html += '<label class="radio-inline"><input type="radio" name="is_rice_print" checked="" value="1">已打印</label>';
                html += '<label class="radio-inline"><input type="radio" name="is_rice_print"  value="0">未打印</label>';
                html += '</div></div>';
                var d = dialog({
                    title:"提示",
                    content:html,
                    ok:function(){
                        var is_print=$('input:radio[name="is_rice_print"]:checked').val();
                        $.post('/kitchen/rice_noodles', {id:id,is_print:is_print}, function(){

                        })
                    },
                    okValue:"确定"
                });
                d.width(320);
                d.showModal();
            })
        },
    resend_msg:function(){
    	$(".resend_msg").click(function(){
    		var dinner_id = $(this).attr("data-id");
    		$.post('/dinner/resend_msg', {dinner_id:dinner_id}, function(data){
    			if(data.status == 0){
    				var d = dialog({
    	    			title:'提示',
    	    			content:'短信发送成功',
    	    			okValue:'确认',
    	    			ok:function(){}
    	    		});
        			
        			d.width(320);
        			d.showModal();
    			}else{
    				var d = dialog({
    	    			title:'提示',
    	    			content:'短信发送失败',
    	    			okValue:'确认',
    	    			ok:function(){}
    	    		});
        			
        			d.width(320);
        			d.showModal();
    			}
    		});
    	})
    },
    
	}
})
