<?php
$page_label = 'bookings';
require_once('core/connect.php');
require_once('includes/settings.php');

require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/pagination.class.php');
require_once('core/bookings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$bookings   = new Bookings($db);

// automatically complete all accepted bookings that are one day old
$bookings->autoComplete();


$count_bookings = $bookings->countBookingsByRange();

$count = 0;
$bookings_array = array();

if(isset($_POST['action']))
{
	if($_POST['action'] !== 'delete')
	{
		$bookings_list = $bookings->sortBookings();
	}
	else
	{
		$bookings->deleteBookings();
	}
}
else
{
	$bookings_list = $bookings->getBookings();
}

foreach($bookings_list as $rows)
{
	$bookings_array[$count]['booking_date'] = date('d-m-Y H:i:s', strtotime($rows['booking_date']));
	$bookings_array[$count]['id']           = $rows['id'];
	$bookings_array[$count]['payment']      = $rows['payment'];
	$bookings_array[$count]['booking_type'] = $rows['booking_type'];
	$bookings_array[$count]['status']       = $rows['status'];
	$bookings_array[$count]['from']         = $rows['pickup'];
	$bookings_array[$count]['to']           = $rows['destination'];
	$bookings_array[$count]['fullname']     = $rows['fullname'];
	$bookings_array[$count]['email']        = $rows['email'];
	$bookings_array[$count]['telephone']    = $rows['telephone'];
	$bookings_array[$count]['saloon']       = $rows['saloon'];
	$bookings_array[$count]['estate']       = $rows['estate'];
	$bookings_array[$count]['executive']    = $rows['executive'];
	$bookings_array[$count]['mpv']          = $rows['mpv'];
	$bookings_array[$count]['minibus']      = $rows['minibus'];
	$bookings_array[$count]['minicoach']    = $rows['minicoach'];
	$bookings_array[$count]['note']         = $rows['note'];
	$bookings_array[$count]['received']     = $rows['received'];
	$bookings_array[$count]['responded']    = $rows['responded'];
	$bookings_array[$count]['booking_id']   = $rows['booking_id'];
    $count++;
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

<title>Bookings</title>
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/dashicons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/admin-bar.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/wp-admin.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/buttons.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/colors.min.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/fancybox.css' />
<link rel='stylesheet' media='all' href='<?php echo $admin_url; ?>assets/css/style.css' />
<link rel='stylesheet' id='open-sans-css' href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=3.8.3' type='text/css' media='all' />

<!--[if lte IE 7]>
<link rel='stylesheet' id='ie-css'  href='http://sexdirectoryuk.com/wp-admin/css/ie.min.css?ver=3.8.3' type='text/css' media='all' />
<![endif]-->

<script src='<?php echo $admin_url; ?>assets/js/jquery-1.11.1.min.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/utils.js'></script>
<script src='<?php echo $admin_url; ?>assets/js/json2.js'></script>

<link rel='stylesheet' href='<?php echo $admin_url; ?>assets/css/datepicker/styles.css' />
<link rel='stylesheet' href='<?php echo $admin_url; ?>assets/css/datepicker/jquery.ui.all.css' />

<script src="<?php echo $admin_url; ?>assets/js/datepicker/jquery-1.10.2.js"></script>
<script src="<?php echo $admin_url; ?>assets/js/datepicker/jquery.ui.core.js"></script>
<script src="<?php echo $admin_url; ?>assets/js/datepicker/jquery.ui.datepicker.js"></script>


<script>
$( document ).ready(function() {
$(".more_info").click(function () {
    // $(this).parents("tr").next().toggle();
    $(this).parents("tr").next().next().addBack().toggle();
});
});
</script>


</head>



<script>
// start datepicker
$(function(){
  $( "#datepicker" ).datepicker({ dateFormat: "dd-mm-yy"});
});

$(function(){
  $( "#datepicker2" ).datepicker({ dateFormat: "dd-mm-yy"});
});
</script>
</head>

<body>








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
Bookings
</h2>

<?php echo $controller->flashdata('Success'); ?>

<ul>
	<li class='cancelled agenda'>Cancelled</li>
	<li class='accepted agenda'>Accepted</li>
	<li class='new agenda'>New</li>
	<li class='completed agenda'>Completed</li>
	<li class='declined agenda'>Declined</li>
</ul>

<div class="tablenav top">

<div class="alignleft actions bulkactions">
<form method='POST' action='<?php echo $admin_url; ?>actions'>
<select name='action'>
    <option value='' selected='selected'>Actions</option>
	<option value='new'>Show New</option>
	<option value='completed'>Show Completed</option>
	<option value='cancelled'>Show Cancelled</option>
	<option value='declined'>Show Declined</option>
	<option value='today'>Show Today</option>
	<option value='accepted'>Show Accepted</option>
</select>

<input name="date_from" type="text" id="datepicker" class="regular-text" placeholder="From" style="width:25%" />
<input name="date_to" type="text" id="datepicker2" class="regular-text" placeholder="To" style="width:25%" />

<input type="submit" name="" id="doaction" class="button action" value="Apply"  />

</div>



<div class="alignleft actions">
	<div id='group-bulk-actions' class='groups-bulk-container'>
		<div class='groups-select-container'></div>
	</div>
</div>


<br class="clear" />


	</div>
<table class="wp-list-table widefat fixed users" cellspacing="0">
	<thead>
	<tr>
		<th scope='col' id='cb' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-1">Select All</label></th>
		<th scope='col'><strong>Pickup Date</strong></th>
		<th scope='col'><strong>Booking Type</strong></th>
		<th scope='col'><strong>Quote</strong></th>
		<th scope='col'><strong>Journey Details</strong></th>
		<th scope='col'><strong>More Info</strong></th>
	</tr>
	</thead>




	<tfoot>
	<tr>
		<th scope='col' class='manage-column column-cb check-column'><label class="screen-reader-text" for="cb-select-all-2">Select All</label></th>
		<th scope='col'><strong>Pickup Date</strong></th>
		<th scope='col'><strong>Booking Type</strong></th>
		<th scope='col'><strong>Quote</strong></th>
		<th scope='col'><strong>Journey Details</strong></th>
		<th scope='col'><strong>More Info</strong></th>
    </tr>
	</tfoot>

	<tbody id="the-list" data-wp-lists='list:user'>
	
	<?php

       if (count($bookings_array)) {
          // Create the pagination object
          $pagination = new pagination($bookings_array, (isset($_GET['page']) ? $_GET['page'] : 1), 10, 'bookings');
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
	<tr id='user-1' class="alternate">
		<th scope='row' class='check-column <?php echo $row['status']; ?>'><label class="screen-reader-text" for="cb-select-1">Select Admin</label></th>
		<td class='<?php echo $row['status']; ?>'><?php echo $row['booking_date']; ?><br />
			<?php if($row['status'] == 'accepted') { ?><div style="font-size:0.8em"><span class='delete'><a class='submitdelete' href='<?php echo $admin_url; ?>cancel-booking/<?php echo $row['id']; ?>'>Cancel</a></span></div><?php } ?>
			<?php if($row['status'] == 'new') { ?><div style="font-size:0.8em"><span class='delete'><a class='submitdelete' href='<?php echo $admin_url; ?>decline-booking/<?php echo $row['id']; ?>'>Decline</a></span>&nbsp;&nbsp;&nbsp;<span class='delete'><a class='submitdelete' href='<?php echo $admin_url; ?>accept-booking/<?php echo $row['id']; ?>'>Accept</a></span>&nbsp;&nbsp;&nbsp;<span class='delete'><a class='submitdelete' href='<?php echo $admin_url; ?>complete-booking/<?php echo $row['id']; ?>'>Complete</a></span></div><?php } ?>
		</td>
		<td class='<?php echo $row['status']; ?>'><?php echo $row['booking_type']; ?></td>
		<td class='<?php echo $row['status']; ?>'>&pound;<?php echo number_format($row['payment'], 2); ?></td>
		<td class='<?php echo $row['status']; ?>'>From: <?php echo $row['from']; ?>, To: <?php echo $row['to']; ?></td>
		<td class='<?php echo $row['status']; ?>'><button type="button" class='more_info'>Open</button>		</td>
	</tr>

	<tr id='user-2' class="alternate" class="more_info_2" style="display:none">
		<th scope='row' class='check-column'></th>
		<td><strong>Fullname</strong> <br /><?php echo $row['fullname']; ?></td>
		<td><strong>Email</strong> <br /><?php echo $row['email']; ?></td>
		<td><strong>Telephone</strong> <br /><?php echo $row['telephone']; ?></td>
		<td><strong>Vehicles</strong> <br />
			<?php if($row['saloon'] !== '0') { echo '<p>' . $row['saloon'] . ' Saloon</p>'; } ?> 
			<?php if($row['estate'] !== '0') { echo '<p>' . $row['estate'] . ' Estate</p>'; } ?> 
			<?php if($row['executive'] !== '0') { echo '<p>' . $row['executive'] . ' Executive</p>'; } ?> 
			<?php if($row['mpv'] !== '0') { echo '<p>' . $row['mpv'] . ' MPV</p>'; } ?> 
			<?php if($row['minibus'] !== '0') { echo '<p>' . $row['minibus'] . ' Minibus</p>'; } ?> 
			<?php if($row['minicoach'] !== '0') { echo '<p>' . $row['minicoach'] . ' Minicoach</p>'; } ?> 
		</td>
		<td><strong>Note</strong> <br /><?php echo $row['note']; ?></td>

	</tr>
	<tr class="alternate" class="more_info_2" style="display:none">
		<th scope='row' class='check-column'></th>
		<td><strong>Received</strong> <br /><?php echo date('d-m-Y H:i:s', strtotime($row['received'])); ?></td>
		<td><strong>Responded</strong> <br /><?php if($row['responded'] == '0000-00-00 00:00:00') { echo 'No Response Yet'; } else { echo date('d-m-Y H:i:s', strtotime($row['responded'])); } ?></td>
		<td><strong>Booking ID</strong> <br /><?php echo $row['booking_id']; ?></td>
		<td></td>
		<td></td>
	</tr>




    <?php
    }
    echo '<div style="float: right">' . $count_bookings . ' bookings&nbsp;&nbsp;&nbsp;<br />';
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

<div id="wpfooter">
		<p id="footer-left" class="alignleft">
		<span id="footer-thankyou"></span>	</p>
	<p id="footer-upgrade" class="alignright">
		<strong><a href=""></a></strong>	</p>
	<div class="clear"></div>
</div>



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
