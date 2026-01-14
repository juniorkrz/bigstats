ALTER TABLE `instagram_user`
	ADD COLUMN `is_verified` TINYINT(1) NOT NULL DEFAULT (0) AFTER `updated_at`;
