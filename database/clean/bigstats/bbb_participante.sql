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
DROP TABLE IF EXISTS `bbb_participante`;
CREATE TABLE IF NOT EXISTS `bbb_participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `profissao` varchar(255) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `idade` tinyint(3) unsigned DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0,
  `grupo` enum('Pipoca','Camarote','Veterano') NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `ano_nascimento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Copiando dados para a tabela bigstats.bbb_participante: ~21 rows (aproximadamente)
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(1, 'Babu Santana', 'Alexandre da Silva Santana', 'Ator e Cantor', 'Rio de Janeiro', 'RJ', 45, 0, 'Veterano', 'babusantana', 'Ator e ex-BBB20, natural do Rio de Janeiro, com carreira em teatro, TV e cinema; ficou conhecido por papéis marcantes além de sua longa trajetória no reality show.', 1979);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(2, 'Sol Vega', 'Solange Cristina Couto Maria', 'Atriz e Empresária', 'São Paulo', 'SP', 54, 0, 'Veterano', 'solvegaoficial', 'Atriz e empresária, de São Paulo, participante do BBB4; ficou conhecida por memética performance na edição, com passagens em televisão e negócios próprios.', 1978);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(3, 'Jonas Sulzbach', 'Jonas Fernando Sulzbach', 'Modelo e Influenciador', 'Lajeado', 'RS', 38, 0, 'Veterano', 'jonassulzbach', 'Modelo, empresário e influenciador de Lajeado (RS), terceiro colocado no BBB12; hoje compartilha estilo de vida fitness e projetos pessoais nas redes.', 1986);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(4, 'Sarah Andrade', 'Sarah Carolline Vieira de Andrade', 'Influenciadora e Analista de Marketing', 'Brasília', 'DF', 33, 0, 'Veterano', 'sarahandrade', 'Influenciadora digital e ex-BBB21 de Brasília (DF), voltou como veterana no BBB26; ganhou notoriedade no jogo por estratégia e presença marcante no G3.', 1991);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(5, 'Alberto Cowboy', 'Alberto Pimentel Baptista', 'Empresário Rural', 'Manhuaçu', 'MG', 42, 0, 'Veterano', 'albertocowboy', 'Empresário mineiro de Manhuaçu, veterano do BBB7, conhecido por rivalidades daquela edição; voltou como Veterano no BBB26.', 1976);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(6, 'Ana Paula Renault', 'Ana Paula Machado Renault', 'Jornalista', 'Belo Horizonte', 'MG', 41, 0, 'Veterano', 'anapaularenault', 'Jornalista mineira de Belo Horizonte e ex-BBB16, famosa pelo bordão “Olha ela!”; retorna à casa como Veterana no BBB26.', 1991);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(7, 'Solange Couto', 'Solange Couto dos Santos', 'Atriz', 'Rio de Janeiro', 'RJ', 67, 0, 'Camarote', 'solangecouto', 'Atriz consagrada do Rio de Janeiro, famosa por papéis em novelas como “O Clone” e “A Viagem”; participa do BBB26 grupo Camarote.', 1956);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(8, 'Aline Campos', 'Aline Campos da Silva', 'Atriz e Empresária', 'Rio de Janeiro', 'RJ', 37, 0, 'Camarote', 'soualinecampos', 'Atriz, empresária, apresentadora e ex-bailarina carioca; destaque em TV e redes sociais, integra o grupo Camarote do BBB26.', 1987);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(9, 'Juliano Floss', 'Juliano Floss Lucatel', 'Dançarino e Influenciador', 'Joinville', 'SC', 30, 0, 'Camarote', 'julianofloss', 'Dançarino e influenciador digital de Santa Catarina, com milhões de seguidores; membro do grupo Camarote no BBB26.', 2004);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(10, 'Edílson Capetinha', 'Edílson da Silva Ferreira', 'Ex-jogador de Futebol', 'Salvador', 'BA', 54, 0, 'Camarote', 'edilsonjogador', 'Ex-jogador de futebol baiano e campeão mundial em 2002 com a seleção brasileira, agora integrante do grupo Camarote no BBB26.', 1970);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(11, 'Henri Castelli', 'Henri Lincoln Fernandes Nascimento', 'Ator', 'São Paulo', 'SP', 46, 1, 'Camarote', 'henricastelli', 'Ator paulista com longa carreira em novelas e séries; entrou no BBB26 pelo grupo Camarote.', 1978);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(12, 'Breno', 'Breno Rangel Moreira Corã', 'Biólogo e Modelo', 'Contagem', 'MG', 33, 0, 'Pipoca', 'brenocora', 'Biólogo com mestrado em Biotecnologia, modelo e pesquisador de Minas Gerais/SC; entrou no BBB26 pelo grupo Pipoca após Casa de Vidro.', 1993);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(13, 'Brigido', 'Brigido Neto', 'Empreendedor e diretor de escola', 'Manaus', 'AM', 34, 0, 'Pipoca', 'brigidoneto', 'Empreendedor e diretor executivo de escola de Manaus (AM), formado em Engenharia de Produção; entrou no BBB26 como Pipoca pelo voto popular.', 1992);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(14, 'Jordana', 'Jordana Ribeiro Morais', 'Advogada e modelo', 'Brasília', 'DF', 29, 0, 'Pipoca', 'jordanaribmorais', 'Advogada, modelo e influenciadora digital de Brasília (DF); escolhida pelo público na Casa de Vidro para entrar no BBB26 como Pipoca.', 1997);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(15, 'Marcelo', 'Marcelo Alves de Araujo Filho', 'Médico', 'Currais Novos', 'RN', 31, 0, 'Pipoca', 'oxemarcelo', 'Médico potiguar de Currais Novos (RN), escolhido pelo público na Casa de Vidro para integrar o BBB26 como Pipoca.', 1995);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(16, 'Marciele', 'Marciele Albuquerque', 'Dançarina', 'Juruti ', 'PA', 32, 0, 'Pipoca', 'marciele.albuquerque', 'Dançarina e influenciadora de Juruti (PA), com forte presença digital; entrou no BBB26 como Pipoca após votação popular.', 1994);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(17, 'Maxiane', 'Maxiane Rodrigues', 'Influenciadora digital', 'Nazaré da Mata', 'PE', 32, 0, 'Pipoca', 'maxiane', 'Influenciadora digital e criadora de conteúdo de Nazaré da Mata (PE), escolhida pelo público para o BBB26 como Pipoca.', 1994);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(18, 'Milena', 'Milena Moreira Lages', 'Babá e recreadora de festa infantil', 'Teófilo Otoni', 'MG', 26, 0, 'Pipoca', 'tiamilenabbb', 'Babá e recreadora de festas infantil de Itambacuri (MG); entrou no BBB26 como Pipoca após votação na Casa de Vidro.', 2000);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(19, 'Paulo Augusto', 'Paulo Augusto Carvalhaes', 'Estudante de Veterinária e influenciador digital', 'Anápolis', 'GO', 21, 0, 'Pipoca', 'pauloaaugustocm', 'Estudante de veterinária, influenciador digital e amante dos animais de Inhumas (GO); entrou no BBB26 como Pipoca pelo voto popular.', 2005);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(20, 'Pedro', 'Pedro Henrique Espindola', 'Vendedor ambulante', 'Curitiba', 'PR', 22, 0, 'Pipoca', 'pedroespindolap', 'Vendedor ambulante de flores e trufas de Curitiba (PR), escolhido pelo público na Casa de Vidro para participar do BBB26 como Pipoca.', 2004);
INSERT INTO `bbb_participante` (`id`, `nome`, `nome_completo`, `profissao`, `cidade`, `estado`, `idade`, `eliminado`, `grupo`, `instagram`, `detalhes`, `ano_nascimento`) VALUES
	(21, 'Samira', 'Samira Sagr', 'Atendente de bar', 'Butiá', 'SC', 25, 0, 'Pipoca', 'samira_sagr', 'Atendente de bar e estudante de Direito, natural de São Jerônimo (RS), entrou no BBB26 como Pipoca após votação popular.', 2001);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
