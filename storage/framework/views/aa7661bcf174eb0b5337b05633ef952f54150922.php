<?php $__env->startSection('head'); ?>
    <?php echo HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css"); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainarea'); ?>

    <div class="page-head">
        <div class="page-title">
            <h1>
                <b style="font-weight: 400"><?php if($loggedAdmin->type=='superadmin'): ?><?php echo e($loggedAdmin->company->company_name); ?> <?php endif; ?></b> <?php echo e(trans('core.dashboard')); ?>

            </h1>
        </div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active"><?php echo e(trans('core.dashboard')); ?></span>
            </li>
        </ul>

    </div>
    <?php if($loggedAdmin->company->license_expired == 1): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="note note-danger"><i class="fa fa-close"></i> You have unpaid invoices past due date. Please
                    pay them by going to Settings > Billing to restore access to your account.
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($loggedAdmin->company->license_expired == 0): ?>
        <?php if(($displaySetup == true and $nextStepNumber > 3) || $displaySetup == false): ?>
            <?php if(!$loggedAdmin->checkEmailVerified()): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="note note-danger"><i
                                    class="fa fa-close"></i> <?php echo trans("messages.verifyEmail", ["link" => URL::to('admin/resend_verify_email')]); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($loggedAdmin->company->billing_address == ""): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="note note-danger"><i class="fa fa-close"></i> Please update your billing address and
                            timezone by going to <a href="<?php echo e(route('admin.general_setting.edit')); ?>">company
                                settings</a>.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($loggedAdmin->company->license_expired == 0): ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="number count">
                            <?php echo e($employee_count); ?>

                        </div>
                        <div class="desc">
                            <?php echo e(trans('core.totalEmployees')); ?>

                        </div>
                    </div>
                    <a class="more" onclick="loadView('<?php echo e(route('admin.employees.index')); ?>')">
                        <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="details">
                        <div class="number count">
                            <?php echo e($department_count); ?>

                        </div>
                        <div class="desc">
                            <?php echo e(trans('core.totalDepartments')); ?>

                        </div>
                    </div>
                    <a class="more" onclick="loadView('<?php echo e(route('admin.departments.index')); ?>')">
                        <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>

            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->award_feature==1): ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green-haze">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number count">
                                <?php echo e($awards_count); ?>

                            </div>
                            <div class="desc">
                                <?php echo e(trans('core.totalAwards')); ?>

                            </div>
                        </div>
                        <a class="more" onclick="loadView('<?php echo e(route('admin.awards.index')); ?>')">
                            <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
        <?php if($displaySetup == true): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption ">
                                
                                <?php echo app('translator')->get("core.welcomeTitle"); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <p><?php echo app('translator')->get("core.welcomeMessage"); ?></p>
                            <hr>
                            <p style="font-weight: bold; font-size: 16px;"><?php echo app('translator')->get("core.step"); ?> <?php echo e($nextStepNumber); ?>: <a
                                        href="javascript:;" onclick="loadView('<?php echo e($nextStepLink); ?>')"><?php echo e($nextStep); ?> <i
                                            class="fa fa-arrow-circle-o-right"></i> </a></p>
                            <div class="progress progress-striped  margin-bottom-5">
                                <div class="progress-bar progress-bar-info" role="progressbar"
                                     aria-valuenow="<?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>"
                                     aria-valuemin="0" aria-valuemax="100"
                                     style="width: <?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>%">
                                    <span class="sr-only"> <?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>% Complete </span>
                                </div>
                            </div>
                            <span><strong><?php echo app('translator')->get("core.progress"); ?></strong>: <?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>% <?php echo app('translator')->get("core.complete"); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">


            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->attendance_feature==1): ?>
                <div class="col-md-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red">
                                <i class="icon-users font-red"></i>
                                <?php echo e(trans('core.attendance')); ?>

                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="calendar" class="has-toolbar">
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif; ?>
            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->expense_feature==1): ?>
                <div class="col-md-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue">
                                <?php echo e($loggedAdmin->company->currency_symbol); ?>

                                <?php echo e(trans('core.expenseReport')); ?>

                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="expenseChart" style="width: 100%; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>

                </div>
            <?php endif; ?>
        </div>

        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="fa fa-birthday-cake font-dark"></i><?php echo e(trans("core.".date('F'))); ?> <?php echo e(trans('core.birthdays')); ?>

                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">


                                <?php $__empty_1 = true; $__currentLoopData = $current_month_birthdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm">
                                                        <?php echo HTML::image($birthday->profile_image_url,'ProfileImage',['class'=>"rounded-x",'width'=>'25px']); ?>

                                                    </div>
                                                </div>

                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        <span><strong><?php echo e($birthday->full_name); ?></strong>  <?php echo e(trans('core.hasBirthDayOn')); ?></span>
                                                        <strong><?php echo e(date('d F ',strtotime($birthday->date_of_birth))); ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-center"
                                       style="padding: 4px; margin-top: 26%;"><?php echo e(trans('messages.noBirthdays')); ?></p>
                                <?php endif; ?>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->award_feature==1): ?>
                <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="fa fa-trophy font-dark"></i><?php echo e(trans('core.awards')); ?>

                            </div>

                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">


                                    <?php $__empty_1 = true; $__currentLoopData = $awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm ">
                                                            <?php echo HTML::image($award->employee->profile_image_url,'ProfileImage',['class'=>"rounded-x",'height'=>'25px']); ?>


                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            <?php echo e(\Illuminate\Support\Str::words($award->employee->full_name,1,'')); ?>

                                                            <span class="label label-sm label-info ">
            														<?php echo e($award->award_name); ?>

            														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    <?php echo e(ucfirst($award->month)); ?> <?php echo e($award->year); ?>

                                                </div>
                                            </div>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="text-center"
                                           style="padding: 4px; margin-top: 26%;"><?php echo e(trans("messages.noAwards")); ?></p>
                                    <?php endif; ?>


                                </ul>
                            </div>

                            <div class="scroller-footer">
                                <div class="btn-arrow-link pull-right">
                                    <a onclick="loadView('<?php echo e(route('admin.awards.index')); ?>')"><?php echo e(trans('core.seeAll')); ?></a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>






    <?php endif; ?>
    <!-- END DASHBOARD STATS -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
    <?php if($loggedAdmin->company->license_expired == 0): ?>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php echo HTML::script("assets/global/plugins/moment.min.js"); ?>

        <?php echo HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js"); ?>

        <?php echo HTML::script("assets/global/plugins/fullcalendar/lang-all.js"); ?>

        <?php echo HTML::script("assets/global/plugins/highcharts/js/highcharts.js"); ?>

        <?php echo HTML::script("assets/global/plugins/highcharts/js/modules/exporting.js"); ?>


        <script>

            var Calendar = function () {


                return {
                    //main function to initiate the module
                    init: function () {
                        Calendar.initCalendar();


                    },

                    initCalendar: function () {

                        if (!jQuery().fullCalendar) {
                            return;
                        }

                        var date = new Date();
                        var d = date.getDate();
                        var m = date.getMonth();
                        var y = date.getFullYear();

                        var h = {};


                        if ($('#calendar').parents(".portlet").width() <= 720) {

                            $('#calendar').addClass("mobile");
                            h = {
                                left: 'title, prev, next',
                                center: '',
                                right: 'today,month'
                            };
                        } else {
                            $('#calendar').removeClass("mobile");
                            h = {
                                left: 'title',
                                center: '',
                                right: 'prev,next,today'
                            };
                        }

                        $('#calendar').fullCalendar('destroy'); // destroy the calendar
                        $('#calendar').fullCalendar({ //re-initialize the calendar
                            lang: '<?php echo e(Lang::getLocale()); ?>',
                            header: h,
                            defaultView: 'month',
                            eventRender: function (event, element, view) {

                                var i = document.createElement('i');
                                // Add all your other classes here that are common, for demo just 'fa'
                                i.className = 'fa';
                                /*'ace-icon fa yellow bigger-250 '*/
                                i.classList.add(event.icon);
                                element.find('div.fc-content').prepend(i);


                                if (event.className == "holiday") {
                                    var dataToFind = moment(event.start).format('YYYY-MM-DD');
                                    $('.fc-day[data-date="' + dataToFind + '"]').css('background', '#fcebb6');
                                }
                            },
                            events: function (start, end, timezone, callback) {
                                jQuery.ajax({
                                    url: '<?php echo e(route('admin.attendance.ajax_load_calender')); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        start: start.format(),
                                        end: end.format()

                                    },
                                    success: function (doc) {
                                        var events = [];
                                        if (!!doc) {
                                            $.map(doc, function (r) {

                                                if (r.type == "attendance") {
                                                    type = r.type;

                                                    if (r.title == "all present") {
                                                        icon = 'fa-check';
                                                        bgcolor = '';
                                                    } else {
                                                        icon = 'no';
                                                        bgcolor = '#e50000';
                                                    }

                                                    eClassName = '';
                                                } else if (r.type == 'birthday') {
                                                    type = r.type;
                                                    icon = 'fa-birthday-cake';
                                                    bgcolor = 'green';
                                                    eClassName = ''
                                                } else {
                                                    type = 'holiday';
                                                    icon = 'fa-tree';
                                                    bgcolor = '#444D58';
                                                    eClassName = 'holiday'
                                                }
                                                events.push({
                                                    className: eClassName,
                                                    icon: icon,
                                                    type: type,
                                                    color: bgcolor,
                                                    id: r.id,
                                                    title: r.title,
                                                    start: r.date

                                                });
                                            });
                                        }
                                        callback(events);
                                    }
                                });
                            }

                        });
                    }
                };
            }();

            $(function () {

                $('#expenseChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo e(trans('core.monthlyExpenseReport')); ?> ' + new Date().getFullYear()
                    },
                    xAxis: {
                        categories: [
                            '<?php echo e(trans('core.jan')); ?>',
                            '<?php echo e(trans('core.feb')); ?>',
                            '<?php echo e(trans('core.mar')); ?>',
                            '<?php echo e(trans('core.apr')); ?>',
                            '<?php echo e(trans('core.may')); ?>',
                            '<?php echo e(trans('core.june')); ?>',
                            '<?php echo e(trans('core.july')); ?>',
                            '<?php echo e(trans('core.aug')); ?>',
                            '<?php echo e(trans('core.sept')); ?>',
                            '<?php echo e(trans('core.oct')); ?>',
                            '<?php echo e(trans('core.nov')); ?>',
                            '<?php echo e(trans('core.dec')); ?>'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            useHTML: true,
                            text: '<?php echo e(trans('core.expense')); ?> (<?php echo $loggedAdmin->company->currency_symbol; ?>)'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f} <?php echo e($loggedAdmin->company->currency_symbol); ?></b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: '<?php echo e(trans('core.expense')); ?>',
                        data: [<?php echo $expense; ?> ]

                    }]
                });
            });

            jQuery(document).ready(function () {
                Calendar.init();
            });
        </script>
        <script>
            $('.count').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/dashboard/dashboard.blade.php ENDPATH**/ ?>