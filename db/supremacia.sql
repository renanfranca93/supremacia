-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Set-2021 às 13:40
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `supremacia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `tiles` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `food1` int(11) DEFAULT 0,
  `wood1` int(11) DEFAULT 0,
  `stone1` int(11) DEFAULT 0,
  `food2` int(11) DEFAULT 0,
  `wood2` int(11) DEFAULT 0,
  `stone2` int(11) DEFAULT 0,
  `choose1` int(11) DEFAULT NULL,
  `choose2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `session`
--

INSERT INTO `session` (`id`, `tiles`, `status`, `food1`, `wood1`, `stone1`, `food2`, `wood2`, `stone2`, `choose1`, `choose2`) VALUES
(6, 'field,rock,field,mountain,water,field,rock,forest,forest,forest,field,forest,rock,mountain,mountain,forest,field,field,rock,field,field,rock,rock,forest,field,water,field,water,field,field,rock,forest,forest,field,town,triTile,town', 1, 21, 8, 21, 0, 0, 0, 7, 3),
(7, 'rock,field,field,rock,forest,rock,mountain,field,forest,forest,field,field,water,field,field,forest,field,forest,field,field,field,forest,mountain,field,rock,rock,rock,forest,forest,water,field,rock,mountain,water,town,triTile,town', 1, 0, 0, 0, 0, 0, 0, NULL, NULL),
(8, 'field,field,forest,forest,rock,forest,field,field,field,field,field,field,rock,mountain,rock,rock,forest,field,rock,water,field,field,forest,rock,rock,field,forest,water,forest,water,mountain,forest,mountain,field,town,triTile,town', 1, 0, 0, 0, 0, 0, 0, NULL, NULL),
(9, 'field,forest,water,field,forest,field,field,field,forest,rock,field,mountain,rock,rock,forest,forest,field,field,rock,forest,mountain,field,forest,rock,field,water,forest,field,mountain,field,rock,water,rock,field,town,triTile,town', 1, 2, 3, 2, 0, 0, 0, 2, NULL),
(10, 'forest,rock,forest,mountain,rock,field,water,rock,field,field,water,field,field,mountain,field,field,forest,forest,field,forest,field,water,rock,field,mountain,rock,forest,forest,field,field,rock,rock,field,forest,town,triTile,town', 1, 4, 2, 4, 0, 0, 0, 2, 3),
(11, 'forest,rock,forest,mountain,rock,field,field,forest,water,field,rock,field,field,water,field,field,forest,rock,mountain,field,rock,field,forest,water,field,field,field,rock,forest,forest,rock,field,mountain,forest,town,triTile,town', 1, 0, 1, 0, 0, 0, 0, 2, NULL),
(12, 'rock,water,water,field,field,forest,rock,rock,mountain,mountain,field,rock,forest,field,rock,forest,field,water,forest,field,forest,rock,field,field,field,forest,rock,forest,mountain,field,forest,field,field,field,town,triTile,town', 1, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiles`
--

CREATE TABLE `tiles` (
  `id` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `tile` int(11) NOT NULL,
  `player1` int(11) DEFAULT NULL,
  `player2` int(11) DEFAULT NULL,
  `build` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tiles`
--

INSERT INTO `tiles` (`id`, `id_session`, `tile`, `player1`, `player2`, `build`) VALUES
(61, 6, 35, 1, 0, NULL),
(62, 6, 36, NULL, NULL, 1),
(63, 6, 37, NULL, 3, NULL),
(69, 6, 1, 4, 0, 1),
(70, 7, 35, 1, NULL, NULL),
(71, 7, 36, NULL, NULL, NULL),
(72, 7, 37, NULL, 3, NULL),
(73, 7, 1, 1, NULL, 2),
(74, 7, 4, 1, NULL, NULL),
(75, 7, 9, NULL, NULL, NULL),
(76, 6, 4, 2, NULL, NULL),
(77, 6, 10, 1, NULL, NULL),
(78, 6, 9, 1, NULL, NULL),
(79, 6, 8, NULL, NULL, NULL),
(80, 6, 3, 2, NULL, NULL),
(81, 6, 4, 2, NULL, NULL),
(82, 8, 35, 3, NULL, NULL),
(83, 8, 36, NULL, NULL, NULL),
(84, 8, 37, NULL, 10, NULL),
(85, 8, 1, NULL, NULL, NULL),
(86, 8, 4, NULL, NULL, NULL),
(87, 8, 10, NULL, NULL, NULL),
(88, 8, 9, NULL, NULL, NULL),
(89, 8, 8, NULL, NULL, NULL),
(90, 8, 3, NULL, NULL, NULL),
(91, 9, 35, 0, NULL, NULL),
(92, 9, 36, NULL, NULL, NULL),
(93, 9, 37, NULL, 3, NULL),
(94, 9, 4, 1, NULL, NULL),
(95, 9, 10, 1, NULL, NULL),
(96, 9, 5, 1, NULL, NULL),
(97, 10, 35, 0, NULL, NULL),
(98, 10, 36, NULL, NULL, NULL),
(99, 10, 37, NULL, 3, NULL),
(100, 10, 1, 0, NULL, 1),
(101, 10, 4, 0, NULL, NULL),
(102, 10, 3, NULL, NULL, NULL),
(103, 10, 1, 1, 2, NULL),
(104, 10, 10, 1, NULL, NULL),
(105, 10, 8, 1, NULL, NULL),
(106, 10, 1, NULL, NULL, NULL),
(107, 11, 35, 2, NULL, NULL),
(108, 11, 36, NULL, NULL, NULL),
(109, 11, 37, NULL, 3, NULL),
(110, 11, 1, 1, NULL, NULL),
(111, 11, 4, NULL, NULL, NULL),
(112, 12, 35, 3, NULL, NULL),
(113, 12, 36, NULL, NULL, NULL),
(114, 12, 37, NULL, 3, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tiles`
--
ALTER TABLE `tiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tiles`
--
ALTER TABLE `tiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
