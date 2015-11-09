<?php
	require_once '../controllers/usuario.php';
	echo '1';

	session_start();
	$usuario = new Usuario();
	$usuario->$nome = mysql_real_escape_string($_POST['cadastro_usuario']);
	$usuario->$email = mysql_real_escape_string($_POST['cadastro_email']);
	$usuario->$senha = $_POST['cadastro_senha'];
	$usuario->$senha2 = $_POST['cadastro_senha2'];

	echo '2';

	$mensagens_erro = array();
	array_push($mensagens_erro, $usuario->valida());
	if(!isset($mensagens_erro))
		$erro_cadastro = !($usuario->cadastra());
	if($erro_cadastro)
		array_push($mensagens_erro, 'Não foi possível realizar cadastro.');
	
	echo '3';
	
	$_SESSION['usuario'] = $usuario;
	echo '4';
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
		<?php if(isset($mensagens_erro)): ?>
			<h1>Cadastro mal-sucedido</h1>
			<p>Um ou mais erros encontrados:</p>
			<ul>
				<?php foreach($mensagens_erro as $mensagem_erro): ?>
					<li><?= $mensagem_erro ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="alert alert-danger">Retorne à <a href="index.php">página anterior</a> para corrigir os erros.</div>
		<?php else:	?>
			<h1>Cadastro bem-sucedido</h1>
			<p>Seu cadastro foi completado com sucesso. Use a barra superior para navegar no site.</p>
		<?php endif; ?>
	</div>
</body>
</html>