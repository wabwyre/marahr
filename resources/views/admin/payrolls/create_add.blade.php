<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->

    {{--INLCUDE ERROR MESSAGE BOX--}}
    <div id="error"></div>
    {{--END ERROR MESSAGE BOX--}}

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                @lang("core.salaryInfo")
            </div>
        </div>
        <div class="portlet-body">

            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.hourlyRate")</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="hourly_rate" name="hourly_rate"
                           placeholder="@lang("core.hourlyRate")" value="{{ $hourly_rate }}" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.hoursClocked")</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="overtime_hours" name="overtime_hours"
                           placeholder="@lang("core.hoursClocked")" value="0">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.totalHoursPayment") ({{$loggedAdmin->company->currency_symbol}})
                </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="overtime_pay" name="overtime_pay"
                           placeholder="overtime_pay" value="0">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.basicSalary") ({{$loggedAdmin->company->currency_symbol}}) </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="basic" name="basic" placeholder="@lang("core.basicSalary") "
                           value="{{$basicSalary}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.expenseClaim") ({{$loggedAdmin->company->currency_symbol}}) </label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control only-num" id="expense_claim" name="expense"
                           placeholder="@lang("core.expenseClaim")" value="{{$expense}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.status")</label>

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
{{--Allowances--}}
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                @lang("core.allowances")
            </div>
        </div>
        <div class="portlet-body">
            <div class="form-group">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") 1"
                           value="@lang("core.bonus")">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="@lang("core.value")" name="allowance[]"
                           value="{{$awardBonus}}">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>
            </div>
           {{-- <div class="form-group" id="allowance0">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]"value="House Allowance" readonly placeholder="@lang("core.allowance") 2" >
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" id="h-allowance" class="allowance form-control" placeholder="@lang("core.value")" readonly value="0" name="allowance[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

                <div class="col-md-2">
                    <button type="button" onclick="$('#allowance1').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>--}}
<!--            <div class="form-group" id="allowance1">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" value="Tax Relief" readonly placeholder="@lang("core.allowance") 2" >
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="@lang("core.value")" readonly value="2400" name="allowance[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

                <div class="col-md-2">
                    <button type="button" onclick="$('#allowance1').remove();" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>-->
            <div class="form-group" id="allowance2">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") 3">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="@lang("core.value")" name="allowance[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

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
{{--Allowances End--}}
{{--Deductions--}}
<div class="col-md-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                @lang("core.deductions")
            </div>
        </div>
        <div class="portlet-body">
            <div class="form-group">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" placeholder="@lang("core.deduction") 1" name="deductionTitle[]">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="deduction form-control" placeholder="@lang("core.value")" name="deduction[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>
            </div>
            <div class="form-group" id="nhif-div">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" readonly class="form-control" placeholder="NHIF" name="deductionTitle[]" value="NHIF">
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" readonly class="deduction form-control" placeholder="@lang("core.value")" id="nhif-value" name="deduction[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

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
                    <input type="text" readonly class="deduction form-control" id="nssf-value" placeholder="@lang("core.value")" name="deduction[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

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
                    <input type="text" class="deduction form-control" readonly id="paye-value" placeholder="@lang("core.value")" name="deduction[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

                <div class="col-md-2">
                    <button type="button" onclick="removeDivs($('#paye-div'));" class="btn red btn-sm delete">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
<!--            <div class="form-group" id="deduction1">
                <label class="control-label col-md-2"></label>

                <div class="col-md-4 margin-bottom-10">
                    <input type="text" class="form-control" name="deductionTitle[]" value="Tax Relief" readonly placeholder="@lang("core.deduction") 2" >
                </div>
                <div class="col-md-3  margin-bottom-10">
                    <input type="text" class="allowance form-control" placeholder="@lang("core.value")" readonly value="2400" name="deduction[]">
                </div>
                <label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label>

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
{{--Deductions End--}}
{{--Gross--}}
<div class="col-md-12">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                @lang("core.grossSalary")
            </div>
        </div>
        <div class="portlet-body">


            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.totalAllowances") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_allowance" name="total_allowance"
                           placeholder="@lang("core.total")" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.totalDeductions") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="total_deduction" name="total_deduction"
                           placeholder="@lang("core.total")" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("Nhif Relief") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="nhif_relief" name="nhif_relief"
                           placeholder="@lang("core.value")" value="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">@lang("core.netSalary") ({{$loggedAdmin->company->currency_symbol}})</label>

                <div class="col-md-7 margin-bottom-10">
                    <input type="text" class="form-control" id="net_salary" name="net_salary" placeholder="@lang("core.total")"
                           value="0" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Gross End--}}
<div class="col-md-12 text-center">
    <div class="portlet light bordered">
        <div class="portlet-body">
            <button type="button" class="btn green" onclick="submitData();return false;">@lang("core.btnSubmit")</button>
        </div>

    </div>
</div>
