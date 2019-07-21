-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2019 at 01:50 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projetogeral`
--

-- --------------------------------------------------------

--
-- Table structure for table `criptografia`
--

CREATE TABLE `criptografia` (
  `id_cartao` int(10) UNSIGNED NOT NULL,
  `numero_cartao` varbinary(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `criptografia`
--

INSERT INTO `criptografia` (`id_cartao`, `numero_cartao`) VALUES
(1, 0xd55b7e6c900dbd7d066fc3d11da02be1),
(2, 0x0bb4273ec93108edb6c2af3cc68060ee);

-- --------------------------------------------------------

--
-- Table structure for table `stock_familias`
--

CREATE TABLE `stock_familias` (
  `id_familia` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `imagem` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_familias`
--

INSERT INTO `stock_familias` (`id_familia`, `id_parent`, `designacao`, `imagem`) VALUES
(2, 7, 'Computadores desktop', ''),
(3, 7, 'Computadores portáteis', ''),
(4, 0, 'Teclados PC', ''),
(5, 4, 'Teclados Gaming', ''),
(6, 5, 'Teclado XPTO', ''),
(7, 0, 'Computadores', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movimentos`
--

CREATE TABLE `stock_movimentos` (
  `id_movimento` int(11) NOT NULL,
  `source` varchar(20) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `quantidade` decimal(10,2) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `entrada_saida` varchar(20) NOT NULL,
  `data_movimento` datetime NOT NULL,
  `observacoes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_produtos`
--

CREATE TABLE `stock_produtos` (
  `id_produto` int(11) NOT NULL,
  `id_familia` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `imagem` varchar(250) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_taxa` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `detalhes` text NOT NULL,
  `atualizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_produtos`
--

INSERT INTO `stock_produtos` (`id_produto`, `id_familia`, `designacao`, `descricao`, `imagem`, `preco`, `id_taxa`, `quantidade`, `detalhes`, `atualizacao`) VALUES
(1, 0, 'Computador x123', 'texto da descrição', 'computador_x123.jpg', '1000.00', 0, 12, 'texto dos detalhes', '2019-07-21 00:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_taxas`
--

CREATE TABLE `stock_taxas` (
  `id_taxa` int(11) NOT NULL,
  `designacao` varchar(50) NOT NULL,
  `percentagem` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_taxas`
--

INSERT INTO `stock_taxas` (`id_taxa`, `designacao`, `percentagem`) VALUES
(1, 'Taxa Maior', '15.00'),
(2, 'Taxa Menor', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwrd` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `profile` varchar(500) NOT NULL,
  `purl` varchar(20) NOT NULL,
  `purl_time` datetime NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `deleted` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `passwrd`, `name`, `email`, `last_login`, `profile`, `purl`, `purl_time`, `active`, `deleted`) VALUES
(2, 'joao', 'd5d849bdba01233f855b16da071127ae', 'João Ribeiro', 'teste@gmail.com', '2019-05-25 19:35:36', 'admin', '', '0000-00-00 00:00:00', b'1', 0),
(7, 'ana', 'd5d849bdba01233f855b16da071127ae', 'Ana Moderadora', 'Ana@gmail.com', '2019-05-25 19:34:57', 'moderator', '', '0000-00-00 00:00:00', b'1', 0),
(8, 'teste', 'e7cb549a4cb5aadb4459b03fd67d553b', 'teste', 'teste1@gmail.com', '0000-00-00 00:00:00', 'user', '', '0000-00-00 00:00:00', b'1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criptografia`
--
ALTER TABLE `criptografia`
  ADD PRIMARY KEY (`id_cartao`);

--
-- Indexes for table `stock_familias`
--
ALTER TABLE `stock_familias`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indexes for table `stock_movimentos`
--
ALTER TABLE `stock_movimentos`
  ADD PRIMARY KEY (`id_movimento`);

--
-- Indexes for table `stock_produtos`
--
ALTER TABLE `stock_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `stock_taxas`
--
ALTER TABLE `stock_taxas`
  ADD PRIMARY KEY (`id_taxa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criptografia`
--
ALTER TABLE `criptografia`
  MODIFY `id_cartao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_familias`
--
ALTER TABLE `stock_familias`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_movimentos`
--
ALTER TABLE `stock_movimentos`
  MODIFY `id_movimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_produtos`
--
ALTER TABLE `stock_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_taxas`
--
ALTER TABLE `stock_taxas`
  MODIFY `id_taxa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
