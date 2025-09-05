-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 18/08/2025 às 19:49
-- Versão do servidor: 8.0.43
-- Versão do PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fatecmeets`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `academicos`
--

CREATE TABLE `academicos` (
  `id_academicos` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `nome_academicos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ra_academicos` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `adicionais`
--

CREATE TABLE `adicionais` (
  `id_adicionais` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `id_telefone` bigint UNSIGNED DEFAULT NULL,
  `id_endereco` bigint UNSIGNED DEFAULT NULL,
  `id_instituicao` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `nome_administrador` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `data_agenda` date NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `id_evento` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `nome_aluno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ra_aluno` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

CREATE TABLE `atividade` (
  `id_atividade` bigint UNSIGNED NOT NULL,
  `likes` int NOT NULL DEFAULT '0',
  `score` int NOT NULL DEFAULT '0',
  `tipo_atividade` enum('postagem','comentario','evento','participacao') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_gameficacao` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat`
--

CREATE TABLE `chat` (
  `id_chat` bigint UNSIGNED NOT NULL,
  `nome_chat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_chat` enum('privado','grupo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'privado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat_denunciado`
--

CREATE TABLE `chat_denunciado` (
  `id_chat_denunciado` bigint UNSIGNED NOT NULL,
  `id_chat` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` bigint UNSIGNED NOT NULL,
  `descricao_comentario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `id_atividade` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios_denunciado`
--

CREATE TABLE `comentarios_denunciado` (
  `id_comentarios_denunciado` bigint UNSIGNED NOT NULL,
  `id_comentario` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario_evento`
--

CREATE TABLE `comentario_evento` (
  `id_comentario_evento` bigint UNSIGNED NOT NULL,
  `id_evento` bigint UNSIGNED NOT NULL,
  `id_comentario` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario_postagem`
--

CREATE TABLE `comentario_postagem` (
  `id_comentario_postagem` bigint UNSIGNED NOT NULL,
  `id_postagem` bigint UNSIGNED NOT NULL,
  `id_comentario` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conexao`
--

CREATE TABLE `conexao` (
  `id_conexao` bigint UNSIGNED NOT NULL,
  `id_gameficacao` bigint UNSIGNED NOT NULL,
  `id_gameficacao_conexao` bigint UNSIGNED NOT NULL,
  `status_conexao` enum('pendente','aceita','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` bigint UNSIGNED NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id_evento` bigint UNSIGNED NOT NULL,
  `nome_evento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `data_inicio_evento` datetime NOT NULL,
  `data_final_evento` datetime DEFAULT NULL,
  `imagem_evento` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_evento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `id_atividade` bigint UNSIGNED DEFAULT NULL,
  `id_lugares` bigint UNSIGNED DEFAULT NULL,
  `id_logradouro` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_denunciado`
--

CREATE TABLE `evento_denunciado` (
  `id_evento_denunciado` bigint UNSIGNED NOT NULL,
  `id_evento` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gameficacao`
--

CREATE TABLE `gameficacao` (
  `id_gameficacao` bigint UNSIGNED NOT NULL,
  `score_total` int NOT NULL DEFAULT '0',
  `nickname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gameficacao_denunciado`
--

CREATE TABLE `gameficacao_denunciado` (
  `id_gameficacao_denunciado` bigint UNSIGNED NOT NULL,
  `id_gameficacao` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id_instituicao` bigint UNSIGNED NOT NULL,
  `nome_instituicao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_institucional` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `intencao`
--

CREATE TABLE `intencao` (
  `id_intencao` bigint UNSIGNED NOT NULL,
  `id_evento` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `status_intencao` enum('interessado','participando','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'interessado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lixo`
--

CREATE TABLE `lixo` (
  `id_lixo` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `tabela_origem` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_registro_origem` int NOT NULL,
  `motivo_exclusao` text COLLATE utf8mb4_unicode_ci,
  `dados_tabela` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logradouro`
--

CREATE TABLE `logradouro` (
  `id_logradouro` bigint UNSIGNED NOT NULL,
  `id_endereco` bigint UNSIGNED NOT NULL,
  `nome_logradouro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lugares`
--

CREATE TABLE `lugares` (
  `id_lugar` bigint UNSIGNED NOT NULL,
  `id_endereco` bigint UNSIGNED NOT NULL,
  `nome_lugares` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `membros`
--

CREATE TABLE `membros` (
  `id_membros` bigint UNSIGNED NOT NULL,
  `id_chat` bigint UNSIGNED NOT NULL,
  `id_gameficacao` bigint UNSIGNED NOT NULL,
  `status_membro` enum('ativo','saiu','removido') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id_mensagens` bigint UNSIGNED NOT NULL,
  `id_chat` bigint UNSIGNED NOT NULL,
  `id_gameficacao` bigint UNSIGNED NOT NULL,
  `descricao_mensagens` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_mensagem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens_denunciado`
--

CREATE TABLE `mensagens_denunciado` (
  `id_mensagens_denunciado` bigint UNSIGNED NOT NULL,
  `id_mensagens` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_18_150359_create_usuario_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagens`
--

CREATE TABLE `postagens` (
  `id_postagem` bigint UNSIGNED NOT NULL,
  `titulo_postagem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao_postagem` text COLLATE utf8mb4_unicode_ci,
  `imagem_postagem` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_postagem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `id_atividade` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagens_denunciado`
--

CREATE TABLE `postagens_denunciado` (
  `id_postagens_denunciado` bigint UNSIGNED NOT NULL,
  `id_postagem` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `redes`
--

CREATE TABLE `redes` (
  `id_redes` bigint UNSIGNED NOT NULL,
  `id_adicionais` bigint UNSIGNED NOT NULL,
  `tipo_rede` enum('instagram','linkedin','github','twitter','facebook','outro') COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_redes` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `id_telefone` bigint UNSIGNED NOT NULL,
  `numero_telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ddd` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_telefone` enum('celular','residencial','comercial') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'celular'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem_usuario` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_conta` enum('ativo','inativo','suspenso') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `senha`, `imagem_usuario`, `status_conta`, `created_at`, `updated_at`) VALUES
(2, 'gabriel.rodrigues106@fatec.sp.gov.br', '$2y$10$khT2lp0mM.31ZIQnhK0Bh.fjpVl2Vaz5neSMNZHqMpkpAxYKALSeG', NULL, 'ativo', '2025-08-18 19:20:21', '2025-08-18 19:20:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_denunciado`
--

CREATE TABLE `usuario_denunciado` (
  `id_usuario_denunciado` bigint UNSIGNED NOT NULL,
  `id_usuario` bigint UNSIGNED NOT NULL,
  `id_administrador` bigint UNSIGNED DEFAULT NULL,
  `id_lixo` bigint UNSIGNED DEFAULT NULL,
  `motivo_denuncia` text COLLATE utf8mb4_unicode_ci,
  `status_denuncia` enum('pendente','analisando','resolvida','rejeitada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `academicos`
--
ALTER TABLE `academicos`
  ADD PRIMARY KEY (`id_academicos`),
  ADD UNIQUE KEY `academicos_ra_academicos_unique` (`ra_academicos`),
  ADD KEY `academicos_id_usuario_foreign` (`id_usuario`);

--
-- Índices de tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD PRIMARY KEY (`id_adicionais`),
  ADD KEY `adicionais_id_usuario_foreign` (`id_usuario`),
  ADD KEY `adicionais_id_telefone_foreign` (`id_telefone`),
  ADD KEY `adicionais_id_endereco_foreign` (`id_endereco`),
  ADD KEY `adicionais_id_instituicao_foreign` (`id_instituicao`);

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `administradores_id_usuario_foreign` (`id_usuario`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `agenda_id_usuario_foreign` (`id_usuario`),
  ADD KEY `agenda_id_evento_foreign` (`id_evento`);

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD UNIQUE KEY `aluno_ra_aluno_unique` (`ra_aluno`),
  ADD KEY `aluno_id_usuario_foreign` (`id_usuario`);

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD KEY `atividade_id_gameficacao_foreign` (`id_gameficacao`);

--
-- Índices de tabela `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Índices de tabela `chat_denunciado`
--
ALTER TABLE `chat_denunciado`
  ADD PRIMARY KEY (`id_chat_denunciado`),
  ADD KEY `chat_denunciado_id_chat_foreign` (`id_chat`),
  ADD KEY `chat_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `chat_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `comentarios_id_usuario_foreign` (`id_usuario`),
  ADD KEY `comentarios_id_atividade_foreign` (`id_atividade`);

--
-- Índices de tabela `comentarios_denunciado`
--
ALTER TABLE `comentarios_denunciado`
  ADD PRIMARY KEY (`id_comentarios_denunciado`),
  ADD KEY `comentarios_denunciado_id_comentario_foreign` (`id_comentario`),
  ADD KEY `comentarios_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `comentarios_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `comentario_evento`
--
ALTER TABLE `comentario_evento`
  ADD PRIMARY KEY (`id_comentario_evento`),
  ADD UNIQUE KEY `comentario_evento_id_evento_id_comentario_unique` (`id_evento`,`id_comentario`),
  ADD KEY `comentario_evento_id_comentario_foreign` (`id_comentario`);

--
-- Índices de tabela `comentario_postagem`
--
ALTER TABLE `comentario_postagem`
  ADD PRIMARY KEY (`id_comentario_postagem`),
  ADD UNIQUE KEY `comentario_postagem_id_postagem_id_comentario_unique` (`id_postagem`,`id_comentario`),
  ADD KEY `comentario_postagem_id_comentario_foreign` (`id_comentario`);

--
-- Índices de tabela `conexao`
--
ALTER TABLE `conexao`
  ADD PRIMARY KEY (`id_conexao`),
  ADD UNIQUE KEY `conexao_id_gameficacao_id_gameficacao_conexao_unique` (`id_gameficacao`,`id_gameficacao_conexao`),
  ADD KEY `conexao_id_gameficacao_conexao_foreign` (`id_gameficacao_conexao`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `evento_id_usuario_foreign` (`id_usuario`),
  ADD KEY `evento_id_atividade_foreign` (`id_atividade`),
  ADD KEY `evento_id_lugares_foreign` (`id_lugares`),
  ADD KEY `evento_id_logradouro_foreign` (`id_logradouro`);

--
-- Índices de tabela `evento_denunciado`
--
ALTER TABLE `evento_denunciado`
  ADD PRIMARY KEY (`id_evento_denunciado`),
  ADD KEY `evento_denunciado_id_evento_foreign` (`id_evento`),
  ADD KEY `evento_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `evento_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `gameficacao`
--
ALTER TABLE `gameficacao`
  ADD PRIMARY KEY (`id_gameficacao`),
  ADD UNIQUE KEY `gameficacao_nickname_unique` (`nickname`),
  ADD KEY `gameficacao_id_usuario_foreign` (`id_usuario`);

--
-- Índices de tabela `gameficacao_denunciado`
--
ALTER TABLE `gameficacao_denunciado`
  ADD PRIMARY KEY (`id_gameficacao_denunciado`),
  ADD KEY `gameficacao_denunciado_id_gameficacao_foreign` (`id_gameficacao`),
  ADD KEY `gameficacao_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `gameficacao_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`id_instituicao`),
  ADD UNIQUE KEY `instituicao_codigo_institucional_unique` (`codigo_institucional`);

--
-- Índices de tabela `intencao`
--
ALTER TABLE `intencao`
  ADD PRIMARY KEY (`id_intencao`),
  ADD UNIQUE KEY `intencao_id_usuario_id_evento_unique` (`id_usuario`,`id_evento`),
  ADD KEY `intencao_id_evento_foreign` (`id_evento`);

--
-- Índices de tabela `lixo`
--
ALTER TABLE `lixo`
  ADD PRIMARY KEY (`id_lixo`),
  ADD KEY `lixo_id_usuario_foreign` (`id_usuario`);

--
-- Índices de tabela `logradouro`
--
ALTER TABLE `logradouro`
  ADD PRIMARY KEY (`id_logradouro`),
  ADD KEY `logradouro_id_endereco_foreign` (`id_endereco`);

--
-- Índices de tabela `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `lugares_id_endereco_foreign` (`id_endereco`),
  ADD KEY `lugares_id_administrador_foreign` (`id_administrador`);

--
-- Índices de tabela `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`id_membros`),
  ADD UNIQUE KEY `membros_id_chat_id_gameficacao_unique` (`id_chat`,`id_gameficacao`),
  ADD KEY `membros_id_gameficacao_foreign` (`id_gameficacao`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id_mensagens`),
  ADD KEY `mensagens_id_chat_foreign` (`id_chat`),
  ADD KEY `mensagens_id_gameficacao_foreign` (`id_gameficacao`);

--
-- Índices de tabela `mensagens_denunciado`
--
ALTER TABLE `mensagens_denunciado`
  ADD PRIMARY KEY (`id_mensagens_denunciado`),
  ADD KEY `mensagens_denunciado_id_mensagens_foreign` (`id_mensagens`),
  ADD KEY `mensagens_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `mensagens_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `postagens`
--
ALTER TABLE `postagens`
  ADD PRIMARY KEY (`id_postagem`),
  ADD KEY `postagens_id_usuario_foreign` (`id_usuario`),
  ADD KEY `postagens_id_atividade_foreign` (`id_atividade`);

--
-- Índices de tabela `postagens_denunciado`
--
ALTER TABLE `postagens_denunciado`
  ADD PRIMARY KEY (`id_postagens_denunciado`),
  ADD KEY `postagens_denunciado_id_postagem_foreign` (`id_postagem`),
  ADD KEY `postagens_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `postagens_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- Índices de tabela `redes`
--
ALTER TABLE `redes`
  ADD PRIMARY KEY (`id_redes`),
  ADD KEY `redes_id_adicionais_foreign` (`id_adicionais`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id_telefone`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario_email_unique` (`email`);

--
-- Índices de tabela `usuario_denunciado`
--
ALTER TABLE `usuario_denunciado`
  ADD PRIMARY KEY (`id_usuario_denunciado`),
  ADD KEY `usuario_denunciado_id_usuario_foreign` (`id_usuario`),
  ADD KEY `usuario_denunciado_id_administrador_foreign` (`id_administrador`),
  ADD KEY `usuario_denunciado_id_lixo_foreign` (`id_lixo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `academicos`
--
ALTER TABLE `academicos`
  MODIFY `id_academicos` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `adicionais`
--
ALTER TABLE `adicionais`
  MODIFY `id_adicionais` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chat_denunciado`
--
ALTER TABLE `chat_denunciado`
  MODIFY `id_chat_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios_denunciado`
--
ALTER TABLE `comentarios_denunciado`
  MODIFY `id_comentarios_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario_evento`
--
ALTER TABLE `comentario_evento`
  MODIFY `id_comentario_evento` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario_postagem`
--
ALTER TABLE `comentario_postagem`
  MODIFY `id_comentario_postagem` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conexao`
--
ALTER TABLE `conexao`
  MODIFY `id_conexao` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id_evento` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `evento_denunciado`
--
ALTER TABLE `evento_denunciado`
  MODIFY `id_evento_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gameficacao`
--
ALTER TABLE `gameficacao`
  MODIFY `id_gameficacao` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gameficacao_denunciado`
--
ALTER TABLE `gameficacao_denunciado`
  MODIFY `id_gameficacao_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id_instituicao` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `intencao`
--
ALTER TABLE `intencao`
  MODIFY `id_intencao` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lixo`
--
ALTER TABLE `lixo`
  MODIFY `id_lixo` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logradouro`
--
ALTER TABLE `logradouro`
  MODIFY `id_logradouro` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugar` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `membros`
--
ALTER TABLE `membros`
  MODIFY `id_membros` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id_mensagens` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens_denunciado`
--
ALTER TABLE `mensagens_denunciado`
  MODIFY `id_mensagens_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens`
--
ALTER TABLE `postagens`
  MODIFY `id_postagem` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postagens_denunciado`
--
ALTER TABLE `postagens_denunciado`
  MODIFY `id_postagens_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redes`
--
ALTER TABLE `redes`
  MODIFY `id_redes` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id_telefone` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario_denunciado`
--
ALTER TABLE `usuario_denunciado`
  MODIFY `id_usuario_denunciado` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `academicos`
--
ALTER TABLE `academicos`
  ADD CONSTRAINT `academicos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `adicionais`
--
ALTER TABLE `adicionais`
  ADD CONSTRAINT `adicionais_id_endereco_foreign` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`),
  ADD CONSTRAINT `adicionais_id_instituicao_foreign` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`id_instituicao`),
  ADD CONSTRAINT `adicionais_id_telefone_foreign` FOREIGN KEY (`id_telefone`) REFERENCES `telefone` (`id_telefone`),
  ADD CONSTRAINT `adicionais_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_id_evento_foreign` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `agenda_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_id_gameficacao_foreign` FOREIGN KEY (`id_gameficacao`) REFERENCES `gameficacao` (`id_gameficacao`);

--
-- Restrições para tabelas `chat_denunciado`
--
ALTER TABLE `chat_denunciado`
  ADD CONSTRAINT `chat_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `chat_denunciado_id_chat_foreign` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`),
  ADD CONSTRAINT `chat_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`);

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_id_atividade_foreign` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`),
  ADD CONSTRAINT `comentarios_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `comentarios_denunciado`
--
ALTER TABLE `comentarios_denunciado`
  ADD CONSTRAINT `comentarios_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `comentarios_denunciado_id_comentario_foreign` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`),
  ADD CONSTRAINT `comentarios_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`);

--
-- Restrições para tabelas `comentario_evento`
--
ALTER TABLE `comentario_evento`
  ADD CONSTRAINT `comentario_evento_id_comentario_foreign` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`),
  ADD CONSTRAINT `comentario_evento_id_evento_foreign` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`);

--
-- Restrições para tabelas `comentario_postagem`
--
ALTER TABLE `comentario_postagem`
  ADD CONSTRAINT `comentario_postagem_id_comentario_foreign` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`),
  ADD CONSTRAINT `comentario_postagem_id_postagem_foreign` FOREIGN KEY (`id_postagem`) REFERENCES `postagens` (`id_postagem`);

--
-- Restrições para tabelas `conexao`
--
ALTER TABLE `conexao`
  ADD CONSTRAINT `conexao_id_gameficacao_conexao_foreign` FOREIGN KEY (`id_gameficacao_conexao`) REFERENCES `gameficacao` (`id_gameficacao`),
  ADD CONSTRAINT `conexao_id_gameficacao_foreign` FOREIGN KEY (`id_gameficacao`) REFERENCES `gameficacao` (`id_gameficacao`);

--
-- Restrições para tabelas `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_id_atividade_foreign` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`),
  ADD CONSTRAINT `evento_id_logradouro_foreign` FOREIGN KEY (`id_logradouro`) REFERENCES `logradouro` (`id_logradouro`),
  ADD CONSTRAINT `evento_id_lugares_foreign` FOREIGN KEY (`id_lugares`) REFERENCES `lugares` (`id_lugar`),
  ADD CONSTRAINT `evento_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `evento_denunciado`
--
ALTER TABLE `evento_denunciado`
  ADD CONSTRAINT `evento_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `evento_denunciado_id_evento_foreign` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `evento_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`);

--
-- Restrições para tabelas `gameficacao`
--
ALTER TABLE `gameficacao`
  ADD CONSTRAINT `gameficacao_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `gameficacao_denunciado`
--
ALTER TABLE `gameficacao_denunciado`
  ADD CONSTRAINT `gameficacao_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `gameficacao_denunciado_id_gameficacao_foreign` FOREIGN KEY (`id_gameficacao`) REFERENCES `gameficacao` (`id_gameficacao`),
  ADD CONSTRAINT `gameficacao_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`);

--
-- Restrições para tabelas `intencao`
--
ALTER TABLE `intencao`
  ADD CONSTRAINT `intencao_id_evento_foreign` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id_evento`),
  ADD CONSTRAINT `intencao_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `lixo`
--
ALTER TABLE `lixo`
  ADD CONSTRAINT `lixo_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `logradouro`
--
ALTER TABLE `logradouro`
  ADD CONSTRAINT `logradouro_id_endereco_foreign` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`);

--
-- Restrições para tabelas `lugares`
--
ALTER TABLE `lugares`
  ADD CONSTRAINT `lugares_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `lugares_id_endereco_foreign` FOREIGN KEY (`id_endereco`) REFERENCES `endereco` (`id_endereco`);

--
-- Restrições para tabelas `membros`
--
ALTER TABLE `membros`
  ADD CONSTRAINT `membros_id_chat_foreign` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`),
  ADD CONSTRAINT `membros_id_gameficacao_foreign` FOREIGN KEY (`id_gameficacao`) REFERENCES `gameficacao` (`id_gameficacao`);

--
-- Restrições para tabelas `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_id_chat_foreign` FOREIGN KEY (`id_chat`) REFERENCES `chat` (`id_chat`),
  ADD CONSTRAINT `mensagens_id_gameficacao_foreign` FOREIGN KEY (`id_gameficacao`) REFERENCES `gameficacao` (`id_gameficacao`);

--
-- Restrições para tabelas `mensagens_denunciado`
--
ALTER TABLE `mensagens_denunciado`
  ADD CONSTRAINT `mensagens_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `mensagens_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`),
  ADD CONSTRAINT `mensagens_denunciado_id_mensagens_foreign` FOREIGN KEY (`id_mensagens`) REFERENCES `mensagens` (`id_mensagens`);

--
-- Restrições para tabelas `postagens`
--
ALTER TABLE `postagens`
  ADD CONSTRAINT `postagens_id_atividade_foreign` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`),
  ADD CONSTRAINT `postagens_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `postagens_denunciado`
--
ALTER TABLE `postagens_denunciado`
  ADD CONSTRAINT `postagens_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `postagens_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`),
  ADD CONSTRAINT `postagens_denunciado_id_postagem_foreign` FOREIGN KEY (`id_postagem`) REFERENCES `postagens` (`id_postagem`);

--
-- Restrições para tabelas `redes`
--
ALTER TABLE `redes`
  ADD CONSTRAINT `redes_id_adicionais_foreign` FOREIGN KEY (`id_adicionais`) REFERENCES `adicionais` (`id_adicionais`);

--
-- Restrições para tabelas `usuario_denunciado`
--
ALTER TABLE `usuario_denunciado`
  ADD CONSTRAINT `usuario_denunciado_id_administrador_foreign` FOREIGN KEY (`id_administrador`) REFERENCES `administradores` (`id_administrador`),
  ADD CONSTRAINT `usuario_denunciado_id_lixo_foreign` FOREIGN KEY (`id_lixo`) REFERENCES `lixo` (`id_lixo`),
  ADD CONSTRAINT `usuario_denunciado_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
