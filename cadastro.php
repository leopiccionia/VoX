<?php
    $usuario = $_POST['cadastro_usuario'];
    $email = $_POST['cadastro_email'];
    $senha = $_POST['cadastro_senha'];
    $senha2 = $_POST['cadastro_senha2'];
    
    $erro_preenchimento = false;
    $mensagem_erro = array();
    
    if(empty($usuario)){
        $erro_preenchimento = true;
        array_push($mensagem_erro, 'Nome de usuário em branco.');
    }
    
    if(empty($email)){
        $erro_preenchimento = true;
        array_push($mensagem_erro, 'E-mail em branco.');
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro_preenchimento = true;
        array_push($mensagem_erro, 'E-mail inválido.');
    }
    else{
        $config_file = file_get_contents("assets/public.json");
        $config_json = json_decode($config_file, true);
        $allow_domain = $config_json['config']['allow_domain'];
        if($allow_domain != explode('@', $email)[1]){
            $erro_preenchimento = true;
            array_push($mensagem_erro, 'E-mail não pertence ao domínio "' .$allow_domain .'".');
        }
    }
    
    if(empty($senha) || empty($senha2)){
        $erro_preenchimento = true;
        array_push($mensagem_erro, 'Senha deve ser repetida.');
    }
    else if($senha != $senha2){
        $erro_preenchimento = true;
        array_push($mensagem_erro, 'Senhas não batem.');
    }

    if($erro_preenchimento){
        echo '<p>Um ou mais erros encontrados:</p><ul>';
        foreach($mensagem_erro as $erro){
            echo '<li>' .$erro .'</li>';
        }
        echo '</ul>';
        echo '<p>Retorne à <a href="index.php">página anterior</a> para corrigir os erros.</p>';
    }
    else{
        /* Cadastrar */
        echo '<p>Sucesso, filhão!</p>';
    }
?>