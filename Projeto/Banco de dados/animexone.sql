-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/06/2025 às 03:42
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
(1, 'One Piece', 'imagens/one_piece.jpg', '2025-06-12 23:44:35', 'Shounen'),
(2, 'Naruto', 'imagens/naruto.jpg', '2025-06-12 23:44:35', 'Shounen'),
(3, 'Chainsaw Man', 'imagens/chainsaw_man.jpg', '2025-06-12 23:47:46', 'Shounen'),
(4, 'Black Clover', 'imagens/black_clover.jpg', '2025-06-12 23:47:46', 'Shounen'),
(5, 'Kimetsu no Yaiba', 'imagens/kimetsu.jpg', '2025-06-12 23:51:12', 'Shounen'),
(6, 'Dragon Ball Z', 'imagens/dragon_ball_z.png', '2025-06-12 23:51:12', 'Shounen'),
(7, 'Edens Zero', 'imagens/edens_zero.jpg', '2025-06-13 00:05:07', 'Shounen'),
(8, 'One Punch Man', 'imagens/one_punch_man.jpg', '2025-06-13 00:05:07', 'Shounen'),
(9, 'Konosuba', 'imagens/konosuba.jpg', '2025-06-13 01:14:59', 'Comedia'),
(10, 'Gintama', 'imagens/gintama.jpg', '2025-06-13 01:16:58', 'Comedia'),
(11, 'Welcome to Demon School! Iruma-Kun', 'imagens/iruma.jpg', '2025-06-17 00:36:46', 'Comedia'),
(12, 'Osomatsu-san', 'imagens/osomatsu_san.jpg', '2025-06-17 00:36:46', 'Comedia'),
(13, 'Urusei Yatsura', 'imagens/Urusei_Yatsura.jpg', '2025-06-17 00:39:35', 'Comedia'),
(14, 'Kaguya-sama: Love is War', 'imagens/Kaguya-sama.jpg', '2025-06-17 00:39:35', 'Comedia'),
(15, 'Prison School', 'imagens/prison_school.jpg', '2025-06-17 00:41:08', 'Comedia'),
(16, 'Ijiranaide Nagatoro-san', 'imagens/Ijiranaide_Nagatoro-san.jpg', '2025-06-17 00:41:46', 'Comedia'),
(17, 'Jitsu wa watashi wa', 'imagens/jitsu_wa_watashi_wa.png', '2025-06-22 12:59:32', 'Romance'),
(18, 'Call of the night', 'imagens/call_of_the_night.jpg', '2025-06-22 12:59:32', 'Romance'),
(19, 'The Ancient Magus\' Bride', 'imagens/magus.jpg', '2025-06-22 13:01:24', 'Romance'),
(20, 'Bunny Girl Senpai', 'imagens/Bunny_Girl.png', '2025-06-22 13:01:24', 'Romance'),
(21, 'Nisekoi', 'imagens/nisekoi.jpg', '2025-06-22 13:05:24', 'Romance'),
(22, 'Komi Can\'t Communicate', 'imagens/komi.jpg', '2025-06-22 13:05:24', 'Romance'),
(23, 'Darling in the Franxx', 'imagens/Darling_in_the_Franxx.jpg', '2025-06-22 13:07:05', 'Romance'),
(24, 'The Apothecary Diaries', 'imagens/apothecary.png', '2025-06-22 13:21:52', 'Romance'),
(25, 'Erased', 'imagens/erased.png', '2025-06-22 14:23:12', 'Seinein'),
(26, 'Cowboy Bebop', 'imagens/cowboy.jpg', '2025-06-22 14:23:12', 'Seinein'),
(27, 'Monster', 'imagens/monster.jpg', '2025-06-22 14:26:20', 'Seinein'),
(28, 'Devilman Cry Baby', 'imagens/devilman.jpg', '2025-06-22 14:26:20', 'Seinein'),
(29, 'Sono Bisque Doll', 'imagens/sono_bisque_doll.png', '2025-06-24 01:30:50', 'Romance'),
(31, 'Boruto: Naruto Next Generations', 'imagens/boruto.png', '2025-06-24 01:36:36', 'Shounen');

-- --------------------------------------------------------

--
-- Estrutura para tabela `episodios`
--

