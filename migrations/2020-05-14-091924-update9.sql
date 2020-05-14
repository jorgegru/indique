ALTER TABLE `indique`.`indications` ADD INDEX `user_uuid_index` (`user_uuid`);

ALTER TABLE `indique`.`indications` ADD INDEX `creator_uuid_index` (`creator_uuid`);

ALTER TABLE `contracts` ADD CONSTRAINT `fk_indication_contract_uuid` FOREIGN KEY (`indication_uuid`) 
REFERENCES `indications`(`uuid`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `commissions` ADD CONSTRAINT `fk_indication_commission_uuid` FOREIGN KEY (`indication_uuid`) 
REFERENCES `indications`(`uuid`) ON DELETE CASCADE ON UPDATE CASCADE;