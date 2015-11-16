<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: /index.php');
		die();
	}
	require_once 'pauta.php';
	require_once 'usuario.php';
	require_once 'opcao_pauta.php';
	
	$pauta = new Pauta($_POST['pauta_id']);
	$opcoes = $pauta->opcoes();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX - <?= $pauta->titulo ?></title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
	    <?php require 'assets/navbar.php' ?>
    	<div class="container main-container">
    	    <h1><?= $pauta->titulo ?></h1>
    	    <p style="font-size: large;"><?= $pauta->descricao ?></p>
    	    <p>Pauta criada por <?= Usuario::nomeDoId($pauta->autor) ?> em <?= date_format($pauta->data_criacao, 'd/m/Y') ?>.</p>
    	    <form action="pauta.votacao1.php" method="post">
    	        <h2>Opções</h2>
    	        <input type="hidden" name="pauta" id="pauta" value="<?= $pauta->id ?>" />
    	        <?php foreach($opcoes as $opcao): ?>
    	            <h3><input type="radio" name="opcao" value="<?= $opcao->id ?>"><?= $opcao->titulo ?>" /></h3>
    	            <?php if(isset($opcao->descricao)): ?>
    	                <p><?= $opcao->descricao ?></p>
    	            <?php endif; ?>
    	        <?php endforeach; ?>
    	        <p><input type="radio" name="opcao" value="0" /> Abster-se</p>
    	        <input type="submit" value="Votar">
    	    </form>
    	</div>
    </body>
</html>