<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    
    <div id="error"></div>
    

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
                           placeholder="<?php echo app('translator')->get("core.hourlyRate"); ?>" value="<?php echo e($hourly_rate); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.hoursClocked"); ?></label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="overtime_hours" name="overtime_hours"
                           placeholder="<?php echo app('translator')->get("core.hoursClocked"); ?>" value="0">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalHoursPayment"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)
                </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                           placeholder="overtime_pay" value="0">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.basicSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>) </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="basic" name="basic" placeholder="<?php echo app('translator')->get("core.basicSalary"); ?> "
                           value="<?php echo e($basicSalary); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.expenseClaim"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>) </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                           placeholder="<?php echo app('translator')->get("core.expenseClaim"); ?>" value="<?php echo e($expense); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.status"); ?></label>

                <div class="col-md-7 margin-bottom-10">
                    <select class="form-control select2me" name="status">
                            <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
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
                <?php echo app('translator')->get("core.allowances"); ?>
            </div>
        </div>
        <div class="portlet-body">
            <div class="form-group">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" placeholder="<?php echo app('translator')->get("core.allowance"); ?> 1"
                           value="<?php echo app('translator')->get("core.bonus"); ?>">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="allowance[]"
                           value="<?php echo e($awardBonus); ?>">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
            </div>
           
<!--            <div class="form-group" id="allowance1">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" value="Tax Relief" readonly placeholder="<?php echo app('translator')->get("core.allowance"); ?> 2" >
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" readonly value="2400" name="allowance[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="$('#allowance1').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>-->
            <div class="form-group" id="allowance2">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" placeholder="<?php echo app('translator')->get("core.allowance"); ?> 3">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="allowance[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="$('#allowance2').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
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
                <?php echo app('translator')->get("core.deductions"); ?>
            </div>
        </div>
        <div class="portlet-body">
            <div class="form-group">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" placeholder="<?php echo app('translator')->get("core.deduction"); ?> 1" name="deductionTitle[]">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="deduction form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="deduction[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>
            </div>
            <div class="form-group" id="nhif-div">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" readonly class="form-control" placeholder="NHIF" name="deductionTitle[]" value="NHIF">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" readonly class="deduction form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" id="nhif-value" name="deduction[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="removeDivs($('#nhif-div'));" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>

            <div class="form-group" id="nssf-div">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text"  class="form-control" placeholder="NSSF"  value="NSSF" readonly name="deductionTitle[]">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" readonly class="deduction form-control" id="nssf-value" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="deduction[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="removeDivs($('#nssf-div'));" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>

            <div class="form-group" id="paye-div">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" value="PAYE" readonly placeholder="PAYE" name="deductionTitle[]">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="deduction form-control" readonly id="paye-value" placeholder="<?php echo app('translator')->get("core.value"); ?>" name="deduction[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="removeDivs($('#paye-div'));" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
<!--            <div class="form-group" id="deduction1">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="deductionTitle[]" value="Tax Relief" readonly placeholder="<?php echo app('translator')->get("core.deduction"); ?> 2" >
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="<?php echo app('translator')->get("core.value"); ?>" readonly value="2400" name="deduction[]">
                </div>
                <label class="control-label col-md-1"><?php echo e($loggedAdmin->company->currency); ?></label>

                <div class="col-md-2">
                    <button type="button" onclick="$('#deduction1').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>-->

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
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalAllowances"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.totalDeductions"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                           placeholder="<?php echo app('translator')->get("core.total"); ?>" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("Nhif Relief"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="nhif_relief" name="nhif_relief"
                           placeholder="<?php echo app('translator')->get("core.value"); ?>" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo app('translator')->get("core.netSalary"); ?> (<?php echo e($loggedAdmin->company->currency_symbol); ?>)</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="net_salary" name="net_salary" placeholder="<?php echo app('translator')->get("core.total"); ?>"
                           value="0" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn green" onclick="submitData();return false;"><?php echo app('translator')->get("core.btnSubmit"); ?></button>
        </div>

    </div>
</div>
<?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/create_add.blade.php ENDPATH**/ ?>