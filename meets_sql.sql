-- =========================================================
-- INTEGRANTES
-- =========================================================
-- Nicolas Felipe de Carvalho
-- Gabriel da Silva Rodrigues
-- Felipe Aires Joaquim
-- Felipe da Costa Catarino
-- Matheus Albuquerque Marinho
-- =========================================================
-- ESQUEMA: TABELAS, RELACIONAMENTOS, VIEWS, PROCEDURES, ÍNDICES
-- Arquivo consolidado: esquema + exemplos para Entrega 6 (INSERT ... SELECT / SUBSELECT)
-- =========================================================

-- =========================================================
-- TABELAS DE ENTIDADE
-- =========================================================

CREATE TABLE IF NOT EXISTS usuario (
    id_user        BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario   VARCHAR(120) NOT NULL,
    email          VARCHAR(255) NOT NULL UNIQUE,
    senha          VARCHAR(255) NOT NULL,
    user_status    VARCHAR(40),
    user_img       TEXT,
    score          INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS aluno (
    id_user  BIGINT PRIMARY KEY,
    ra       VARCHAR(50) NOT NULL UNIQUE,
    CONSTRAINT fk_aluno_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS corpo_docente (
    id_user   BIGINT PRIMARY KEY,
    rf        VARCHAR(50) NOT NULL UNIQUE,
    CONSTRAINT fk_docente_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS instituicao (
    id_inst    BIGINT AUTO_INCREMENT PRIMARY KEY,
    cod_inst   VARCHAR(50) NOT NULL UNIQUE,
    nome_inst  VARCHAR(160) NOT NULL
);

CREATE TABLE IF NOT EXISTS telefone_inst (
    id_tel_inst  BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_inst      BIGINT NOT NULL,
    tel_inst     VARCHAR(30) NOT NULL,
    CONSTRAINT fk_tel_inst_instituicao FOREIGN KEY (id_inst) REFERENCES instituicao(id_inst) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS endereco_inst (
    id_end_inst   BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_inst       BIGINT NOT NULL,
    cep_inst      VARCHAR(20) NOT NULL,
    endereco_inst VARCHAR(255) NOT NULL,
    num_inst      VARCHAR(20),
    comp_inst     VARCHAR(120),
    CONSTRAINT fk_end_inst_instituicao FOREIGN KEY (id_inst) REFERENCES instituicao(id_inst) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS telefone (
    id_tel    BIGINT AUTO_INCREMENT PRIMARY KEY,
    ddd       VARCHAR(5),
    tipo_tel  VARCHAR(30),
    num_tel   VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS endereco (
    id_end  BIGINT AUTO_INCREMENT PRIMARY KEY,
    cep     VARCHAR(20) NOT NULL,
    num     VARCHAR(20),
    comp    VARCHAR(120)
);

CREATE TABLE IF NOT EXISTS dados_adc (
    id_adc   BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user  BIGINT NOT NULL,
    id_tel   BIGINT NOT NULL,
    id_end   BIGINT NOT NULL,
    UNIQUE (id_user, id_tel, id_end),
    CONSTRAINT fk_dados_adc_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_dados_adc_telefone FOREIGN KEY (id_tel) REFERENCES telefone(id_tel) ON DELETE RESTRICT,
    CONSTRAINT fk_dados_adc_endereco FOREIGN KEY (id_end) REFERENCES endereco(id_end) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS postagem (
    id_post       BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user       BIGINT NOT NULL,
    img_post      TEXT,
    data_post     DATE,
    hora_post     TIME,
    conteudo      TEXT,
    num_curtidas  INT DEFAULT 0,
    titulo_post   VARCHAR(200),
    CONSTRAINT fk_postagem_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS comentario (
    id_comentario BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user       BIGINT NOT NULL,
    id_post       BIGINT NOT NULL,
    conteudo      TEXT NOT NULL,
    data          DATE,
    hora          TIME,
    CONSTRAINT fk_comentario_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_comentario_postagem FOREIGN KEY (id_post) REFERENCES postagem(id_post) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS denuncia (
    id_denun      BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_post       BIGINT NOT NULL,
    id_docente    BIGINT,
    status_denun  VARCHAR(40),
    num_denun     INT,
    CONSTRAINT fk_denuncia_postagem FOREIGN KEY (id_post) REFERENCES postagem(id_post) ON DELETE CASCADE,
    CONSTRAINT fk_denuncia_docente FOREIGN KEY (id_docente) REFERENCES corpo_docente(id_user) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS arquivo_morto (
    id_aq_morto   BIGINT AUTO_INCREMENT PRIMARY KEY,
    data_exclusao DATE,
    id_docente    BIGINT,
    id_post       BIGINT,
    img_post      TEXT,
    titulo_post   VARCHAR(200),
    desc_post     TEXT,
    CONSTRAINT fk_arquivo_docente FOREIGN KEY (id_docente) REFERENCES corpo_docente(id_user) ON DELETE SET NULL,
    CONSTRAINT fk_arquivo_postagem FOREIGN KEY (id_post) REFERENCES postagem(id_post) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS backlog (
    id_backlog  BIGINT AUTO_INCREMENT PRIMARY KEY,
    tipo_acao   VARCHAR(80) NOT NULL,
    data        DATE,
    hora        TIME
);

CREATE TABLE IF NOT EXISTS evento (
    id_event    BIGINT AUTO_INCREMENT PRIMARY KEY,
    data_event  DATE,
    hora_event  TIME,
    end_event   VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS presentes (
    id_presentes BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_event     BIGINT NOT NULL,
    id_user      BIGINT NOT NULL,
    UNIQUE (id_event, id_user),
    CONSTRAINT fk_presentes_evento FOREIGN KEY (id_event) REFERENCES evento(id_event) ON DELETE CASCADE,
    CONSTRAINT fk_presentes_usuario FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE
);

-- =========================================================
-- TABELAS DE RELACIONAMENTO (diamantes do DER)
-- =========================================================

CREATE TABLE IF NOT EXISTS registra_usuario_backlog (
    id_user     BIGINT NOT NULL,
    id_backlog  BIGINT NOT NULL,
    PRIMARY KEY (id_user, id_backlog),
    CONSTRAINT fk_registra_user FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_registra_backlog FOREIGN KEY (id_backlog) REFERENCES backlog(id_backlog) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS analiza_docente_denuncia (
    id_docente  BIGINT NOT NULL,
    id_denun    BIGINT NOT NULL,
    PRIMARY KEY (id_docente, id_denun),
    CONSTRAINT fk_analiza_docente FOREIGN KEY (id_docente) REFERENCES corpo_docente(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_analiza_denuncia FOREIGN KEY (id_denun) REFERENCES denuncia(id_denun) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS posta_usuario_postagem (
    id_user  BIGINT NOT NULL,
    id_post  BIGINT NOT NULL,
    PRIMARY KEY (id_user, id_post),
    CONSTRAINT fk_posta_user FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_posta_post FOREIGN KEY (id_post) REFERENCES postagem(id_post) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS participado_usuario_evento (
    id_user   BIGINT NOT NULL,
    id_event  BIGINT NOT NULL,
    PRIMARY KEY (id_user, id_event),
    CONSTRAINT fk_participado_user FOREIGN KEY (id_user) REFERENCES usuario(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_participado_event FOREIGN KEY (id_event) REFERENCES evento(id_event) ON DELETE CASCADE
);

-- =========================================================
-- ÍNDICES DE APOIO
-- =========================================================

CREATE INDEX IF NOT EXISTS idx_usuario_email ON usuario(email);
CREATE INDEX IF NOT EXISTS idx_postagem_user ON postagem(id_user);
CREATE INDEX IF NOT EXISTS idx_comentario_post ON comentario(id_post);
CREATE INDEX IF NOT EXISTS idx_comentario_user ON comentario(id_user);
CREATE INDEX IF NOT EXISTS idx_denuncia_post ON denuncia(id_post);
CREATE INDEX IF NOT EXISTS idx_denuncia_docente ON denuncia(id_docente);
CREATE INDEX IF NOT EXISTS idx_dados_adc_user ON dados_adc(id_user);
CREATE INDEX IF NOT EXISTS idx_presentes_event ON presentes(id_event);
CREATE INDEX IF NOT EXISTS idx_presentes_user ON presentes(id_user);
CREATE INDEX IF NOT EXISTS idx_registra_user ON registra_usuario_backlog(id_user);
CREATE INDEX IF NOT EXISTS idx_registra_backlog ON registra_usuario_backlog(id_backlog);
CREATE INDEX IF NOT EXISTS idx_analiza_docente ON analiza_docente_denuncia(id_docente);
CREATE INDEX IF NOT EXISTS idx_analiza_denun ON analiza_docente_denuncia(id_denun);
CREATE INDEX IF NOT EXISTS idx_posta_user ON posta_usuario_postagem(id_user);
CREATE INDEX IF NOT EXISTS idx_posta_post ON posta_usuario_postagem(id_post);
CREATE INDEX IF NOT EXISTS idx_participado_user ON participado_usuario_evento(id_user);
CREATE INDEX IF NOT EXISTS idx_participado_event ON participado_usuario_evento(id_event);

-- =========================================================
-- CONSULTAS COM JUNÇÕES (EXEMPLOS)
-- =========================================================

-- 1) Posts com autor e contagem de comentários
-- ... (exemplo de SELECT para consulta) ...
SELECT
    p.id_post,
    u.nome_usuario AS autor,
    p.titulo_post,
    p.data_post,
    COUNT(c.id_comentario) AS total_comentarios
FROM postagem p
JOIN usuario u
    ON u.id_user = p.id_user
LEFT JOIN comentario c
    ON c.id_post = p.id_post
GROUP BY
    p.id_post, u.nome_usuario, p.titulo_post, p.data_post
ORDER BY p.data_post DESC, p.id_post DESC;

-- 2) Denúncias com detalhes do post e do(s) docente(s) analisando
-- (versões de uso direto e M:N)
SELECT
    d.id_denun,
    d.status_denun,
    d.num_denun,
    p.id_post,
    p.titulo_post,
    u_autor.nome_usuario AS autor_post,
    d.id_docente,
    u_docente.nome_usuario AS nome_docente
FROM denuncia d
JOIN postagem p
    ON p.id_post = d.id_post
JOIN usuario u_autor
    ON u_autor.id_user = p.id_user
LEFT JOIN corpo_docente cd
    ON cd.id_user = d.id_docente
LEFT JOIN usuario u_docente
    ON u_docente.id_user = cd.id_user
ORDER BY d.id_denun DESC;

-- 3) Dados de contato do usuário (telefone e endereço) via dados_adc
SELECT
    u.id_user,
    u.nome_usuario,
    t.ddd,
    t.num_tel,
    t.tipo_tel,
    e.cep,
    e.num,
    e.comp
FROM usuario u
JOIN dados_adc da
    ON da.id_user = u.id_user
JOIN telefone t
    ON t.id_tel = da.id_tel
JOIN endereco e
    ON e.id_end = da.id_end
ORDER BY u.id_user;

-- 4) Postagens com autor e comentarista (comentários detalhados)
SELECT
    c.id_comentario,
    c.conteudo      AS comentario,
    c.data          AS data_comentario,
    c.hora          AS hora_comentario,
    p.id_post,
    p.titulo_post,
    u_autor.nome_usuario      AS autor_post,
    u_coment.nome_usuario     AS autor_comentario
FROM comentario c
JOIN postagem p
    ON p.id_post = c.id_post
JOIN usuario u_autor
    ON u_autor.id_user = p.id_user
JOIN usuario u_coment
    ON u_coment.id_user = c.id_user
ORDER BY c.id_comentario DESC;

-- 5) Instituições com seus telefones e endereços
SELECT
    i.id_inst,
    i.cod_inst,
    i.nome_inst,
    ti.tel_inst,
    ei.cep_inst,
    ei.endereco_inst,
    ei.num_inst,
    ei.comp_inst
FROM instituicao i
LEFT JOIN telefone_inst ti
    ON ti.id_inst = i.id_inst
LEFT JOIN endereco_inst ei
    ON ei.id_inst = i.id_inst
ORDER BY i.id_inst, ti.id_tel_inst, ei.id_end_inst;

-- 6) Eventos com participantes (via presentes)
SELECT
    e.id_event,
    e.data_event,
    e.hora_event,
    e.end_event,
    u.id_user AS participante,
    u.nome_usuario
FROM evento e
LEFT JOIN presentes pr
    ON pr.id_event = e.id_event
LEFT JOIN usuario u
    ON u.id_user = pr.id_user
ORDER BY e.id_event, u.nome_usuario;


-- ======================
-- CRIAÇÃO DE VIEWS
-- ======================

DROP VIEW IF EXISTS vw_usuario_contatos;
CREATE VIEW vw_usuario_contatos AS
SELECT
    u.id_user,
    u.nome_usuario,
    u.email,
    t.ddd,
    t.num_tel,
    t.tipo_tel,
    e.cep,
    e.num,
    e.comp
FROM usuario u
JOIN dados_adc da
    ON da.id_user = u.id_user
JOIN telefone t
    ON t.id_tel = da.id_tel
JOIN endereco e
    ON e.id_end = da.id_end;

DROP VIEW IF EXISTS vw_post_com_stats;
CREATE VIEW vw_post_com_stats AS
SELECT
    p.id_post,
    p.titulo_post,
    p.data_post,
    p.hora_post,
    p.num_curtidas,
    u.id_user    AS autor_id,
    u.nome_usuario AS autor_nome,
    COUNT(c.id_comentario) AS total_comentarios
FROM postagem p
JOIN usuario u
    ON u.id_user = p.id_user
LEFT JOIN comentario c
    ON c.id_post = p.id_post
GROUP BY
    p.id_post, p.titulo_post, p.data_post, p.hora_post, p.num_curtidas, u.id_user, u.nome_usuario;

DROP VIEW IF EXISTS vw_denuncia_detalhe;
CREATE VIEW vw_denuncia_detalhe AS
SELECT
    d.id_denun,
    d.status_denun,
    d.num_denun,
    p.id_post,
    p.titulo_post,
    u_autor.id_user AS autor_post_id,
    u_autor.nome_usuario AS autor_post_nome,
    d.id_docente,
    u_docente.nome_usuario AS nome_docente
FROM denuncia d
JOIN postagem p
    ON p.id_post = d.id_post
JOIN usuario u_autor
    ON u_autor.id_user = p.id_user
LEFT JOIN usuario u_docente
    ON u_docente.id_user = d.id_docente;

DROP VIEW IF EXISTS vw_denuncia_analistas;
CREATE VIEW vw_denuncia_analistas AS
SELECT
    d.id_denun,
    d.status_denun,
    d.num_denun,
    ad.id_docente,
    u_docente.nome_usuario AS nome_docente
FROM denuncia d
JOIN analiza_docente_denuncia ad
    ON ad.id_denun = d.id_denun
JOIN usuario u_docente
    ON u_docente.id_user = ad.id_docente;

DROP VIEW IF EXISTS vw_evento_participantes;
CREATE VIEW vw_evento_participantes AS
SELECT
    e.id_event,
    e.data_event,
    e.hora_event,
    e.end_event,
    u.id_user AS participante_id,
    u.nome_usuario AS participante_nome
FROM evento e
JOIN presentes pr
    ON pr.id_event = e.id_event
JOIN usuario u
    ON u.id_user = pr.id_user;

DROP VIEW IF EXISTS vw_evento_participantes_total;
CREATE VIEW vw_evento_participantes_total AS
SELECT
    e.id_event,
    e.data_event,
    e.hora_event,
    e.end_event,
    COUNT(pr.id_user) AS total_participantes
FROM evento e
LEFT JOIN presentes pr
    ON pr.id_event = e.id_event
GROUP BY e.id_event, e.data_event, e.hora_event, e.end_event;

DROP VIEW IF EXISTS vw_backlog_por_usuario;
CREATE VIEW vw_backlog_por_usuario AS
SELECT
    u.id_user,
    u.nome_usuario,
    b.id_backlog,
    b.tipo_acao,
    b.data,
    b.hora
FROM usuario u
JOIN registra_usuario_backlog r
    ON r.id_user = u.id_user
JOIN backlog b
    ON b.id_backlog = r.id_backlog;

DROP VIEW IF EXISTS vw_feed_postagens;
CREATE VIEW vw_feed_postagens AS
SELECT
    p.id_post,
    p.titulo_post,
    p.conteudo,
    p.img_post,
    p.data_post,
    p.hora_post,
    p.num_curtidas,
    u.id_user    AS autor_id,
    u.nome_usuario AS autor_nome
FROM postagem p
JOIN usuario u
    ON u.id_user = p.id_user
ORDER BY p.data_post DESC, p.hora_post DESC, p.id_post DESC;


-- =========================================================
-- PROCEDURES / TRANSATIONS (MySQL 8+)
-- =========================================================

-- 1) Arquivar uma postagem (sp_arquivar_postagem)
DROP PROCEDURE IF EXISTS sp_arquivar_postagem;
DELIMITER $$
CREATE PROCEDURE sp_arquivar_postagem(IN p_id_post BIGINT, IN p_id_docente BIGINT)
BEGIN
    DECLARE v_titulo VARCHAR(200);
    DECLARE v_img TEXT;
    DECLARE v_desc TEXT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro ao arquivar a postagem. Transação revertida.';
    END;

    START TRANSACTION;

    SELECT titulo_post, img_post, conteudo
        INTO v_titulo, v_img, v_desc
    FROM postagem
    WHERE id_post = p_id_post
    FOR UPDATE;

    INSERT INTO arquivo_morto (data_exclusao, id_docente, id_post, img_post, titulo_post, desc_post)
    VALUES (CURRENT_DATE(), p_id_docente, p_id_post, v_img, v_titulo, v_desc);

    DELETE FROM postagem WHERE id_post = p_id_post;

    COMMIT;
END$$
DELIMITER ;

-- 2) Criar postagem e relacionar ao autor (sp_criar_postagem)
DROP PROCEDURE IF EXISTS sp_criar_postagem;
DELIMITER $$
CREATE PROCEDURE sp_criar_postagem(
    IN p_id_user BIGINT,
    IN p_titulo  VARCHAR(200),
    IN p_conteudo TEXT,
    IN p_img     TEXT
)
BEGIN
    DECLARE v_id_post BIGINT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro ao criar a postagem. Transação revertida.';
    END;

    START TRANSACTION;

    INSERT INTO postagem (id_user, titulo_post, conteudo, img_post, data_post, hora_post, num_curtidas)
    VALUES (p_id_user, p_titulo, p_conteudo, p_img, CURRENT_DATE(), CURRENT_TIME(), 0);

    SET v_id_post = LAST_INSERT_ID();

    INSERT INTO posta_usuario_postagem (id_user, id_post)
    VALUES (p_id_user, v_id_post);

    COMMIT;

    SELECT v_id_post AS novo_id_post;
END$$
DELIMITER ;

-- 3) Atualizar status de denúncia e registrar docente analista (sp_atualizar_status_denuncia)
DROP PROCEDURE IF EXISTS sp_atualizar_status_denuncia;
DELIMITER $$
CREATE PROCEDURE sp_atualizar_status_denuncia(
    IN p_id_denun BIGINT,
    IN p_novo_status VARCHAR(40),
    IN p_id_docente BIGINT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro ao atualizar denúncia. Transação revertida.';
    END;

    START TRANSACTION;

    UPDATE denuncia
        SET status_denun = p_novo_status
    WHERE id_denun = p_id_denun;

    INSERT INTO analiza_docente_denuncia (id_docente, id_denun)
    VALUES (p_id_docente, p_id_denun);

    COMMIT;
END$$
DELIMITER ;

-- 4) Inscrição em evento (sp_inscrever_evento)
DROP PROCEDURE IF EXISTS sp_inscrever_evento;
DELIMITER $$
CREATE PROCEDURE sp_inscrever_evento(
    IN p_id_event BIGINT,
    IN p_id_user  BIGINT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro na inscrição no evento. Transação revertida.';
    END;

    START TRANSACTION;

    INSERT INTO presentes (id_event, id_user)
    VALUES (p_id_event, p_id_user);

    COMMIT;
END$$
DELIMITER ;

-- =========================================================
-- ÍNDICES ADICIONAIS / OTIMIZAÇÕES (DROP IF EXISTS para segurança)
-- =========================================================

-- (Criação/ recriação de índices com nomes já usados durante desenvolvimento)
DROP INDEX IF EXISTS idx_postagem_user ON postagem;
CREATE INDEX IF NOT EXISTS idx_postagem_user ON postagem(id_user);

DROP INDEX IF EXISTS idx_postagem_user_data ON postagem;
CREATE INDEX IF NOT EXISTS idx_postagem_user_data ON postagem(id_user, data_post, id_post);

DROP INDEX IF EXISTS idx_comentario_post ON comentario;
CREATE INDEX IF NOT EXISTS idx_comentario_post ON comentario(id_post);

DROP INDEX IF EXISTS idx_comentario_post_data ON comentario;
CREATE INDEX IF NOT EXISTS idx_comentario_post_data ON comentario(id_post, data, id_comentario);

DROP INDEX IF EXISTS idx_denuncia_post ON denuncia;
CREATE INDEX IF NOT EXISTS idx_denuncia_post ON denuncia(id_post);

DROP INDEX IF EXISTS idx_denuncia_status_post ON denuncia;
CREATE INDEX IF NOT EXISTS idx_denuncia_status_post ON denuncia(status_denun, id_post);

DROP INDEX IF NOT EXISTS idx_dados_adc_user ON dados_adc;
CREATE INDEX IF NOT EXISTS idx_dados_adc_user ON dados_adc(id_user);

DROP INDEX IF EXISTS idx_telefone_num ON telefone;
CREATE INDEX IF NOT EXISTS idx_telefone_num ON telefone(num_tel);

DROP INDEX IF EXISTS idx_presentes_user ON presentes;
CREATE INDEX IF NOT EXISTS idx_presentes_user ON presentes(id_user);

DROP INDEX IF EXISTS idx_registra_user ON registra_usuario_backlog;
CREATE INDEX IF NOT EXISTS idx_registra_user ON registra_usuario_backlog(id_user);

DROP INDEX IF EXISTS idx_registra_backlog ON registra_usuario_backlog;
CREATE INDEX IF NOT EXISTS idx_registra_backlog ON registra_usuario_backlog(id_backlog);

DROP INDEX IF EXISTS idx_analiza_docente ON analiza_docente_denuncia;
CREATE INDEX IF NOT EXISTS idx_analiza_docente ON analiza_docente_denuncia(id_docente);

DROP INDEX IF EXISTS idx_analiza_denun ON analiza_docente_denuncia;
CREATE INDEX IF NOT EXISTS idx_analiza_denun ON analiza_docente_denuncia(id_denun);

DROP INDEX IF EXISTS idx_posta_user ON posta_usuario_postagem;
CREATE INDEX IF NOT EXISTS idx_posta_user ON posta_usuario_postagem(id_user);

DROP INDEX IF EXISTS idx_posta_post ON posta_usuario_postagem;
CREATE INDEX IF NOT EXISTS idx_posta_post ON posta_usuario_postagem(id_post);

DROP INDEX IF EXISTS idx_participado_user ON participado_usuario_evento;
CREATE INDEX IF NOT EXISTS idx_participado_user ON participado_usuario_evento(id_user);

DROP INDEX IF EXISTS idx_participado_event ON participado_usuario_evento;
CREATE INDEX IF NOT EXISTS idx_participado_event ON participado_usuario_evento(id_event);

DROP INDEX IF EXISTS idx_tel_inst_inst ON telefone_inst;
CREATE INDEX IF NOT EXISTS idx_tel_inst_inst ON telefone_inst(id_inst);

DROP INDEX IF EXISTS idx_end_inst_inst ON endereco_inst;
CREATE INDEX IF NOT EXISTS idx_end_inst_inst ON endereco_inst(id_inst, cep_inst);

-- =========================================================
-- EXPLAIN / TESTES DE UTILIDADE (exemplos)
-- =========================================================

EXPLAIN
SELECT id_post, titulo_post, data_post
FROM postagem
WHERE id_user = 10
    AND data_post BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()
ORDER BY data_post DESC, id_post DESC
LIMIT 50;

EXPLAIN
SELECT id_comentario, conteudo, data
FROM comentario
WHERE id_post = 123
    AND data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
ORDER BY data DESC, id_comentario DESC;

EXPLAIN
SELECT id_denun, status_denun, id_post
FROM denuncia
WHERE status_denun = 'analise'
    AND id_post = 123
ORDER BY id_denun DESC;

EXPLAIN
SELECT da.id_adc, t.num_tel, e.cep
FROM dados_adc da
JOIN telefone t ON t.id_tel = da.id_tel
JOIN endereco e ON e.id_end = da.id_end
WHERE da.id_user = 10;

EXPLAIN
SELECT pr.id_event, e.data_event, e.end_event
FROM presentes pr
JOIN evento e ON e.id_event = pr.id_event
WHERE pr.id_user = 10
ORDER BY e.data_event DESC;

EXPLAIN
SELECT b.id_backlog, b.tipo_acao, b.data
FROM registra_usuario_backlog r
JOIN backlog b ON b.id_backlog = r.id_backlog
WHERE r.id_user = 10
ORDER BY b.data DESC;

EXPLAIN
SELECT ad.id_docente
FROM analiza_docente_denuncia ad
WHERE ad.id_denun = 321;

EXPLAIN
SELECT tel_inst
FROM telefone_inst
WHERE id_inst = 5;

EXPLAIN
SELECT endereco_inst, cep_inst
FROM endereco_inst
WHERE id_inst = 5;

-- =========================================================
-- ENTREGA 6 - Exemplos de INSERT ... SELECT e Subselects
-- Objetivo: transferências, cópias, prevenção de duplicatas, subqueries condicionais
-- =========================================================

-- 1) Arquivar (migrar) postagens antigas para arquivo_morto usando INSERT ... SELECT + DELETE (transação)
START TRANSACTION;

INSERT INTO arquivo_morto (data_exclusao, id_docente, id_post, img_post, titulo_post, desc_post)
SELECT
    CURRENT_DATE() AS data_exclusao,
    NULL AS id_docente,
    p.id_post,
    p.img_post,
    p.titulo_post,
    p.conteudo
FROM postagem p
WHERE p.data_post < DATE_SUB(CURDATE(), INTERVAL 365 DAY);

DELETE p
FROM postagem p
WHERE p.data_post < DATE_SUB(CURDATE(), INTERVAL 365 DAY);

COMMIT;

-- 2) Inserir relações M:N (posta_usuario_postagem) para posts que ainda não têm o vínculo (evita duplicatas com NOT EXISTS)
INSERT INTO posta_usuario_postagem (id_user, id_post)
SELECT p.id_user, p.id_post
FROM postagem p
WHERE NOT EXISTS (
    SELECT 1 FROM posta_usuario_postagem pp
    WHERE pp.id_post = p.id_post
      AND pp.id_user = p.id_user
);

-- 3) Popular tabela presentes a partir de uma lista de alunos (ex.: inscrever todos os alunos no evento 10)
INSERT INTO presentes (id_event, id_user)
SELECT DISTINCT 10 AS id_event, a.id_user
FROM aluno a
WHERE NOT EXISTS (
    SELECT 1 FROM presentes pr
    WHERE pr.id_event = 10
      AND pr.id_user = a.id_user
);

-- 4) Gerar backlog automático para usuários inativos (subselect conta posts)
START TRANSACTION;

INSERT INTO backlog (tipo_acao, data, hora)
VALUES ('verificar_inatividade', CURRENT_DATE(), CURRENT_TIME());

SET @id_backlog := LAST_INSERT_ID();

INSERT INTO registra_usuario_backlog (id_user, id_backlog)
SELECT u.id_user, @id_backlog
FROM usuario u
LEFT JOIN postagem p ON p.id_user = u.id_user
    AND p.data_post >= DATE_SUB(CURDATE(), INTERVAL 90 DAY)
WHERE p.id_post IS NULL;

COMMIT;

-- 5) Inserir telefones institucionais a partir de uma tabela temporária (ex.: temp_tel_inst)
-- Suponha que exista tabela temp_tel_inst(id_inst, tel_inst)
INSERT INTO telefone_inst (id_inst, tel_inst)
SELECT t.id_inst, t.tel_inst
FROM temp_tel_inst t
WHERE NOT EXISTS (
    SELECT 1 FROM telefone_inst ti
    WHERE ti.id_inst = t.id_inst
      AND ti.tel_inst = t.tel_inst
);

-- 6) Atualizar pontuação (score) de usuários baseada no número de posts, curtidas e comentários
UPDATE usuario u
JOIN (
    SELECT
        p.id_user,
        COUNT(p.id_post) AS num_posts,
        SUM(IFNULL(p.num_curtidas, 0)) AS total_curtidas,
        COALESCE(SUM(c.qtd_com), 0) AS total_comentarios
    FROM postagem p
    LEFT JOIN (
        SELECT id_post, COUNT(*) AS qtd_com
        FROM comentario
        GROUP BY id_post
    ) c ON c.id_post = p.id_post
    GROUP BY p.id_user
) s ON s.id_user = u.id_user
SET u.score = 10 * s.num_posts + 1 * s.total_curtidas + 2 * s.total_comentarios;

-- 7) Inserir denúncias derivadas de um SELECT (ex.: títulos contendo 'spam')
INSERT INTO denuncia (id_post, id_docente, status_denun, num_denun)
SELECT p.id_post, NULL, 'aberta', 1
FROM postagem p
WHERE LOWER(p.titulo_post) LIKE '%spam%'
  AND NOT EXISTS (
      SELECT 1 FROM denuncia d WHERE d.id_post = p.id_post
  );

-- 8) Inserir contatos (dados_adc) relacionando usuários a telefones e endereços existentes
-- Observação: adaptar se telefone/endereco não possuem id_user direto — este é um template
INSERT INTO dados_adc (id_user, id_tel, id_end)
SELECT u.id_user, t_max.max_id_tel, e_max.max_id_end
FROM usuario u
JOIN (
    SELECT id_user, MAX(id_tel) AS max_id_tel
    FROM telefone
    -- Este subselect pressupõe que telefone tem coluna id_user — adaptar conforme modelo
    GROUP BY id_user
) t_max ON t_max.id_user = u.id_user
JOIN (
    SELECT id_user, MAX(id_end) AS max_id_end
    FROM endereco
    -- Este subselect pressupõe que endereco tem coluna id_user — adaptar conforme modelo
    GROUP BY id_user
) e_max ON e_max.id_user = u.id_user
WHERE NOT EXISTS (
    SELECT 1 FROM dados_adc da WHERE da.id_user = u.id_user
);

-- 9) Criar posts de boas-vindas para usuários que ainda não postaram
INSERT INTO postagem (id_user, titulo_post, conteudo, img_post, data_post, hora_post, num_curtidas)
SELECT u.id_user,
       'Bem-vindo ao sistema' AS titulo_post,
       CONCAT('Olá ', u.nome_usuario, ', bem-vindo!') AS conteudo,
       NULL AS img_post,
       CURRENT_DATE() AS data_post,
       CURRENT_TIME() AS hora_post,
       0 AS num_curtidas
FROM usuario u
WHERE NOT EXISTS (
    SELECT 1 FROM postagem p WHERE p.id_user = u.id_user
);

-- 10) Inserir análises M:N para denúncias abertas: atribuir 3 docentes com maior score (exemplo)
INSERT INTO analiza_docente_denuncia (id_docente, id_denun)
SELECT dtop.id_user AS id_docente, dn.id_denun
FROM (
    SELECT id_user
    FROM corpo_docente cd
    JOIN usuario u ON u.id_user = cd.id_user
    ORDER BY u.score DESC
    LIMIT 3
) dtop
CROSS JOIN (
    SELECT id_denun FROM denuncia WHERE status_denun = 'aberta'
) dn
WHERE NOT EXISTS (
    SELECT 1 FROM analiza_docente_denuncia ad
    WHERE ad.id_denun = dn.id_denun
      AND ad.id_docente = dtop.id_user
);

-- =========================================================
-- FIM DO ARQUIVO
-- =========================================================