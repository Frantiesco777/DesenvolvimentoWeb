-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/08/2025 às 02:39
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
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `genero` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animes_geral`
--

INSERT INTO `animes_geral` (`id`, `nome`, `imagem`, `criado_em`, `genero`) VALUES
(53, 'Dragon Ball Z', 'imagens/dragon_ball_z.png', '2025-07-31 23:46:04', 'Shounen'),
(55, 'Kimetsu no Yaiba', 'imagens/kimetsu.jpg', '2025-08-01 00:13:50', 'Shounen'),
(56, 'Chainsaw Man', 'imagens/chainsaw_man.jpg', '2025-08-01 00:19:26', 'Shounen'),
(57, 'Darling in the Franxx', 'imagens/Darling_in_the_Franxx.jpg', '2025-08-01 00:22:52', 'Romance'),
(58, 'Gachiakuta', 'imagens/gachiakuta.jpg', '2025-08-01 23:03:47', 'Shounen'),
(61, 'Sono Bisque Doll', 'imagens/sono_bisque_doll.png', '2025-08-01 23:57:54', 'Romance'),
(62, 'Boruto: Naruto Next Generations', 'imagens/boruto.png', '2025-08-02 00:03:01', 'Shounen');

-- --------------------------------------------------------

--
-- Estrutura para tabela `episodios`
--

CREATE TABLE `episodios` (
  `id` int(11) NOT NULL,
  `temporada_id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `conteudo` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `episodios`
--

