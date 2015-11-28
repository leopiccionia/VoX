<?php
	require_once MODEL_PATH . 'usuario.php';
	require_once VALIDATORS_PATH . 'cadastroValidator.php';

	session_start();
	$usuario = new Usuario(mysql_escape_string($_POST['cadastro_usuario']), mysql_escape_string($_POST['cadastro_email']), $_POST['cadastro_senha'], $_POST['cadastro_senha_repetida']);
	$cadastro = new CadastroValidator($usuario);

	$mensagens_erro = array();
	$mensagens_erro = $cadastro->validar_informacoes();
	$sucesso_cadastro = false;

	if(empty($mensagens_erro))
		$sucesso_cadastro = $usuario->cadastrar();
	
	if(!$sucesso_cadastro)
	{
		$_SESSION['erros_validacao'] = $mensagens_erro;
		header('Location: /index.php');
		exit();
	}
	else
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
		<?php if($sucesso_cadastro): ?>
			<h1>Cadastro bem-sucedido!</h1>
			<p>Seu cadastro foi completado com sucesso! Favor, aguarde o envio do e-mail de confirmação.</p>
		<?php endif; ?>
	</div>
</body>
</html>