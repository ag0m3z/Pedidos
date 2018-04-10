-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: hsppedidos
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `hsdsucursales`
--

DROP TABLE IF EXISTS `hsdsucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hsdsucursales` (
  `idsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_um` datetime DEFAULT NULL,
  PRIMARY KEY (`idsucursal`,`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hsdsucursales`
--

LOCK TABLES `hsdsucursales` WRITE;
/*!40000 ALTER TABLE `hsdsucursales` DISABLE KEYS */;
INSERT INTO `hsdsucursales` VALUES (1,1,'Guerrero',1,1,1,'0000-00-00 00:00:00','2018-04-04 23:56:02'),(2,1,'Colon',0,1,1,'2018-04-04 23:47:15','2018-04-05 00:00:42');
/*!40000 ALTER TABLE `hsdsucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspclientes`
--

DROP TABLE IF EXISTS `hspclientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspclientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_um` datetime DEFAULT NULL,
  PRIMARY KEY (`idcliente`,`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspclientes`
--

LOCK TABLES `hspclientes` WRITE;
/*!40000 ALTER TABLE `hspclientes` DISABLE KEYS */;
INSERT INTO `hspclientes` VALUES (1,1,'Mostrador',1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hspclientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspcompras`
--

DROP TABLE IF EXISTS `hspcompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspcompras` (
  `idcompra` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`idcompra`,`idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspcompras`
--

LOCK TABLES `hspcompras` WRITE;
/*!40000 ALTER TABLE `hspcompras` DISABLE KEYS */;
/*!40000 ALTER TABLE `hspcompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspconfig`
--

DROP TABLE IF EXISTS `hspconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspconfig` (
  `idsysconfig` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `nombre_empresa` varchar(45) DEFAULT NULL,
  `descripcion_empresa` text,
  `logo` varchar(60) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`idsysconfig`,`idempresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspconfig`
--

LOCK TABLES `hspconfig` WRITE;
/*!40000 ALTER TABLE `hspconfig` DISABLE KEYS */;
/*!40000 ALTER TABLE `hspconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspdetalle_pedido`
--

DROP TABLE IF EXISTS `hspdetalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspdetalle_pedido` (
  `idhspdetalle_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `hsppedido_idpedido` int(11) NOT NULL,
  `hspplatillo_idplatillo` int(11) NOT NULL,
  `precio_venta` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idhspdetalle_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspdetalle_pedido`
--

LOCK TABLES `hspdetalle_pedido` WRITE;
/*!40000 ALTER TABLE `hspdetalle_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `hspdetalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspempresas`
--

DROP TABLE IF EXISTS `hspempresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspempresas` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) NOT NULL,
  `key` text NOT NULL,
  `licencia` text NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspempresas`
--

LOCK TABLES `hspempresas` WRITE;
/*!40000 ALTER TABLE `hspempresas` DISABLE KEYS */;
INSERT INTO `hspempresas` VALUES (1,'Tacos Charly','1','1','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hspempresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspinsumos`
--

DROP TABLE IF EXISTS `hspinsumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspinsumos` (
  `idinsumo` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idinsumo`,`idempresa`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspinsumos`
--

LOCK TABLES `hspinsumos` WRITE;
/*!40000 ALTER TABLE `hspinsumos` DISABLE KEYS */;
INSERT INTO `hspinsumos` VALUES (1,1,'Tomate');
/*!40000 ALTER TABLE `hspinsumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspmesas`
--

DROP TABLE IF EXISTS `hspmesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspmesas` (
  `idmesa` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `numero_mesa` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`idmesa`,`idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspmesas`
--

LOCK TABLES `hspmesas` WRITE;
/*!40000 ALTER TABLE `hspmesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `hspmesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hsppedido`
--

DROP TABLE IF EXISTS `hsppedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hsppedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  PRIMARY KEY (`idpedido`,`idempresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hsppedido`
--

LOCK TABLES `hsppedido` WRITE;
/*!40000 ALTER TABLE `hsppedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `hsppedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspplatillo`
--

DROP TABLE IF EXISTS `hspplatillo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspplatillo` (
  `idplatillo` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(65) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `Categoria` int(11) DEFAULT NULL,
  `SubCategoria` int(11) DEFAULT NULL,
  `Clasificacion1` int(11) DEFAULT NULL,
  `Clasificacion2` int(11) DEFAULT NULL,
  `precio_venta` decimal(18,2) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_um` datetime DEFAULT NULL,
  PRIMARY KEY (`idplatillo`,`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspplatillo`
--

LOCK TABLES `hspplatillo` WRITE;
/*!40000 ALTER TABLE `hspplatillo` DISABLE KEYS */;
INSERT INTO `hspplatillo` VALUES (1,1,'Orden de Tacos',1,1,1,1,1,60.00,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `hspplatillo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hspusuarios`
--

DROP TABLE IF EXISTS `hspusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hspusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idperfil` int(11) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_um` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`,`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hspusuarios`
--

LOCK TABLES `hspusuarios` WRITE;
/*!40000 ALTER TABLE `hspusuarios` DISABLE KEYS */;
INSERT INTO `hspusuarios` VALUES (1,1,1,'Alejandro','agomez','d033e22ae348aeb5660fc2140aec35850c4da997',1,1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,2,2,'Pedro Gomez','pgomez','da39a3ee5e6b4b0d3255bfef95601890afd80709',2,0,1,1,'2018-04-04 22:45:07','2018-04-04 23:24:32'),(3,2,1,'Pedro Gomez','pgomez','7c4a8d09ca3762af61e59520943dc26494f8941b',1,1,1,1,'2018-04-04 22:48:06','2018-04-04 22:48:06');
/*!40000 ALTER TABLE `hspusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_caja`
--

DROP TABLE IF EXISTS `movimientos_caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos_caja` (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idempresa` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `importe_total` decimal(18,2) DEFAULT NULL,
  `importe_pagado` decimal(18,2) DEFAULT NULL,
  `importe_recibido` decimal(18,2) DEFAULT NULL,
  `tipo_pago` int(11) DEFAULT NULL,
  `importe_efectivo` decimal(18,2) DEFAULT NULL,
  `importe_voucher` decimal(18,2) DEFAULT NULL,
  `idestatus` varchar(1) DEFAULT NULL,
  `idusuario_movimiento` int(11) DEFAULT NULL,
  `fecha_movimiento` datetime DEFAULT NULL,
  PRIMARY KEY (`idmovimiento`,`idempresa`,`idpedido`,`idpago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_caja`
--

LOCK TABLES `movimientos_caja` WRITE;
/*!40000 ALTER TABLE `movimientos_caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos_caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'hsppedidos'
--

--
-- Dumping routines for database 'hsppedidos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-04 19:05:00
