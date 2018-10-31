create database veiculos;
use veiculos;

drop table if exists opcional;
drop table if exists marca;
drop table if exists veiculo;
drop table if exists veiculo_adicional;
drop table if exists usuario;

create table usuario (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario varchar(100) NOT NULL,
    senha varchar(255) NOT NULL,
    INDEX `pk_usuario` (`id`)
);


CREATE TABLE `adicional` (
    `id` int not null auto_increment PRIMARY KEY,
    idUsuario int not null,
    `descricao` varchar(100) NOT NULL,
    INDEX `pk_opcional` (`id`),
    INDEX `fk_usuario_adicional` (`idUsuario`),
    CONSTRAINT `fk_usuario_adicional` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
);

CREATE TABLE `marca` (
    `id` int(11) not null auto_increment PRIMARY KEY,
    idUsuario int not null,
    descricao varchar(20),
    INDEX `pk_marca` (`id`),
    INDEX `fk_usuario_marca` (`idUsuario`),
    CONSTRAINT `fk_usuario_marca` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
);

CREATE TABLE `veiculo` (
	id int not null auto_increment PRIMARY KEY,
    idUsuario int not null,
    descricao varchar(60) not null,
    placa varchar(7) not null,
    codigoRenavam varchar(11) not null,
    anoModelo int(4) not null,
    anoFabricacao int(4) not null,
    cor varchar(20) not null,
    km int(6) not null,
    `marca` int(11),
    preco double(8,2) not null,
    precoFipe double(8,2) not null,
    INDEX `pk_veiculo` (`id`),
    INDEX `pk_usuario_veiculo` (`idUsuario`),
    INDEX `fk_marca_veiculo` (`marca`),
    CONSTRAINT `fk_marca_veiculo` FOREIGN KEY (`marca`) REFERENCES `marca` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_usuario_veiculo` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
);

CREATE TABLE `veiculo_adicional` (
    `idVeiculo` INT(11) NOT NULL,
    `idAdicional` INT(11) NOT NULL,
    INDEX `fk_veiculo_va` (`idVeiculo`),
    INDEX `fk_adicional_va` (`idAdicional`),
    CONSTRAINT `fk_veiculo_va` FOREIGN KEY (`idVeiculo`) REFERENCES `veiculo` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_adicional_va` FOREIGN KEY (`idAdicional`) REFERENCES `adicional` (`id`) ON DELETE CASCADE
);



