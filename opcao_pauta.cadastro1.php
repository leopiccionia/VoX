<?php
	require_once 'opcao_pauta.php';
	session_start();

	if(!isset($_SESSION['usuario']))
	{
		header('Location: /index.php');
		die();
	}
	
	if(!isset($_SESSION['pauta']))
	{
	    header('Location: /pauta.cadastro.php');
	    die();
	}
	
    $opcao_pauta = new OpcaoPauta($_POST['titulo'], $_POST['descricao'], $_SESSION['pauta']);
    if($opcao_pauta->cadastrar())
    {
    	header('Location: /opcao_pauta.cadastro.php');
        die();
    }
	
	echo 'Não foi possível realizar o cadastro com sucesso. <a href="opcao_cadastro.cadastro.html">Tente novamente.</a>';