CREATE TABLE `episodios` (
  `id` int(11) NOT NULL,
  `temporada_id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `episodios`
--

INSERT INTO `episodios` (`id`, `temporada_id`, `numero`, `link`) VALUES
(1, 1, 1, 'eps/ep_1.html'),
(2, 1, 2, 'eps/ep_2.html'),
(3, 1, 3, 'eps/ep_3.html'),
(4, 1, 4, 'eps/ep_4.html'),
(5, 1, 5, 'eps/ep_5.html'),
(6, 1, 6, 'eps/ep_6.html'),
(7, 1, 7, 'eps/ep_7.html'),
(8, 1, 8, 'eps/ep_8.html'),
(9, 1, 9, 'eps/ep_9.html'),
(10, 1, 10, 'eps/ep_10.html'),
(11, 1, 11, 'eps/ep_11.html'),
(12, 1, 12, 'eps/ep_12.html'),
(18, 2, 1, 'eps/ep_1.html'),
(19, 2, 2, 'eps/ep_2.html'),
(20, 2, 3, 'eps/ep_2.html'),
(21, 2, 4, 'eps/ep_2.html'),
(22, 2, 5, 'eps/ep_2.html'),
(23, 2, 6, 'eps/ep_2.html'),
(24, 2, 7, 'eps/ep_2.html'),
(25, 2, 8, 'eps/ep_2.html'),
(26, 2, 9, 'eps/ep_2.html'),
(27, 2, 10, 'eps/ep_10.html'),
(28, 2, 11, 'eps/ep_11.html'),
(29, 2, 12, 'eps/ep_12.html'),
(30, 2, 13, 'eps/ep_13.html'),
(31, 2, 14, 'eps/ep_14.html'),
(32, 2, 15, 'eps/ep_15.html'),
(33, 2, 16, 'eps/ep_16.html'),
(34, 2, 17, 'eps/ep_17.html'),
(35, 2, 18, 'eps/ep_18.html'),
(36, 2, 19, 'eps/ep_19.html'),
(37, 2, 20, 'eps/ep_20.html'),
(38, 2, 21, 'eps/ep_21.html'),
(39, 2, 22, 'eps/ep_22.html'),
(40, 2, 23, 'eps/ep_23.html'),
(41, 2, 24, 'eps/ep_24.html'),
(42, 2, 25, 'eps/ep_25.html'),
(43, 2, 26, 'eps/ep_26.html'),
(44, 3, 1, 'eps/ep_1.html'),
(45, 3, 2, 'eps/ep_2.html'),
(46, 3, 3, 'eps/ep_3.html'),
(47, 3, 4, 'eps/ep_4.html'),
(48, 3, 5, 'eps/ep_5.html'),
(49, 3, 6, 'eps/ep_6.html'),
(50, 3, 7, 'eps/ep_7.html'),
(51, 4, 1, 'eps/ep_1.html'),
(52, 4, 2, 'eps/ep_2.html'),
(53, 4, 3, 'eps/ep_3.html'),
(54, 4, 4, 'eps/ep_4.html'),
(55, 4, 5, 'eps/ep_5.html'),
(56, 4, 6, 'eps/ep_6.html'),
(57, 4, 7, 'eps/ep_7.html'),
(58, 4, 8, 'eps/ep_8.html'),
(59, 4, 9, 'eps/ep_9.html'),
(60, 4, 10, 'eps/ep_10.html'),
(61, 4, 11, 'eps/ep_11.html'),
(62, 4, 1, 'eps/ep_1.html'),
(63, 4, 2, 'eps/ep_2.html'),
(64, 4, 3, 'eps/ep_3.html'),
(65, 4, 4, 'eps/ep_4.html'),
(66, 4, 5, 'eps/ep_5.html'),
(67, 4, 6, 'eps/ep_6.html'),
(68, 4, 7, 'eps/ep_7.html'),
(69, 4, 8, 'eps/ep_8.html'),
(70, 4, 9, 'eps/ep_9.html'),
(71, 4, 10, 'eps/ep_10.html'),
(72, 4, 11, 'eps/ep_11.html'),
(73, 5, 1, 'eps/ep_1.html'),
(74, 5, 2, 'eps/ep_2.html'),
(75, 5, 3, 'eps/ep_3.html'),
(76, 5, 4, 'eps/ep_4.html'),
(77, 5, 5, 'eps/ep_5.html'),
(78, 5, 6, 'eps/ep_6.html'),
(79, 5, 7, 'eps/ep_7.html'),
(80, 5, 8, 'eps/ep_8.html'),
(81, 5, 9, 'eps/ep_9.html'),
(82, 5, 10, 'eps/ep_10.html'),
(83, 5, 11, 'eps/ep_11.html'),
(84, 6, 1, 'eps/ep_1.html'),
(85, 6, 2, 'eps/ep_2.html'),
(86, 6, 3, 'eps/ep_3.html'),
(87, 6, 4, 'eps/ep_4.html'),
(88, 6, 5, 'eps/ep_5.html'),
(89, 6, 6, 'eps/ep_6.html'),
(90, 6, 7, 'eps/ep_7.html'),
(91, 6, 8, 'eps/ep_8.html');

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
(1, 1, 'Toei Animation', 'Ação , Aventura , Fantasia', 'Mangá', 1133, 'Sobrevivendo com dificuldade em um barril após passar por um terrível redemoinho no mar, o despreocupado Monkey D. Luffy acaba a bordo de um navio sob ataque de piratas temíveis. Apesar de ser um adolescente de aparência ingênua, ele não deve ser subestimado. Inigualável em batalha, Luffy é um pirata que persegue resolutamente o cobiçado tesouro One Piece e o título de Rei dos Piratas que o acompanha.', 'Outono'),
(2, 2, 'Pierrot', 'Ação , Aventura , Fantasia', 'Mangá', 220, 'Momentos antes do nascimento de Naruto Uzumaki, um enorme demônio conhecido como a Raposa de Nove Caudas atacou Konohagakure, a Vila Oculta da Folha, e causou estragos. Para pôr fim à fúria do demônio, o líder da vila, o Quarto Hokage, sacrificou sua vida e selou a fera monstruosa dentro do recém-nascido Naruto.', 'Outono'),
(3, 3, 'MAPPA', 'Ação, Fantasia', 'Mangá', 12, 'Denji é privado de uma vida normal de adolescente, restando-lhe apenas a dívida avassaladora de seu pai caloteiro. Sua única companhia é seu animal de estimação, o demônio da motosserra Pochita, com quem ele mata demônios por dinheiro que inevitavelmente acaba nos bolsos da yakuza. Tudo o que Denji pode fazer é sonhar com uma vida boa e simples: uma com comida deliciosa e uma linda namorada ao seu lado. Mas um ato de traição gananciosa da yakuza leva à morte brutal e prematura de Denji, destruindo toda a esperança de que ele alcance a felicidade.', 'Outono'),
(4, 4, 'Pierrot', 'Ação, Fantasia', 'Mangá', 170, 'Asta e Yuno foram abandonados na mesma igreja, no mesmo dia. Criados juntos quando crianças, conheceram o \"Rei Mago\" — título dado ao mago mais forte do reino — e prometeram que competiriam entre si pela posição de próximo Rei Mago. No entanto, à medida que cresciam, a diferença gritante entre eles se tornava evidente. Enquanto Yuno é capaz de manejar magia com poder e controle incríveis, Asta não consegue usar magia alguma e tenta desesperadamente despertar seus poderes treinando fisicamente.', 'Outono'),
(5, 5, 'uftable', 'Ação, Premiado, Sobrenatural', 'Mangá', 26, 'Desde a morte de seu pai, o fardo de sustentar a família recai sobre os ombros de Tanjirou Kamado. Apesar de viverem na miséria em uma montanha remota, a família Kamado consegue desfrutar de uma vida relativamente pacífica e feliz. Um dia, Tanjirou decide ir até a aldeia local para ganhar algum dinheiro vendendo carvão. No caminho de volta, a noite cai, forçando Tanjirou a se abrigar na casa de um homem estranho, que o avisa da existência de demônios carnívoros que espreitam na floresta à noite.', 'Primavera'),
(6, 6, 'Toei Animation', 'Ação , Aventura , Comédia , Fantasia', 'Mangá', 291, 'Cinco anos após vencer o torneio de Artes Marciais, Gokuu agora vive uma vida pacífica com sua esposa e filho. Isso muda, no entanto, com a chegada de um misterioso inimigo chamado Raditz, que se apresenta como o irmão há muito perdido de Gokuu. Ele revela que Gokuu é descendente da outrora poderosa, mas agora praticamente extinta raça Saiyajin, cujo planeta natal foi aniquilado. Quando foi enviado à Terra ainda bebê, o único propósito de Gokuu era conquistar e destruir o planeta; mas após sofrer amnésia devido a um ferimento na cabeça, sua natureza violenta e selvagem mudou, e em vez disso foi criado como um menino gentil e bem-educado, agora lutando para proteger os outros.', 'Primavera'),
(7, 7, 'JCStaff', 'Ação , Aventura , Fantasia , Ficção científica', 'Mangá', 25, 'Durante toda a sua vida, Shiki viveu cercado por máquinas. No Reino Granbell, um parque de diversões há muito abandonado, ele é o único da sua espécie por perto. Isto é, até Rebecca Bluegarden e seu companheiro felino Happy chegarem, sem saber que são os primeiros visitantes de Granbell em cem anos. O objetivo deles é fazer vídeos divertidos para o canal B-Cube, mas o que eles encontram em vez disso é um amigo no desajeitado Shiki.', 'Primavera'),
(8, 8, 'Madhouse', '	\r\nAção , Comédia', 'Web manga', 12, 'O aparentemente inexpressivo Saitama tem um hobby bastante peculiar: ser um herói. Para realizar seu sonho de infância, Saitama treinou incansavelmente por três anos, perdendo todo o cabelo no processo. Agora, Saitama é tão poderoso que pode derrotar qualquer inimigo com apenas um soco. No entanto, não ter ninguém capaz de igualar sua força levou Saitama a um problema inesperado: ele não consegue mais desfrutar da emoção da batalha e ficou entediado.', 'Outono'),
(9, 9, 'Studio Deen', 'Aventura , Comédia , Fantasia, Isekai', 'Light novel', 10, 'Após morrer de forma risível e patética ao voltar de um jogo, o estudante do ensino médio e recluso Kazuma Satou se vê diante de uma deusa linda, porém detestável, chamada Aqua. Ela oferece ao NEET duas opções: continuar rumo ao céu ou reencarnar no sonho de todo jogador — um mundo de fantasia real! Escolhendo começar uma nova vida, Kazuma é rapidamente incumbido de derrotar um Rei Demônio que está aterrorizando aldeias. Mas antes de partir, ele pode escolher um item de qualquer tipo para ajudá-lo em sua busca, e o futuro herói escolhe Aqua. Mas Kazuma cometeu um erro grave — Aqua é completamente inútil!', 'Inverno'),
(10, 10, 'Sunrise', 'Ação , Comédia , Ficção científica', 'Mangá', 51, 'Após um hiato de um ano, Shinpachi Shimura retorna a Edo, apenas para se deparar com uma surpresa chocante: Gintoki e Kagura, seus companheiros Yorozuya, tornaram-se personagens completamente diferentes! Fugindo da sede Yorozuya em confusão, Shinpachi descobre que todos os cidadãos de Edo passaram por mudanças impossivelmente extremas, tanto na aparência quanto na personalidade. O mais inacreditável é que sua irmã Otae se casou com o chefe Shinsengumi e perseguidor descarado Isao Kondou e está grávida do primeiro filho deles.', 'Primavera'),
(11, 11, 'Bandai Namco Pictures', 'Comédia , Fantasia', 'Mangá', 23, 'Iruma Suzuki, de quatorze anos, teve um azar a vida toda, tendo que trabalhar para sustentar seus pais irresponsáveis, mesmo sendo menor de idade. Um dia, ele descobre que seus pais o venderam para o demônio Sullivan. No entanto, as preocupações de Iruma sobre o que será dele logo se dissipam, pois Sullivan quer apenas um neto, mimando-o e obrigando-o a frequentar a escola demoníaca Babyls.\r\n', 'Outono'),
(12, 12, 'Pierrot', 'Comédia', 'Mangá', 25, 'A maioria da família Matsuno é composta por seis irmãos idênticos: o egocêntrico líder Osomatsu, o másculo Karamatsu, a voz da razão Choromatsu, o cínico Ichimatsu, o hiperativo Juushimatsu e o adorável Todomatsu. Apesar de cada um deles ter mais de 20 anos, são incrivelmente preguiçosos e não têm absolutamente nenhuma motivação para conseguir um emprego, optando por viver como NEETs. Nos raros casos em que tentam procurar emprego e conseguem uma entrevista, suas personalidades únicas geralmente levam à rápida rejeição.\r\n', 'Outono'),
(13, 13, 'David Production', 'Comédia , Romance , Ficção científica', 'Mangá', 23, 'Quando alienígenas conhecidos como Oni ameaçam invadir a Terra, eles prometem partir sob uma condição: um humano escolhido aleatoriamente deve vencer uma partida de pega-pega individual contra Lum, a bela filha do líder Oni. O \"sortudo\" escolhido acaba sendo o lascivo e azarado estudante do ensino médio Ataru Moroboshi. Com 10 dias para tentar agarrar os chifres de Lum, Ataru percebe o quão impossível é o desafio ao se deparar com os poderes extraterrestres de Lum.', 'Outono'),
(14, 14, 'A-1 Pictures', 'Comédia, Romance', 'Mangá', 12, 'Na renomada Academia Shuchiin, Miyuki Shirogane e Kaguya Shinomiya são as principais representantes do corpo estudantil. Considerada a melhor aluna do país e respeitada por colegas e mentores, Miyuki atua como presidente do conselho estudantil. Ao lado dele, a vice-presidente Kaguya — filha mais velha da abastada família Shinomiya — se destaca em todas as áreas imagináveis. Eles são a inveja de todo o corpo estudantil, considerados o casal perfeito.', 'Inverno'),
(15, 15, 'JCStaff', 'Comédia, Ecchi', 'Mangá', 12, 'Localizada nos arredores de Tóquio, a Academia Privada Hachimitsu é um prestigiado internato feminino, famoso por sua educação de alta qualidade e alunas disciplinadas. No entanto, tudo isso está prestes a mudar devido à revisão da política mais emblemática da escola, já que meninos agora também podem se matricular.', 'Verão'),
(16, 16, 'Telecom Animation Film', 'Comédia , Romance', 'Web manga', 12, 'Todos os dias, Naoto Hachiouji é provocado implacavelmente por Hayase Nagatoro, uma aluna do primeiro ano que ele conhece um dia na biblioteca enquanto trabalha em seu mangá. Depois de ler sua história e ver seu comportamento estranho, ela decide, a partir daquele momento, brincar com ele, chegando a chamá-lo de \"Senpai\" em vez de usar seu nome verdadeiro.', 'Primavera'),
(17, 17, 'TMS Entertainment', 'Comédia , Romance , Sobrenatural', 'Mangá', 13, 'Um dia, depois da escola, Asahi Kuromine descobre que Youko Shiragami, a garota por quem ele tem uma queda, é na verdade uma vampira. De acordo com as regras de seu pai, Youko precisa abandonar a escola para manter sua família segura. No entanto, Asahi não quer que ela vá e promete manter sua verdadeira natureza em segredo. Infelizmente, isso acaba sendo mais fácil de dizer do que de fazer, já que Asahi é um homem fácil de ler e incapaz de guardar segredos para si mesmo.', 'Verão'),
(18, 18, 'LIDENFILMS', 'Romance, Sobrenatural', 'Mangá', 13, 'Kou Yamori é um estudante médio do ensino fundamental que luta para compreender o complexo conceito de amor. Como vê pouco sentido em se render à norma, logo para de ir à escola. Atormentado pela insônia devido à sua ociosidade, Kou começa a vagar pelas ruas solitárias à noite.', 'Verão'),
(19, 19, 'Wit Studio', 'Drama, Fantasia, Romance', 'Mangá', 24, 'Chise Hatori, uma jovem japonesa de 15 anos, foi vendida por cinco milhões de libras em um leilão para um cavalheiro alto e mascarado. Abandonada ainda jovem e ridicularizada por seus pares por seu comportamento nada convencional, ela estava pronta para se entregar a qualquer comprador se isso significasse ter um lugar para onde voltar. Acorrentada e a caminho de um destino desconhecido, ela ouve sussurros de homens de túnica ao longo de seu caminho, fofocando e reclamando que tal comprador conseguiu um raro Sleigh Beggy.', 'Outono'),
(20, 20, 'CloverWorks', 'Drama, Romance, Sobrenatural', 'Light novel', 13, 'A rara e inexplicável Síndrome da Puberdade é considerada um mito. É uma doença rara que afeta apenas adolescentes, e seus sintomas são tão sobrenaturais que quase ninguém a reconhece como uma ocorrência legítima. No entanto, o estudante do ensino médio Sakuta Azusagawa sabe por experiência própria que ela é muito real e bastante prevalente em sua escola.', 'Outono'),
(21, 21, 'Shaft', 'Comédia, Romance', 'Mangá', 20, 'Raku Ichijou, um aluno do primeiro ano da Escola Secundária Bonyari, é o único herdeiro de uma intimidadora família yakuza. Dez anos atrás, Raku fez uma promessa à sua amiga de infância. Agora, tudo o que ele tem para se sustentar é um pingente com cadeado, que só pode ser destrancado com a chave que a garota levou consigo quando se separaram.', 'Inverno'),
(22, 22, 'OLM', 'Comédia, Romance', 'Mangá', 12, 'Hitohito Tadano é um garoto comum que chega ao primeiro dia de aula com um plano claro: evitar problemas e se esforçar para se misturar aos outros. Infelizmente, ele fracassa imediatamente ao se sentar ao lado da madonna da escola, Shouko Komi. Seus colegas agora o reconhecem como alguém a ser eliminado para ter a chance de sentar ao lado da garota mais bonita da turma.', 'Outono'),
(23, 23, 'A-1 Pictures , Trigger , CloverWorks', 'Ação, Drama, Romance, Ficção científica', 'Original', 24, 'Em um futuro distante, a humanidade foi levada à quase extinção por feras gigantes conhecidas como Klaxossauros, forçando os humanos sobreviventes a se refugiarem em enormes cidades-fortaleza chamadas Plantações. Crianças criadas aqui são treinadas para pilotar mechas gigantes conhecidos como FranXX — as únicas armas conhecidas por serem eficazes contra os Klaxossauros — em pares de meninos e meninas. Criadas com o único propósito de pilotar essas máquinas, essas crianças desconhecem o mundo exterior e só conseguem provar sua existência defendendo sua raça.', 'Inverno'),
(24, 24, 'OLM, TOHO animation STUDIO', 'Drama, Mistério, Romance', 'Light novel', 24, 'Maomao, filha de um boticário, foi arrancada de sua vida pacífica e vendida aos escalões mais baixos da corte imperial. Agora apenas uma criada, Maomao se adapta à sua nova vida mundana e esconde seu vasto conhecimento de medicina para evitar qualquer atenção indesejada.', 'Outono'),
(25, 29, 'CloverWorks', 'Romance, escolar', 'Mangá', 12, 'O estudante do ensino médio Wakana Gojou passa os dias aperfeiçoando a arte de fazer bonecas hina, na esperança de eventualmente alcançar o nível de perícia de seu avô. Enquanto seus colegas adolescentes se ocupam com a cultura pop, Gojou encontra a felicidade em costurar roupas para suas bonecas. No entanto, ele faz de tudo para manter seu hobby único em segredo, pois acredita que seria ridicularizado se fosse revelado.', 'Inverno'),
(27, 31, 'Pierrot', 'Ação , Aventura , Fantasia', 'Mangá', 293, 'Após o fim bem-sucedido da Quarta Guerra Mundial Ninja, Konohagakure tem desfrutado de um período de paz, prosperidade e extraordinário avanço tecnológico. Tudo isso graças aos esforços das Forças Aliadas Shinobi e do Sétimo Hokage da vila, Naruto Uzumaki. Agora, assemelhando-se a uma metrópole moderna, Konohagakure mudou, especialmente a vida de um shinobi. Sob o olhar atento de Naruto e seus antigos companheiros, uma nova geração de shinobi se destacou para aprender os costumes dos ninjas.', 'Primavera');

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
(1, 3, 1, 'Temporada 1'),
(2, 5, 1, 'Temporada 1'),
(3, 5, 2, 'Temporada 2'),
(4, 5, 3, 'Temporada 3'),
(5, 5, 4, 'Temporada 4'),
(6, 5, 5, 'Temporada 5');

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
(14, 'Evil', 'evil@gmail.com', '$2y$10$DunGKSE5R4SEEvGL2LPONuEz5PF0dLcHBdakLXCi.5zyaZZD6SwqC', NULL, '2025-06-24 00:59:59', NULL),
(15, 'ADM', 'admin@admin.com', '$2y$10$rOXWDXnw0k/lmriG1K1AOuivjFmCbirnAeJh/llvhUS5SWJqgSgsi', NULL, '2025-06-24 01:01:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_animes_assistindo`
--

CREATE TABLE `usuarios_animes_assistindo` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `anime_id` int(11) NOT NULL,
  `episodio` int(11) NOT NULL,
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `episodios`
--
ALTER TABLE `episodios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `informacoes`
--
ALTER TABLE `informacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `temporadas_animes`
--
ALTER TABLE `temporadas_animes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios_animes_assistindo`
--
ALTER TABLE `usuarios_animes_assistindo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
