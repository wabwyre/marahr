<?php $__env->startSection('head'); ?>

    <style>

        @media  print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title no-print">
            <h1>
                Show Payroll Variations
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
                    <?php if(isset($reports)): ?>
                    <li>
                        <a href="<?php echo e(url('admin/downloadVariations').'/'.$m.'/'.$y); ?>"><i class="fa fa-print"></i> Download To Excel
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<br>
    <div class="portlet light bordered no-print">
        <div class="portlet-body">
            <div class="table-toolbar">
                <form method="post" action="<?php echo e(url('admin/payrollVariations')); ?>">
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
                            <div class="form-group">
                                <label>Department</label>
                                <select name="department_id" class="form-control select2" required>
                                    <option value="all">All Departments</option>
                                    <?php if($departments): ?>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($dep->id); ?>"><?php echo e($dep->name); ?></option>
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
    <!-- <?php if(isset($reports)): ?> -->
    <div class="portlet light">
        <div class="portlet-body">
            <?php echo $__env->make('admin.reports.payroll-view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <!-- <?php endif; ?> -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");
    $('.select2me').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: false
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/reports/payroll.blade.php ENDPATH**/ ?>