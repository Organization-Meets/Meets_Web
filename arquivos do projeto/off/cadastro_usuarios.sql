-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Abr-2025 às 13:26
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nickname varchar(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    numero varchar(25),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    profile_image VARCHAR(255) DEFAULT NULL
);
E=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela de eventos (events)
CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    likes INT,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(255),
    image_reference VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status tinyint(1) DEFAULT 1, -- 1 para ativo, 0 para inativo
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

INSERT INTO `users` (`id`, `nome`, `email`, `usuario`, `celular`, `senha`, `data_cadastro`) VALUES
(1, 'Felipe Catarino', 'felipecatarinu@gmail.com', 'FeFedaZL', '11985723027', '$2y$10$DOnxolVmSl/AMeZIg9BneO0HQcFa7j6MAQWzH924CtaOcP1aulSGm', '2025-04-08 13:42:37'),
(3, 'Nicolas ferreira', 'nicolas@gmail.com', 'Nicky', '11985723027', '$2y$10$vHqb4oHRa0v7vW2jvPMP5eBWE2EUdHzufDkJF4iee.NMzj9N1aLBa', '2025-04-08 13:48:22');

-- Cria uma tabela para armazenar os comentários dos eventos
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,            -- ID único do comentário
    evento_id INT,                                -- Referência ao evento
    usuario_id INT,                               -- Referência ao usuário que comentou
    comentario TEXT,                              -- Texto do comentário (sem limite rígido de 255)
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP, -- Data/hora automática da criação
    FOREIGN KEY (evento_id) REFERENCES eventos(id),
    FOREIGN KEY (usuario_id) REFERENCES users(user_id)
);



-- Tabela de presenças (attendees)
CREATE TABLE attendees (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    status ENUM('confirmado', 'interessado', 'não comparecerá') DEFAULT 'interessado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
