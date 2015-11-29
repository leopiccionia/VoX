<?php require COMMOM_PATH . 'user_logged_confirmation.php' ?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX - Cadastro de pauta</title>
		<?php require ASSETS_PATH . 'header.php'; ?>
	</head>
	<body>
        <?php require ASSETS_PATH . 'navbar.php'; ?>
	    <?php require COMMOM_PATH . 'error_message.php'; ?>
    	<div class="container main-container">
            <h1>Cadastro de pauta</h1>
            <form action="/cadastrar_pauta" method="post">
                <div class="form-group">
                    <label for="titulo">Título [obrigatório]</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título da votação" required />
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea rows="4" id="descricao" name="descricao" class="form-control" placeholder="Descrição da votação"></textarea>
                </div>
                <div class="form-group">
                    <label for="data_inicio">Data de início</label>
                    <input id="data_inicio" name="data_inicio" class="form-control datepicker" placeholder="DD-MM-YYYY" required />
                </div>
                <div class="form-group">
                    <label for="data_fim">Data de fim</label>
                    <input id="data_fim" name="data_fim" class="form-control datepicker" placeholder="DD-MM-YYYY" required />
                </div>
            	<button class="btn btn-primary">Cadastrar</button>
            </form>
    	</div>
    </body>
</html>