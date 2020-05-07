ALTER TABLE `users` ADD `telefone` VARCHAR(15) NOT NULL AFTER `email`;

ALTER TABLE `indications` CHANGE `telefone` `telefone` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `indications` CHANGE `telefone2` `telefone2` VARCHAR(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;