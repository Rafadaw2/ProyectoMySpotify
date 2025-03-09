-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: spotifyDB
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cancion`
--

DROP TABLE IF EXISTS `cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genero_id` int DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` int NOT NULL,
  `album` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reproducciones` int NOT NULL,
  `likes` int NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E4620FA0BCE7B795` (`genero_id`),
  CONSTRAINT `FK_E4620FA0BCE7B795` FOREIGN KEY (`genero_id`) REFERENCES `estilo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancion`
--

LOCK TABLES `cancion` WRITE;
/*!40000 ALTER TABLE `cancion` DISABLE KEYS */;
INSERT INTO `cancion` VALUES (1,1,'Violinista en tu tejado',123,'Primero','Melendi',2,4,'Violinista en tu tejado.mp3'),(2,1,'Caminando por la vida',134,'Segundo','Melendi',5,2,'Caminando por la vida.mp3'),(3,2,'So payaso',143,'Duro','Extremoduro',6,3,'So payaso.mp3'),(4,1,'Tu jard├¡n con enanitos',200,'L├ígrimas desordenadas','Melendi',1,1,'Tu jard├¡n con enanitos.mp3'),(5,1,'Barbie de extrarradio',210,'Volvamos a empezar','Melendi',2,2,'Barbie de extrarradio.mp3'),(6,2,'Si te vas',150,'Material defectuoso','Extremoduro',1,1,'Si te vas.mp3');
/*!40000 ALTER TABLE `cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancion_usuario`
--

DROP TABLE IF EXISTS `cancion_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancion_usuario` (
  `cancion_id` int NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`cancion_id`,`usuario_id`),
  KEY `IDX_9240090B9B1D840F` (`cancion_id`),
  KEY `IDX_9240090BDB38439E` (`usuario_id`),
  CONSTRAINT `FK_9240090B9B1D840F` FOREIGN KEY (`cancion_id`) REFERENCES `cancion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9240090BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancion_usuario`
--

LOCK TABLES `cancion_usuario` WRITE;
/*!40000 ALTER TABLE `cancion_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `cancion_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250201165927','2025-02-05 22:24:19',2528),('DoctrineMigrations\\Version20250205221318','2025-02-05 22:24:22',268),('DoctrineMigrations\\Version20250205221837','2025-02-05 22:24:22',10),('DoctrineMigrations\\Version20250205230923','2025-02-05 23:10:15',569),('DoctrineMigrations\\Version20250205233457','2025-02-05 23:35:26',296),('DoctrineMigrations\\Version20250208184114','2025-02-08 18:41:45',411),('DoctrineMigrations\\Version20250215114132','2025-02-15 11:42:12',515),('DoctrineMigrations\\Version20250215192420','2025-02-15 19:27:04',548);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estilo`
--

DROP TABLE IF EXISTS `estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estilo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estilo`
--

LOCK TABLES `estilo` WRITE;
/*!40000 ALTER TABLE `estilo` DISABLE KEYS */;
INSERT INTO `estilo` VALUES (1,'POP','Genero POP'),(2,'ROCK','Genero ROCK');
/*!40000 ALTER TABLE `estilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_estilo`
--

DROP TABLE IF EXISTS `perfil_estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil_estilo` (
  `perfil_id` int NOT NULL,
  `estilo_id` int NOT NULL,
  PRIMARY KEY (`perfil_id`,`estilo_id`),
  KEY `IDX_8C8A3EBE57291544` (`perfil_id`),
  KEY `IDX_8C8A3EBE43798DA7` (`estilo_id`),
  CONSTRAINT `FK_8C8A3EBE43798DA7` FOREIGN KEY (`estilo_id`) REFERENCES `estilo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8C8A3EBE57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_estilo`
--

LOCK TABLES `perfil_estilo` WRITE;
/*!40000 ALTER TABLE `perfil_estilo` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil_estilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `propietario_id` int DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibilidad` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reproducciones` int NOT NULL,
  `likes` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D782112D53C8D32C` (`propietario_id`),
  CONSTRAINT `FK_D782112D53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES (1,NULL,'PlaylistAdmin','Oculta',3,7),(3,NULL,'Mi musica','publica',5,6),(4,NULL,'Rock','Publica',3,3),(5,NULL,'Melendi','publica',2,2),(6,NULL,'PlaylistGus','publica',0,0),(7,3,'La lista','1',0,0),(8,3,'Gustav','1',0,0),(9,3,'Gustav4','1',0,0),(10,3,'Los exitos','1',0,0),(11,3,'Las mejores','1',0,0),(12,2,'Tranquila','1',0,0);
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_cancion`
--

DROP TABLE IF EXISTS `playlist_cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist_cancion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `playlist_id` int DEFAULT NULL,
  `cancion_id` int DEFAULT NULL,
  `repdroducciones` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B5D18BA6BBD148` (`playlist_id`),
  KEY `IDX_5B5D18BA9B1D840F` (`cancion_id`),
  CONSTRAINT `FK_5B5D18BA6BBD148` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  CONSTRAINT `FK_5B5D18BA9B1D840F` FOREIGN KEY (`cancion_id`) REFERENCES `cancion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_cancion`
--

LOCK TABLES `playlist_cancion` WRITE;
/*!40000 ALTER TABLE `playlist_cancion` DISABLE KEYS */;
INSERT INTO `playlist_cancion` VALUES (1,3,1,NULL),(2,3,3,NULL),(3,1,2,NULL),(4,4,3,NULL),(5,4,6,NULL),(6,5,1,NULL),(7,5,2,NULL),(8,5,4,NULL),(9,6,1,NULL),(10,6,3,NULL),(11,7,1,NULL),(12,7,5,NULL),(13,8,3,NULL),(14,8,6,NULL),(15,9,2,NULL),(16,9,3,NULL),(17,9,6,NULL),(18,10,1,NULL),(19,10,2,NULL),(20,10,3,NULL),(21,10,6,NULL),(22,11,1,NULL),(23,11,2,NULL),(24,12,3,NULL);
/*!40000 ALTER TABLE `playlist_cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(365) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  UNIQUE KEY `UNIQ_2265B05D57291544` (`perfil_id`),
  CONSTRAINT `FK_2265B05D57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,NULL,'rafa@gmail.com','$2y$13$Ep18Uj19HRnlenGr3IwkLezIxXQujp4vzMW6x9SaApJlUqy2R7anO','Rafael','1993-05-08','[\"ROLE_ADMIN\"]'),(2,NULL,'joseUser@gmail.com','$2y$13$HLC8Uv9GsMDvVs6lL1uKa.yocRoHFzAV.EMqI7nhZtB6xbYF8O1Zy','Jose Luis','1993-05-07','[\"ROLE_USUARIO\"]'),(3,NULL,'andreaManager@gmail.com','$2y$13$5S37QyZ1QNtc0HSap6jykupWGpUlztnydHJXCi7kxWR8.Wm.F4TB.','Andrea','1994-12-16','[\"ROLE_MANAGER\"]');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_playlist`
--

DROP TABLE IF EXISTS `usuario_playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_playlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `playlist_id` int DEFAULT NULL,
  `reproducida` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F43E3B4DB38439E` (`usuario_id`),
  KEY `IDX_3F43E3B46BBD148` (`playlist_id`),
  CONSTRAINT `FK_3F43E3B46BBD148` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  CONSTRAINT `FK_3F43E3B4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_playlist`
--

LOCK TABLES `usuario_playlist` WRITE;
/*!40000 ALTER TABLE `usuario_playlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_playlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-02 16:00:31
