ALTER TABLE `indications` ADD `creator_uuid` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL AFTER `user_uuid`;

ALTER TABLE `indique`.`indications` ADD INDEX `fk_indications_users_uuid_idx` (`create_user_uuid`);

ALTER TABLE `indications` ADD CONSTRAINT `fk_indications_users_uuid` FOREIGN KEY (`creator_uuid`) REFERENCES `users`(`uuid`) ON DELETE RESTRICT ON UPDATE RESTRICT;