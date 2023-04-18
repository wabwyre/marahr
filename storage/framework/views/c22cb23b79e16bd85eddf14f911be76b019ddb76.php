<li class="nav-item start <?php echo e(isset($superadmindashboardActive) ? $superadmindashboardActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(URL::route('superadmin.dashboard.index')); ?>')">
        <i class="fa fa-home"></i>
        <span class="title"><?php echo e(__('menu.dashboard')); ?></span>
        <span class="selected"></span>
    </a>
</li>


<li class="nav-item <?php echo e(isset($companyActive) ? $companyActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.companies.index')); ?>')">
        <i class="fa fa-th-large"></i>
        <span class="title">Companies</span>
        <span class="selected "></span>
    </a>
</li>


<li class="nav-item <?php echo e(isset($contactRequestActive) ? $contactRequestActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.contact_requests.index')); ?>')">
        <i class="fa fa-envelope"></i>
        Contact Requests</a>
</li>


<li class="nav-item <?php echo e(isset($licenseTypesActive) ? $licenseTypesActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.plans.index')); ?>')">
        <i class="fa fa-paper-plane"></i>
        Subscription Plans</a>
</li>

<li class="nav-item <?php echo e(isset($invoicesActive) ? $invoicesActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.invoices.index')); ?>')">
        <i class="fa fa-file"></i>
        Invoices</a>
</li>

<li class="nav-item <?php echo e(isset($superAdminUserActive) ? $superAdminUserActive : ''); ?>">
    <a class="nav-link"
       href="javascript: loadView('<?php echo e(route('admin.superadmin_users.index')); ?>')">
        <i class="fa fa-user"></i>
        SuperAdmins</a>
</li>
<li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($faqCategoryActive) ? $faqCategoryActive : ''); ?>">
    <a href="javascript:;">
        <i class="icon-user"></i> CMS
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">

        <li class="nav-item <?php echo e(isset($faqCategoryActive) ? $faqCategoryActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.faq_categories.index')); ?>')">
                <i class="fa fa-file-text"></i>
                FAQ Category</a>
        </li>

        <li class="nav-item <?php echo e(isset($faqActive) ? $faqActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.faq.index')); ?>')">
                <i class="fa fa-support"></i>
                FAQ</a>
        </li>


        <li class="nav-item <?php echo e(isset($featureActive) ? $featureActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.features.index')); ?>')">
                <i class="fa fa-briefcase"></i>
                Features</a>
        </li>

    </ul>
</li>

<li class="menu-dropdown classic-menu-dropdown <?php echo e(isset($settingActive) ? $settingActive : ''); ?>">
    <a href="javascript:;">
        <i class="fa fa-cog"></i> Settings
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-left">

        <li class="nav-item <?php echo e(isset($generalSettingActive) ? $generalSettingActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.settings.edit','setting')); ?>')">
                <i class="fa  fa-cog"></i>
                <?php echo e(__('menu.generalSetting')); ?></a>
        </li>

        <li class="nav-item <?php echo e(isset($emailTemplateActive) ? $emailTemplateActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.email_templates.index')); ?>')">
                <i class="icon-envelope"></i>
                <?php echo e(__('menu.emailTemplate')); ?></a>
        </li>

        <li class="nav-item <?php echo e(isset($stripeSettingActive) ? $stripeSettingActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.stripe_settings')); ?>')">
                <i class="fa fa-cc-stripe"></i>
                <?php echo e(__('menu.paymentSetting')); ?></a>
        </li>
        <?php if(env('APP_ENV') !=='demo'): ?>
            <li class="nav-item">
                <a class="nav-link"
                   href="<?php echo e(action('\Barryvdh\TranslationManager\Controller@getIndex')); ?>">
                    <i class="fa fa-language"></i>
                    <?php echo e(__('menu.translationManager')); ?></a>
            </li>
        <?php endif; ?>
        <?php if($setting->system_update == 1): ?>
        <li class="nav-item">
            <a class="nav-link"
               href="javascript:;" onclick="loadView('<?php echo e(route('admin.updateVersion.index')); ?>')">
                <i class="fa fa-refresh"></i>
                <?php echo e(__('menu.updateLog')); ?></a>
        </li>
        <?php endif; ?>
        <li class="nav-item <?php echo e(isset($smtpSettingActive) ? $smtpSettingActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.smtp_settings')); ?>')">
                <i class="icon-envelope"></i>
                <?php echo e(__('menu.smtpSetting')); ?></a>
        </li>

        <li class="nav-item <?php echo e(isset($gdprSettingActive) ? $gdprSettingActive : ''); ?>">
            <a class="nav-link"
               href="javascript: loadView('<?php echo e(route('admin.custom-modules.index')); ?>')">
                <i class="fa fa-suitcase"></i>
                <?php echo e(__('menu.customModule')); ?></a>
        </li>

    </ul>
</li>
<?php /**PATH /var/www/html/hr/resources/views/admin/include/superadmin_menu.blade.php ENDPATH**/ ?>