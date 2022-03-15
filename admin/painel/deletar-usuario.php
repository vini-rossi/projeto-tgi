<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');
$sql = "DELETE FROM usuarios WHERE id = '{$_POST['id']}'";
if(mysqli_query($con, $sql)){
	echo json_encode(array("info" => 1));
}else{
	echo json_encode(array("info" => 2));
}
?>