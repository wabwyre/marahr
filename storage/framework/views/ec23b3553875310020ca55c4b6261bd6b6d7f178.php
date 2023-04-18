<?php $__env->startSection('head'); ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <?php echo HTML::style("assets/global/plugins/bootstrap-summernote/summernote.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head"><div class="page-title"><h1>
        <?php echo e($pageTitle); ?>

    </h1></div></div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                                          <a onclick="loadView('<?php echo e(route('admin.dashboard.index')); ?>')"><?php echo e(trans('core.home')); ?></a>
                     <i class="fa fa-circle"></i>
                 </li>
            <li>
                <span class="active">Contact Requests</span>

            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->

    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                

                

            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-envelope font-dark"></i> Contact Request
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body">


                    <table class="table table-striped table-bordered table-hover" id="emails">
                        <thead>
                        <tr>
                            <th> Sr No. </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Category </th>
                            <th> Details </th>
                            <th> created at </th>
                            <th> status </th>

                            <th class="text-center"> <?php echo e(trans('core.action')); ?> </th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contactDef; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row->id); ?></td>
                                <td><?php echo e($row->name); ?></td>
                                <td><?php echo e($row->email); ?></td>
                                <td><?php echo e($row->category); ?></td>
                                <td><?php echo e($row->details); ?></td>
                                <td><?php echo e(date('d-M-Y', strtotime($row->created_at))); ?></td>
                                <td>
                                    <?php ($color = ['Pending' => 'warning', 'Completed' => 'success']); ?>
                                    <span id='status<?php echo e($row->id); ?>' class='label label-<?php echo e($color[$row->status]); ?>'><?php echo e($row->status); ?></span>
                                </td>
                                <td>
                                    <?php if($row->status == 'Completed'): ?>
                                        <a data-container="body" data-placement="top" data-original-title="Pending" href="javascript:;" onclick="changeStatus('<?php echo e($row->id); ?>','Pending');return false;" class="btn yellow btn-sm tooltips"><i class="fa fa-close"></i> Pending</a>
                                    <?php elseif($row->status == 'Pending'): ?>
                                        <a  data-container="body" data-placement="top" data-original-title="Completed" href="javascript:;" onclick="changeStatus('<?php echo e($row->id); ?> ','Completed');return false;" class="btn green btn-sm tooltips"><i class="fa fa-check"></i> Completed</a>
                                    <?php endif; ?>
                                        <a  class="blue-ebonyclay btn btn-sm "  href="javascript:;" onclick="showView(<?php echo e($row->id); ?>);return false;" ><i class="fa fa-eye"></i> <?php echo e(trans('core.btnView')); ?></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->


<div id="ContactModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><?php echo e($pageTitle); ?></h4>
            </div>
            <div class="modal-body" id="contact_info">
                
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline"><?php echo e(trans('core.btnCancel')); ?></button>

            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/select2/js/select2.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>

    <?php echo HTML::script("assets/global/plugins/bootstrap-summernote/summernote.min.js"); ?>

    <script>
        $('#body').summernote({height: 300});
    </script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script>


      var table =   $('#emails').dataTable( {
            <?php echo $datatabble_lang; ?>

            processing: true,
          serverSide: true,
            "ajax": "<?php echo e(URL::route("admin.ajax_contact_requests")); ?>",
            "deferLoading":'<?php echo e($total); ?>',
          "aaSorting": [[ 0, "desc" ]],
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'category', name: 'category' },
                { data: 'details', name: 'details' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' },
                { data: 'edit', name: 'edit', "bSortable": false  }
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "sPaginationType": "full_numbers",
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {

            },
          "fnInitComplete": function(oSettings, json) {

              App.init();


          }

        });



      function showView(id){
          $('#ContactModal').appendTo("body").modal('show');
          var get_url = "<?php echo e(route('admin.contact_requests.show',':id')); ?>";
          get_url = get_url.replace(':id',id);

          $.ajax({
              type: 'GET',
              url: get_url,

              data: {'id':id},
              success: function(response) {
                  $('#contact_info').html(response);
                  $('#body').summernote({height: 300});
              },
              error: function(xhr, textStatus, thrownError) {

              }
          });
      }
      function changeStatus(id,status){
          $.ajax({
              type: 'POST',
              url: "<?php echo e(route('admin.contact_requests.change_status')); ?>",
              dataType: "JSON",
              data: { 'status':status,'id':id},
              success: function(response) {
                  table._fnDraw();
                  showToastrMessage(status, '<?php echo e(__('messages.statusChanged')); ?>', 'success');

              },
              error: function(xhr, textStatus, thrownError) {

              }
          });
      }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/contact_requests/index.blade.php ENDPATH**/ ?>