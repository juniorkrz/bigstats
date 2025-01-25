ALTER TABLE `bbb_participante`
	ADD COLUMN `eliminado` TINYINT(1) NOT NULL DEFAULT 0 AFTER `nome`;

UPDATE `bbb_participante` SET `eliminado` = 1 WHERE `nome` = 'Arleane' OR `nome` = 'Marcelo';