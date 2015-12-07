<?php
	require VALIDATORS_PATH . 'pesquisaValidator.php';
	require MODEL_PATH . 'query.php';
	require USER_LOGGED;

	if(isset($_POST['query_parcial']))
		$pesquisador = new Query($_POST['query_parcial']);
	else
		$pesquisador = new Query($_POST['titulo'], $_POST['data_inicio'], $_POST['data_fim']);

	$validador = new PesquisaValidator($pesquisador);
	$erros_validacao = $validador->validar_informacoes();

	if(empty($erros_validacao))
	{
		$_SESSION['lista_pautas'] = $pesquisador->pesquisar();
		header('Location: /listagem_pautas');
		exit();
	}

	$_SESSION['erros_validacao'] = $erros_validacao;

	if(isset($_POST['query_parcial']))
	{
	    header('Location: /home');
    	exit();
	}
	else
	{
		header('Location: /pesquisar');
    	exit();	
	}
