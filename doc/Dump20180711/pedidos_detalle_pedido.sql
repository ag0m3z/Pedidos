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
-- Table structure for table `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedido` (
  `iddetalle` int(11) NOT NULL AUTO_INCREMENT,
  `pedidos_idpedido` int(11) NOT NULL,
  `platillos_idplatillo` int(11) NOT NULL,
  `precio_venta` decimal(19,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`iddetalle`),
  KEY `fk_detalle_pedido_platillos1_idx` (`platillos_idplatillo`),
  KEY `fk_detalle_pedido_pedidos1_idx` (`pedidos_idpedido`),
  CONSTRAINT `fk_detalle_pedido_pedidos1` FOREIGN KEY (`pedidos_idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_platillos1` FOREIGN KEY (`platillos_idplatillo`) REFERENCES `platillos` (`idplatillo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,2,7,45.00,1),(2,2,4,50.00,1),(3,3,7,45.00,1),(4,3,4,50.00,1),(5,4,4,50.00,1),(6,4,7,45.00,1),(7,5,4,50.00,1),(8,5,7,45.00,1),(9,6,4,50.00,1),(10,6,6,45.00,1),(11,6,7,45.00,1),(12,6,4,50.00,1),(13,6,6,45.00,1),(15,7,4,50.00,1),(16,7,8,10.00,1),(17,8,8,10.00,1),(18,8,5,60.00,1),(19,9,7,45.00,1),(20,8,6,45.00,1),(21,8,4,50.00,1),(22,8,4,50.00,1),(23,8,4,50.00,1),(24,8,4,50.00,1),(25,10,4,50.00,1),(26,10,6,45.00,1),(27,10,7,45.00,1),(28,9,4,50.00,1),(29,9,6,45.00,1),(30,9,4,50.00,1),(31,11,4,50.00,1),(32,11,6,45.00,1),(33,11,7,45.00,1),(34,8,6,45.00,1),(35,12,4,50.00,1),(36,12,6,45.00,1),(37,13,4,50.00,1),(38,13,6,45.00,1),(39,14,4,50.00,1),(40,14,6,45.00,1),(41,15,4,50.00,1),(42,15,6,45.00,1),(43,16,4,50.00,1),(44,17,4,50.00,1),(45,17,6,45.00,1),(46,17,8,10.00,1),(47,18,6,45.00,1),(48,18,8,10.00,1),(49,19,6,45.00,1),(50,19,8,10.00,1),(51,20,4,50.00,1),(52,20,8,10.00,1),(53,21,6,45.00,1),(54,21,8,10.00,1),(55,22,4,50.00,1),(56,22,6,45.00,1),(57,23,5,60.00,1),(58,23,5,60.00,1),(59,23,5,60.00,1),(60,24,4,50.00,1),(61,24,4,50.00,1),(62,24,8,10.00,1),(63,24,8,10.00,1);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
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
