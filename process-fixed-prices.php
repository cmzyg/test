<?php
require_once('core/connect.php');
require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
require_once('../core/geolocation.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);


// get latitude and longitude of company address
use JeroenDesloovere\Geolocation\Geolocation;


if($_POST['fixed_location_1'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_1'] . ', London, UK');
	$fixed_lat_1  = (string)$result['latitude'];
	$fixed_lon_1  = (string)$result['longitude'];
}
if($_POST['fixed_location_2'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_2'] . ', London, UK');
	$fixed_lat_2  = (string)$result['latitude'];
	$fixed_lon_2  = (string)$result['longitude'];
}
if($_POST['fixed_location_3'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_3'] . ', London, UK');
	$fixed_lat_3  = (string)$result['latitude'];
	$fixed_lon_3  = (string)$result['longitude'];
}
if($_POST['fixed_location_4'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_4'] . ', London, UK');
	$fixed_lat_4  = (string)$result['latitude'];
	$fixed_lon_4  = (string)$result['longitude'];
}
if($_POST['fixed_location_5'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_5'] . ', London, UK');
	$fixed_lat_5  = (string)$result['latitude'];
	$fixed_lon_5  = (string)$result['longitude'];
}
if($_POST['fixed_location_6'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_6'] . ', London, UK');
	$fixed_lat_6  = (string)$result['latitude'];
	$fixed_lon_6  = (string)$result['longitude'];
}
if($_POST['fixed_location_7'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_7'] . ', London, UK');
	$fixed_lat_7  = (string)$result['latitude'];
	$fixed_lon_7  = (string)$result['longitude'];
}
if($_POST['fixed_location_8'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_8'] . ', London, UK');
	$fixed_lat_8  = (string)$result['latitude'];
	$fixed_lon_8  = (string)$result['longitude'];
}
if($_POST['fixed_location_9'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_9'] . ', London, UK');
	$fixed_lat_9  = (string)$result['latitude'];
	$fixed_lon_9  = (string)$result['longitude'];
}
if($_POST['fixed_location_10'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_10'] . ', London, UK');
	$fixed_lat_10  = (string)$result['latitude'];
	$fixed_lon_10  = (string)$result['longitude'];
}
if($_POST['fixed_location_11'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_11'] . ', London');
	$fixed_lat_11  = (string)$result['latitude'];
	$fixed_lon_11  = (string)$result['longitude'];
}
if($_POST['fixed_location_12'] !== '')
{
	$result = Geolocation::getCoordinates($_POST['fixed_location_12'] . ', London');
	$fixed_lat_12  = (string)$result['latitude'];
	$fixed_lon_12  = (string)$result['longitude'];
}

// update settings
$settings->updateFixedPrices($fixed_lat_1, $fixed_lon_1, $fixed_lat_2, $fixed_lon_2, $fixed_lat_3, $fixed_lon_3, $fixed_lat_4, $fixed_lon_4, $fixed_lat_5, $fixed_lon_5, $fixed_lat_6, $fixed_lon_6, $fixed_lat_7, $fixed_lon_7, $fixed_lat_8, $fixed_lon_8, $fixed_lat_9, $fixed_lon_9, $fixed_lat_10, $fixed_lon_10, $fixed_lat_11, $fixed_lon_11, $fixed_lat_12, $fixed_lon_12);

?>