INSERT INTO `episodios` (`id`, `temporada_id`, `numero`, `link`, `conteudo`) VALUES
(1, 9, 1, NULL, ''),
(2, 9, 2, NULL, ''),
(3, 9, 3, NULL, ''),
(4, 9, 4, NULL, ''),
(5, 9, 5, NULL, ''),
(6, 9, 6, NULL, ''),
(7, 9, 7, NULL, ''),
(8, 9, 8, NULL, ''),
(9, 9, 9, NULL, ''),
(10, 9, 10, NULL, ''),
(11, 9, 11, NULL, ''),
(12, 9, 12, NULL, ''),
(13, 9, 13, NULL, ''),
(14, 9, 14, NULL, ''),
(15, 9, 15, NULL, ''),
(16, 9, 16, NULL, ''),
(17, 9, 17, NULL, ''),
(18, 9, 18, NULL, ''),
(19, 9, 19, NULL, ''),
(20, 9, 20, NULL, ''),
(21, 9, 21, NULL, ''),
(22, 9, 22, NULL, ''),
(23, 9, 23, NULL, ''),
(24, 9, 24, NULL, ''),
(25, 9, 25, NULL, ''),
(26, 9, 26, NULL, ''),
(27, 9, 27, NULL, ''),
(28, 9, 28, NULL, ''),
(29, 9, 29, NULL, ''),
(30, 9, 30, NULL, ''),
(31, 9, 31, NULL, ''),
(32, 9, 32, NULL, ''),
(33, 9, 33, NULL, ''),
(34, 9, 34, NULL, ''),
(35, 9, 35, NULL, ''),
(36, 9, 36, NULL, ''),
(37, 9, 37, NULL, ''),
(38, 9, 38, NULL, ''),
(39, 9, 39, NULL, ''),
(40, 9, 40, NULL, ''),
(41, 9, 41, NULL, ''),
(42, 9, 42, NULL, ''),
(43, 9, 43, NULL, ''),
(44, 9, 44, NULL, ''),
(45, 9, 45, NULL, ''),
(46, 9, 46, NULL, ''),
(47, 9, 47, NULL, ''),
(48, 9, 48, NULL, ''),
(49, 9, 49, NULL, ''),
(50, 9, 50, NULL, ''),
(51, 9, 51, NULL, ''),
(52, 9, 52, NULL, ''),
(53, 9, 53, NULL, ''),
(54, 9, 54, NULL, ''),
(55, 9, 55, NULL, ''),
(56, 9, 56, NULL, ''),
(57, 9, 57, NULL, ''),
(58, 9, 58, NULL, ''),
(59, 9, 59, NULL, ''),
(60, 9, 60, NULL, ''),
(61, 9, 61, NULL, ''),
(62, 9, 62, NULL, ''),
(63, 9, 63, NULL, ''),
(64, 9, 64, NULL, ''),
(65, 9, 65, NULL, ''),
(66, 9, 66, NULL, ''),
(67, 9, 67, NULL, ''),
(68, 9, 68, NULL, ''),
(69, 9, 69, NULL, ''),
(70, 9, 70, NULL, ''),
(71, 9, 71, NULL, ''),
(72, 9, 72, NULL, ''),
(73, 9, 73, NULL, ''),
(74, 9, 74, NULL, ''),
(75, 9, 75, NULL, ''),
(76, 9, 76, NULL, ''),
(77, 9, 77, NULL, ''),
(78, 9, 78, NULL, ''),
(79, 9, 79, NULL, ''),
(80, 9, 80, NULL, ''),
(81, 9, 81, NULL, ''),
(82, 9, 82, NULL, ''),
(83, 9, 83, NULL, ''),
(84, 9, 84, NULL, ''),
(85, 9, 85, NULL, ''),
(86, 9, 86, NULL, ''),
(87, 9, 87, NULL, ''),
(88, 9, 88, NULL, ''),
(89, 9, 89, NULL, ''),
(90, 9, 90, NULL, ''),
(91, 9, 91, NULL, ''),
(92, 9, 92, NULL, ''),
(93, 9, 93, NULL, ''),
(94, 9, 94, NULL, ''),
(95, 9, 95, NULL, ''),
(96, 9, 96, NULL, ''),
(97, 9, 97, NULL, ''),
(98, 9, 98, NULL, ''),
(99, 9, 99, NULL, ''),
(100, 9, 100, NULL, ''),
(101, 9, 101, NULL, ''),
(102, 9, 102, NULL, ''),
(103, 9, 103, NULL, ''),
(104, 9, 104, NULL, ''),
(105, 9, 105, NULL, ''),
(106, 9, 106, NULL, ''),
(107, 9, 107, NULL, ''),
(108, 9, 108, NULL, ''),
(109, 9, 109, NULL, ''),
(110, 9, 110, NULL, ''),
(111, 9, 111, NULL, ''),
(112, 9, 112, NULL, ''),
(113, 9, 113, NULL, ''),
(114, 9, 114, NULL, ''),
(115, 9, 115, NULL, ''),
(116, 9, 116, NULL, ''),
(117, 9, 117, NULL, ''),
(118, 9, 118, NULL, ''),
(119, 9, 119, NULL, ''),
(120, 9, 120, NULL, ''),
(121, 9, 121, NULL, ''),
(122, 9, 122, NULL, ''),
(123, 9, 123, NULL, ''),
(124, 9, 124, NULL, ''),
(125, 9, 125, NULL, ''),
(126, 9, 126, NULL, ''),
(127, 9, 127, NULL, ''),
(128, 9, 128, NULL, ''),
(129, 9, 129, NULL, ''),
(130, 9, 130, NULL, ''),
(131, 9, 131, NULL, ''),
(132, 9, 132, NULL, ''),
(133, 9, 133, NULL, ''),
(134, 9, 134, NULL, ''),
(135, 9, 135, NULL, ''),
(136, 9, 136, NULL, ''),
(137, 9, 137, NULL, ''),
(138, 9, 138, NULL, ''),
(139, 9, 139, NULL, ''),
(140, 9, 140, NULL, ''),
(141, 9, 141, NULL, ''),
(142, 9, 142, NULL, ''),
(143, 9, 143, NULL, ''),
(144, 9, 144, NULL, ''),
(145, 9, 145, NULL, ''),
(146, 9, 146, NULL, ''),
(147, 9, 147, NULL, ''),
(148, 9, 148, NULL, ''),
(149, 9, 149, NULL, ''),
(150, 9, 150, NULL, ''),
(151, 9, 151, NULL, ''),
(152, 9, 152, NULL, ''),
(153, 9, 153, NULL, ''),
(154, 9, 154, NULL, ''),
(155, 9, 155, NULL, ''),
(156, 9, 156, NULL, ''),
(157, 9, 157, NULL, ''),
(158, 9, 158, NULL, ''),
(159, 9, 159, NULL, ''),
(160, 9, 160, NULL, ''),
(161, 9, 161, NULL, ''),
(162, 9, 162, NULL, ''),
(163, 9, 163, NULL, ''),
(164, 9, 164, NULL, ''),
(165, 9, 165, NULL, ''),
(166, 9, 166, NULL, ''),
(167, 9, 167, NULL, ''),
(168, 9, 168, NULL, ''),
(169, 9, 169, NULL, ''),
(170, 9, 170, NULL, ''),
(171, 9, 171, NULL, ''),
(172, 9, 172, NULL, ''),
(173, 9, 173, NULL, ''),
(174, 9, 174, NULL, ''),
(175, 9, 175, NULL, ''),
(176, 9, 176, NULL, ''),
(177, 9, 177, NULL, ''),
(178, 9, 178, NULL, ''),
(179, 9, 179, NULL, ''),
(180, 9, 180, NULL, ''),
(181, 9, 181, NULL, ''),
(182, 9, 182, NULL, ''),
(183, 9, 183, NULL, ''),
(184, 9, 184, NULL, ''),
(185, 9, 185, NULL, ''),
(186, 9, 186, NULL, ''),
(187, 9, 187, NULL, ''),
(188, 9, 188, NULL, ''),
(189, 9, 189, NULL, ''),
(190, 9, 190, NULL, ''),
(191, 9, 191, NULL, ''),
(192, 9, 192, NULL, ''),
(193, 9, 193, NULL, ''),
(194, 9, 194, NULL, ''),
(195, 9, 195, NULL, ''),
(196, 9, 196, NULL, ''),
(197, 9, 197, NULL, ''),
(198, 9, 198, NULL, ''),
(199, 9, 199, NULL, ''),
(200, 9, 200, NULL, ''),
(201, 9, 201, NULL, ''),
(202, 9, 202, NULL, ''),
(203, 9, 203, NULL, ''),
(204, 9, 204, NULL, ''),
(205, 9, 205, NULL, ''),
(206, 9, 206, NULL, ''),
(207, 9, 207, NULL, ''),
(208, 9, 208, NULL, ''),
(209, 9, 209, NULL, ''),
(210, 9, 210, NULL, ''),
(211, 9, 211, NULL, ''),
(212, 9, 212, NULL, ''),
(213, 9, 213, NULL, ''),
(214, 9, 214, NULL, ''),
(215, 9, 215, NULL, ''),
(216, 9, 216, NULL, ''),
(217, 9, 217, NULL, ''),
(218, 9, 218, NULL, ''),
(219, 9, 219, NULL, ''),
(220, 9, 220, NULL, ''),
(221, 9, 221, NULL, ''),
(222, 9, 222, NULL, ''),
(223, 9, 223, NULL, ''),
(224, 9, 224, NULL, ''),
(225, 9, 225, NULL, ''),
(226, 9, 226, NULL, ''),
(227, 9, 227, NULL, ''),
(228, 9, 228, NULL, ''),
(229, 9, 229, NULL, ''),
(230, 9, 230, NULL, ''),
(231, 9, 231, NULL, ''),
(232, 9, 232, NULL, ''),
(233, 9, 233, NULL, ''),
(234, 9, 234, NULL, ''),
(235, 9, 235, NULL, ''),
(236, 9, 236, NULL, ''),
(237, 9, 237, NULL, ''),
(238, 9, 238, NULL, ''),
(239, 9, 239, NULL, ''),
(240, 9, 240, NULL, ''),
(241, 9, 241, NULL, ''),
(242, 9, 242, NULL, ''),
(243, 9, 243, NULL, ''),
(244, 9, 244, NULL, ''),
(245, 9, 245, NULL, ''),
(246, 9, 246, NULL, ''),
(247, 9, 247, NULL, ''),
(248, 9, 248, NULL, ''),
(249, 9, 249, NULL, ''),
(250, 9, 250, NULL, ''),
(251, 9, 251, NULL, ''),
(252, 9, 252, NULL, ''),
(253, 9, 253, NULL, ''),
(254, 9, 254, NULL, ''),
(255, 9, 255, NULL, ''),
(256, 9, 256, NULL, ''),
(257, 9, 257, NULL, ''),
(258, 9, 258, NULL, ''),
(259, 9, 259, NULL, ''),
(260, 9, 260, NULL, ''),
(261, 9, 261, NULL, ''),
(262, 9, 262, NULL, ''),
(263, 9, 263, NULL, ''),
(264, 9, 264, NULL, ''),
(265, 9, 265, NULL, ''),
(266, 9, 266, NULL, ''),
(267, 9, 267, NULL, ''),
(268, 9, 268, NULL, ''),
(269, 9, 269, NULL, ''),
(270, 9, 270, NULL, ''),
(271, 9, 271, NULL, ''),
(272, 9, 272, NULL, ''),
(273, 9, 273, NULL, ''),
(274, 9, 274, NULL, ''),
(275, 9, 275, NULL, ''),
(276, 9, 276, NULL, ''),
(277, 9, 277, NULL, ''),
(278, 9, 278, NULL, ''),
(279, 9, 279, NULL, ''),
(280, 9, 280, NULL, ''),
(281, 9, 281, NULL, ''),
(282, 9, 282, NULL, ''),
(283, 9, 283, NULL, ''),
(284, 9, 284, NULL, ''),
(285, 9, 285, NULL, ''),
(286, 9, 286, NULL, ''),
(287, 9, 287, NULL, ''),
(288, 9, 288, NULL, ''),
(289, 9, 289, NULL, ''),
(290, 9, 290, NULL, ''),
(291, 9, 291, NULL, ''),
(299, 12, 1, NULL, ''),
(300, 12, 2, NULL, ''),
(301, 12, 3, NULL, ''),
(302, 12, 4, NULL, ''),
(303, 12, 5, NULL, ''),
(304, 12, 6, NULL, ''),
(305, 12, 7, NULL, ''),
(306, 12, 8, NULL, ''),
(307, 12, 9, NULL, ''),
(308, 12, 10, NULL, ''),
(309, 12, 11, NULL, ''),
(310, 12, 12, NULL, ''),
(311, 12, 13, NULL, ''),
(312, 12, 14, NULL, ''),
(313, 12, 15, NULL, ''),
(314, 12, 16, NULL, ''),
(315, 12, 17, NULL, ''),
(316, 12, 18, NULL, ''),
(317, 12, 19, NULL, ''),
(318, 12, 20, NULL, ''),
(319, 12, 21, NULL, ''),
(320, 12, 22, NULL, ''),
(321, 12, 23, NULL, ''),
(322, 12, 24, NULL, ''),
(323, 12, 25, NULL, ''),
(324, 12, 26, NULL, ''),
(325, 13, 1, NULL, ''),
(326, 13, 2, NULL, ''),
(327, 13, 3, NULL, ''),
(328, 13, 4, NULL, ''),
(329, 13, 5, NULL, ''),
(330, 13, 6, NULL, ''),
(331, 13, 7, NULL, ''),
(332, 14, 1, NULL, ''),
(333, 14, 2, NULL, ''),
(334, 14, 3, NULL, ''),
(335, 14, 4, NULL, ''),
(336, 14, 5, NULL, ''),
(337, 14, 6, NULL, ''),
(338, 14, 7, NULL, ''),
(339, 14, 8, NULL, ''),
(340, 14, 9, NULL, ''),
(341, 14, 10, NULL, ''),
(342, 14, 11, NULL, ''),
(343, 15, 1, NULL, ''),
(344, 15, 2, NULL, ''),
(345, 15, 3, NULL, ''),
(346, 15, 4, NULL, ''),
(347, 15, 5, NULL, ''),
(348, 15, 6, NULL, ''),
(349, 15, 7, NULL, ''),
(350, 15, 8, NULL, ''),
(351, 15, 9, NULL, ''),
(352, 15, 10, NULL, ''),
(353, 15, 11, NULL, ''),
(354, 16, 1, NULL, ''),
(355, 16, 2, NULL, ''),
(356, 16, 3, NULL, ''),
(357, 16, 4, NULL, ''),
(358, 16, 5, NULL, ''),
(359, 16, 6, NULL, ''),
(360, 16, 7, NULL, ''),
(361, 16, 8, NULL, ''),
(362, 17, 1, NULL, ''),
(363, 17, 2, NULL, ''),
(364, 17, 3, NULL, ''),
(365, 17, 4, NULL, ''),
(366, 17, 5, NULL, ''),
(367, 17, 6, NULL, ''),
(368, 17, 7, NULL, ''),
(369, 17, 8, NULL, ''),
(370, 17, 9, NULL, ''),
(371, 17, 10, NULL, ''),
(372, 17, 11, NULL, ''),
(373, 17, 12, NULL, ''),
(374, 18, 1, NULL, ''),
(375, 18, 2, NULL, ''),
(376, 18, 3, NULL, ''),
(377, 18, 4, NULL, ''),
(378, 18, 5, NULL, ''),
(379, 18, 6, NULL, ''),
(380, 18, 7, NULL, ''),
(381, 18, 8, NULL, ''),
(382, 18, 9, NULL, ''),
(383, 18, 10, NULL, ''),
(384, 18, 11, NULL, ''),
(385, 18, 12, NULL, ''),
(386, 18, 13, NULL, ''),
(387, 18, 14, NULL, ''),
(388, 18, 15, NULL, ''),
(389, 18, 16, NULL, ''),
(390, 18, 17, NULL, ''),
(391, 18, 18, NULL, ''),
(392, 18, 19, NULL, ''),
(393, 18, 20, NULL, ''),
(394, 18, 21, NULL, ''),
(395, 18, 22, NULL, ''),
(396, 18, 23, NULL, ''),
(397, 18, 24, NULL, ''),
(408, 21, 1, NULL, 'Vídeo padrão'),
(409, 21, 2, NULL, 'Vídeo padrão'),
(410, 21, 3, NULL, 'Vídeo padrão'),
(411, 21, 4, NULL, 'Vídeo padrão'),
(412, 21, 5, NULL, 'Vídeo padrão'),
(413, 21, 6, NULL, 'Vídeo padrão'),
(414, 21, 7, NULL, 'Vídeo padrão'),
(415, 21, 8, NULL, 'Vídeo padrão'),
(416, 21, 9, NULL, 'Vídeo padrão'),
(417, 21, 10, NULL, 'Vídeo padrão'),
(418, 21, 11, NULL, 'Vídeo padrão'),
(419, 21, 12, NULL, 'Vídeo padrão'),
(420, 21, 13, NULL, 'Vídeo padrão'),
(421, 21, 14, NULL, 'Vídeo padrão'),
(422, 21, 15, NULL, 'Vídeo padrão'),
(423, 21, 16, NULL, 'Vídeo padrão'),
(424, 21, 17, NULL, 'Vídeo padrão'),
(425, 21, 18, NULL, 'Vídeo padrão'),
(426, 21, 19, NULL, 'Vídeo padrão'),
(427, 21, 20, NULL, 'Vídeo padrão'),
(428, 21, 21, NULL, 'Vídeo padrão'),
(429, 21, 22, NULL, 'Vídeo padrão'),
(430, 21, 23, NULL, 'Vídeo padrão'),
(431, 21, 24, NULL, 'Vídeo padrão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `formato` varchar(100) NOT NULL,
  `estudio` varchar(255) DEFAULT NULL,
  `diretor` varchar(255) DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL,
  `ano_lancamento` year(4) DEFAULT NULL,
  `sub_generos` varchar(255) DEFAULT NULL,
  `fonte` varchar(255) DEFAULT NULL,
  `sinopse` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `nome`, `imagem`, `formato`, `estudio`, `diretor`, `duracao`, `ano_lancamento`, `sub_generos`, `fonte`, `sinopse`, `criado_em`) VALUES
