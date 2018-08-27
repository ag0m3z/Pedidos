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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-11  8:05:09
