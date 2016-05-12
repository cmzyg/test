<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
ob_start();
session_start();

date_default_timezone_set('Europe/London');

$base_url  = 'http://www.meethelocals.com/';
$admin_url = 'http://www.meethelocals.com/admin/';

$config = array(
	'host'		=> 'localhost',
	'username' 	=> 'zygimanatssimkus',
	'password' 	=> 'Abcabcabc1',
	'dbname' 	=> 'meethelocals'
);

$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$page = '';
?>