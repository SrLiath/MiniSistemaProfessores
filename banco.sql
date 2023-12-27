CREATE DATABASE brasa;
CREATE USER 'stage'@'localhost' IDENTIFIED BY 't5r4e3';
GRANT ALL PRIVILEGES ON brasa.* TO 'stage'@'localhost';
FLUSH PRIVILEGES;
USE brasa;
CREATE TABLE professores(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login varchar(255) unique,
    nome varchar(100),
    materia varchar(100),
    password varchar(255)
);
CREATE TABLE postagem(
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome varchar(100),
    email varchar(100),
    nascimento varchar(8),
    wpp varchar(35),
    cidade varchar(35),
    estado char(2),
    mensagem varchar(300),
    resposta varchar(300),
    data timestamp DEFAULT CURRENT_TIMESTAMP,
    status varchar(10),
    professor_id int,
    cod varchar(100),
    FOREIGN KEY (professor_id) REFERENCES professores(id)
);
INSERT INTO professores(materia, login, password, nome) VALUES ('portugues', 'prof', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'regiane');
INSERT INTO professores(materia, login, password, nome) VALUES ('ciencias', 'profa', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'magali');
INSERT INTO professores(materia, login, password, nome) VALUES ('matematica', 'profe', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'joao');
