<?php
ini_set('error_reporting', E_ALL & ~E_WARNING & ~E_NOTICE);
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['user']) && !isset($_SESSION['id'])){
	header('Location: /admin/index.php');
	exit;
}
?>