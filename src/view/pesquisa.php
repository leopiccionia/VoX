<?php require COMMOM_PATH . 'user_logged_confirmation.php' ?>
<!DOCTYPE html>
<html>
	<head>
		<title>VoX - Pesquisa de pauta</title>
		<?php require ASSETS_PATH . 'header.php'; ?>
	</head>
	<body>
        <?php require ASSETS_PATH . 'navbar.php'; ?>
        <?php require COMMOM_PATH . 'error_message.php'; ?>
    	<div class="container main-container">
            <h1>Pesquisa de pauta</h1>
            <form action="/pesquisar_pauta" method="post">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="descricao">Título</label>
                        <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Parte ou título inteiro da pauta" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="data_inicio">Data de início</label>
                        <input id="data_inicio" name="data_inicio" class="form-control datepicker" placeholder="DD-MM-YYYY" />
                    </div>
                    <div class="col-sm-6">
                        <label for="data_fim">Data de fim</label>
                        <input id="data_fim" name="data_fim" class="form-control datepicker" placeholder="DD-MM-YYYY" />
                    </div>
                </div>
            	<button class="btn btn-primary">Buscar</button>
            </form>
    	</div>
    </body>
</html>