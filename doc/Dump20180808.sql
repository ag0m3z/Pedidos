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
INSERT INTO `accesos` VALUES (1,1,1,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,2,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,3,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,4,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,5,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,6,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,7,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(2,1,5,1,1,1,1,1,1,1,1,'2018-07-24 22:56:58',NULL,NULL),(3,1,5,1,1,1,1,1,1,1,1,'2018-07-24 22:57:23',NULL,NULL);
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apertura`
--

DROP TABLE IF EXISTS `apertura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apertura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(1) NOT NULL,
  `Fecha` date NOT NULL,
  `Monto` decimal(18,2) NOT NULL,
  `idestatus` int(11) NOT NULL,
  `NoUsuarioAlta` int(11) NOT NULL,
  `FechaRegistro` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apertura`
--

LOCK TABLES `apertura` WRITE;
/*!40000 ALTER TABLE `apertura` DISABLE KEYS */;
INSERT INTO `apertura` VALUES (1,'C','2018-07-22',300.00,1,1,'2018-07-24 13:34:30'),(2,'C','2018-07-21',100.00,1,1,'2018-07-24 13:37:28'),(5,'C','2018-07-23',500.00,1,1,'2018-07-24 17:59:25'),(4,'A','2018-07-24',600.00,1,1,'2018-07-24 13:39:35'),(6,'C','2018-07-24',1500.00,1,1,'2018-07-25 00:06:37'),(7,'C','2018-07-25',1450.00,1,1,'2018-07-26 00:12:02'),(8,'C','2018-07-26',100.00,1,1,'2018-08-04 00:42:31'),(9,'C','2018-07-27',2500.00,1,1,'2018-08-04 00:42:38'),(10,'C','2018-07-28',2500.00,1,1,'2018-08-04 00:42:46'),(11,'C','2018-07-29',2500.00,1,1,'2018-08-04 00:44:02'),(12,'C','2018-07-30',700.00,1,1,'2018-08-04 00:44:10'),(13,'C','2018-07-31',300.00,1,1,'2018-08-04 00:44:28'),(14,'C','2018-08-01',1500.00,1,1,'2018-08-04 00:44:35'),(15,'C','2018-08-02',1200.00,1,1,'2018-08-04 00:44:41'),(16,'C','2018-08-03',1500.00,1,1,'2018-08-04 00:44:48'),(17,'C','2018-08-04',2300.00,1,1,'2018-08-05 22:56:54'),(18,'C','2018-08-05',1500.00,1,1,'2018-08-06 09:01:48'),(19,'C','2018-08-06',2500.00,1,1,'2018-08-07 20:50:09'),(20,'C','2018-08-07',2500.00,1,1,'2018-08-08 00:06:45');
/*!40000 ALTER TABLE `apertura` ENABLE KEYS */;
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
INSERT INTO `catalogos` VALUES (0,1,'Catalogo Estatus',0,0,1,'0000-00-00 00:00:00',1),(0,2,'Catalogo Perfiles',0,0,1,'0000-00-00 00:00:00',1),(1,1,'Activo',0,0,1,'0000-00-00 00:00:00',1),(2,1,'Administrador',0,0,1,'0000-00-00 00:00:00',1),(2,2,'Cajero',0,0,1,'0000-00-00 00:00:00',1),(1,2,'Desactivado',0,0,1,'0000-00-00 00:00:00',1),(2,3,'Cocinero',0,0,0,'0000-00-00 00:00:00',1),(2,4,'Mesero',0,0,1,'0000-00-00 00:00:00',1),(2,5,'Gerente',0,0,0,'0000-00-00 00:00:00',1),(0,3,'Catalogo Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,4,'Catalogo Sub Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,5,'Catalogo Unidad Medida',0,0,1,'0000-00-00 00:00:00',1),(3,1,'Tacos',1,0,1,'0000-00-00 00:00:00',1),(3,2,'Hamburguesa',1,0,1,'0000-00-00 00:00:00',1),(3,3,'Papas',1,0,1,'0000-00-00 00:00:00',1),(4,1,'Trompo',1,0,1,'0000-00-00 00:00:00',1),(4,2,'Bisteck',1,0,1,'0000-00-00 00:00:00',1),(4,3,'Arrachera',1,0,1,'0000-00-00 00:00:00',1),(3,4,'Frijoles',1,0,1,'0000-00-00 00:00:00',1),(3,5,'Bebidas',1,0,1,'0000-00-00 00:00:00',1),(3,6,'Otros',1,0,1,'0000-00-00 00:00:00',1),(5,1,'Pieza',0,0,1,'0000-00-00 00:00:00',1),(5,2,'Orden /Paquete',0,0,1,'0000-00-00 00:00:00',1),(4,4,'Refresco',1,0,1,'0000-00-00 00:00:00',1),(4,5,'Refresco Sabor',1,0,1,'0000-00-00 00:00:00',1),(4,6,'Agua Natural',1,0,1,'0000-00-00 00:00:00',1),(0,6,'Catalogo Tipo Platillos',0,0,1,'0000-00-00 00:00:00',1),(6,1,'Platillos o Paquetes',0,0,1,'0000-00-00 00:00:00',1),(6,2,'Extras',0,0,1,'0000-00-00 00:00:00',1),(6,3,'Bebidas',0,0,1,'0000-00-00 00:00:00',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Cliente ','Mostrador','','','','',1,1,'2018-07-20 22:10:13',1,'2018-07-20 22:10:13'),(2,'Jose','Hernandez','','8121530769','8121530769','Francionamient # 1',1,1,'2018-07-20 22:11:54',1,'2018-07-20 22:11:54'),(3,'Lesly','Suarez','','81321563','','',1,1,'2018-07-23 22:27:02',1,'2018-07-23 22:27:02'),(4,'Nelly','suarez','','8234156','','',1,1,'2018-07-23 22:29:36',1,'2018-07-23 22:29:36'),(5,'Ari','Suarez','','9897651','','',1,1,'2018-07-23 22:30:27',1,'2018-07-23 22:30:27'),(6,'Francisco','Suarez','','908989','','',1,1,'2018-07-23 22:32:45',1,'2018-07-23 22:32:45');
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
  `NombreEmpresa` varchar(85) DEFAULT NULL,
  `Colonia` varchar(145) DEFAULT NULL,
  `Calle` varchar(165) DEFAULT NULL,
  `Telefono1` varchar(15) DEFAULT NULL,
  `Telefono2` varchar(15) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL,
  `AperturaCierre` int(11) DEFAULT NULL,
  `HorarioAcceso` int(11) DEFAULT NULL,
  `ServicioDomicilio` int(11) DEFAULT NULL,
  `CambiarClave` int(11) DEFAULT NULL,
  `Ticket` int(11) DEFAULT NULL,
  `TicketLogo` int(11) DEFAULT NULL,
  `TicketTelefono` int(11) DEFAULT NULL,
  `TicketAutomatico` int(11) DEFAULT NULL,
  `TicketAgrupacion` int(11) DEFAULT NULL,
  `CerrarPantallaTicket` int(11) DEFAULT NULL,
  `Licencia` text,
  `FechaExp` date DEFAULT NULL,
  PRIMARY KEY (`idKey`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'skin-purple','sidebar-16.jpg','Taquería Arneyda','Fraccionamiento los Pilares','Cerrode la Campana #322','81 82602123','','',NULL,1,1,1,0,1,1,1,1,1,1,NULL,NULL);
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
  KEY `fk_detalle_pedido_pedidos1_idx` (`pedidos_idpedido`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,1,28,50.00,1),(2,1,1,15.00,1),(4,2,6,60.00,1),(5,3,6,60.00,1),(6,3,28,50.00,1),(7,4,26,35.00,1),(8,4,0,15.00,1),(9,5,26,35.00,1),(10,5,0,20.00,1),(11,6,28,50.00,1),(12,6,0,10.00,1),(13,7,26,35.00,1),(14,7,28,50.00,1),(15,8,26,35.00,1),(16,9,27,45.00,1),(17,9,27,45.00,1),(18,9,27,45.00,1),(19,9,27,45.00,1),(20,9,28,50.00,1),(21,10,13,50.00,1),(22,10,1,15.00,1),(23,11,16,25.00,1),(24,11,7,30.00,1),(25,11,1,15.00,1),(26,12,26,35.00,1),(27,12,1,15.00,1),(28,13,26,35.00,1),(29,13,28,50.00,1),(30,13,26,35.00,1),(31,14,26,35.00,1),(32,15,26,35.00,1),(33,15,1,15.00,1),(34,16,6,60.00,1),(35,16,13,50.00,1),(36,16,1,15.00,1),(37,17,6,60.00,1),(38,17,1,15.00,1),(39,18,28,50.00,1),(40,18,28,50.00,1),(41,18,28,50.00,1),(42,19,6,60.00,1),(43,20,26,35.00,1),(44,20,28,50.00,1),(45,20,1,15.00,1),(46,20,2,15.00,1),(47,21,6,60.00,1),(48,21,1,15.00,1),(49,22,28,50.00,1),(50,22,1,15.00,1),(51,23,7,30.00,1),(52,24,6,60.00,1),(53,25,6,60.00,1),(54,25,1,15.00,1),(55,26,26,35.00,1),(56,26,1,15.00,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'Mesa 1',1,1,'2018-07-20 22:10:00',1,'2018-07-20 22:10:00');
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
INSERT INTO `modulos` VALUES (1,1,2,7,'Catalogo Usuarios','fa fa-user','getCatalogoUsuarios','1',1,1,'2018-06-14 00:00:00'),(1,2,1,3,'Catalogos','fa fa-list-alt','getCatalogos','1',1,1,'2018-06-14 00:00:00'),(1,3,1,4,'Configuracion','fa fa-gears','getViewConfiguracion','1',1,1,'2018-06-14 00:00:00'),(1,4,1,2,'Reportes','fa fa-line-chart','getViewReportes','1',1,1,'2018-06-14 00:00:00'),(1,5,1,1,'Caja','fa fa-calculator','getViewCaja','1',1,1,'2018-06-14 00:00:00'),(1,6,1,5,'Indicadores','fa fa-area-chart','getViewIndicadores','1',2,1,'2018-06-14 00:00:00'),(1,7,1,6,'Contabilidad','fa fa-dollar','getViewContabilidad','1',2,1,'2018-06-14 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,1,'1',1,65.00,100.00,1,0.00,0.00,2,1,'2018-07-20 22:43:59',1,'2018-07-25 22:43:59'),(2,3,'1',1,110.00,200.00,1,0.00,0.00,1,1,'2018-07-23 22:30:42',NULL,NULL),(3,10,'1',1,65.00,100.00,1,0.00,0.00,1,1,'2018-07-24 00:06:35',NULL,NULL),(4,11,'1',1,70.00,70.00,1,0.00,0.00,1,1,'2018-07-24 00:08:13',NULL,NULL),(5,12,'1',1,65.00,100.00,1,0.00,0.00,1,1,'2018-07-24 10:50:11',NULL,NULL),(6,9,'1',1,260.00,300.00,1,0.00,0.00,1,1,'2018-07-24 11:05:52',NULL,NULL),(7,13,'1',1,130.00,150.00,1,0.00,0.00,1,1,'2018-07-24 13:07:43',NULL,NULL),(8,14,'1',1,35.00,50.00,1,0.00,0.00,1,1,'2018-07-24 17:56:41',NULL,NULL),(9,15,'1',1,50.00,50.00,1,0.00,0.00,1,1,'2018-07-25 22:44:29',NULL,NULL),(10,8,'1',1,50.00,100.00,1,0.00,0.00,1,1,'2018-07-25 22:48:17',NULL,NULL),(11,7,'1',1,85.00,100.00,1,0.00,0.00,1,1,'2018-08-04 00:49:19',NULL,NULL),(12,6,'1',1,60.00,100.00,1,0.00,0.00,1,1,'2018-08-04 00:49:35',NULL,NULL),(13,5,'1',1,55.00,100.00,1,0.00,0.00,1,1,'2018-08-04 00:50:29',NULL,NULL),(14,4,'1',1,50.00,100.00,1,0.00,0.00,1,1,'2018-08-04 00:50:41',NULL,NULL),(15,2,'1',1,60.00,100.00,1,0.00,0.00,1,1,'2018-08-04 00:51:09',NULL,NULL),(16,20,'1',1,115.00,200.00,1,0.00,0.00,1,1,'2018-08-05 23:30:17',NULL,NULL),(17,23,'1',1,30.00,100.00,1,0.00,0.00,1,1,'2018-08-06 17:42:42',NULL,NULL),(18,26,'1',1,50.00,100.00,1,0.00,0.00,1,1,'2018-08-07 23:49:02',NULL,NULL);
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
  `folio` int(11) NOT NULL DEFAULT '0',
  `idcliente` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `adomicilio` smallint(1) NOT NULL,
  `costo_domicilio` decimal(18,2) DEFAULT '0.00',
  `direccion` text,
  `idestatus` int(11) NOT NULL,
  `idusuario_alta` int(11) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `idusuario_cancela` int(11) DEFAULT NULL,
  `FechaCancelacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idpedido`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,0,1,1,0,0.00,NULL,2,1,'2018-07-20 22:43:55',NULL,NULL),(2,0,1,1,0,0.00,NULL,2,1,'2018-07-23 22:17:57',NULL,NULL),(3,0,5,1,0,0.00,NULL,2,1,'2018-07-23 22:30:39',NULL,NULL),(4,0,1,1,0,0.00,NULL,2,1,'2018-07-23 22:44:41',NULL,NULL),(5,0,1,1,0,0.00,NULL,2,1,'2018-07-23 22:45:33',NULL,NULL),(6,0,2,1,0,0.00,NULL,2,1,'2018-07-23 22:47:52',NULL,NULL),(7,0,2,1,0,0.00,NULL,2,1,'2018-07-23 22:57:51',NULL,NULL),(8,0,2,1,1,15.00,'Francionamient # 1',2,1,'2018-07-23 23:00:17',NULL,NULL),(9,0,2,1,1,30.00,'Francionamient # 1\r \r en dpto 4 Francionamient # 1',2,1,'2018-07-23 23:27:08',NULL,NULL),(10,0,1,1,0,0.00,'',2,1,'2018-07-24 00:06:31',NULL,NULL),(11,0,1,1,0,0.00,'',2,1,'2018-07-24 00:08:02',NULL,NULL),(12,0,2,1,1,15.00,'Francionamient # 1',2,1,'2018-07-24 10:49:52',NULL,NULL),(13,0,2,1,1,10.00,'Francionamient # 1',2,1,'2018-07-24 13:07:33',NULL,NULL),(14,0,1,1,0,0.00,'',2,1,'2018-07-24 17:56:38',NULL,NULL),(15,0,1,1,0,0.00,'',2,1,'2018-07-25 22:44:09',NULL,NULL),(16,0,2,1,0,0.00,'Francionamient # 1',3,1,'2018-08-04 00:52:14',1,'2018-08-06 11:00:08'),(17,0,1,1,0,0.00,'',3,1,'2018-08-04 01:24:17',1,'2018-08-06 10:59:42'),(18,0,2,1,1,10.00,'Francionamient # 1',3,1,'2018-08-04 01:51:14',1,'2018-08-06 10:58:49'),(19,0,2,1,1,10.00,'Francionamient # 1',3,1,'2018-08-04 02:52:26',1,'2018-08-06 10:59:45'),(20,0,1,1,0,0.00,'',2,1,'2018-08-05 23:29:44',NULL,NULL),(21,0,1,1,0,0.00,'',3,1,'2018-08-06 10:38:41',1,'2018-08-06 10:38:46'),(22,0,1,1,0,0.00,'',3,1,'2018-08-06 17:38:10',1,'2018-08-06 17:38:22'),(23,0,1,1,0,0.00,'',2,1,'2018-08-06 17:41:25',NULL,NULL),(24,0,1,1,0,0.00,'',3,1,'2018-08-07 20:50:22',1,'2018-08-07 20:50:50'),(25,0,1,1,0,0.00,'',3,1,'2018-08-07 20:51:04',1,'2018-08-07 23:21:59'),(26,0,1,1,0,0.00,'',2,1,'2018-08-07 23:48:59',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (1,'Coca',1,1,3,5,4,15.00,7.00,'9.jpg',1,1,'2018-07-18 00:40:24',1,'2018-07-18 00:40:55'),(2,'Agua',1,1,3,5,6,15.00,7.00,'10.png',1,1,'2018-07-18 00:40:43',1,'2018-07-18 00:40:43'),(3,'Tacos de Trompo',2,5,1,1,1,45.00,0.00,'5.png',1,1,'2018-07-18 00:41:46',1,'2018-07-18 00:41:46'),(4,'Orden de Caprichos',2,5,1,1,2,60.00,0.00,'caprichos.jpg',1,1,'2018-07-18 00:42:46',1,'2018-07-18 00:42:46'),(5,'Tacos de Bisteck',2,5,1,1,2,45.00,0.00,'bisteck.jpg',1,1,'2018-07-18 00:43:06',1,'2018-07-18 00:43:06'),(6,'Tacos Piratitas',2,5,1,1,2,60.00,0.00,'piratitas.jpg',1,1,'2018-07-18 00:44:01',1,'2018-07-18 00:44:01'),(7,'Gringa CH',1,1,1,1,1,30.00,0.00,'grincaCH.jpg',1,1,'2018-07-18 00:45:06',1,'2018-07-18 00:47:56'),(8,'Pirata CH',1,1,1,1,2,35.00,0.00,'pirataCH.jpg',1,1,'2018-07-18 00:45:32',1,'2018-07-18 00:48:04'),(9,'Campechana CH',1,1,1,1,2,30.00,0.00,'campechana.jpg',1,1,'2018-07-18 00:45:55',1,'2018-07-18 00:48:12'),(10,'Taco Suelto',1,1,2,1,2,11.00,0.00,'taco_suelto.jpg',1,1,'2018-07-18 00:47:15',1,'2018-07-18 00:47:15'),(11,'Taco con Queso',1,1,2,1,2,13.00,0.00,'taco_sueltoqueso.png',1,1,'2018-07-18 00:47:40',1,'2018-07-18 00:47:40'),(12,'Gringa Grande',1,1,1,1,1,50.00,0.00,'grincaCH.jpg',1,1,'2018-07-18 00:49:04',1,'2018-07-18 00:49:04'),(13,'Campechana',1,1,1,1,2,50.00,0.00,'campechana.jpg',1,1,'2018-07-18 00:49:31',1,'2018-07-18 00:49:31'),(14,'Pirata Grande',1,1,1,1,2,80.00,0.00,'pirataCH.jpg',1,1,'2018-07-18 00:49:54',1,'2018-07-18 00:49:54'),(15,'Frijoles Chicos',1,1,1,4,2,15.00,0.00,'frijoles.jpg',1,1,'2018-07-18 00:51:08',1,'2018-07-18 00:51:08'),(16,'Frijoles Medianos',1,1,1,4,2,25.00,0.00,'frijoles.jpg',1,1,'2018-07-18 00:51:34',1,'2018-07-18 00:51:34'),(17,'Frijoles Grandes',1,1,1,4,2,50.00,0.00,'frijoles.jpg',1,1,'2018-07-18 00:52:10',1,'2018-07-18 00:52:10'),(18,'Frijoles Preparados X3 Chicos',1,1,1,4,2,25.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:00:38',1,'2018-07-18 01:00:38'),(19,'Frijoles Preparados X3 Medianos',1,1,1,4,2,40.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:01:05',1,'2018-07-18 01:01:05'),(20,'Frijoles Preparados X3 Grande',1,1,1,4,2,70.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:02:01',1,'2018-07-18 01:02:01'),(21,'Frijoles Especiales X2 Chicos',1,1,1,4,2,27.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:03:05',1,'2018-07-18 01:03:05'),(22,'Frijoles Especiales X2 Medianos',1,1,1,4,2,50.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:03:32',1,'2018-07-18 01:03:32'),(23,'Frijoles Especiales X2 Grande',1,1,1,4,2,80.00,0.00,'frijoles_preparados.jpg',1,1,'2018-07-18 01:04:28',1,'2018-07-18 01:04:28'),(24,'Orde de Papas',2,1,2,3,2,45.00,0.00,'papagaleana.jpg',1,1,'2018-07-18 01:05:18',1,'2018-07-18 01:05:18'),(25,'Media Orden de Papas',1,1,2,3,2,25.00,0.00,'papagaleana.jpg',1,1,'2018-07-18 01:05:47',1,'2018-07-18 01:05:47'),(26,'Hamburguesa Sencilla',1,1,1,2,2,35.00,0.00,'4.png',1,1,'2018-07-18 01:06:30',1,'2018-07-18 01:06:30'),(27,'Hamburguesa Sencilla  Trompo',1,1,1,2,2,45.00,0.00,'hamburguesatrompo.jpg',1,1,'2018-07-18 01:07:08',1,'2018-07-18 01:07:08'),(28,'Hamburguesa Doble',1,1,1,2,2,50.00,0.00,'8.jpg',1,1,'2018-07-18 01:07:28',1,'2018-07-18 01:07:28'),(29,'Hamburguesa Doble con Trompo',1,1,1,2,2,60.00,0.00,'hamburdoble.jpg',1,1,'2018-07-18 01:07:49',1,'2018-07-18 01:07:49'),(30,'Aguacate',1,1,2,6,2,15.00,10.00,'Avocado.jpg',1,1,'2018-07-18 01:08:51',1,'2018-07-18 01:08:51'),(31,'Queso',1,1,2,6,2,15.00,0.00,'queso.jpg',1,1,'2018-07-18 01:09:23',1,'2018-07-18 01:09:23'),(32,'Salsa',1,1,2,6,2,5.00,0.00,'salsa.png',1,1,'2018-07-18 01:09:43',1,'2018-07-18 01:09:43'),(33,'Chile Jalapeño',1,1,2,6,2,3.00,0.00,'chiles.jpg',1,1,'2018-07-18 01:10:00',1,'2018-07-18 01:10:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','','Admin','admin','f3bbc4525270868ca4f5ac22bd9e970b',1,1,'2018-06-14 22:06:33'),(2,'Cajero ','001','Cajero 01','cajero01','a8f2fb61fd0008606f67e50552f19622',1,2,'2018-07-24 22:56:58'),(3,'Mesero ','001','Mesero 01','mesero01','5b41779fe84c0fdd633c321146c94a91',1,4,'2018-07-24 22:57:23');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pedidos'
--

--
-- Dumping routines for database 'pedidos'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_registra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registra`(
In rNombre VARCHAR(65),
IN rApellidos VARCHAR(85),
IN rNickName VARCHAR(45),
IN rUsuario VARCHAR(45),
IN rPassword VARCHAR(255),
IN rIdEstatus INT,
IN ridPerfil INT,
IN RUsuarioAlta INT
)
BEGIN

INSERT INTO usuarios (nombre,apellidos,nickname,usuario,password,idestatus,idperfil,FechaAlta)
VALUES (rNombre,rApellidos,rNickName,rUsuario,rPassword,rIdEstatus,ridPerfil,now()) ;
        
SET @idUser = (SELECT @@identity as id );

CASE ridPerfil 
	WHEN  1 THEN 
    INSERT INTO accesos (idusuario,idModulo,idOpcion,Leer,Crear,Actualizar,Borrar,Reportes,Importar,Exportar,idusuario_alta,FechaRegistro) 
    VALUES 
        (@idUser,1,1,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,2,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,3,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,4,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,5,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,6,1,1,1,1,1,1,1,RUsuarioAlta,now()),
        (@idUser,1,7,1,1,1,1,1,1,1,RUsuarioAlta,now());
    ELSE 
		INSERT INTO accesos (idusuario,idModulo,idOpcion,Leer,Crear,Actualizar,Borrar,Reportes,Importar,Exportar,idusuario_alta,FechaRegistro) VALUES 
        (@idUser,1,5,1,1,1,1,1,1,1,RUsuarioAlta,now());
END CASE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-08  7:40:32
