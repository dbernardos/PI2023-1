CREATE DATABASE IF NOT EXISTS study_root;

USE study_root;

CREATE TABLE IF NOT EXISTS estudante(
  id_estudante INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  senha VARCHAR(60) NOT NULL,
  PRIMARY KEY (id_estudante)
);

CREATE TABLE IF NOT EXISTS assunto(
  id_assunto INT(11) NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(24) NOT NULL,
  resumo VARCHAR(300) NULL,
  id_estudante_fk INT(11) NOT NULL,
  FOREIGN KEY (id_estudante_fk) REFERENCES estudante(id_estudante),
  PRIMARY KEY (id_assunto)
);

CREATE TABLE IF NOT EXISTS anotacao(
  id_anotacao INT(11) NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(24) NOT NULL,
  conteudo TEXT NULL,
  id_assunto_fk INT(11) NOT NULL,
  FOREIGN KEY (id_assunto_fk) REFERENCES assunto(id_assunto),
  PRIMARY KEY (id_anotacao)
);
