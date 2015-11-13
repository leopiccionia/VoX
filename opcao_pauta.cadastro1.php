<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: /index.php');
		die();
	}
	elseif(!isset($_SESSION['pauta'])){
	    header('Location: /pauta.cadastro.php');
	    die();
	}
	
	require_once 'opcao_pauta.php';
    $opcao_pauta = new OpcaoPauta($_POST['titulo'], $_POST['descricao'], $_SESSION['pauta']);
    if($opcao_pauta->cadastra()):
        header('Location: /opcao_pauta.cadastro.php');
        die();
    else: ?>
        Não foi possível realizar o cadastro com sucesso. <a href="opcao_cadastro.cadastro.html">Tente novamente.</a>
    <?php endif; ?>
?>