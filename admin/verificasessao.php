<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_SESSION['user']) && isset($_SESSION['id'])){
	header('Location: /admin/painel/index.php');
	exit;
}else{
	require_once(__DIR__ . '/login.html');
}
?>