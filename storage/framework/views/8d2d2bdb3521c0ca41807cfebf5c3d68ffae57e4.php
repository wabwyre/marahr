<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    
    <div id="error"></div>
    

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-blue-steel">
                <?php echo app('translator')->get("core.editSalaryInfo"); ?>
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
                           placeholder="<?php echo app('translator')->get("core.hoursClocked"); ?>" value="<?php echo e($payrolls->overtime_hours); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalHoursPayment"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                           placeholder="overtime_pay" value="<?php echo e($payrolls->overtime_pay); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.basicSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10 only-num">
                    <input type="text" class="form-control" id="basic" name="basic" placeholder="<?php echo app('translator')->get("core.basicSalary"); ?>"
                           value="<?php echo e($payrolls->basic); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.expenseClaim"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                           placeholder="<?php echo app('translator')->get("core.expenseClaim"); ?>" value="<?php echo e($payrolls->expense); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.status"); ?> </label>

                <div class="col-md-7 margin-bottom-10">
                    <select class="form-control select2me" name="status">
                        <option value="paid" <?php if($payrolls->status == 'paid'): ?> selected <?php endif; ?>>Paid</option>
                        <option value="unpaid" <?php if($payrolls->status == 'unpaid'): ?> selected <?php endif; ?>>Unpaid</option>
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
            <div class="caption font-blue-steel">
                <?php echo app('translator')->get("core.editAllowances"); ?>
            </div>
        </div>
        <div class="portlet-body">
            <?php $i = 0; ?>
            <?php $__currentLoopData = json_decode($payrolls->allowances); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="form-group" id="allowance<?php echo e($i); ?>">
                    <label class="control-label col-md-2"></label>

                    <div class="col-md-4 margin-bottom-10">
                        <input type="text" class="form-control" name="allowanceTitle[]" placeholder="<?php echo app('translator')->get("core.allowance"); ?> <?php echo e($i + 1); ?>"
                               value="<?php echo e($index); ?>">
                    </div>
                    <div class="col-md-3  margin-bottom-10">
                        <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="allowance[]"
                               value="<?php echo e($value); ?>">
                    </div>
                    <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
                <?php if($i>0): ?>
                        <div class="col-md-2">
                            <button type="button" onclick="$('#allowance<?php echo e($i); ?>').remove();"
                                    class="btn red btn-sm delete">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php $i++; ?>
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
            <div class="caption font-blue-steel">
                <?php echo app('translator')->get("core.editDeductions"); ?>
            </div>
        </div>
        <div class="portlet-body">
            <?php $i = 0; ?>
            <?php $__currentLoopData = json_decode($payrolls->deductions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="form-group" id="deduction<?php echo e($i); ?>">
                    <label class="control-label col-md-2"></label>

                    <div class="col-md-4 margin-bottom-10">
                        <input type="text" class="form-control" name="deductionTitle[]" value="<?php echo e($index); ?>" placeholder="<?php echo app('translator')->get("core.deduction"); ?> <?php echo e($i + 1); ?>">
                    </div>
                    <div class="col-md-3  margin-bottom-10">
                        <input type="text" class="deduction form-control" name="deduction[]" value="<?php echo e($value); ?>" placeholder="<?php echo app('translator')->get("core.value"); ?>">
                    </div>
                    <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
                    <?php if($i>0): ?>
                        <div class="col-md-2">
                            <button type="button" onclick="$('#deduction<?php echo e($i); ?>').remove();"
                                    class="btn red btn-sm delete">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php $i++; ?>
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
            <div class="caption font-blue-steel">
                <?php echo app('translator')->get("core.grossSalary"); ?>
            </div>
        </div>
        <div class="portlet-body">


            <div class="form-group">
                <label class="control-label col-md-2"><?php echo app('translator')->get("core.totalAllowances"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-8 margin-bottom-10">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="<?php echo e($payrolls->total_allowance); ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2"><?php echo app('translator')->get("core.totalDeductions"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-8 margin-bottom-10">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="<?php echo e($payrolls->total_deduction); ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2"><?php echo app('translator')->get("core.netSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-8 margin-bottom-10">
                    <input type="text" class="form-control" id="net_salary" name="net_salary" placeholder="<?php echo app('translator')->get("core.total"); ?>"
                           value="<?php echo e($payrolls->net_salary); ?>" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center margin-bottom-30">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn green"
                    onclick="submitData();return false;"><?php echo app('translator')->get("core.btnSubmit"); ?></button>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/create_edit.blade.php ENDPATH**/ ?>