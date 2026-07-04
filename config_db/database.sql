
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
CLIENTES
=========================== */
--DROP TABLE IF EXISTS `clientes`;

--CREATE TABLE `clientes` (
--    `id` INT NOT NULL AUTO_INCREMENT,
--    `nome` VARCHAR(100) NOT NULL,
--    `email` VARCHAR(256) NOT NULL,
--    `telefone` VARCHAR(14) NOT NULL,
--    `servicos` INT NOT NULL,
--    `observacao` TEXT NOT NULL,
--    PRIMARY KEY (`id`),
--    UNIQUE KEY `email` (`email`),
--    KEY `servicos_fk_idx` (`servicos`),
--    CONSTRAINT `servicos_fk`
--        FOREIGN KEY (`servicos`)
--        REFERENCES `servicos` (`id`)
--)