(1, 'Chainsaw Man: Reze Arc', 'imagens/Chainsaw_Man_reze.png', 'Filme', 'MAPPA', 'Tatsuya Yoshihara', 2, '2025', 'Ação, Aventura, Fantasia Sombria, Terror', 'Mangá', 'Denji se tornou \"Chainsaw Man\", um garoto com um coração de demônio, e agora faz parte dos Caçadores de Demônios da Divisão Especial 4. Após um encontro com Makima, a mulher dos seus sonhos, Denji se abriga da chuva. Lá ele conhece Reze, uma garota que trabalha em um café.', '2025-08-01 01:23:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `estudio` varchar(255) DEFAULT NULL,
  `sub_generos` varchar(255) DEFAULT NULL,
  `fonte` varchar(255) DEFAULT NULL,
  `episodios` int(11) DEFAULT NULL,
  `sinopse` text DEFAULT NULL,
  `temporada` varchar(255) DEFAULT NULL,
  `formato` varchar(100) NOT NULL,
  `diretor` varchar(255) DEFAULT NULL,
  `ano_lancamento` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `informacoes`
--

INSERT INTO `informacoes` (`id`, `anime_id`, `estudio`, `sub_generos`, `fonte`, `episodios`, `sinopse`, `temporada`, `formato`, `diretor`, `ano_lancamento`) VALUES
(49, 53, 'Toei Animation', 'Ação, Aventura, Comédia, Fantasia', 'Mangá', 0, 'Cinco anos após vencer o torneio de Artes Marciais, Gokuu agora vive uma vida pacífica com sua esposa e filho. Isso muda, no entanto, com a chegada de um misterioso inimigo chamado Raditz, que se apresenta como o irmão há muito perdido de Gokuu. Ele revela que Gokuu é descendente da outrora poderosa, mas agora praticamente extinta raça Saiyajin, cujo planeta natal foi aniquilado. Quando foi enviado à Terra ainda bebê, o único propósito de Gokuu era conquistar e destruir o planeta; mas após sofrer amnésia devido a um ferimento na cabeça, sua natureza violenta e selvagem mudou, e em vez disso foi criado como um menino gentil e bem-educado, agora lutando para proteger os outros.', 'Primavera', 'Anime', NULL, NULL),
(51, 55, 'ufotable', 'Ação, Premiado, Sobrenatural', 'Mangá', 0, 'Desde a morte de seu pai, o fardo de sustentar a família recai sobre os ombros de Tanjirou Kamado. Apesar de viverem na miséria em uma montanha remota, a família Kamado consegue desfrutar de uma vida relativamente pacífica e feliz. Um dia, Tanjirou decide ir até a aldeia local para ganhar algum dinheiro vendendo carvão. No caminho de volta, a noite cai, forçando Tanjirou a se abrigar na casa de um homem estranho, que o avisa da existência de demônios carnívoros que espreitam na floresta à noite.', 'Primavera', 'Anime', NULL, NULL),
(52, 56, 'MAPPA', 'Ação, Fantasia', 'Mangá', 0, 'Denji é privado de uma vida normal de adolescente, restando-lhe apenas a dívida avassaladora de seu pai caloteiro. Sua única companhia é seu animal de estimação, o demônio da motosserra Pochita, com quem ele mata demônios por dinheiro que inevitavelmente acaba nos bolsos da yakuza. Tudo o que Denji pode fazer é sonhar com uma vida boa e simples: uma com comida deliciosa e uma linda namorada ao seu lado. Mas um ato de traição gananciosa da yakuza leva à morte brutal e prematura de Denji, destruindo toda a esperança de que ele alcance a felicidade.', 'Outono', 'Anime', NULL, NULL),
(53, 57, 'A-1 Pictures, Trigger, CloverWorks', 'Ação, Drama, Romance, Ficção científica, Mecha', 'Original', 0, 'Em um futuro distante, a humanidade foi levada à quase extinção por feras gigantes conhecidas como Klaxossauros, forçando os humanos sobreviventes a se refugiarem em enormes cidades-fortaleza chamadas Plantações. Crianças criadas aqui são treinadas para pilotar mechas gigantes conhecidos como FranXX — as únicas armas conhecidas por serem eficazes contra os Klaxossauros — em pares de meninos e meninas. Criadas com o único propósito de pilotar essas máquinas, essas crianças desconhecem o mundo exterior e só conseguem provar sua existência defendendo sua raça.', 'Inverno', 'Anime', NULL, NULL),
(54, 58, 'Bones Film', 'Ação , Fantasia', 'Mangá', NULL, 'Vivendo nas favelas de uma cidade rica, Rudo e seu pai adotivo, Regto, tentam coexistir com os demais moradores da cidade, mas Rudo despreza o desperdício da classe alta. Ignorando os avisos daqueles ao seu redor, Rudo vasculha regularmente o lixo da cidade em busca de algo útil ou valioso para salvar do \"Abismo\" — um enorme buraco onde tudo o que é considerado lixo é despejado, incluindo pessoas. O pai biológico de Rudo era uma dessas pessoas, tendo sido jogado no Abismo após ser acusado de assassinato.', 'Verão', 'Anime', 'Suganuma, Fumihiko', '2025'),
(57, 61, 'CloverWorks', 'Romance, comédia', 'Mangá', NULL, 'O estudante do ensino médio Wakana Gojou passa os dias aperfeiçoando a arte de fazer bonecas hina, na esperança de eventualmente alcançar o nível de perícia de seu avô. Enquanto seus colegas adolescentes se ocupam com a cultura pop, Gojou encontra a felicidade em costurar roupas para suas bonecas. No entanto, ele faz de tudo para manter seu hobby único em segredo, pois acredita que seria ridicularizado se fosse revelado.', 'Inverno', '', 'Shinohara, Keisuke', '2022'),
(58, 62, 'Pierrot', 'Ação, Aventura, Fantasia', 'Mangá', NULL, 'Após o fim bem-sucedido da Quarta Guerra Mundial Ninja, Konohagakure tem desfrutado de um período de paz, prosperidade e extraordinário avanço tecnológico. Tudo isso graças aos esforços das Forças Aliadas Shinobi e do Sétimo Hokage da vila, Naruto Uzumaki. Agora, assemelhando-se a uma metrópole moderna, Konohagakure mudou, especialmente a vida de um shinobi. Sob o olhar atento de Naruto e seus antigos companheiros, uma nova geração de shinobi se destacou para aprender os costumes dos ninjas.', 'Primavera', '', 'Abe, Noriyuki', '2017');

-- --------------------------------------------------------

--
-- Estrutura para tabela `temporadas_animes`
--

CREATE TABLE `temporadas_animes` (
  `id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `temporadas_animes`
--

INSERT INTO `temporadas_animes` (`id`, `anime_id`, `numero`, `nome`) VALUES
(1, 50, 1, 'Temporada 1'),
(2, 51, 1, 'Temporada 1'),
(3, 51, 2, 'Temporada 2'),
(4, 52, 1, 'Temporada 1'),
(5, 52, 2, 'Temporada 2'),
(6, 52, 3, 'Temporada 3'),
(7, 52, 4, 'Temporada 4'),
(8, 52, 5, 'Temporada 5'),
(9, 53, 1, 'Temporada 1'),
(12, 55, 1, 'Temporada 1'),
(13, 55, 2, 'Temporada 2'),
(14, 55, 3, 'Temporada 3'),
(15, 55, 4, 'Temporada 4'),
(16, 55, 5, 'Temporada 5'),
(17, 56, 1, 'Temporada 1'),
(18, 57, 1, 'Temporada 1'),
(21, 58, 1, 'Temporada 1');

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
(14, 'Evil', 'evil@gmail.com', '$2y$10$DunGKSE5R4SEEvGL2LPONuEz5PF0dLcHBdakLXCi.5zyaZZD6SwqC', NULL, '2025-08-01 00:26:02', 'uploads/perfil_688c099a3d1e04.22991686.jpg'),
(15, 'ADM', 'admin@admin.com', '$2y$10$rOXWDXnw0k/lmriG1K1AOuivjFmCbirnAeJh/llvhUS5SWJqgSgsi', NULL, '2025-06-24 01:01:59', NULL),
(18, 'Fran', 'francisco.cardoso.teixeira777@gmail.com', '$2y$10$NzjMyi1PHIWhoNDOT5EVb.bFRzRFh4A87ONwX5rlnrrppbyxbYTKC', NULL, '2025-08-01 00:57:31', 'uploads/perfil_688c10fbaacb95.58264013.jpg'),
(20, 'Mine977', 'agustinhocarrara@gmail.com', '$2y$10$EikNMrmqEoPlmiq8kB5rjOHp9.2oV/AFCMp.LeaTffsD61ENhhrQS', NULL, '2025-08-01 22:41:38', 'uploads/perfil_688d42a2964126.19335051.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animes_geral`
--
ALTER TABLE `animes_geral`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `episodios`
--
ALTER TABLE `episodios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- Índices de tabela `temporadas_animes`
--
ALTER TABLE `temporadas_animes`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `episodios`
--
ALTER TABLE `episodios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=432;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `temporadas_animes`
--
ALTER TABLE `temporadas_animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `informacoes`
--
ALTER TABLE `informacoes`
  ADD CONSTRAINT `informacoes_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `animes_geral` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
