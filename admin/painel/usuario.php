<?php
require_once(__DIR__ . '/verificasessao.php');
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

    <script type="text/javascript" src="js/jquery.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<script language="JavaScript">

function EnviarCadastro(){
    var nome = $('#nome').val();
    var email = $('#email').val();
    var usuario = $('#usuario').val();
    var senha = $('#senha').val();
    $.ajax({
        dataType: 'json',
        method: "post",
        data: {
            nome: nome,
            email: email,
            usuario: usuario,
            senha: senha
        },
        url: 'criar-usuario.php',
        success: function(response){
             $('#alert-envio').attr('class', '');
            if(response.info == '1'){
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>Usuário ou email já foram cadastrados</p>');
            }else if(response.info == '2'){
                $('#alert-envio').addClass('alert alert-success');
                $('#alert-envio').html('<strong>Cadastrado!</strong> O usuário '+usuario+' foi cadastrado com sucesso!');
            }else if(response.info == '3'){
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>Ocorreu um erro</p>');
            }
            $('#alert-envio').show();
        }
    });
}
 </script>

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
                            Adicionar um novo usuário
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Painel de controle</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Usuário
                            </li>
                            <li class="active">
                                Adicionar novo
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="alert" id="alert-envio" style="display: none; text-align: center;">
                    </div>
                    <div class="col-lg-6">
                        <form role="form" method="post" onsubmit="EnviarCadastro();return false;">

                            <div class="form-group">
                                <input class="form-control" id="nome" name="nome" placeholder="Nome" required>
                                <br>
                                <input class="form-control" type="email" id="email" name="Email" placeholder="Email" required>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
                            <button type="reset" class="btn btn-lg btn-default">Limpar campos</button>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" required>
                                <br>
                         </div>
                         <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" id="senha" placeholder="Senha" required>
                         </div>
                            </div>
                        </form>
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
