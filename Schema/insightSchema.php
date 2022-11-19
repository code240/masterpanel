<?php
$insight_schema =  
"CREATE TABLE `traffic` 
( 
`id` INT NOT NULL AUTO_INCREMENT  , 
`newuser` INT(8) NOT NULL , 
`user` INT(8) NOT NULL , 
`day` INT(3) NOT NULL , 
`month` INT(3) NOT NULL ,
`year` INT(5) NOT NULL,
PRIMARY KEY (`id`)
)";

?>