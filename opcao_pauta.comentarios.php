<?
    session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: /index.php');
		die();
	}
	require_once 'opcao_pauta.php';
	require_once 'comentario.php';
    $opcao_pauta = new OpcaoPauta();
    $opcao_pauta->id = $_GET['id'];
    $comentarios = $opcao_pauta->obterComentarios();
    $num_comentarios = $opcao_pauta->contarComentarios();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX - <?= $num_comentarios ?> comentários</title>
		<?php require 'assets/header.php' ?>
	</head>
	<body>
	  	<div class="container main-container">
    	    <h1><?= $num_comentarios ?> comentários</h1>
    	    <?php foreach($comentarios as $comentario): ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><b><?= $comentario->autor_nome ?> enviou: </b></div>
                    <div class="panel-body"><?= $comentario->renderizar() ?></div>
                </div>
    	    <?php endforeach; ?>
    	</div>
    </body>
</html>