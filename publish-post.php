<?php
require_once('lib/connect.php');
require_once('core/posts.class.php');

$posts = new Posts($db);
$posts->publish_post();
?>