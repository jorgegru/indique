ALTER TABLE `users` DROP FOREIGN KEY `fk_users_company_uuid`;

ALTER TABLE `users` DROP INDEX `fk_users_company_uuid_idx`;

ALTER TABLE `users` DROP `company_uuid`;



ALTER TABLE `indications` DROP FOREIGN KEY `fk_indications_company_uuid`;

ALTER TABLE `indications` DROP INDEX `fk_indications_company_uuid_idx`;

ALTER TABLE `indications` DROP `company_uuid`;