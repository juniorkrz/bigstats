-- --------------------------------------------------------
-- Servidor:                     35.247.249.160
-- Versão do servidor:           10.11.6-MariaDB-0+deb12u1 - Debian 12
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bigstats
CREATE DATABASE IF NOT EXISTS `bigstats` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci */;
USE `bigstats`;

-- Copiando estrutura para tabela bigstats.bbb_dupla
CREATE TABLE IF NOT EXISTS `bbb_dupla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_participante_1` int(11) DEFAULT NULL,
  `id_participante_2` int(11) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `grupo` varchar(10) DEFAULT NULL,
  `grau_relacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_participante_1` (`id_participante_1`,`id_participante_2`),
  KEY `id_participante_2` (`id_participante_2`),
  CONSTRAINT `bbb_dupla_ibfk_1` FOREIGN KEY (`id_participante_1`) REFERENCES `bbb_participante` (`id`),
  CONSTRAINT `bbb_dupla_ibfk_2` FOREIGN KEY (`id_participante_2`) REFERENCES `bbb_participante` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Copiando dados para a tabela bigstats.bbb_dupla: ~12 rows (aproximadamente)
INSERT INTO `bbb_dupla` (`id`, `id_participante_1`, `id_participante_2`, `detalhes`, `grupo`, `grau_relacao`) VALUES
	(34, 1, 2, 'Amigos baianos, Vinícius, 28 anos, e Aline, 32, têm uma conexão baseada em lealdade e superação. Vinícius é promotor de eventos e arquiteto, enquanto Aline é policial militar e influenciadora.', 'Pipoca', 'Amigos'),
	(35, 3, 4, 'Gêmeos goianos, João Gabriel e João Pedro, 21 anos, trabalham como salva-vidas de rodeio e pecuaristas. João Gabriel é extrovertido e esquentado, enquanto João Pedro é mais calmo e estratégico.', 'Pipoca', 'Irmãos'),
	(36, 5, 6, 'Amigas de infância de Fortaleza (CE), Eva, 31, e Renata, 32, têm uma amizade de 25 anos, unidas pela paixão pela dança. Eva é bailarina e modelo, enquanto Renata é professora de dança e coordenadora de ginástica rítmica.', 'Pipoca', 'Amigas'),
	(37, 7, 8, 'Edilberto, 42 anos, e Raissa, 19, são artistas circenses mineiros que trabalham juntos no negócio da família. Eles compartilham uma conexão fora do comum e têm temperamentos semelhantes.', 'Pipoca', 'Pai e filha'),
	(38, 9, 10, 'As cariocas Thamiris, 33, e Camilla, 34, foram criadas pela avó e pela mãe. Sempre cuidaram uma da outra, mesmo não morando juntas, e se falam todos os dias.', 'Pipoca', 'Irmãs'),
	(39, 11, 12, 'Arleane, 34 anos, é formada em Estética e Cosmética e atua como influenciadora em Manaus. Marcelo, 38 anos, é servidor público e engenheiro de segurança do trabalho. Casados há 11 anos, se conheceram durante a apresentação de uma escola de samba.', 'Pipoca', 'Casados'),
	(40, 13, 14, 'Gabriel e Maike, ambos com 30 anos, são amigos de São Paulo. Gabriel é modelo e promotor de eventos, enquanto Maike é representante comercial. Se conheceram aos 13 anos, quando nadavam juntos e competiam pelo mesmo clube.', 'Pipoca', 'Amigos'),
	(41, 15, 16, 'As irmãs Gracyanne Barbosa, 42 anos, e Giovanna, 26, são naturais de Campo Grande, MS. Apaixonadas por atividade física, compartilham rotinas saudáveis nas redes sociais. Gracyanne é modelo de fisiculturismo e ex-dançarina do Tchakabum, enquanto Giovanna é veterinária.', 'Camarote', 'Irmãs'),
	(42, 17, 18, 'Diogo Almeida, ator, e Vilma, 68 anos, são mãe e filho. Vilma chegou a iniciar uma inscrição com o marido para participar do reality, mas percebeu que não poderia ter entrado com outra pessoa que não fosse Diogo.', 'Camarote', 'Filho e mãe'),
	(43, 19, 20, 'Daniele Hypolito, 40 anos, e Diego Hypolito, 38, são ginastas nascidos em Santo André, SP. Por influência da irmã mais velha, a família se mudou para o Rio de Janeiro, onde Daniele conseguiu um contrato com um grande clube de ginástica.', 'Camarote', 'Irmãos'),
	(44, 21, 22, 'Vitória Strada, 28 anos, atriz, e Mateus Pires, 28 anos, arquiteto, são amigos inseparáveis. Se consideram irmãos e têm uma sintonia tão forte que chegam a parecer um casal.', 'Camarote', 'Amigos'),
	(45, 23, 24, 'Guilherme, 27 anos, fisioterapeuta geriatra, e sua sogra Joselma, 54 anos, dona de casa, ambos de Olinda (PE). Eles têm uma relação de muita amizade e foram escolhidos pelo público para entrar no BBB 25.', 'Pipoca', 'Genro e Sogra');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
