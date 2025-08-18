-- Schema do banco de dados FatecMeets
-- Corrigido e simplificado

CREATE TABLE Usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    imagem_usuario VARCHAR(500),
    status_conta ENUM('ativo', 'inativo', 'suspenso') DEFAULT 'ativo'
);

CREATE TABLE Telefone (
    id_telefone INT PRIMARY KEY AUTO_INCREMENT,
    numero_telefone VARCHAR(15) NOT NULL,
    ddd VARCHAR(3) NOT NULL,
    tipo_telefone ENUM('celular', 'residencial', 'comercial') DEFAULT 'celular'
);

CREATE TABLE Endereco (
    id_endereco INT PRIMARY KEY AUTO_INCREMENT,
    numero VARCHAR(10),
    cep VARCHAR(10) NOT NULL
);

CREATE TABLE Instituicao (
    id_instituicao INT PRIMARY KEY AUTO_INCREMENT,
    nome_instituicao VARCHAR(255) NOT NULL,
    codigo_institucional VARCHAR(50) UNIQUE
);

CREATE TABLE Administradores (
    id_administrador INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nome_administrador VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Aluno (
    id_aluno INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nome_aluno VARCHAR(255) NOT NULL,
    ra_aluno VARCHAR(20) UNIQUE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Academicos (
    id_academicos INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nome_academicos VARCHAR(255) NOT NULL,
    ra_academicos VARCHAR(20) UNIQUE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Logradouro (
    id_logradouro INT PRIMARY KEY AUTO_INCREMENT,
    id_endereco INT NOT NULL,
    nome_logradouro VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_endereco) REFERENCES Endereco(id_endereco)
);

CREATE TABLE Lugares (
    id_lugar INT PRIMARY KEY AUTO_INCREMENT,
    id_endereco INT NOT NULL,
    nome_lugares VARCHAR(255) NOT NULL,
    id_administrador INT,
    FOREIGN KEY (id_endereco) REFERENCES Endereco(id_endereco),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador)
);

CREATE TABLE Gameficacao (
    id_gameficacao INT PRIMARY KEY AUTO_INCREMENT,
    score_total INT DEFAULT 0,
    nickname VARCHAR(100) UNIQUE,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Atividade (
    id_atividade INT PRIMARY KEY AUTO_INCREMENT,
    likes INT DEFAULT 0,
    score INT DEFAULT 0,
    tipo_atividade ENUM('postagem', 'comentario', 'evento', 'participacao') NOT NULL,
    id_gamificacao INT,
    FOREIGN KEY (id_gamificacao) REFERENCES Gameficacao(id_gameficacao)
);

CREATE TABLE Evento (
    id_evento INT PRIMARY KEY AUTO_INCREMENT,
    nome_evento VARCHAR(255) NOT NULL,
    descricao TEXT,
    data_inicio_evento DATETIME NOT NULL,
    data_final_evento DATETIME,
    imagem_evento VARCHAR(500),
    categoria_evento VARCHAR(100),
    id_usuario INT NOT NULL,
    id_atividade INT,
    id_lugares INT,
    id_logradouro INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_atividade) REFERENCES Atividade(id_atividade),
    FOREIGN KEY (id_lugares) REFERENCES Lugares(id_lugar),
    FOREIGN KEY (id_logradouro) REFERENCES Logradouro(id_logradouro)
);

CREATE TABLE Postagens (
    id_postagem INT PRIMARY KEY AUTO_INCREMENT,
    titulo_postagem VARCHAR(255) NOT NULL,
    descricao_postagem TEXT,
    imagem_postagem VARCHAR(500),
    data_postagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    id_atividade INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_atividade) REFERENCES Atividade(id_atividade)
);

CREATE TABLE Comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    descricao_comentario TEXT NOT NULL,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    id_atividade INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_atividade) REFERENCES Atividade(id_atividade)
);

CREATE TABLE Intencao (
    id_intencao INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_usuario INT NOT NULL,
    status_intencao ENUM('interessado', 'participando', 'cancelado') DEFAULT 'interessado',
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    UNIQUE KEY unique_user_event (id_usuario, id_evento)
);

CREATE TABLE Agenda (
    id_agenda INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    data_agenda DATE NOT NULL,
    descricao TEXT,
    id_evento INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento)
);

CREATE TABLE Adicionais (
    id_adicionais INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_telefone INT,
    id_endereco INT,
    id_instituicao INT,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_telefone) REFERENCES Telefone(id_telefone),
    FOREIGN KEY (id_endereco) REFERENCES Endereco(id_endereco),
    FOREIGN KEY (id_instituicao) REFERENCES Instituicao(id_instituicao)
);

CREATE TABLE Redes (
    id_redes INT PRIMARY KEY AUTO_INCREMENT,
    id_adicionais INT NOT NULL,
    tipo_rede ENUM('instagram', 'linkedin', 'github', 'twitter', 'facebook', 'outro') NOT NULL,
    url_redes VARCHAR(500) NOT NULL,
    FOREIGN KEY (id_adicionais) REFERENCES Adicionais(id_adicionais)
);

CREATE TABLE Chat (
    id_chat INT PRIMARY KEY AUTO_INCREMENT,
    nome_chat VARCHAR(255),
    tipo_chat ENUM('privado', 'grupo') DEFAULT 'privado'
);

