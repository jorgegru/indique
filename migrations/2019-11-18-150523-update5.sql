ALTER TABLE `indications` ADD `value_commission` INT(11) NOT NULL DEFAULT '0000' AFTER `commission`;

ALTER TABLE `indications` ADD `end_date` DATE NULL DEFAULT NULL AFTER `value_commission`;

ALTER TABLE `indications` ADD `start_date` DATE NULL DEFAULT NULL AFTER `value_commission`;