<?php 
require_once('lib/connect.php');
require_once('lib/session.class.php');
require_once('core/categories.class.php');
$page_label = 'blog';

$categories        = new Categories($db);
$all_categories    = $categories->get_all_categories();
$all_subcategories = $categories->get_all_subcategories();
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
<title>New Post</title>

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
<h2>New Post</h2>


<form name="post" action="../publish-post" method="post" id="post">


<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">
<div id="post-body-content">

<div id="titlediv">
<div id="titlewrap">
	<input type="text" name="title" size="30" value="" id="title" autocomplete="off" placeholder='Subject' />
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
<div id="wp-content-editor-container" class="wp-editor-container"><textarea class="wp-editor-area" style="height: 360px" cols="40" name="post" id="content" placeholder='Your post goes here...'></textarea></div>
</div>



</div>
</div><!-- /post-body-content -->

<div id="postbox-container-1" class="postbox-container">
<div id="side-sortables" class="meta-box-sortables">

<div id="submitdiv" class="postbox " >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Publish</span></h3>
<div class="inside">
<div class="submitbox" id="submitpost">

<div id="minor-publishing">


<div class="clear"></div>
</div>

<div id="major-publishing-actions">

	<h3>Category</h3>
<select style="cursor:pointer" name="category">
	<option value="Plays">Plays</option>
<?php foreach($all_categories as $row)
{
	?>
	<option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
	<?php
}
?>
</select>
<!--
<br /><br />
<h3>Sub Category</h3>
<select style="cursor:pointer" name="subcategory">
<?php foreach($all_subcategories as $row)
{
	?>
	<option value="<?php echo $row['subcategory']; ?>"><?php echo $row['subcategory']; ?></option>
	<?php
}
?>
</select>
-->
<br /><br />


<div id="publishing-action">
<span class="spinner"></span>

		<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Publish Post" accesskey="p"  /></div>
<div class="clear"></div>
</div>
</div>

</div>
</div>




</div></div>
<div id="postbox-container-2" class="postbox-container">
<div id="normal-sortables" class="meta-box-sortables"><div id="postcustom" class="postbox  hide-if-js" >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Custom Fields</span></h3>
<div class="inside">
<div id="postcustomstuff">
<div id="ajax-response"></div>

<table id="list-table" style="display: none;">
	<thead>
	<tr>
		<th class="left">Name</th>
		<th>Value</th>
	</tr>
	</thead>
	<tbody id="the-list" data-wp-lists="list:meta">
	<tr><td></td></tr>
	</tbody>
</table><p><strong>Add New Custom Field:</strong></p>

</div>
<p>Custom fields can be used to add extra metadata to a post that you can <a href="http://codex.wordpress.org/Using_Custom_Fields" target="_blank">use in your theme</a>.</p>
</div>
</div>
<div id="commentstatusdiv" class="postbox  hide-if-js" >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Discussion</span></h3>
<div class="inside">
<input name="advanced_view" type="hidden" value="1" />
<p class="meta-options">
	<label for="comment_status" class="selectit"><input name="comment_status" type="checkbox" id="comment_status" value="open"  checked='checked' /> Allow comments.</label><br />
	<label for="ping_status" class="selectit"><input name="ping_status" type="checkbox" id="ping_status" value="open"  checked='checked' /> Allow <a href="http://codex.wordpress.org/Introduction_to_Blogging#Managing_Comments" target="_blank">trackbacks and pingbacks</a> on this page.</label>
	</p>
</div>
</div>
<div id="slugdiv" class="postbox  hide-if-js" >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Slug</span></h3>
<div class="inside">
<label class="screen-reader-text" for="post_name">Slug</label><input name="post_name" type="text" size="13" id="post_name" value="" />
</div>
</div>
<div id="authordiv" class="postbox  hide-if-js" >
<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Author</span></h3>
<div class="inside">
<label class="screen-reader-text" for="post_author_override">Author</label>
<select name='post_author_override' id='post_author_override' class=''>
	<option value='1' selected='selected'>Admin</option>
	<option value='3'>Suzanne Parker</option>
</select></div>
</div>
</div></div>
</div><!-- /post-body -->
<br class="clear" />
</div><!-- /poststuff -->
</form>
</div>


<script type="text/javascript">
try{document.post.title.focus();}catch(e){}
</script>

<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->


<link rel='stylesheet' id='wpcom-notes-admin-bar-css'  href='http://s0.wp.com/wp-content/mu-plugins/notes/admin-bar-v2.css?ver=2.9.3-201417' type='text/css' media='all' />
<link rel='stylesheet' id='noticons-css'  href='http://s0.wp.com/i/noticons/noticons.css?ver=2.9.3-201417' type='text/css' media='all' />

	
<div class="clear"></div></div><!-- wpwrap -->

</body>
</html>
