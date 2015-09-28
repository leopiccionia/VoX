<!DOCTYPE html>
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
        if(!empty($allow_domain) && $allow_domain != explode('@', $email)[1]){
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
    
?>
<html>
<head>
	<title>VoX</title>
	<?php require 'assets/header.php' ?>
</head>
<body>
    <?php require 'assets/navbar.php' ?>
    <div class="container main-container">
        <?php if($erro_preenchimento): ?>
            <h1>Cadastro mal-sucedido</h1>
            <p>Um ou mais erros encontrados:</p>
            <ul>
                <?php foreach($mensagem_erro as $erro): ?>
                    <li><?= $erro ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="alert alert-danger">Retorne à <a href="index.php">página anterior</a> para corrigir os erros.</div>
        <?php else: ?>
            <h1>Cadastro bem-sucedido</h1>
            <p>Seu cadastro foi completado com sucesso. Use a barra superior para navegar no site.</p>
        <?php endif; ?>
    </div>
</body>
</html>
