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
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (1,1,1,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,2,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,3,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,4,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,5,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,6,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00'),(1,1,7,1,1,1,1,1,1,1,1,'2018-06-14 00:00:00',1,'2018-06-14 00:00:00');
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `catalogos`
--

LOCK TABLES `catalogos` WRITE;
/*!40000 ALTER TABLE `catalogos` DISABLE KEYS */;
INSERT INTO `catalogos` VALUES (0,1,'Catalogo Estatus',0,0,1,'0000-00-00 00:00:00',1),(0,2,'Catalogo Perfiles',0,0,1,'0000-00-00 00:00:00',1),(1,1,'Activo',0,0,1,'0000-00-00 00:00:00',1),(2,1,'Administrador',0,0,1,'0000-00-00 00:00:00',1),(2,2,'Cajero',0,0,1,'0000-00-00 00:00:00',1),(1,2,'Desactivado',0,0,1,'0000-00-00 00:00:00',1),(2,3,'Cocinero',0,0,1,'0000-00-00 00:00:00',1),(2,4,'Mesero',0,0,1,'0000-00-00 00:00:00',1),(2,5,'Gerente',0,0,1,'0000-00-00 00:00:00',1),(0,3,'Catalogo Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,4,'Catalogo Sub Categorias',0,0,1,'0000-00-00 00:00:00',1),(0,5,'Catalogo Unidad Medida',0,0,1,'0000-00-00 00:00:00',1),(3,1,'Tacos',1,0,1,'0000-00-00 00:00:00',1),(3,2,'Hamburguesa',1,0,1,'0000-00-00 00:00:00',1),(3,3,'Papas',1,0,1,'0000-00-00 00:00:00',1),(4,1,'Trompo',1,0,1,'0000-00-00 00:00:00',1),(4,2,'Bisteck',1,0,1,'0000-00-00 00:00:00',1),(4,3,'Arrachera',1,0,1,'0000-00-00 00:00:00',1),(3,4,'Frijoles',1,0,1,'0000-00-00 00:00:00',1),(3,5,'Bebidas',1,0,1,'0000-00-00 00:00:00',1),(3,6,'Otros',1,0,1,'0000-00-00 00:00:00',1),(5,1,'Pieza',0,0,1,'0000-00-00 00:00:00',1),(5,2,'Orden /Paquete',0,0,1,'0000-00-00 00:00:00',1),(4,4,'Refresco',1,0,1,'0000-00-00 00:00:00',1),(4,5,'Refresco Sabor',1,0,1,'0000-00-00 00:00:00',1),(4,6,'Agua Natural',1,0,1,'0000-00-00 00:00:00',1),(0,6,'Catalogo Tipo Platillos',0,0,1,'0000-00-00 00:00:00',1),(6,1,'Platillos o Paquetes',0,0,1,'0000-00-00 00:00:00',1),(6,2,'Extras',0,0,1,'0000-00-00 00:00:00',1),(6,3,'Bebidas',0,0,1,'0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `catalogos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Fernando','','','','',NULL,1,1,'2018-06-19 22:07:37',1,'2018-06-19 22:30:17'),(2,'alejandrino','','','','','',2,1,'2018-06-19 22:11:16',1,'2018-06-28 23:53:01'),(3,'Alejandro','Gomez','','8121530769','','francisco pizarro',2,1,'2018-06-19 22:12:28',1,'2018-06-28 23:53:00'),(4,'Pedro ','luis','','','','porteslda ',2,1,'2018-06-22 23:36:14',1,'2018-06-28 23:52:58'),(5,'Pedro','','','','','',2,1,'2018-06-26 19:57:31',1,'2018-06-28 23:52:55'),(6,'Pedro','','','','','',2,1,'2018-06-26 19:58:56',1,'2018-06-28 23:52:54'),(7,'Pedro','','','','','',2,1,'2018-06-26 19:59:13',1,'2018-06-28 23:52:53'),(8,'Jesus','Mart','','7172871','7172871','',2,1,'2018-06-28 21:27:56',1,'2018-06-28 23:52:53'),(9,'Joel','Muñoz','','8121540865','812154','Francisco Pizarron #116 entre Calle Numero 1 y Calle numero 2',2,1,'2018-06-28 22:56:34',1,'2018-06-28 23:52:49'),(10,'Alejandro','Gomez','','8121530769','8121','Francisco Pizarro # 116 Entre Juarez y Colegio Civil',1,1,'2018-06-28 23:56:06',1,'2018-06-28 23:56:06');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'skin-red-light','sidebar-12.jpg');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_pedido`
--

LOCK TABLES `detalle_pedido` WRITE;
/*!40000 ALTER TABLE `detalle_pedido` DISABLE KEYS */;
INSERT INTO `detalle_pedido` VALUES (1,2,7,45.00,1),(2,2,4,50.00,1),(3,3,7,45.00,1),(4,3,4,50.00,1),(5,4,4,50.00,1),(6,4,7,45.00,1),(7,5,4,50.00,1),(8,5,7,45.00,1),(9,6,4,50.00,1),(10,6,6,45.00,1),(11,6,7,45.00,1),(12,6,4,50.00,1),(13,6,6,45.00,1),(15,7,4,50.00,1),(16,7,8,10.00,1),(17,8,8,10.00,1),(18,8,5,60.00,1);
/*!40000 ALTER TABLE `detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `mesas`
--

LOCK TABLES `mesas` WRITE;
/*!40000 ALTER TABLE `mesas` DISABLE KEYS */;
INSERT INTO `mesas` VALUES (1,'Mesa 1',1,1,'2018-06-18 23:05:16',1,'2018-06-18 23:05:16'),(2,'Mesa 2',1,1,'2018-06-18 23:17:28',1,'2018-06-19 20:19:02');
/*!40000 ALTER TABLE `mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,1,2,1,'Catalogo Usuarios','fa fa-user','getCatalogoUsuarios','1',1,1,'2018-06-14 00:00:00'),(1,2,1,1,'Catalogos','fa fa-list-alt','getCatalogos','1',1,1,'2018-06-14 00:00:00'),(1,3,1,2,'Configuracion','fa fa-gears','getViewConfiguracion','1',1,1,'2018-06-14 00:00:00'),(1,4,1,3,'Reportes','fa fa-line-chart','getViewReportes','1',1,1,'2018-06-14 00:00:00'),(1,5,1,4,'Caja','fa fa-calculator','getViewCaja','1',1,1,'2018-06-14 00:00:00'),(1,6,1,5,'Indicadores','fa fa-area-chart','getViewIndicadores','1',1,1,'2018-06-14 00:00:00'),(1,7,1,6,'Contabilidad','fa fa-dollar','getViewContabilidad','1',1,1,'2018-06-14 00:00:00');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,3,1,1,1,'2018-07-03 00:12:04',NULL),(2,3,1,1,1,'2018-07-03 00:13:09',NULL),(3,3,1,1,1,'2018-07-03 00:13:39',NULL),(4,1,1,1,1,'2018-07-03 08:43:43',NULL),(5,1,1,1,1,'2018-07-03 08:43:51',NULL),(6,1,1,1,1,'2018-07-03 08:53:36',NULL),(7,8,1,1,1,'2018-07-03 18:54:12',NULL),(8,1,1,1,1,'2018-07-03 18:54:45',NULL);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `platillos`
--

LOCK TABLES `platillos` WRITE;
/*!40000 ALTER TABLE `platillos` DISABLE KEYS */;
INSERT INTO `platillos` VALUES (4,'Tacos de Trompo',2,5,1,1,1,50.00,40.00,'4.png',1,1,'2018-06-21 00:00:05',1,'2018-06-23 12:10:39'),(5,'Taco de Bisteck',1,1,2,1,2,60.00,40.00,'5.png',1,1,'2018-06-21 00:39:56',1,'2018-06-21 00:39:56'),(6,'Hamburguesa',1,1,1,2,2,45.00,45.00,'6.png',1,1,'2018-06-21 00:41:52',1,'2018-06-22 20:43:03'),(7,'Hamburguesa',1,1,1,2,2,45.00,30.00,'7.png',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46'),(8,'Refresco',1,1,3,5,4,10.00,7.00,'9.jpg',1,1,'2018-06-23 12:09:46',1,'2018-06-23 12:09:46');
/*!40000 ALTER TABLE `platillos` ENABLE KEYS */;
UNLOCK TABLES;

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

-- Dump completed on 2018-07-03 19:14:12
