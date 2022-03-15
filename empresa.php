<?php
require_once(__DIR__ . '/inc/banco.php');
    $sql_user = "SELECT * FROM empresas WHERE id = '{$_REQUEST['id']}'";
    $query = mysqli_query($con, $sql_user);
    $result = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Overcore tecnologia - <?php echo $result['fantasia']?></title>
<meta charset="utf-16">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/layout.css" type="text/css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <img width="15%" src="images/logo.png">
      <a style="float: right;" href="admin/"><button class="login">Fazer Login</button></a>
    </div>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="listar.php">Empresas</a></li>
        <li><a href="contato.html">Contato</a></li>
      </ul>
    </nav>
  </header>
</div>
<!-- conteúdo -->
<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Corpo de conteúdo -->
    <h1 style="color: #009cff;"><?php echo $result['fantasia']?></h1>
    <br>
    <hr>
    <br>
    <strong>Razão social: </strong><span style="color: #009cff;"><?php echo $result['razao_social']?></span>
    <br><br>
    <strong>Nome fantasia: </strong><span style="color: #009cff;"><?php echo $result['fantasia']?></span>
    <br><br>
    <strong>CNPJ: </strong><span style="color: #009cff;"><?php echo $result['cnpj']?></span>
    <br><br>
    <strong>Endereço: </strong><span style="color: #009cff;"><?php echo $result['endereco']?></span>
    <br><br> 
    <strong>Bairro: </strong><span style="color: #009cff;"><?php echo $result['bairro']?></span>
    <br><br>
    <strong>Cidade: </strong><span style="color: #009cff;"><?php echo $result['cidade']?></span>
    <br><br>
    <strong>Estado: </strong><span style="color: #009cff;"><?php echo $result['estado']?></span>
    <br><br>
    <strong>Pais: </strong><span style="color: #009cff;"><?php echo $result['pais']?></span>
    <br><br>
    <strong>CEP: </strong><span style="color: #009cff;"><?php echo $result['cep']?></span>
    <br><br>
    <strong>Atividades desenvolvidas: </strong><span style="color: #009cff;"><?php echo $result['atv_desenvolvidas']?></span>
    <br><br>
    <strong>Gênero da atividade: </strong><span style="color: #009cff;"><?php echo $result['gen_atividade']?></span>
    <br><br>
    <strong>Espece da atividade da empresa: </strong><span style="color: #009cff;"><?php echo $result['espece']?></span>
    <!-- / Corpo de conteúdo -->
  </div>
</div>
<!-- Rodapé -->
<div class="wrapper row3">
  <footer id="footer" class="clear">
    <p class="fl_left">Copyright &copy; 2017 - Todos direitos reservados</p>
    <p class="fl_right"><a href="#" title="Overcore tecnologia">Overcore tecnologia</a></p>
  </footer>
</div>
</body>
</html>
