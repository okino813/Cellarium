-- MySQL dump 10.13  Distrib 8.4.7, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.4.7

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firestation_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_firestation_id_foreign` (`firestation_id`),
  CONSTRAINT `admins_firestation_id_foreign` FOREIGN KEY (`firestation_id`) REFERENCES `firestations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Axel','Jaunet','okino813@pm.me','$2y$12$C9v4Eybc1KcO.e.JmfAQ0u9yp02OmBQGhhJaNtSMbOStTjWxk6PuO',1,'2026-01-21 21:07:48','2026-01-25 09:57:00'),(2,'Kevin','Idier','kevin@gmail.com','$2y$12$1ziLIqxcQFHBhbw6/vKs9e4vj/QExht/sqgNqIh1FqNFYzWrewAje',1,'2026-01-25 09:59:07','2026-01-25 10:11:03'),(3,'Louison','Griveau','louison.girveau85@gmail.com','$2y$12$XOPBwhWLrslFLkgX0Rl4WeUztOTb9d74jmZayAtsj8hPrXBiMlQV.',1,'2026-01-25 09:59:59','2026-01-25 09:59:59'),(4,'Michel','Daniels','michel.daniel@gmail.com','$2y$12$pIxToeaCN1akPooJLvUOwu3OCLM/UfjkDvA41DofxoxTZssNaIZrS',1,'2026-02-04 17:14:31','2026-02-04 17:15:39');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containing_item`
--

DROP TABLE IF EXISTS `containing_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `containing_item` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `containing_id` bigint unsigned NOT NULL,
  `qty_affect` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `containing_item_item_id_foreign` (`item_id`),
  KEY `containing_item_containing_id_foreign` (`containing_id`),
  CONSTRAINT `containing_item_containing_id_foreign` FOREIGN KEY (`containing_id`) REFERENCES `containings` (`id`),
  CONSTRAINT `containing_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containing_item`
--

LOCK TABLES `containing_item` WRITE;
/*!40000 ALTER TABLE `containing_item` DISABLE KEYS */;
INSERT INTO `containing_item` VALUES (4,16,1,1,NULL,NULL),(5,77,1,1,NULL,NULL),(6,22,1,5,NULL,NULL),(7,44,1,2,NULL,NULL),(8,25,1,4,NULL,NULL),(9,42,1,5,NULL,NULL),(10,41,1,10,NULL,NULL),(11,43,1,10,NULL,NULL),(12,50,1,2,NULL,NULL),(13,15,1,3,NULL,NULL),(14,12,4,1,NULL,NULL),(15,13,4,1,NULL,NULL),(16,14,4,1,NULL,NULL),(17,78,4,1,NULL,NULL),(18,39,4,2,NULL,NULL),(19,40,4,2,NULL,NULL),(20,33,4,1,NULL,NULL),(21,34,4,1,NULL,NULL),(23,4,3,2,NULL,NULL),(29,5,3,2,NULL,NULL),(30,6,3,2,NULL,NULL),(32,47,3,1,NULL,NULL),(33,24,3,1,NULL,NULL),(34,23,3,1,NULL,NULL),(35,66,2,1,NULL,NULL),(36,51,2,1,NULL,NULL),(37,48,2,1,NULL,NULL),(38,79,2,5,NULL,NULL),(39,7,3,1,NULL,NULL),(40,37,4,1,NULL,NULL);
/*!40000 ALTER TABLE `containing_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `containings`
--

DROP TABLE IF EXISTS `containings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `containings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `containings_source_id_foreign` (`source_id`),
  CONSTRAINT `containings_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `containings`
--

LOCK TABLES `containings` WRITE;
/*!40000 ALTER TABLE `containings` DISABLE KEYS */;
INSERT INTO `containings` VALUES (1,'Tiroire Rouge',1,'2026-01-24 15:17:54','2026-02-03 16:45:10'),(2,'Tiroire Jaune',1,'2026-01-24 15:18:11','2026-01-25 19:57:00'),(3,'Tiroire Vert',1,'2026-01-24 15:18:21','2026-01-25 19:57:47'),(4,'Tiroire Bleu',1,'2026-01-24 15:18:43','2026-01-25 19:57:52'),(5,'Saccoche panssement',NULL,'2026-01-24 15:28:51','2026-01-25 19:56:21'),(6,'Porte droite',NULL,'2026-01-24 15:32:52','2026-01-25 19:56:19');
/*!40000 ALTER TABLE `containings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `firestations`
--

