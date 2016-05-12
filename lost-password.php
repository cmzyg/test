<?php
$no_session = TRUE;
require_once('core/connect.php');
require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
require_once('core/admin.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);
$admin      = new Admin($db);

$admin->sendPasswordResetInstructions();

?>
<!DOCTYPE html>
	<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" lang="en-US">
	<![endif]-->
	<!--[if !(IE 8) ]><!-->
		<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
	<!--<![endif]-->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Password Reset</title>
	<link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.3' type='text/css' media='all' />
    <link rel='stylesheet' id='dashicons-css'  href='assets/css/dashicons.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wp-admin-css'  href='assets/css/admin.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='buttons-css'  href='assets/css/buttons.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='colors-fresh-css'  href='assets/css/colors.min.css?ver=3.8.3' type='text/css' media='all' />
    <!--[if lte IE 7]>
    <link rel='stylesheet' id='ie-css'  href='assets/css/ie.min.css' type='text/css' media='all' />
    <![endif]-->
    <style type="text/css">
           body.login { background: #f4f4f4; margin: 15px 0px; padding-bottom: 50px; }
           h1 a { background: url("") no-repeat top center !important; width: 100% !important;}
    </style>
    <meta name="robots" content="noindex,nofollow" /><meta name='robots' content='noindex,follow' />
	</head>

	<body class="login login-action-login wp-core-ui">
	<div id="login">
		<h3 style="text-align:center">Reset instructions sent!</h3>
		<h4 style="text-align:center">Please check your admin email for instructions.</h4>
	





<script type="text/javascript">
function wp_attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

wp_attempt_focus();
if(typeof wpOnload=='function')wpOnload();
</script>


	
	</div>

	
	
	<div class="clear"></div>
	</body>
	</html>
	