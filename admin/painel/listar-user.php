<?php
require_once(__DIR__ . '/verificasessao.php');
require_once(__DIR__ . '/banco.php');

if(isset($_REQUEST['pesquisar'])){
    $pesquisar = $_REQUEST['pesquisar'];
    $listagem = "SELECT * FROM usuarios WHERE nome LIKE '%{$pesquisar}%' or email LIKE '%{$pesquisar}%' or user LIKE '%{$pesquisar}%'";
    $query_listagem = mysqli_query($con, $listagem);
}else{
    $pesquisar = '';
    $listagem = "SELECT * FROM usuarios";
    $query_listagem = mysqli_query($con, $listagem);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel - Overcore Tecnologia</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/jquery.js"></script>

    <script type="text/javascript">
    function EditarUsuario(id){
        location.href = 'editar-user.php?id='+id;
    }
    function ExcluirUsuario(id, user){
        if(confirm('Deseja realmente deletar o usuário '+user+' permanentemente?')){
            $('#alert-envio').hide();
             $.ajax({
                dataType: 'json',
                method: "post",
                data: {
                    id: id
                },
                url: 'deletar-usuario.php',
                success: function(response){
                    if(response.info == '1'){
                        $('#alert-envio').addClass('alert-success');
                        $('#alert-envio').html('O Usuário <strong>'+user+'</strong> foi deletado com sucesso!');
                    }else if(response.info == '2'){
                        $('#alert-envio').addClass('alert-danger');
                        $('#alert-envio').html('O Usuário <strong>'+user+'</strong> não foi deletado!');
                    }
                    $('#alert-envio').show();
                    $('#user'+id).remove();
                }
            });
        }
    }
    </script>
</head>

<body>

    <div id="wrapper">

        <?php
        require(__DIR__ . '/menu.php');
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Todos os usuários
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Painel de controle</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Usuários
                            </li>
                            <li class="active">
                                Todos usuários
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                     <form method="post" name="pesquisar">
                    <div class="form-group input-group">
                                
                                <input type="text" class="form-control" name="pesquisar" value="<?=$pesquisar?>" placeholder="Pesquisar...">
                                <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
                            </div>
                        </form>
                        <div class="alert" id="alert-envio" style="display: none; text-align: center;">
                         </div>
                        <h2>Usuários cadastrados</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Usuário</th>
                                        <th>Email</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        
                                        echo ' <tr id="user'.$result['id'].'">
                                        <td>'.$countusers.'</td>
                                        <td>'.$result['nome'].'</td>
                                        <td>'.$result['user'].'</td>
                                        <td>'.$result['email'].'</td>
                                        <td><button type="button" onclick="EditarUsuario('.$result['id'].');" class="btn btn-xs btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>  Editar</button></td>
                                        <td><button type="button" onclick="ExcluirUsuario('.$result['id'].', \''.$result['user'].'\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i>  Excluir</button></td>
                                         </tr>';
                                    }
                                    ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
