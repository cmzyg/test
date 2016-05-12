<?php
require_once('lib/connect.php');
require_once('core/brands.class.php');

$brands = new Brands($db);
$brands->edit_brand();
?>