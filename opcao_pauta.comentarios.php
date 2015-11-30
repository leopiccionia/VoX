<?
    session_start();
	if(!isset($_SESSION['usuario']))){
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
		<script>
            $("#tipo").change(function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                switch(valueSelected){
                    case('T'):
                        $("textarea#conteudo").attr("placeholder", "Insira seu comentário aqui.");
                        break;
                    case('V'):
                        $("textarea#conteudo").attr("placeholder", "https://www.youtube.com/watch?v=y6120QOlsfU");
                        break;
                    case('U'):
                        $("textarea#conteudo").attr("placeholder", "http://www.w3.org/History/1989/proposal.html");
                        break;
                }
            });
		</script>
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
    	    <h2>Inserir novo comentário</h2>
    	    <form method="post" action="opcao_pauta.comentarios1.php">
    	        <input type="hidden" name="opcao_pauta" id="opcao_pauta" value="<?= $_GET['id'] ?>" />
    	        <div class="form-group">
    	           <label for="tipo">Tipo</label>
    	           <select name="tipo" id="tipo" class="form-control">
    	               <option value="T" selected>Texto</option>
    	               <option value="U">URL</option>
    	               <option value="V">Vídeo do Youtube</option>
    	           </select>
    	        </div>
    	        <div class="form-group">
    	            <label for="conteúdo">Conteúdo</label>
    	            <textarea class="form-control" name="conteudo" id="conteudo" rows="3" cols="50"></textarea>
    	        </div>
    	        <button type="submit" class="form-control">Enviar</button>
    	    </form>
    	</div>
    </body>
</html>