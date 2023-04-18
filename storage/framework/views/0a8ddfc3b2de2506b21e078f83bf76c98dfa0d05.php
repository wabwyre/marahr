<!-- Screenlock -->
<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Screen Lock</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <?php echo HTML::style("https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all", array("name" => "core")); ?>

    <?php echo HTML::style('front_assets/plugins/bootstrap/css/bootstrap.min.css'); ?>

    <?php echo HTML::style('front_assets/css/style.css?v=1'); ?>

    <?php echo HTML::style('front_assets/plugins/line-icons/line-icons.css'); ?>

    <?php echo HTML::style('front_assets/plugins/font-awesome/css/font-awesome.min.css'); ?>

    <?php echo HTML::style('assets/global/plugins/bootstrap-toastr/toastr.min.css'); ?>

    <?php echo HTML::style('assets/global/plugins/froiden-helper/helper.css'); ?>

    <?php echo HTML::style('front_assets/css/pages/page_log_reg_v2.css'); ?>

    <?php echo HTML::style("front_assets/css/theme-colors/default.css"); ?>

    <?php echo HTML::style('front_assets/css/custom.css'); ?>

</head>
<!-- BEGIN BODY -->
<body class="login">
<div class="container">
    <div class="reg-block">
        <div class="reg-block-header text-center">
            <img src="<?php echo e($setting->logo_image_url); ?>" height="50px">
        </div>
        <h2 class="text-center"><?php echo e($loggedAdmin->name); ?></h2>
        <h5 class="email text-center">
            <?php echo e($loggedAdmin->email); ?> </h5>
        <h5 class="locked text-center"><strong>Locked</strong></h5><br/>

        <?php echo Form::open(['url' => '','class' =>'form-inline ajax-form', 'id' => 'login_form']); ?>

        <div class="form-group margin-bottom-20" style="width: 100%">
            <div>
                <div class="input-group" style="width: 100%">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <input type="hidden" class="form-control" name="email" value="<?php echo e($loggedAdmin->email); ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn-u icn-only" onclick="login();return false;" id="submitbutton"
                                style="margin-left: 5px;"><i class="fa fa-arrow-circle-o-right"></i></button>
                    </span>
                </div>
            </div>
            <!-- /input-group --><hr>
            <div class="relogin text-center">
                <a href="<?php echo e(URL::to('admin/logout')); ?>">
                    Not <strong><?php echo e($loggedAdmin->name); ?></strong>?</a>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php echo HTML::script('front_assets/plugins/jquery/jquery.min.js'); ?>

<?php echo HTML::script('front_assets/plugins/jquery/jquery-migrate.min.js'); ?>

<?php echo HTML::script('front_assets/plugins/bootstrap/js/bootstrap.min.js'); ?>

<?php echo HTML::script('front_assets/plugins/back-to-top.js'); ?>

<?php echo HTML::script('front_assets/plugins/backstretch/jquery.backstretch.min.js'); ?>

<?php echo HTML::script('assets/global/plugins/jquery.blockui.min.js'); ?>

<?php echo HTML::script('assets/global/plugins/bootstrap-toastr/toastr.min.js'); ?>

<?php echo HTML::script('assets/global/plugins/froiden-helper/helper.js'); ?>


<script type="text/javascript">
    $.backstretch([
        "<?php echo e(URL::asset('front_assets/img/bg/1.jpg')); ?>"
    ], {
        fade: 1000,
        duration: 7000
    });
</script>

<!--[if lt IE 9]>
<?php echo HTML::script('front_assets/plugins/respond.js'); ?>

<?php echo HTML::script('front_assets/plugins/html5shiv.js'); ?>

<?php echo HTML::script('front_assets/js/plugins/placeholder-IE-fixes.js'); ?>

<![endif]-->

<script type="text/javascript">
    function login() {
        $.easyAjax({
            url: "<?php echo route('admin.login'); ?>",
            type: "POST",
            data: $("#login_form").serialize(),
            container: "#login_form",
            messagePosition: "inline"
        });
    }
</script>
</body>
</html>
<?php /**PATH /var/www/html/hr/resources/views/admin/screen_lock.blade.php ENDPATH**/ ?>