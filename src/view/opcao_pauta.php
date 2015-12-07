<?php 
	require USER_LOGGED;

	if(!isset($_SESSION['pauta']))
	{
	    header('Location: /pauta');
	    die();
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>VoX - Cadastro de opção</title>
		<?php require ASSETS_PATH . 'header.php' ?>
	</head>
	<body>
	    <?php require ASSETS_PATH . 'navbar.php' ?>
        <?php require COMMOM_PATH . 'error_message.php' ?>
        <?php require COMMOM_PATH . 'success_register.php' ?>
    	<div class="container main-container">
            <h1>Cadastro de opções da pauta</h1>
            <form action="/cadastrar_opcao_pauta" method="post">
                <div class="form-group">
                    <label for="titulo">Título [obrigatório]</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título da votação" required />
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea rows="4" id="descricao" name="descricao" class="form-control" placeholder="Descrição da votação"></textarea>
                </div>
             	<button class="btn btn-primary">Cadastrar</button>
            </form>
    	</div>
    </body>
</html>