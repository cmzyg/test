<?php
require_once('lib/connect.php');
require_once('lib/database.class.php');
require_once('lib/session.class.php');
$database = new Database($db);
$session  = new Session;  
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
	<title>Admin Control Panel</title>
    <link rel='stylesheet' id='wp-admin-css'  href='assets/css/admin.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='buttons-css'  href='assets/css/buttons.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='colors-fresh-css'  href='assets/css/colors.min.css?ver=3.8.3' type='text/css' media='all' />
    <link rel='stylesheet' id='dashicons-css'  href='assets/css/login.css' type='text/css' media='all' />
    <style>
    .img-circled {
    	border-radius: 50%;
    	width: 100%;
    	margin: 0 auto;
	}

	.img-full {
		width: 100%;
		margin: 0 auto;
	}
	</style>
    <!--[if lte IE 7]>
    <link rel='stylesheet' id='ie-css'  href='assets/css/ie.min.css' type='text/css' media='all' />
    <![endif]-->

	</head>
	<body class="login login-action-login wp-core-ui">
	<div id="login" ng-controller="languages">


		<div class="incorrect-login"><?php if(isset($_SESSION['error'])) { echo 'Incorrect login details'; unset($_SESSION['error']); } ?></div>
		
		<p><img src="assets/img/meethelocalslogo.jpg" class="img-full" /></p>
		<form name="loginform" id="loginform" action="process-login" method="post">
			<p>
				<label for="user_login">Username<br />
				<input type="text" name="user_login" id="user_login" class="input" value="" size="20" ng-model="name" /></label>
			</p>
			
			<p>
				<label for="user_pass">Password<br />
				<input type="password" name="user_pass" id="user_pass" class="input" value="" size="20" /></label>
			</p>
				
			<p class="submit">
				<input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Log In" />
			</p>
		</form>



	</div>	

	</body>
	</html>
	