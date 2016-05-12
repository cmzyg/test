<?php
require_once('lib/connect.php');
require_once('core/settings.class.php');

$settings = new Settings($db);
$settings->edit_settings();
?>