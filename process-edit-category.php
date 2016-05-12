<?php
require_once('lib/connect.php');
require_once('core/categories.class.php');

$categories = new Categories($db);
$categories->edit_category();
?>