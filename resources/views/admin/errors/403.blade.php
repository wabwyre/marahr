<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title> HRM - Permission Denied </title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	{!!HTML::style("assets/global/plugins/font-awesome/css/font-awesome.min.css")!!}
	{!!HTML::style("assets/global/plugins/simple-line-icons/simple-line-icons.min.css")!!}
	{!!HTML::style("assets/global/plugins/bootstrap/css/bootstrap.min.css")!!}
	{!!HTML::style("assets/global/plugins/uniform/css/uniform.default.css")!!}
	{!!HTML::style("assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css")!!}

	{!!HTML::style("assets/global/css/components.css")!!}
	{!!HTML::style("assets/global/css/plugins.css")!!}
	{!!HTML::style("assets/admin/layout/css/layout.css?v=1")!!}
	{!!HTML::style("assets/admin/layout/css/themes/default.css")!!}
	{!!HTML::style("assets/admin/layout/css/custom.css")!!}
	{!!HTML::style("assets/admin/pages/css/error.css")!!}


</head>
<!-- END HEAD -->

<body class="page-404-3">

<div class="container error-404 text-center" style="text-align: center">
	<h1>403</h1>
	<p>
		Access to this page has been disabled because license of this account has been suspended. Please pay any undue bills if any to restore access.
	</p>
	<p>
		<a href="{!!route('admin.billing.index')!!}">
			Return Billing </a>
		<br>
	</p>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>

{!! HTML::script("assets/global/plugins/respond.min.js") !!}
{!! HTML::script("assets/global/plugins/excanvas.min.js") !!}

<![endif]-->
{!! HTML::script("assets/global/plugins/jquery.min.js") !!}
{!! HTML::script("assets/global/plugins/jquery-ui/jquery-ui.min.js") !!}
{!! HTML::script("assets/global/plugins/bootstrap/js/bootstrap.min.js") !!}
{!! HTML::script("assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js") !!}
{!! HTML::script("assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js") !!}


{!! HTML::script("assets/global/scripts/metronic.js")!!}
{!! HTML::script("assets/admin/layout/scripts/layout.js?v=1")!!}


		<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core componets
		Layout.init(); // init layout



</script>

@yield('footerjs')


		<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>