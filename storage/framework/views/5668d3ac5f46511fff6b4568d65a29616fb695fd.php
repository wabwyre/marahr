<?php $__env->startSection('head'); ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/fullcalendar/fullcalendar.min.css"); ?>

    <!-- BEGIN THEME STYLES -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                <?php echo e(trans('pages.superAdminDashboard.title')); ?>

            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <span class="active"><?php echo e(trans('pages.superAdminDashboard.title')); ?></span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->


    <?php echo $setting->set_smtp_message; ?>


    <?php if($setting->system_update == 1): ?>
        <?php ($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo()); ?>
        <?php if(isset($updateVersionInfo['lastVersion'])): ?>
            <div class="note note-info row">
                <div class="col-md-10"><i class="fa fa-gift"></i> <?php echo app('translator')->get('core.newUpdate'); ?> <label
                            class="label label-success"><?php echo e($updateVersionInfo['lastVersion']); ?></label></div>
                <div class="col-md-2">
                    <a href="javascript:;" onclick="loadView('<?php echo e(route('admin.updateVersion.index')); ?>')"
                       class="btn btn-success btn-small"><?php echo app('translator')->get('core.updateNow'); ?>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        <?php endif; ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="details">
                    <div class="number count">
                        <?php echo e($loggedAdmin->company_count); ?>

                    </div>
                    <div class="desc">
                        <?php echo e(trans('core.totalCompany')); ?>

                    </div>
                </div>
                <a class="more" href="<?php echo e(route('admin.companies.index')); ?>">
                    <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
                <div class="visual">
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="details">
                    <div class="number count">
                        <?php echo e($company_lists->count()); ?>


                    </div>
                    <div class="desc">
                        <?php echo e(trans('core.weeklyActiveCompany')); ?>

                    </div>
                </div>
                <a class="more" href="<?php echo e(route('admin.licenses.index')); ?>">
                    <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat yellow-crusta">
                <div class="visual">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <i class="fa fa-<?php echo e(strtolower($currency)); ?>"></i> <span class="count"><?php echo e($total_earning); ?></span>
                    </div>

                    <div class="desc">
                        Total Income
                    </div>
                </div>
                <a class="more" href="<?php echo e(route('admin.invoices.index')); ?>">
                    <?php echo e(trans('core.viewMore')); ?> <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th-large font-blue"></i>
                        <span class="caption-subject font-blue bold uppercase"><?php echo app('translator')->get("core.weeklyActiveCompany"); ?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">

                            <?php $__currentLoopData = $company_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="col1">
                                        <?php echo HTML::image($company_data->logo_image_url,'Logo',['class'=>'logo-default','height'=>'20px']); ?>

                                        <div class="cont-col2">
                                            <div class="desc"><a
                                                        onclick="loadView('<?php echo e(route('admin.companies.edit', [$company_data->id])); ?>')"><?php echo e($company_data->company_name); ?></a>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col2">
                                        <div class="date"><?php echo e($company_data->last_in_words); ?></div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="scroller-footer">
                        <div class="btn-arrow-link pull-right">
                            <a onclick="loadView('<?php echo e(route('admin.companies.index')); ?>')">See All Records</a>
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-blue">
                        <i class="fa fa-line-chart font-blue"></i>
                        <?php echo e(trans('core.companyRegister')); ?>

                    </div>
                </div>
                <div class="portlet-body">
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12" id="earningReport">
            <div class="portlet light bordered ">
                <div class="portlet-title">
                    <div class="caption font-blue">
                        <?php echo e($currency_symbol); ?><?php echo e(trans('core.earningReport')); ?>

                    </div>
                    <div class="btn-group pull-right">
                        <span class="control-label"><strong>Filter By <?php echo app('translator')->get('core.year'); ?>:</strong></span>
                        <?php echo Form::select('employee_id', $earningYearFilter ,'all',['class' => 'form-control input-sm input-small input-inline ','id'=>'filterYear','data-placeholder'=> trans("core.selectAnEmployee").'...']); ?>

                    </div>
                </div>
                <div class="portlet-body">
                    <div id="earningChart" style="width: 100%; height: 400px; margin: 0 auto">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModal"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel">Rating HRM-SAAS on Codecanyon</h4>
                </div>
                <div class="modal-body">
                    <div class="note note-info">
                        Thank you for your recent purchase and using our application
                        <hr>
                        We hope you love it. If you do, would you mind taking 10 seconds to leave me a short review an review on codecanyon?
                        <br>
                        This helps us to continue providing great products, and helps potential buyers to make confident decisions.
                        <hr>
                        Thank you in advance for your review and for being a preferred customer.

                        <hr>


                        <a href="<?php echo e(\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()); ?>"> <img src="https://envato.froid.works/review/review-hrm-saas.png" alt=""></a>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideReviewModal('closed_permanently_button_pressed')">Hide Pop up permanently</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideReviewModal('already_reviewed_button_pressed')">Already Reviewed</button>
                    <a href="<?php echo e(\Froiden\Envato\Functions\EnvatoUpdate::reviewUrl()); ?>" target="_blank" type="button" class="btn btn-success">Give Review</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"); ?>

    <?php echo HTML::script("assets/pages/scripts/dashboard.min.js"); ?>

    <?php echo HTML::script("assets/admin/pages/scripts/components-dropdowns.js"); ?>

    <?php echo HTML::script("assets/global/plugins/moment.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/fullcalendar/fullcalendar.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/fullcalendar/lang-all.js"); ?>

    <?php echo HTML::script("assets/global/plugins/highcharts/js/highcharts.js"); ?>

    <?php echo HTML::script("assets/global/plugins/highcharts/js/modules/exporting.js"); ?>






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
    <script>
        $(function () {
            $('#container').highcharts({
                title: {
                    text: 'Companies Registered (<?php echo e(trans('core.'.$monthName)); ?>)',
                    x: -20 //center
                },
                xAxis: {
                    categories: [
                        '<?php echo e(trans('core.'.$monthName)); ?>'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Companies'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'No. of Companies',
                    data: <?php echo json_encode($graph_data); ?>

                }]
            });
        });
    </script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(document).ready(
            initChart([<?php echo $earning; ?> ], new Date().getFullYear())
        );

        function initChart(earning, year) {

            $('#earningChart').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: '<?php echo e(trans('core.yearlyEarningReport')); ?> ' + year
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
                        text: '<?php echo e(trans('core.earning')); ?> (<?php echo e($currency_symbol); ?>)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} <?php echo e($currency_symbol); ?></b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                return Highcharts.numberFormat(this.y, 2);
                            }
                        },
                    }

                },
                series: [{
                    name: '<?php echo e($currency_symbol); ?> <?php echo e(trans('core.earning')); ?>',
                    data: earning

                }]
            });
        }

        $('#filterYear').select2().on("select2:select", function (e) {

            var year = $('#filterYear').val();
            var url = "<?php echo e(route('admin.earning.report',':year')); ?>";
            url = url.replace(':year', year);
            $.ajax({
                type: "get",
                url: url,
                dataType: 'json',
                data: {"year": $('#filterYear').val()},

                beforeSend: function () {
                    $("#earningChart").html('<div style="margin-left:48%"><?php echo HTML::image('assets/loader.gif'); ?></div>');
                },
                success: function (response) {
                    if (response.success == "success") {
                        $("#earningChart").html('');

                        var array = response.earningReport.split(',');
                        array.forEach(function (item, i) {
                            if (item == "''") {
                                array[i] = '';
                            } else {
                                array[i] = parseFloat(item)
                            }
                        });
                        console.log(array);
                        initChart(array, year);
                    }
                }

            });
        });
        <?php if(\Froiden\Envato\Functions\EnvatoUpdate::showReview()): ?>
            $('#reviewModal').modal('show');

            function hideReviewModal(type){
                var url = "<?php echo e(route('hide-review-modal',':type')); ?>";
                url = url.replace(':type', type);

                $.easyAjax({
                    url: url,
                    type: "GET",
                    container: "#reviewModal",
                });
            }
        <?php endif; ?>
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/dashboard/dashboard_superadmin.blade.php ENDPATH**/ ?>