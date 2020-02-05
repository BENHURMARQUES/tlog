
CREATE SCHEMA IF NOT EXISTS `tlog` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `tlog`.`estados` (
  `id_estados` INT(11) NOT NULL AUTO_INCREMENT,
  `estado` VARCHAR(100) NULL DEFAULT NULL,
  `uf` VARCHAR(2) NULL DEFAULT NULL,
  `ibge` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id_estados`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tlog`.`cidades` (
  `id_cidades` INT(11) NOT NULL AUTO_INCREMENT,
  `id_estados` INT(11) NULL DEFAULT NULL,
  `cidade` VARCHAR(100) NULL DEFAULT NULL,
  `ibge` VARCHAR(20) NULL DEFAULT NULL,
  `populacao` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cidades`),
  INDEX `fk_cidades_estados_idx` (`id_estados` ASC),
  CONSTRAINT `fk_cidades_estados`
    FOREIGN KEY (`id_estados`)
    REFERENCES `tlog`.`estados` (`id_estados`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tlog`.`configura` (
  `id_configura` INT(11) NOT NULL AUTO_INCREMENT,
  `custo_pessoa` DECIMAL(30,2) NULL DEFAULT NULL,
  `qtd_corte_desc` INT(11) NULL DEFAULT NULL,
  `desc_pessoa_corte` DECIMAL(30,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_configura`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;