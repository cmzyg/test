<?php 
require_once('lib/connect.php');
require_once('lib/session.class.php');
require_once('core/pages.class.php');
$page_label = 'pages';
$page = new Pages($db);
$session = new Session($db);
$page_content = $page->get_page('contact');
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
<title>Edit '<?php echo $page_content['page_title']; ?>' Page</title>

<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>source/jquery.fancybox.css' />
<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.3' type='text/css' media='all' />

<script src='<?php echo $admin_url; ?>assets/js/jquery-1.11.1.min.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/utils.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/json2.js'></script>
<script src='<?php echo $admin_url; ?>source/jquery.fancybox.pack.js'></script>


<style type="text/css">
#publicize {
	line-height: 1.5;
}
#publicize ul {
	margin: 4px 0 4px 6px;
}
#publicize li {
	margin: 0;
}
#publicize textarea {
	margin: 4px 0 0;
	width: 100%
}
#publicize ul.not-connected {
	list-style: square;
	padding-left: 1em;
}
.post-new-php .authorize-link, .post-php .authorize-link {
	line-height: 1.5em;
}
.post-new-php .authorize-message, .post-php .authorize-message {
	margin-bottom: 0;
}
#poststuff #publicize .updated p {
	margin: .5em 0;
}
.wpas-twitter-length-limit {
	color: red;
}
</style>
</head>
<body class="wp-admin wp-core-ui no-js  jetpack-connected post-new-php auto-fold admin-bar post-type-page branch-3-8 version-3-8-3 admin-color-fresh locale-en-us no-customize-support no-svg">
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
<h2>Edit '<?php echo $page_content['page_title']; ?>' Page</h2>
<?php echo $session->flashdata('page-updated'); ?>


<form name="post" action="../process-edit-page" method="post" id="post">


<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">
<div id="post-body-content">

<div id="titlediv">
<div id="titlewrap">
	<input type="text" name="title" size="30" id="title" autocomplete="off" placeholder='Subject' value='<?php echo $page_content['page_title']; ?>' readonly />
    <br /><br /><label>Intro</label><br />
	<input type="text" name="intro" size="91" placeholder='Intro' value='<?php echo $page_content['page_intro']; ?>' />
    <input type="hidden" name="page_id" value="<?php echo $page_content['page_id']; ?>" />
    <input type="hidden" name="page_url" value="<?php echo $page_content['page_url']; ?>" />
</div>
<div class="inside">
	<div id="edit-slug-box" class="hide-if-no-js">
		</div>
</div>
</div><!-- /titlediv -->
<div id="postdivrich" class="postarea edit-form-section">

<div id="wp-content-wrap" class="wp-core-ui wp-editor-wrap html-active"><link rel='stylesheet' id='editor-buttons-css'  href='<?php echo $admin_url; ?>assets/css/editor.min.css' type='text/css' media='all' />
<div id="wp-content-editor-tools" class="wp-editor-tools hide-if-no-js">

</div>
<label>Content</label><br />
<div id="wp-content-editor-container" class="wp-editor-container"><textarea class="wp-editor-area" style="height: 360px" cols="40" name="page_content" id="content" placeholder='Your post goes here...'><?php echo $page_content['page_content']; ?></textarea></div>
</div>



</div>
</div><!-- /post-body-content -->

<div id="postbox-container-1" class="postbox-container">
<div id="side-sortables" class="meta-box-sortables">

<div id="submitdiv" class="postbox " >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Save</span></h3>
<div class="inside">
<div class="submitbox" id="submitpost">

<div id="minor-publishing">


<div class="clear"></div>
</div>

<div id="major-publishing-actions">



<div id="publishing-action">
<span class="spinner"></span>

		<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Save Page" accesskey="p"  /></div>
<div class="clear"></div>
</div>
</div>

</div>
</div>




</div></div>

</div><!-- /post-body -->
<br class="clear" />
</div><!-- /poststuff -->
</form>
</div>

<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->


<link rel='stylesheet' id='wpcom-notes-admin-bar-css'  href='http://s0.wp.com/wp-content/mu-plugins/notes/admin-bar-v2.css?ver=2.9.3-201417' type='text/css' media='all' />
<link rel='stylesheet' id='noticons-css'  href='http://s0.wp.com/i/noticons/noticons.css?ver=2.9.3-201417' type='text/css' media='all' />

<!-- javascript -->
<script src='<?php echo $admin_url; ?>assets/js/hoverIntent.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/admin-bar.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/common.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/wp-lists.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/jquery.fancybox.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/mousewheel.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/functions.js'></script>
<!--            -->
	
<div class="clear"></div></div><!-- wpwrap -->

</body>
</html>
