CREATE DATABASE  IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pedidos`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: pedidos
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,3,1,1,1,'2018-07-03 00:12:04',NULL),(2,3,1,1,1,'2018-07-03 00:13:09',NULL),(3,3,1,1,1,'2018-07-03 00:13:39',NULL),(4,1,1,2,1,'2018-07-03 08:43:43',NULL),(5,1,1,2,1,'2018-07-03 08:43:51',NULL),(6,1,1,2,1,'2018-07-03 08:53:36',NULL),(7,8,1,2,1,'2018-07-03 18:54:12',NULL),(8,1,1,2,1,'2018-07-03 18:54:45',NULL),(9,10,1,2,1,'2018-07-05 19:59:04',NULL),(10,1,1,2,1,'2018-07-09 21:39:20',NULL),(11,1,1,2,1,'2018-07-09 22:24:41',NULL),(12,1,1,2,1,'2018-07-10 21:57:37',NULL),(13,1,1,2,1,'2018-07-10 21:57:47',NULL),(14,1,1,2,1,'2018-07-10 22:02:35',NULL),(15,1,1,2,1,'2018-07-10 22:02:46',NULL),(16,1,1,2,1,'2018-07-10 23:49:43',NULL),(17,1,1,1,1,'2018-07-10 23:54:02',NULL),(18,1,1,1,1,'2018-07-10 23:54:24',NULL),(19,1,1,1,1,'2018-07-10 23:54:27',NULL),(20,1,1,2,1,'2018-07-10 23:54:53',NULL),(21,1,1,2,1,'2018-07-10 23:55:05',NULL),(22,1,1,1,1,'2018-07-10 23:56:05',NULL),(23,1,1,2,1,'2018-07-10 23:56:21',NULL),(24,1,1,2,1,'2018-07-10 23:56:40',NULL);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-11  8:05:10