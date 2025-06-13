-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2025 às 03:21
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
-- Estrutura para tabela `animes_geral`
--

CREATE TABLE `animes_geral` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `temporada` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `genero` varchar(255) DEFAULT NULL,
  `episodios` int(11) NOT NULL,
  `estudio` varchar(255) NOT NULL,
  `sub_generos` varchar(255) NOT NULL,
  `fonte` varchar(255) NOT NULL,
  `sinopse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animes_geral`
--

INSERT INTO `animes_geral` (`id`, `nome`, `imagem`, `temporada`, `criado_em`, `genero`, `episodios`, `estudio`, `sub_generos`, `fonte`, `sinopse`) VALUES
(3, 'One Piece', 'imagens/one_piece.jpg', 'Outono', '2025-06-12 23:44:35', 'Shounen', 1133, 'Toei Animation', 'Ação , Aventura , Fantasia', 'Mangá', 'Sobrevivendo com dificuldade em um barril após passar por um terrível redemoinho no mar, o despreocupado Monkey D. Luffy acaba a bordo de um navio sob ataque de piratas temíveis. Apesar de ser um adolescente de aparência ingênua, ele não deve ser subestimado. Inigualável em batalha, Luffy é um pirata que persegue resolutamente o cobiçado tesouro One Piece e o título de Rei dos Piratas que o acompanha.'),
(4, 'Naruto', 'imagens/naruto.jpg', 'Outono', '2025-06-12 23:44:35', 'Shounen', 220, 'Pierrot', 'Ação , Aventura , Fantasia', 'Mangá', 'Momentos antes do nascimento de Naruto Uzumaki, um enorme demônio conhecido como a Raposa de Nove Caudas atacou Konohagakure, a Vila Oculta da Folha, e causou estragos. Para pôr fim à fúria do demônio, o líder da vila, o Quarto Hokage, sacrificou sua vida e selou a fera monstruosa dentro do recém-nascido Naruto.'),
(5, 'Chainsaw Man', 'imagens/chainsaw_man.jpg', 'Outono', '2025-06-12 23:47:46', 'Shounen', 12, 'MAPPA', 'Ação, Fantasia', 'Mangá', 'Denji é privado de uma vida normal de adolescente, restando-lhe apenas a dívida avassaladora de seu pai caloteiro. Sua única companhia é seu animal de estimação, o demônio da motosserra Pochita, com quem ele mata demônios por dinheiro que inevitavelmente acaba nos bolsos da yakuza. Tudo o que Denji pode fazer é sonhar com uma vida boa e simples: uma com comida deliciosa e uma linda namorada ao seu lado. Mas um ato de traição gananciosa da yakuza leva à morte brutal e prematura de Denji, destruindo toda a esperança de que ele alcance a felicidade.'),
(6, 'Black Clover', 'imagens/black_clover.jpg', 'Outono', '2025-06-12 23:47:46', 'Shounen', 170, 'Pierrot', 'Ação, Fantasia', 'Mangá', 'Asta e Yuno foram abandonados na mesma igreja, no mesmo dia. Criados juntos quando crianças, conheceram o \"Rei Mago\" — título dado ao mago mais forte do reino — e prometeram que competiriam entre si pela posição de próximo Rei Mago. No entanto, à medida que cresciam, a diferença gritante entre eles se tornava evidente. Enquanto Yuno é capaz de manejar magia com poder e controle incríveis, Asta não consegue usar magia alguma e tenta desesperadamente despertar seus poderes treinando fisicamente.'),
(7, 'Kimetsu no Yaiba', 'imagens/kimetsu.jpg', 'Primavera', '2025-06-12 23:51:12', 'Shounen', 26, 'ufotable', 'Ação , Premiado , Sobrenatural', 'Mangá', 'Desde a morte de seu pai, o fardo de sustentar a família recai sobre os ombros de Tanjirou Kamado. Apesar de viverem na miséria em uma montanha remota, a família Kamado consegue desfrutar de uma vida relativamente pacífica e feliz. Um dia, Tanjirou decide ir até a aldeia local para ganhar algum dinheiro vendendo carvão. No caminho de volta, a noite cai, forçando Tanjirou a se abrigar na casa de um homem estranho, que o avisa da existência de demônios carnívoros que espreitam na floresta à noite.'),
(8, 'Dragon Ball Z', 'imagens/dragon_ball_z.png', 'Primavera', '2025-06-12 23:51:12', 'Shounen', 291, 'Toei Animation', 'Ação , Aventura , Comédia , Fantasia', 'Mangá', 'Cinco anos após vencer o torneio de Artes Marciais, Gokuu agora vive uma vida pacífica com sua esposa e filho. Isso muda, no entanto, com a chegada de um misterioso inimigo chamado Raditz, que se apresenta como o irmão há muito perdido de Gokuu. Ele revela que Gokuu é descendente da outrora poderosa, mas agora praticamente extinta raça Saiyajin, cujo planeta natal foi aniquilado. Quando foi enviado à Terra ainda bebê, o único propósito de Gokuu era conquistar e destruir o planeta; mas após sofrer amnésia devido a um ferimento na cabeça, sua natureza violenta e selvagem mudou, e em vez disso foi criado como um menino gentil e bem-educado, agora lutando para proteger os outros.'),
(9, 'Edens Zero', 'imagens/edens_zero.jpg', 'Primavera', '2025-06-13 00:05:07', 'Shounen', 25, 'JCStaff', 'Ação , Aventura , Fantasia , Ficção científica', 'Mangá', 'Durante toda a sua vida, Shiki viveu cercado por máquinas. No Reino Granbell, um parque de diversões há muito abandonado, ele é o único da sua espécie por perto. Isto é, até Rebecca Bluegarden e seu companheiro felino Happy chegarem, sem saber que são os primeiros visitantes de Granbell em cem anos. O objetivo deles é fazer vídeos divertidos para o canal B-Cube, mas o que eles encontram em vez disso é um amigo no desajeitado Shiki.'),
(10, 'One Punch Man', 'imagens/one_punch_man.jpg', 'Outono', '2025-06-13 00:05:07', 'Shounen', 12, 'Madhouse', 'Ação , Comédia', 'Web manga', 'O aparentemente inexpressivo Saitama tem um hobby bastante peculiar: ser um herói. Para realizar seu sonho de infância, Saitama treinou incansavelmente por três anos, perdendo todo o cabelo no processo. Agora, Saitama é tão poderoso que pode derrotar qualquer inimigo com apenas um soco. No entanto, não ter ninguém capaz de igualar sua força levou Saitama a um problema inesperado: ele não consegue mais desfrutar da emoção da batalha e ficou entediado.'),
(11, 'Konosuba', 'imagens/konosuba.jpg', NULL, '2025-06-13 01:14:59', 'Comedia', 0, '', '', '', ''),
(14, 'Gintama', 'imagens/gintama.jpg', NULL, '2025-06-13 01:16:58', 'Comedia', 0, '', '', '', '');

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
(7, 'EvilLucifer', 'evil@gmail.com', '$2y$10$zF/O6Og3HTTM2FfbcmVOGO.Hsp6a2BcxSc0ZfFkpELyqZF17OASsK', NULL, '2025-06-12 23:02:01', 'uploads/perfil_684b5c69436e02.54358535.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animes_geral`
--
ALTER TABLE `animes_geral`
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
-- AUTO_INCREMENT de tabela `animes_geral`
--
ALTER TABLE `animes_geral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
