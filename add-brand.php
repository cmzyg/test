<?php
require_once('lib/connect.php');
require_once('core/categories.class.php');
require_once('lib/session.class.php');
$page_label = 'Brands';

$categories   = new Categories($db);
$session      = new Session($db);

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar" lang="en-US">
<!--<![endif]-->
<head>
<title>Add Brand</title>
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
<body class="wp-admin wp-core-ui no-js  jetpack-connected post-new-php auto-fold admin-bar post-type-page admin-color-fresh locale-en-us no-customize-support no-svg">
<div id="wpwrap">

<div id="adminmenuback"></div>

<?php include('includes/admin_navigation.php'); ?>

<div id="wpcontent">

<?php include('includes/admin_bar.php'); ?>
		
<div id="wpbody">

<div id="wpbody-content" aria-label="Main content" tabindex="0">



<div class="wrap">
<h2>Add Brand</h2>

<form method="POST" enctype="multipart/form-data" action="<?php echo $admin_url; ?>process-add-brand">
<table class="form-table">
<tr valign="top">
<th scope="row"><label>Brand Name</label></th>
<td><input name="brand" type="text" value="" class="regular-text" /></td>
</tr>
<tr valign="top">
<th scope="row"><label>Brand City</label></th>
<td><input name="brand_city" type="text" value="" class="regular-text" /></td>
</tr>
<tr valign="top">
<th scope="row"><label>Brand Description</label></th>
<td><textarea name="brand_description" class="regular-text" cols="45" rows="4"></textarea></td>
</tr>

<tr valign="top">
<th scope="row"><label>In Stock</label></th>
<td><select name="in_stock">
    <option value="1">Yes</option>
    <option value="0">No</option>
</select></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Image</label></th>
	<!-- <td style="float:left"><img src="" width="200" height="100" /></td> -->
	<td style="float:left"><input name="file" type="file" value="" class="regular-text" /></td>
</tr>

</table>
<input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Add Brand"  />
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
