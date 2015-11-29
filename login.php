<?php
	require_once 'usuario.php';

	session_start();
	$_SESSION['usuario'] = new Usuario();
	$logado = $_SESSION['usuario']->login($_POST['login_credencial'], $_POST['login_senha']);

	if($logado){
		header('Location: /home.php');
		die();
	}
	else{
		$erro_login = 'O usuário ou senha não foram encontrados';
	}

?>
<!DOCTYPE html>

<html>
	<head>
		<title>VoX</title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
			<?php if(isset($erro_login)): ?>
				<div class="container main-container">
					<h1>Erro de login</h1>
					<p>Não foi possível completar o login no sistema. Para tentar novamente, retorne à <a href="index.php">página anterior</a>.</p>
				</div>
			<?php else: ?>
				Não foi possível redirecionar.
			<?php endif; ?>  
	</body>
</html>