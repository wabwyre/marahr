<head>
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
</head>
<body>
<table class="logo">
    <tr>
        <td>

        </td>
        <td><p style="text-align: center;">
                <?php echo HTML::image($company->logo_image_url,'Logo',['class'=>'logo-default','height'=>'40px']); ?>

                
            </p>

            <p style="text-align: center;">
                    
                <b><?php echo e($company->company_name); ?></b><br/>
                <?php echo e($company->address); ?><br/>
                <?php echo e($company->billing_address); ?><br/>
                <b>Contact</b>: <?php echo e($company->contact); ?><br/>
                <?php echo e($company->email); ?><br/>
                <b>Company Pin</b>: <?php echo e($company->pin); ?>


            </p>
        </td>
    </tr>
</table>
<table class="payment_details">
    <thead>
    <tr>
        <th>#</th>
        <th>Employee ID</th>
        <th>Employee Name</th>


        <th>Month/Year</th>
        <th class="text-right">Basic Pay</th>
        <th class="text-right">Expense Claim</th>
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
        <th class="text-right">Net Pay</th>
    </tr>
    </thead>
    <?php if(count($reports)): ?>
        <?php
            $totalAdditions = [];
            $totalDeductions = [];
            $count= 1;
        ?>
        <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php
                $totalAdditions[] = json_decode($report->allowances);
                $totalDeductions[] = json_decode($report->deductions);
            ?>
            <tr>
                <td><?php echo e($count); ?></td>
                <td><?php echo e($report->employee->employeeID); ?></td>
                <td><?php echo e($report->employee->full_name); ?></td>
                <td><?php echo e($report->month); ?>/<?php echo e($report->year); ?></td>
                <td class="text-right"><?php echo e(number_format($report->basic,2)); ?></td>
                <td class="text-right"><?php echo e(number_format($report->expense)); ?></td>
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
                <td class="text-right"><?php echo e(number_format($report->net_salary,2)); ?></td>

            </tr>
            <?php $count++ ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <td>Totals</td>
                <td class="text-right bold"><?php echo e(number_format($reports->sum('basic'),2)); ?></td>
                <td class="text-right bold"><?php echo e(number_format($reports->sum('expense'),2)); ?></td>
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
                <td class="text-right bold"><?php echo e(number_format($reports->sum('total_allowance'),2)); ?></td>
                <td class="text-right bold"><?php echo e(number_format($reports->sum('total_deduction'),2)); ?></td>
                <td class="text-right bold"><?php echo e(number_format($reports->sum('net_salary'),2)); ?></td>
            </tr>
    <?php endif; ?>

</table>

</body>




<?php /**PATH /var/www/html/hr/resources/views/admin/reports/summary-view.blade.php ENDPATH**/ ?>