<?php
$page_label = 'settings';
require_once('core/connect.php');
require_once('includes/settings.php');

require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);

$database->select('SELECT * FROM payment_options');
$values = $database->fetch();
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar"  lang="en-US">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>Payment Options</title>

<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/fancybox.css' />
<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.3' type='text/css' media='all' />

<!--[if lte IE 7]>
<link rel='stylesheet' id='ie-css'  href='<?php echo $admin_url; ?>assets/css/ie.min.css' type='text/css' media='all' />
<![endif]-->

<script src='<?php echo $admin_url; ?>assets/js/jquery-1.11.1.min.js'></script>
<style>
.invisible
{
	visibility: hidden;
}

.percentage-icon
{ 
   background-image:url('../../assets/img/percentage.png');
   background-repeat:no-repeat;
   background-position:left top;  
   padding-left:15px;
}

.pound-icon
{ 
   background-image:url('../../assets/img/pound.png');
   background-repeat:no-repeat;
   background-position:left top;  
   padding-left:15px;
}

.clock-icon
{ 
   background-image:url('../../assets/img/clock.png');
   background-repeat:no-repeat;
   background-position:left top;  
   padding-left:15px;
}
</style>
</head>


<body class="wp-admin wp-core-ui no-js  jetpack-connected options-general-php auto-fold admin-bar branch-3-8 version-3-8-3 admin-color-fresh locale-en-us no-customize-support no-svg">
<script type="text/javascript">
	document.body.className = document.body.className.replace('no-js','js');
</script>

	
<div id="wpwrap">

<div id="adminmenuback"></div>

<?php include('includes/admin_navigation.php'); ?>

<div id="wpcontent">

<?php include('includes/admin_bar.php'); ?>
		
<div id="wpbody">

<div id="wpbody-content" aria-label="Main content" tabindex="0">



<div class="wrap">
<h2>Payment Options</h2>

<form method="post" action="<?php echo $admin_url; ?>process-payment-options">

<table class="form-table">


<?php echo $settings->flashdata('Success'); ?>



<tr valign="top">
<th scope="row"><label for="blogname">Payment Type Accepted</label></th>
<td><select name="pay_on_day"><option value='Cash' <?php if($values['pay_on_day'] == 'Cash') { echo "selected='selected'"; } ?>>Cash Payments Only</option><option value='Card' <?php if($values['pay_on_day'] == 'Card') { echo "selected='selected'"; } ?>>Card Payments Only</option><option value='Cash_and_card' <?php if($values['pay_on_day'] == 'Cash_and_card') { echo "selected='selected'"; } ?>>Cash &amp; Card Payments</option><select></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Fixed Booking Fee</label></th>
<td><input name="fixed_booking_fee" type="text" id="blogname" style="text-align: center; width:185px" value="<?php echo $values['fixed_booking_fee']; ?>" class="regular-text pound-icon" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Percentage Credit Card Fee</label></th>
<td><input name="percentage_credit_card_fee" type="text" id="blogname" style="text-align: center; width:185px;" value="<?php echo $values['percentage_credit_card_fee']; ?>" class="regular-text percentage-icon" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">PayPal Account (email)</label></th>
<td><input name="paypal_account" type="text" id="blogname" style="text-align: center; width:185px;" value="<?php echo $values['paypal_account']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">PayPal Status</label></th>
<td><select name="paypal_status"><option value='Live' <?php if($values['paypal_status'] == 'Live') { echo "selected='selected'"; } ?>>Live</option><option value='Test' <?php if($values['paypal_status'] == 'Test') { echo "selected='selected'"; } ?>>Test</option><select></td>
<td><span class="description">You can register your PayPal account at <a href="http://www.paypal.com" target="_blank">www.paypal.com</a><span></td>
</tr>

<!--<tr valign="top">
<th scope="row"><label for="blogname">"Stripe" Secret Key</label></th>
<td><input name="test_secret_key" type="text" id="blogname" style="text-align: center;" value="<?php echo $values['test_secret_key']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">"Stripe" Publishable Key</label></th>
<td><input name="test_publishable_key" type="text" id="blogname" style="text-align: center;" value="<?php echo $values['test_publishable_key']; ?>" class="regular-text" /></td>
</tr>-->

<!--<div id="description">In order to activate online payments please visit stripe.com, create a new account (free), and fill out relevant forms, such as the statement descriptor and your banking information. You will be provided with publishable key and secret key.</div>-->


</table>


<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</div>


<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
		<span id="footer-thankyou"></span>	</p>

	<div class="clear"></div>
</div>
	<div id="wp-auth-check-wrap" class="hidden">
	<div id="wp-auth-check-bg"></div>
	<div id="wp-auth-check">
	<div class="wp-auth-check-close" tabindex="0" title="Close"></div>
			<div id="wp-auth-check-form" data-src="http://sexdirectoryuk.com/wp-login.php?interim-login=1"></div>
			<div class="wp-auth-fallback">
		<p><b class="wp-auth-fallback-expired" tabindex="0">Session expired</b></p>
		<p><a href="http://sexdirectoryuk.com/wp-login.php" target="_blank">Please log in again.</a>
		The login page will open in a new window. After logging in you can close it and return to this page.</p>
	</div>
	</div>
	</div>
	<link rel='stylesheet' id='wpcom-notes-admin-bar-css'  href='http://s0.wp.com/wp-content/mu-plugins/notes/admin-bar-v2.css?ver=2.9.3-201417' type='text/css' media='all' />
<link rel='stylesheet' id='noticons-css'  href='http://s0.wp.com/i/noticons/noticons.css?ver=2.9.3-201417' type='text/css' media='all' />

<script type='text/javascript' src='http://sexdirectoryuk.com/wp-admin/load-scripts.php?c=1&amp;load%5B%5D=hoverIntent,common,admin-bar,svg-painter,heartbeat,wp-auth-check,underscore,backbone&amp;ver=3.8.3'></script>
<script type='text/javascript' src='http://s0.wp.com/wp-content/js/devicepx-jetpack.js?ver=201417'></script>
<script type='text/javascript' src='http://s1.wp.com/wp-content/js/mustache.js?ver=2.9.3-201417'></script>


<div class="clear"></div></div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>
