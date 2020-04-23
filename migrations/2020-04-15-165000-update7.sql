CREATE TABLE `indique`.`observation_indication` ( 
    `uuid_indication` VARCHAR(45) NOT NULL , 
    `status` TINYINT NOT NULL , 
    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `observation` VARCHAR(255) NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `indique`.`observation_indication` ADD PRIMARY KEY (`uuid_indication`, `status`, `create_time`);

ALTER TABLE `indications` ADD `observation` VARCHAR(255) NULL AFTER `end_date`;

ALTER TABLE `observation_indication` ADD CONSTRAINT `uuid_indaication_fk` FOREIGN KEY (`uuid_indication`) REFERENCES `indications`(`uuid`) ON DELETE CASCADE ON UPDATE CASCADE

ALTER TABLE `indications` DROP FOREIGN KEY `fk_indications_service_uuid`; ALTER TABLE `indications` ADD CONSTRAINT `fk_indications_service_uuid` FOREIGN KEY (`service_uuid`) REFERENCES `services`(`uuid`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `indications` ADD `telefone2` VARCHAR(45) NULL DEFAULT NULL AFTER `telefone`;

ALTER TABLE `indications` CHANGE `cpf_cnpj` `cpf_cnpj` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

ALTER TABLE `indications` ADD `cargo` VARCHAR(45) NOT NULL AFTER `name_responsavel`;
