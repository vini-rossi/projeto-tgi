<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');
if(isset($_REQUEST['dataconst'])){
	$_REQUEST['dataconst'] = DataParaBanco($_REQUEST['dataconst']);
}
$sql_procurar = "SELECT id FROM empresas WHERE razao_social = '{$_REQUEST['razao']}' or fantasia = '{$_REQUEST['fantasia']}' or cnpj = '{$_REQUEST['cnpj']}'";
$query_procurar = mysqli_query($con, $sql_procurar);
$encontrados = mysqli_num_rows($query_procurar);
if($encontrados > 0){
	echo json_encode(array("info" => 1));exit;
}else{
	$sql_insert = "INSERT INTO empresas (razao_social, fantasia, cnpj, estadual, municipal, data_constituicao, atv_desenvolvidas, gen_atividade, espece, endereco, bairro, cep, cidade, estado, pais, telefone, nome_rep, email, cpf, tel_rep) VALUES ('{$_REQUEST['razao']}', '{$_REQUEST['fantasia']}', '{$_REQUEST['cnpj']}', '{$_REQUEST['estadual']}', '{$_REQUEST['municipal']}', '{$_REQUEST['dataconst']}', '{$_REQUEST['atividade']}', '{$_REQUEST['genero']}', '{$_REQUEST['espece']}', '{$_REQUEST['endereco']}', '{$_REQUEST['bairro']}', '{$_REQUEST['cep']}', '{$_REQUEST['cidade']}', '{$_REQUEST['estado']}', '{$_REQUEST['pais']}', '{$_REQUEST['tel']}', '{$_REQUEST['representante']}', '{$_REQUEST['email']}', '{$_REQUEST['cpf']}', '{$_REQUEST['telrepre']}')";
	$query_insert = mysqli_query($con, $sql_insert);
	if($query_insert){
		echo json_encode(array("info" => 2));exit;
	}else{
		echo json_encode(array("info" => 3));exit;
	}
}
?>