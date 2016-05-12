<?php
require_once('lib/connect.php');
require_once('core/categories.class.php');
require_once('core/pagination.class.php');
require_once('lib/session.class.php');
$page_label = 'blog';

$categories   = new Categories($db);
$session = new Session($db);
$subcategories_array = $categories->get_all_subcategories();
$count = $categories->count_subcategories();

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar" lang="en-US">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name='viewport' content='width=device-width,initial-scale=1.0' />

<title>Sub Categories</title>
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

.fancybox-custom .fancybox-skin {
	box-shadow: 0 0 50px #222;
}

</style>

</head>
<body class="wp-admin wp-core-ui no-js options-general-php auto-fold admin-bar branch-3-8 version-3-8-3 admin-color-fresh locale-en-us no-customize-support no-svg">
	
<div id="wpwrap">

<div id="adminmenuback"></div>

<?php include('includes/admin_navigation.php'); ?>

<div id="wpcontent">

<?php include('includes/admin_bar.php'); ?>
		
<div id="wpbody">

<div id="wpbody-content" aria-label="Main content" tabindex="0">

<div class="wrap">
<h2>
Sub Categories <a href="../add-sub-category" class="add-new-h2">New Sub Category</a>
</h2>

<?php echo $session->flashdata('sub-category-added'); ?>
<?php echo $session->flashdata('sub-category-deleted'); ?>

<form action="" method="get">


	<div class="tablenav top">



<br class="clear" />


</div>
<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' id='cb' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox" /></th>
		<th scope='col' id='username' class='manage-column column-username sortable desc'><a href=""><span>Sub Category Name</span></a></th>
    <th scope='col' id='username' class='manage-column column-username sortable desc'><a href=""><span>Category Name</span></a></th>
	</tr>
	</thead>




	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox" /></th>
		<th scope='col' id='username' class='manage-column column-username sortable desc'><a href=""><span>Sub Category Name</span></a></th>
    <th scope='col' class='manage-column column-username'><a href=""><span>Category Name</span></a></th>
    </tr>
	</tfoot>

	<tbody id="the-list" data-wp-lists='list:user'>
	
	<?php

       if (count($subcategories_array)) {
          // Create the pagination object
          $pagination = new pagination($subcategories_array, (isset($_GET['page']) ? $_GET['page'] : 1), 10, 'posts');
          // Decide if the first and last links should show
          $pagination->setShowFirstAndLast(false);
          // You can overwrite the default seperator
          $pagination->setMainSeperator(' | ');
          // Parse through the pagination class
          $productPages = $pagination->getResults();
          // If we have items 
          if (count($productPages) != 0) {
            // Create the page numbers
            $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';
            // Loop through all the items in the array
            foreach ($productPages as $row) {
              // Show the information about the item
              // echo '<p><b>'.$productArray['id'].'</b> &nbsp; &pound;'.$productArray['title'].'</p>';


	?>
	<tr id='user-1' class="alternate"><th scope='row' class='check-column'><label class="screen-reader-text" for="cb-select-1">Select Admin</label></th>
		<td><strong><?php echo $row['subcategory']; ?></strong><br /><div class="row-actions"><span class='edit'><a href="../edit-sub-category/<?php echo $row['id']; ?>">Edit</a> | </span><span class='delete'><a class='submitdelete' href='../delete-sub-category/<?php echo $row['id']; ?>'>Delete</a></span></div></td>
	  <td><?php echo $row['category']; ?></td>
  </tr>

    <?php
    }
    echo '<div style="float: right">' . $count . ' categories&nbsp;&nbsp;&nbsp;<br />';
    echo $pageNumbers . '</div>';
          }
        }
        ?>
	




    
    </tbody>
</table>



</form>

<br class="clear" />
</div>


<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->




<!-- javascript -->
<script src='../assets/js/hoverIntent.js'></script>
<script src='../assets/js/admin-bar.js'></script>
<script src='../assets/js/common.js'></script>
<script src='../assets/js/wp-lists.js'></script>
<script src='../assets/js/jquery.fancybox.js'></script>
<script src='../assets/js/mousewheel.js'></script>
<script src='../assets/js/functions.js'></script>
<!--            -->

<div class="clear"></div></div><!-- wpwrap -->

</body>
</html>
