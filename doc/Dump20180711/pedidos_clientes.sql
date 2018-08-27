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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) NOT NULL,
  `apellidos` varchar(85) DEFAULT NULL,
  `correo` varchar(135) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `direccion` text,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUm` datetime DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Fernando','','','','',NULL,1,1,'2018-06-19 22:07:37',1,'2018-06-19 22:30:17'),(2,'alejandrino','','','','','',2,1,'2018-06-19 22:11:16',1,'2018-06-28 23:53:01'),(3,'Alejandro','Gomez','','8121530769','','francisco pizarro',2,1,'2018-06-19 22:12:28',1,'2018-06-28 23:53:00'),(4,'Pedro ','luis','','','','porteslda ',2,1,'2018-06-22 23:36:14',1,'2018-06-28 23:52:58'),(5,'Pedro','','','','','',2,1,'2018-06-26 19:57:31',1,'2018-06-28 23:52:55'),(6,'Pedro','','','','','',2,1,'2018-06-26 19:58:56',1,'2018-06-28 23:52:54'),(7,'Pedro','','','','','',2,1,'2018-06-26 19:59:13',1,'2018-06-28 23:52:53'),(8,'Jesus','Mart','','7172871','7172871','',2,1,'2018-06-28 21:27:56',1,'2018-06-28 23:52:53'),(9,'Joel','Muñoz','','8121540865','812154','Francisco Pizarron #116 entre Calle Numero 1 y Calle numero 2',2,1,'2018-06-28 22:56:34',1,'2018-06-28 23:52:49'),(10,'Alejandro','Gomez','','8121530769','8121','Francisco Pizarro # 116 Entre Juarez y Colegio Civil',1,1,'2018-06-28 23:56:06',1,'2018-06-28 23:56:06');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-11  8:05:09
