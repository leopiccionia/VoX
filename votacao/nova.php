<!DOCTYPE html>
<html>
	<head>
		<title>VoX</title>
		<?php require '../assets/header.php' ?>
	</head>
	<body>
        <form action="nova1.php" method="post">
            <div class="form-group">
                <label for="titulo">Título [obrigatório]</label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título da votação" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea rows="4" id="titulo" name="titulo" class="form-control" placeholder="Descrição da votação"></textarea>
            </div>
        	<input type="submit" class="btn btn-primary" value="Entrar">
        </form>
    </body>
</html>

<!--
    CREATE TABLE votacao(
        votacao_id INT NOT NULL AUTO_INCREMENT,
        autor_id INT NOT NULL,
        titulo VARCHAR(100) NOT NULL,
        descricao TEXT,
        data_criacao TIMESTAMP() NOT NULL,
        data_inicio TIMESTAMP() NOT NULL,
        data_fim TIMESTAMP() NOT NULL,
        abstencoes INT NOT NULL,
        PRIMARY KEY(votacao_id),
        FOREIGN KEY(autor_id) REFERENCES usuario(usuario_id)
    );
-->