CREATE TABLE Membros (
    id_membros INT PRIMARY KEY AUTO_INCREMENT,
    id_chat INT NOT NULL,
    id_gameficacao INT NOT NULL,
    status_membro ENUM('ativo', 'saiu', 'removido') DEFAULT 'ativo',
    FOREIGN KEY (id_chat) REFERENCES Chat(id_chat),
    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao),
    UNIQUE KEY unique_chat_member (id_chat, id_gameficacao)
);

CREATE TABLE Mensagens (
    id_mensagens INT PRIMARY KEY AUTO_INCREMENT,
    id_chat INT NOT NULL,
    id_gameficacao INT NOT NULL,
    descricao_mensagens TEXT NOT NULL,
    data_mensagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_chat) REFERENCES Chat(id_chat),
    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao)
);

CREATE TABLE Conexao (
    id_conexao INT PRIMARY KEY AUTO_INCREMENT,
    id_gameficacao INT NOT NULL,
    id_gameficacao_conexao INT NOT NULL,
    status_conexao ENUM('pendente', 'aceita', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao),
    FOREIGN KEY (id_gameficacao_conexao) REFERENCES Gameficacao(id_gameficacao),
    UNIQUE KEY unique_connection (id_gameficacao, id_gameficacao_conexao)
);

CREATE TABLE Lixo (
    id_lixo INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    tabela_origem VARCHAR(100) NOT NULL,
    id_registro_origem INT NOT NULL,
    motivo_exclusao TEXT,
    dados_tabela JSON,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)
);

CREATE TABLE Usuario_denunciado (
    id_usuario_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Mensagens_denunciado (
    id_mensagens_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_mensagens INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_mensagens) REFERENCES Mensagens(id_mensagens),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Chat_denunciado (
    id_chat_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_chat INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_chat) REFERENCES Chat(id_chat),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Postagens_denunciado (
    id_postagens_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_postagem INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_postagem) REFERENCES Postagens(id_postagem),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Gameficacao_denunciado (
    id_gameficacao_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_gameficacao INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Comentarios_denunciado (
    id_comentarios_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_comentario INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Evento_denunciado (
    id_evento_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

-- Tabelas de relacionamento para comentários específicos
CREATE TABLE Comentario_Evento (
    id_comentario_evento INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_comentario INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    UNIQUE KEY unique_comment_event (id_evento, id_comentario)
);

CREATE TABLE Comentario_Postagem (
    id_comentario_postagem INT PRIMARY KEY AUTO_INCREMENT,
    id_postagem INT NOT NULL,
    id_comentario INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postagem) REFERENCES Postagens(id_postagem),
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    UNIQUE KEY unique_comment_post (id_postagem, id_comentario)
);

-- Índices para melhor performance
CREATE INDEX idx_usuario_email ON Usuario(email);
CREATE INDEX idx_aluno_ra ON Aluno(ra_aluno);
CREATE INDEX idx_evento_data ON Evento(data_inicio_evento);
CREATE INDEX idx_postagem_data ON Postagens(data_postagem);
CREATE INDEX idx_comentario_data ON Comentarios(data_comentario);
CREATE INDEX idx_mensagem_data ON Mensagens(data_mensagem);
CREATE INDEX idx_gameficacao_score ON Gameficacao(score_total);
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Gameficacao_denunciado (
    id_gameficacao_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_gameficacao INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Comentarios_denunciado (
    id_comentarios_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_comentario INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

CREATE TABLE Evento_denunciado (
    id_evento_denunciado INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_administrador INT,
    id_lixo INT,
    motivo_denuncia TEXT,
    status_denuncia ENUM('pendente', 'analisando', 'resolvida', 'rejeitada') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
    FOREIGN KEY (id_administrador) REFERENCES Administradores(id_administrador),
    FOREIGN KEY (id_lixo) REFERENCES Lixo(id_lixo)
);

-- Tabelas de relacionamento para comentários específicos
CREATE TABLE Comentario_Evento (
    id_comentario_evento INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_comentario INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    UNIQUE KEY unique_comment_event (id_evento, id_comentario)
);

CREATE TABLE Comentario_Postagem (
    id_comentario_postagem INT PRIMARY KEY AUTO_INCREMENT,
    id_postagem INT NOT NULL,
    id_comentario INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_postagem) REFERENCES Postagens(id_postagem),
    FOREIGN KEY (id_comentario) REFERENCES Comentarios(id_comentario),
    UNIQUE KEY unique_comment_post (id_postagem, id_comentario)
);

-- Índices para melhor performance
CREATE INDEX idx_usuario_email ON Usuario(email);
CREATE INDEX idx_aluno_ra ON Aluno(ra_aluno);
CREATE INDEX idx_evento_data ON Evento(data_inicio_evento);
CREATE INDEX idx_postagem_data ON Postagens(data_postagem);
CREATE INDEX idx_comentario_data ON Comentarios(data_comentario);
CREATE INDEX idx_mensagem_data ON Mensagens(data_mensagem);
CREATE INDEX idx_gameficacao_score ON Gameficacao(score_total);