DROP TABLE IF EXISTS `firestations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `firestations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firestations`
--

LOCK TABLES `firestations` WRITE;
/*!40000 ALTER TABLE `firestations` DISABLE KEYS */;
INSERT INTO `firestations` VALUES (1,'Saint Martin des Noyers','85140','925654','2026-01-21 19:39:34','2026-01-21 19:39:34');
/*!40000 ALTER TABLE `firestations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_movement`
--

DROP TABLE IF EXISTS `item_movement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_movement` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `movement_id` bigint unsigned NOT NULL,
  `operation` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_movement_item_id_foreign` (`item_id`),
  KEY `item_movement_movement_id_foreign` (`movement_id`),
  CONSTRAINT `item_movement_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `item_movement_movement_id_foreign` FOREIGN KEY (`movement_id`) REFERENCES `movements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_movement`
--

LOCK TABLES `item_movement` WRITE;
/*!40000 ALTER TABLE `item_movement` DISABLE KEYS */;
INSERT INTO `item_movement` VALUES (11,4,10,-2,NULL,NULL),(12,4,11,-2,NULL,NULL),(13,19,11,-1,NULL,NULL),(14,40,11,-1,NULL,NULL),(15,25,12,-2,NULL,NULL);
/*!40000 ALTER TABLE `item_movement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` int NOT NULL,
  `state` tinyint(1) NOT NULL,
  `is_stock` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seuil` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (4,'Bande de crêpe 5cm',6,1,1,'2026-02-02 17:51:32','2026-02-04 17:29:46',5),(5,'Bande de crêpe 10cm',10,1,1,'2026-02-02 17:53:00','2026-02-02 17:53:00',5),(6,'Bande de crêpe 20cm',2,1,1,'2026-02-02 17:53:27','2026-02-02 17:53:27',1),(7,'Boîte à aiguille',2,1,1,'2026-02-02 17:53:56','2026-02-02 17:53:56',0),(8,'Boîte à gants taille S',2,1,1,'2026-02-02 17:54:40','2026-02-02 17:54:40',0),(9,'Boîte à gants taille M',2,1,1,'2026-02-02 17:54:55','2026-02-02 17:54:55',0),(10,'Boîte à gants taille L',4,1,1,'2026-02-02 17:55:05','2026-02-02 17:56:04',2),(11,'Boîte à gants taille XL',4,1,1,'2026-02-02 17:56:21','2026-02-02 17:56:21',2),(12,'Canule de Guedel taille 1',2,1,1,'2026-02-02 17:56:47','2026-02-02 17:57:26',1),(13,'Canule de Guedel taille 2',2,1,1,'2026-02-02 17:57:11','2026-02-02 17:57:11',1),(14,'Canule de Guedel taille 3',2,1,1,'2026-02-02 17:57:37','2026-02-02 17:57:37',1),(15,'Champs de protection',6,1,1,'2026-02-02 17:58:11','2026-02-02 17:58:11',3),(16,'Ciseaux coupe-vêtement JESCO',9,1,1,'2026-02-02 17:59:04','2026-03-09 16:11:52',0),(17,'Collier cervical Adulte',2,1,1,'2026-02-02 17:59:35','2026-02-02 17:59:35',0),(18,'Colier Cervical Enfant',2,1,1,'2026-02-02 17:59:52','2026-02-02 17:59:52',0),(19,'Compresse gel brûlure GM',0,1,1,'2026-02-02 18:00:21','2026-02-04 17:29:46',0),(20,'Compresse gel brûlure MM',1,1,1,'2026-02-02 18:00:37','2026-02-02 18:00:37',0),(21,'Compresse gel brûlure PM',1,1,1,'2026-02-02 18:01:28','2026-02-02 18:01:28',0),(22,'Compresses stériles',7,1,1,'2026-02-02 18:01:59','2026-03-09 15:37:16',5),(23,'Coussin de PLS',2,1,1,'2026-02-02 18:03:00','2026-02-02 18:03:00',0),(24,'Couverture de survie',4,1,1,'2026-02-02 18:03:25','2026-02-02 18:03:25',2),(25,'Dakin 60ml',3,1,1,'2026-02-02 18:03:47','2026-03-09 17:23:18',2),(26,'Fiche bilan',60,1,1,'2026-02-02 18:04:10','2026-02-02 18:04:10',10),(27,'Filet tubulaire',2,1,1,'2026-02-02 18:04:36','2026-02-02 18:04:36',1),(28,'Filtre antibactérien pour BAVU',6,1,1,'2026-02-02 18:05:01','2026-02-02 18:05:01',2),(29,'Gel hydroalcoolique PM',6,1,1,'2026-02-02 18:05:34','2026-02-02 18:05:34',2),(30,'Glucopulse (Boîte entière)',1,1,1,'2026-02-02 18:06:30','2026-02-02 18:06:30',0),(31,'Bandelette Glycémie',50,1,1,'2026-02-02 18:07:47','2026-02-02 18:07:47',10),(32,'House mortuaire',1,1,1,'2026-02-02 18:11:52','2026-02-02 18:11:52',0),(33,'Insufflateur Adulte',1,1,1,'2026-02-02 18:12:10','2026-02-02 18:12:10',0),(34,'Insufflateur Enfant',1,1,1,'2026-02-02 18:12:29','2026-02-02 18:12:29',0),(35,'Kit risque infectieux',2,1,1,'2026-02-02 18:13:04','2026-02-02 18:13:04',0),(36,'Kit DSA',1,1,1,'2026-02-02 18:13:35','2026-02-02 18:13:35',0),(37,'Kit Aspirateur à Mucosité',2,1,1,'2026-02-02 18:14:00','2026-02-02 19:57:01',0),(38,'Masque chirurgicaux',2,1,1,'2026-02-02 18:14:34','2026-02-02 18:14:34',0),(39,'Masque HC O₂ Adulte',10,1,1,'2026-02-02 18:20:57','2026-02-02 18:20:57',5),(40,'Masque HC O₂ Enfant',5,1,1,'2026-02-02 18:21:17','2026-02-04 17:29:48',3),(41,'Sérum Phy 10ml',30,1,1,'2026-02-02 18:21:44','2026-02-02 18:21:44',10),(42,'Sérum Phy 45ml',15,1,1,'2026-02-02 18:22:09','2026-02-02 18:22:09',5),(43,'Pansement américain',20,1,1,'2026-02-02 18:23:01','2026-02-02 18:23:01',10),(44,'Pansement Comprésif d\'Urgence',7,1,1,'2026-02-02 18:23:28','2026-03-09 15:38:26',0),(45,'Protection thermomêtre',10,1,1,'2026-02-02 18:23:50','2026-02-02 18:23:50',2),(46,'Sac isotherme',1,1,1,'2026-02-02 18:24:53','2026-02-02 18:24:53',0),(47,'Sac Vomix',15,1,1,'2026-02-02 18:25:31','2026-02-02 18:25:31',5),(48,'Sac DASRI (rouleau)',2,1,1,'2026-02-02 18:26:06','2026-02-02 18:26:32',0),(49,'Sonde d\'aspiration',2,1,1,'2026-02-02 18:27:09','2026-02-02 18:27:09',0),(50,'Sparadrap',2,1,1,'2026-02-02 18:27:28','2026-02-02 18:27:28',0),(51,'Spray désinfectant',2,1,1,'2026-02-02 18:27:44','2026-02-02 18:27:44',0),(52,'Stylo lampe',1,1,1,'2026-02-02 18:28:08','2026-02-02 18:28:08',0),(53,'Aspirateur de mucosités',0,1,0,'2026-02-02 18:31:09','2026-02-02 18:31:09',0),(54,'Attelle à décompression bras adulte',0,1,0,'2026-02-02 18:31:31','2026-02-02 18:31:31',0),(55,'Attelle à décompression jambe adulte',0,1,0,'2026-02-02 18:31:47','2026-02-02 18:31:47',0),(56,'Attelle à décompression poignet',0,1,0,'2026-02-02 18:32:09','2026-02-02 18:32:09',0),(57,'ACT',0,1,0,'2026-02-02 19:40:23','2026-02-02 19:40:23',0),(58,'Brassard à tension Enfant',0,1,0,'2026-02-02 19:40:38','2026-02-02 19:40:38',0),(59,'Brassard à tension Adulte',0,1,0,'2026-02-02 19:40:51','2026-02-02 19:40:51',0),(60,'Brassard à tension Obèse',0,1,0,'2026-02-02 19:41:04','2026-02-02 19:41:04',0),(61,'Couverture Bactériostatique',0,1,0,'2026-02-02 19:41:31','2026-02-02 19:41:31',0),(62,'DSA',0,1,0,'2026-02-02 19:41:52','2026-02-02 19:41:52',0),(63,'Garrot tounirquet',0,1,0,'2026-02-02 19:42:01','2026-02-02 19:42:01',0),(64,'Kit accouchement',0,1,0,'2026-02-02 19:42:24','2026-02-02 19:42:24',0),(65,'Kit NOVI',0,1,0,'2026-02-02 19:42:37','2026-02-02 19:42:37',0),(66,'Lavette hygiène',0,1,0,'2026-02-02 19:43:06','2026-02-02 19:43:06',0),(67,'Lecteur glycémie',0,1,0,'2026-02-02 19:43:20','2026-02-02 19:43:20',0),(68,'MID Adulte',0,1,0,'2026-02-02 19:43:42','2026-02-02 19:43:42',0),(69,'MID Enfant',0,1,0,'2026-02-02 19:43:50','2026-02-02 19:43:50',0),(70,'Oxymètre de pouls',0,1,0,'2026-02-02 19:44:08','2026-02-02 19:44:08',0),(71,'Plan dur',0,1,0,'2026-02-02 19:44:31','2026-02-02 19:44:31',0),(72,'Pompe à dépression',0,1,0,'2026-02-02 19:44:44','2026-02-02 19:44:44',0),(73,'Reglette EVA Adulte / Enfant',0,1,0,'2026-02-02 19:45:05','2026-02-02 19:45:05',0),(74,'Stétoscope',0,1,0,'2026-02-02 19:45:53','2026-02-02 19:45:53',0),(75,'Tensiomètre',0,1,0,'2026-02-02 19:46:07','2026-02-02 19:46:07',0),(76,'Thermomètre',0,1,0,'2026-02-02 19:46:18','2026-02-02 19:46:18',0),(77,'Ciseaux inox multifonction',-3,1,0,'2026-02-02 19:49:58','2026-03-09 16:01:43',0),(78,'Canule de Guedel taille 4',2,1,1,'2026-02-02 19:53:36','2026-02-02 19:53:36',0),(79,'Drap de transfert',0,1,0,'2026-02-02 20:03:36','2026-02-02 20:03:36',0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'01_create_firestation',1),(5,'02_create_admin',1),(6,'03_create_source',1),(7,'04_create_containing',1),(8,'05_create_item',1),(9,'06_create_movements',1),(10,'07_create_containing_item_table',1),(11,'08_create_item_movements_table',1),(12,'2026_01_25_195412_update_containings_source_id_nullable',2),(13,'2026_02_01_105743_item_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movements`
--

LOCK TABLES `movements` WRITE;
/*!40000 ALTER TABLE `movements` DISABLE KEYS */;
INSERT INTO `movements` VALUES (1,'Axel',NULL,'2026-01-25 12:21:31','2026-01-25 12:21:31'),(2,'Axel','A pu','2026-02-01 15:44:06','2026-02-01 15:44:06'),(3,'Axel',NULL,'2026-02-01 16:00:49','2026-02-01 16:00:49'),(4,'Axel',NULL,'2026-02-01 16:03:40','2026-02-01 16:03:40'),(5,'Axel',NULL,'2026-02-01 16:04:49','2026-02-01 16:04:49'),(6,'Axel',NULL,'2026-02-01 16:05:11','2026-02-01 16:05:11'),(7,'Axel',NULL,'2026-02-01 16:25:07','2026-02-01 16:25:07'),(8,'Axel',NULL,'2026-02-01 16:26:48','2026-02-01 16:26:48'),(9,'Axel',NULL,'2026-02-02 17:33:28','2026-02-02 17:33:28'),(10,'Axel','Petit test','2026-02-03 21:34:45','2026-02-03 21:34:45'),(11,'Axel','Test','2026-02-04 17:29:48','2026-02-04 17:29:48'),(12,'Axel','','2026-03-09 17:23:18','2026-03-09 17:23:18');
/*!40000 ALTER TABLE `movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('PHBkVWH2SD1CcYx42gPmN6vq9YX7i9WtuRJfwMkh',NULL,'192.168.65.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:148.0) Gecko/20100101 Firefox/148.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXhUZ0pxSEJvbEwyUlNnVXlVQVQwVE0xdjdmU1RWQlh4Q3JQVnNuSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3QvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJmaXJzdG5hbWUiO3M6NDoiQXhlbCI7fQ==',1773077987);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sources`
--

DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sources` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firestation_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sources_firestation_id_foreign` (`firestation_id`),
  CONSTRAINT `sources_firestation_id_foreign` FOREIGN KEY (`firestation_id`) REFERENCES `firestations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sources`
--

LOCK TABLES `sources` WRITE;
/*!40000 ALTER TABLE `sources` DISABLE KEYS */;
INSERT INTO `sources` VALUES (1,'Cellule VSAV',1,'2026-01-24 14:40:08','2026-02-04 17:18:39'),(2,'Sac Prompt Secours',1,'2026-01-24 14:48:46','2026-01-24 14:48:46'),(3,'Médipack',1,'2026-01-24 14:48:52','2026-01-24 14:48:52'),(4,'Cabine conducteur',1,'2026-01-24 14:49:06','2026-01-24 14:49:06');
/*!40000 ALTER TABLE `sources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-16  9:14:15
