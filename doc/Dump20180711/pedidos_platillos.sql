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
-- Table structure for table `platillos`
--

DROP TABLE IF EXISTS `platillos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platillos` (
  `idplatillo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `unidad_medida` int(11) NOT NULL,
  `piezas` int(11) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `idsubcategoria` int(11) DEFAULT NULL,
  `precio_venta` decimal(19,2) NOT NULL,
  `precio_compra` decimal(19,2) DEFAULT NULL,
  `url_img` varchar(250) DEFAULT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUM` datetime DEFAULT NULL,
  PRIMARY KEY (`idplatillo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (4,'Tacos de Trompo',2,5,1,1,1,50.00,40.00,'4.png',1,1,'2018-06-21 00:00:05',1,'2018-07-10 21:56:46'),(5,'Taco de Bisteck',1,1,2,1,2,60.00,40.00,'5.png',1,1,'2018-06-21 00:39:56',1,'2018-06-21 00:39:56'),(6,'Hamburguesa',1,1,1,2,2,45.00,45.00,'6.png',1,1,'2018-06-21 00:41:52',1,'2018-06-22 20:43:03'),(7,'Hamburguesa',1,1,1,2,2,45.00,30.00,'7.png',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46'),(8,'Refresco',1,1,3,5,4,10.00,7.00,'9.jpg',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46');
/*!40000 ALTER TABLE `platillos` ENABLE KEYS */;
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
