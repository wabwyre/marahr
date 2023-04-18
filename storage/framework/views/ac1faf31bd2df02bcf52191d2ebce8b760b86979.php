
<div id="deleteModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?php echo e(trans('core.confirmation')); ?></h4>
            </div>
            <div class="modal-body" id="info">
                <p>
                    
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal"
                        class="btn dark btn-outline"><?php echo e(trans('core.btnCancel')); ?></button>
                <button type="button" data-dismiss="modal" class="btn red" id="delete"><i
                            class="fa fa-trash"></i> <?php echo e(trans('core.btnDelete')); ?></button>
            </div>
        </div>
    </div>
</div>


<?php /**PATH /var/www/html/hr/resources/views/admin/common/delete.blade.php ENDPATH**/ ?>