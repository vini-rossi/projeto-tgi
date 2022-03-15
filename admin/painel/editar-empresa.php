<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');
if(!isset($_REQUEST['id'])){
	exit;
}
if(isset($_REQUEST['dataconst'])){
	$_REQUEST['dataconst'] = DataParaBanco($_REQUEST['dataconst']);
}
$sql_procurar = "SELECT * FROM empresas WHERE id = '{$_REQUEST['id']}'";
$query_procurar = mysqli_query($con, $sql_procurar);
$encontrados = mysqli_num_rows($query_procurar);
if($encontrados > 0){
	$sql_duplicado = "SELECT id FROM empresas WHERE id <> '{$_REQUEST['id']}' and (razao_social = '{$_REQUEST['razao']}' or cnpj = '{$_REQUEST['cnpj']}')";
	$query_duplicado = mysqli_query($con, $sql_duplicado);
	$duplicados = mysqli_num_rows($query_duplicado);
	if($duplicados > 0){
		echo json_encode(array("info" => 4));exit;
	}
	$sql_update = "UPDATE empresas SET razao_social = '{$_REQUEST['razao']}', fantasia = '{$_REQUEST['fantasia']}', cnpj = '{$_REQUEST['cnpj']}' , estadual = '{$_REQUEST['estadual']}', municipal = '{$_REQUEST['municipal']}', data_constituicao = '{$_REQUEST['dataconst']}', atv_desenvolvidas = '{$_REQUEST['atividade']}', gen_atividade = '{$_REQUEST['atividade']}', espece = '{$_REQUEST['espece']}', endereco = '{$_REQUEST['endereco']}', bairro = '{$_REQUEST['bairro']}', cep = '{$_REQUEST['cep']}', cidade = '{$_REQUEST['cidade']}', estado = '{$_REQUEST['estado']}', pais = '{$_REQUEST['pais']}', telefone = '{$_REQUEST['tel']}', nome_rep = '{$_REQUEST['representante']}', email = '{$_REQUEST['email']}', cpf = '{$_REQUEST['cpf']}', tel_rep = '{$_REQUEST['telrepre']}' WHERE id = '{$_REQUEST['id']}'";
	if(mysqli_query($con, $sql_update)){
		echo json_encode(array("info" => 1));exit;
	}else{
		echo json_encode(array("info" => 2));exit;
	}
}else{
	echo json_encode(array("info" => 3));exit;
}
?>