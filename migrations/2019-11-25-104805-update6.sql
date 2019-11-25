CREATE TABLE `indique`.`commissions` ( 
    `uuid` VARCHAR(45) NOT NULL , 
    `paid` TINYINT(1) NOT NULL DEFAULT '1' , 
    `value_commission` INT(11) NOT NULL , 
    `date` DATE NOT NULL , 
    `observation` VARCHAR(255),
    `indication_uuid` VARCHAR(45) NOT NULL , PRIMARY KEY (`uuid`(45))) ENGINE = InnoDB;

ALTER TABLE `users` CHANGE `name` `name` VARCHAR(45)
CHARACTER SET utf8 COLLATE utf8_general/ci NOT NULL;


CREATE TABLE `indique`.`contracts` ( `uuid` VARCHAR(45) NOT NULL , 
    `corporate_name` VARCHAR(45) NOT NULL , 
    `value` INT(11) NOT NULL , 
    `date` DATE NOT NULL , 
    `user_uuid` VARCHAR(45) NOT NULL , 
    `observation` VARCHAR(255), 
    `indentification` VARCHAR(50) NOT NULL , 
    `indication_uuid` VARCHAR(45) NOT NULL , PRIMARY KEY (`uuid`(45))) ENGINE = InnoDB;