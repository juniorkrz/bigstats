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

-- Copiando estrutura para tabela bigstats.bbb_participante
CREATE TABLE IF NOT EXISTS `bbb_participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `grupo` enum('Pipoca','Camarote') NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Copiando dados para a tabela bigstats.bbb_participante: ~24 rows (aproximadamente)
INSERT INTO `bbb_participante` (`id`, `nome`, `grupo`, `instagram`, `detalhes`) VALUES
	(1, 'Vinícius', 'Pipoca', 'viniciusnascimentos', 'Vinícius, 28 anos, é promotor de eventos e arquiteto. Ele tem uma conexão com Aline, 32, baseada em lealdade e superação. Aline é policial militar e influenciadora. Juntos, compartilham uma amizade sólida que nasceu na infância.'),
	(2, 'Aline', 'Pipoca', 'alinepatriarca_', 'Aline, 32 anos, é policial militar e influenciadora. Ela tem uma conexão com Vinícius, 28, baseada em lealdade e superação. Juntos, compartilham uma amizade sólida que nasceu na infância. Vinícius é promotor de eventos e arquiteto.'),
	(3, 'João Gabriel', 'Pipoca', 'gabrielgemim', 'João Gabriel, 21 anos, é um dos gêmeos goianos. Ele é extrovertido e esquentado, trabalhando como salva-vidas de rodeio e pecuarista. Tem uma relação forte com seu irmão João Pedro, mais calmo e estratégico, com quem compartilha sua vida profissional e pessoal.'),
	(4, 'João Pedro', 'Pipoca', 'pedrogemim', 'João Pedro, 21 anos, é o irmão mais calmo de João Gabriel. Ambos são salva-vidas de rodeio e pecuaristas. João Pedro é mais estratégico, enquanto João Gabriel é mais extrovertido e esquentado. Juntos, têm uma conexão forte e uma relação de apoio mútuo.'),
	(5, 'Eva', 'Pipoca', 'evapachecod', 'Eva, 31 anos, é bailarina e modelo. Ela tem uma amizade de 25 anos com Renata, 32, com quem compartilha uma paixão pela dança. Eva é dinâmica e cheia de energia, enquanto Renata é professora de dança e coordenadora de ginástica rítmica.'),
	(6, 'Renata', 'Pipoca', '_renatasaldanha', 'Renata, 32 anos, é professora de dança e coordenadora de ginástica rítmica. Ela tem uma amizade de 25 anos com Eva, 31, com quem compartilha uma paixão pela dança. Renata é mais reservada e estratégica, complementando o espírito energético de Eva.'),
	(7, 'Edilberto', 'Pipoca', 'edy_circo', 'Edilberto, 42 anos, é artista circense e trabalha ao lado de sua filha Raissa, 19. Juntos, eles administram um negócio familiar e têm uma conexão única, com temperamentos semelhantes. Edilberto é mais experiente e protetor, enquanto Raissa é jovem e criativa.'),
	(8, 'Raissa', 'Pipoca', 'raissasimoesofic', 'Raissa, 19 anos, é artista circense e trabalha ao lado de seu pai Edilberto, 42. Raissa traz criatividade e energia jovem para o trabalho familiar. Sua relação com Edilberto é marcada por uma forte conexão e afinidade, com temperamentos semelhantes.'),
	(9, 'Thamiris', 'Pipoca', 'eumonabonita', 'Thamiris, 33 anos, e sua irmã Camilla, 34, são cariocas que cresceram juntas com a avó e mãe. Elas sempre cuidaram uma da outra, se comunicando todos os dias. Thamiris é dinâmica e espontânea, enquanto Camilla é mais reservada e estratégica.'),
	(10, 'Camilla', 'Pipoca', 'millamaiia_', 'Camilla, 34 anos, e sua irmã Thamiris, 33, são inseparáveis. Elas foram criadas pela mãe e avó e se falam todos os dias. Camilla é mais tranquila e estratégica, enquanto Thamiris é extrovertida e cheia de energia.'),
	(11, 'Arleane', 'Pipoca', 'arleanemarques', 'Arleane, 34 anos, é influenciadora e atua na área de Estética e Cosmética. Casada com Marcelo, 38 anos, um engenheiro de segurança do trabalho, há 11 anos, eles se conheceram durante uma apresentação de uma escola de samba. Juntos, formam um casal unido e cheio de paixão.'),
	(12, 'Marcelo', 'Pipoca', 'marcelo_prata32', 'Marcelo, 38 anos, é servidor público e engenheiro de segurança do trabalho. Casado com Arleane, 34 anos, uma influenciadora e profissional de Estética, eles compartilham uma vida sólida e apaixonada. Se conheceram durante uma apresentação de uma escola de samba.'),
	(13, 'Gabriel', 'Pipoca', 'gabriel.yoshimoto', 'Gabriel, 30 anos, é modelo e promotor de eventos. Ele tem uma amizade de longa data com Maike, 30, que é representante comercial. Juntos, eles compartilham uma paixão por esportes e competiram no mesmo clube de natação quando jovens.'),
	(14, 'Maike', 'Pipoca', 'maikealllan', 'Maike, 30 anos, é representante comercial. Ele tem uma amizade de longa data com Gabriel, 30, que é modelo e promotor de eventos. Eles se conheceram aos 13 anos, quando nadavam juntos e competiam pelo mesmo clube.'),
	(15, 'Gracyanne Barbosa', 'Camarote', 'graoficial', 'Gracyanne, 42 anos, é modelo de fisiculturismo e ex-dançarina do Tchakabum. Ela compartilha sua paixão por atividades físicas com sua irmã Giovanna, 26, veterinária. Juntas, são inseparáveis e compartilham rotinas saudáveis nas redes sociais.'),
	(16, 'Giovanna', 'Camarote', 'giovanna_jacobina', 'Giovanna, 26 anos, é veterinária e apaixonada por atividades físicas. Ela compartilha sua rotina saudável com sua irmã Gracyanne, 42, que é modelo de fisiculturismo e ex-dançarina. Juntas, inspiram seus seguidores a adotar um estilo de vida ativo.'),
	(17, 'Diogo Almeida', 'Camarote', 'diogo.allmeida', 'Diogo Almeida, ator, tem uma relação única com sua mãe Vilma, 68 anos. Vilma inicialmente pensou em participar do reality com seu marido, mas logo percebeu que seria mais apropriado fazer isso com seu filho. Juntos, têm uma ligação intensa e especial.'),
	(18, 'Vilma', 'Camarote', 'vvilmanascimento', 'Vilma, 68 anos, tem uma relação muito forte com seu filho Diogo Almeida, ator. Ela chegou a iniciar uma inscrição para participar do reality com o marido, mas logo percebeu que seria mais adequado com Diogo. Juntos, têm uma conexão intensa e especial.'),
	(19, 'Daniele Hypolito', 'Camarote', 'danyhypolito', 'Daniele Hypolito, 40 anos, é ginasta e compartilha sua paixão pelo esporte com seu irmão Diego, 38 anos. Juntos, nasceram em Santo André, SP, e se mudaram para o Rio de Janeiro, onde Daniele conseguiu um contrato com um grande clube de ginástica.'),
	(20, 'Diego Hypolito', 'Camarote', 'diegohypolito', 'Diego Hypolito, 38 anos, é ginasta e tem uma forte ligação com sua irmã Daniele, 40 anos. Juntos, se mudaram para o Rio de Janeiro em busca de melhores oportunidades no esporte. Eles são figuras inspiradoras no mundo da ginástica.'),
	(21, 'Vitória Strada', 'Camarote', 'vitoriastrada_', 'Vitória Strada, 28 anos, atriz, tem uma amizade profunda com Mateus Pires, 28 anos, arquiteto. Eles se consideram irmãos e compartilham uma sintonia tão forte que suas interações parecem um casal.'),
	(22, 'Mateus Pires', 'Camarote', 'teuspires', 'Mateus Pires, 28 anos, arquiteto, tem uma amizade sólida com Vitória Strada, 28 anos, atriz. Eles são inseparáveis e se consideram irmãos, com uma sintonia tão forte que chegam a ser confundidos com um casal.'),
	(23, 'Guilherme', 'Pipoca', 'guilhermevilar', 'Guilherme, 27 anos, é fisioterapeuta geriátrico de Olinda, Pernambuco. Casado com Letícia, filha mais nova de Joselma, ele mantém uma relação harmoniosa com sua sogra, com quem entrou no BBB 25.'),
	(24, 'Joselma', 'Pipoca', 'adonadelma', 'Joselma, 54 anos, é dona de casa de Olinda, Pernambuco. Conhecida por sua alegria e hospitalidade, tem uma relação próxima com seu genro Guilherme, com quem divide a experiência no BBB 25.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
