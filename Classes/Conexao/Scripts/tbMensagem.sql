-- COGIGO PARA MUDAR OS CARACTERES DO BANCO PARA RECONHECER PT-BR
-- ALTER DATABASE `sua_base` CHARSET = Latin1 COLLATE = latin1_swedish_ci;

-- -----------------------------------------------------
-- Table `mydb`.`tbLog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `redeteste`.`tbComentario` (
  `idMensagem` INT NOT NULL AUTO_INCREMENT,
  `idDestinatario` INT NULL,
  `idUsuario` INT NULL,
  `NomeUsuario` VARCHAR(50) NULL,
  `emailUsuario` VARCHAR(60)  NULL,
  `dataHora` DATETIME NULL,
  `mensagem` TEXT(1500)  NULL,
  PRIMARY KEY (`idMensagem`)
  )
GO
INSERT INTO tbComentario VALUES(1,2,1,'Alessandro dos Santos', 'alessandro@rede.com.br',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds '),
(2,2,1,'Alessandro dos Santos', 'alessandro@rede.com.br',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds '),
(3,2,1,'Alessandro dos Santos', 'alessandro@rede.com.br',curdate(),'Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds Primeiro comentário de teste chayds ')
GO
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;