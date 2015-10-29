<?php
	require_once 'controllers/usuario.php';

	session_start();
	$_SESSION['usuario'] = new Usuario();
	$erro_login = !$_SESSION['usuario']->login($_POST['login_credencial'], $_POST['login_senha']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX</title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
		<?php
			require 'helpers/persistencia.php';
			$credencial = $_POST['login_credencial'];
			$senha = $_POST['login_senha'];
			$erro_login = false;
			
			try{
				$resultado = array();
				if(filter_var($credencial, FILTER_VALIDATE_EMAIL))
					$resultado = loginPorEmail($credencial, $senha);
				else
					$resultado = loginPorNome($credencial, $senha);
					
				if($resultado['logado'] == true){
					session_start();
					$_SESSION['logado'] = true;
					$_SESSION['id'] = $resultado['id'];
				}
				else
					$erro_login = true;
			}
			catch(Exception $erro){
				echo '<div class="alert alert-danger">Erro: ' . $erro->getMessage() .'.</div>';
				$erro_login = true;
			}
			
			if($erro_login): ?>
				<div class="container main-container">
					<h1>Erro de login</h1>
					<p>Não foi possível completar o login no sistema. Para tentar novamente, retorne à <a href="index.php">página anterior</a>.</p>
				</div>
			<?php else:
				header('Location: home.php');
				die();
			endif;
		?>  
	</body>
</html>