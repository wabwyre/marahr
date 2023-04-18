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
            margin-bottom: 5px;
            padding: 5px;
            border-bottom: 2px solid #25221F;

        }

        table.emp {
            width: 100%;
            margin-bottom: 10px;
            padding: 20px;
        }

        table.details, table.payment_details {
            width: 50%;
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
            width: 50%;
            padding: 3px
        }

        table.payment_details > tbody > tr > td {
            border: 1px solid #000000;
            padding: 5px;
            width: 50%;
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
<table class="logo" style="width: 50%">
    <tr >
        <td>

        </td>
        <td><p style="text-align: right;">
                <?php echo HTML::image($employee->company->logo_image_url,'Logo',['class'=>'logo-default','height'=>'40px']); ?>

            </p>

            <p style="text-align: right;">

                <b><?php echo e($employee->company->company_name); ?></b><br/>
                <?php echo e($employee->company->address); ?><br/>
                <b>Contact</b>: <?php echo e($employee->company->contact); ?>

                <?php echo e($employee->company->email); ?>


            </p>
        </td>
    </tr>
</table>
<table class="emp" style="width: 50%">
    <tbody>
    <tr>
        <td colspan="3" style="text-align: center; font-size: 18px;"><strong><?php echo app('translator')->get("core.payslip"); ?> <br>
                <?php echo app('translator')->get("core.salaryMonth"); ?>: <?php echo e(date('F', mktime(0, 0, 0, $payroll->month, 10))); ?>, <?php echo e($payroll->year); ?>

            </strong></td>
    </tr>
    <tr>
        <td><strong><?php echo app('translator')->get("core.employeeID"); ?>:</strong> <?php echo e($payroll->employee->employeeID); ?> </td>
        <td><strong><?php echo app('translator')->get("core.name"); ?>:</strong> <?php echo e($payroll->employee->full_name); ?></td>
        
    </tr>

    <tr>
        <td><strong><?php echo app('translator')->get("core.department"); ?>:</strong> <?php echo e($payroll->employee->getDesignation->department->name); ?></td>
        <td><strong><?php echo app('translator')->get("core.designation"); ?>:</strong> <?php echo e($payroll->employee->getDesignation->designation); ?></td>
        
    </tr>
    </tbody>
</table>


    <table class="payment_details" style="border: none">
        <tr>
            <th colspan="2">EARNINGS</th>
        </tr>

        <tr>
            <td style="width: 50%"><?php echo app('translator')->get("core.basic"); ?></td>
            <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($payroll->basic, 2)); ?></td>
        </tr>



        <?php if($payroll->overtime_pay > 0): ?>
            <tr>
                <td style="width: 50%"><?php echo app('translator')->get("core.hourlyPayment"); ?></td>

                <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($payroll->overtime_pay, 2)); ?> </td>
            </tr>
        <?php endif; ?>

        <?php if($payroll->expense > 0): ?>
            <tr>
                <td><?php echo app('translator')->get("core.expenseClaim"); ?></td>
                <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($payroll->expense, 2)); ?> </td>
            </tr>
        <?php endif; ?>
        <?php $__currentLoopData = json_decode($payroll->allowances); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <?php echo e($index); ?></td>

                <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($value, 2)); ?> </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="width: 50%">Gross Pay</td>
            <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($gp = $payroll->basic + $payroll->total_allowance + $payroll->expense, 2)); ?></td>
        </tr>
    </table>

    <table class="payment_details">
        <tr>
            <th colspan="2">DEDUCTIONS</th>
        </tr>
        <?php $__currentLoopData = json_decode($payroll->deductions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($index != 'PAYE'): ?>
            <tr>
                <td> <?php echo e($index); ?></td>

                <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($value, 2)); ?> </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>
    <?php
        $nf = $payroll->deductions;
        $nsf = json_decode($nf, true); 
        //var_dump($nsf);
        $nssf = $nsf["NSSF"];            
    ?>
    <table class="payment_details">
        <tr>
            <th colspan="2">TAX CALCULATION</th>
        </tr>
        <tr>
            <td>Defined Contribution</td>
         
            <td><?php echo e($employee->company->currency); ?> (<?php echo e($nssf); ?>) </td>
        </tr>

        <tr>
            <td>Taxable Pay</td>

            <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($gp - $nssf, 2)); ?></td>
        </tr>
        <?php $__currentLoopData = json_decode($payroll->deductions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($index == 'PAYE'): ?>
                <tr>
                    <td> Tax Charged</td>

                    <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($value, 2)); ?> </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <tr>
            <td>Tax Relief</td>

            <td> <?php echo e($employee->company->currency); ?> <?php echo e(($payroll->basic > 24000)? number_format(2400, 2): number_format(0,2)); ?></td>
        </tr>

        <tr>
            <td>Net Pay</td>

            <td> <?php echo e($employee->company->currency); ?> <?php echo e(number_format($payroll->net_salary,2)); ?></td>
        </tr>

    </table>

    <table class="payment_details">
        <tr>
            <th colspan="2">PERSONAL INFORMATION</th>
        </tr>
        <tr>
            <td>ID#</td> <td><?php echo e($employee->id_number); ?> </td>
        </tr>
        <tr>
            <td>PIN#</td> <td><?php echo e($employee->PIN); ?> </td>
        </tr>
        <tr>
            <td>NSSF#</td> <td><?php echo e($employee->NSSF); ?> </td>
        </tr>
        <tr>
            <td>NHIF#</td> <td><?php echo e($employee->NHIF); ?> </td>
        </tr>
    </table>
<!-- Table for Details -->
<hr>
<!-- TotalTotal -->

<!-- TotalTotal -->
</body>



<?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/pdfview.blade.php ENDPATH**/ ?>