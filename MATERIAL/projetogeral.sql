-- --------------------------------------------------------
-- Anfitrião:                    localhost
-- Versão do servidor:           10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for projetogeral
CREATE DATABASE IF NOT EXISTS `projetogeral` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projetogeral`;

-- Dumping structure for table projetogeral.criptografia
CREATE TABLE IF NOT EXISTS `criptografia` (
  `id_cartao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero_cartao` varbinary(200) NOT NULL,
  PRIMARY KEY (`id_cartao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.criptografia: ~2 rows (approximately)
/*!40000 ALTER TABLE `criptografia` DISABLE KEYS */;
INSERT IGNORE INTO `criptografia` (`id_cartao`, `numero_cartao`) VALUES
	(1, _binary 0xD55B7E6C900DBD7D066FC3D11DA02BE1),
	(2, _binary 0x0BB4273EC93108EDB6C2AF3CC68060EE);
/*!40000 ALTER TABLE `criptografia` ENABLE KEYS */;

-- Dumping structure for table projetogeral.stock_apps
CREATE TABLE IF NOT EXISTS `stock_apps` (
  `id_app` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(50) NOT NULL,
  `app_key` varchar(50) NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_app`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.stock_apps: ~3 rows (approximately)
/*!40000 ALTER TABLE `stock_apps` DISABLE KEYS */;
INSERT IGNORE INTO `stock_apps` (`id_app`, `app_name`, `app_key`, `active`) VALUES
	(1, 'Aplicacao 1', 'DGXhTjiGPjsBb96SrYkA8NXWhzQisLVF', 1),
	(2, 'Aplicacao 2', 'tC4mcHsdVHrYK0m73GnyS4H9g251HnId', 1),
	(3, 'Aplicacao 3', 'UDk3F9CIrryPtslTkXTJ4iwt2nn8jNF9', 1);
/*!40000 ALTER TABLE `stock_apps` ENABLE KEYS */;

-- Dumping structure for table projetogeral.stock_familias
CREATE TABLE IF NOT EXISTS `stock_familias` (
  `id_familia` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `imagem` varchar(250) NOT NULL,
  PRIMARY KEY (`id_familia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.stock_familias: ~6 rows (approximately)
/*!40000 ALTER TABLE `stock_familias` DISABLE KEYS */;
INSERT IGNORE INTO `stock_familias` (`id_familia`, `id_parent`, `designacao`, `imagem`) VALUES
	(2, 7, 'Computadores desktop', ''),
	(3, 7, 'Computadores portáteis', ''),
	(4, 0, 'Teclados PC', ''),
	(5, 4, 'Teclados Gaming', ''),
	(6, 5, 'Teclado XPTO', ''),
	(7, 0, 'Computadores', '');
/*!40000 ALTER TABLE `stock_familias` ENABLE KEYS */;

-- Dumping structure for table projetogeral.stock_movimentos
CREATE TABLE IF NOT EXISTS `stock_movimentos` (
  `id_movimento` int(11) NOT NULL AUTO_INCREMENT,
  `id_app` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `entrada_saida` varchar(20) NOT NULL,
  `data_movimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `observacoes` text NOT NULL,
  PRIMARY KEY (`id_movimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.stock_movimentos: ~0 rows (approximately)
/*!40000 ALTER TABLE `stock_movimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_movimentos` ENABLE KEYS */;

-- Dumping structure for table projetogeral.stock_produtos
CREATE TABLE IF NOT EXISTS `stock_produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_familia` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_taxa` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `detalhes` text NOT NULL,
  `atualizacao` datetime NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.stock_produtos: ~2 rows (approximately)
/*!40000 ALTER TABLE `stock_produtos` DISABLE KEYS */;
INSERT IGNORE INTO `stock_produtos` (`id_produto`, `id_familia`, `designacao`, `descricao`, `imagem`, `preco`, `id_taxa`, `quantidade`, `detalhes`, `atualizacao`) VALUES
	(1, 3, 'Computador Gamer', 'Computador com os melhores componentes...', '1565975608058.jpg', 1000.00, 2, 100, 'Nada nos detalhes.', '2019-08-16 18:13:28'),
	(2, 3, 'Computador de viagem', 'texto da descrição', '1567005693800.jpg', 2500.00, 2, 10, 'texto dos detalhes', '2019-08-28 16:21:33');
/*!40000 ALTER TABLE `stock_produtos` ENABLE KEYS */;

-- Dumping structure for table projetogeral.stock_taxas
CREATE TABLE IF NOT EXISTS `stock_taxas` (
  `id_taxa` int(11) NOT NULL AUTO_INCREMENT,
  `designacao` varchar(50) NOT NULL,
  `percentagem` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id_taxa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.stock_taxas: ~2 rows (approximately)
/*!40000 ALTER TABLE `stock_taxas` DISABLE KEYS */;
INSERT IGNORE INTO `stock_taxas` (`id_taxa`, `designacao`, `percentagem`) VALUES
	(1, 'Taxa Maior', 15.00),
	(2, 'Taxa Menor', 5.00);
/*!40000 ALTER TABLE `stock_taxas` ENABLE KEYS */;

-- Dumping structure for table projetogeral.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `passwrd` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `profile` varchar(500) NOT NULL,
  `purl` varchar(20) NOT NULL,
  `purl_time` datetime NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `deleted` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table projetogeral.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id_user`, `username`, `passwrd`, `name`, `email`, `last_login`, `profile`, `purl`, `purl_time`, `active`, `deleted`) VALUES
	(2, 'joao', 'd5d849bdba01233f855b16da071127ae', 'João Ribeiro', 'teste@gmail.com', '2019-05-25 19:35:36', 'admin', '', '0000-00-00 00:00:00', b'1', 0),
	(7, 'ana', 'd5d849bdba01233f855b16da071127ae', 'Ana Moderadora', 'Ana@gmail.com', '2019-05-25 19:34:57', 'moderator', '', '0000-00-00 00:00:00', b'1', 0),
	(8, 'teste', 'e7cb549a4cb5aadb4459b03fd67d553b', 'teste', 'teste1@gmail.com', '0000-00-00 00:00:00', 'user', '', '0000-00-00 00:00:00', b'1', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
