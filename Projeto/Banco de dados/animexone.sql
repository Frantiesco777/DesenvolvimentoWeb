-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/06/2025 às 03:21
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
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animes`
--

INSERT INTO `animes` (`id`, `nome`, `imagem`, `link`, `categoria`, `criado_em`) VALUES
(1, 'Dr. Stone', 'imagens/Dr_stone.jpg	', './generos/Páginas/Dr. Stone/dr_stone.php', 'assistindo', '2025-06-06 00:35:21'),
(2, 'Kill la Kill', 'imagens/Kill_la_Kill.jpg', './generos/Páginas/Kill la Kill/kill_la_kill.html', 'assistindo', '2025-06-06 00:35:21'),
(3, 'Dan Da Dan', 'imagens/dan_da_dan.jpg', '', '', '2025-06-06 00:58:03');

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
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `imagen`, `criado_em`) VALUES
(3, 'EvilLucifer', 'francisco.cardoso.teixeira777@gmail.com', '$2y$10$pg1ZW6G1raZ4v2/exISg1u4lm4aACo3uFXOzkaBT1pmjUDLfAtp92', NULL, '2025-06-05 23:49:27'),
(4, 'Evil', 'toto@gmail.com', '$2y$10$zlZPBZn2x3qFFG9ACo3uSuwcHce63mxDCpG6GOFIiXtW1xBJNLU7q', NULL, '2025-06-06 00:01:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
