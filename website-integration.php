<?php
$page_label = 'social';
require_once('core/connect.php');
require_once('includes/settings.php');

require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);

// get social media from the database
$database->selectAll('SELECT * FROM social_media');
$social_media = $database->fetchAll();

$database->select('SELECT * FROM analytics');
$analytics = $database->fetch();

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

<title>Website Integration</title>

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

</head>


<body class="wp-admin wp-core-ui no-js  jetpack-connected options-general-php auto-fold admin-bar branch-3-8 version-3-8-3 admin-color-fresh locale-en-us no-customize-support no-svg">
<script type="text/javascript">
	document.body.className = document.body.className.replace('no-js','js');
</script>

	
<div id="wpwrap">
<a tabindex="1" href="#wpbody-content" class="screen-reader-shortcut">Skip to main content</a>

<div id="adminmenuback"></div>

<?php include('includes/admin_navigation.php'); ?>

<div id="wpcontent">

<?php include('includes/admin_bar.php'); ?>
		
<div id="wpbody">

<div id="wpbody-content" aria-label="Main content" tabindex="0">



<div class="wrap">
<h2>Website Integration</h2>

<form method="post" action="<?php echo $admin_url; ?>process-social-media">
<input type='hidden' name='option_page' value='general' /><input type="hidden" name="action" value="update" /><input type="hidden" id="_wpnonce" name="_wpnonce" value="e32afa69af" /><input type="hidden" name="_wp_http_referer" value="/wp-admin/options-general.php" />
<table class="form-table">


<?php echo $settings->flashdata('Success'); ?>

<?php foreach($social_media as $row) { ?>

<tr valign="top">
	<th scope="row"><h3><?php echo $row['name']; ?></h3></th>
</tr>

<tr valign="top">
	<th scope="row"><label for="blogname">URL</label></th>
	<td><input name="url[]" type="text" id="blogname" value="<?php echo $row['url']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
	<th scope="row"><label for="blogname">Status</label></th>
	<td><select name="status[]"><option value='Active' <?php if($row['status'] == 'Active') { echo "selected='selected'"; } ?>>Active</option><option value='Inactive' <?php if($row['status'] == 'Inactive') { echo "selected='selected'"; } ?>>Inactive</option><select></td>
</tr>


<tr>
	<th><hr /></th>
	<td><hr /></td>
</tr>
<?php } ?>

<tr valign="top">
<th scope="row"><label for="blogname">Google Analytics</label></th>
<td><textarea name="google_analytics_code" cols="60" rows="10"><?php echo $analytics['google_analytics_code']; ?></textarea></td>
</tr>

<tr valign="top">
	<th scope="row"><label for="blogname">Analytics ID</label></th>
	<td><input name="gapi_id" type="text" id="blogname" value="<?php echo $analytics['gapi_id']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
	<th scope="row"><label for="blogname">Analytics Email</label></th>
	<td><input name="gapi_email" type="text" id="blogname" value="<?php echo $analytics['gapi_email']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
	<th scope="row"><label for="blogname">Analytics Password</label></th>
	<td><input name="gapi_password" type="password" id="blogname" value="<?php echo $analytics['gapi_password']; ?>" class="regular-text" /></td>
</tr>




</table>


<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</div>


<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
		<span id="footer-thankyou"></span>	</p>
	<p id="footer-upgrade" class="alignright">
		<strong></strong>	</p>
	<div class="clear"></div>
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
