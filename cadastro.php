<?php
	require_once 'usuario.php';

	session_start();
	$usuario = new Usuario();
	
	$usuario->nome = $_POST['cadastro_usuario'];
	$usuario->email = $_POST['cadastro_email'];
	$usuario->senha = $_POST['cadastro_senha'];
	$usuario->senha2 = $_POST['cadastro_senha2'];

	$mensagens_erro = array();
	$mensagens_erro = $usuario->validar_informacoes();
	$sucesso_cadastro = false;

	if(!empty($mensagens_erro))
		$sucesso_cadastro = $usuario->cadastrar();
	
	if(!$sucesso_cadastro)
		array_push($mensagens_erro, 'Não foi possível realizar cadastro.');
	
	$_SESSION['usuario'] = $usuario;
?>

<!DOCTYPE html>
<html>
<head>
	<title>VoX</title>
	<?php require_once 'assets/header.php' ?>
</head>
<body>
	<?php require_once 'assets/navbar.php' ?>
	<div class="container main-container">
		<?php if(!$sucesso_cadastro): ?>
			<h1>Cadastro mal-sucedido!</h1>
			<p>Um ou mais erros ocorreram:</p>
			<ul>
				<?php foreach($mensagens_erro as $mensagem): ?>
					<li><?= $mensagem ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="alert alert-danger">Retorne à <a href="index.php">página anterior</a> para corrigir os erros.</div>
		<?php else:	?>
			<h1>Cadastro bem-sucedido!</h1>
			<p>Seu cadastro foi completado com sucesso! Favor, aguarde o envio do e-mail de confirmação.</p>
		<?php endif; ?>
	</div>
</body>
</html>