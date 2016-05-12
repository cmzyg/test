<?php
require_once('lib/connect.php');
require_once('lib/database.class.php');
require_once('core/admin.class.php');

$database   = new Database($db);
$admin      = new Admin($db);

$admin->log_in();

?>