<?php
require_once('lib/connect.php');
require_once('core/settings.class.php');
require_once('lib/session.class.php');
$page_label = 'settings';

$session  = new Session($db);
$settings = new Settings($db);
$value    = $settings->get_settings(); 

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar" lang="en-US">
<!--<![endif]-->
<head>
<title>Homepage Settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>source/jquery.fancybox.css' />
<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.3' type='text/css' media='all' />

<script src='<?php echo $admin_url; ?>assets/js/jquery-1.11.1.min.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/utils.js'></script>
</head>
<body class="wp-admin wp-core-ui no-js  jetpack-connected post-new-php auto-fold admin-bar post-type-page branch-3-8 version-3-8-3 admin-color-fresh locale-en-us no-customize-support no-svg">
<div id="wpwrap">

<div id="adminmenuback"></div>

<?php include('includes/admin_navigation.php'); ?>

<div id="wpcontent">

<?php include('includes/admin_bar.php'); ?>
		
<div id="wpbody">

<div id="wpbody-content" aria-label="Main content" tabindex="0">


<div class="wrap">
<h2>Settings</h2>

<?php echo $session->flashdata('success'); ?>
<?php echo $session->flashdata('errors'); ?>

<form method="POST" action="<?php echo $admin_url; ?>process-settings">
<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">Homepage Header Title</label></th>
<td><input name="header_title" type="text" id="blogname" value="<?php echo $value['header_title']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Homepage Header Subtext</label></th>
<td><textarea name="header_subtext" cols="60" rows="4" id="blogname" class="regular-text" /><?php echo $value['header_subtext']; ?></textarea></td>
</tr>

</table>
<input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Save"  />
</form>
</div>


<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->
<div class="clear"></div></div><!-- wpwrap -->

<!-- javascript -->
<script src='<?php echo $admin_url; ?>assets/js/hoverIntent.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/admin-bar.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/common.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/wp-lists.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/jquery.fancybox.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/mousewheel.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/functions.js'></script>
<!--            -->

</body>
</html>
