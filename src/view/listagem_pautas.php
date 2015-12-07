<?php 
	require_once MODEL_PATH . '/pauta.php';
	require COMMOM_PATH . 'user_logged_confirmation.php';

	$lista_vazia = false;
	$contador = 1;

	if(!isset($_SESSION['lista_pautas']) || (empty($_SESSION['lista_pautas'])))
		$lista_vazia = true;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>VoX - Listagem de pautas</title>
		<?php require ASSETS_PATH . 'header.php'; ?>
	</head>
	<body>
        <?php require ASSETS_PATH . 'navbar.php'; ?>
	    <?php require COMMOM_PATH . 'error_message.php'; ?>
    	<div class="container main-container">
            <h1>Pautas Encontradas</h1>
            <?php if($lista_vazia): ?>
            	<p>Nenhuma pauta pôde ser encontrada!</p>
			<?php else: ?>
				<div class="lista-pautas">
					<?php foreach ($_SESSION['lista_pautas'] as $pauta): ?>
						<ul>
							<li class="item-lista-pautas">
								<div>
									<span class="titulo-pauta"><?= $contador++ . '. ' . $pauta->titulo; ?></span>
									<form method="post" action="/votacao">
										<input type="hidden" value="<?= $pauta->pauta_id; ?>" name="pauta_id" id="pauta_id"/>
										<button class="btn btn-success">Detalhes</button>
									</form>
								</div>
								<div class="descricao-pauta">
									<span><?= $pauta->descricao; ?></span>
								</div>
							</li>
						</ul>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
    	</div>
    </body>
</html>

