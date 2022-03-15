<?php
function validaCPF($cpf = null) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}
 function ValidaCNPJ ( $cnpj ) {
    // Deixa o CNPJ com apenas nÃºmeros
    $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );
    
    // Garante que o CNPJ Ã© uma string
    $cnpj = (string)$cnpj;
    $cnpj =  str_pad($cnpj, 14, "0", STR_PAD_LEFT);
    // O valor original
    $cnpj_original = $cnpj;
    
    // Captura os primeiros 12 nÃºmeros do CNPJ
    $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );
    
    /**
     * MultiplicaÃ§Ã£o do CNPJ
     *
     * @param string $cnpj Os digitos do CNPJ
     * @param int $posicoes A posiÃ§Ã£o que vai iniciar a regressÃ£o
     * @return int O
     *
     */
    if ( ! function_exists('multiplica_cnpj') ) {
        function multiplica_cnpj( $cnpj, $posicao = 5 ) {
            // VariÃ¡vel para o cÃ¡lculo
            $calculo = 0;
            
            // LaÃ§o para percorrer os item do cnpj
            for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
                // CÃ¡lculo mais posiÃ§Ã£o do CNPJ * a posiÃ§Ã£o
                $calculo = $calculo + ( $cnpj[$i] * $posicao );
                
                // Decrementa a posiÃ§Ã£o a cada volta do laÃ§o
                $posicao--;
                
                // Se a posiÃ§Ã£o for menor que 2, ela se torna 9
                if ( $posicao < 2 ) {
                    $posicao = 9;
                }
            }
            // Retorna o cÃ¡lculo
            return $calculo;
        }
    }
    
    // Faz o primeiro cÃ¡lculo
    $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );
    
    // Se o resto da divisÃ£o entre o primeiro cÃ¡lculo e 11 for menor que 2, o primeiro
    // DÃ­gito Ã© zero (0), caso contrÃ¡rio Ã© 11 - o resto da divisÃ£o entre o cÃ¡lculo e 11
    $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );
    
    // Concatena o primeiro dÃ­gito nos 12 primeiros nÃºmeros do CNPJ
    // Agora temos 13 nÃºmeros aqui
    $primeiros_numeros_cnpj .= $primeiro_digito;
 
    // O segundo cÃ¡lculo Ã© a mesma coisa do primeiro, porÃ©m, comeÃ§a na posiÃ§Ã£o 6
    $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );
    $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );
    
    // Concatena o segundo dÃ­gito ao CNPJ
    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;
    
    // Verifica se o CNPJ gerado Ã© idÃªntico ao enviado
    if ( $cnpj === $cnpj_original ) {
        return true;
    }
}

if($_REQUEST['tipo'] == '1'){
	$validado = validaCPF($_REQUEST['cpf']);
	if($validado == true){
		echo json_encode(array("info" => 1));
	}else{
		echo json_encode(array("info" => 2));
	}
}elseif($_REQUEST['tipo'] == '2'){
	$validado = validaCNPJ($_REQUEST['cnpj']);
	if($validado == true){
		echo json_encode(array("info" => 1));
	}else{
		echo json_encode(array("info" => 2));
	}
}
?>