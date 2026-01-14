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

-- Copiando estrutura para tabela bigstats.bbb_participante
CREATE TABLE IF NOT EXISTS `bbb_participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0,
  `grupo` enum('Pipoca','Camarote','Veterano') NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Copiando dados para a tabela bigstats.bbb_participante: ~21 rows (aproximadamente)
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(1, 'Babu Santana', 0, 'Veterano', 'babusantana', 'Ator carioca, veterano do BBB20, conhecido pela resistência em paredões e por papéis fortes no cinema e na TV.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(2, 'Sol Vega', 0, 'Veterano', 'solvegaoficial', 'Atriz e empresária, veterana do BBB4, virou ícone de memes e momentos marcantes da era raiz do reality.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(3, 'Jonas Sulzbach', 0, 'Veterano', 'jonassulzbach', 'Modelo, influenciador fitness e veterano do BBB12, ficou em terceiro lugar e mantém carreira ligada à vida saudável.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(4, 'Sarah Andrade', 0, 'Veterano', 'sarahandrade', 'Influenciadora digital e ex-analista de marketing, veterana do BBB21, integrou o grupo estratégico G3.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(5, 'Alberto Cowboy', 0, 'Veterano', 'albertocowboy', 'Empresário rural e veterano do BBB7, famoso por rivalidades e perfil competitivo dentro do jogo.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(6, 'Ana Paula Renault', 0, 'Veterano', 'anapaularenault', 'Jornalista mineira, veterana do BBB16, conhecida pelo temperamento explosivo e bordões virais.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(7, 'Solange Couto', 0, 'Camarote', 'solangecouto', 'Atriz consagrada, participante do Camarote, com longa carreira em novelas e personagens populares.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(8, 'Aline Campos', 0, 'Camarote', 'soualinecampos', 'Atriz, empresária e ex-bailarina do Faustão, Camarote, ligada ao mundo fitness e espiritualidade.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(9, 'Juliano Floss', 0, 'Camarote', 'julianofloss', 'Dançarino profissional e influenciador, Camarote, famoso por vídeos virais e projetos de dança urbana.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(10, 'Edilson', 0, 'Camarote', 'edilsonjogador', 'Ex-jogador de futebol, Camarote, ídolo de torcida nos anos 90, conhecido por carisma e resenha.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(11, 'Henri Castelli', 0, 'Camarote', 'henricastelli', 'Ator de novelas globais, Camarote, carreira consolidada em papéis de galã e protagonistas.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(12, 'Breno', 0, 'Pipoca', 'brenocora', 'Biólogo, modelo e Pipoca vindo da Casa de Vidro, mistura perfil acadêmico com carreira artística.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(13, 'Brígido', 0, 'Pipoca', 'brigidoneto', 'Pipoca anônimo escolhido pelo público, perfil popular, trabalhador e focado em representar a vida comum.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(14, 'Jordana', 0, 'Pipoca', 'jordanaribmorais', 'Advogada de Brasília e influenciadora, Pipoca, entrou pelo voto popular com discurso de jogo estratégico.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(15, 'Marcelo', 0, 'Pipoca', 'oxemarcelo', 'Pipoca do Nordeste, selecionado na Casa de Vidro, carismático e com forte sotaque regional.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(16, 'Marciele', 0, 'Pipoca', 'marciele.albuquerque', 'Pipoca que passou pela Casa de Vidro, trabalha com comércio local e entrou pela votação do público.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(17, 'Maxiane', 0, 'Pipoca', 'maxiane', 'Pipoca escolhida por votação popular, perfil comunicativo e engajado em causas sociais.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(18, 'Milena', 0, 'Pipoca', 'tiamilenabbb', 'Pipoca revelada na Casa de Vidro, conhecida por carisma e forte presença nas redes após seleção.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(19, 'Paulo Augusto', 0, 'Pipoca', 'pauloaaugustocm', 'Pipoca apaixonado por animais, trabalha com projetos comunitários e entrou pelo voto do público.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(20, 'Pedro', 0, 'Pipoca', 'pedroespindolap', 'Pipoca vendedor ambulante e empreendedor digital, história de superação e foco em negócios.');
INSERT INTO `bbb_participante` (`id`, `nome`, `eliminado`, `grupo`, `instagram`, `detalhes`) VALUES
	(21, 'Samira', 0, 'Pipoca', 'samira_sagr', 'Pipoca destaque das Casas de Vidro, perfil extrovertido e competitivo, entrou com apoio popular.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
