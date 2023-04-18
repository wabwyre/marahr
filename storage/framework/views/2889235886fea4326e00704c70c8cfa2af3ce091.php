<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
    <tr>
        <td style="background-color:#FFFFFF;padding:10px; text-align: center">
            <img src="<?php echo e($setting['logo_image_url']); ?>" height="50px">
        </td>
    </tr>
    <tr>
        <td style="padding: 30px 100px 10px 50px">
            <?php echo $__env->yieldContent('email_content'); ?>

            <b> <?php echo e(config('app.name')); ?></b><br/>
            <font size="1">
                <a href="<?php echo e(config('app.url')); ?>"><?php echo e(config('app.url')); ?></a>
                <br/>
            </font>
        </td>
    </tr>
</table>
<?php /**PATH /var/www/html/hr/resources/views/mail/layout.blade.php ENDPATH**/ ?>