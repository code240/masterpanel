<?php


$authorities_schema = 
"CREATE TABLE authorities (
id INT NOT NULL AUTO_INCREMENT,
fullname VARCHAR(40) NOT NULL,
email_id VARCHAR(50) NOT NULL,
phone_number VARCHAR(30) NOT NULL,
user_password VARCHAR(50) NOT NULL,
unique_id VARCHAR(50) NOT NULL,
job_post VARCHAR(20) NOT NULL,
parent VARCHAR(50) NOT NULL,
block_status INT(3) NOT NULL, 
auth_power INT(3) NOT NULL ,
PRIMARY KEY (`id`)
)";

?>