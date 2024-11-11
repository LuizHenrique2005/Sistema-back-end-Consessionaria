CREATE DATABASE concessionariaproj;

USE concessionariaproj;

CREATE TABLE funcionario(
id_func INT AUTO_INCREMENT PRIMARY KEY,
nome_completo VARCHAR(255) NOT NULL,
CPF VARCHAR(11) NOT NULL,
data_de_nascimento DATE NOT NULL,
telefone VARCHAR(15) NOT NULL,
email VARCHAR(60) NOT NULL,
senha VARCHAR(60) NOT NULL
);
CREATE TABLE cliente (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    E_mail VARCHAR(60) NOT NULL,
    Senha VARCHAR(20) NOT NULL,
    telefone VARCHAR(15) NOT NULL
);

CREATE TABLE Carros(
id_car INT AUTO_INCREMENT PRIMARY KEY,
Modelo VARCHAR(60) NOT NULL,
Ano VARCHAR(4) NOT NULL,
cambio VARCHAR(15) NOT NULL,
Combustivel VARCHAR(15) NOT NULL,
Cor VARCHAR(60) NOT NULL
);

CREATE TABLE usuarios(
id int primary key not null auto_increment,
nome VARCHAR(255) NOT NULL,
data_nascimento DATE NOT NULL,
E_mail VARCHAR(60) NOT NULL,
telefone VARCHAR(15) NOT NULL,
Senha VARCHAR(20) NOT NULL
);