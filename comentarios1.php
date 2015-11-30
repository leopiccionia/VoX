<?php
    require_once MODEL_PATH . 'comentario.php';
    require_once MODEL_PATH . 'usuario.php';

    session_start();
	
    if(!isset($_SESSION['usuario']) || !isset($_GET['opcao_pauta'])){
		header('Location: /index.php');
		die();
	}
    
    $opcao_pauta = $_POST['opcao_pauta'];
    $comentario = new Comentario();
    $comentario->tipo = $_POST['tipo'];
    $comentario->conteudo = mysqli_escape_string($_POST['conteudo']);
    $comentario->autor = $_SESSION['usuario']->id;
    $comentario->opcao = $_GET['opcao_pauta'];
    $erro_validacao = false;
    $erro_cadastro = false;
    
    if($comentario->validar()){
        if($comentario->cadastrar()){
            header('Location: /comentarios.php?id=' .$_POST['opcao_pauta']);
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
		<title>VoX - Inserção de comentário</title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
    	<?php require 'assets/navbar.php' ?>
    	<div class="container main-container">
    		<h1>Inserção de comentário</h1>
    		<?php if($erro_validacao): ?>
    		    <p>Erro de validação. <a href="comentarios.php">Tente novamente</a>.</p>
    	    <?php elseif($erro_cadastro): ?>
    	        <p>Não foi possível cadastrar o comentário. <a href="comentarios.php">Tente novamente</a>.</p>
    	    <?php endif; ?>
    	</div>
    </body>
</html>