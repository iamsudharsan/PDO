CREATE DATABASE shopping;

use shopping;

CREATE TABLE productlist (
	productid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	product VARCHAR(30) NOT NULL,
	producttype VARCHAR(30) NOT NULL,
	prize INT(10)
);