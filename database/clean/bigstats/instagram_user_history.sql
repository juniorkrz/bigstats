-- --------------------------------------------------------
-- Servidor:                     192.168.1.5
-- Versão do servidor:           10.11.14-MariaDB-0+deb12u2 - Debian 12
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela bigstats.instagram_user_history
DROP TABLE IF EXISTS `instagram_user_history`;
CREATE TABLE IF NOT EXISTS `instagram_user_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instagram_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `instagram_id` (`instagram_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Copiando dados para a tabela bigstats.instagram_user_history: ~100 rows (aproximadamente)
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(1, '2308757549', 'brenocora', 'Breno Corã', 'Participante do #BBB26\nBiologo | Modelo | Mestre em Biotecnologia\nAqui e Agora! Vamos sonhar juntos!!!\n#TeamBreno♟️', 14261, '2026-01-13 00:15:19');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(2, '19153869', 'brigidoneto', 'Brigido Neto | Mentor de Escolas', 'Participante do #BBB26 🔨🫰🏻\nEmpreendedor | Diretor de escola \nCEO @eusoucbn\n📧 brigido_comercial@g.globo', 26102, '2026-01-13 00:15:50');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(3, '1119316814', 'jordanaribmorais', 'Jordana Morais', 'BBB 26\n#TeamJordana 💖\nBrasília \nAdvogada e Modelo ⚖️✨\nContato comercial: \njordanamorais_comercial@g.globo', 123823, '2026-01-13 00:16:21');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(4, '290679950', 'marciele.albuquerque', 'Marciele Albuquerque', '#TimeMarciele BBB 26 🪇\nCultura • Arte • Dança \nCunhã Poranga do @boicaprichoso #Munduruku \n📧 marciele_comercial@g.globo', 822487, '2026-01-13 00:16:52');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(5, '208886025', 'maxiane', 'Maxiane Rodrigues', 'BBB26 🪞\n✉️maxiane_comercial@g.globo', 87909, '2026-01-13 00:17:23');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(6, '144825681', 'oxemarcelo', 'Marcelinho', 'PARTICIPANTE DO BBB26\nComercial: marcelo_comercial@g.globo\n#MarcelinhoNoBBB 🐦‍🔥\nNunca foi sorte, sempre foi Deus! \nMédico⚕️', 62932, '2026-01-13 00:17:54');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(7, '7506226814', 'pauloaaugustocm', 'Paulo Augusto Carvalhaes', 'BBB 26 • 🐎\nItaguaru-GO | Anápolis-GO\nMedicina Veterinária\ncomercial: pauloaugusto_comercial@g.globo', 361034, '2026-01-13 00:22:03');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(8, '6259159064', 'pedroespindolap', 'Pedro Henrique Espindola 🌹', 'PERFIL OFICIAL \nParticipante do #BBB26 \n🌹 | Vendedor ambulante\n💪🏼 | Tropa do pedro #TeamPedro\n📧 | contatoglobo@globo.com', 36060, '2026-01-13 00:22:34');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(9, '1586005548', 'samira_sagr', 'Sami Sagr 💋', 'PARTICIPANTE DO #BBB26 #TeamSamira 💋\n💋 Atendente de bar\n🐶 Mamãe do @lindolfo_sagr\n💌 samira_comercial@g.globo', 162560, '2026-01-13 00:23:05');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(10, '198554911', 'solangecouto', '𝐒𝐨𝐥𝐚𝐧𝐠𝐞 𝐂𝐨𝐮𝐭𝐨', 'Atriz • Participante BBB26\n📍 Agente @luizgwyer \n📩 luiz@luizgwyer.com.br\n🔎 Minhas Rede', 1123002, '2026-01-13 00:23:36');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(11, '35861145', 'jonassulzbach', 'JONΛS SULZBΛCH A+', '📍 São Paulo\n⚡ Co-founder @maha.play | @sunrizebr\n📩 contato@satorahal.com.br', 3233651, '2026-01-13 00:24:09');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(12, '52194825685', 'tiamilenabbb', 'Milena Moreira, a Tia Milena', '🎨 Perfil oficial da Milena Moreira, a Tia Milena\n⭐ Participante do BBB26\n🏡 Teófilo Otoni, nascida em Itambacuri (MG)\nmilena_comercial@g.globo', 46222, '2026-01-13 00:54:32');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(13, '1144859455', 'julianofloss', 'JULIANO FLOSS LUCATEL', '#BBB26 | #TeamFloss 🐉\nAURORA SOON⏳\nBABYLON & TENTEI 2k26\nOwner @flosscamp', 4365590, '2026-01-13 02:42:25');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(14, '1656675', 'henricastelli', 'Henri Castelli', 'Henri Castelli\nBBB26 | #TeamHenri 🎬\nVivendo um personagem que só eu conheço, ou não, eu mesmo!\n📧comercial@castellihenri.com.br', 2770296, '2026-01-13 02:42:56');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(15, '212283980', 'soualinecampos', 'Aline Campos 🔮', '#TeamAlineCampos #BBB26🔮 \nArte | Saúde física, mental | Beleza Contato@soualinecampos.com', 11281013, '2026-01-13 02:44:11');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(17, '3980959', 'anapaularenault', 'Ana Paula Renault 🥂', 'Olha elaaaa! 🥂\nAtivista e apresentadora.\n#TeamRenault | #BBB26', 2430023, '2026-01-13 02:45:12');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(19, '1548258336', 'babusantana', 'BABU SANTANA', 'ATOR| CANTOR| DIRETOR \n@gruponosdomorrooficial \n.\n📧: contato@babusantana.com\nartístico: sabrina.isnard@tingodelata.com.br\npubli: babu@mynd8.com.br', 4747453, '2026-01-13 02:46:14');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(20, '666973139', 'solvegaoficial', 'SOL VEGA ☀️', 'O fenômeno do BBB 4 agora no BBB 26! \nAtriz, empresária e cantora do hit “Iarnuou”.\n#TeamSol | #BBB26', 340666, '2026-01-13 02:46:46');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(23, '397205072', 'edilsonjogador', 'Edilson Capetinha', 'Edilson Capetinha ⚽ \nCamarote BBB26 \nPenta do Mundo🏆', 1135448, '2026-01-13 02:57:14');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(24, '30501027', 'sarahandrade', 'Sarah Andrade', 'Comunicadora | Empreendedora\nFalo sobre comportamento humano e escolhas...\nÀs vezes, tudo o que falta é olhar de perto. 🔎\n@simulaprox 📊 @ouseopya 💎', 7563721, '2026-01-13 02:57:46');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(25, '298028046', 'albertocowboy', 'Alberto Cowboy', 'BBB26 | #TeamCowboy 🤠\n19 anos depois, o Cowboy ainda é Cowboy', 14462, '2026-01-13 02:58:17');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(26, '2308757549', 'brenocora', 'Breno Corã', 'Participante do #BBB26\nBiologo | Modelo | Mestre em Biotecnologia\nAqui e Agora! Vamos sonhar juntos!!!\n#TeamBreno♟️', 17414, '2026-01-13 03:11:17');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(27, '19153869', 'brigidoneto', 'Brigido Neto | Mentor de Escolas', '#BrigiTeam BBB 26🔨\nEmpreendedorismo | Educação | Lifestyle\nDiretor e CEO do @eusoucbn\n📧 brigido_comercial@g.globo', 26987, '2026-01-13 03:11:49');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(28, '1119316814', 'jordanaribmorais', 'Jordana Morais', 'BBB 26\n#TeamJordana 💖\nBrasília \nAdvogada e Modelo ⚖️✨\nContato comercial: \njordanamorais_comercial@g.globo', 130228, '2026-01-13 03:12:20');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(29, '290679950', 'marciele.albuquerque', 'Marciele Albuquerque', '#TimeMarciele BBB 26 🪇\nCultura • Arte • Dança \nCunhã Poranga do @boicaprichoso #Munduruku \n📧 marciele_comercial@g.globo', 827208, '2026-01-13 03:12:51');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(30, '208886025', 'maxiane', 'Maxiane Rodrigues', 'Participante Pipoca BBB26 🪞\n#MaxianenoBBB26\n✉️ maxiane_comercial@g.globo.com\nUma potência sem filtro!', 92286, '2026-01-13 03:13:23');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(31, '144825681', 'oxemarcelo', 'Marcelinho', 'PARTICIPANTE DO BBB26\nComercial: marcelo_comercial@g.globo\n#MarcelinhoNoBBB 🐦‍🔥\nNunca foi sorte, sempre foi Deus! \nMédico⚕️', 66978, '2026-01-13 03:13:53');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(32, '7506226814', 'pauloaaugustocm', 'Paulo Augusto Carvalhaes', 'BBB 26 • 🐎\nItaguaru-GO | Anápolis-GO\nMedicina Veterinária\ncomercial: pauloaugusto_comercial@g.globo', 367099, '2026-01-13 03:14:24');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(33, '6259159064', 'pedroespindolap', 'Pedro Henrique Espindola 🌹', 'PERFIL OFICIAL \nParticipante do #BBB26 \n🌹 | Vendedor ambulante\n💪🏼 | Tropa do pedro #TeamPedro\n📧 | contatoglobo@globo.com', 42429, '2026-01-13 03:14:55');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(34, '1586005548', 'samira_sagr', 'Sami Sagr 💋', 'PARTICIPANTE DO #BBB26 #TeamSamira 💋\n💋 Atendente de bar\n🐶 Mamãe do @lindolfo_sagr\n💌 samira_comercial@g.globo', 183950, '2026-01-13 03:15:26');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(35, '198554911', 'solangecouto', '𝐒𝐨𝐥𝐚𝐧𝐠𝐞 𝐂𝐨𝐮𝐭𝐨', 'Atriz • Participante BBB26\n📍 Agente @luizgwyer \n📩 luiz@luizgwyer.com.br\n🔎 Minhas Rede', 1126951, '2026-01-13 03:15:57');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(36, '35861145', 'jonassulzbach', 'JONΛS SULZBΛCH A+', 'BBB26 | #TeamJonas 🤙🏻\n📧 contato@satorahal.com.br', 3249771, '2026-01-13 03:16:28');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(37, '52194825685', 'tiamilenabbb', 'Milena Moreira, a Tia Milena', '🎨 Perfil oficial da Milena Moreira, a Tia Milena\n⭐ Participante do BBB26\n🏡 Teófilo Otoni, nascida em Itambacuri (MG)\nmilena_comercial@g.globo', 48740, '2026-01-13 03:16:59');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(38, '1656675', 'henricastelli', 'Henri Castelli', 'Henri Castelli\nBBB26 | #TeamHenri 🎬\nVivendo um personagem que só eu conheço, ou não, eu mesmo!\n📧comercial@castellihenri.com.br', 2774477, '2026-01-13 11:22:02');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(39, '212283980', 'soualinecampos', 'Aline Campos 🔮', '#TeamAlineCampos #BBB26🔮 \nArte | Saúde física, mental | Beleza Contato@soualinecampos.com\n✨☯️Link da lista de transmissão⬇️✨', 11285547, '2026-01-13 11:23:04');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(40, '3980959', 'anapaularenault', 'Ana Paula Renault 🥂', 'Olha elaaaa! 🥂\nAtivista e apresentadora.\n#TeamRenault | #BBB26', 2462465, '2026-01-13 11:24:05');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(41, '1548258336', 'babusantana', 'BABU SANTANA', 'ATOR| CANTOR| DIRETOR \n@gruponosdomorrooficial \n.\n📧: contato@babusantana.com\nartístico: sabrina.isnard@tingodelata.com.br\npubli: babu@mynd8.com.br', 4752211, '2026-01-13 11:25:06');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(42, '666973139', 'solvegaoficial', 'SOL VEGA ☀️', 'O fenômeno do BBB 4 agora no BBB 26! \nAtriz, empresária e cantora do hit “Iarnuou”.\n#TeamSol | #BBB26', 345996, '2026-01-13 11:26:08');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(43, '397205072', 'edilsonjogador', 'Edilson Capetinha', 'Edilson Capetinha ⚽\n#Camarote #BBB26 \nPentacampeão do Mundo 🏆 \n#EdilsonCapetinha #EdilsonNoBBB26', 1140808, '2026-01-13 11:27:09');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(44, '30501027', 'sarahandrade', 'Sarah Andrade', '#bbb26 | #teamsarah 🔎\nComunicadora e empreendedora', 7572529, '2026-01-13 11:28:11');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(45, '298028046', 'albertocowboy', 'Alberto Cowboy', 'BBB26 | #TeamCowboy 🤠\n19 anos depois, o Cowboy ainda é Cowboy', 18143, '2026-01-13 11:29:12');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(46, '2308757549', 'brenocora', 'Breno Corã', 'Participante do #BBB26\nBiologo | Modelo | Mestre em Biotecnologia\nAqui e Agora! Vamos sonhar juntos!!!\n#TeamBreno♟️', 21585, '2026-01-13 11:30:12');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(47, '19153869', 'brigidoneto', 'Brigido Neto | Mentor de Escolas', '#BrigiTeam BBB 26🔨\nEmpreendedorismo | Educação | Lifestyle\nDiretor e CEO do @eusoucbn\n📧 brigido_comercial@g.globo', 27787, '2026-01-13 11:31:13');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(48, '1119316814', 'jordanaribmorais', 'Jordana Morais', 'BBB 26\n#TeamJordana 💖\nBrasília \nAdvogada e Modelo ⚖️✨\nContato comercial: \njordanamorais_comercial@g.globo', 133919, '2026-01-13 11:32:15');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(49, '290679950', 'marciele.albuquerque', 'Marciele Albuquerque', '#TimeMarciele BBB 26 🪇\nCultura • Arte • Dança \nCunhã Poranga do @boicaprichoso #Munduruku \n📧 marciele_comercial@g.globo', 830278, '2026-01-13 11:33:16');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(50, '208886025', 'maxiane', 'Maxiane Rodrigues', 'Participante Pipoca BBB26 🪞\n#MaxianenoBBB26\n✉️ maxiane_comercial@g.globo.com\nUma potência sem filtro!', 94486, '2026-01-13 11:34:17');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(51, '144825681', 'oxemarcelo', 'Marcelinho', 'PARTICIPANTE DO BBB26\nComercial: marcelo_comercial@g.globo\n#MarcelinhoNoBBB 🐦‍🔥\nNunca foi sorte, sempre foi Deus! \nMédico⚕️', 70000, '2026-01-13 11:35:18');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(52, '7506226814', 'pauloaaugustocm', 'Paulo Augusto Carvalhaes', 'BBB 26 • 🐎\nItaguaru-GO | Anápolis-GO\nMedicina Veterinária\ncomercial: pauloaugusto_comercial@g.globo', 370464, '2026-01-13 11:36:19');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(53, '6259159064', 'pedroespindolap', 'Pedro Henrique Espindola 🌹', 'PERFIL OFICIAL \nParticipante do #BBB26 \n🌹 | Vendedor ambulante\n💪🏼 | Tropa do pedro #TeamPedro\n📧 | contatoglobo@globo.com', 46917, '2026-01-13 11:37:20');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(54, '1586005548', 'samira_sagr', 'Sami Sagr 💋', 'PARTICIPANTE DO #BBB26 #TeamSamira 💋\n💋 Atendente de bar\n🐶 Mamãe do @lindolfo_sagr\n💌 samira_comercial@g.globo', 196286, '2026-01-13 11:38:22');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(55, '198554911', 'solangecouto', '𝐒𝐨𝐥𝐚𝐧𝐠𝐞 𝐂𝐨𝐮𝐭𝐨', 'Atriz • Participante BBB26\n📍 Agente @luizgwyer \n📩 luiz@luizgwyer.com.br\n🔎 Minhas Rede', 1131225, '2026-01-13 11:39:23');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(56, '35861145', 'jonassulzbach', 'JONΛS SULZBΛCH A+', 'BBB26 | #TeamJonas 🤙🏻\n📧 contato@satorahal.com.br', 3261068, '2026-01-13 11:40:24');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(57, '52194825685', 'tiamilenabbb', 'Milena Moreira, a Tia Milena', '🎨 Perfil oficial da Milena Moreira, a Tia Milena\n⭐ Participante do BBB26\n🏡 Teófilo Otoni, nascida em Itambacuri (MG)\nmilena_comercial@g.globo', 52882, '2026-01-13 11:41:25');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(58, '1144859455', 'julianofloss', 'JULIANO FLOSS LUCATEL', '#BBB26 | #TeamFloss 🐉\nAURORA SOON⏳\nBABYLON & TENTEI 2k26\nOwner @flosscamp', 4376697, '2026-01-13 11:46:26');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(59, '1656675', 'henricastelli', 'Henri Castelli', 'Henri Castelli\nBBB26 | #TeamHenri 🎬\nVivendo um personagem que só eu conheço, ou não, eu mesmo!\n📧 comercial@castellihenri.com.br', 2788896, '2026-01-14 11:29:42');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(60, '212283980', 'soualinecampos', 'Aline Campos 🔮', '#TeamAlineCampos #BBB26🔮 \nArte | Saúde física, mental | Beleza Contato@soualinecampos.com\n✨☯️Link da lista de transmissão⬇️✨', 11299769, '2026-01-14 11:30:43');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(61, '3980959', 'anapaularenault', 'Ana Paula Renault 🥂', 'Olha elaaaa! 🥂\nAtivista e apresentadora.\n✉️ contato@anapaularenault.com.br\n#TeamRenault | #BBB26', 2543740, '2026-01-14 11:31:44');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(62, '1548258336', 'babusantana', 'BABU SANTANA', 'ATOR| CANTOR| DIRETOR \n@gruponosdomorrooficial \n.\n📧: contato@babusantana.com\nartístico: sabrina.isnard@tingodelata.com.br\npubli: babu@mynd8.com.br', 4765684, '2026-01-14 11:32:46');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(63, '666973139', 'solvegaoficial', 'SOL VEGA ☀️', 'Do BBB4 ao #BBB26! #TeamSol\nAtriz, empresária e cantora do hit “Iarnuou”.\nArtístico: solvega@3work.com.br\nPubli: agenciamento.talentos@g.globo', 363900, '2026-01-14 11:33:47');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(64, '397205072', 'edilsonjogador', 'Edilson Capetinha', 'Edilson Capetinha ⚽\n#Camarote #BBB26 \nPentacampeão do Mundo 🏆 \n#EdilsonCapetinha #EdilsonNoBBB', 1166084, '2026-01-14 11:34:48');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(65, '30501027', 'sarahandrade', 'Sarah Andrade', '#BBB26 | #TeamSarah 🔎\nComunicadora e empreendedora', 7598340, '2026-01-14 11:35:49');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(66, '298028046', 'albertocowboy', 'Alberto Cowboy', '🤠 BBB26 | #TeamCowboy \n19 anos depois, o Cowboy ainda é Cowboy\n📧 agenciamento.talentos@g.globo', 40302, '2026-01-14 11:36:50');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(67, '2308757549', 'brenocora', 'Breno Corã', 'Participante do #BBB26\nBiologo | Modelo | Mestre em Biotecnologia\nAqui e Agora! Vamos sonhar juntos!!!\n#BrenoBBB26♟️', 38990, '2026-01-14 11:37:51');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(68, '19153869', 'brigidoneto', 'Brigido Neto | Mentor de Escolas', '#BrigiTeam BBB 26🔨\nEmpreendedorismo | Educação | Lifestyle\nDiretor e CEO do @eusoucbn\n📧 brigido_comercial@g.globo', 30092, '2026-01-14 11:38:52');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(69, '1119316814', 'jordanaribmorais', 'Jordana Morais', 'BBB 26\n#TeamJordana 💖\nBrasília \nAdvogada e Modelo ⚖️✨\nContato comercial: \njordanamorais_comercial@g.globo', 143253, '2026-01-14 11:39:54');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(70, '290679950', 'marciele.albuquerque', 'Marciele Albuquerque', 'BBB 26 | #TimeMarciele 🪇\nDança • Cultura • Arte \nCunhã Poranga do @boicaprichoso  #Munduruku \n📧 marciele_comercial@g.globo', 852879, '2026-01-14 22:21:43');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(71, '208886025', 'maxiane', 'Maxiane Rodrigues', 'Participante Pipoca BBB26 🪞\n#MaxianenoBBB26\n✉️ maxiane_comercial@g.globo.com\nUma potência sem filtro!', 106416, '2026-01-14 22:22:49');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(72, '144825681', 'oxemarcelo', 'Marcelinho', 'Participante do #BBB26\nMédico | Modelo\n📧 marcelo_comercial@g.globo\n#TeamMarcelinho 🐦‍🔥\nNunca foi sorte, sempre foi Deus!', 84624, '2026-01-14 22:22:59');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(73, '7506226814', 'pauloaaugustocm', 'Paulo Augusto Carvalhaes', '🏡 PARTICIPANTE DO #BBB26 | #TeamPA\n🐎 Estudante de Veterinária\n🌾 Anápolis 🚜 Itaguaru – GO\n💪 Influenciador\n📩 pauloaugusto_comercial@g.globo', 380961, '2026-01-14 22:26:00');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(74, '6259159064', 'pedroespindolap', 'Pedro Henrique Espindola 🌹', 'PERFIL OFICIAL \nParticipante do #BBB26 \n🌹 | Vendedor ambulante\n💪🏼 | Tropa do pedro #TeamPedro\n📧 | contatoglobo@globo.com', 69819, '2026-01-14 22:29:01');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(75, '1586005548', 'samira_sagr', 'Sami Sagr 💋', 'PARTICIPANTE DO #BBB26 #TeamSamira 💋\n💋 Atendente de bar\n🐶 Mamãe do @lindolfo_sagr\n💌 samira_comercial@g.globo', 229790, '2026-01-14 22:32:02');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(76, '198554911', 'solangecouto', '𝐒𝐨𝐥𝐚𝐧𝐠𝐞 𝐂𝐨𝐮𝐭𝐨', 'Atriz • Participante BBB26\n📍 Agente @luizgwyer \n📩 luiz@luizgwyer.com.br\n🔎 Minhas Redes', 1148705, '2026-01-14 22:35:04');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(77, '35861145', 'jonassulzbach', 'JONΛS SULZBΛCH A+', 'BBB26 | #TeamJonas 🤙🏻\n📧 contato@satorahal.com.br', 3337193, '2026-01-14 22:38:05');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(78, '52194825685', 'tiamilenabbb', 'Milena Moreira, a Tia Milena', '🎨 Perfil oficial da Milena Moreira, a Tia Milena\n⭐ Participante do BBB26\n🏡 Teófilo Otoni, nascida em Itambacuri (MG)\nmilena_comercial@g.globo', 90196, '2026-01-14 22:41:06');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(79, '1144859455', 'julianofloss', 'JULIANO FLOSS LUCATEL', '#BBB26 | #TeamFloss 🐉\nAURORA SOON⏳\nBABYLON & TENTEI 2k26\nOwner @flosscamp', 4424653, '2026-01-14 22:44:07');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(80, '1656675', 'henricastelli', 'Henri Castelli', 'Henri Castelli\nBBB26 | #TeamHenri 🎬\nVivendo um personagem que só eu conheço, ou não, eu mesmo!\n📧 comercial@castellihenri.com.br', 2886770, '2026-01-14 22:47:09');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(81, '212283980', 'soualinecampos', 'Aline Campos 🔮', '#TeamAlineCampos #BBB26🔮 \nArte | Saúde física, mental | Beleza Contato@soualinecampos.com\n✨☯️Link da lista de transmissão⬇️✨', 11304909, '2026-01-14 22:50:12');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(82, '3980959', 'anapaularenault', 'Ana Paula Renault 🥂', 'Olha elaaaa! 🥂\nAtivista e apresentadora.\n✉️ contato@anapaularenault.com.br\n#TeamRenault | #BBB26', 2588545, '2026-01-14 22:53:13');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(83, '1548258336', 'babusantana', 'BABU SANTANA', 'ATOR| CANTOR| DIRETOR \n@gruponosdomorrooficial \n.\n📧: contato@babusantana.com\nartístico: sabrina.isnard@tingodelata.com.br\npubli: babu@mynd8.com.br', 4774757, '2026-01-14 22:56:15');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(84, '666973139', 'solvegaoficial', 'SOL VEGA ☀️', 'Do BBB4 ao #BBB26! #TeamSol\nAtriz, empresária e cantora do hit “Iarnuou”.\nArtístico: solvega@3work.com.br\nPubli: solvega_comercial@g.globo', 376703, '2026-01-15 12:42:06');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(85, '397205072', 'edilsonjogador', 'Edilson Capetinha 🏆', 'Edilson Capetinha 🏆\n#Camarote #BBB26 \nPentacampeão do Mundo ⚽️\n#EdilsonCapetinha #EdilsonNoBBB', 1212774, '2026-01-15 12:45:07');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(86, '30501027', 'sarahandrade', 'Sarah Andrade', '#BBB26 | #TeamSarah 🔎\nComunicadora e empreendedora', 7611865, '2026-01-15 12:48:09');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(87, '298028046', 'albertocowboy', 'Alberto Cowboy', '🤠 BBB26 | #TeamCowboy \n19 anos depois, o Cowboy ainda é Cowboy\n📧 albertocowboy_comercial@g.globo', 103551, '2026-01-15 12:51:10');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(88, '2308757549', 'brenocora', 'Breno Corã', 'Participante do #BBB26\nBiologo | Modelo | Mestre em Biotecnologia\nAqui e Agora! Vamos sonhar juntos!!!\n#BrenoBBB26♟️', 50392, '2026-01-15 12:54:11');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(89, '19153869', 'brigidoneto', 'Brigido Neto | Mentor de Escolas', '#BrigiTeam BBB 26🔨\nEmpreendedorismo | Educação | Lifestyle\nDiretor e CEO do @eusoucbn\n📧 brigido_comercial@g.globo', 32026, '2026-01-15 12:57:12');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(90, '1119316814', 'jordanaribmorais', 'Jordana Morais', 'BBB 26\n#TeamJordana 💖\nBrasília \nAdvogada e Modelo ⚖️✨\nContato comercial: \njordanamorais_comercial@g.globo', 148343, '2026-01-15 13:00:13');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(91, '290679950', 'marciele.albuquerque', 'Marciele Albuquerque', 'BBB 26 | #TimeMarciele 🪇\nDança • Cultura • Arte \nCunhã Poranga do @boicaprichoso  #Munduruku \n📧 marciele_comercial@g.globo', 861468, '2026-01-15 13:03:14');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(92, '208886025', 'maxiane', 'Maxiane Rodrigues', 'Participante Pipoca BBB26 🪞\n#MaxianenoBBB26\n✉️ maxiane_comercial@g.globo.com\nUma potência sem filtro!', 109421, '2026-01-15 13:06:17');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(93, '144825681', 'oxemarcelo', 'Marcelinho', 'Participante do #BBB26\nMédico | Modelo\n📧 marcelo_comercial@g.globo\n#TeamMarcelinho 🐦‍🔥\nNunca foi sorte, sempre foi Deus!', 87893, '2026-01-15 13:09:18');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(94, '7506226814', 'pauloaaugustocm', 'Paulo Augusto Carvalhaes', '🏡 PARTICIPANTE DO #BBB26 | #TeamPA\n🐎 Estudante de Veterinária\n🌾 Anápolis 🚜 Itaguaru – GO\n💪 Influenciador\n📩 pauloaugusto_comercial@g.globo', 382743, '2026-01-15 13:12:20');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(95, '6259159064', 'pedroespindolap', 'Pedro Henrique Espindola 🌹', 'PERFIL OFICIAL \nParticipante do #BBB26 \n🌹 | Vendedor ambulante\n💪🏼 | Tropa do pedro #TeamPedro\n📧 | contatoglobo@globo.com', 74299, '2026-01-15 13:15:21');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(96, '1586005548', 'samira_sagr', 'Sami Sagr 💋', 'PARTICIPANTE DO #BBB26 #TeamSamira 💋\n💋 Atendente de bar\n🐶 Mamãe do @lindolfo_sagr\n💌 samira_comercial@g.globo', 233238, '2026-01-15 13:18:23');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(97, '198554911', 'solangecouto', '𝐒𝐨𝐥𝐚𝐧𝐠𝐞 𝐂𝐨𝐮𝐭𝐨', 'Atriz • Participante BBB26\n📍 Agente @luizgwyer \n📩 luiz@luizgwyer.com.br\n🔎 Minhas Redes', 1151851, '2026-01-15 13:21:24');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(98, '35861145', 'jonassulzbach', 'JONΛS SULZBΛCH A+', 'BBB26 | #TeamJonas 🤙🏻\n📧 jonas_comercial@g.globo', 3373340, '2026-01-15 13:24:25');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(99, '52194825685', 'tiamilenabbb', 'Milena Moreira, a Tia Milena', '🎨 Perfil oficial da Milena Moreira, a Tia Milena\n⭐ Participante do BBB26\n🏡 Teófilo Otoni, nascida em Itambacuri (MG)\nmilena_comercial@g.globo', 96146, '2026-01-15 13:27:26');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(100, '1144859455', 'julianofloss', 'JULIANO FLOSS LUCATEL', '#BBB26 | #TeamFloss 🐉\nAURORA SOON⏳\nBABYLON & TENTEI 2k26\nOwner @flosscamp', 4434360, '2026-01-15 13:30:28');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(101, '1656675', 'henricastelli', 'Henri Castelli', 'Henri Castelli\nBBB26 | #TeamHenri 🎬\nVivendo um personagem que só eu conheço, ou não, eu mesmo!\n📧 comercial@castellihenri.com.br', 3184637, '2026-01-15 13:33:29');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(102, '212283980', 'soualinecampos', 'Aline Campos 🔮', '#TeamAlineCampos #BBB26🔮 \nArte | Saúde física, mental | Beleza Contato@soualinecampos.com\n✨☯️Link da lista de transmissão⬇️✨', 11306180, '2026-01-15 13:36:31');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(103, '3980959', 'anapaularenault', 'Ana Paula Renault 🥂', 'Olha elaaaa! 🥂\nAtivista e apresentadora.\n✉️ contato@anapaularenault.com.br\n#TeamRenault | #BBB26', 2625003, '2026-01-15 13:39:33');
INSERT INTO `instagram_user_history` (`id`, `instagram_id`, `username`, `full_name`, `biography`, `followers_count`, `created_at`) VALUES
	(104, '1548258336', 'babusantana', 'BABU SANTANA', 'ATOR & Veterano do BBB 26 | #TropaDoBabu 🪮\n📧: contato@babusantana.com\nartístico: sabrina.isnard@tingodelata.com.br\npubli: babu@mynd8.com.br', 4780481, '2026-01-15 13:42:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
