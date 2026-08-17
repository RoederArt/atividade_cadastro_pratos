CREATE DATABASE cadastro_pratos;

use cadastro_pratos;

CREATE TABLE pratos(
    id_pratos INT PRIMARY KEY AUTO_INCREMENT,
    nome_pratos VARCHAR(40) NOT NULL,
    descrição_pratos TEXT NOT NULL,
    preço_pratos INT NOT NULL,
    categoria_pratos VARCHAR(40) NOT NULL
);

CREATE TABLE usuarios(
        id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        nome_usuario VARCHAR(40) NOT NULL,
        email_usuario VARCHAR(40) NOT NULL
);

