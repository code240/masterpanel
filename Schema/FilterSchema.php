<?php

$filter_schema = 
"CREATE TABLE `filterx` 
( 
`id`  INT NOT NULL AUTO_INCREMENT  , 
`filtername` VARCHAR(40) NOT NULL , 
`filterQuery` VARCHAR(100) NOT NULL , 
`filterUser` VARCHAR(200) NOT NULL , 
`filterPsw` VARCHAR(100) NOT NULL ,
`createByUs` int(3) NOT NULL ,
`filterCreater` VARCHAR(50) NOT NULL, 
PRIMARY KEY (`id`)
)";

?>