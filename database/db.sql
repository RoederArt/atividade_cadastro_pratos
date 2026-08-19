CREATE DATABASE cadastro_pratos;

use cadastro_pratos;

CREATE TABLE pratos(
    id_pratos INT PRIMARY KEY AUTO_INCREMENT,
    nome_pratos VARCHAR(100) NOT NULL,
    descrição_pratos TEXT NOT NULL,
    preço_pratos DECIMAL(10,2) NOT NULL,
    categoria_pratos VARCHAR(100) NOT NULL

    id_usuario int not null,
    foreign key (id_usuario) references usuarios(id_usuario)
);

CREATE TABLE usuarios(
        id_usuario INT PRIMARY KEY AUTO_INCREMENT,
        nome_usuario VARCHAR(100) NOT NULL,
        email_usuario VARCHAR(100) NOT NULL
);

