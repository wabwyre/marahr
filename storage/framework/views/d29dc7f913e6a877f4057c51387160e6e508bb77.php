<?php $__env->startSection('head'); ?>


    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php echo HTML::style("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"); ?>

    <!-- END PAGE LEVEL STYLES -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('mainarea'); ?>


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                <?php echo e($pageTitle); ?>

            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">

            <span class="active">Companies</span>

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
                
                
                
                
                
                
                


                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row ">
                            <div class="col-md-6">

                                <a class="btn green" href="<?php echo e(route('admin.companies.create')); ?>">
                                    <?php echo e(trans('core.btnAddCompany')); ?>

                                    <i class="fa fa-plus"></i> </a>
                            </div>
                            
                                
                                    
                                        
                                               
                                        
                                            
                                                    
                                          
                                    
                                
                            
                        </div>
                    </div>


                    <table class="table table-striped table-bordered table-hover" id="company">
                        <thead>
                        <tr>
                            <th> <?php echo e(trans('core.id')); ?> </th>
                            <th> Logo</th>
                            <th> Company</th>
                            <?php if(module_enabled('Subdomain')): ?>
                                <th>  Subdomains</th>

                            <?php else: ?>
                                <th> # Login</th>
                            <?php endif; ?>
                            <th> Package</th>
                            <th> <?php echo e(trans('core.createdOn')); ?> </th>
                            <th> <?php echo e(trans('core.status')); ?></th>

                            <th class="text-center"> <?php echo e(trans('core.action')); ?> </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->

        </div>
    </div>
    <!-- END PAGE CONTENT-->

    
    <?php echo $__env->make('admin.common.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    


    
    <div id="blockModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo e(trans('core.confirmation')); ?></h4>
                </div>
                <div class="modal-body" id="blockinfo">
                    <p>
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline"><?php echo e(trans('core.btnCancel')); ?></button>
                    <button type="button" data-dismiss="modal" class="btn red"
                            id="success"> <?php echo e(trans('core.btnSubmit')); ?></button>
                </div>
            </div>
        </div>
    </div>

    

    
    <div class="modal fade bs-modal-md in" id="packageUpdateModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <form class="ajax-form" id="update-company-form">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading">Change Package</span>
                    </div>
                    <div class="modal-body">
                        Loading...
                    </div>
                    <div class="modal-footer">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><i
                                        class="fa fa-check"></i>Update</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- .row -->
<?php $__env->stopSection(); ?>



<?php $__env->startSection('footerjs'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php echo HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/datatables.min.js"); ?>

    <?php echo HTML::script("assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"); ?>


    <!-- END PAGE LEVEL PLUGINS -->

    <script>

        onlyNum('numOnly');
        var modal = $('#packageUpdateModal');

        var table = $('#company').dataTable({
            <?php echo $datatabble_lang; ?>

            processing: true,
            serverSide: true,
            "ajax": {
                "url": "<?php echo e(URL::route("admin.ajax_admin_company")); ?>",
                "data": function (d) {
                    d.days = $('input[name=days]').val();
                }
            },
            autoWidth: false,
            "order": [[0, "desc"]],
            "columns": [
                {'data': 'id', name: 'companies.id', "bSortable": true, "width": "5%"},
                {'data': 'logo', name: 'logo', "bSortable": false, "width": "10%"},
                {'data': 'company_name', name: 'company_name', "bSortable": true, "width": "15%"},
                {'data': 'number_of_logins', name: 'number_of_logins', "bSortable": true},
                {'data': 'plan_name', name: 'subscription_plans.plan_name', "bSortable": true, "width": "15%"},
                {'data': 'created_at', name: 'companies.created_at', "bSortable": true},
                {'data': 'status', name: 'companies.status', "bSortable": true},

                {'data': 'edit', name: 'edit', "bSortable": false}

            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            "sPaginationType": "full_numbers",

            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                if (aData['8'] == 1) {
                    row.css({"background-color": "rgba(240, 235, 64, 0.41)"});
                }

                row.attr("id", 'row' + aData['0']);
            }

        });

        function del(id) {

            $('#deleteModal').modal('show');
            $("#deleteModal").find('#info').html('<?php echo e(__('messages.deleteConfirmCompany')); ?> ?');
            $('#deleteModal').find("#delete").off().click(function () {
                var url = "<?php echo e(route('admin.companies.destroy',':id')); ?>";
                url = url.replace(':id', id);
                var token = "<?php echo e(csrf_token()); ?>";
                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });
            })

        }

        function blockUnblock(id, status, company) {
            var msg;
            if (status == "active") {
                msg = 'Are you sure you want to <span class="label label-danger">Disable</span> the <b>' + company + '</b>';
            } else {
                msg = 'Are you sure you want to <span class="label label-success">Enable</span> the <b>' + company + '</b>';
            }
            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);
            $('#blockModal').find("#success").off().click(function () {
                var url = "<?php echo e(route('admin.companies.change_status',':id')); ?>";
                url = url.replace(':id', id);

                $.easyAjax({
                    type: 'POST',
                    url: url,
                    data: {"id": id, 'status': status},
                    container: "#blockModal",
                    success: function (response) {
                        if (response.status === "success") {
                            $('#deleteModal').modal('hide');
                            table.fnDraw();
                        }
                    }
                });

            })

        }

        $('body').on('click', '.package-update-button', function () {
            const url = '<?php echo e(route('admin.companies.edit-package.get', ':companyId')); ?>' . replace(':companyId', $(this).data(
                'company-id'
            ));
            $.easyAjax({
                type: 'GET',
                url: url,
                blockUI: false,
                messagePosition: "inline",
                success: function (response) {
                    if (response.status === "success" && response.data) {
                        modal.find('.modal-body').html(response.data).closest('#packageUpdateModal').modal('show');

                    } else {
                        modal.find('.modal-body').html('Loading...').closest('#packageUpdateModal').modal('show');
                    }
                }
            });
        });

        modal.on('bs-modal-hide', function () {
            modal.find('.modal-body').html('Loading...');
        });

        <?php if(module_enabled('Subdomain')): ?>
        $('body').on('click', '.domain-params', function(){

            var company_id = $(this).data('company-id');
            var company_url = $(this).data('company-url');

            var msg = `You want to notify company admins about company Login URL <br> Company URL: <a href="//${company_url}"><b>${company_url}</b></a>`;

            $('#blockModal').appendTo("body").modal('show');
            $('#blockinfo').html(msg);

            $('#blockModal').find("#success").off().click(function () {
                var token = "<?php echo e(csrf_token()); ?>";

                $.easyAjax({
                    type: 'POST',
                    url: "<?php echo e(route('notify.domain')); ?>",
                    data: {'_token': token, 'company_id': company_id},
                    success: function (response) {
                        if (response.status === "success") {
                            $.unblockUI();
                            table._fnDraw();
                        }
                    }
                });

            })
        });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.adminlayouts.adminlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/hr/resources/views/admin/companies/index.blade.php ENDPATH**/ ?>