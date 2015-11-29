<?php
	require_once MODEL_PATH . 'opcao_pauta.php';
	require_once VALIDATORS_PATH . 'opcaoPautaValidator.php';
	require USER_LOGGED;
	
	if(!isset($_SESSION['pauta']))
	{
	    header('Location: /pauta');
	    die();
	}
	
    $opcao_pauta = new OpcaoPauta($_POST['titulo'], $_POST['descricao'], $_SESSION['pauta']);
    $validator = new OpcaoPautaValidator($opcao_pauta);
    $erros_validacao = $validator->validar_informacoes();

    if(empty($erros_validacao))
    {
		if($opcao_pauta->cadastrar())
	    {
	    	$_SESSION['success'] = 'Opção de pauta salta com sucesso!';
	    	header('Location: /opcao_pauta');
	        die();
	    }
	    $erros_validacao = 'Um erro interno impediu a criação da opção.';
    }

    $_SESSION['erros_validacao'] = $erros_validacao;
    header('Location: /opcao_pauta');
    exit();
