-- =====================
-- TABELA USUARIOS
-- =====================
CREATE TABLE usuarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verification_token VARCHAR(10) NULL,
    imagem JSON NULL,
    status ENUM('ativo','inativo','suspenso') DEFAULT 'ativo',
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =====================
-- TABELA ADMINISTRADORES
-- =====================
CREATE TABLE administradores (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_administradores_usuarios FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA CONEXOES
-- =====================
CREATE TABLE conexoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_origem_id BIGINT UNSIGNED NOT NULL,
    usuario_destino_id BIGINT UNSIGNED NOT NULL,
    status ENUM('pendente', 'aceito', 'recusado', 'bloqueado') DEFAULT 'pendente',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_conexoes_usuario_origem FOREIGN KEY (usuario_origem_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_conexoes_usuario_destino FOREIGN KEY (usuario_destino_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE,
    CONSTRAINT uq_conexao UNIQUE (usuario_origem_id, usuario_destino_id)
);

-- =====================
-- TABELA GAMIFICACOES
-- =====================
CREATE TABLE gamificacoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    score_total INT DEFAULT 0,
    nickname VARCHAR(100) UNIQUE NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_gamificacoes_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- =====================
-- TABELA ALUNOS
-- =====================
CREATE TABLE alunos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_alunos_usuarios FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA ACADEMICOS
-- =====================
CREATE TABLE academicos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_academicos_usuarios FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA ATIVIDADES
-- =====================
CREATE TABLE atividades (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    likes INT DEFAULT 0,
    tipo ENUM('postagem','comentario','evento','participacao') NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =====================
-- TABELA COMENTARIOS
-- =====================
CREATE TABLE comentarios (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descricao TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_id BIGINT UNSIGNED NOT NULL,
    atividade_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_comentarios_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_comentarios_atividades FOREIGN KEY (atividade_id) REFERENCES atividades(id)
);

-- =====================
-- TABELA TELEFONES
-- =====================
CREATE TABLE telefones (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(15) NOT NULL,
    ddd VARCHAR(3) NOT NULL,
    tipo ENUM('celular','residencial','comercial') DEFAULT 'celular',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =====================
-- TABELA ENDERECOS
-- =====================
CREATE TABLE enderecos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(10) NULL,
    cep VARCHAR(10) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =====================
-- TABELA COMPLEMENTOS
-- =====================
CREATE TABLE complementos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    endereco_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_complementos_enderecos FOREIGN KEY (endereco_id)
        REFERENCES enderecos(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA LUGARES
-- =====================
CREATE TABLE lugares (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    endereco_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    administrador_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_lugares_enderecos FOREIGN KEY (endereco_id)
        REFERENCES enderecos(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_lugares_administradores FOREIGN KEY (administrador_id)
        REFERENCES administradores(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA INSTITUICOES
-- =====================
CREATE TABLE instituicoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    administrador_id BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    codigo VARCHAR(50) UNIQUE NULL,
    telefone_id BIGINT UNSIGNED NOT NULL,
    endereco_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_instituicoes_administradores FOREIGN KEY (administrador_id)
        REFERENCES administradores(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_instituicoes_enderecos FOREIGN KEY (endereco_id)
        REFERENCES enderecos(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_instituicoes_telefones FOREIGN KEY (telefone_id)
        REFERENCES telefones(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA ADICIONAIS
-- =====================
CREATE TABLE adicionais (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    telefone_id BIGINT UNSIGNED NULL,
    endereco_id BIGINT UNSIGNED NULL,
    instituicao_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_adicionais_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_adicionais_telefones FOREIGN KEY (telefone_id) REFERENCES telefones(id),
    CONSTRAINT fk_adicionais_enderecos FOREIGN KEY (endereco_id) REFERENCES enderecos(id),
    CONSTRAINT fk_adicionais_instituicoes FOREIGN KEY (instituicao_id) REFERENCES instituicoes(id)
);

-- =====================
-- TABELA REDES
-- =====================
CREATE TABLE redes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    adicional_id BIGINT UNSIGNED NOT NULL,
    tipo ENUM('instagram','linkedin','github','twitter','facebook','outro') NOT NULL,
    url VARCHAR(500) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_redes_adicionais FOREIGN KEY (adicional_id) REFERENCES adicionais(id)
);

-- =====================
-- TABELA POSTAGENS
-- =====================
CREATE TABLE postagens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    imagem JSON NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario_id BIGINT UNSIGNED NOT NULL,
    atividade_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_postagens_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_postagens_atividades FOREIGN KEY (atividade_id) REFERENCES atividades(id)
);

-- =====================
-- TABELA EVENTOS
-- =====================
CREATE TABLE eventos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    imagem JSON NULL,
    descricao TEXT NOT NULL,
    data_inicio DATE NOT NULL,
    data_final DATE NOT NULL,
    complemento_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,
    atividade_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_eventos_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_eventos_atividades FOREIGN KEY (atividade_id) REFERENCES atividades(id)
);

-- =====================
-- TABELA CHATS
-- =====================
CREATE TABLE chats (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo ENUM('privado','grupo') DEFAULT 'privado',
    usuario_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_chats_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- =====================
-- TABELA MEMBROS
-- =====================
CREATE TABLE membros (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chat_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,
    role ENUM('membro','admin') DEFAULT 'membro',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_membros_chats FOREIGN KEY (chat_id) REFERENCES chats(id),
    CONSTRAINT fk_membros_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- =====================
-- TABELA MENSAGENS
-- =====================
CREATE TABLE mensagens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL,
    chat_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_mensagens_chats FOREIGN KEY (chat_id) REFERENCES chats(id),
    CONSTRAINT fk_mensagens_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);-- =====================
-- TABELA ARQUIVOS_MORTOS
-- =====================
CREATE TABLE arquivos_mortos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    tabela_origem VARCHAR(100) NOT NULL,
    registro_origem_id BIGINT NOT NULL,
    motivo_exclusao TEXT NULL,
    dados JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_arquivos_mortos_usuarios FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
); 

-- =====================
-- TABELA DENUNCIAS
-- =====================
CREATE TABLE denuncias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario_id BIGINT UNSIGNED NOT NULL,
    arquivo_morto_id BIGINT UNSIGNED NOT NULL,
    administrador_id BIGINT UNSIGNED NULL,
    tipo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('aberta', 'em_analise', 'resolvida', 'arquivada') DEFAULT 'aberta',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_denuncias_usuarios FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_denuncias_administradores FOREIGN KEY (administrador_id)
        REFERENCES administradores(id)
        ON DELETE SET NULL,
    CONSTRAINT fk_denuncias_arquivos_mortos FOREIGN KEY (arquivo_morto_id)
        REFERENCES arquivos_mortos(id)
        ON DELETE CASCADE
);

-- =====================
-- TABELA PARTICIPACOES
-- =====================
CREATE TABLE participacoes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    evento_id BIGINT UNSIGNED NOT NULL,
    usuario_id BIGINT UNSIGNED NOT NULL,
    atividade_id BIGINT UNSIGNED NULL,
    status_intencao ENUM('salvo', 'confirmado', 'furou', 'cancelado', 'aberto') DEFAULT 'aberto',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_participacoes_evento FOREIGN KEY (evento_id) REFERENCES eventos(id) ON DELETE CASCADE,
    CONSTRAINT fk_participacoes_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_participacoes_atividade FOREIGN KEY (atividade_id) REFERENCES atividades(id) ON DELETE SET NULL,
    CONSTRAINT uq_participacao_usuario_evento UNIQUE (usuario_id, evento_id)
);



