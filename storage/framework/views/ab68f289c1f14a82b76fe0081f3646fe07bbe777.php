<?php $__env->startSection('head'); ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css"); ?>

    <!-- BEGIN THEME STYLES -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                <?php echo app('translator')->get("pages.payroll.editTitle"); ?>
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo app('translator')->get("core.dashboard"); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('<?php echo e(route('admin.payrolls.index')); ?>')"><?php echo app('translator')->get("pages.payroll.indexTitle"); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"><?php echo app('translator')->get("pages.payroll.editTitle"); ?></span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <?php echo Form::open(['class'=>'form-horizontal','method'=>'POST','id'=>'salary-form']); ?>

    <div class="row">
        
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            
            <div id="error"></div>
            

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <?php echo app('translator')->get('core.employeeInfo'); ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-md-9">


                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <?php echo HTML::image($payroll->employee->profile_image_url,'ProfileImage',['height'=>'100px']); ?>


                                    
                                    <input type="hidden" value="<?php echo e($payroll->employee->id); ?>" name="employee_id">
                                    <input type="hidden" value="<?php echo e($payroll->month); ?>" name="month">
                                    <input type="hidden" value="<?php echo e($payroll->year); ?>" name="year">
                                    

                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <ul>
                                        <li><h4><?php echo app('translator')->get("core.employeeID"); ?>: <?php echo e($payroll->employee->employeeID); ?></h4></li>
                                        <li><h4><?php echo app('translator')->get("core.name"); ?>: <?php echo e($payroll->employee->full_name); ?></h4></li>
                                        <li><h4><?php echo app('translator')->get("core.month"); ?>
                                                : <?php echo date("F", mktime(0, 0, 0, $payroll->month, 10)); ?></h4></li>
                                        <li><h4><?php echo app('translator')->get("core.year"); ?>: <?php echo e($payroll->year); ?></h4></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="col-md-9">

                                </div>

                            </div>
                        </div>

                        <!--/span-->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <?php echo app('translator')->get("core.salaryInfo"); ?>
                    </div>
                </div>
                <div class="portlet-body">

                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.hourlyRate"); ?></label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control only-num" id="hourly_rate" name="hourly_rate"
                                   placeholder="<?php echo app('translator')->get("core.hourlyRate"); ?>" value="<?php echo e($hourly_rate); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.hoursClocked"); ?></label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control only-num" id="overtime_hours" name="overtime_hours"
                                   placeholder="<?php echo app('translator')->get("core.hoursClocked"); ?>" value="<?php echo e($payroll->overtime_hours); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalHoursPayment"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                                   placeholder="overtime_pay" value="<?php echo e($payroll->overtime_pay); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.basicSalary"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control only-num" id="basic" name="basic"
                                   placeholder="<?php echo app('translator')->get("core.basicSalary"); ?>" value="<?php echo e($payroll->basic); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.expenseClaim"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                                   placeholder="<?php echo app('translator')->get("core.expenseClaim"); ?>" value="<?php echo e($payroll->expense); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.status"); ?></label>

                        <div class="col-md-7 margin-bottom-10">
                            <select class="form-control select2me" name="status">
                                <option value="paid" <?php if($payroll->status == 'paid'): ?> selected <?php endif; ?>>Paid</option>
                                <option value="unpaid" <?php if($payroll->status == 'unpaid'): ?> selected <?php endif; ?>>Unpaid</option>
                            </select>
                        </div>
                    </div>
                    <!--/span-->
                </div>

            </div>
        </div>
        
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <?php echo app('translator')->get("core.editAllowances"); ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php echo '';$i=0;; ?>

                    <?php $__currentLoopData = json_decode($payroll->allowances); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group" id="allowance<?php echo e($i); ?>">
                            <label class="control-label col-md-2"></label>
                            <div class="col-md-4 margin-bottom-10">
                                <input type="text" class="form-control" name="allowanceTitle[]" value="<?php echo e($index); ?>"
                                       placeholder="<?php echo app('translator')->get("core.allowance"); ?> <?php echo e($i + 1); ?>">
                            </div>
                            <div class="col-md-3  margin-bottom-10">
                                <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>"
                                       name="allowance[]" value="<?php echo e($value); ?>">
                            </div>
                            <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
                            <?php if($i>0): ?>
                                <div class="col-md-2">
                                    <button type="button" onclick="$('#allowance<?php echo e($i); ?>').remove();calculation();"
                                            class="btn red btn-sm delete">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php echo '';$i++;; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    <div id="insertBeforeA"></div>
                    <div class="form-group">
                        <div class="col-md-12  margin-bottom-10 text-center">
                            <button type="button" id="plusButtonA" class="btn btn-sm green form-control-inline">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        
        
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <?php echo app('translator')->get("core.editDeductions"); ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php echo '';$i=0;; ?>

                    <?php $__currentLoopData = json_decode($payroll->deductions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="form-group" id="deduction<?php echo e($i); ?>">
                            <label class="control-label col-md-2"></label>
                            <div class="col-md-4 margin-bottom-10">
                                <input type="text" class="form-control" name="deductionTitle[]" value="<?php echo e($index); ?>"
                                       placeholder="<?php echo app('translator')->get("core.deduction"); ?> <?php echo e($i + 1); ?>">
                            </div>
                            <div class="col-md-3  margin-bottom-10">
                                <input type="text" class="deduction form-control" name="deduction[]" value="<?php echo e($value); ?>"
                                       placeholder="<?php echo app('translator')->get("core.value"); ?>">
                            </div>
                            <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
                            <?php if($i>0): ?>
                                <div class="col-md-2">
                                    <button type="button" onclick="$('#deduction<?php echo e($i); ?>').remove();calculation();"
                                            class="btn red btn-sm delete">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php echo '';$i++;; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    <div id="insertBeforeD"></div>
                    <div class="form-group">
                        <div class="col-md-12  margin-bottom-10 text-center">
                            <button type="button" id="plusButtonD" class="btn btn-sm green form-control-inline">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <?php echo app('translator')->get("core.grossSalary"); ?>
                    </div>
                </div>
                <div class="portlet-body">


                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalAllowances"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                                   placeholder="<?php echo app('translator')->get("core.total"); ?>" value="<?php echo e($payroll->total_allowance); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalDeductions"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                                   placeholder="<?php echo app('translator')->get("core.total"); ?>" value="<?php echo e($payroll->total_deduction); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo app('translator')->get("core.netSalary"); ?>
                            (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>
                        <div class="col-md-7 margin-bottom-10">
                            <input type="text" class="form-control" id="net_salary" name="net_salary"
                                   placeholder="<?php echo app('translator')->get("core.total"); ?>" value="<?php echo e(round($payroll->net_salary, 2)); ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 text-center">
            <div class="portlet light bordered">
                <div class="portlet-body">

                    <button type="button" class="btn green"
                            onclick="submitData();return false;"><?php echo app('translator')->get("core.btnSubmit"); ?></button>
                </div>
            </div>

        </div>


    </div>

    <?php echo Form::close(); ?>

    <!-- END FORM-->




    
    <div id="confirmBox" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo app('translator')->get("core.confirmation"); ?>"</h4>
                </div>
                <div class="modal-body" id="info">
                    <p>
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline"><?php echo app('translator')->get("core.cancel"); ?></button>
                    <button type="button" data-dismiss="modal" class="btn green" id="show"><i
                                class="fa fa-edit"></i> <?php echo app('translator')->get("core.modify"); ?></button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- END PAGE CONTENT-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"); ?>

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        onlyNum('only-num');
        var $insertBeforeA = $('#insertBeforeA');
        var i = $(".allowance").length;
        $('#plusButtonA').click(function () {
            i = $(".allowance").length;
            $('<div class="form-group" id="allowance' + i + '">' +
                '<div class="control-label col-md-2"></div>' +
                '<div class="col-md-4 margin-bottom-10">' +
                '<input type="text" class="form-control" name="allowanceTitle[]" placeholder="<?php echo app('translator')->get("core.allowance"); ?> ' + i + '">' +
                '</div>' +
                '<div class="col-md-3  margin-bottom-10">' +
                '<input type="text" class="allowance form-control" name="allowance[]" placeholder="<?php echo app('translator')->get("core.value"); ?>">' +
                '</div>' +
                '<label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label> ' +
                ' <div class="col-md-2"> <button type="button" onclick="$(\'#allowance' + i + '\').remove();" class="btn red btn-sm delete">' +
                '<i class="fa fa-close"></i>' +
                '</button></div>' +
                '</div>').insertBefore($insertBeforeA);
            onlyNum('allowance');

        });
        var $insertBeforeD = $('#insertBeforeD');
        var j = $(".deduction").length;
        $('#plusButtonD').click(function () {
            j = $(".deduction").length;
            $('<div class="form-group" id="deduction' + j + '">' +
                '<div class="control-label col-md-2"></div>' +
                '<div class="col-md-4 margin-bottom-10">' +
                '<input type="text" class="form-control" name="deductionTitle[]" placeholder="<?php echo app('translator')->get("core.deduction"); ?> ' + j + '">' +
                '</div>' +
                '<div class="col-md-3  margin-bottom-10">' +
                '<input type="text" class="deduction form-control" name="deduction[]" placeholder="<?php echo app('translator')->get("core.value"); ?>">' +
                '</div>' +
                '<label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label> ' +
                '<div class="col-md-2"> <button type="button" onclick="$(\'#deduction' + j + '\').remove();" class="btn red btn-sm delete">' +
                '<i class="fa fa-close"></i>' +
                '</button></div>' +
                '</div>').insertBefore($insertBeforeD);
            onlyNum('deduction');

        });
        onlyNum('allowance');
        onlyNum('deduction');

        function check() {
            $('#load').html();
            var employee_id = $('#employeeID').val();
            var month = $('#month').val();
            var year = $('#year').val();
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('admin.payrolls.check')); ?>",
                dataType: "JSON",
                data: {'employee_id': employee_id, 'month': month, 'year': year},
                success: function (response) {
                    if (response.success == 'fail') {
                        $('#load').html(response.content);
                    } else {
                        $('#confirmBox').appendTo("body").modal('show');
                        $("#deleteModal").find('#info').html('Salary Slip for the selected employee month and year already created.Do you want modify it?');
                        $("#show").click(function () {
                            $('#load').html(response.content);
                            $('#load').append('<input type="hidden" name="type" value="edit">');
                        })
                    }

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }

        function submitData() {
            $('#error').html('<div class="alert alert-info"><span class="fa fa-info"></span> Submitting..</div>');
            $.ajax({
                type: 'POST',
                url: "<?php echo e(route('admin.payrolls.store')); ?>",
                dataType: "JSON",
                data: $('#salary-form').serialize(),
                success: function (response) {
                    if (response.status == "error") {
                        $('#error').html('');
                        var arr = response.msg;
                        var alert = '';
                        $.each(arr, function (index, value) {
                            if (value.length != 0) {
                                alert += '<p><span class="fa fa-close"></span> ' + value + '</p>';
                            }
                        });

                        $('#error').append('<div class="alert alert-danger alert-dismissable"><button class="close" data-close="alert"></button> ' + alert + '</div>');
                        $("html, body").animate({scrollTop: 0}, "slow");
                    } else {
                        window.location.href = '<?php echo e(route('admin.payrolls.index')); ?>'
                    }

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }

        $(document).on("change keydown paste input", function () {
            calculation();
        });

        function calculation() {
            var allowance = 0.0;
            var hours = 0;
            var hourly_rate = 0.0;
            var deduc = 0.0;
            var basic = 0.0;
            var expense_claim = 0.0;
            var overtime = 0.0;
            basic = $("#basic").val();
            expense_claim = $("#expense_claim").val();

            hourly_rate = $("#hourly_rate").val();
            hours = $("#overtime_hours").val();

            $("#overtime_pay").val(hourly_rate * hours);

            overtime = $("#overtime_pay").val();

            $(".allowance").each(function () {
                if ($(this).val() !== "") {
                    allowance += parseFloat($(this).val());
                }
            });

            $(".deduction").each(function () {
                if ($(this).val() !== "") {
                    deduc += parseFloat($(this).val());
                }

            });

            $("#total_allowance").val(allowance.toFixed(2));
            $("#total_deduction").val(deduc.toFixed(2));

            net_salary = (allowance - deduc) + parseFloat(basic) + parseFloat(overtime) + parseFloat(expense_claim);
            $("#net_salary").val(net_salary.toFixed(2));

        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/edit.blade.php ENDPATH**/ ?>