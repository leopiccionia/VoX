<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: /index.php');
		die();
	}

    require_once 'pauta.php';
    
    $pauta = new Pauta($_POST['titulo'], $_POST['descricao'], $_POST['data_inicio'], $_POST['data_fim']);
    $erro_validacao = false;
    $erro_cadastro = false;
    if($pauta->valida()){
        $pauta_id = $pauta->cadastra($_SESSION['usuario']->$id);
        if($pauta_id > 0){
            $_SESSION['pauta'] = $pauta_id;
            header('Location: /opcao_pauta.cadastro.php');
            die();
        }
        else
            $erro_cadastro = true;
    }
    else
        $erro_validacao = true;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX - Cadastro de pauta</title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
    	<?php require 'assets/navbar.php' ?>
    	<div class="container main-container">
    		<h1>Cadastro de pauta</h1>
    		<?php if($erro_validacao): ?>
    		    <p>Erro de validação. <a href="cadastro.php">Tente novamente</a>.</p>
    	    <?php elseif($erro_cadastro): ?>
    	        <p>Não foi possível completar o cadastro. <a href="cadastro.php">Tente novamente</a>.</p>
    	    <?php endif; ?>
    	</div>
    </body>
</html>