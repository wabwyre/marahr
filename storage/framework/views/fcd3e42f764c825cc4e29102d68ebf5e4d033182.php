<?php $__env->startSection('head'); ?>

    <style>

        @media  print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
    <style type="text/css">

        @media  print {
            body {
                -webkit-print-color-adjust: exact;
            }

            table.details tr th {
                background-color: #F2F2F2 !important;
            }

            .print_bg {
                background-color: #F2F2F2 !important;
            }

        }

        .print_bg {
            background-color: #F2F2F2 !important;
        }

        body {
            font-family: "Open Sans", helvetica, sans-serif;
            font-size: 13px;
            color: #000000;
        }

        table.logo {
            -webkit-print-color-adjust: exact;
            border-collapse: inherit;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 2px solid #25221F;

        }

        table.emp {
            width: 100%;
            margin-bottom: 10px;
            padding: 40px;
        }

        table.details, table.payment_details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table.payment_total {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        table.emp tr td {
            width: 30%;
            padding: 10px
        }

        table.details tr th {
            border: 1px solid #000000;
            background-color: #F2F2F2;
            font-size: 15px;
            padding: 10px
        }

        table.details tr td {
            vertical-align: top;
            width: 30%;
            padding: 3px
        }

        table.payment_details > tbody > tr > td {
            border: 1px solid #000000;
            padding: 5px;
        }

        table.payment_total > tbody > tr > td {
            padding: 5px;
            width: 60%
        }

        table.logo > tbody > tr > td {
            border: 1px solid transparent;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title no-print">
            <h1>
                Make Payment(s)
            </h1>
        </div>
        <div class="page-toolbar no-print">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-fit-height red-sunglo dropdown-toggle" data-toggle="dropdown"
                        data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <?php echo app('translator')->get("core.actions"); ?> <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo app('translator')->get("core.print"); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<br>
<br>
    <div class="portlet light bordered no-print">
        <div class="portlet-body">
            <div class="table-toolbar">
                <form method="post" action="<?php echo e(url('admin/makePayments')); ?>">
                    <?php echo csrf_field(); ?>
                <div class="row ">
                    <div class="col-md-2 col-md-offset-3">
                        <div class="form-group">
                            <label>Month</label>
                            <select name="month" class="form-control" required>
                                <?php if($months): ?>
                                    <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($month); ?>"><?php echo e(\Carbon\Carbon::parse('2020/'.(strlen($month == 1)? '0'.$month : $month).'/01')->format('M')); ?></option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Year</label>
                            <select name="year" class="form-control" required>
                                <?php if($years): ?>
                                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($month); ?>"><?php echo e($month); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 27px">Search
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <?php if(isset($status)): ?>
    <div class="portlet light">
        <div class="portlet-body">
            <div class="alert alert-success">
                <strong>Success!</strong> Payments Submitted for processing
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(isset($payrolls)): ?>
    <div class="portlet light">
        <div class="portlet-body">
            <table class="logo">
                <tr>
                    <td>

                    </td>
                    <td><p style="text-align: right;">
                            <?php echo HTML::image($company->logo_image_url,'Logo',['class'=>'logo-default','height'=>'40px']); ?>

                        </p>

                        <p style="text-align: right;">

                            <b><?php echo e($company->company_name); ?></b><br/>
                            <?php echo e($company->address); ?><br/>
                            <b>Contact</b>: <?php echo e($company->contact); ?>

                            <?php echo e($company->email); ?>


                        </p>
                    </td>
                </tr>
            </table>
            <form method="post" id="selectedPaymentsform" action="<?php echo e(url('admin/paySelectedPayrolls')); ?>">
                <?php echo csrf_field(); ?>
                <table class="payment_details">
                    <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Month/Year</th>
                        <th class="text-right">Basic Pay</th>
                        <th class="text-right">Payment Amount</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Select All <input type="checkbox" id="select-all"> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($payrolls)): ?>
                        <?php
                            $totalAdditions = [];
                            $totalDeductions = [];
                        ?>
                        <?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $totalAdditions[] = json_decode($report->allowances);
                                $totalDeductions[] = json_decode($report->deductions);
                            ?>
                            <tr>
                                <td><?php echo e($report->employee->full_name); ?></td>
                                <td><?php echo e($report->month); ?>/<?php echo e($report->year); ?></td>
                                <td class="text-right"><?php echo e(number_format($report->basic,2)); ?></td>
                                <td class="text-right"><?php echo e(number_format($report->net_salary,2)); ?></td>
                                <td class="text-center">
                                    <?php if($report->status == 'paid'): ?> <label class="label label-success">Paid</label><?php else: ?> <label class="label label-danger">Un paid</label><?php endif; ?>
                                </td>
                                <td class="text-center"><?php if($report->status != 'paid'): ?> <input type="checkbox" class="selectable" name="selected[]" value="<?php echo e($report->id); ?>"><?php else: ?> <label class="label label-success">Paid</label> <?php endif; ?> </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th></th>
                            <td>Totals</td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('basic'),2)); ?></td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('net_salary'),2)); ?></td>
                            <th></th>
                        </tr>
                    <?php endif; ?>
                    </tbody>


                </table>
                <br>
                <br>
                <div class="form-group">
                    <button class="btn btn-success pull-right">Pay Selected</button>
                </div>
                <br>
                <br>
            </form>

        </div>
    </div>
    <?php endif; ?>

    <div id="submitModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Submit Payments</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-offset-6">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                    <div class="col-md-offset-5" ><span style="margin: 17px">Processing</span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");
    $('.select2me').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: false
    });

    $('#select-all').on('change',function(){
        let s =$(this).parent('span').attr('class')
        if(s === 'checked'){
            $('.selectable').each(function (index,element) {
                if($(element).parent('span').attr('class') !== 'checked'){
                    $(element).trigger('click')
                }
            });
        }else{
            $('.selectable').each(function (index,element) {
                if($(element).parent('span').attr('class') === 'checked'){
                    $(element).trigger('click')
                }
            });
        }

    });

    $(document).ready(function (){
        $('#selectedPaymentsform').on('submit',function (e){
            e.preventDefault();
            $('#submitModal').modal()
            let data = $('#selectedPaymentsform').serializeArray()
            for (let i = 0; i < data.length; i++) {
                console.log(data[i].name)
                if(data[i].name !== '_token'){
                    $.ajax({
                        url: '<?php echo e(url('admin/paySelectedPayrolls')); ?>'+'/'+data[i].value,
                        dataType: 'json',
                        type: "GET",
                        success: function(data){

                        }
                    })
                }
            }
        })
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/make-payments.blade.php ENDPATH**/ ?>