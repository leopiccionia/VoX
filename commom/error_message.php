<?php

	if (session_status() == PHP_SESSION_NONE) 
    	session_start();

	$headerErro;

	if(isset($_SESSION['header_erro']))
		$headerErro = $_SESSION['header_erro'];
	else
		$headerErro = 'Não foi possível realizar o cadastro!';		
?>

<?php if(isset($_SESSION['erros_validacao'])): ?>
	<div class="alert alert-danger alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert">
	        <i class="glyphicon glyphicon-remove"></i>
	    </button>
	    <h2><?= $headerErro ?></h3>
	    <ul>
	        <?php foreach ($_SESSION['erros_validacao'] as $erro): ?>
	        	<li><?= $erro ?></li>
	        <?php endforeach; unset($_SESSION['erros_validacao']); ?>
	    </ul>
	</div>		
<?php endif; ?>

