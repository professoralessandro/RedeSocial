-- COGIGO PARA MUDAR OS CARACTERES DO BANCO PARA RECONHECER PT-BR
-- ALTER DATABASE `sua_base` CHARSET = Latin1 COLLATE = latin1_swedish_ci;

-- -----------------------------------------------------
-- Table `mydb`.`tbLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chayds_teste`.`tbLog` (
  `idLog` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `dataHora` DATE,
  `acao` INT NOT NULL,
  `comentLog` VARCHAR(250),
  PRIMARY KEY (`idLog`)
  )
GO
INSERT INTO tb_usuario VALUES(1,'Alessandro dos Santos','12345678910','1990-03-28',curdate(),'M','alessandro@chayds.com.br','Gerente administrador','013','33424849','Rua Dona Risoleta de Moraes N28','Casa A','Jardim Progresso','Guaruja','SP','1463-080','123456'),
(2,'Funcionario teste','12345678101','1990-03-28',curdate(),'M','teste@teste.com','Teste','013','33424849','Rua Dona Risoleta de Moraes N28','Casa A','Jardim Progresso','Guaruja','SP','1463-080','123456'),
(3,'Everton Chayd','12345678151','1990-03-28',curdate(),'M','everton_chayd@chayds.com.br','Gerente administrador','013','33424849','Rua Dona Risoleta de Moraes N28','Casa A','Jardim Progresso','Guaruja','SP','1463-080','123456')
GO
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;