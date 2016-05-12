<?php
require_once('lib/connect.php');
require_once('core/brands.class.php');
require_once('lib/session.class.php');
$page_label = 'Brands';

$brands   = new Brands($db);
$session  = new Session($db);

$brand = $brands->get_brand_by_id();

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar" lang="en-US">
<!--<![endif]-->
<head>
<title>Edit Brand</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' media='all' href='../assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='../assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='../assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='../assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='../assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='../source/jquery.fancybox.css' />
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
<h2>Edit Brand</h2>
<?php echo $session->flashdata('saved'); ?>
<?php echo $session->flashdata('errors'); ?>

<form method="POST" action="<?php echo $admin_url; ?>process-edit-brand">
<table class="form-table">
<tr valign="top">
<th scope="row"><label for="blogname">Brand Name</label></th>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<td><input name="brand_name" type="text" value="<?php echo $brand['brand_name']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Brand City</label></th>
<td><input name="brand_city" type="text" value="<?php echo $brand['brand_city']; ?>" class="regular-text" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">Brand Description</label></th>
<td><textarea name="brand_description" cols="45" rows="4" class="regular-text" /><?php echo $brand['brand_description']; ?></textarea></td>
</tr>

<tr valign="top">
<th scope="row"><label for="blogname">In Stock</label></th>
<td>
	<select name="in_stock">
        <option value="1" <?php if($brand['in_stock'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
        <option value="0" <?php if($brand['in_stock'] == 0) { echo "selected='selected'"; } ?>>No</option>
    </select>
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
