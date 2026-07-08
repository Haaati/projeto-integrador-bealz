
/* ===========================
ADMINISTRADORES
=========================== */
--CREATE TABLE `administradores` (
--    `id` INT NOT NULL AUTO_INCREMENT,
--    `usuario` VARCHAR(50) NOT NULL,
--    `senha` VARCHAR(100) NOT NULL,
--    PRIMARY KEY (`id`),
--    UNIQUE KEY `usuario` (`usuario`)
--)

-- SENHA: Sql@2026k


/* ===========================
--SERVIÇOS
--=========================== */
--DROP TABLE IF EXISTS `servicos`;
--
--CREATE TABLE `servicos` (
--    `id` INT NOT NULL AUTO_INCREMENT,
--    `nome_servicos` VARCHAR(45) NOT NULL,
--    PRIMARY KEY (`id`),
--    UNIQUE KEY `nome_UNIQUE` (`nome_servicos`)
--) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
--INSERT INTO `servicos` (`id`, `nome_servicos`) VALUES
--(1, 'Logo Simples'),
--(2, 'Logo + Tipografia'),
--(3, 'Identidade Visual'),
--(4, 'Brand Kit Completo'),
--(5, 'Ícones para Destaques'),
--(6, 'Posts para Redes');


/* ===========================
leads
=========================== */
--DROP TABLE IF EXISTS `leads`;

--CREATE TABLE `leads` (
--    `id` INT NOT NULL AUTO_INCREMENT,
--    `nome` VARCHAR(100) NOT NULL,
--    `email` VARCHAR(256) NOT NULL,
--    `telefone` VARCHAR(14) NOT NULL,
--    `servico_id` INT NOT NULL,
--    `mensagem` TEXT NOT NULL,
--    PRIMARY KEY (`id`),
--    UNIQUE KEY `email` (`email`),
--    KEY `servicos_fk_idx` (`servico_id`),
--    CONSTRAINT `servicos_fk`
--        FOREIGN KEY (`servico_id`)
--        REFERENCES `servicos` (`id`)
--)

/* ===========================
clientes
=========================== */
--CREATE TABLE clientes (
--    id INT AUTO_INCREMENT PRIMARY KEY,
--    nome VARCHAR(100) NOT NULL,
--    email VARCHAR(150),
--    telefone VARCHAR(20),
--    instagram VARCHAR(100),
--    servico_id INT NOT NULL,
--    mensagem TEXT,
--    data_cadastro DATETIME NOT NULL,
--    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
--        ON UPDATE CURRENT_TIMESTAMP,
--    FOREIGN KEY (servico_id) REFERENCES servicos(id)
--);

/* ===========================
Status Cliente
=========================== */
--CREATE TABLE status_clientes (
--    id INT AUTO_INCREMENT PRIMARY KEY,
--    nome_status NOT NULL,
