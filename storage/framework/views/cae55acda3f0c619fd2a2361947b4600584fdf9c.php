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
                Approve Payroll(s)
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
                <form method="post" action="<?php echo e(url('admin/approvePayroll')); ?>">
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
            <form method="post" action="<?php echo e(url('admin/approveSelectedPayrolls')); ?>">
                <?php echo csrf_field(); ?>
                <table class="payment_details">
                    <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Month/Year</th>
                        <th class="text-right">Basic Pay</th>
                        <?php if(count($additions)): ?>
                            <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="text-right"><?php echo e($addition); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(count($deductions)): ?>
                            <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="text-right"> <?php echo e($deduction); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <th class="text-right">Total Additions</th>
                        <th class="text-right">Total Deductions</th>
                        <th class="text-right">Nhif Relief</th>
                        <th class="text-right">Net Pay</th>
                        <th class="text-center">Action</th>
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
                                <?php if(count($additions)): ?>
                                    <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $add = collect(json_decode($report->allowances))->get($addition) ?>
                                        <td class="text-right"><?php echo e(number_format($add,2) ?? '-'); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if(count($deductions)): ?>
                                    <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $dd = collect(json_decode($report->deductions))->get($deduction) ?>
                                        <td class="text-right"><?php echo e(number_format($dd,2)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <td class="text-right"><?php echo e(number_format($report->total_allowance,2)); ?></td>
                                <td class="text-right"><?php echo e(number_format($report->total_deduction,2)); ?></td>
                                <td class="text-right"><?php echo e(number_format($report->nhif_relief,2)); ?></td>
                                <td class="text-right"><?php echo e(number_format($report->net_salary,2)); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(url('admin/payrolls/'.$report->id)); ?>">view</a> |
                                    <a href="<?php echo e(url('admin/payrolls/'.$report->id.'/edit')); ?>">edit</a>
                                </td>
                                <td class="text-center"><?php if(!$report->is_approved): ?> <input type="checkbox" class="selectable" name="selected[]" value="<?php echo e($report->id); ?>"><?php else: ?> <label class="label label-success">Approved</label> <?php endif; ?> </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th></th>
                            <td>Totals</td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('basic'),2)); ?></td>
                            <?php if(count($additions)): ?>
                                <?php $__currentLoopData = $additions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $total = collect($totalAdditions)->sum($addition);
                                    ?>
                                    <td class="text-right bold"><?php echo e(number_format($total,2)); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(count($deductions)): ?>
                                <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $total = collect($totalDeductions)->sum($deduction);
                                    ?>
                                    <td class="text-right bold"><?php echo e(number_format($total,2)); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('total_allowance'),2)); ?></td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('total_deduction'),2)); ?></td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('nhif_relief'),2)); ?></td>
                            <td class="text-right bold"><?php echo e(number_format($payrolls->sum('net_salary'),2)); ?></td>
                            <th></th>
                        </tr>
                    <?php endif; ?>
                    </tbody>


                </table>
                <br>
                <br>
                <div class="form-group">
                    <button class="btn btn-success pull-right">Approve</button>
                </div>
                <br>
                <br>
            </form>

        </div>
    </div>
    <?php endif; ?>
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

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/approve.blade.php ENDPATH**/ ?>