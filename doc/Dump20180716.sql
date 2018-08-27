CREATE DATABASE  IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pedidos`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: pedidos
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
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesos` (
  `idusuario` int(11) NOT NULL,
  `idModulo` int(11) NOT NULL,
  `idOpcion` int(11) NOT NULL,
  `Leer` int(11) DEFAULT NULL,
  `Crear` int(11) DEFAULT NULL,
  `Actualizar` int(11) DEFAULT NULL,
  `Borrar` int(11) DEFAULT NULL,
  `Reportes` int(11) DEFAULT NULL,
  `Importar` int(11) DEFAULT NULL,
  `Exportar` int(11) DEFAULT NULL,
  `idusuario_alta` int(11) DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUM` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`,`idModulo`,`idOpcion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (1,1,1,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,2,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,3,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,4,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,5,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,6,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,7,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00');
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogos`
--

DROP TABLE IF EXISTS `catalogos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogos` (
  `idcatalogo` int(11) NOT NULL,
  `opc_catalogo` int(11) NOT NULL,
  `Descripcion` varchar(145) NOT NULL,
  `Numero01` int(11) DEFAULT NULL,
  `Numero02` int(11) DEFAULT NULL,
  `idestatus` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `NoUsuarioAlta` int(11) NOT NULL,
  PRIMARY KEY (`idcatalogo`,`opc_catalogo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogos`
--

LOCK TABLES `catalogos` WRITE;
/*!40000 ALTER TABLE `catalogos` DISABLE KEYS */;
INSERT INTO `catalogos` VALUES (0,1,'Catalogo Estatus',0,0,1,'0000-00-00 00:00:00',1),(0,2,'Catalogo Perfiles',0,0,1,'0000-00-00 00:00:00',1),(1,1,'Activo',0,0,1,'0000-00-00 00:00:00',1),(2,1,'Administrador',0,0,1,'0000-00-00 00:00:00',1),(2,2,'Cajero',0,0,1,'0000-00-00 00:00:00',1),(1,2,'Desactivado',0,0,1,'0000-00-00 00:00:00',1),(2,3,'Cocinero',0,0,1,'0000-00-00 00:00:00',1),(2,4,'Mesero',0,0,1,'0000-00-00 00:00:00',1),(2,5,'Gerente',0,0,1,'0000-00-00 00:00:00',1),(0,3,'Catalogo Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,4,'Catalogo Sub Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,5,'Catalogo Unidad Medida',0,0,1,'0000-00-00 00:00:00',1),(3,1,'Tacos',1,0,1,'0000-00-00 00:00:00',1),(3,2,'Hamburguesa',1,0,1,'0000-00-00 00:00:00',1),(3,3,'Papas',1,0,1,'0000-00-00 00:00:00',1),(4,1,'Trompo',1,0,1,'0000-00-00 00:00:00',1),(4,2,'Bisteck',1,0,1,'0000-00-00 00:00:00',1),(4,3,'Arrachera',1,0,1,'0000-00-00 00:00:00',1),(3,4,'Frijoles',1,0,1,'0000-00-00 00:00:00',1),(3,5,'Bebidas',1,0,1,'0000-00-00 00:00:00',1),(3,6,'Otros',1,0,1,'0000-00-00 00:00:00',1),(5,1,'Pieza',0,0,1,'0000-00-00 00:00:00',1),(5,2,'Orden /Paquete',0,0,1,'0000-00-00 00:00:00',1),(4,4,'Refresco',1,0,1,'0000-00-00 00:00:00',1),(4,5,'Refresco Sabor',1,0,1,'0000-00-00 00:00:00',1),(4,6,'Agua Natural',1,0,1,'0000-00-00 00:00:00',1),(0,6,'Catalogo Tipo Platillos',0,0,1,'0000-00-00 00:00:00',1),(6,1,'Platillos o Paquetes',0,0,1,'0000-00-00 00:00:00',1),(6,2,'Extras',0,0,1,'0000-00-00 00:00:00',1),(6,3,'Bebidas',0,0,1,'0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `catalogos` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Fernando','','','','',NULL,1,1,'2018-06-19 22:07:37',1,'2018-06-19 22:30:17'),(2,'alejandrino','','','','','',2,1,'2018-06-19 22:11:16',1,'2018-06-28 23:53:01'),(3,'Alejandro','Gomez','','8121530769','','francisco pizarro',2,1,'2018-06-19 22:12:28',1,'2018-06-28 23:53:00'),(4,'Pedro ','luis','','','','porteslda ',2,1,'2018-06-22 23:36:14',1,'2018-06-28 23:52:58'),(5,'Pedro','','','','','',2,1,'2018-06-26 19:57:31',1,'2018-06-28 23:52:55'),(6,'Pedro','','','','','',2,1,'2018-06-26 19:58:56',1,'2018-06-28 23:52:54'),(7,'Pedro','','','','','',2,1,'2018-06-26 19:59:13',1,'2018-06-28 23:52:53'),(8,'Jesus','Mart','','7172871','7172871','',2,1,'2018-06-28 21:27:56',1,'2018-06-28 23:52:53'),(9,'Joel','Muñoz','','8121540865','812154','Francisco Pizarron #116 entre Calle Numero 1 y Calle numero 2',2,1,'2018-06-28 22:56:34',1,'2018-06-28 23:52:49'),(10,'Alejandro','Gomez','','8121530769','8121','Francisco Pizarro # 116 Entre Juarez y Colegio Civil',1,1,'2018-06-28 23:56:06',1,'2018-06-28 23:56:06'),(11,'Prueba de Cliente',' Nuevo','','812153','812153','francisco pizarro #116',1,1,'2018-07-15 22:35:28',1,'2018-07-15 22:35:28');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `idKey` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(85) DEFAULT NULL,
  `imgMenu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idKey`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'skin-red-light','sidebar-12.jpg');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,2,7,45.00,1),(2,2,4,50.00,1),(3,3,7,45.00,1),(4,3,4,50.00,1),(5,4,4,50.00,1),(6,4,7,45.00,1),(7,5,4,50.00,1),(8,5,7,45.00,1),(9,6,4,50.00,1),(10,6,6,45.00,1),(11,6,7,45.00,1),(12,6,4,50.00,1),(13,6,6,45.00,1),(15,7,4,50.00,1),(16,7,8,10.00,1),(17,8,8,10.00,1),(18,8,5,60.00,1),(19,9,7,45.00,1),(20,8,6,45.00,1),(21,8,4,50.00,1),(22,8,4,50.00,1),(23,8,4,50.00,1),(24,8,4,50.00,1),(25,10,4,50.00,1),(26,10,6,45.00,1),(27,10,7,45.00,1),(28,9,4,50.00,1),(29,9,6,45.00,1),(30,9,4,50.00,1),(31,11,4,50.00,1),(32,11,6,45.00,1),(33,11,7,45.00,1),(34,8,6,45.00,1),(35,12,4,50.00,1),(36,12,6,45.00,1),(37,13,4,50.00,1),(38,13,6,45.00,1),(39,14,4,50.00,1),(40,14,6,45.00,1),(41,15,4,50.00,1),(42,15,6,45.00,1),(43,16,4,50.00,1),(44,17,4,50.00,1),(45,17,6,45.00,1),(46,17,8,10.00,1),(47,18,6,45.00,1),(48,18,8,10.00,1),(49,19,6,45.00,1),(50,19,8,10.00,1),(51,20,4,50.00,1),(52,20,8,10.00,1),(53,21,6,45.00,1),(54,21,8,10.00,1),(55,22,4,50.00,1),(56,22,6,45.00,1),(57,23,5,60.00,1),(58,23,5,60.00,1),(59,23,5,60.00,1),(60,24,4,50.00,1),(61,24,4,50.00,1),(62,24,8,10.00,1),(63,24,8,10.00,1),(64,17,6,45.00,1),(65,25,4,50.00,1),(66,25,6,45.00,1),(67,25,7,45.00,1),(68,25,8,10.00,1),(69,26,4,50.00,1),(70,26,6,45.00,1),(71,26,8,10.00,1),(72,26,8,10.00,1),(73,27,6,45.00,1),(74,27,8,10.00,1),(75,27,6,45.00,1),(76,28,4,50.00,1),(77,28,8,10.00,1),(78,29,5,60.00,1),(79,29,8,10.00,1),(80,29,7,45.00,1),(81,30,4,50.00,1),(82,31,4,50.00,1),(83,31,6,45.00,1),(84,31,8,10.00,1),(85,32,4,50.00,1),(86,33,4,50.00,1),(87,33,9,10.00,1),(88,34,6,45.00,1),(89,34,7,45.00,1),(90,34,4,50.00,1),(91,34,6,45.00,1),(92,34,8,10.00,1),(93,34,8,10.00,1),(94,34,8,10.00,1),(95,34,8,10.00,1),(96,34,9,10.00,1),(97,35,4,50.00,1),(98,35,6,45.00,1),(99,35,8,10.00,1),(100,35,9,10.00,1),(101,36,4,50.00,1),(102,37,4,50.00,1),(103,37,8,10.00,1),(104,37,9,10.00,1),(105,38,4,50.00,1),(106,38,9,10.00,1),(107,38,8,10.00,1),(108,39,4,50.00,1),(109,39,5,60.00,1),(110,39,5,60.00,1),(113,40,5,60.00,1),(115,40,9,10.00,1),(116,41,4,50.00,1),(117,41,8,10.00,1),(118,41,8,10.00,1),(119,42,4,50.00,1),(120,43,4,50.00,1),(121,43,6,45.00,1),(122,44,4,50.00,1),(124,44,5,60.00,1),(125,45,4,50.00,1),(126,45,8,10.00,1),(127,46,4,50.00,1),(128,46,8,10.00,1),(129,47,6,45.00,1),(130,47,5,60.00,1),(131,47,8,10.00,1),(132,48,4,50.00,1),(133,48,8,10.00,1);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesas`
--

DROP TABLE IF EXISTS `mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mesas` (
  `idmesas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `idestatus` int(11) DEFAULT NULL,
  `idusuario_alta` int(11) DEFAULT NULL,
  `FechaAlta` datetime DEFAULT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUM` datetime DEFAULT NULL,
  PRIMARY KEY (`idmesas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'Mesa 1',1,1,'2018-06-18 23:05:16',1,'2018-06-18 23:05:16'),(2,'Mesa 2',1,1,'2018-06-18 23:17:28',1,'2018-06-19 20:19:02'),(3,'Mesa 3',1,1,'2018-07-15 00:39:19',1,'2018-07-15 00:39:19');
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `idModulo` int(11) NOT NULL,
  `idOpcion` int(11) NOT NULL,
  `TipoOpcion` int(11) DEFAULT NULL,
  `Orden` int(11) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Icono` varchar(25) DEFAULT NULL,
  `Funcion` varchar(85) DEFAULT NULL,
  `Parametros` varchar(85) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUM` datetime DEFAULT NULL,
  PRIMARY KEY (`idModulo`,`idOpcion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,1,2,1,'Catalogo Usuarios','fa fa-user','getCatalogoUsuarios','1',1,1,'2018-06-14 00:00:00'),(1,2,1,1,'Catalogos','fa fa-list-alt','getCatalogos','1',1,1,'2018-06-14 00:00:00'),(1,3,1,2,'Configuracion','fa fa-gears','getViewConfiguracion','1',1,1,'2018-06-14 00:00:00'),(1,4,1,3,'Reportes','fa fa-line-chart','getViewReportes','1',1,1,'2018-06-14 00:00:00'),(1,5,1,4,'Caja','fa fa-calculator','getViewCaja','1',1,1,'2018-06-14 00:00:00'),(1,6,1,5,'Indicadores','fa fa-area-chart','getViewIndicadores','1',1,1,'2018-06-14 00:00:00'),(1,7,1,6,'Contabilidad','fa fa-dollar','getViewContabilidad','1',1,1,'2018-06-14 00:00:00');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `idmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idpedido` int(11) NOT NULL,
  `tipo_mov` varchar(2) NOT NULL,
  `nopago` int(11) NOT NULL,
  `importe_venta` decimal(19,2) NOT NULL,
  `importe_pagado` decimal(19,2) DEFAULT NULL,
  `tipo_pago` int(11) NOT NULL,
  `pago_efectivo` decimal(19,2) DEFAULT NULL,
  `pago_tarjeta` decimal(19,2) DEFAULT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_cancelacion` int(11) DEFAULT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idmovimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,15,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-10 23:08:23',NULL,NULL),(2,14,'1',1,95.00,200.00,1,0.00,0.00,1,1,'2018-07-10 23:21:27',NULL,NULL),(3,11,'1',1,140.00,200.00,1,0.00,0.00,1,1,'2018-07-10 23:23:58',NULL,NULL),(4,8,'1',1,360.00,400.00,1,0.00,0.00,1,1,'2018-07-10 23:24:41',NULL,NULL),(5,12,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-10 23:28:44',NULL,NULL),(6,12,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-10 23:28:56',NULL,NULL),(7,7,'1',1,60.00,80.00,1,0.00,0.00,1,1,'2018-07-10 23:30:48',NULL,NULL),(8,9,'1',1,190.00,300.00,1,0.00,0.00,1,1,'2018-07-10 23:33:42',NULL,NULL),(9,13,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-10 23:38:58',NULL,NULL),(10,10,'1',1,140.00,200.00,1,0.00,0.00,1,1,'2018-07-10 23:41:21',NULL,NULL),(11,6,'1',1,235.00,300.00,1,0.00,0.00,1,1,'2018-07-10 23:42:59',NULL,NULL),(12,5,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-10 23:45:40',NULL,NULL),(13,4,'1',1,95.00,300.00,1,0.00,0.00,1,1,'2018-07-10 23:46:57',NULL,NULL),(14,16,'1',1,50.00,50.00,1,0.00,0.00,1,1,'2018-07-10 23:50:24',NULL,NULL),(15,21,'1',1,55.00,60.00,1,0.00,0.00,1,1,'2018-07-10 23:55:10',NULL,NULL),(16,24,'1',1,120.00,200.00,1,0.00,0.00,1,1,'2018-07-10 23:56:51',NULL,NULL),(17,23,'1',1,180.00,500.00,1,0.00,0.00,1,1,'2018-07-10 23:57:35',NULL,NULL),(18,20,'1',1,60.00,100.00,1,0.00,0.00,1,1,'2018-07-11 00:02:23',NULL,NULL),(19,19,'1',1,55.00,100.00,1,0.00,0.00,1,1,'2018-07-12 19:00:40',NULL,NULL),(20,18,'1',1,55.00,100.00,1,0.00,0.00,1,1,'2018-07-12 19:01:44',NULL,NULL),(21,17,'1',1,150.00,200.00,1,0.00,0.00,1,1,'2018-07-13 00:37:42',NULL,NULL),(22,3,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-13 00:43:07',NULL,NULL),(23,22,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-13 00:46:31',NULL,NULL),(24,2,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-13 00:47:14',NULL,NULL),(25,25,'1',1,150.00,200.00,1,0.00,0.00,1,1,'2018-07-13 00:50:43',NULL,NULL),(26,26,'1',1,115.00,200.00,1,0.00,0.00,1,1,'2018-07-13 00:52:00',NULL,NULL),(27,27,'1',1,100.00,200.00,1,0.00,0.00,1,1,'2018-07-13 00:58:08',NULL,NULL),(28,28,'1',1,60.00,200.00,1,0.00,0.00,1,1,'2018-07-13 01:53:17',NULL,NULL),(29,29,'1',1,115.00,120.00,1,0.00,0.00,1,1,'2018-07-13 01:54:33',NULL,NULL),(30,30,'1',1,50.00,50.00,1,0.00,0.00,1,1,'2018-07-13 01:55:29',NULL,NULL),(31,31,'1',1,105.00,200.00,1,0.00,0.00,1,1,'2018-07-13 16:45:15',NULL,NULL),(32,32,'1',1,50.00,50.00,1,0.00,0.00,1,1,'2018-07-13 16:48:38',NULL,NULL),(33,34,'1',1,235.00,500.00,1,0.00,0.00,1,1,'2018-07-13 17:35:58',NULL,NULL),(34,33,'1',1,60.00,70.00,1,0.00,0.00,1,1,'2018-07-13 23:51:58',NULL,NULL),(35,35,'1',1,115.00,200.00,1,0.00,0.00,1,1,'2018-07-13 23:58:33',NULL,NULL),(36,36,'1',1,50.00,100.00,1,0.00,0.00,1,1,'2018-07-15 00:36:47',NULL,NULL),(37,38,'1',1,70.00,70.00,1,0.00,0.00,1,1,'2018-07-15 00:45:07',NULL,NULL),(38,39,'1',1,170.00,500.00,1,0.00,0.00,1,1,'2018-07-15 00:47:08',NULL,NULL),(39,40,'1',1,70.00,100.00,1,0.00,0.00,1,1,'2018-07-15 01:43:28',NULL,NULL),(40,37,'1',1,70.00,100.00,1,0.00,0.00,1,1,'2018-07-15 01:46:10',NULL,NULL),(41,42,'1',1,50.00,50.00,1,0.00,0.00,1,1,'2018-07-15 01:58:55',NULL,NULL),(42,44,'1',1,110.00,200.00,1,0.00,0.00,1,1,'2018-07-15 07:53:07',NULL,NULL),(43,45,'1',1,60.00,60.00,1,0.00,0.00,1,1,'2018-07-15 22:46:11',NULL,NULL),(44,43,'1',1,95.00,100.00,1,0.00,0.00,1,1,'2018-07-16 13:23:25',NULL,NULL),(45,41,'1',1,70.00,70.00,1,0.00,0.00,1,1,'2018-07-16 13:33:15',NULL,NULL),(46,46,'1',1,60.00,60.00,1,0.00,0.00,1,1,'2018-07-16 13:43:18',NULL,NULL),(47,47,'1',1,115.00,200.00,1,0.00,0.00,1,1,'2018-07-16 13:45:26',NULL,NULL);
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

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
  `adomicilio` smallint(1) NOT NULL,
  `direccion` text,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,3,1,0,NULL,1,1,'2018-07-03 00:12:04',NULL),(2,3,1,0,NULL,2,1,'2018-07-03 00:13:09',NULL),(3,3,1,0,NULL,2,1,'2018-07-03 00:13:39',NULL),(4,1,1,0,NULL,2,1,'2018-07-03 08:43:43',NULL),(5,1,1,0,NULL,2,1,'2018-07-03 08:43:51',NULL),(6,1,1,0,NULL,2,1,'2018-07-03 08:53:36',NULL),(7,8,1,0,NULL,2,1,'2018-07-03 18:54:12',NULL),(8,1,1,0,NULL,2,1,'2018-07-03 18:54:45',NULL),(9,10,1,0,NULL,2,1,'2018-07-05 19:59:04',NULL),(10,1,1,0,NULL,2,1,'2018-07-09 21:39:20',NULL),(11,1,1,0,NULL,2,1,'2018-07-09 22:24:41',NULL),(12,1,1,0,NULL,2,1,'2018-07-10 21:57:37',NULL),(13,1,1,0,NULL,2,1,'2018-07-10 21:57:47',NULL),(14,1,1,0,NULL,2,1,'2018-07-10 22:02:35',NULL),(15,1,1,0,NULL,2,1,'2018-07-10 22:02:46',NULL),(16,1,1,0,NULL,2,1,'2018-07-10 23:49:43',NULL),(17,1,1,0,NULL,2,1,'2018-07-10 23:54:02',NULL),(18,1,1,0,NULL,2,1,'2018-07-10 23:54:24',NULL),(19,1,1,0,NULL,2,1,'2018-07-10 23:54:27',NULL),(20,1,1,0,NULL,2,1,'2018-07-10 23:54:53',NULL),(21,1,1,0,NULL,2,1,'2018-07-10 23:55:05',NULL),(22,1,1,0,NULL,2,1,'2018-07-10 23:56:05',NULL),(23,1,1,0,NULL,2,1,'2018-07-10 23:56:21',NULL),(24,1,1,0,NULL,2,1,'2018-07-10 23:56:40',NULL),(25,1,1,0,NULL,2,1,'2018-07-13 00:50:29',NULL),(26,1,1,0,NULL,2,1,'2018-07-13 00:51:50',NULL),(27,1,1,0,NULL,2,1,'2018-07-13 00:56:08',NULL),(28,1,1,0,NULL,2,1,'2018-07-13 01:52:20',NULL),(29,1,1,0,NULL,2,1,'2018-07-13 01:52:35',NULL),(30,1,1,0,NULL,2,1,'2018-07-13 01:55:19',NULL),(31,1,1,0,NULL,2,1,'2018-07-13 16:41:00',NULL),(32,1,1,0,NULL,2,1,'2018-07-13 16:48:33',NULL),(33,10,1,0,NULL,2,1,'2018-07-13 16:50:12',NULL),(34,1,1,0,NULL,2,1,'2018-07-13 16:56:57',NULL),(35,1,1,0,NULL,2,1,'2018-07-13 23:58:29',NULL),(36,1,1,0,NULL,2,1,'2018-07-15 00:36:39',NULL),(37,1,1,0,NULL,2,1,'2018-07-15 00:37:37',NULL),(38,1,1,0,NULL,2,1,'2018-07-15 00:45:03',NULL),(39,1,1,0,NULL,2,1,'2018-07-15 00:46:43',NULL),(40,1,1,0,NULL,2,1,'2018-07-15 01:12:11',NULL),(41,1,1,0,NULL,2,1,'2018-07-15 01:47:43',NULL),(42,1,1,0,NULL,2,1,'2018-07-15 01:58:18',NULL),(43,1,1,0,NULL,2,1,'2018-07-15 02:04:59',NULL),(44,1,1,0,NULL,2,1,'2018-07-15 07:51:51',NULL),(45,11,1,0,NULL,2,1,'2018-07-15 22:35:48',NULL),(46,1,1,0,NULL,2,1,'2018-07-16 13:43:14',NULL),(47,1,1,0,NULL,2,1,'2018-07-16 13:44:25',NULL),(48,1,1,0,NULL,1,1,'2018-07-16 13:46:21',NULL);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (4,'Tacos de Trompo',2,5,1,1,1,50.00,40.00,'5.png',1,1,'2018-06-21 00:00:05',1,'2018-07-10 21:56:46'),(5,'Taco de Bisteck',1,1,2,1,2,60.00,40.00,'7.png',1,1,'2018-06-21 00:39:56',1,'2018-06-21 00:39:56'),(6,'Hamburguesa',1,1,1,2,2,45.00,45.00,'4.png',1,1,'2018-06-21 00:41:52',1,'2018-06-22 20:43:03'),(7,'Hamburguesa',1,1,1,2,2,45.00,30.00,'4.png',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46'),(8,'Refresco',1,1,3,5,4,10.00,7.00,'9.jpg',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46'),(9,'Agua Natural',1,1,3,5,4,10.00,7.00,'10.png',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46'),(10,'Servicio a Domicilio',1,1,NULL,6,6,10.00,10.00,NULL,1,1,'2018-07-15 02:09:09',1,'2018-07-15 02:09:09');
/*!40000 ALTER TABLE `platillos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) DEFAULT NULL,
  `apellidos` varchar(85) DEFAULT NULL,
  `nickname` varchar(55) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idestatus` int(11) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `FechaAlta` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Alejandro','Gomez Barron','Alejandro Gomez','agomez','ac62e1011e7b4a54ab203b64bb6d85e8',1,1,'2018-06-14 22:06:33'),(6,'Pedro','Gomez Barron','Pedro Gomez','pgomez','3a5e7c734f27b158e94060ad77252605',2,1,'2018-06-14 22:06:33'),(7,'Eduardo','Muñoz','Eduardo','emunoz','cc93f3b9096342d2d9a022be33d7ef76',2,1,'2018-06-14 22:06:33'),(8,'Nelly','Suarez Roblero','Nelly Suarez','nsuarez','3d43c5498a63e95f929f8f8588588a1a',1,3,'2018-06-15 10:13:56'),(9,'Mesa 1','','','','0144712dd81be0c3d9724f5e56ce6685',2,0,'2018-06-16 00:44:45');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pedidos'
--

--
-- Dumping routines for database 'pedidos'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-16 17:51:30
