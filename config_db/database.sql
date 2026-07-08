-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: berenice
-- ------------------------------------------------------
-- Server version	8.0.46

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `senha_UNIQUE` (`senha`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'admin','Sql@2026k');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `servico_id` int NOT NULL,
  `sobre` text,
  `proposta_url` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_clientes` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `servico_id` (`servico_id`),
  KEY `fk_clientes_status_idx` (`status_clientes`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`),
  CONSTRAINT `fk_clientes_status` FOREIGN KEY (`status_clientes`) REFERENCES `status_cliente` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (13,'Manuel','manuel@gmail.com','41988154721',NULL,NULL,5,NULL,NULL,'2026-07-07 16:37:03','2026-07-08 18:38:04',5),(14,'Willy','willywonka@gmail.com','41992397076',NULL,NULL,1,NULL,NULL,'2026-07-07 15:21:13','2026-07-08 18:37:57',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(256) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `servicos` int NOT NULL,
  `mensagem` text NOT NULL,
  `data_clientes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_lead` enum('Novo','Em contato','Perdido') NOT NULL DEFAULT 'Novo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `servicos_fk_idx` (`servicos`),
  CONSTRAINT `servicos_fk` FOREIGN KEY (`servicos`) REFERENCES `servicos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (10,'Beatriz Kava','beatriz.kava@gmail.com','41991073771',4,'a','2026-07-07 17:42:36','Novo'),(14,'Heron','heron@gmail.com','41 989898888',1,'Mmm','2026-07-08 18:47:46','Novo'),(16,'Adam','adam@gmail.com','41 989898888',1,'Mmm','2026-07-08 18:50:40','Novo'),(19,'Julio','julio@gmail.com','41123451234',6,'Zzz','2026-07-08 18:52:42','Em contato'),(20,'claudio','claudio@gmail.com','41991073771',3,'aaaaaaaaaaaa','2026-07-08 18:54:25','Perdido'),(21,'Josivaldo','josivaldo@gmail.com','47979797977',5,'aaaaabbbbbbbbcxxxxxxxxx','2026-07-08 18:58:23','Novo'),(22,'Robervani','robervani@gmail.com','4199797997',3,'claudioo','2026-07-08 19:01:13','Em contato'),(26,'Pedro Ambrósio','pedro.ambrosio@yahoo.com','44 97298368',6,'Olá! gostei do seu trabalho!','2026-07-08 19:39:36','Novo');
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_servicos` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome_servicos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (4,'Brand Kit Completo'),(5,'Ícones para Destaques'),(3,'Identidade Visual'),(2,'Logo + Tipografia'),(1,'Logo Simples'),(6,'Posts para Redes');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_cliente`
--

DROP TABLE IF EXISTS `status_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_cliente` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `nome_status` varchar(45) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_cliente`
--

LOCK TABLES `status_cliente` WRITE;
/*!40000 ALTER TABLE `status_cliente` DISABLE KEYS */;
INSERT INTO `status_cliente` VALUES (1,'Proposta enviada'),(2,'Aguardando pagamento'),(3,'Entregue'),(4,'Inativo'),(5,'Ativo'),(6,'Pausado'),(7,'Finalizado');
/*!40000 ALTER TABLE `status_cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-08 16:44:01
