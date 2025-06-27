-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 03:38
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
(3, 'One Piece', 'imagens/one_piece.jpg', '2025-06-12 23:44:35', 'Shounen'),
(4, 'Naruto', 'imagens/naruto.jpg', '2025-06-12 23:44:35', 'Shounen'),
(5, 'Chainsaw Man', 'imagens/chainsaw_man.jpg', '2025-06-12 23:47:46', 'Shounen'),
(6, 'Black Clover', 'imagens/black_clover.jpg', '2025-06-12 23:47:46', 'Shounen'),
(7, 'Kimetsu no Yaiba', 'imagens/kimetsu.jpg', '2025-06-12 23:51:12', 'Shounen'),
(8, 'Dragon Ball Z', 'imagens/dragon_ball_z.png', '2025-06-12 23:51:12', 'Shounen'),
(9, 'Edens Zero', 'imagens/edens_zero.jpg', '2025-06-13 00:05:07', 'Shounen'),
(10, 'One Punch Man', 'imagens/one_punch_man.jpg', '2025-06-13 00:05:07', 'Shounen'),
(11, 'Konosuba', 'imagens/konosuba.jpg', '2025-06-13 01:14:59', 'Comedia'),
(14, 'Gintama', 'imagens/gintama.jpg', '2025-06-13 01:16:58', 'Comedia'),
(15, 'Welcome to Demon School! Iruma-Kun', 'imagens/iruma.jpg', '2025-06-17 00:36:46', 'Comedia'),
(16, 'Osomatsu-san', 'imagens/osomatsu_san.jpg', '2025-06-17 00:36:46', 'Comedia'),
(17, 'Urusei Yatsura', 'imagens/Urusei_Yatsura.jpg', '2025-06-17 00:39:35', 'Comedia'),
(18, 'Kaguya-sama: Love is War', 'imagens/Kaguya-sama.jpg', '2025-06-17 00:39:35', 'Comedia'),
(20, 'Prison School', 'imagens/prison_school.jpg', '2025-06-17 00:41:08', 'Comedia'),
(21, 'Ijiranaide Nagatoro-san', 'imagens/Ijiranaide_Nagatoro-san.jpg', '2025-06-17 00:41:46', 'Comedia');

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
  `temporada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `informacoes`
--

INSERT INTO `informacoes` (`id`, `anime_id`, `estudio`, `sub_generos`, `fonte`, `episodios`, `sinopse`, `temporada`) VALUES
(1, 3, 'Toei Animation', 'Ação , Aventura , Fantasia', 'Mangá', 1133, 'Sobrevivendo com dificuldade em um barril após passar por um terrível redemoinho no mar, o despreocupado Monkey D. Luffy acaba a bordo de um navio sob ataque de piratas temíveis. Apesar de ser um adolescente de aparência ingênua, ele não deve ser subestimado. Inigualável em batalha, Luffy é um pirata que persegue resolutamente o cobiçado tesouro One Piece e o título de Rei dos Piratas que o acompanha.', 'Outono'),
(2, 4, 'Pierrot', 'Ação , Aventura , Fantasia', 'Mangá', 220, 'Momentos antes do nascimento de Naruto Uzumaki, um enorme demônio conhecido como a Raposa de Nove Caudas atacou Konohagakure, a Vila Oculta da Folha, e causou estragos. Para pôr fim à fúria do demônio, o líder da vila, o Quarto Hokage, sacrificou sua vida e selou a fera monstruosa dentro do recém-nascido Naruto.', 'Outono'),
(3, 5, 'MAPPA', 'Ação, Fantasia', 'Mangá', 12, 'Denji é privado de uma vida normal de adolescente, restando-lhe apenas a dívida avassaladora de seu pai caloteiro. Sua única companhia é seu animal de estimação, o demônio da motosserra Pochita, com quem ele mata demônios por dinheiro que inevitavelmente acaba nos bolsos da yakuza. Tudo o que Denji pode fazer é sonhar com uma vida boa e simples: uma com comida deliciosa e uma linda namorada ao seu lado. Mas um ato de traição gananciosa da yakuza leva à morte brutal e prematura de Denji, destruindo toda a esperança de que ele alcance a felicidade.', 'Outono'),
(4, 6, 'Pierrot', 'Ação, Fantasia', 'Mangá', 170, 'Asta e Yuno foram abandonados na mesma igreja, no mesmo dia. Criados juntos quando crianças, conheceram o \"Rei Mago\" — título dado ao mago mais forte do reino — e prometeram que competiriam entre si pela posição de próximo Rei Mago. No entanto, à medida que cresciam, a diferença gritante entre eles se tornava evidente. Enquanto Yuno é capaz de manejar magia com poder e controle incríveis, Asta não consegue usar magia alguma e tenta desesperadamente despertar seus poderes treinando fisicamente.', 'Outono'),
(5, 8, 'Toei Animation', 'Ação , Aventura , Comédia , Fantasia', 'Mangá', 291, 'Cinco anos após vencer o torneio de Artes Marciais, Gokuu agora vive uma vida pacífica com sua esposa e filho. Isso muda, no entanto, com a chegada de um misterioso inimigo chamado Raditz, que se apresenta como o irmão há muito perdido de Gokuu. Ele revela que Gokuu é descendente da outrora poderosa, mas agora praticamente extinta raça Saiyajin, cujo planeta natal foi aniquilado. Quando foi enviado à Terra ainda bebê, o único propósito de Gokuu era conquistar e destruir o planeta; mas após sofrer amnésia devido a um ferimento na cabeça, sua natureza violenta e selvagem mudou, e em vez disso foi criado como um menino gentil e bem-educado, agora lutando para proteger os outros.', 'Primavera'),
(6, 7, 'ufotable', 'Ação , Premiado , Sobrenatural\r\n', 'Mangá', 26, 'Desde a morte de seu pai, o fardo de sustentar a família recai sobre os ombros de Tanjirou Kamado. Apesar de viverem na miséria em uma montanha remota, a família Kamado consegue desfrutar de uma vida relativamente pacífica e feliz. Um dia, Tanjirou decide ir até a aldeia local para ganhar algum dinheiro vendendo carvão. No caminho de volta, a noite cai, forçando Tanjirou a se abrigar na casa de um homem estranho, que o avisa da existência de demônios carnívoros que espreitam na floresta à noite.', 'Primavera'),
(7, 9, 'JCStaff', 'Ação , Aventura , Fantasia , Ficção científica', 'Mangá', 25, 'Durante toda a sua vida, Shiki viveu cercado por máquinas. No Reino Granbell, um parque de diversões há muito abandonado, ele é o único da sua espécie por perto. Isto é, até Rebecca Bluegarden e seu companheiro felino Happy chegarem, sem saber que são os primeiros visitantes de Granbell em cem anos. O objetivo deles é fazer vídeos divertidos para o canal B-Cube, mas o que eles encontram em vez disso é um amigo no desajeitado Shiki.', 'Primavera'),
(8, 10, 'Madhouse', '	\r\nAção , Comédia', 'Web manga', 12, 'O aparentemente inexpressivo Saitama tem um hobby bastante peculiar: ser um herói. Para realizar seu sonho de infância, Saitama treinou incansavelmente por três anos, perdendo todo o cabelo no processo. Agora, Saitama é tão poderoso que pode derrotar qualquer inimigo com apenas um soco. No entanto, não ter ninguém capaz de igualar sua força levou Saitama a um problema inesperado: ele não consegue mais desfrutar da emoção da batalha e ficou entediado.', 'Outono'),
(9, 21, 'Telecom Animation Film', 'Comédia , Romance', 'Web manga', 12, 'Todos os dias, Naoto Hachiouji é provocado implacavelmente por Hayase Nagatoro, uma aluna do primeiro ano que ele conhece um dia na biblioteca enquanto trabalha em seu mangá. Depois de ler sua história e ver seu comportamento estranho, ela decide, a partir daquele momento, brincar com ele, chegando a chamá-lo de \"Senpai\" em vez de usar seu nome verdadeiro.', 'Primavera'),
(10, 11, 'Studio Deen', 'Aventura , Comédia , Fantasia, Isekai', 'Light novel', 10, 'Após morrer de forma risível e patética ao voltar de um jogo, o estudante do ensino médio e recluso Kazuma Satou se vê diante de uma deusa linda, porém detestável, chamada Aqua. Ela oferece ao NEET duas opções: continuar rumo ao céu ou reencarnar no sonho de todo jogador — um mundo de fantasia real! Escolhendo começar uma nova vida, Kazuma é rapidamente incumbido de derrotar um Rei Demônio que está aterrorizando aldeias. Mas antes de partir, ele pode escolher um item de qualquer tipo para ajudá-lo em sua busca, e o futuro herói escolhe Aqua. Mas Kazuma cometeu um erro grave — Aqua é completamente inútil!', 'Inverno'),
(11, 14, 'Sunrise', 'Ação , Comédia , Ficção científica', 'Mangá', 51, 'Após um hiato de um ano, Shinpachi Shimura retorna a Edo, apenas para se deparar com uma surpresa chocante: Gintoki e Kagura, seus companheiros Yorozuya, tornaram-se personagens completamente diferentes! Fugindo da sede Yorozuya em confusão, Shinpachi descobre que todos os cidadãos de Edo passaram por mudanças impossivelmente extremas, tanto na aparência quanto na personalidade. O mais inacreditável é que sua irmã Otae se casou com o chefe Shinsengumi e perseguidor descarado Isao Kondou e está grávida do primeiro filho deles.', 'Primavera'),
(12, 15, 'Bandai Namco Pictures', 'Comédia , Fantasia', 'Mangá', 23, 'Iruma Suzuki, de quatorze anos, teve um azar a vida toda, tendo que trabalhar para sustentar seus pais irresponsáveis, mesmo sendo menor de idade. Um dia, ele descobre que seus pais o venderam para o demônio Sullivan. No entanto, as preocupações de Iruma sobre o que será dele logo se dissipam, pois Sullivan quer apenas um neto, mimando-o e obrigando-o a frequentar a escola demoníaca Babyls.\r\n', 'Outono'),
(13, 16, 'Pierrot', 'Comédia', 'Mangá', 25, 'A maioria da família Matsuno é composta por seis irmãos idênticos: o egocêntrico líder Osomatsu, o másculo Karamatsu, a voz da razão Choromatsu, o cínico Ichimatsu, o hiperativo Juushimatsu e o adorável Todomatsu. Apesar de cada um deles ter mais de 20 anos, são incrivelmente preguiçosos e não têm absolutamente nenhuma motivação para conseguir um emprego, optando por viver como NEETs. Nos raros casos em que tentam procurar emprego e conseguem uma entrevista, suas personalidades únicas geralmente levam à rápida rejeição.\r\n', 'Outono'),
(14, 17, 'David Production', 'Comédia , Romance , Ficção científica', 'Mangá', 23, 'Quando alienígenas conhecidos como Oni ameaçam invadir a Terra, eles prometem partir sob uma condição: um humano escolhido aleatoriamente deve vencer uma partida de pega-pega individual contra Lum, a bela filha do líder Oni. O \"sortudo\" escolhido acaba sendo o lascivo e azarado estudante do ensino médio Ataru Moroboshi. Com 10 dias para tentar agarrar os chifres de Lum, Ataru percebe o quão impossível é o desafio ao se deparar com os poderes extraterrestres de Lum.', 'Outono');

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
-- Índices de tabela `episodios`
--
ALTER TABLE `episodios`
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
-- Índices de tabela `usuarios_animes_assistindo`
--
ALTER TABLE `usuarios_animes_assistindo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `anime_id` (`anime_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animes_geral`
--
ALTER TABLE `animes_geral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
