<?php
if(isset($_REQUEST['logadosession'])){
	if($_REQUEST['logadosession'] == true){
		session_start();
		$_SESSION['id'] = $_REQUEST['id'];
		$_SESSION['user'] = $_REQUEST['user'];
		$_SESSION['nome'] = $_REQUEST['nome'];
	}
}
require_once(__DIR__ . '/verificasessao.php');
?>