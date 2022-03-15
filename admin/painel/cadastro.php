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
    $('#alert-envio').hide();
    ValidaCPF();
    if($('#alert-envio').css('display') !== 'none'){
        return false;
    }
    ValidaCNPJ();
    if($('#alert-envio').css('display') !== 'none'){
        return false;
    }
    ValidaCEP();
    if($('#alert-envio').css('display') !== 'none'){
        return false;
    }
    var razao = $('#razao').val();
    var fantasia = $('#fantasia').val();
    var cnpj = $('#cnpj').val();
    var estadual = $('#estadual').val();
    var municipal = $('#municipal').val();
    var dataconst = $('#dataconst').val();
    var atividade = $('#atividade').val();
    var genero = $('#genero').val();
    var espece = $('#espece').val();
    var endereco = $('#endereco').val();
    var bairro = $('#bairro').val();
    var cep = $('#cep').val();
    var cidade = $('#cidades').val();
    var estado = $('#estados').val();
    var pais = $('#pais').val();
    var tel = $('#tel').val();
    var representante = $('#representante').val();
    var email = $('#email').val();
    var cpf = $('#cpf').val();
    var telrepre = $('#telrepre').val();
    $.ajax({
        dataType: 'json',
        method: "post",
        data: {
            razao: razao,
            fantasia: fantasia,
            cnpj: cnpj,
            estadual: estadual,
            municipal: municipal,
            dataconst: dataconst,
            atividade: atividade,
            genero: genero,
            espece: espece,
            endereco: endereco,
            bairro: bairro,
            cep: cep,
            cidade: cidade,
            estado: estado,
            pais: pais,
            tel: tel,
            representante: representante,
            email: email,
            cpf: cpf,
            telrepre: telrepre
        },
        url: 'cadastrar-empresa.php',
        success: function(response){
             $('#alert-envio').attr('class', '');
            if(response.info == '1'){
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>Empresa ou CNPJ já foram cadastrados</p>');
            }else if(response.info == '2'){
                $('#alert-envio').addClass('alert alert-success');
                $('#alert-envio').html('<strong>Cadastrado!</strong> A empresa <strong>'+fantasia+'</strong> foi cadastrada com sucesso!');
            }else if(response.info == '3'){
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>Ocorreu um erro</p>');
            }
            $('#alert-envio').show();
            $('body').scrollTop(0);
        }
    });
    return false;
}
function ValidaCNPJ(){
    var cnpj = $('#cnpj').val();
    $.ajax({
        dataType: 'json',
        method: "post",
        data: {
            tipo: 2,
            cnpj: cnpj
        },
        url: '/admin/valida/cpfcnpj.php',
        success: function(response){
            if (response.info == '2') {
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>CNPJ Inválido</p>');
                $('#alert-envio').show();
              $('body').scrollTop(0);
            }
        }
    });
}
function ValidaCPF(){
    var cpf = $('#cpf').val();
    $.ajax({
        dataType: 'json',
        method: "post",
        data: {
            tipo: 1,
            cpf: cpf
        },
        url: '../valida/cpfcnpj.php',
        success: function(response){
            if (response.info == '2') {
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>CPF Inválido</p>');
                $('#alert-envio').show();
                $('body').scrollTop(0);
            }
        }
     });
}
function ValidaCEP(){
    var cep = $('#cep').val();
    $.ajax({
        dataType: 'json',
        method: "post",
        data: {
            cep: cep
        },
        url: '../valida/buscaCep_curl.php',
        success: function(response){
            if(response.logradouro !== ''){
                $('#endereco').val(response.logradouro);
                $('#estados').val(response.uf);
                $('#cidades').val(response.cidade);
                $('#bairro').val(response.bairro);
            }else{
                $('#alert-envio').addClass('alert alert-danger');
                $('#alert-envio').html('<p>CEP Inválido</p>');
                $('#alert-envio').show();
                $('body').scrollTop(0);
            }
        }
     });
}

 function mascara(t, mask){
 var i = t.value.length;
 var saida = mask.substring(1,0);
 var texto = mask.substring(i)
 if (texto.substring(0,1) != saida){
 t.value += texto.substring(0,1);
 }
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
                            Cadastrar uma empresa
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Painel de controle</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Cadastro
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
                                <input class="form-control" id="razao" name="razao" placeholder="Razão Social">
                                <br>
                                <input class="form-control" id="cnpj" name="cnpj" onkeypress="mascara(this, '##.###.###/####-##')" maxlength="18" placeholder="CNPJ">
                                <br>
                                <input class="form-control" id="municipal" name="municipal" placeholder="Inscrição Municipal">
                                <br>
                                <input class="form-control" id="atividade" name="atividade" placeholder="Atividades desenvolvidas">
                                <br>
                                <input class="form-control" id="espece" name="espece" placeholder="Espece da atividade">                               
                                <br>
                                <input class="form-control" id="bairro" name="bairro" placeholder="Bairro">                   
                                <br>
                                <input type="text" placeholder="Digite o estado"  class="form-control" id="estados" name="estados">
                                <br>
                                <select class="form-control" id="pais" name="pais">
                                    <option selected="selected">Selecione o pais</option>
                                    <option value="Brasil">Brasil</option>
                                    <option value="Afeganistão">Afeganistão</option>
                                    <option value="África do Sul">África do Sul</option>
                                    <option value="Albânia">Albânia</option>
                                    <option value="Alemanha">Alemanha</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antilhas Holandesas">Antilhas Holandesas</option>
                                    <option value="Antárctida">Antárctida</option>
                                    <option value="Antígua e Barbuda">Antígua e Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Argélia">Argélia</option>
                                    <option value="Armênia">Armênia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Arábia Saudita">Arábia Saudita</option>
                                    <option value="Austrália">Austrália</option>
                                    <option value="Áustria">Áustria</option>
                                    <option value="Azerbaijão">Azerbaijão</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrein">Bahrein</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benim">Benim</option>
                                    <option value="Bermudas">Bermudas</option>
                                    <option value="Bielorrússia">Bielorrússia</option>
                                    <option value="Bolívia">Bolívia</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgária">Bulgária</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Butão">Butão</option>
                                    <option value="Bélgica">Bélgica</option>
                                    <option value="Bósnia e Herzegovina">Bósnia e Herzegovina</option>
                                    <option value="Cabo Verde">Cabo Verde</option>
                                    <option value="Camarões">Camarões</option>
                                    <option value="Camboja">Camboja</option>
                                    <option value="Canadá">Canadá</option>
                                    <option value="Catar">Catar</option>
                                    <option value="Cazaquistão">Cazaquistão</option>
                                    <option value="Chade">Chade</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Chipre">Chipre</option>
                                    <option value="Colômbia">Colômbia</option>
                                    <option value="Comores">Comores</option>
                                    <option value="Coreia do Norte">Coreia do Norte</option>
                                    <option value="Coreia do Sul">Coreia do Sul</option>
                                    <option value="Costa do Marfim">Costa do Marfim</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Croácia">Croácia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Dinamarca">Dinamarca</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Egito">Egito</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>
                                    <option value="Equador">Equador</option>
                                    <option value="Eritreia">Eritreia</option>
                                    <option value="Escócia">Escócia</option>
                                    <option value="Eslováquia">Eslováquia</option>
                                    <option value="Eslovênia">Eslovênia</option>
                                    <option value="Espanha">Espanha</option>
                                    <option value="Estados Federados da Micronésia">Estados Federados da Micronésia</option>
                                    <option value="Estados Unidos">Estados Unidos</option>
                                    <option value="Estônia">Estônia</option>
                                    <option value="Etiópia">Etiópia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Filipinas">Filipinas</option>
                                    <option value="Finlândia">Finlândia</option>
                                    <option value="França">França</option>
                                    <option value="Gabão">Gabão</option>
                                    <option value="Gana">Gana</option>
                                    <option value="Geórgia">Geórgia</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Granada">Granada</option>
                                    <option value="Gronelândia">Gronelândia</option>
                                    <option value="Grécia">Grécia</option>
                                    <option value="Guadalupe">Guadalupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernesei">Guernesei</option>
                                    <option value="Guiana">Guiana</option>
                                    <option value="Guiana Francesa">Guiana Francesa</option>
                                    <option value="Guiné">Guiné</option>
                                    <option value="Guiné Equatorial">Guiné Equatorial</option>
                                    <option value="Guiné-Bissau">Guiné-Bissau</option>
                                    <option value="Gâmbia">Gâmbia</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungria">Hungria</option>
                                    <option value="Ilha Bouvet">Ilha Bouvet</option>
                                    <option value="Ilha de Man">Ilha de Man</option>
                                    <option value="Ilha do Natal">Ilha do Natal</option>
                                    <option value="Ilha Heard e Ilhas McDonald">Ilha Heard e Ilhas McDonald</option>
                                    <option value="Ilha Norfolk">Ilha Norfolk</option>
                                    <option value="Ilhas Cayman">Ilhas Cayman</option>
                                    <option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
                                    <option value="Ilhas Cook">Ilhas Cook</option>
                                    <option value="Ilhas Feroé">Ilhas Feroé</option>
                                    <option value="Ilhas Geórgia do Sul e Sandwich do Sul">Ilhas Geórgia do Sul e Sandwich do Sul</option>
                                    <option value="Ilhas Malvinas">Ilhas Malvinas</option>
                                    <option value="Ilhas Marshall">Ilhas Marshall</option>
                                    <option value="Ilhas Menores Distantes dos Estados Unidos">Ilhas Menores Distantes dos Estados Unidos</option>
                                    <option value="Ilhas Salomão">Ilhas Salomão</option>
                                    <option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
                                    <option value="Ilhas Virgens Britânicas">Ilhas Virgens Britânicas</option>
                                    <option value="Ilhas Åland">Ilhas Åland</option>
                                    <option value="Indonésia">Indonésia</option>
                                    <option value="Inglaterra">Inglaterra</option>
                                    <option value="Índia">Índia</option>
                                    <option value="Iraque">Iraque</option>
                                    <option value="Irlanda do Norte">Irlanda do Norte</option>
                                    <option value="Irlanda">Irlanda</option>
                                    <option value="Irã">Irã</option>
                                    <option value="Islândia">Islândia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Itália">Itália</option>
                                    <option value="Iêmen">Iêmen</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japão">Japão</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordânia">Jordânia</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Lesoto">Lesoto</option>
                                    <option value="Letônia">Letônia</option>
                                    <option value="Libéria">Libéria</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lituânia">Lituânia</option>
                                    <option value="Luxemburgo">Luxemburgo</option>
                                    <option value="Líbano">Líbano</option>
                                    <option value="Líbia">Líbia</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Macedônia">Macedônia</option>
                                    <option value="Madagáscar">Madagáscar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Maldivas">Maldivas</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Malásia">Malásia</option>
                                    <option value="Marianas Setentrionais">Marianas Setentrionais</option>
                                    <option value="Marrocos">Marrocos</option>
                                    <option value="Martinica">Martinica</option>
                                    <option value="Mauritânia">Mauritânia</option>
                                    <option value="Maurícia">Maurícia</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Moldávia">Moldávia</option>
                                    <option value="Mongólia">Mongólia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Moçambique">Moçambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="México">México</option>
                                    <option value="Mônaco">Mônaco</option>
                                    <option value="Namíbia">Namíbia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Nicarágua">Nicarágua</option>
                                    <option value="Nigéria">Nigéria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Noruega">Noruega</option>
                                    <option value="Nova Caledônia">Nova Caledônia</option>
                                    <option value="Nova Zelândia">Nova Zelândia</option>
                                    <option value="Níger">Níger</option>
                                    <option value="Omã">Omã</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestina">Palestina</option>
                                    <option value="Panamá">Panamá</option>
                                    <option value="Papua-Nova Guiné">Papua-Nova Guiné</option>
                                    <option value="Paquistão">Paquistão</option>
                                    <option value="Paraguai">Paraguai</option>
                                    <option value="País de Gales">País de Gales</option>
                                    <option value="Países Baixos">Países Baixos</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Polinésia Francesa">Polinésia Francesa</option>
                                    <option value="Polônia">Polônia</option>
                                    <option value="Porto Rico">Porto Rico</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Quirguistão">Quirguistão</option>
                                    <option value="Quênia">Quênia</option>
                                    <option value="Reino Unido">Reino Unido</option>
                                    <option value="República Centro-Africana">República Centro-Africana</option>
                                    <option value="República Checa">República Checa</option>
                                    <option value="República Democrática do Congo">República Democrática do Congo</option>
                                    <option value="República do Congo">República do Congo</option>
                                    <option value="República Dominicana">República Dominicana</option>
                                    <option value="Reunião">Reunião</option>
                                    <option value="Romênia">Romênia</option>
                                    <option value="Ruanda">Ruanda</option>
                                    <option value="Rússia">Rússia</option>
                                    <option value="Saara Ocidental">Saara Ocidental</option>
                                    <option value="Saint Martin">Saint Martin</option>
                                    <option value="Saint-Barthélemy">Saint-Barthélemy</option>
                                    <option value="Saint-Pierre e Miquelon">Saint-Pierre e Miquelon</option>
                                    <option value="Samoa Americana">Samoa Americana</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="Santa Helena, Ascensão e Tristão da Cunha">Santa Helena, Ascensão e Tristão da Cunha</option>
                                    <option value="Santa Lúcia">Santa Lúcia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serra Leoa">Serra Leoa</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Singapura">Singapura</option>
                                    <option value="Somália">Somália</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Suazilândia">Suazilândia</option>
                                    <option value="Sudão">Sudão</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Suécia">Suécia</option>
                                    <option value="Suíça">Suíça</option>
                                    <option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
                                    <option value="São Cristóvão e Nevis">São Cristóvão e Nevis</option>
                                    <option value="São Marino">São Marino</option>
                                    <option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
                                    <option value="São Vicente e Granadinas">São Vicente e Granadinas</option>
                                    <option value="Sérvia">Sérvia</option>
                                    <option value="Síria">Síria</option>
                                    <option value="Tadjiquistão">Tadjiquistão</option>
                                    <option value="Tailândia">Tailândia</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tanzânia">Tanzânia</option>
                                    <option value="Terras Austrais e Antárticas Francesas">Terras Austrais e Antárticas Francesas</option>
                                    <option value="Território Britânico do Oceano Índico">Território Britânico do Oceano Índico</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Toquelau">Toquelau</option>
                                    <option value="Trinidad e Tobago">Trinidad e Tobago</option>
                                    <option value="Tunísia">Tunísia</option>
                                    <option value="Turcas e Caicos">Turcas e Caicos</option>
                                    <option value="Turquemenistão">Turquemenistão</option>
                                    <option value="Turquia">Turquia</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Ucrânia">Ucrânia</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Uruguai">Uruguai</option>
                                    <option value="Uzbequistão">Uzbequistão</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vaticano">Vaticano</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietname">Vietname</option>
                                    <option value="Wallis e Futuna">Wallis e Futuna</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                    <option value="Zâmbia">Zâmbia</option>
                                </select>                                
                                <br>
                                <h1>Representante legal</h1>
                                <input class="form-control" id="representante" name="representante" placeholder="Nome do Representante Legal">
                                <br>
                                <input class="form-control" id="email" type="email" name="end1" placeholder="Email">
                                <br>
                                <input class="form-control" id="cpf" name="cpf" onkeypress="mascara(this, '###.###.###-##')" maxlength="14" placeholder="CPF do representante">
                                <br>
                                <input class="form-control" id="telrepre" name="telrepre" onkeypress="mascara(this, '## #####-####')" maxlength="13" placeholder="Telefone do representante">

                            </div>

                    </div>

                    <div class="col-lg-6">

                        <input class="form-control" id="fantasia" name="fantasia" placeholder="Nome de Fantasia">
                        <br>
                        <input class="form-control" id="estadual" name="estadual" placeholder="Inscrição Estadual">
                        <br>
                        <input class="form-control" id="dataconst" name="dataconst" onkeypress="mascara(this, '##/##/#####')" maxlength="10" placeholder="Data de sua constituição">
                        <br>
                        <input class="form-control" id="genero" name="genero" placeholder="Gênero da atividade">
                        <br>
                        <input type="text" class="form-control" id="cep" name="cep" onchange="ValidaCEP()" onkeypress="mascara(this, '#####-###')" maxlength="9" placeholder="CEP">
                        <br>
                        <input class="form-control" id="endereco" name="endereco" placeholder="Endereço">
                        <br>
                        <input type="text" placeholder="Digite a cidade" class="form-control" id="cidades" name="cidades">
                            <br>
                            <input class="form-control" id="tel" name="tel" onkeypress="mascara(this, '## ####-####')" maxlength="12" placeholder="Telefone">
                            </div>
                            <div class="col-lg-12">
                            <button type="submit" class="btn btn-lg btn-primary">Cadastrar</button>
                            <button type="reset" class="btn btn-lg btn-default">Limpar campos</button>
                            </div>
                        </form>

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
<script>
$.getJSON('js/estados_cidades.json', function (data) {
    var items = [];
    var options = '<option value="">escolha um estado</option>';  
    $.each(data, function (key, val) {
        options += '<option value="' + val.sigla + '">' + val.nome + '</option>';
    });                 
    $("#estados").html(options);                
    
    $("#estados").change(function () {              
    
        var options_cidades = '';
        var str = "";                   
        
        $("#estados option:selected").each(function () {
            str += $(this).text();
        });
        
        $.each(data, function (key, val) {
            if(val.nome == str) {                           
                $.each(val.cidades, function (key_city, val_city) {
                    options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                });                         
            }
        });
        $("#cidades").html(options_cidades);
        
    }).change();        

});
</script>
</html>
