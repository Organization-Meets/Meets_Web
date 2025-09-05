-- Tabelas principais

CREATE TABLE Usuario (

    id_usuario INT PRIMARY KEY AUTO_INCREMENT,

    senha VARCHAR(255),

    email VARCHAR(255) UNIQUE,

    imagem_usuario VARCHAR(255),

    status_conta TINYINT

);
 
CREATE TABLE Aluno (

    id_aluno INT PRIMARY KEY AUTO_INCREMENT,

    id_usuario INT,

    nome_aluno VARCHAR(255),

    ra_aluno VARCHAR(20),

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Evento (

    id_evento INT PRIMARY KEY AUTO_INCREMENT,

    nome_evento VARCHAR(255),

    descricao TEXT,

    data_inicio_evento DATETIME,

    data_final_evento DATETIME,

    imagem_evento VARCHAR(255),

    categoria_evento VARCHAR(100),

    id_usuario INT,

    id_atividade INT,

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Instituicao (

    id_instituicao INT PRIMARY KEY AUTO_INCREMENT,

    nome_instituicao VARCHAR(255),

    codigo_institucional VARCHAR(50)

);
 
CREATE TABLE Endereco (

    id_endereco INT PRIMARY KEY AUTO_INCREMENT,

    numero VARCHAR(10),

    cep VARCHAR(10)

);
 
CREATE TABLE Academicos (

    id_academicos INT PRIMARY KEY AUTO_INCREMENT,

    nome_academicos VARCHAR(255),

    ra_academicos VARCHAR(20)

);
 
CREATE TABLE Telefone (

    id_telefone INT PRIMARY KEY AUTO_INCREMENT,

    numero_telefone VARCHAR(20),

    ddd VARCHAR(5),

    tipo_telefone VARCHAR(20)

);
 
CREATE TABLE Comentarios (

    id_comentario INT PRIMARY KEY AUTO_INCREMENT,

    data_comentario DATETIME,

    descricao_comentario TEXT,

    id_usuario INT,

    id_atividade INT,

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Postagens (

    id_postagem INT PRIMARY KEY AUTO_INCREMENT,

    descricao_postagem TEXT,

    data_postagem DATETIME,

    titulo_postagem VARCHAR(255),

    id_usuario INT,

    imagem_postagem VARCHAR(255),

    id_atividade INT,

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Intencao (

    id_intencao INT PRIMARY KEY AUTO_INCREMENT,

    id_evento INT,

    status_intencao TINYINT,

    id_usuario INT,

    FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Agenda (

    id_agenda INT PRIMARY KEY AUTO_INCREMENT,

    data DATETIME,

    descricao TEXT,

    id_usuario INT,

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Gameficacao (

    id_gameficacao INT PRIMARY KEY AUTO_INCREMENT,

    score_total INT,

    nickname VARCHAR(50),

    id_usuario INT,

    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario)

);
 
CREATE TABLE Atividade (

    id_atividade INT PRIMARY KEY AUTO_INCREMENT,

    likes INT,

    score INT,

    tipo_atividade VARCHAR(50),

    id_gameficacao INT,

    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao)

);
 
CREATE TABLE Adicionais (

    id_adicionais INT PRIMARY KEY AUTO_INCREMENT,

    id_usuario INT,

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

    id_adicionais INT,

    url_redes VARCHAR(255),

    FOREIGN KEY (id_adicionais) REFERENCES Adicionais(id_adicionais)

);
 
CREATE TABLE Chat (

    id_chat INT PRIMARY KEY AUTO_INCREMENT,

    id_gameficacao INT,

    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao)

);
 
CREATE TABLE Membros (

    id_membros INT PRIMARY KEY AUTO_INCREMENT,

    id_chat INT,

    id_gameficacao INT,

    status_membro TINYINT,

    FOREIGN KEY (id_chat) REFERENCES Chat(id_chat),

    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao)

);
 
CREATE TABLE Conexao (

    id_conexao INT PRIMARY KEY AUTO_INCREMENT,

    id_gameficacao INT,

    id_gameficacao_conexao INT,

    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao)

);
 
CREATE TABLE Mensagens (

    id_mensagens INT PRIMARY KEY AUTO_INCREMENT,

    id_gameficacao INT,

    descricao_mensagens TEXT,

    id_chat INT,

    FOREIGN KEY (id_gameficacao) REFERENCES Gameficacao(id_gameficacao),

    FOREIGN KEY (id_chat) REFERENCES Chat(id_chat)

);
 