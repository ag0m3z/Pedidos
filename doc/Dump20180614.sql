CREATE DATABASE  IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET latin1 */;
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
INSERT INTO `catalogos` VALUES (0,1,'Catalogo Estatus',1,'0000-00-00 00:00:00',1),(0,2,'Catalogo Perfiles',1,'0000-00-00 00:00:00',1),(1,1,'Activo',1,'0000-00-00 00:00:00',1),(2,1,'Administrador',1,'0000-00-00 00:00:00',1),(2,2,'Cajero',1,'0000-00-00 00:00:00',1),(1,2,'Desactivado',1,'0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `catalogos` ENABLE KEYS */;
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
  `platillos_idplatillo` int(11) NOT NULL,
  `pedidos_idpedido` int(11) NOT NULL,
  `mesas_idmesas` int(11) NOT NULL,
  `precio_venta` decimal(19,2) DEFAULT NULL,
  PRIMARY KEY (`iddetalle`),
  KEY `fk_detalle_pedido_platillos1_idx` (`platillos_idplatillo`),
  KEY `fk_detalle_pedido_pedidos1_idx` (`pedidos_idpedido`),
  KEY `fk_detalle_pedido_mesas1_idx` (`mesas_idmesas`),
  CONSTRAINT `fk_detalle_pedido_mesas1` FOREIGN KEY (`mesas_idmesas`) REFERENCES `mesas` (`idmesas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_pedidos1` FOREIGN KEY (`pedidos_idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_pedido_platillos1` FOREIGN KEY (`platillos_idplatillo`) REFERENCES `platillos` (`idplatillo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idcliente`
--

DROP TABLE IF EXISTS `idcliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idcliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) NOT NULL,
  `apellidos` varchar(85) DEFAULT NULL,
  `correo` varchar(135) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUm` datetime DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idcliente`
--

LOCK TABLES `idcliente` WRITE;
/*!40000 ALTER TABLE `idcliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `idcliente` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
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
INSERT INTO `modulos` VALUES (1,1,2,1,'Catalogo Usuarios','fa fa-user','getCatalogoUsuarios','1',1,1,'2018-06-14 00:00:00'),(1,2,1,1,'Catalogos','fa fa-list-alt','getCatalogos','1',1,1,'2018-06-14 00:00:00'),(1,3,1,2,'Configuracion','fa fa-gears','getConfiguracion','1',1,1,'2018-06-14 00:00:00'),(1,4,1,3,'Reportes','fa fa-line-chart','getReportes','1',1,1,'2018-06-14 00:00:00'),(1,5,1,4,'Caja','fa fa-calculator','getCaja','1',1,1,'2018-06-14 00:00:00'),(1,6,1,5,'Indicadores','fa fa-area-chart','getIndicadores','1',1,1,'2018-06-14 00:00:00'),(1,7,1,6,'Contabilidad','fa fa-dollar','getContabilidad','1',1,1,'2018-06-14 00:00:00');
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
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_cancelacion` int(11) DEFAULT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idmovimiento`),
  KEY `fk_movimientos_pedidos1_idx` (`idpedido`),
  CONSTRAINT `fk_movimientos_pedidos1` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
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
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `fk_pedidos_mesas_idx` (`idmesa`),
  KEY `fk_pedidos_idcliente1_idx` (`idcliente`),
  CONSTRAINT `fk_pedidos_idcliente1` FOREIGN KEY (`idcliente`) REFERENCES `idcliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_mesas` FOREIGN KEY (`idmesa`) REFERENCES `mesas` (`idmesas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
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
  `nombre` varchar(85) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `idtipo` int(11) DEFAULT NULL,
  `idcategoria` int(11) NOT NULL,
  `idsubcategoria` int(11) DEFAULT NULL,
  `precio_venta` decimal(19,2) NOT NULL,
  `idusuario_alta` int(11) DEFAULT NULL,
  `FechaAlta` datetime DEFAULT NULL,
  `idusuario_um` int(11) DEFAULT NULL,
  `FechaUM` datetime DEFAULT NULL,
  PRIMARY KEY (`idplatillo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Alejandro','Gomez Barron','Alejandro Gomez','agomez','0c7540eb7e65b553ec1ba6b20de79608',1,1,'0000-00-00 00:00:00'),(2,'Pedro Luis','Gomez Barron','Pedro Gomez','pgomez','0c7540eb7e65b553ec1ba6b20de79608',1,1,'2018-05-04 05:23:50');
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

-- Dump completed on 2018-06-14 19:05:20
