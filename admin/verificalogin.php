<?php
require_once(__DIR__ . '/banco.php');
$sql = "SELECT * FROM usuarios WHERE user = '{$_REQUEST['usuario']}' and pass = '{$_REQUEST['senha']}'";
$procurar = mysqli_query($con, $sql);
$encontrados = mysqli_num_rows($procurar);
$login = mysqli_fetch_assoc($procurar);
	if ($encontrados > 0) {
		echo json_encode(array("info" => 1, "id" => $login['id'], "nome" => $login['nome']));exit;
	} 
	else {
		echo json_encode(array("info" => 2));exit;
	}
?>