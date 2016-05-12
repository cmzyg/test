<?php
require_once('core/connect.php');
require_once('core/database.class.php');
require_once('core/controller.class.php');
require_once('core/settings.class.php');
$database   = new Database($db);
$controller = new Controller($db);
$settings   = new Settings($db);


// update settings
$settings->updateSaloon()
         ->updateEstate()
         ->updateExecutive()
         ->updateMPV()
         ->updateMinibus()
         ->updateMinicoach();


foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";


?>