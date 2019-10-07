CREATE TABLE IF NOT EXISTS `indications` (
  `uuid` VARCHAR(45) NOT NULL,
  `cpf_cnpj` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `name_responsavel` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NULL,
  `bairro` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `complemento` VARCHAR(45) NULL,
  `status` TINYINT(1) NOT NULL,
  `commission` TINYINT(1) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service_uuid` VARCHAR(45) NOT NULL,
  `user_uuid` VARCHAR(45) NOT NULL,
  `company_uuid` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`uuid`),
  UNIQUE INDEX `cpf_cnpj_UNIQUE` (`cpf_cnpj` ASC),
  INDEX `fk_indications_service_uuid_idx` (`service_uuid` ASC),
  INDEX `fk_indications_user_uuid_idx` (`user_uuid` ASC),
  INDEX `fk_indications_company_uuid_idx` (`company_uuid` ASC),
  CONSTRAINT `fk_indications_service_uuid`
    FOREIGN KEY (`service_uuid`)
    REFERENCES `services` (`uuid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_indications_user_uuid`
    FOREIGN KEY (`user_uuid`)
    REFERENCES `users` (`uuid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_indications_company_uuid`
    FOREIGN KEY (`company_uuid`)
    REFERENCES `companies` (`uuid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;