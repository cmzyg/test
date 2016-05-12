<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
ob_start();
session_start();
require_once('core/connect.php');
require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);


// update settings
$settings->updateHomepageSettings()
         ->uploadBanners();

foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";


?>