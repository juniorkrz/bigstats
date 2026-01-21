ALTER TABLE `instagram_account`
	ADD COLUMN `password` VARCHAR(100) NOT NULL DEFAULT '0' AFTER `username`,
	DROP COLUMN `password`;
