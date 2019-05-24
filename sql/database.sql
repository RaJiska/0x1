CREATE DATABASE nnullptr;
USE nnullptr;

GRANT ALL PRIVILEGES ON nnullptr.* TO 'nnullptr_user'@'%' IDENTIFIED BY 'passwd';

CREATE TABLE files (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	ip INT UNSIGNED,
	name VARCHAR(50) NOT NULL,
	size BIGINT UNSIGNED,
	original_name VARCHAR(100),
	creation_date BIGINT UNSIGNED,
	deletion_date BIGINT UNSIGNED,
	file_type VARCHAR(100),
	active TINYINT NOT NULL DEFAULT '1',
	PRIMARY KEY(id)
);