<?php $__env->startSection("email_content"); ?>
    <?php echo $body; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make("mail.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/emails/email_template.blade.php ENDPATH**/ ?>