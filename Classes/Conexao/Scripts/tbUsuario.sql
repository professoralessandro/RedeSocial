-- COGIGO PARA MUDAR OS CARACTERES DO BANCO PARA RECONHECER PT-BR
-- ALTER DATABASE `sua_base` CHARSET = Latin1 COLLATE = latin1_swedish_ci;

CREATE DATABASE redeTeste

-- -----------------------------------------------------
-- Table `redeTeste`.`tbUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `redeTeste`.`tbUsuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `dataNascimento` DATE,
  `dataCadastro` DATE,
  `email` VARCHAR(60) UNIQUE,
  `senha` VARCHAR(20),
  `nivelAcesso` VARCHAR(15),
  `ddd` VARCHAR(5),
  `telefone` VARCHAR(15),
  `sexo` VARCHAR(8),
  `imagem` VARCHAR(80),
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)
  )
GO
INSERT INTO tbUsuario VALUES(1,'Alessandro dos Santos','1990-03-28',curdate(),'alessandro@rede.com.br','123456','Gerente','013','33424849','M', '8aca6235-81fb-47c8-9f24-23a5a886bd1b.jpg'),
(2,'Lucas Santos','1990-03-28',curdate(),'lucas@rede.com.br','123456','Gerente','013','33424849','M', '8aca6235-81fb-47c8-9f24-23a5a886bd1b.jpg'),
(3,'Thiago','1990-03-28',curdate(),'thiago@rede.com.br','123456','Gerente','013','33424849','M', '8aca6235-81fb-47c8-9f24-23a5a886bd1b.jpg')
GO
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;