ALTER TABLE `indications` DROP FOREIGN KEY `fk_indications_user_uuid`;

ALTER TABLE `indications` DROP INDEX `fk_indications_user_uuid_idx`;

ALTER TABLE `indications` CHANGE `status` `status` TINYINT(1) NOT NULL DEFAULT '7';