-- COGIGO PARA MUDAR OS CARACTERES DO BANCO PARA RECONHECER PT-BR
-- ALTER DATABASE `sua_base` CHARSET = Latin1 COLLATE = latin1_swedish_ci;

-- -----------------------------------------------------
-- Table `mydb`.`tbLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chayds_teste`.`tbComentario` (
  `idComentario` INT NOT NULL AUTO_INCREMENT,
  `idPessoa` INT NULL,
  `idProduto` INT NULL,
  `isCompra` VARCHAR(5)  NULL,
  `nome` VARCHAR(50)  NULL,
  `data` DATE,
  `comentario` VARCHAR(350),
  PRIMARY KEY (`idComentario`)
  )
GO
INSERT INTO tbComentario VALUES(1,1,1,'true','Alessandro dos Santos',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds '),
(2,1,1,'true','Alessandro dos Santos',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds '),
(3,1,1,'true','Alessandro dos Santos',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds ')
GO
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;