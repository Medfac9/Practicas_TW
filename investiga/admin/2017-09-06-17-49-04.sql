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
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (2,3,'2017-08-26 10:58:41','Nuevo Miembro Creado - ID: 41'),(3,3,'2017-08-26 10:59:12','Miembro Editado - ID: 41'),(4,3,'2017-08-26 10:59:47','Nuevo Proyecto Creado - ID: 11'),(5,3,'2017-08-26 10:59:57','Proyecto Editado - ID: 11'),(6,3,'2017-08-26 11:00:41','Nueva PublicaciÃ³n Creada - ID: 2'),(7,3,'2017-08-26 11:01:14','PublicaciÃ³n Editada - ID: 2'),(8,3,'2017-08-26 11:50:49','Nuevo Miembro Creado - ID: 42'),(9,3,'2017-08-26 11:51:10','Miembro Borrado - ID: '),(10,3,'2017-08-26 11:52:10','Nuevo Miembro Creado - ID: 43'),(11,3,'2017-08-26 11:52:16','Miembro Borrado - ID: '),(12,3,'2017-08-26 11:57:26','Nuevo Miembro Creado - ID: 44'),(13,3,'2017-08-26 11:57:33','Miembro Borrado - ID: 44'),(14,3,'2017-08-26 11:58:37','Nuevo Proyecto Creado - ID: 12'),(15,3,'2017-08-26 11:58:43','Proyecto Borrado - ID: 12'),(16,3,'2017-08-26 16:06:46','Nueva PublicaciÃ³n Creada - ID: <br />\r\n<b>Notice</b>:  Undefined variable: idPublicacion in <b>/home/alumnos/1617sep/ramefa1617sep/public_html/investiga/publicaciones/formulario.php</b> on line <b>176</b><br />\r\n'),(17,3,'2017-08-26 16:07:42','Nueva PublicaciÃ³n Creada - ID: <br />\r\n<b>Notice</b>:  Undefined variable: idPublicacion in <b>/home/alumnos/1617sep/ramefa1617sep/public_html/investiga/publicaciones/formulario.php</b> on line <b>178</b><br />\r\n'),(18,3,'2017-08-26 16:10:51','Nueva PublicaciÃ³n Creada - ID: 3'),(19,3,'2017-08-26 16:16:05','PublicaciÃ³n Editada - ID: 3'),(20,3,'2017-08-26 16:16:12','PublicaciÃ³n Editada - ID: 3'),(21,3,'2017-08-26 16:18:01','PublicaciÃ³n Editada - ID: 3'),(22,3,'2017-08-26 16:20:49','PublicaciÃ³n Editada - ID: 3'),(23,3,'2017-08-26 16:21:28','PublicaciÃ³n Editada - ID: 3'),(24,3,'2017-08-26 16:21:43','PublicaciÃ³n Editada - ID: 3'),(25,3,'2017-08-26 16:22:07','PublicaciÃ³n Editada - ID: 3'),(26,3,'2017-08-26 16:23:35','PublicaciÃ³n Editada - ID: 3'),(27,3,'2017-08-26 16:24:29','PublicaciÃ³n Editada - ID: 3'),(28,3,'2017-08-26 16:31:13','PublicaciÃ³n Editada - ID: 1'),(29,3,'2017-08-26 16:32:03','PublicaciÃ³n Editada - ID: 1'),(30,3,'2017-08-27 14:28:46','Nuevo Miembro Creado - ID: 45'),(31,3,'2017-08-28 10:01:42','Nueva PublicaciÃ³n Creada - ID: 4'),(32,3,'2017-08-28 10:19:53','Nueva PublicaciÃ³n Creada - ID: q'),(33,3,'2017-08-28 10:24:39','Proyecto Borrado - TÃ­tulo: '),(34,3,'2017-08-28 10:26:17','Proyecto Borrado - TÃ­tulo: '),(35,3,'2017-08-28 10:26:23','Proyecto Borrado - TÃ­tulo: '),(36,3,'2017-08-29 09:49:19','Nueva PublicaciÃ³n Creada - ID: 6'),(37,3,'2017-08-29 10:05:51','Nuevo Miembro Creado - ID: 46'),(38,3,'2017-08-29 10:06:46','Nuevo Miembro Creado - ID: 47'),(39,3,'2017-08-29 10:07:42','Nuevo Miembro Creado - ID: 48'),(40,3,'2017-08-29 10:08:58','Nuevo Miembro Creado - ID: 49'),(41,3,'2017-08-29 10:09:08','Nuevo Miembro Creado - ID: 50'),(42,3,'2017-08-29 10:10:33','Nuevo Miembro Creado - ID: 51'),(43,3,'2017-08-29 10:22:43','Nuevo Proyecto Creado - ID: 13'),(44,3,'2017-08-29 10:23:09','Nuevo Proyecto Creado - ID: 14'),(45,3,'2017-08-29 10:25:42','Nueva PublicaciÃ³n Creada - ID: 7'),(46,52,'2017-08-30 09:22:40','Nuevo Miembro Creado - ID: 53'),(47,53,'2017-08-30 09:24:51','Nuevo Miembro Creado - ID: 54'),(48,53,'2017-08-30 09:26:30','Nuevo Miembro Creado - ID: 55'),(49,53,'2017-08-30 09:28:31','Nuevo Miembro Creado - ID: 56'),(50,53,'2017-08-30 10:24:40','Nuevo Proyecto Creado - ID: 15'),(51,53,'2017-08-30 10:28:49','Proyecto Borrado - ID: 15'),(52,53,'2017-08-30 10:29:55','Nuevo Proyecto Creado - ID: 16'),(53,53,'2017-08-30 10:30:24','Proyecto Editado - ID: 16'),(54,53,'2017-08-30 10:32:18','Proyecto Borrado - ID: 16'),(55,53,'2017-08-30 10:32:49','Nuevo Proyecto Creado - ID: 17'),(56,53,'2017-08-30 10:34:06','Proyecto Borrado - ID: 17'),(57,53,'2017-08-30 10:35:11','Nuevo Proyecto Creado - ID: 18'),(58,53,'2017-08-30 10:48:20','Nueva PublicaciÃ³n Creada - ID: 8'),(59,53,'2017-08-30 10:48:39','PublicaciÃ³n Borrada - ID: 8'),(60,53,'2017-08-30 10:51:09','Proyecto Borrado - ID: 18'),(61,53,'2017-08-30 10:51:21','Nuevo Proyecto Creado - ID: 19'),(62,53,'2017-08-30 10:59:19','Proyecto Borrado - ID: 19'),(63,53,'2017-08-30 11:00:16','Nuevo Proyecto Creado - ID: 20'),(64,53,'2017-08-30 11:00:33','Proyecto Borrado - ID: 20'),(65,53,'2017-08-30 11:13:51','Nuevo Proyecto Creado - ID: 21'),(66,53,'2017-08-30 11:13:58','Proyecto Editado - ID: 21'),(67,53,'2017-08-30 11:14:06','Proyecto Editado - ID: 21'),(68,53,'2017-08-30 11:16:37','Proyecto Borrado - ID: 21'),(69,53,'2017-08-30 11:16:53','Nuevo Proyecto Creado - ID: 22'),(70,53,'2017-08-30 11:19:55','Proyecto Borrado - ID: 22'),(71,53,'2017-08-30 11:20:13','Nuevo Proyecto Creado - ID: 23'),(72,53,'2017-08-30 11:23:59','Proyecto Borrado - ID: 23'),(73,53,'2017-08-30 11:24:19','Nuevo Proyecto Creado - ID: 24'),(74,53,'2017-08-30 11:24:50','Proyecto Editado - ID: 24'),(75,53,'2017-08-30 11:24:57','Proyecto Editado - ID: 24'),(76,53,'2017-08-30 11:26:39','Proyecto Borrado - ID: 24'),(77,53,'2017-08-30 11:26:55','Nuevo Proyecto Creado - ID: 25'),(78,53,'2017-08-30 11:27:59','Nuevo Proyecto Creado - ID: 26'),(79,53,'2017-08-30 11:28:22','Nuevo Proyecto Creado - ID: 27'),(80,53,'2017-08-30 11:28:33','Proyecto Borrado - ID: 25'),(81,53,'2017-08-30 11:28:35','Proyecto Borrado - ID: 26'),(82,53,'2017-08-30 11:30:19','Proyecto Borrado - ID: 27'),(83,53,'2017-08-30 11:30:32','Nuevo Proyecto Creado - ID: 28'),(84,53,'2017-08-30 11:32:22','Proyecto Borrado - ID: 28'),(85,53,'2017-08-30 11:32:35','Nuevo Proyecto Creado - ID: 29'),(86,53,'2017-08-30 11:32:57','Proyecto Borrado - ID: 29'),(87,53,'2017-08-30 11:34:30','Nuevo Proyecto Creado - ID: 30'),(88,53,'2017-08-30 11:36:10','Nuevo Proyecto Creado - ID: 31'),(89,53,'2017-08-30 11:38:03','Nuevo Proyecto Creado - ID: 32'),(90,53,'2017-08-30 11:43:26','Nueva PublicaciÃ³n Creada - ID: 9'),(91,53,'2017-08-30 11:46:26','Nueva PublicaciÃ³n Creada - ID: 10'),(92,53,'2017-08-30 11:46:47','PublicaciÃ³n Editada - ID: 10'),(93,53,'2017-08-30 11:49:50','Nueva PublicaciÃ³n Creada - ID: 11'),(94,53,'2017-08-30 11:52:33','Nueva PublicaciÃ³n Creada - ID: 12'),(95,53,'2017-09-01 09:23:09','Nuevo Miembro Creado - ID: 57'),(96,53,'2017-09-01 09:23:32','Nuevo Proyecto Creado - ID: 33'),(97,53,'2017-09-01 09:23:47','Proyecto Editado - ID: 33'),(98,53,'2017-09-01 09:23:54','Miembro Borrado - ID: 57'),(99,53,'2017-09-01 09:24:11','Proyecto Borrado - ID: 33'),(100,53,'2017-09-01 09:32:40','Nuevo Miembro Creado - ID: 58'),(101,53,'2017-09-01 09:32:56','Miembro Borrado - ID: 58'),(102,53,'2017-09-01 09:35:15','Nuevo Miembro Creado - ID: 59'),(103,53,'2017-09-01 09:35:21','Miembro Borrado - ID: 59'),(104,53,'2017-09-01 09:54:08','Nuevo Miembro Creado - ID: 60'),(105,53,'2017-09-01 09:54:13','Miembro Borrado - ID: 60'),(106,53,'2017-09-02 15:08:58','Nuevo Miembro Creado - ID: 61'),(107,53,'2017-09-02 15:14:12','Nuevo Miembro Creado - ID: 62'),(108,53,'2017-09-02 15:14:20','Miembro Borrado - ID: 61'),(109,53,'2017-09-02 15:14:22','Miembro Borrado - ID: 62'),(110,53,'2017-09-02 15:14:30','Nuevo Miembro Creado - ID: 63'),(111,53,'2017-09-02 15:33:02','Nuevo Miembro Creado - ID: 64'),(112,53,'2017-09-02 15:34:02','Miembro Borrado - ID: 63'),(113,53,'2017-09-02 15:34:09','Miembro Borrado - ID: 64'),(114,53,'2017-09-02 17:41:42','Nuevo Miembro Creado - ID: 65'),(115,53,'2017-09-02 18:58:56','Nuevo Miembro Creado - ID: 66'),(116,53,'2017-09-02 18:59:17','PublicaciÃ³n Editada - ID: 12'),(117,53,'2017-09-03 09:51:36','Nuevo Proyecto Creado - ID: 34'),(118,53,'2017-09-03 10:07:32','Nueva PublicaciÃ³n Creada - ID: 13'),(119,53,'2017-09-03 10:15:54','Proyecto Editado - ID: 34'),(120,53,'2017-09-03 10:52:51','Nuevo Miembro Creado - ID: 67'),(121,53,'2017-09-03 10:53:19','PublicaciÃ³n Editada - ID: 13'),(122,53,'2017-09-03 11:17:37','PublicaciÃ³n Borrada - ID: 13'),(123,53,'2017-09-03 11:18:12','Nueva PublicaciÃ³n Creada - ID: 14'),(124,53,'2017-09-03 11:20:45','Nueva PublicaciÃ³n Creada - ID: 15'),(125,53,'2017-09-03 11:23:41','Nueva PublicaciÃ³n Creada - ID: 16'),(126,53,'2017-09-03 13:49:58','Nuevo Proyecto Creado - ID: 35'),(127,53,'2017-09-03 13:53:09','Nuevo Miembro Creado - ID: 68'),(128,53,'2017-09-03 15:08:13','Nuevo Miembro Creado - ID: 70'),(129,53,'2017-09-03 15:10:18','Nuevo Miembro Creado - ID: 71'),(130,53,'2017-09-03 15:10:25','Miembro Borrado - ID: '),(131,53,'2017-09-03 15:11:38','Nuevo Miembro Creado - ID: 72'),(132,53,'2017-09-03 15:11:44','Miembro Borrado - ID: 72'),(133,53,'2017-09-05 07:48:17','PublicaciÃ³n Editada - ID: 12'),(134,53,'2017-09-05 07:55:55','Miembro Borrado - ID: 1'),(135,53,'2017-09-05 08:33:35','Miembro Editado - ID: 54'),(136,53,'2017-09-05 18:55:30','PublicaciÃ³n Editada - ID: 11'),(137,53,'2017-09-05 18:56:23','PublicaciÃ³n Editada - ID: 11'),(138,53,'2017-09-05 18:58:55','PublicaciÃ³n Editada - ID: 12'),(139,53,'2017-09-05 18:59:20','PublicaciÃ³n Editada - ID: 11'),(140,53,'2017-09-05 19:01:45','PublicaciÃ³n Editada - ID: 12'),(141,53,'2017-09-05 19:06:47','PublicaciÃ³n Editada - ID: 12'),(142,53,'2017-09-05 19:07:19','PublicaciÃ³n Editada - ID: 12'),(143,53,'2017-09-05 19:09:53','PublicaciÃ³n Editada - ID: 12'),(144,53,'2017-09-05 19:15:46','PublicaciÃ³n Editada - ID: 11'),(145,53,'2017-09-05 19:16:59','PublicaciÃ³n Editada - ID: 11'),(146,53,'2017-09-05 19:17:14','PublicaciÃ³n Editada - ID: 11'),(147,53,'2017-09-05 19:18:43','PublicaciÃ³n Editada - ID: 11'),(148,53,'2017-09-05 19:18:53','PublicaciÃ³n Editada - ID: 11'),(149,53,'2017-09-05 19:19:03','PublicaciÃ³n Editada - ID: 11'),(150,53,'2017-09-06 09:39:25','PublicaciÃ³n Editada - ID: 12'),(151,53,'2017-09-06 09:39:33','PublicaciÃ³n Editada - ID: 11'),(152,53,'2017-09-06 09:40:05','PublicaciÃ³n Editada - ID: 9'),(153,53,'2017-09-06 09:40:48','PublicaciÃ³n Editada - ID: 10'),(154,53,'2017-09-06 09:43:10','PublicaciÃ³n Editada - ID: 9'),(155,53,'2017-09-06 09:43:20','PublicaciÃ³n Editada - ID: 9'),(156,53,'2017-09-06 10:22:01','Proyecto Editado - ID: 31'),(157,53,'2017-09-06 10:22:29','Proyecto Editado - ID: 31'),(158,53,'2017-09-06 10:22:46','Proyecto Editado - ID: 31'),(159,53,'2017-09-06 10:22:53','Proyecto Editado - ID: 31'),(160,53,'2017-09-06 10:23:06','Proyecto Editado - ID: 31'),(161,53,'2017-09-06 10:26:54','Proyecto Editado - ID: 31'),(162,53,'2017-09-06 10:27:10','Proyecto Editado - ID: 31'),(163,53,'2017-09-06 10:29:45','Proyecto Editado - ID: 31'),(164,53,'2017-09-06 10:30:06','Proyecto Editado - ID: 31'),(165,53,'2017-09-06 10:32:41','Proyecto Editado - ID: 31'),(166,53,'2017-09-06 10:32:52','Proyecto Editado - ID: 31'),(167,53,'2017-09-06 10:36:19','Proyecto Editado - ID: 31'),(168,53,'2017-09-06 10:36:23','Proyecto Editado - ID: 31'),(169,53,'2017-09-06 10:36:52','Proyecto Editado - ID: 31'),(170,53,'2017-09-06 10:37:04','Proyecto Editado - ID: 31'),(171,53,'2017-09-06 10:38:12','Proyecto Editado - ID: 31'),(172,53,'2017-09-06 10:38:25','Proyecto Editado - ID: 31'),(173,53,'2017-09-06 10:39:10','Proyecto Editado - ID: 32'),(174,53,'2017-09-06 10:44:16','Proyecto Editado - ID: 31'),(175,53,'2017-09-06 10:45:04','Proyecto Editado - ID: 31'),(176,53,'2017-09-06 10:54:50','Proyecto Editado - ID: 31'),(177,53,'2017-09-06 10:55:31','Proyecto Editado - ID: 31'),(178,53,'2017-09-06 10:55:33','Proyecto Editado - ID: 31'),(179,53,'2017-09-06 10:56:00','Proyecto Editado - ID: 31'),(180,53,'2017-09-06 10:59:08','Proyecto Editado - ID: 31'),(181,53,'2017-09-06 11:03:10','Proyecto Editado - ID: 31'),(182,53,'2017-09-06 11:03:27','Proyecto Editado - ID: 31'),(183,53,'2017-09-06 11:18:46','Proyecto Editado - ID: 31'),(184,53,'2017-09-06 13:52:49','Proyecto Editado - ID: 31'),(185,53,'2017-09-06 13:56:16','Proyecto Editado - ID: 31'),(186,53,'2017-09-06 14:03:25','Proyecto Editado - ID: 31'),(187,53,'2017-09-06 14:04:09','Proyecto Editado - ID: 31'),(188,53,'2017-09-06 14:04:22','Proyecto Editado - ID: 31'),(189,53,'2017-09-06 14:06:51','Proyecto Editado - ID: 31'),(190,53,'2017-09-06 14:14:37','Proyecto Editado - ID: 32'),(191,53,'2017-09-06 14:14:52','Proyecto Editado - ID: 32'),(192,53,'2017-09-06 14:15:16','Proyecto Editado - ID: 32'),(193,53,'2017-09-06 14:17:06','Proyecto Editado - ID: 31'),(194,53,'2017-09-06 14:19:18','Proyecto Editado - ID: 31'),(195,53,'2017-09-06 14:20:29','Proyecto Editado - ID: 31'),(196,53,'2017-09-06 14:22:22','Proyecto Editado - ID: 31'),(197,53,'2017-09-06 14:25:53','Proyecto Editado - ID: 31'),(198,53,'2017-09-06 14:26:49','Proyecto Editado - ID: 31'),(199,53,'2017-09-06 14:27:04','Proyecto Editado - ID: 31'),(200,53,'2017-09-06 14:28:04','Proyecto Editado - ID: 31'),(201,53,'2017-09-06 14:28:11','Proyecto Editado - ID: 31'),(202,53,'2017-09-06 14:31:07','Proyecto Editado - ID: 31'),(203,53,'2017-09-06 14:32:06','Nuevo Proyecto Creado - ID: 33'),(204,53,'2017-09-06 14:35:41','Proyecto Editado - ID: 33'),(205,53,'2017-09-06 14:36:01','Proyecto Editado - ID: 33'),(206,53,'2017-09-06 14:36:16','Proyecto Editado - ID: 33'),(207,53,'2017-09-06 14:36:32','Proyecto Editado - ID: 33'),(208,53,'2017-09-06 14:37:21','Proyecto Editado - ID: 33'),(209,53,'2017-09-06 14:40:53','Proyecto Editado - ID: 33'),(210,53,'2017-09-06 14:41:23','Proyecto Editado - ID: 33'),(211,53,'2017-09-06 14:52:38','Proyecto Editado - ID: 31'),(212,53,'2017-09-06 14:54:49','Proyecto Editado - ID: 31'),(213,53,'2017-09-06 14:56:47','Proyecto Editado - ID: 31'),(214,53,'2017-09-06 15:14:57','Proyecto Editado - ID: 31'),(215,53,'2017-09-06 15:16:09','Proyecto Borrado - ID: 33'),(216,53,'2017-09-06 15:17:21','Nuevo Proyecto Creado - ID: 34'),(217,53,'2017-09-06 15:18:06','Proyecto Editado - ID: 32'),(218,53,'2017-09-06 15:18:35','Proyecto Editado - ID: 34'),(219,53,'2017-09-06 15:18:51','Proyecto Editado - ID: 34'),(220,53,'2017-09-06 15:24:14','Proyecto Editado - ID: 34'),(221,53,'2017-09-06 15:26:00','Nuevo Proyecto Creado - ID: 35'),(222,53,'2017-09-06 15:26:09','Proyecto Editado - ID: 35'),(223,53,'2017-09-06 15:26:55','Proyecto Borrado - ID: 34'),(224,53,'2017-09-06 15:26:59','Proyecto Borrado - ID: 35'),(225,53,'2017-09-06 15:27:35','Nuevo Proyecto Creado - ID: 36'),(226,53,'2017-09-06 15:27:54','Proyecto Borrado - ID: 36'),(227,53,'2017-09-06 15:29:10','Nuevo Proyecto Creado - ID: 37'),(228,53,'2017-09-06 15:34:40','Proyecto Borrado - ID: 37'),(229,53,'2017-09-06 15:34:59','Nuevo Proyecto Creado - ID: 38'),(230,53,'2017-09-06 15:43:19','Proyecto Borrado - ID: 38'),(231,53,'2017-09-06 15:43:35','Nuevo Proyecto Creado - ID: 39'),(232,53,'2017-09-06 15:44:08','Nuevo Proyecto Creado - ID: 40'),(233,53,'2017-09-06 15:44:13','Nuevo Proyecto Creado - ID: 41'),(234,53,'2017-09-06 15:45:38','Nuevo Proyecto Creado - ID: 42'),(235,53,'2017-09-06 15:45:49','Nuevo Proyecto Creado - ID: 43'),(236,53,'2017-09-06 15:46:00','Nuevo Proyecto Creado - ID: 44'),(237,53,'2017-09-06 15:46:23','Proyecto Borrado - ID: 39'),(238,53,'2017-09-06 15:46:26','Proyecto Borrado - ID: 40'),(239,53,'2017-09-06 15:46:29','Proyecto Borrado - ID: 41'),(240,53,'2017-09-06 15:46:31','Proyecto Borrado - ID: 44'),(241,53,'2017-09-06 15:46:33','Proyecto Borrado - ID: 43'),(242,53,'2017-09-06 15:46:35','Proyecto Borrado - ID: 42'),(243,53,'2017-09-06 15:46:51','Nuevo Proyecto Creado - ID: 45'),(244,53,'2017-09-06 15:47:02','Proyecto Borrado - ID: 45'),(245,53,'2017-09-06 15:47:27','Proyecto Editado - ID: 31');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembro`
--

LOCK TABLES `miembro` WRITE;
/*!40000 ALTER TABLE `miembro` DISABLE KEYS */;
INSERT INTO `miembro` VALUES (2,'Dummy','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,1,0,NULL),(53,'Administrador','del Sistema','Titular',1,'admin@correo.com','35cd2d0d62d9bc5e60a3ca9f7593b05b','123456789','http://www.admin.com','DECSAI','ETSIIT','UGR','Calle falsa nÃºmero 123',3,0,1,'png'),(54,'Usuario','del Sistema','Universitario',0,'usuario@correo.com','35cd2d0d62d9bc5e60a3ca9f7593b05b','123456789','http://www.usuario.com','DECSAI','ETSIIT','UGR','Calle de la golosina',2,0,1,'jpg'),(55,'Rafael','Medina Facal','Universitario',0,'ramefa@hotmail.com','35cd2d0d62d9bc5e60a3ca9f7593b05b','123456789','http://www.rafa.com','DECSAI','ETSIIT','UGR','Calle de mi casa',2,0,1,'jpg'),(56,'Isabel','GarcÃ­a PÃ©rez','Universitario',0,'isabel@correo.com','35cd2d0d62d9bc5e60a3ca9f7593b05b','123456789','http://www.isabel.com','DECSAI','ETSIIT','UGR','Calle Don Quijote',2,0,1,'jpg');
/*!40000 ALTER TABLE `miembro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembrosProyectos`
--

DROP TABLE IF EXISTS `miembrosProyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembrosProyectos` (
  `idMiembro` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembrosProyectos`
