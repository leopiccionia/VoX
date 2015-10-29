<?php
    require '../helpers/persistencia.php';
    require '../helpers/validacao/pauta.php';
    
    require '../controllers/pauta.php';
    
    $pauta = new Pauta($_POST['titulo'], $_POST['descricao'], $_POST['data_inicio'], $_POST['data_fim']);
    $erro_validacao = !$pauta->valida();
    
    $autor = $_SESSION['id'];
    cadastrarVotacao($titulo, $descricao, $data_inicio, $data_fim);
?>

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