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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-11  8:05:09
