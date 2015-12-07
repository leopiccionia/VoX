<?php
	require_once MODEL_PATH . 'pauta.php';
	require_once MODEL_PATH . 'usuario.php';
	require_once MODEL_PATH . 'opcao_pauta.php';
    require_once USER_LOGGED;
	
	$pauta = Pauta::encontrar_pauta_por_id($_POST['pauta_id']);
	$opcoes = $pauta->buscar_opcoes_pauta($pauta->pauta_id);
    $myDateTime = DateTime::createFromFormat('Y-m-d', $pauta->data_criacao);
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
    	    <p>Pauta criada por <?= Usuario::nomeDoId($pauta->autor) ?> em <?= $myDateTime->format('d/m/Y') ?>.</p>
    	    <form action="pauta.votacao1.php" method="post">
    	        <h2>Opções</h2>
    	        <input type="hidden" name="pauta" id="pauta" value="<?= $pauta->id ?>" />
    	        <?php foreach($opcoes as $opcao): ?>
    	            <h3><input type="radio" name="opcao" value="<?= $opcao->id ?>"><?= $opcao->titulo ?>" /></h3>
    	            <?php if(isset($opcao->descricao)): ?>
    	                <p><?= $opcao->descricao ?></p>
    	            <?php endif; ?>
    	            <p><a href="opcao_pauta.comentarios?id=<?= $opcao->id ?>"><?= $opcao->contarComentarios() ?> comentários</a></p>
    	        <?php endforeach; ?>
    	        <p><input type="radio" name="opcao" value="0" /> Abster-se</p>
    	        <input type="submit" value="Votar">
    	    </form>
    	</div>
    </body>
</html>