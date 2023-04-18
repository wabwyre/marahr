<!-- BEGIN HEADER -->


<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="javascript:;">
                <?php if(admin()->type =='admin'): ?>
                    <img src="<?php echo e($loggedAdmin->company->logo_image_url); ?>" height="50px">
                <?php else: ?>
                    <img src="<?php echo e($setting->logo_image_url); ?>" height="50px">
                <?php endif; ?>

            </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END LOGO -->
        <div class="page-actions hidden-xs">
            <?php if($loggedAdmin->company && $displaySetup == true && !Route::is("admin.dashboard.index") && $loggedAdmin->company->license_expired != 1 && $loggedAdmin->type !=='superadmin'): ?>
                <div class="btn-group hidden-sm hidden-xs" style="margin-top: -5px;">
                    <a href="<?php echo e($nextStepLink); ?>" class="btn btn-sm dropdown-toggle btn-outline">
                        <span class=""><strong><?php echo app('translator')->get("core.nextStep"); ?></strong>: <?php echo e($nextStep); ?> <i
                                    class="fa fa-arrow-right"></i> </span>
                        <div class="progress progress-striped  margin-bottom-5" style="height: 5px">
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>" aria-valuemin="0"
                                 aria-valuemax="100"
                                 style="width: <?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>%;">
                                <span class="sr-only"> <?php echo e(round(($nextStepNumber - 1)/$totalSteps*100)); ?>

                                    % Complete </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php elseif($displaySetup != true): ?>
                <div class="btn-group">

                    <?php if(App::isDownForMaintenance()): ?>
                        <a href="#" class="btn red-intense btn-sm dropdown-toggle" style="margin-left: 10px">
                            <i class="fa fa-exclamation-circle"></i> Maintenance Mode
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- BEGIN TOP NAVIGATION MENU -->

        <div class="page-top">
            <div class="top-menu">

                <ul class="nav navbar-nav pull-right">
                    <?php if($loggedAdmin->company && $loggedAdmin->company->license_expired != 1): ?>
                        <?php if(isset($pending_applications)): ?>
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                   data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>

                                    <?php if(count($pending_applications)): ?>
                                        <span class="badge badge-default">
											<?php echo e(count($pending_applications)); ?>

                            </span>
                                    <?php endif; ?>

                                </a>


                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3><span class="bold"><?php echo e(count($pending_applications)); ?> pending</span>
                                            notifications</h3>

                                    </li>
                                    <?php if(count($pending_applications)): ?>
                                        <li>
                                            <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                                data-handle-color="#637283">
                                                <?php $__empty_1 = true; $__currentLoopData = $pending_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <li>
                                                        <a data-toggle="modal" href="#static_leave_requests"
                                                           onclick="show_application_notification(<?php echo e($pending->id); ?>);return false;">
                                                            <span class="time"><?php echo e(date('d-M-Y',strtotime($pending->created_at))); ?></span>
                                                            <span class="details">
                									<span class="label label-sm label-icon label-success">
                									<i class="fa fa-bell-o"></i>
                									</span>
                									 <strong><?php echo e($pending->employee->full_name); ?> </strong> has applied for leave for <?php if(!isset($pending->end_date)): ?>
                                                                    <?php echo e(date('d-M-Y',strtotime($pending->start_date))); ?>

                                                                <?php else: ?>
                                                                    <?php echo e(date('d-M-Y',strtotime($pending->start_date))); ?>

                                                                    to  <?php echo e(date('d-M-Y',strtotime($pending->end_date))); ?>

                                                                <?php endif; ?>
                                                    </span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <li>
                                                    </li>
                                                <?php endif; ?>


                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    

                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">


                                <span class="username hidden-sm hidden-xs">
                  <?php echo e($loggedAdmin->name); ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo e(route(admin()->type.'.profile_settings.edit')); ?>">
                                    <i class="icon-user"></i> <?php echo e(trans('menu.myProfile')); ?></a>
                            </li>

                            <li class="divider">
                            </li>
                            <li>
                                <a onclick="lockScreenModal()">
                                    <i class="icon-lock"></i> <?php echo e(trans('menu.lockScreen')); ?> </a>
                            </li>
                            <li>
                                <a href="<?php echo e(URL::route('admin.logout')); ?> " id="logout-form">
                                    <i class="icon-logout"></i> <?php echo e(trans('menu.logout')); ?> </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->

                </ul>
            </div>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
    <div class="page-header-menu">
        <div class="container-fluid">
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu ">
                <ul class="nav navbar-nav">
                    <?php if($loggedAdmin->type=='superadmin'): ?>
                        <?php echo $__env->make('admin.include.superadmin_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php endif; ?>
                    
                    <?php if(isset($loggedAdmin->company) && $loggedAdmin->type !=='superadmin'): ?>
                        <?php if($loggedAdmin->company->license_expired  == 0): ?>
                            
                            <li class="nav-item  <?php if($loggedAdmin->type=='admin'): ?>start <?php endif; ?> <?php echo e(isset($dashboardActive) ? $dashboardActive : ''); ?>">
                                <a class="nav-link" href="javascript: loadView('<?php echo e(URL::to('admin')); ?>')">
                                    <i class="icon-home"></i>
                                    <span class="title"><?php echo e(__('menu.dashboard')); ?></span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            

                            <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($peopleMenuActive) ? $peopleMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="icon-user"></i> <?php echo app('translator')->get('menu.people'); ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <?php if($loggedAdmin->manager!=1): ?>
                                        <li class=" <?php echo e(isset($departmentActive) ? $departmentActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.departments.index')); ?>')">
                                                <i class="fa fa-bookmark"></i>
                                                <?php echo e(__('menu.department')); ?></a>
                                        </li>
                                        
                                        
                                        
                                        
                                        
                                        
                                    <?php else: ?>
                                        <li class="nav-item <?php echo e(isset($departmentActive) ? $departmentActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.departments.index')); ?>')">
                                                <i class="fa fa-briefcase"></i>
                                                <span class="title"><?php echo e(__('menu.department')); ?></span>
                                                <span class="selected"></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>
                                    <li class="nav-item <?php echo e(isset($employeesActive) ? $employeesActive : ''); ?>">
                                        <a class="nav-link"
                                           href="javascript: loadView('<?php echo e(route('admin.employees.index')); ?>')">
                                            <i class="fa fa-user"></i>
                                            <span class="title"><?php echo e(__('menu.employees')); ?></span>
                                            <span class="selected"></span>

                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($hrMenuActive) ? $hrMenuActive : ''); ?>">
                                <a href="javascript:;">
                                    <i class="icon-briefcase"></i> HR
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    
                                    <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->award_feature==1): ?>
                                        <li class="nav-item <?php echo e(isset($awardsActive) ? $awardsActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.awards.index')); ?>')">
                                                <i class="fa fa-trophy"></i>
                                                <span class="title"><?php echo e(__('menu.award')); ?></span>
                                                <span class="selected"></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>
                                    


                                    <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->expense_feature==1): ?>
                                        
                                        <li class="nav-item <?php echo e(isset($expensesActive) ? $expensesActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.expenses.index')); ?>')">
                                                <i class="fa fa-money"></i>
                                                <span class="title"><?php echo e(__('menu.expense')); ?></span>
                                                <span class="selected"></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>
                                    

                                    <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->holidays_feature==1): ?>
                                        
                                        <li class="nav-item <?php echo e(isset($holidayActive) ? $holidayActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.holidays.index')); ?>')">
                                                <i class="fa fa-send"></i>
                                                <span class="title"><?php echo e(__('menu.holiday')); ?></span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->payroll_feature==1): ?>
                                        
                                        <li class="nav-item <?php echo e(isset($payrollActive) ? $payrollActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.payrolls.index')); ?>')">
                                                &nbsp; <?php echo e($loggedAdmin->company->currency_symbol); ?> &nbsp;
                                                <span class="title"><?php echo e(__('menu.payroll')); ?></span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                        <li class="nav-item <?php echo e(isset($approve) ? $approve : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(url('admin/approvePayroll')); ?>">
                                                &nbsp; <?php echo e($loggedAdmin->company->currency_symbol); ?> &nbsp;
                                                <span class="title">Approve Payroll(s)</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                        <li class="nav-item <?php echo e(isset($makePayment) ? $makePayment : ''); ?>">
                                            <a class="nav-link"
                                               href="<?php echo e(url('admin/makePayments')); ?>">
                                                &nbsp; <?php echo e($loggedAdmin->company->currency_symbol); ?> &nbsp;
                                                <span class="title">Make Payment(s)</span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>

                                    


                                    <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->notice_feature==1): ?>
                                        
                                        <li class="nav-item <?php echo e(isset($noticeBoardActive) ? $noticeBoardActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.noticeboards.index')); ?>')">
                                                <i class="fa fa-quote-left"></i>
                                                <span class="title"><?php echo e(__('menu.noticeBoard')); ?></span>
                                                <span class="selected "></span>
                                            </a>

                                        </li>
                                    <?php endif; ?>
                                    
                                </ul>
                            </li>

                            <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($reportActive) ? 'active' : ''); ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-search"></i>
                                    <span class="title">Reports</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item <?php echo e(isset($reportActive) ? $reportActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/payrollSummary')); ?>"><i class="fa  fa-check"></i>Payroll Summary</a>
                                    </li>
                                    <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/p9a')); ?>"><i class="fa  fa-check"></i>P9A</a>
                                    </li>
                                    <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/statutoryDeductions')); ?>"><i class="fa  fa-check"></i>Statutory Deductions</a>
                                    </li>
                                    <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/paymentShedule')); ?>"><i class="fa  fa-check"></i>Payments Shedule</a>
                                    </li>
                                    <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/employeeReport')); ?>"><i class="fa  fa-check"></i>Employees Report</a>
                                    </li>

                                    <li class="nav-item <?php echo e(isset($reportActive) ? $reportActive : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(url('admin/payrollVariations')); ?>"><i class="fa  fa-check"></i>Payroll Variations</a>
                                    </li>
                                </ul>
                            </li>

                            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->attendance_feature==1): ?>
                                
                                <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($attendanceOpen) ? $attendanceOpen : ''); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-users"></i>
                                        <span class="title"><?php echo e(__('menu.attendance')); ?></span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item <?php echo e(isset($markAttendanceActive) ? $markAttendanceActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.attendances.create')); ?>')">
                                                <i class="fa  fa-check"></i>
                                                <?php echo e(__('menu.markAttendance')); ?></a>
                                        </li>
                                        <li class="nav-item <?php echo e(isset($viewAttendanceActive) ? $viewAttendanceActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.attendances.index')); ?>')">
                                                <i class="fa fa-eye"></i>
                                                <?php echo e(__('menu.viewAttendance')); ?></a>
                                        </li>
                                        <?php if($loggedAdmin->manager!=1): ?>
                                            <li class="nav-item <?php echo e(isset($leaveTypeActive) ? $leaveTypeActive : ''); ?>">
                                                <a class="nav-link"
                                                   href="javascript: loadView('<?php echo e(route('admin.leavetypes.index')); ?>')">
                                                    <i class="fa fa-sitemap"></i>
                                                    <?php echo e(__('menu.leaveTypes')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->leave_feature==1): ?>
                                            
                                            <li class="nav-item <?php echo e(isset($leaveApplicationOpen) ? $leaveApplicationOpen : ''); ?>">
                                                <a class="nav-link"
                                                   href="javascript: loadView('<?php echo e(route('admin.leave_applications.index')); ?>')">
                                                    <i class="fa fa-rocket"></i>
                                                    <span class="title"><?php echo e(__('menu.leaveApplication')); ?></span>
                                                    <span class="selected "></span>
                                                </a>

                                            </li>
                                        <?php endif; ?>

                                        
                                    </ul>
                                </li>
                            <?php endif; ?>

                            




                            <?php if($loggedAdmin->type=='superadmin' || $loggedAdmin->company->jobs_feature==1): ?>
                                
                                <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($jobsOpen) ? $jobsOpen : ''); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-graduation"></i>
                                        <span class="title">Recruitment</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item <?php echo e(isset($jobsPostedActive) ? $jobsPostedActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.jobs.index')); ?>')">
                                                <i class="fa fa-ticket"></i>
                                                <?php echo e(__('menu.jobsPosted')); ?></a>
                                        </li>
                                        <li class="nav-item <?php echo e(isset($jobsApplicationActive) ? $jobsApplicationActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.job_applications.index')); ?>')">
                                                <i class="fa fa-file-text-o"></i>
                                                <?php echo e(__('menu.jobApplications')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            



                        <?php endif; ?>
                        
                        <li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($csettingOpen) ? $csettingOpen : ''); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title"><?php echo e(__('menu.settings')); ?></span>
                                <?php if($unpaid_invoices > 0): ?>
                                    <span class="badge badge-danger"><?php echo e($unpaid_invoices); ?></span>
                                <?php else: ?>
                                    <i class="fa fa-angle-down"></i>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu pull-left">

                                <?php if($loggedAdmin->manager!=1): ?>
                                    <li class="nav-item <?php echo e(isset($billingActive) ? $billingActive : ''); ?>">
                                        <a class="nav-link"
                                           href="javascript: loadView('<?php echo e(route('admin.billing.index')); ?>')">
                                            <i class="fa fa-dollar"></i>
                                            <?php echo e(__('menu.billing')); ?>

                                            <?php if($unpaid_invoices > 0): ?>
                                                <span class="badge badge-danger"><?php echo e($unpaid_invoices); ?></span>
                                            <?php endif; ?>
                                        </a>

                                    </li>
                                <?php endif; ?>
                                <?php if($loggedAdmin->company->license_expired == 0): ?>
                                    <?php if($loggedAdmin->type!='superadmin'): ?>
                                        <?php if($loggedAdmin->manager!=1): ?>
                                            <li class="nav-item <?php echo e(isset($csettingActive) ? $csettingActive : ''); ?>">
                                                <a class="nav-link"
                                                   href="javascript: loadView('<?php echo e(route('admin.general_setting.edit')); ?>')">
                                                    <i class="fa  fa-cog"></i>
                                                    <?php echo e(__('menu.generalSetting')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($loggedAdmin->type!='superadmin'): ?>
                                        <li class="nav-item <?php echo e(isset($profileSettingActive) ? $profileSettingActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.profile_settings.edit','profile')); ?>')">
                                                <i class="fa fa-user"></i>
                                                <?php echo e(__('menu.profileSetting')); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="nav-item <?php echo e(isset($notificationSettingActive) ? $notificationSettingActive : ''); ?>">
                                        <a class="nav-link"
                                           href="javascript: loadView('<?php echo e(route('admin.notification.edit')); ?>')">
                                            <i class="fa fa-bell"></i>
                                            <?php echo e(__('menu.notificationSetting')); ?></a>
                                    </li>

                                    <?php if($loggedAdmin->manager!=1): ?>
                                        <li class="nav-item <?php echo e(isset($cthemeSettingActive) ? $cthemeSettingActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.company_setting.theme')); ?>')">
                                                <i class="icon-diamond"></i>
                                                <?php echo e(__('menu.theme')); ?></a>
                                        </li>

                                        <li class="nav-item <?php echo e(isset($adminSettingActive) ? $adminSettingActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.attendance_settings.edit')); ?>')">
                                                <i class="fa fa-gears"></i>
                                                Attendance Settings</a>
                                        </li>

                                        <li class="nav-item <?php echo e(isset($adminUserActive) ? $adminUserActive : ''); ?>">
                                            <a class="nav-link"
                                               href="javascript: loadView('<?php echo e(route('admin.admin_users.index')); ?>')">
                                                <i class="icon-users"></i>
                                                <?php echo e(__('menu.adminUser')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ul>
                        </li>

                    <?php endif; ?>
                    
                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
</div>
<!-- END HEADER -->



<?php echo Form::open(['url'=>'','id'=>'edit_form_leave','method'=>'PATCH']); ?>

<div id="static_leave_requests" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase">Leave Application</span>
            </div>
            <div class="modal-body" id="load-data">
                
            </div>
        </div>

    </div>
</div>
<?php echo Form::close(); ?>



<div id="static_screen_lock" class="modal fade" tabindex="-1" style="z-index: 999999;" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-data-leave">
            <div class="modal-header">
                <center>
                    <div class="reg-block-header">
                        <h2><img src="<?php echo e($setting->logo_image_url); ?>" height="50px"></h2>
                    </div>
                </center>
                <h2 class="text-center"><?php echo e($loggedAdmin->name); ?></h2>
                <h5 class="email text-center">
                    <?php echo e($loggedAdmin->email); ?> </h5>
                <h5 class="locked text-center"><strong>Locked</strong></h5><br/>
            </div>
            <div class="modal-body" id="load-data">
                <?php echo Form::open(array('url' => '','class' =>'form')); ?>

                <div id='alert'></div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="input-group margin-bottom-20">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                       id="password">
                                <input type="hidden" class="form-control" name="email" value="<?php echo e($loggedAdmin->email); ?>">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn red" onclick="loginCheck();return false;"
                                            id="submitbutton" style="margin-left: 5px;"><i
                                                class="fa fa-arrow-circle-right"></i></button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="relogin text-center">
                                <a href="<?php echo e(URL::to('admin/logout')); ?>">
                                    Not <strong><?php echo e($loggedAdmin->name); ?></strong>? </a>
                            </div>
                        </div>
                    </div>


                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>

    </div>
</div>


<script>
    function show_application_notification(id) {
        $("#load-data").html('<div class="text-center"><?php echo HTML::image('assets/loader.gif'); ?></div>');
        $('#edit_form_leave').attr('action', "<?php echo URL::to('admin/leave_applications/"+id+"'); ?>");
        $.ajax({
            type: "GET",
            url: "<?php echo URL::to('admin/leave_applications/"+id+"'); ?>"

        }).done(function (response) {
            $('#modal-data-leave').html(response);
//
        });
    }

    function changeLanguage(lang) {
        $.ajax({
            type: 'GET',
            url: "<?php echo e(route('admin.change_language')); ?>",
            dataType: "JSON",
            data: {
                'locale': lang
            },
            success: function (response) {
                if (response.success === 'success') {
                    window.location.reload();
                }

            },
            error: function (xhr, textStatus, thrownError) {

            }
        });
    }

    function changeCompany(com_id) {
        $.ajax({
            type: 'GET',
            url: "<?php echo e(route('admin.change_company')); ?>",
            dataType: "JSON",
            data: {
                'company_id': com_id
            },
            success: function (response) {
                if (response.success === 'success') {
                    window.location.reload();
                }

            },
            error: function (xhr, textStatus, thrownError) {

            }
        });
    }
</script>
<?php /**PATH /var/www/html/hr/resources/views/admin/include/header.blade.php ENDPATH**/ ?>