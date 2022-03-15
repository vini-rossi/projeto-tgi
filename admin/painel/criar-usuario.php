<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');

$sql_procurar = "SELECT id FROM usuarios WHERE email = '{$_REQUEST['email']}' or user = '{$_REQUEST['usuario']}'";
$query_procurar = mysqli_query($con, $sql_procurar);
$encontrados = mysqli_num_rows($query_procurar);
if($encontrados > 0){
	echo json_encode(array("info" => 1));exit;
}else{
	$sql_insert = "INSERT INTO usuarios (nome, email, user, pass) VALUES ('{$_REQUEST['nome']}', '{$_REQUEST['email']}', '{$_REQUEST['usuario']}', '{$_REQUEST['senha']}')";
	$query_insert = mysqli_query($con, $sql_insert);
	if($query_insert){
		echo json_encode(array("info" => 2));exit;
	}else{
		echo json_encode(array("info" => 3));exit;
	}
}
?>