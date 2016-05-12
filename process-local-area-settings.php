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

$company_address = $_POST['main_area'];

$result = Geolocation::getCoordinates($company_address);

$latitude  = (string)$result['latitude'];
$longitude = (string)$result['longitude'];


// update settings
$settings->updateLocalAreaSettings($latitude, $longitude);
?>