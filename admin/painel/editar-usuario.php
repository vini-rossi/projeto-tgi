<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');
if(!isset($_REQUEST['id'])){
	exit;
}
$sql_procurar = "SELECT * FROM usuarios WHERE id = '{$_REQUEST['id']}'";
$query_procurar = mysqli_query($con, $sql_procurar);
$encontrados = mysqli_num_rows($query_procurar);
if($encontrados > 0){
	$sql_duplicado = "SELECT id FROM usuarios WHERE id <> '{$_REQUEST['id']}' and (email = '{$_REQUEST['email']}' or user = '{$_REQUEST['usuario']}')";
	$query_duplicado = mysqli_query($con, $sql_duplicado);
	$duplicados = mysqli_num_rows($query_duplicado);
	if($duplicados > 0){
		echo json_encode(array("info" => 4));exit;
	}
	if($_REQUEST['senha'] !== ''){
		$sql_update = "UPDATE usuarios SET nome = '{$_REQUEST['nome']}', email = '{$_REQUEST['email']}', user = '{$_REQUEST['usuario']}', pass = '{$_REQUEST['senha']}' WHERE id = '{$_REQUEST['id']}'";
	}else{
		$sql_update = "UPDATE usuarios SET nome = '{$_REQUEST['nome']}', email = '{$_REQUEST['email']}', user = '{$_REQUEST['usuario']}' WHERE id = '{$_REQUEST['id']}'";
	}
	if(mysqli_query($con, $sql_update)){
		echo json_encode(array("info" => 1));exit;
	}else{
		echo json_encode(array("info" => 2));exit;
	}
}else{
	echo json_encode(array("info" => 3));exit;
}
?>