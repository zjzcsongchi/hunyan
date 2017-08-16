<!DOCTYPE html>
<html><head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>米兰国际 - 收件箱</title>


    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $domain['static']['url'].'/milan_mobile/font-awesome/css/font-awesome.css';?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('animate.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('style-milan.css', 'milan_mobile');?>" type="text/css" rel="stylesheet"/>
    
    <link href="<?php echo css_js_url('plugins/fullcalendar/fullcalendar.css', 'milan_mobile');?>" rel="stylesheet">
    <link href="<?php echo css_js_url('plugins/fullcalendar/fullcalendar.print.css', 'milan_mobile');?>" rel="stylesheet">
    

</head>

<body class="pace-done">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu" style="display: block;">
                    <li>
                        <a href="/milanschedule/index"><i class="fa fa-th-large"></i> <span class="nav-label">主页</span> </a>
                    </li>

                    <li>
                        <a href="mailbox.html">
                            <i class="fa fa-envelope"></i> 
                            <span class="nav-label">档期消息 </span>
                            <?php if($unread_message_count > 0):?>
                            <span class="label label-warning pull-right"><?php echo $unread_message_count;  ?></span>
                            <?php endif?>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/milanschedule/unread_message">新消息</a>
                            </li>
                            <li><a href="/milanschedule/all_message">所有消息</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="/milanschedule/schedule"><i class="fa fa-calendar"></i> <span class="nav-label">档期日历</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" href="/milanschedule/unread_message">
                                <i class="fa fa-bell"></i>  
                                <span class="label label-warning">
                                    <?php echo $unread_message_count;  ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/milanschedule/logout"><i class="fa fa-sign-out"></i> 退出</a>
                        </li>
                    </ul>

                </nav>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>档期日历 </h5>
                            <div class="ibox-tools">
                                
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="pull-right">
                   
                </div>
                <div>
                    <strong>Copyright</strong> H+ © 2014
                </div>
            </div>

        </div>
    </div>
    

    <!-- Mainly scripts -->
    <script src="<?php echo css_js_url('jquery-2.1.1.min.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('bootstrap.min.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('plugins/metisMenu/jquery.metisMenu.js','milan_mobile');?>"></script>
    <script src="<?php echo css_js_url('plugins/slimscroll/jquery.slimscroll.min.js','milan_mobile');?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo css_js_url('hplus.js','milan_mobile');?> "></script>
    
    <!-- Full Calendar -->
    <script src="<?php echo css_js_url('plugins/fullcalendar/fullcalendar.min.js','milan_mobile');?> "></script>

    <script>
        $(document).ready(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                },
                titleFormat:{
                  month: ' yyyy年M月',
                },
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                },

                events: function(start, end, callback) {
                  var year = end.getFullYear();
                  var month = end.getMonth();
                  if(month == 0){
                    month = 12;
                    year -= 1;
                  }
                  $.ajax({
                      type: "post",
                      url: "/milanschedule/schedule",
                      dataType: "json",
                      data: {
                          year: year,
                          month: month
                      },
                      success: function(res) {
                          if(res.status == 0){
                            var event = [];
                            $.each(res.data,
                            function(i) {
                                event.push({
                                    title: '档期详情',
                                    start: new Date(res.data[i].y, res.data[i].m, res.data[i].d),
                                    url: "/milanschedule/schedule_detail?menu_id=" + res.data[i].menu_id,
                                    editable: false,
                                    borderColor: res.data[i].status == 0 ? 'red' : 'green'
                                });
                            });
                            callback(event);
                          }else{
                            //Nothing to do
                          }
                      }
                  });
              	}
            });


        });
    </script>
    
    
    <!-- user-defined -->
    <script>
        $(document).ready(function () {
            $('.confirm_schedule').on('click',function(){
                _this = $(this);
                $.ajax({  
                url : "/milanschedule/confirm_schedule",
                type : "post",  
                dataType : "json",
                data: {id: _this.data('id')},  
                success : function(res) {
                  if(res.status == 0) {
                    alert('档期确认成功');
                    _this.addClass('disabled');
                    _this.parent().prev().removeClass('text-danger');
                    _this.parent().prev().addClass('text-navy');
                    _this.parent().prev().text('已确认');
                  } else {
                    alert('档期确认失败, 请重新确认!');
                  }
                },
                error: function() {
                  alert('网络异常, 请重新确认!');
                }
                });
            });
        });
    </script>

</body>
</html>