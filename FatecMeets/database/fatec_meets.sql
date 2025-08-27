-- ==========================================
-- SCRIPT BANCO DE DADOS FATEC MEETS
-- ==========================================
 
-- =====================
-- TABELA USUARIOS
-- =====================
CREATE TABLE usuarios (
    id_usuario BIGINT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email_verification_token VARCHAR(10) NULL,
    imagem_usuario JSON NULL,
    status_conta ENUM('ativo','inativo','suspenso') DEFAULT 'ativo',
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
 
-- =====================
-- TABELA ADMINISTRADORES
-- =====================
CREATE TABLE administradores (
    id_administrador BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_alunos_usuarios FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
);
 
-- =====================
-- TABELA CONEXOES
-- =====================
CREATE TABLE conexoes (
    id_conexao BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario_origem BIGINT UNSIGNED NOT NULL,
    id_usuario_destino BIGINT UNSIGNED NOT NULL,
    status ENUM('pendente', 'aceito', 'recusado', 'bloqueado') DEFAULT 'pendente',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_conexao_usuario_origem FOREIGN KEY (id_usuario_origem)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE,
    CONSTRAINT fk_conexao_usuario_destino FOREIGN KEY (id_usuario_destino)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE,
    CONSTRAINT uq_conexao UNIQUE (id_usuario_origem, id_usuario_destino)
);
 
-- =====================
-- TABELA GAMEFICACOES
-- =====================
CREATE TABLE gameficacoes (
    id_gameficacao BIGINT AUTO_INCREMENT PRIMARY KEY,
    score_total INT DEFAULT 0,
    nickname VARCHAR(100) UNIQUE NULL,
    id_usuario BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_gameficacao_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
 
-- ==========================
-- Tabela: ALUNOS
-- ==========================
CREATE TABLE alunos (
    id_aluno BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_alunos_usuarios FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
);
 
-- ==========================
-- Tabela: ACADEMICOS
-- ==========================
CREATE TABLE academicos (
    id_academico BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    ra VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_academicos_usuarios FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
);
 
-- =====================
-- TABELA ATIVIDADES
-- =====================
CREATE TABLE atividades (
    id_atividade BIGINT AUTO_INCREMENT PRIMARY KEY,
    likes INT DEFAULT 0,
    tipo_atividade ENUM('postagem','comentario','evento','participacao') NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
);
 
-- =====================
-- TABELA COMENTARIOS
-- =====================
CREATE TABLE comentarios (
    id_comentario BIGINT AUTO_INCREMENT PRIMARY KEY,
    descricao_comentario TEXT NOT NULL,
    data_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario BIGINT NOT NULL,
    id_atividade BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_comentario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_comentario_atividade FOREIGN KEY (id_atividade) REFERENCES atividade(id_atividade)
);
 
-- =====================
-- TABELA TELEFONES
-- =====================
CREATE TABLE telefones (
    id_telefone BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero_telefone VARCHAR(15) NOT NULL,
    ddd VARCHAR(3) NOT NULL,
    tipo_telefone ENUM('celular','residencial','comercial') DEFAULT 'celular',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
 
-- =====================
-- TABELA ENDERECOS
-- =====================
CREATE TABLE enderecos (
    id_endereco BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(10) NULL,
    cep VARCHAR(10) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
 
-- =====================
-- TABELA COMPLEMENTOS
-- =====================
CREATE TABLE complementos (
    id_complemento BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_endereco BIGINT UNSIGNED NOT NULL,
    nome_complemento VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_complemento_endereco FOREIGN KEY (id_endereco)
        REFERENCES enderecos(id_endereco)
        ON DELETE CASCADE
);
 
-- =====================
-- TABELA LUGARES
-- =====================
CREATE TABLE lugares (
    id_lugar BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_endereco BIGINT UNSIGNED NOT NULL,
    nome_lugar VARCHAR(255) NOT NULL,
    id_administrador BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_lugares_endereco FOREIGN KEY (id_endereco)
        REFERENCES endereco(id_endereco)
        ON DELETE CASCADE,
    CONSTRAINT fk_lugares_administradores FOREIGN KEY (id_administrador)
        REFERENCES administradores(id_administrador)
        ON DELETE SET NULL
);
 
-- =====================
-- TABELA INSTITUICOES
-- =====================
CREATE TABLE instituicoes (
    id_instituicao BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_administrador BIGINT UNSIGNED NOT NULL,
    nome_instituicao VARCHAR(255) NOT NULL,
    codigo_institucional VARCHAR(50) UNIQUE NULL,
    id_telefone BIGINT UNSIGNED NOT NULL,
    id_endereco BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_instituicoes_administradores FOREIGN KEY (id_administrador)
        REFERENCES administradores(id_administrador)
        ON DELETE CASCADE
    CONSTRAINT fk_instituicoes_enderecos FOREIGN KEY (id_endereco)
        REFERENCES enderecos(id_endereco)
        ON DELETE CASCADE
    CONSTRAINT fk_instituicoes_telefones FOREIGN KEY (id_telefone)
        REFERENCES telefones(id_telefone)
        ON DELETE CASCADE
);
 
 
-- =====================
-- TABELA ADICIONAIS
-- =====================
CREATE TABLE adicionais (
    id_adicionais BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT NOT NULL,
    id_telefone BIGINT NULL,
    id_endereco BIGINT NULL,
    id_instituicao BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_adicional_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_adicional_telefone FOREIGN KEY (id_telefone) REFERENCES telefone(id_telefone),
    CONSTRAINT fk_adicional_endereco FOREIGN KEY (id_endereco) REFERENCES endereco(id_endereco),
    CONSTRAINT fk_adicional_instituicao FOREIGN KEY (id_instituicao) REFERENCES instituicao(id_instituicao)
);
 
-- =====================
-- TABELA REDES
-- =====================
CREATE TABLE redes (
    id_redes BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_adicionais BIGINT NOT NULL,
    tipo_rede ENUM('instagram','linkedin','github','twitter','facebook','outro') NOT NULL,
    url_redes VARCHAR(500) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_redes_adicional FOREIGN KEY (id_adicionais) REFERENCES adicionais(id_adicionais)
);
 
-- =====================
-- TABELA POSTAGENS
-- =====================
CREATE TABLE postagens (
    id_postagem BIGINT AUTO_INCREMENT PRIMARY KEY,
    titulo_postagem VARCHAR(255) NOT NULL,
    descricao_postagem TEXT NOT NULL,
    imagem_postagem JSON NULL,
    data_postagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario BIGINT NOT NULL,
    id_atividade BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_postagem_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_postagem_atividade FOREIGN KEY (id_atividade) REFERENCES atividade(id_atividade)
);
 
-- =====================
-- TABELA EVENTOS
-- =====================
CREATE TABLE eventos (
    id_evento BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome_evento VARCHAR(255) NOT NULL,
    imagem_evento JSON NULL,
    descricao_evento TEXT NOT NULL,
    data_inicio_evento DATE NOT NULL,
    data_final_evento DATE NOT NULL,
    id_complemento BIGINT NOT NULL,
    id_usuario BIGINT NOT NULL,
    id_atividade BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_evento_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_evento_atividade FOREIGN KEY (id_atividade) REFERENCES atividade(id_atividade)
);
 
-- =====================
-- TABELA CHATS
-- =====================
CREATE TABLE chats (
    id_chat BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome_chat VARCHAR(255) NOT NULL,
    tipo_chat ENUM('privado','grupo') DEFAULT 'privado',
    id_usuario BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_chat_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
 
-- =====================
-- TABELA MEMBROS
-- =====================
CREATE TABLE membros (
    id_membro BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_chat BIGINT NOT NULL,
    id_usuario BIGINT NOT NULL,
    role ENUM('membro','admin') DEFAULT 'membro',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_membros_chat FOREIGN KEY (id_chat) REFERENCES chat(id_chat),
    CONSTRAINT fk_membros_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
 
-- =====================
-- TABELA MENSAGENS
-- =====================
CREATE TABLE mensagens (
    id_mensagem BIGINT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL,
    id_chat BIGINT NOT NULL,
    id_usuario BIGINT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_mensagem_chat FOREIGN KEY (id_chat) REFERENCES chat(id_chat),
    CONSTRAINT fk_mensagem_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
 
-- =====================
-- TABELA DENUNCIAS
-- =====================
CREATE TABLE denuncias (
    id_denuncia BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    id_arquivo_morto BIGINT UNSIGNED NOT NULL,
    id_administrador BIGINT UNSIGNED NULL,
    tipo_denuncia VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('aberta', 'em_analise', 'resolvida', 'arquivada') DEFAULT 'aberta',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_denuncia_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE,
    CONSTRAINT fk_denuncia_administrador FOREIGN KEY (id_administrador)
        REFERENCES administradores(id_administrador)
        ON DELETE SET NULL,
    CONSTRAINT fk_denuncia_arquivo_morto FOREIGN KEY (id_arquivo_morto)
        REFERENCES arquivo_morto(id_arquivo_morto)
        ON DELETE CASCADE
);
 
-- =====================
-- TABELA ARQUIVOS_MORTOS
-- =====================
CREATE TABLE arquivos_mortos (
    id_arquivo_morto BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario BIGINT UNSIGNED NOT NULL,
    tabela_origem VARCHAR(100) NOT NULL,
    id_registro_origem BIGINT NOT NULL,
    motivo_exclusao TEXT NULL,
    dados_tabela JSON NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_arquivo_morto_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE CASCADE
);