-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql312.infinityfree.com
-- Tempo de geração: 16/06/2025 às 08:18
-- Versão do servidor: 10.6.19-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_38701439_fatecmeets`
--
CREATE DATABASE IF NOT EXISTS `if0_38701439_fatecmeets` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `if0_38701439_fatecmeets`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_evento` datetime NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `status` tinyint(4) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `usuario_id`, `titulo`, `local`, `categoria`, `data_evento`, `descricao`, `imagem`, `data_criacao`, `status`) VALUES
(1, 1, 'Evento teste', 'Biblioteca', 'leitura', '2025-05-20 15:30:00', 'Teste de criação primeiro evento', 'uploads/682c6e11c287a-imagemTeste.webp', '2025-05-20 04:57:05', 1),
(2, 1, 'Segundo teste', 'Cantina', 'estudos', '2025-05-25 23:13:00', 'Segundo teste de criação de post', 'uploads/682c6fae90ea8-1000031578.jpg', '2025-05-20 05:03:57', 1),
(3, 1, 'Terceiro Teste', 'Sala de Estudos', 'esporte', '1999-05-04 15:50:00', 'Teste de terceiro evento', 'uploads/682c7b7492902-imagemTeste.webp', '2025-05-20 05:54:12', 1),
(4, 1, 'Gp - estudos', 'Fatec', 'estudos', '2020-06-20 13:31:00', 'Teste de grupo de estudos', 'uploads/682c8365b713b-imagemTeste.webp', '2025-05-20 06:28:05', 1),
(5, 1, 'Ensaio de musica', 'Auditório', 'música', '2025-07-11 15:30:00', 'Ensaio de uma nova playlist minha', 'uploads/6846eed4394d1-drums-7751985_1280.jpg', '2025-06-09 07:25:24', 1),
(6, 1, 'Ensaio Teatral', 'Auditório', 'estudos', '2025-07-28 10:20:00', 'Ensaio Teatral para uma futura apresentação', 'uploads/6846efbbac588-theater-8569119_1280.jpg', '2025-06-09 07:29:15', 1),
(7, 1, 'Teste de evento a ser desativado ', 'Teste', 'leitura', '2025-06-12 22:13:00', 'Excluir evento ', 'uploads/684a29e62ddd0-1000037331.jpg', '2025-06-11 18:14:14', 1),
(8, 2, 'Teste de Evento', 'Cantina', 'esporte', '2025-07-23 18:14:00', 'Teste evento criado por segundo usuario', 'uploads/684f6217cb091-cat-sunglasses-gangster-digital-art-animal-4k-wallpaper-uhdpaper.com-241@0@j.jpg', '2025-06-15 17:15:19', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `data_curtida` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT 'view/imagens/perfil-padrao.png'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`user_id`, `nome`, `email`, `nickname`, `numero`, `senha`, `profile_image`, `created_at`, `foto`) VALUES
(1, 'Matheus Marinho', 'teste@teste.com', 'fe', '11985723027', '$2y$10$iwArLKr.fPPMRJZoMqWP4emSWlXBYkPzpts4QO6BMwvnCzOoarC4K', 'uploads/perfil_68377ff8331be.jpg', '2025-05-15 14:27:19', 'view/imagens/perfil-padrao.png'),
(2, 'Nicolas Felipe', 'teste2@teste2.com', 'cagezinho', '40028922', '$2y$10$5More0ybVtOHKaSwsp5MEehpV.IZMxa3S.EkekIN7jm3AMPApNuF2', 'uploads/UserImage/user_2_984da567db.jpg', '2025-06-16 00:13:41', 'view/imagens/perfil-padrao.png');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
