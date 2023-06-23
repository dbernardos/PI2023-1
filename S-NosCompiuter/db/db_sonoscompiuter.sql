-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3312
-- Tempo de geração: 12-Jun-2023 às 17:09
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_sonoscompiuter`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(5) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admin_login`
--

INSERT INTO `admin_login` (`id`, `login`, `senha`) VALUES
(7, 'admin', '$2y$12$fmhcl4MmSpvWGOJl3mRYKedQYcbgKN.Titfrgt6Clvc2vYLbd7LOK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cpu`
--

CREATE TABLE `cpu` (
  `id` int(5) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `soquete` varchar(50) DEFAULT NULL,
  `pontuacao` int(6) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `nome_cpu` varchar(50) NOT NULL,
  `gpu_integrado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cpu`
--

INSERT INTO `cpu` (`id`, `marca`, `soquete`, `pontuacao`, `preco`, `nome_cpu`, `gpu_integrado`) VALUES
(1, 'Intel', '1200', 8806, 440, 'i3-10100f', NULL),
(3, 'Intel', '1700', 15207, 980, 'i3-13100f', NULL),
(5, 'Intel', '1200', 17170, 780, 'i5-11400f', NULL),
(8, 'Intel', '1700', 27467, 1770, 'i5-12600k', 'UHD Graphics 770'),
(10, 'Intel', '1700', 46829, 2800, 'i7-13700k', 'UHD Graphics 770'),
(11, 'Intel', '1200', 25381, 2500, 'i9-11900k', 'UHD Graphics 750'),
(12, 'Intel', '1700', 37240, 2500, 'i9-12900f', NULL),
(13, 'AMD', 'AM4', 11194, 449, 'Ryzen 3 4100', NULL),
(14, 'AMD', 'AM4', 17795, 639, 'Ryzen 5 3600', NULL),
(15, 'AMD', 'AM4', 21632, 899, 'Ryzen 5 5600', NULL),
(16, 'AMD', 'AM4', 28073, 1499, 'Ryzen 7 5800X', NULL),
(17, 'AMD', 'AM4', 39307, 1999, 'Ryzen 9 5900X', NULL),
(18, 'Intel', '1200', 8806, 699, 'i3-10100', 'UHD Graphics 630');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gpu`
--

CREATE TABLE `gpu` (
  `id` int(5) NOT NULL,
  `chip_grafico` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `pontuacao` int(20) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `nome_gpu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gpu`
--

INSERT INTO `gpu` (`id`, `chip_grafico`, `marca`, `pontuacao`, `preco`, `nome_gpu`) VALUES
(3, 'NVIDIA', 'Asus', 6045, 1999, 'GTX 1650'),
(4, 'NVIDIA', 'Galax', 16612, 2969, 'RTX 2060 SUPER'),
(5, 'NVIDIA', 'MSI', 12811, 1529, 'GTX 1660 SUPER'),
(6, 'NVIDIA', 'Asus', 13190, 4589, 'RTX 2080 '),
(7, 'NVIDIA', 'PNY', 13032, 1899, 'RTX 3050 '),
(8, 'NVIDIA', 'Asus', 22513, 3799, 'RTX 3070'),
(9, 'NVIDIA', 'Gigabyte', 39551, 11489, 'RTX 4090'),
(10, 'AMD', 'Red Dragon', 8915, 911, 'RX 580 '),
(11, 'AMD', 'Gigabyte', 9497, 1599, 'RX 6500 XT'),
(12, 'AMD', 'Sapphire', 19920, 2759, 'RX 6700 XT'),
(13, 'AMD', 'Sapphire', 31873, 7629, 'RX 7900 XTX'),
(14, 'AMD', 'Sapphire', 29145, 10923, 'RX 6950 XT'),
(15, 'AMD', 'Gigabyte', 25108, 5698, 'RX 6800 XT'),
(17, 'Intel', 'Intel', 1807, 0, 'UHD Graphics 770'),
(18, 'Intel', 'Intel', 1749, 0, 'UHD Graphics 750'),
(20, 'Intel', 'Intel', 1259, 0, 'UHD Graphics 630');

-- --------------------------------------------------------

--
-- Estrutura da tabela `placa_mae`
--

CREATE TABLE `placa_mae` (
  `id` int(5) NOT NULL,
  `soquete_mae` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `nome_mae` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `placa_mae`
--

INSERT INTO `placa_mae` (`id`, `soquete_mae`, `marca`, `preco`, `nome_mae`) VALUES
(23, '1200', 'Gigabyte', 549, 'H410M'),
(24, '1200', 'Asus', 809, 'B460M-PLUS'),
(25, '1700', 'Asus', 639, 'H610M-E'),
(26, 'AM4', 'Asus', 579, 'A520M-E'),
(27, 'AM4', 'Gigabyte', 715, 'B450M'),
(28, '1700', 'Asus', 1799, 'Z690-Plus');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisito_software`
--

CREATE TABLE `requisito_software` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `pontuacao_gpu` int(5) DEFAULT NULL,
  `pontuacao_cpu` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `requisito_software`
--

INSERT INTO `requisito_software` (`id`, `nome`, `pontuacao_gpu`, `pontuacao_cpu`) VALUES
(14, 'Call of Duty: Warzone', 11744, 4113),
(16, 'Battlefield V', 10070, 7236),
(17, 'Cyberpunk 2077', 9642, 4964),
(18, 'Destiny 2', 10070, 5513),
(19, 'Valorant', 824, 957),
(20, 'Watch Dogs Legion', 6024, 4867),
(21, 'Scarlet Nexus', 4771, 4683),
(22, 'Red Dead Redemption 2', 10070, 6914),
(23, 'Naruto Ultimate Ninja Storm 4', 2790, 1492),
(24, 'Mafia 3', 3990, 4113),
(25, 'Counter Strike:Global Offensive', 400, 600),
(26, 'Word', 10, 10),
(27, 'Excel', 10, 10),
(28, 'PowerPoint', 10, 10),
(29, 'Outlook', 10, 10),
(30, 'Photoshop', 10, 7011),
(31, 'Sony Vegas', 12000, 7011),
(32, 'Skype', 200, 200),
(33, 'Discord', 200, 200),
(34, 'Adobe Audition', 10, 10),
(35, 'Adobe Illustrator', 10, 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `placa_mae`
--
ALTER TABLE `placa_mae`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `requisito_software`
--
ALTER TABLE `requisito_software`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `gpu`
--
ALTER TABLE `gpu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `placa_mae`
--
ALTER TABLE `placa_mae`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `requisito_software`
--
ALTER TABLE `requisito_software`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
