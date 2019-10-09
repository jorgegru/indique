ALTER TABLE `users` ADD `user_type` TINYINT(1) NOT NULL DEFAULT '4' AFTER `uuid`;

ALTER TABLE `users` ADD `status` TINYINT(1) NOT NULL DEFAULT '2' AFTER `cpf`;

ALTER TABLE `indications` ADD `status` TINYINT(1) NOT NULL AFTER `numero`;

ALTER TABLE `indications` ADD `commission` TINYINT(1) NOT NULL AFTER `status`;

ALTER TABLE `indications` ADD `service_uuid` VARCHAR(45) NOT NULL AFTER `create_time`;

CREATE INDEX `fk_indications_service_uuid_idx` ON `indications` (`service_uuid` ASC);

ALTER TABLE `indications` ADD CONSTRAINT `fk_indications_service_uuid`
                                FOREIGN KEY (`service_uuid`)
                                REFERENCES `services` (`uuid`)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE;


