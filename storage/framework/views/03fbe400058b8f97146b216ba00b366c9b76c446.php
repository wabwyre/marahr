<?php $__env->startSection('head'); ?>

<style>

	@media  print
	{
		.no-print, .no-print *
		{
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
			<?php echo app('translator')->get("pages.payroll.showTitle"); ?>
		</h1>
	</div>
	<div class="page-toolbar no-print">
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-fit-height red-sunglo dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
				<?php echo app('translator')->get("core.actions"); ?> <i class="fa fa-angle-down"></i>
			</button>
			<ul class="dropdown-menu pull-right" role="menu">
				<li>
					<a href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i> <?php echo app('translator')->get("core.print"); ?></a>
				</li>
				<li>
					<a   href="<?php echo e(route('admin.payrolls.edit',$payroll->id)); ?>" ><i class="fa fa-edit"></i> <?php echo app('translator')->get('core.edit'); ?></a>
				</li>

				<li class="divider">
				</li>
				<li>
					<a   href="<?php echo e(route('admin.payrolls.downloadpdf',$payroll->id)); ?>" ><i class="fa fa-download"></i> <?php echo app('translator')->get('core.btnDownload'); ?> PDF</a>
				</li>
			</ul>
		</div>
	</div>
</div>
			<div class="page-bar">
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo app('translator')->get("core.dashboard"); ?></a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<a class="no-print" href="<?php echo e(route('admin.payrolls.index')); ?>"><?php echo app('translator')->get("pages.payroll.indexTitle"); ?></a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<span class="active"><?php echo app('translator')->get("pages.payroll.showTitle"); ?></span>
					</li>
				</ul>


			</div>

<div class="portlet light">
	<div class="portlet-body">
<?php echo $__env->make('admin.payrolls.pdfview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/payrolls/show_pdf.blade.php ENDPATH**/ ?>