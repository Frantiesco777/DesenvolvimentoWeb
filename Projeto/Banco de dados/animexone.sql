-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 03:28
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `animexone`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animes`
--

CREATE TABLE `animes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `temporada` varchar(250) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animes`
--

INSERT INTO `animes` (`id`, `nome`, `imagem`, `link`, `categoria`, `temporada`, `criado_em`) VALUES
(1, 'Dr. Stone', 'imagens/Dr_stone.jpg	', '', 'assistindo', NULL, '2025-06-06 00:35:21'),
(2, 'Kill la Kill', 'imagens/Kill_la_Kill.jpg', '', 'assistindo', NULL, '2025-06-06 00:35:21'),
(3, 'Dan Da Dan', 'imagens/dan_da_dan.jpg', '', 'assistindo', 'Invernolkjlkjk', '2025-06-06 00:58:03'),
(4, 'Chainsaw Man', 'imagens/chainsaw_man.jpg', '', 'assistindo', '54564kjk', '2025-06-10 00:43:03'),
(5, 'My Hero Academia: Vigilantes', 'imagens/vigilantes.jpg', '', 'em_breve', NULL, '2025-06-10 00:51:03'),
(6, 'Kimi to Boku', 'imagens/kimi_to_boku.jpg', '', 'em_breve', NULL, '2025-06-10 00:55:13'),
(7, 'Nigejouzu', 'imagens/nigejouzu.jpg', '', 'em_breve', NULL, '2025-06-10 00:55:13'),
(8, 'Mayonaka Punch', 'imagens/mayonaka_punch.jpg', '', 'em_breve', NULL, '2025-06-10 01:02:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagem_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `imagen`, `criado_em`, `imagem_perfil`) VALUES
(5, 'Francisco Cardoso Teixeira', 'francisco.cardoso.teixeira777@gmail.com', '$2y$10$i0KFkM/aib4EHRrcB7F7Y.U2yRYds6YdMaNUSN0wvB.hp0X0NCxgy', NULL, '2025-06-09 22:36:40', NULL),
(7, 'EvilLucifer', 'evil@gmail.com', '$2y$10$zF/O6Og3HTTM2FfbcmVOGO.Hsp6a2BcxSc0ZfFkpELyqZF17OASsK', NULL, '2025-06-10 01:14:04', 'uploads/perfil_684786dcde59d1.81219649.jpg'),
(8, 'Thierry', 'thierry@gmail.com', '$2y$10$hT0xZqMgLNFrpO7coA6IPOUopYBmqpZi42jmAUmHr.dEZoaWH60YW', NULL, '2025-06-10 01:09:12', 'uploads/perfil_684785b860bbf3.46654787.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animes`
--
ALTER TABLE `animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
