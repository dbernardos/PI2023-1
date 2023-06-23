CREATE TABLE medicalsystem(

    idM INT NOT NULL AUTO_INCREMENT,
    telefone varchar (15),
    emailM varchar (500),
    
    PRIMARY KEY(idM)
);

/*INSERT INTO `medicalsystem`(`telefone`, `emailM`) VALUES ('+55 49999256787','medicalsystem@gmail.com')*/

CREATE TABLE usuario(

    id INT NOT NULL AUTO_INCREMENT,
 	nome varchar (50)NOT null,
    email varchar (50) NOT null,
    especialidade varchar (50) NOT null,
    CRM varchar (15) NOT null,
    senha varchar (100) NOT null,
    
    PRIMARY KEY(id)
);

/*INSERT INTO `usuario`(`Nome`, `Email`, `Especialidade`, `CRM`, `Senha`) VALUES ('Nefi','nefidavidl@gmail.com','Oftalmologia','00000101010','123')*/

USE medicalsystem;
CREATE TABLE relato (
    idR INT NOT NULL AUTO_INCREMENT,
    altura VARCHAR(10) NOT NULL,
    peso VARCHAR(10) NOT NULL,
    idade INT NOT NULL,
    sexo ENUM('Masculino', 'Femenino') NOT NULL,
    dataR DATE NOT NULL,
    titulo VARCHAR(500) NOT NULL,
    observacao VARCHAR(5000) NOT NULL,
    relatoD VARCHAR(10000) NOT NULL,
    doctor_id INT NOT NULL,
    PRIMARY KEY (idR),
    FOREIGN KEY (doctor_id) REFERENCES usuario (id)
);

    /*UPDATE relato SET dataR = STR_TO_DATE(dataR, '%d/%m/%Y');*/
