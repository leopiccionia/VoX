CREATE DATABASE vox;
USE vox;

CREATE TABLE usuario(
    usuario_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha CHAR(40) NOT NULL,
    status CHAR(1) NOT NULL,
    PRIMARY KEY(usuario_id)
);

/*
    status:
        C - criado (cadastro realizado com sucesso)
        V - verificado (apos verificacao de e-mail)
        R - removido
*/

CREATE TABLE pauta(
    pauta_id INT NOT NULL AUTO_INCREMENT,
    autor_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_criacao DATE NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    PRIMARY KEY(pauta_id),
    FOREIGN KEY(autor_id) REFERENCES usuario(usuario_id)
);

CREATE TABLE opcao_pauta(
    opcao_id INT NOT NULL AUTO_INCREMENT,
    pauta_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    PRIMARY KEY(opcao_id),
    FOREIGN KEY(pauta_id) REFERENCES pauta(pauta_id)
);

CREATE TABLE comentario(
    comentario_id INT NOT NULL AUTO_INCREMENT,
    opcao_id INT NOT NULL,
    autor_id INT NOT NULL,
    conteudo TEXT NOT NULL,
    tipo CHAR(1) NOT NULL,
    curtidas INT NOT NULL DEFAULT 0,
    PRIMARY KEY(comentario_id),
    FOREIGN KEY(opcao_id) REFERENCES opcao_pauta(opcao_id),
    FOREIGN KEY(autor_id) REFERENCES usuario(usuario_id)
);

CREATE TABLE voto(
    voto_id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    opcao_id INT NOT NULL,
    data TIMESTAMP NOT NULL,
    PRIMARY KEY(voto_id),
    FOREIGN KEY(usuario_id) REFERENCES usuario(usuario_id),
    FOREIGN KEY(opcao_id) REFERENCES opcao_pauta(opcao_id)
);

CREATE TABLE abstencao(
    abstencao_id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    pauta_id INT NOT NULL,
    data TIMESTAMP NOT NULL,
    PRIMARY KEY(abstencao_id),
    FOREIGN KEY(usuario_id) REFERENCES usuario(usuario_id),
    FOREIGN KEY(pauta_id) REFERENCES pauta(pauta_id)
);

/*
    tipo:
        B - BBcode [reservado]
        T - texto
        V - video
        U - URL
        I - imagem [reservado]
*/