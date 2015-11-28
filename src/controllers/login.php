<?php
	require_once APP_PATH . 'src/validators/loginValidator.php';
	session_start();

	$validador = new LoginValidator($_POST['login_credencial'], $_POST['login_senha']);
	$resultado = $validador->validar_dados_de_login();

	if(is_object($resultado))
	{
		$_SESSION['usuario'] = $resultado;
		header('Location: /home');
		die();
	}
	else{
		$_SESSION['header_erro'] = 'Não foi possível realizar o login!';
		$_SESSION['erros_validacao'] = array(0 => $resultado);
		header('Location: /index');
		exit();	
	}