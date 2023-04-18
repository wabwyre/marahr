<?php $__env->startSection('head'); ?>


    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/select2/css/select2.css"); ?>

    <?php echo HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css"); ?>

    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                <?php echo app('translator')->get("pages.payroll.indexTitle"); ?>
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active"><?php echo app('translator')->get("pages.payroll.indexTitle"); ?></span>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                

                

            </div>
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-2">
                                <a class="btn green" onclick="loadView('<?php echo e(route('admin.payrolls.create')); ?>')">
                                    <?php echo e(trans('core.btnAddPayroll')); ?>

                                    <i class="fa fa-plus"></i> </a>
                            </div>
                            <div class="col-md-2">
                                <a class="btn green" onclick="loadView('<?php echo e(url('multiple')); ?>')">
                                    Add Multiple Payrolls
                                    <i class="fa fa-plus"></i> </a>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control select2me" name="employee_id" id="employeeID">
                                    <option value="all"><?php echo app('translator')->get('core.selectEmployee'); ?></option>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->full_name); ?> (<?php echo app('translator')->get('core.empId'); ?>: <?php echo e($employee->employeeID); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <a href="" class="btn blue-chambray"
                                   onclick="showReportModal();return false;"><?php echo app('translator')->get("core.monthlyExcelReport"); ?> <i
                                            class="fa fa-download"></i> </a>
                            </div>
                            <div class="col-md-2 text-right">

                                <span id="load_notification"></span>
                                <input type="checkbox"
                                       onchange="ToggleEmailNotification('payroll_notification');return false;"
                                       class="make-switch" name="payroll_notification"
                                       <?php if($loggedAdmin->company->payroll_notification==1): ?>checked
                                       <?php endif; ?> data-on-color="success" data-on-text="<?php echo e(trans('core.btnYes')); ?>"
                                       data-off-text="<?php echo e(trans('core.btnNo')); ?>" data-off-color="danger">
                                <strong><?php echo e(trans('core.emailNotification')); ?></strong><br>


                            </div>
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="payroll">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> <?php echo e(trans('core.employeeID')); ?> </th>
                            <th> <?php echo e(trans('core.name')); ?> </th>
                            <th> <?php echo e(trans('core.month')); ?> - <?php echo e(trans('core.year')); ?> </th>
                            <th> <?php echo app('translator')->get("core.netSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</th>
                            <th> <?php echo e(trans('core.createdOn')); ?> </th>
                            <th> <?php echo e(trans('core.status')); ?> </th>
                            <th class="text-center" width="36%"> <?php echo e(trans('core.action')); ?> </th>
                        </tr>
                        </thead>

                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    

    <div id="reportModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo app('translator')->get("core.selectMonthAndYear"); ?></h4>
                </div>
                <?php echo Form::open(array('route'=>'admin.payroll_report','class'=>'form-horizontal','method'=>'POST','id'=>'salary-form')); ?>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <select class="form-control" name="month" id="month">
                                        <option value="1"
                                                <?php if(1 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.January')); ?></option>
                                        <option value="2"
                                                <?php if(2 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.February')); ?></option>
                                        <option value="3"
                                                <?php if(3 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.March')); ?></option>
                                        <option value="4"
                                                <?php if(4 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.April')); ?></option>
                                        <option value="5"
                                                <?php if(5 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.May')); ?></option>
                                        <option value="6"
                                                <?php if(6== date("n")): ?> selected="selected"<?php endif; ?> ><?php echo e(trans('core.june')); ?></option>
                                        <option value="7"
                                                <?php if(7 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.July')); ?></option>
                                        <option value="8"
                                                <?php if(8 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.August')); ?></option>
                                        <option value="9"
                                                <?php if(9 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.September')); ?></option>
                                        <option value="10"
                                                <?php if(10 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.October')); ?></option>
                                        <option value="11"
                                                <?php if(11 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.November')); ?></option>
                                        <option value="12"
                                                <?php if(12 == date("n")): ?> selected="selected"<?php endif; ?>><?php echo e(trans('core.December')); ?></option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <?php echo Form::selectYear('year', 2013, date('Y')+1,date('Y'),['class' => 'form-control','id'=>'year']); ?>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline"><?php echo e(trans('core.btnCancel')); ?></button>
                    <button type="submit" class="btn blue-chambray" id="report"><i
                                class="fa fa-download"></i> <?php echo app('translator')->get("core.download"); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>


    
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(function (e) {
           loadTable();

           $('#employeeID').on('change', function() {
               loadTable();
           })

        });

        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });



        function loadTable() {
            var employee_id = $('#employeeID').val();

            var table = $('#payroll').dataTable({
                <?php echo $datatabble_lang; ?>

                processing: true,
                serverSide: true,
                destroy: true,
                "ajax": "<?php echo route('admin.ajax_payrolls'); ?>?employee_id=" + employee_id,
                "autoWidth": false,
                "aaSorting": [[6, "desc"]],
                "columns": [
                    {data: 'id', name: 'payrolls.id', 'sortable': false},
                    {data: 'employeeID', name: 'employees.employeeID', searchable: false},
                    {data: 'full_name', name: 'full_name', searchable: true},
                    {data: 'year', name: 'year', searchable: true},
                    {data: 'net_salary', name: 'net_salary', searchable: false},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'actions', sortable: false, searchable: false}
                ],
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                "sPaginationType": "full_numbers"

            });
        }

        function showReportModal() {
            $('#reportModal').appendTo("body").modal('show');
        }


        function del(id, title) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('<?php echo app('translator')->get("messages.payrollDeleteConfirm"); ?>');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "<?php echo e(route('admin.payrolls.destroy',':id')); ?>";
                url = url.replace(':id', id);

                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            });


        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/index.blade.php ENDPATH**/ ?>