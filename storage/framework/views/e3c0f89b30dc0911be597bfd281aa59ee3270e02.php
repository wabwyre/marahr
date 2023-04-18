<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en" class="no-js">

<?php echo $__env->make('admin.include.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square <?php if(\Cookie::get("sidebar_closed") == "1"): ?> page-sidebar-closed <?php endif; ?>">
<?php if(isset($company) && is_null($company->subscription_plan_id) && $loggedAdmin->type !=='superadmin'): ?>
    <?php echo $__env->make('admin.include.plan-null-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('admin.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">

            <?php echo $__env->yieldContent('mainarea'); ?>

        </div>

    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->

<?php echo $__env->make('admin.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.include.footerjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.common.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
<!-- END BODY -->
</html>
<?php /**PATH /var/www/html/hr/resources/views/admin/adminlayouts/adminlayout.blade.php ENDPATH**/ ?>