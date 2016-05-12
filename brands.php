<?php
require_once('lib/connect.php');
require_once('core/admin.class.php');
require_once('core/brands.class.php');
require_once('core/pagination.class.php');
require_once('lib/session.class.php');
$page_label = 'Brands';

$brands       = new Brands($db);
$session      = new Session($db);
$admin        = new Admin($db);
$general      = new General($db);
$brands_array = $brands->get_all_brands();
$count = count($brands_array);
if(!$admin->isLoggedIn())
{
    header("location: $admin_url");
}
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

<title><?php echo $page_label; ?></title>
<link rel='stylesheet' media='all' href='assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='source/jquery.fancybox.css' />
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
<?php echo $page_label; ?> <a href="<?php echo $admin_url; ?>add-brand" class="add-new-h2">New Brand</a>
</h2>

<?php echo $session->flashdata('brand-added'); ?>
<?php echo $session->flashdata('brand-deleted'); ?>

<form action="" method="get">


	<div class="tablenav top">



<br class="clear" />


</div>
<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' id='cb' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox" /></th>
		<th scope='col' id='username' class='manage-column'><a href=""><span>Brand Name</span></a></th>
    <th scope='col' id='username' class='manage-column'><a href=""><span>Brand City</span></a></th>
    <th scope='col' id='username' class='manage-column'><a href=""><span>Description</span></a></th>
    <th scope='col' id='username' class='manage-column'><a href=""><span>In Stock</span></a></th>
    <th scope='col' id='username' class='manage-column'><a href=""><span>Picture</span></a></th>
	</tr>
	</thead>




	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox" /></th>
		<th scope='col' class='manage-column'><a href=""><span>Brand Name</span></a></th>
    <th scope='col' class='manage-column'><a href=""><span>Brand City</span></a></th>
    <th scope='col' class='manage-column'><a href=""><span>Description</span></a></th>
    <th scope='col' class='manage-column'><a href=""><span>In Stock</span></a></th>
    <th scope='col' class='manage-column'><a href=""><span>Picture</span></a></th>
    </tr>
	</tfoot>

	<tbody id="the-list" data-wp-lists='list:user'>
	
	<?php

       if (count($brands_array)) {
          // Create the pagination object
          $pagination = new pagination($brands_array, (isset($_GET['page']) ? $_GET['page'] : 1), 10, 'brands');
          // Decide if the first and last links should show
          $pagination->setShowFirstAndLast(false);
          // You can overwrite the default seperator
          $pagination->setMainSeperator(' | ');
          // Parse through the pagination class
          $productPages = $pagination->getResults();
          // If we have items 
          if (count($productPages) != 0) {

            $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';

            foreach ($productPages as $row) {

	?>
	<tr id='user-1' class="alternate"><th scope='row' class='check-column'><label class="screen-reader-text" for="cb-select-1">Select Admin</label></th>
		<td><strong><?php echo $row['brand_name']; ?></strong><br /><div class="row-actions"><span class='edit'><a href="<?php echo $admin_url; ?>edit-brand/<?php echo $row['brand_id']; ?>">Edit</a> | </span><span class='delete'><a class='submitdelete' href='<?php echo $admin_url; ?>delete-brand/<?php echo $row['brand_id']; ?>'>Delete</a></span></div></td>
	  <td><?php echo $row['brand_city']; ?></td>
    <td><?php echo $general->limit_words($row['brand_description'], 30); ?></td>
    <td><?php if($row['in_stock'] == 1) { echo "Yes"; } else { echo "no"; } ?></td>
    <td><p><a class="group1" href="http://www.meethelocals.com/admin/assets/img/<?php echo $row['brand_id']; ?>/" title="Me and my grandfather on the Ohoopee."><img src="http://www.meethelocals.com/admin/assets/img/<?php echo $row['brand_id']; ?>/" /></a></p></td>
  </tr>

    <?php
    }
    echo '<div style="float: right">' . $count . ' brands&nbsp;&nbsp;&nbsp;<br />';
    echo $pageNumbers . '</div>';
          }
        }
        ?>
	




    
    </tbody>
</table>



</form>

<br class="clear" />
</div>


<div class="clear"></div></div>
<div class="clear"></div></div>
<div class="clear"></div></div>




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


    <link rel="stylesheet" href="<?php echo $admin_url; ?>assets/css/colorbox.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo $admin_url; ?>assets/js/jquery.colorbox.js"></script>
    <script>
      $(document).ready(function(){
        //Examples of how to assign the Colorbox event to elements
        $(".group1").colorbox({rel:'group1'});
        $(".group2").colorbox({rel:'group2', transition:"fade"});
        $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
        $(".group4").colorbox({rel:'group4', slideshow:true});
        $(".ajax").colorbox();
        $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
        $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
        $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
        $(".inline").colorbox({inline:true, width:"50%"});
        $(".callbacks").colorbox({
          onOpen:function(){ alert('onOpen: colorbox is about to open'); },
          onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
          onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
          onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
          onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
        });

        $('.non-retina').colorbox({rel:'group5', transition:'none'})
        $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
        
        //Example of preserving a JavaScript event for inline calls.
        $("#click").click(function(){ 
          $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
          return false;
        });
      });
    </script>
