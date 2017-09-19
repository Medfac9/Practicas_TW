-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: ramefa1617sep
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `miembro` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` longtext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icono` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idPadre` int(11) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Inicio','/index.php','fa fa-home',NULL,1,'HOME'),(2,'Miembros','/miembros','fa fa-users',NULL,2,'MIEMB'),(3,'Publicaciones','/publicaciones','fa fa-newspaper-o',NULL,3,'PUBLI'),(4,'Proyectos','/proyectos','fa fa-bar-chart',NULL,4,'PROYECT'),(5,'Administración','#','fa fa-wrench',NULL,5,'ADMIN'),(6,'Log del sistema','/admin/log.php','fa fa-history',5,6,'ADMINLOG'),(7,'Backup','/admin/backup.php','fa fa-floppy-o',5,7,'ADMINBACK'),(8,'Documentación','/documentacion','fa fa-book',NULL,8,'DOCU');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembro`
--

DROP TABLE IF EXISTS `miembro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembro` (
  `idMiembro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci,
  `director` tinyint(1) DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci,
  `clave` text COLLATE utf8_spanish_ci,
  `telefono` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` text COLLATE utf8_spanish_ci,
  `departamento` text COLLATE utf8_spanish_ci,
  `centro` text COLLATE utf8_spanish_ci,
  `universidad` text COLLATE utf8_spanish_ci,
  `direccion` longtext COLLATE utf8_spanish_ci,
  `rol` int(11) NOT NULL DEFAULT '2',
  `bloqueado` tinyint(1) DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1',
  `formato` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idMiembro`),
  KEY `FK_Miembro_Rol` (`rol`),
  CONSTRAINT `FK_Miembro_Rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembro`
--

LOCK TABLES `miembro` WRITE;
/*!40000 ALTER TABLE `miembro` DISABLE KEYS */;
INSERT INTO `miembro` VALUES (74,'Rafa','',NULL,NULL,'ramefa@hotmail.com','35cd2d0d62d9bc5e60a3ca9f7593b05b',NULL,NULL,NULL,NULL,NULL,NULL,3,0,1,NULL);
/*!40000 ALTER TABLE `miembro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('lectura','escritura','borrado') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'MIEMB','lectura'),(2,'MIEMB','escritura'),(3,'MIEMB','borrado'),(4,'PROYECT','lectura'),(5,'PROYECT','escritura'),(6,'PROYECT','borrado'),(7,'PUBLI','lectura'),(8,'PUBLI','escritura'),(9,'PUBLI','borrado'),(10,'ADMIN','lectura'),(11,'ADMIN','escritura'),(12,'ADMIN','borrado'),(13,'DOCU','lectura'),(14,'ADMINLOG','lectura'),(15,'ADMINBACK','lectura'),(18,'HOME','lectura');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisosRoles`
--

DROP TABLE IF EXISTS `permisosRoles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisosRoles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPermiso` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_permisosRoles_permisos` (`idPermiso`),
  KEY `FK_permisosRoles_roles` (`idRol`),
  CONSTRAINT `FK_permisosRoles_permisos` FOREIGN KEY (`idPermiso`) REFERENCES `permisos` (`idPermiso`),
  CONSTRAINT `FK_permisosRoles_roles` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisosRoles`
--

LOCK TABLES `permisosRoles` WRITE;
/*!40000 ALTER TABLE `permisosRoles` DISABLE KEYS */;
INSERT INTO `permisosRoles` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,3),(5,3,3),(6,4,1),(7,4,2),(8,4,3),(9,5,2),(10,5,3),(11,6,2),(12,6,3),(13,7,1),(14,7,2),(15,7,3),(16,8,2),(17,8,3),(18,9,2),(19,9,3),(20,10,3),(21,11,3),(22,12,3),(23,13,1),(24,13,2),(25,13,3),(26,14,3),(27,15,3),(28,18,1),(29,18,2),(30,18,3);
/*!40000 ALTER TABLE `permisosRoles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `entidad` text COLLATE utf8_spanish_ci,
  `cuantia` int(11) DEFAULT NULL,
  `principal` text COLLATE utf8_spanish_ci,
  `colaborador` text COLLATE utf8_spanish_ci,
  `url` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacion`
--

DROP TABLE IF EXISTS `publicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacion` (
  `idPublicacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('articulo','libro','capitulo','conferencia') COLLATE utf8_spanish_ci NOT NULL,
  `doi` int(11) NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `autor` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `resumen` longtext COLLATE utf8_spanish_ci NOT NULL,
  `palabras` longtext COLLATE utf8_spanish_ci NOT NULL,
  `url` text COLLATE utf8_spanish_ci NOT NULL,
  `proyecto` int(11) NOT NULL,
  `nombre_r` text COLLATE utf8_spanish_ci,
  `volumen` text COLLATE utf8_spanish_ci,
  `paginas` int(11) DEFAULT NULL,
  `editorial` text COLLATE utf8_spanish_ci,
  `editor` text COLLATE utf8_spanish_ci,
  `isbn` text COLLATE utf8_spanish_ci,
  `titulo_l` text COLLATE utf8_spanish_ci,
  `nombre_c` text COLLATE utf8_spanish_ci,
  `lugar` text COLLATE utf8_spanish_ci,
  `resena` text COLLATE utf8_spanish_ci,
  `otro` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idPublicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'invitado'),(2,'usuario'),(3,'admin');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-04 20:55:03
