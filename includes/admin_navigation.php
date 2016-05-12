<?php

$page_label      == 'pages'       ? $pages_status       = 'wp-has-current-submenu' : $pages_status       = 'wp-not-current-submenu';
$page_label      == 'Events' 	  ? $events_status 		= 'wp-has-current-submenu' : $events_status 	 = 'wp-not-current-submenu';
$page_label      == 'Press'    	  ? $press_status    	= 'wp-has-current-submenu' : $press_status    	 = 'wp-not-current-submenu';
$page_label      == 'Brands'	  ? $brands_status      = 'wp-has-current-submenu' : $brands_status      = 'wp-not-current-submenu';

?>

<div id="adminmenuwrap">
<ul id="adminmenu" role="navigation">

    <!-- brands menu -->
    <li class="wp-has-submenu <?php echo $brands_status; ?> menu-top menu-icon-event" id="menu-posts-event">
	<a href='<?php echo $admin_url; ?>brands' class="wp-has-submenu <?php echo $brands_status; ?> menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image'></div><div class='wp-menu-name'>Brands</div></a>
	<ul class='wp-submenu wp-submenu-wrap'>
		<li class='wp-submenu-head'>Brands</li>
		<li><a href='<?php echo $admin_url; ?>add-brand' class="wp-first-item">Add Brand</a></li>
	</ul>
    </li>

    <!-- events menu -->
    <li class="wp-has-submenu <?php echo $events_status; ?> menu-top menu-icon-event" id="menu-posts-event">
	<a href='<?php echo $admin_url; ?>events' class="wp-has-submenu <?php echo $events_status; ?> menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image'></div><div class='wp-menu-name'>Events</div></a>
	<ul class='wp-submenu wp-submenu-wrap'>
		<li class='wp-submenu-head'>Events</li>
		<li><a href='<?php echo $admin_url; ?>add-event' class="wp-first-item">Add Event</a></li>
	</ul>
    </li>

    <!-- press menu -->
    <li class="wp-has-submenu <?php echo $press_status; ?> menu-top menu-icon-event" id="menu-posts-event">
	<a href='<?php echo $admin_url; ?>press' class="wp-has-submenu <?php echo $press_status; ?> menu-top menu-icon-page" aria-haspopup="true"><div class="wp-menu-arrow"><div></div></div><div class='wp-menu-image'></div><div class='wp-menu-name'>Press</div></a>
	<ul class='wp-submenu wp-submenu-wrap'>
		<li class='wp-submenu-head'>Press</li>
		<li><a href='<?php echo $admin_url; ?>add-press' class="wp-first-item">Add Press</a></li>
	</ul>
    </li>


	<li class="wp-not-current-submenu wp-menu-separator"><div class="separator"></div></li>

    <li id="collapse-menu" class="hide-if-no-js"><div id="collapse-button"><div></div></div><span>Collapse menu</span></li>

</ul>
</div>