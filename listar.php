<!-- Acessando banco de dados -->
<?php
require_once(__DIR__ . '/inc/banco.php');

if(isset($_REQUEST['pesquisar'])){
    $pesquisar = $_REQUEST['pesquisar'];
    $listagem = "SELECT * FROM empresas WHERE razao_social LIKE '%{$pesquisar}%' or fantasia LIKE '%{$pesquisar}%' or cnpj LIKE '%{$pesquisar}%' or cep LIKE '%{$pesquisar}%' or pais LIKE '%{$pesquisar}%' or gen_atividade LIKE '%{$pesquisar}%'";
    $query_listagem = mysqli_query($con, $listagem);
}else{
    $pesquisar = '';
    $listagem = "SELECT * FROM empresas";
    $query_listagem = mysqli_query($con, $listagem);
}
?>
<!-- / Acessando banco de dados -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Overcore tecnologia - Empresas</title>
<meta charset="utf-16">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/layout.css" type="text/css">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    function VisualizarEmpresa(id){
        location.href = 'empresa.php?id='+id;
    }
</script>
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
    <form method="post" name="pesquisar">
  <div class="form-group input-group">
              
              <input type="text" class="form-control" name="pesquisar" id="pesquisar" value="<?=$pesquisar?>" placeholder="Pesquisar...">
              <span class="input-group-btn"><button class="btn-pesquisar" type="submit"><i class="fa fa-search"></i></button></span>
          </div>
      </form>

  <dl class="tabela">

          <li>ID</li>
          <li>Razão Social</li>
          <li>Nome fantasia</li>
          <li>CNPJ</li>
          <li>Visualizar</li>
  </dl><br>
            <?php
            $countusers = 0;
            while($result = mysqli_fetch_assoc($query_listagem)){
                $countusers++;
                foreach($result as $field => $valor){
                    if(strlen($valor) > 20){
                        $result[$field] = substr($result[$field], 0, 20) . '...';
                    }else{
                        $result[$field] = $result[$field];
                    }
                }
                
                echo ' <dl class="tabela" id="user'.$result['id'].'">
                <li>'.$countusers.'</li>
                <li>'.$result['razao_social'].'</li>
                <li>'.$result['fantasia'].'</li>
                <li>'.$result['cnpj'].'</li>
                <li><a type="button" onclick="VisualizarEmpresa('.$result['id'].');" ><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                </dl><br>';
            }
            ?>
           
        </tbody>
    </table>
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
