<script type="text/javascript">
    $(document).ready(function (){
        var object = <?php echo $errors->toJson(); ?>;
        showErrors(object);
    });
</script><?php /**PATH /var/www/html/hr/resources/views/admin/common/error.blade.php ENDPATH**/ ?>