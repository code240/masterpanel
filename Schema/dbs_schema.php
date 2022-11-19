<?php


$dbs_schema = 
"CREATE TABLE `dbs` 
( 
`id` INT NOT NULL AUTO_INCREMENT , 
`db` VARCHAR(100) NOT NULL , 
`servername` VARCHAR(150) NOT NULL , 
`db_user` VARCHAR(100) NOT NULL , 
`psw` VARCHAR(200) NOT NULL , 
`active` INT(3) NOT NULL ,
`connect_by` VARCHAR(50) NOT NULL,
PRIMARY KEY (`id`)
)";

?>