--

LOCK TABLES `miembrosProyectos` WRITE;
/*!40000 ALTER TABLE `miembrosProyectos` DISABLE KEYS */;
INSERT INTO `miembrosProyectos` VALUES (2,0,'principal'),(53,0,'colaborador'),(2,33,'principal'),(53,0,'principal'),(54,0,'colaborador'),(55,0,'colaborador'),(53,32,'principal'),(55,32,'colaborador'),(53,34,'principal'),(54,34,'colaborador'),(2,0,'principal'),(2,0,'colaborador'),(2,35,'principal'),(2,35,'colaborador'),(2,0,'principal'),(2,0,'colaborador'),(2,0,'principal'),(2,0,'colaborador'),(2,0,'principal'),(2,0,'colaborador'),(2,44,'principal'),(2,44,'colaborador'),(2,45,'principal'),(2,45,'colaborador'),(56,31,'principal'),(53,31,'principal'),(54,31,'colaborador'),(2,31,'colaborador');
/*!40000 ALTER TABLE `miembrosProyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembrosPublicaciones`
--

DROP TABLE IF EXISTS `miembrosPublicaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembrosPublicaciones` (
  `idMiembro` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  PRIMARY KEY (`idMiembro`,`idPublicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembrosPublicaciones`
--

LOCK TABLES `miembrosPublicaciones` WRITE;
/*!40000 ALTER TABLE `miembrosPublicaciones` DISABLE KEYS */;
INSERT INTO `miembrosPublicaciones` VALUES (53,9),(53,11),(55,10),(55,12);
/*!40000 ALTER TABLE `miembrosPublicaciones` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` VALUES (30,'123','La informÃ¡tica en la nube','Proyecto ficticio creado para comprobar si el sistema funciona correctamente.','2017-04-05','2017-08-01','BBVA',100000,'','','http://www.proyecto1.com'),(31,'456','La informÃ¡tica esa gran desconocida','Hoy en dÃ­a todo el mundo conoce de informÃ¡tica pero eso es realmente cierto','2017-08-01','2017-08-30','La Caixa',10000,'       hola','       adios','http://www.proyecto2.com'),(32,'789','La Inteligencia Artificial la soluciÃ³n a los problemas','Gracias a la rama de la InformÃ¡tica Inteligencia Artificial podremos dar soluciÃ³n a todos nuestros problemas','2017-02-08','2017-08-17','Santander',0,' 0',' adios ','http://www.proyecto3.com');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacion`
--

LOCK TABLES `publicacion` WRITE;
/*!40000 ALTER TABLE `publicacion` DISABLE KEYS */;
INSERT INTO `publicacion` VALUES (9,'articulo',12345,'La nube','a:2:{i:0;s:2:\"55\";i:1;s:2:\"56\";}','2017-08-08','   La nube almacena grandes cantidades de archivos','    nube, informatica, seguro','http://www.publicacion1.com',31,'La informÃ¡tica','2',10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'    Sergio LÃ³pez LÃ³pez y RamÃ³n GarcÃ­a PÃ©rez, Dummy Test'),(10,'libro',67890,'Conocemos la informÃ¡tica','a:1:{i:0;s:2:\"55\";}','2017-08-03','   Hoy en dÃ­a todo el mundo sabe o conoce sobre la informÃ¡tica','   informatica, conocer, desconocida','http://www.publicacion2.com',30,NULL,NULL,NULL,'EdebÃ©','Rafael Medina Facal','123456789',NULL,NULL,NULL,NULL,'   Fracisco GutiÃ©rrez, Dummy Test'),(11,'capitulo',45678,'La Inteligencia Artificial','a:2:{i:0;s:2:\"53\";i:1;s:2:\"56\";}','2017-08-11','         Realmente la IA es la soluciÃ³n a todos nuestros problemas','          IA, inteligencia, artificial, problema, informatica','http://www.publicacion3.com',30,NULL,NULL,130,'Anaya','Isable PÃ©rez','23524523','La Inteligencia Artificial',NULL,NULL,NULL,'          Jose Manuel JimÃ©nez, Dummy Test'),(12,'conferencia',98765,'Seguridad en la nube','a:2:{i:0;s:2:\"55\";i:1;s:2:\"56\";}','2017-08-29','  EstÃ¡n nuestros archivos a salvo en la nube','     seguridad, nube, informatica','http://www.publicacion4.com',30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'La nube','ETSIIT','Esto es una reseÃ±a','Dummy Test');
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

-- Dump completed on 2017-09-06 17:49:04
