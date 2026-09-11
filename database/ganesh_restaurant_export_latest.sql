Warning: A partial dump from a server that has GTIDs will by default include the GTIDs of all transactions, even those that changed suppressed parts of the database. If you don't want to restore GTIDs, pass --set-gtid-purged=OFF. To make a complete dump, pass --all-databases --triggers --routines --events. 
Warning: A dump from a server that has GTIDs enabled will by default include the GTIDs of all transactions, even those that were executed during its extraction and might not be represented in the dumped data. This might result in an inconsistent data dump. 
In order to ensure a consistent backup of the database, pass --single-transaction or --lock-all-tables or --source-data. 
-- MySQL dump 10.13  Distrib 9.7.1, for macos15.7 (arm64)
--
-- Host: 127.0.0.1    Database: ganesh_restaurant
-- ------------------------------------------------------
-- Server version	9.7.1

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'd7bc7cbe-9f2f-11f1-ade3-dc0379584e7b:1-448';

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint unsigned NOT NULL,
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
  `expiration` bigint unsigned NOT NULL,
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
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_reviews`
--

DROP TABLE IF EXISTS `customer_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reviewer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` bigint unsigned NOT NULL DEFAULT '5',
  `food_rating` bigint unsigned DEFAULT NULL,
  `service_rating` bigint unsigned DEFAULT NULL,
  `atmosphere_rating` bigint unsigned DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'google',
  `reviewed_ago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` bigint unsigned NOT NULL DEFAULT '1',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_reviews`
--

LOCK TABLES `customer_reviews` WRITE;
/*!40000 ALTER TABLE `customer_reviews` DISABLE KEYS */;
INSERT INTO `customer_reviews` VALUES (1,'Riddhi Ghaghada',5,5,5,5,'All the food is extremely delicious. Among them, UMBADIYU tasted amazing and is truly one of the best in all of Ahmedabad. You should definitely try it..😋','google','7 months ago',1,1,1,'2026-09-07 15:37:10','2026-09-07 15:37:10'),(2,'Fresha Patel',5,5,5,5,'Absolutely amazing Umbadiyu! Not spicy at all, yet full of authentic flavor. Truly delicious and a must-visit place','google','8 months ago',1,1,2,'2026-09-07 15:37:10','2026-09-07 15:37:10'),(3,'Urvil Sarvasva',5,5,5,5,'Excellent umbaiyu. Glad we now have umbadiyu place in gota. They serve it with chutneys which is great as eating umbadiyu alone is not great to swallow. Chutneys with umbadiyu are definately worth it.','google','9 months ago',1,1,3,'2026-09-07 15:37:10','2026-09-07 15:37:10'),(4,'Ghanshyam Solanki',5,5,4,4,'Delicious food, mainly umbadiyu is testy.','google','7 months ago',1,1,4,'2026-09-07 15:37:10','2026-09-07 15:37:10'),(5,'Kajal Patel',5,5,5,5,'It was awesome taste....first time try ... & it was so good','google','9 months ago',1,1,5,'2026-09-07 15:37:10','2026-09-07 15:37:10');
/*!40000 ALTER TABLE `customer_reviews` ENABLE KEYS */;
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
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `founders`
--

DROP TABLE IF EXISTS `founders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `founders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `founders`
--

LOCK TABLES `founders` WRITE;
/*!40000 ALTER TABLE `founders` DISABLE KEYS */;
INSERT INTO `founders` VALUES (1,'Ganesh Patel','Founder & Head Chef','Started Ganesh The Family Restaurant with a vision to serve honest Gujarati and South Indian food. 25+ years in hospitality — Umbadiyu and Dosa specialist.','https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80',1,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(2,'Priya Shah','Co-Founder & Operations','Manages daily operations, quality control, and guest experience. Ensures every family feels at home at our Gota restaurant.','https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80',2,1,'2026-09-07 12:59:49','2026-09-07 12:59:49');
/*!40000 ALTER TABLE `founders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_categories`
--

DROP TABLE IF EXISTS `gallery_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_categories`
--

LOCK TABLES `gallery_categories` WRITE;
/*!40000 ALTER TABLE `gallery_categories` DISABLE KEYS */;
INSERT INTO `gallery_categories` VALUES (1,'Restaurant',1,1,'2026-09-07 10:11:03','2026-09-07 10:11:03'),(2,'Food & Dishes',2,1,'2026-09-07 10:25:07','2026-09-07 10:25:07');
/*!40000 ALTER TABLE `gallery_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gallery_category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES (1,1,'Restaurant Interior','https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80','Warm family dining at Gota',1,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(2,1,'Dosa Counter','https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=800&q=80','Fresh crispy dosas',2,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(3,1,'Family Seating','https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800&q=80','Comfortable seating for families',3,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(4,2,'South Indian Thali','https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=800&q=80','Traditional thali service',4,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(5,2,'Paneer Special','https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80','Rich paneer gravies',5,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(6,2,'Kathiyawadi Dish','https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80','Authentic Gujarati flavours',6,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(7,2,'Evening Ambience','https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80','Evening dining atmosphere',7,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(8,2,'Fresh Vegetables','https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&q=80','Farm fresh ingredients',8,1,'2026-09-07 12:59:49','2026-09-07 12:59:49');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_sliders`
--

DROP TABLE IF EXISTS `home_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `home_sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_sliders`
--

LOCK TABLES `home_sliders` WRITE;
/*!40000 ALTER TABLE `home_sliders` DISABLE KEYS */;
INSERT INTO `home_sliders` VALUES (1,'Welcome to Ganesh','Umbadiyu Specialist · Family Dining in Gota','https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80',NULL,1,1,'2026-09-07 10:46:47','2026-09-07 10:46:47'),(2,'South Indian Dosa','Paper Dosa · Masala Dosa · Burj Khalifa Dosa','https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=1200&q=80',NULL,2,1,'2026-09-07 10:46:47','2026-09-07 10:46:47'),(3,'Order Online','Fresh food delivered — call 9276819283','https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80',NULL,3,1,'2026-09-07 10:46:47','2026-09-07 10:46:47');
/*!40000 ALTER TABLE `home_sliders` ENABLE KEYS */;
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
  `total_jobs` bigint unsigned NOT NULL,
  `pending_jobs` bigint unsigned NOT NULL,
  `failed_jobs` bigint unsigned NOT NULL,
  `failed_job_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `cancelled_at` bigint unsigned DEFAULT NULL,
  `created_at` bigint unsigned NOT NULL,
  `finished_at` bigint unsigned DEFAULT NULL,
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
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` bigint unsigned NOT NULL,
  `reserved_at` bigint unsigned DEFAULT NULL,
  `available_at` bigint unsigned NOT NULL,
  `created_at` bigint unsigned NOT NULL,
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
-- Table structure for table `menu_categories`
--

DROP TABLE IF EXISTS `menu_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_categories`
--

LOCK TABLES `menu_categories` WRITE;
/*!40000 ALTER TABLE `menu_categories` DISABLE KEYS */;
INSERT INTO `menu_categories` VALUES (1,'Starters','Starters — Ganesh Restaurant','https://images.unsplash.com/photo-1601050690597-df0568fa7098?w=600&q=80',9,1,'2026-09-07 10:11:03','2026-09-07 12:59:49'),(3,'Paper Dosa','Paper Dosa — Ganesh Restaurant','https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=600&q=80',1,1,'2026-09-07 10:25:07','2026-09-07 12:59:49'),(4,'Masala Dosa','Masala Dosa — Ganesh Restaurant','https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=600&q=80',2,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(5,'Surati Mysore Dosa','Surati Mysore Dosa — Ganesh Restaurant','https://images.unsplash.com/photo-1668236541030-9a7e005a0857?w=600&q=80',3,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(6,'Fancy Dosa & Jini Roll','Fancy Dosa & Jini Roll — Ganesh Restaurant','https://images.unsplash.com/photo-1596797038530-2c107229654b?w=600&q=80',4,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(7,'Uttapam','Uttapam — Ganesh Restaurant','https://images.unsplash.com/photo-1606491956689-2ea866858657?w=600&q=80',5,1,'2026-09-07 10:25:07','2026-09-07 12:59:49'),(8,'Kathiyawadi Special','Kathiyawadi Special — Ganesh Restaurant','https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=600&q=80',6,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(9,'Khichdi','Khichdi — Ganesh Restaurant','https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80',7,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(10,'Rajasthani Special','Rajasthani Special — Ganesh Restaurant','https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=600&q=80',8,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(11,'Punjabi Paneer','Punjabi Paneer — Ganesh Restaurant','https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',10,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(12,'Classic Paneer & Kofta','Classic Paneer & Kofta — Ganesh Restaurant','https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',11,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(13,'Kaju & Cheese Special','Kaju & Cheese Special — Ganesh Restaurant','https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',12,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(14,'Veg Special','Veg Special — Ganesh Restaurant','https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80',13,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(15,'Dal Special','Dal Special — Ganesh Restaurant','https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80',14,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(16,'Pulav & Rice','Pulav & Rice — Ganesh Restaurant','https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=600&q=80',15,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(17,'Pav Bhaji','Pav Bhaji — Ganesh Restaurant','https://images.unsplash.com/photo-1606491956689-2ea866858657?w=600&q=80',16,1,'2026-09-07 10:25:07','2026-09-07 12:59:49'),(18,'Beverages & Extras','Beverages & Extras — Ganesh Restaurant','https://images.unsplash.com/photo-1546173159-315724a31696?w=600&q=80',17,1,'2026-09-07 10:25:07','2026-09-07 15:37:09'),(19,'Tandoor & Breads','Tandoor & Breads — Ganesh Restaurant','https://images.unsplash.com/photo-1601050690597-df0568fa7098?w=600&q=80',18,1,'2026-09-07 10:25:07','2026-09-07 12:59:49');
/*!40000 ALTER TABLE `menu_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(12,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_veg` bigint unsigned NOT NULL DEFAULT '1',
  `is_available` bigint unsigned NOT NULL DEFAULT '1',
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name_gu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Paneer Tikka','Grilled cottage cheese',180.00,'images/food/items/paneer-tikka.svg',1,1,1,'2026-09-07 10:11:03','2026-09-07 15:37:09',NULL),(3,3,'Paper Dosa','Freshly prepared · 100% vegetarian',79.00,'images/food/items/paper-dosa.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(4,3,'Plain Paper','Freshly prepared · 100% vegetarian',79.00,'images/food/items/plain-paper.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(5,3,'Baby Paper','Freshly prepared · 100% vegetarian',89.00,'images/food/items/baby-paper.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(6,3,'Garlic Paper','Freshly prepared · 100% vegetarian',79.00,'images/food/items/garlic-paper.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(7,3,'Masala Paper','Freshly prepared · 100% vegetarian',89.00,'images/food/items/masala-paper.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(8,3,'Tomato Paper','Freshly prepared · 100% vegetarian',89.00,'images/food/items/tomato-paper.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(9,3,'Nylon Paper','Freshly prepared · 100% vegetarian',99.00,'images/food/items/nylon-paper.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(10,3,'Schezwan Paper','Freshly prepared · 100% vegetarian',99.00,'images/food/items/schezwan-paper.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(11,3,'Cheese Paper','Freshly prepared · 100% vegetarian',109.00,'images/food/items/cheese-paper.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(12,3,'Mysore Paper','Freshly prepared · 100% vegetarian',109.00,'images/food/items/mysore-paper.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(13,3,'Fruit Jam Paper','Freshly prepared · 100% vegetarian',109.00,'images/food/items/fruit-jam-paper.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(14,3,'Chocolate Paper','Freshly prepared · 100% vegetarian',109.00,'images/food/items/chocolate-paper.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(15,3,'Peri Peri Cheese Paper','Freshly prepared · 100% vegetarian',119.00,'images/food/items/peri-peri-cheese-paper.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(16,3,'Tomato Cheese Paper','Freshly prepared · 100% vegetarian',119.00,'images/food/items/tomato-cheese-paper.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(17,3,'Gwalior Paper','Freshly prepared · 100% vegetarian',109.00,'images/food/items/gwalior-paper.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(18,3,'Corn Cheese Paper','Freshly prepared · 100% vegetarian',119.00,'images/food/items/corn-cheese-paper.svg',1,1,16,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(19,3,'Capsicum Cheese Paper','Freshly prepared · 100% vegetarian',129.00,'images/food/items/capsicum-cheese-paper.svg',1,1,17,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(20,3,'Cheese Garlic Paper','Freshly prepared · 100% vegetarian',129.00,'images/food/items/cheese-garlic-paper.svg',1,1,18,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(21,3,'Mysore Cheese Roll','Freshly prepared · 100% vegetarian',129.00,'images/food/items/mysore-cheese-roll.svg',1,1,19,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(22,3,'Chataka Pataka','Freshly prepared · 100% vegetarian',129.00,'images/food/items/chataka-pataka.svg',1,1,20,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(23,3,'Harabhara Paper','Freshly prepared · 100% vegetarian',129.00,'images/food/items/harabhara-paper.svg',1,1,21,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(24,3,'Cheese Chilli Garlic','Freshly prepared · 100% vegetarian',139.00,'images/food/items/cheese-chilli-garlic.svg',1,1,22,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(25,3,'Choco Cheese','Freshly prepared · 100% vegetarian',139.00,'images/food/items/choco-cheese.svg',1,1,23,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(26,3,'Schezwan Cheese Paper','Freshly prepared · 100% vegetarian',139.00,'images/food/items/schezwan-cheese-paper.svg',1,1,24,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(27,3,'Chocolate Silencer','Freshly prepared · 100% vegetarian',159.00,'images/food/items/chocolate-silencer.svg',1,1,25,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(28,3,'Ganesh\'s Special Paper','Freshly prepared · 100% vegetarian',169.00,'images/food/items/ganeshs-special-paper.svg',1,1,26,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(29,4,'Masala Dosa','Freshly prepared · 100% vegetarian',119.00,'images/food/items/masala-dosa.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(30,4,'Onion Masala Dosa','Freshly prepared · 100% vegetarian',129.00,'images/food/items/onion-masala-dosa.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(31,4,'Separate Masala','Freshly prepared · 100% vegetarian',129.00,'images/food/items/separate-masala.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(32,4,'Mysore Masala','Freshly prepared · 100% vegetarian',139.00,'images/food/items/mysore-masala.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(33,4,'Schezwan Masala','Freshly prepared · 100% vegetarian',149.00,'images/food/items/schezwan-masala.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(34,4,'Cheese Masala','Freshly prepared · 100% vegetarian',149.00,'images/food/items/cheese-masala.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(35,4,'Paneer Masala','Freshly prepared · 100% vegetarian',149.00,'images/food/items/paneer-masala.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(36,4,'Gwalior Masala','Freshly prepared · 100% vegetarian',159.00,'images/food/items/gwalior-masala.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(37,4,'Cheese Mysore Masala','Freshly prepared · 100% vegetarian',169.00,'images/food/items/cheese-mysore-masala.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(38,4,'Cheese Schezwan Masala','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-schezwan-masala.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(39,4,'Cheese Paneer Masala','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-paneer-masala.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(40,4,'Gwalior Cheese Masala','Freshly prepared · 100% vegetarian',179.00,'images/food/items/gwalior-cheese-masala.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(41,4,'Cheese Paneer Schezwan Masala','Freshly prepared · 100% vegetarian',189.00,'images/food/items/cheese-paneer-schezwan-masala.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(42,4,'Dosa Fry','Freshly prepared · 100% vegetarian',159.00,'images/food/items/dosa-fry.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(43,4,'Cheese Dosa Fry','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-dosa-fry.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(44,4,'Ganesh\'s Special Masala','Freshly prepared · 100% vegetarian',209.00,'images/food/items/ganeshs-special-masala.svg',1,1,16,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(45,5,'Surati Mysore','Freshly prepared · 100% vegetarian',139.00,'images/food/items/surati-mysore.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(46,5,'Cheese Surati Mysore','Freshly prepared · 100% vegetarian',149.00,'images/food/items/cheese-surati-mysore.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(47,5,'Paneer Tukda Mysore','Freshly prepared · 100% vegetarian',159.00,'images/food/items/paneer-tukda-mysore.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(48,5,'Paneer Bhurji Mysore','Freshly prepared · 100% vegetarian',159.00,'images/food/items/paneer-bhurji-mysore.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(49,5,'Cheese Sweet Corn Mysore','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-sweet-corn-mysore.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(50,5,'Gotala Mysore','Freshly prepared · 100% vegetarian',219.00,'images/food/items/gotala-mysore.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(51,5,'Tadka Gotala Mysore','Freshly prepared · 100% vegetarian',229.00,'images/food/items/tadka-gotala-mysore.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(52,5,'Green Tadka Gotala Mysore','Freshly prepared · 100% vegetarian',229.00,'images/food/items/green-tadka-gotala-mysore.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(53,5,'Ganesh\'s Special Surati Mysore','Freshly prepared · 100% vegetarian',249.00,'images/food/items/ganeshs-special-surati-mysore.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(54,5,'Shahi Matka Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/shahi-matka-dosa.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(55,6,'Jini Roll','Freshly prepared · 100% vegetarian',219.00,'images/food/items/jini-roll.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(56,6,'Spring Roll','Freshly prepared · 100% vegetarian',219.00,'images/food/items/spring-roll.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(57,6,'Magic Roll','Freshly prepared · 100% vegetarian',219.00,'images/food/items/magic-roll.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(58,6,'Cheese Palak Paneer','Freshly prepared · 100% vegetarian',219.00,'images/food/items/cheese-palak-paneer.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(59,6,'Singapuri','Freshly prepared · 100% vegetarian',219.00,'images/food/items/singapuri.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(60,6,'American Chopsuey','Freshly prepared · 100% vegetarian',219.00,'images/food/items/american-chopsuey.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(61,6,'Chinese Dosa','Freshly prepared · 100% vegetarian',219.00,'images/food/items/chinese-dosa.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(62,6,'Cheese Dosa','Freshly prepared · 100% vegetarian',229.00,'images/food/items/cheese-dosa.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(63,6,'Sweet Corn Dosa','Freshly prepared · 100% vegetarian',229.00,'images/food/items/sweet-corn-dosa.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(64,6,'Palak Paneer Dosa','Freshly prepared · 100% vegetarian',229.00,'images/food/items/palak-paneer-dosa.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(65,6,'Paneer Toofani','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-toofani.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(66,6,'Maggie Cheese','Freshly prepared · 100% vegetarian',239.00,'images/food/items/maggie-cheese.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(67,6,'Raja Rani','Freshly prepared · 100% vegetarian',239.00,'images/food/items/raja-rani.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(68,6,'Dilkhush','Freshly prepared · 100% vegetarian',239.00,'images/food/items/dilkhush.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(69,6,'Dabeli','Freshly prepared · 100% vegetarian',239.00,'images/food/items/dabeli.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(70,6,'Paneer Chilli','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-chilli.svg',1,1,16,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(71,6,'Mix Veg','Freshly prepared · 100% vegetarian',229.00,'images/food/items/mix-veg.svg',1,1,17,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(72,6,'Cheese Sweet Corn Sandwich',NULL,229.00,'images/food/items/cheese-sweet-corn-sandwich.svg',1,1,18,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(73,6,'Indian Tadka','Freshly prepared · 100% vegetarian',229.00,'images/food/items/indian-tadka.svg',1,1,20,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(74,6,'Janak Janak Payal','Freshly prepared · 100% vegetarian',239.00,'images/food/items/janak-janak-payal.svg',1,1,21,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(75,6,'Paneer Tikka','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-tikka.svg',1,1,22,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(76,6,'American Tukda','Freshly prepared · 100% vegetarian',249.00,'images/food/items/american-tukda.svg',1,1,23,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(77,6,'Bombay Fancy Dosa','Freshly prepared · 100% vegetarian',239.00,'images/food/items/bombay-fancy-dosa.svg',1,1,24,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(78,6,'Jethalal 3 in 1 Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/jethalal-3-in-1-dosa.svg',1,1,25,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(79,6,'KurKure Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/kurkure-dosa.svg',1,1,26,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(80,6,'Chips Corn Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/chips-corn-dosa.svg',1,1,27,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(81,6,'Hong Kong Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/hong-kong-dosa.svg',1,1,28,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(82,6,'American Fusion Dosa','Freshly prepared · 100% vegetarian',249.00,'images/food/items/american-fusion-dosa.svg',1,1,29,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(83,6,'Fusion Roll Dosa','Freshly prepared · 100% vegetarian',269.00,'images/food/items/fusion-roll-dosa.svg',1,1,30,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(84,6,'Bahubali Dosa','Freshly prepared · 100% vegetarian',279.00,'images/food/items/bahubali-dosa.svg',1,1,31,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(85,6,'Burj Khalifa Dosa','Freshly prepared · 100% vegetarian',289.00,'images/food/items/burj-khalifa-dosa.svg',1,1,32,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(86,6,'Ganesh\'s Special Fancy','Freshly prepared · 100% vegetarian',299.00,'images/food/items/ganeshs-special-fancy.svg',1,1,33,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(87,7,'Plain Uttapam','Freshly prepared · 100% vegetarian',149.00,'images/food/items/plain-uttapam.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(88,7,'Onion Uttapam','Freshly prepared · 100% vegetarian',169.00,'images/food/items/onion-uttapam.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(89,7,'Tomato Uttapam','Freshly prepared · 100% vegetarian',169.00,'images/food/items/tomato-uttapam.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(90,7,'Cheese Uttapam','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-uttapam.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(91,7,'Onion Tomato Uttapam','Freshly prepared · 100% vegetarian',179.00,'images/food/items/onion-tomato-uttapam.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(92,7,'Ulat Pulat Uttapam','Freshly prepared · 100% vegetarian',179.00,'images/food/items/ulat-pulat-uttapam.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(93,7,'Mix Uttapam','Freshly prepared · 100% vegetarian',189.00,'images/food/items/mix-uttapam.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(94,7,'Pizza Uttapam','Freshly prepared · 100% vegetarian',199.00,'images/food/items/pizza-uttapam.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(95,7,'Ganesh\'s Special Uttapam','Freshly prepared · 100% vegetarian',219.00,'images/food/items/ganeshs-special-uttapam.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(96,8,'Varaliyu','Freshly prepared · 100% vegetarian',199.00,'images/food/items/varaliyu.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(97,8,'Aakhi Dungali','Freshly prepared · 100% vegetarian',149.00,'images/food/items/aakhi-dungali.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(98,8,'Dahi Tikhari','Freshly prepared · 100% vegetarian',119.00,'images/food/items/dahi-tikhari.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(99,8,'Dungali Gathiya','Freshly prepared · 100% vegetarian',159.00,'images/food/items/dungali-gathiya.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(100,8,'Sev Tameta','Freshly prepared · 100% vegetarian',139.00,'images/food/items/sev-tameta.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(101,8,'Masala Dhokli','Freshly prepared · 100% vegetarian',179.00,'images/food/items/masala-dhokli.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(102,8,'Lasaniya Bateta','Freshly prepared · 100% vegetarian',149.00,'images/food/items/lasaniya-bateta.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(103,8,'Bharela Ringna','Freshly prepared · 100% vegetarian',149.00,'images/food/items/bharela-ringna.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(104,8,'Ringan Bhadthu (Seasonal)','Freshly prepared · 100% vegetarian',169.00,'images/food/items/ringan-bhadthu-seasonal.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(105,8,'Bhindi Masala','Freshly prepared · 100% vegetarian',159.00,'images/food/items/bhindi-masala.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(106,8,'Kaju Gathiya','Freshly prepared · 100% vegetarian',179.00,'images/food/items/kaju-gathiya.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(107,8,'Kaju Lasan','Freshly prepared · 100% vegetarian',169.00,'images/food/items/kaju-lasan.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(108,8,'Methi Papad','Freshly prepared · 100% vegetarian',169.00,'images/food/items/methi-papad.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(109,8,'Besan Gatta','Freshly prepared · 100% vegetarian',159.00,'images/food/items/besan-gatta.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(110,8,'Sev Methi','Freshly prepared · 100% vegetarian',179.00,'images/food/items/sev-methi.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(111,8,'Leelee Sev Dungali','Freshly prepared · 100% vegetarian',169.00,'images/food/items/leelee-sev-dungali.svg',1,1,16,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(112,9,'Khichdi','Freshly prepared · 100% vegetarian',79.00,'images/food/items/khichdi.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(113,9,'Masala Khichdi','Freshly prepared · 100% vegetarian',99.00,'images/food/items/masala-khichdi.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(114,9,'Kadhi-Khichdi','Freshly prepared · 100% vegetarian',139.00,'images/food/items/kadhi-khichdi.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(115,10,'Original Rajasthani Spl Daal-Bati','Freshly prepared · 100% vegetarian',199.00,'images/food/items/original-rajasthani-spl-daal-bati.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(116,1,'Roasted Papad','Freshly prepared · 100% vegetarian',19.00,'images/food/items/roasted-papad.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(117,1,'Masala Papad','Freshly prepared · 100% vegetarian',39.00,'images/food/items/masala-papad.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(118,1,'Paneer Tikka Dry','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-tikka-dry.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(119,1,'Harabhara Kabab','Freshly prepared · 100% vegetarian',239.00,'images/food/items/harabhara-kabab.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(120,1,'Pahadi Kabab','Freshly prepared · 100% vegetarian',269.00,'images/food/items/pahadi-kabab.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(121,1,'Makai Tikka Dry','Freshly prepared · 100% vegetarian',279.00,'images/food/items/makai-tikka-dry.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(122,11,'Paneer Butter Masala','Freshly prepared · 100% vegetarian',229.00,'images/food/items/paneer-butter-masala.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(123,11,'Paneer Tikka Masala','Freshly prepared · 100% vegetarian',179.00,'images/food/items/paneer-tikka-masala.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(124,11,'Paneer Kadai','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-kadai.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(125,11,'Paneer Toofani','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-toofani.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(126,11,'Paneer Patiyala','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-patiyala.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(127,11,'Paneer Takatak Masala','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-takatak-masala.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(128,11,'Paneer Angara','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-angara.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(129,11,'Paneer Kolhapuri','Freshly prepared · 100% vegetarian',219.00,'images/food/items/paneer-kolhapuri.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(130,11,'Paneer Hyderabadi Masala','Freshly prepared · 100% vegetarian',229.00,'images/food/items/paneer-hyderabadi-masala.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(131,11,'Paneer Do Pyaza','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-do-pyaza.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(132,11,'Paneer Lasooni','Freshly prepared · 100% vegetarian',219.00,'images/food/items/paneer-lasooni.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(133,11,'Paneer Chatpata','Freshly prepared · 100% vegetarian',249.00,'images/food/items/paneer-chatpata.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(134,11,'Paneer Pasanda','Freshly prepared · 100% vegetarian',239.00,'images/food/items/paneer-pasanda.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(135,12,'Palak Paneer','Freshly prepared · 100% vegetarian',209.00,'images/food/items/palak-paneer.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(136,12,'Matar Paneer','Freshly prepared · 100% vegetarian',209.00,'images/food/items/matar-paneer.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(137,12,'Paneer Bhurji','Freshly prepared · 100% vegetarian',219.00,'images/food/items/paneer-bhurji.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(138,12,'Saag Paneer','Freshly prepared · 100% vegetarian',249.00,'images/food/items/saag-paneer.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(139,12,'Paneer Makhanwala','Freshly prepared · 100% vegetarian',229.00,'images/food/items/paneer-makhanwala.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(140,12,'Tava Paneer','Freshly prepared · 100% vegetarian',259.00,'images/food/items/tava-paneer.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(141,12,'Paneer Kofta','Freshly prepared · 100% vegetarian',259.00,'images/food/items/paneer-kofta.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(142,12,'Malai Kofta (Sweet)','Freshly prepared · 100% vegetarian',229.00,'images/food/items/malai-kofta-sweet.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(143,12,'Ganesh\'s Special Kofta','Freshly prepared · 100% vegetarian',229.00,'images/food/items/ganeshs-special-kofta.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(144,13,'Kaju Paneer Makhani','Freshly prepared · 100% vegetarian',239.00,'images/food/items/kaju-paneer-makhani.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(145,13,'Cheese Butter Masala','Freshly prepared · 100% vegetarian',239.00,'images/food/items/cheese-butter-masala.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(146,13,'Cheese Angoori','Freshly prepared · 100% vegetarian',249.00,'images/food/items/cheese-angoori.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(147,13,'Cheese Paneer Masala','Freshly prepared · 100% vegetarian',249.00,'images/food/items/cheese-paneer-masala.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(148,13,'Cheese Kaju Masala','Freshly prepared · 100% vegetarian',269.00,'images/food/items/cheese-kaju-masala.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(149,14,'Ganesh\'s Special Veg','Freshly prepared · 100% vegetarian',229.00,'images/food/items/ganeshs-special-veg.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(150,14,'Veg Paneer Masala','Freshly prepared · 100% vegetarian',219.00,'images/food/items/veg-paneer-masala.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(151,14,'Veg Makhanwala','Freshly prepared · 100% vegetarian',209.00,'images/food/items/veg-makhanwala.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(152,14,'Veg Jaipuri','Freshly prepared · 100% vegetarian',199.00,'images/food/items/veg-jaipuri.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(153,14,'Veg Handi','Freshly prepared · 100% vegetarian',219.00,'images/food/items/veg-handi.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(154,14,'Veg Kofta','Freshly prepared · 100% vegetarian',219.00,'images/food/items/veg-kofta.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(155,14,'Navratna Korma','Freshly prepared · 100% vegetarian',229.00,'images/food/items/navratna-korma.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(156,14,'Koya Kaju',NULL,239.00,'images/food/items/koya-kaju.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(157,14,'Kaju Curry','Freshly prepared · 100% vegetarian',249.00,'images/food/items/kaju-curry.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(158,14,'Baby Corn Masala','Freshly prepared · 100% vegetarian',239.00,'images/food/items/baby-corn-masala.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(159,14,'Punjabi Dum Aloo','Freshly prepared · 100% vegetarian',189.00,'images/food/items/punjabi-dum-aloo.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(160,14,'Veg Kolhapuri','Freshly prepared · 100% vegetarian',209.00,'images/food/items/veg-kolhapuri.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(161,14,'Veg Kadai','Freshly prepared · 100% vegetarian',209.00,'images/food/items/veg-kadai.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(162,14,'Chana Masala','Freshly prepared · 100% vegetarian',199.00,'images/food/items/chana-masala.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(163,14,'Veg Toofani','Freshly prepared · 100% vegetarian',199.00,'images/food/items/veg-toofani.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(164,14,'Kaju Masala','Freshly prepared · 100% vegetarian',239.00,'images/food/items/kaju-masala.svg',1,1,16,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(165,14,'Veg Tava','Freshly prepared · 100% vegetarian',209.00,'images/food/items/veg-tava.svg',1,1,17,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(166,14,'Mix Veg','Freshly prepared · 100% vegetarian',179.00,'images/food/items/mix-veg.svg',1,1,18,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(167,15,'Dal Fry','Freshly prepared · 100% vegetarian',159.00,'images/food/items/dal-fry.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(168,15,'Dal Tadka','Freshly prepared · 100% vegetarian',169.00,'images/food/items/dal-tadka.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(169,15,'Dal Makhani','Freshly prepared · 100% vegetarian',179.00,'images/food/items/dal-makhani.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(170,15,'Dal Palak','Freshly prepared · 100% vegetarian',169.00,'images/food/items/dal-palak.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(171,16,'Veg Pulav','Freshly prepared · 100% vegetarian',149.00,'images/food/items/veg-pulav.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(172,16,'Jain Pulav','Freshly prepared · 100% vegetarian',149.00,'images/food/items/jain-pulav.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(173,16,'Kashmir Pulav','Freshly prepared · 100% vegetarian',159.00,'images/food/items/kashmir-pulav.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(174,16,'Hyderabadi Pulav','Freshly prepared · 100% vegetarian',169.00,'images/food/items/hyderabadi-pulav.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(175,16,'Cheese Pulav','Freshly prepared · 100% vegetarian',179.00,'images/food/items/cheese-pulav.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(176,16,'Ganesh\'s Special Pulav','Freshly prepared · 100% vegetarian',199.00,'images/food/items/ganeshs-special-pulav.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(177,16,'Jeera Rice','Freshly prepared · 100% vegetarian',119.00,'images/food/items/jeera-rice.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(178,16,'Veg Biryani','Freshly prepared · 100% vegetarian',149.00,'images/food/items/veg-biryani.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(179,16,'Hyderabadi Biryani','Freshly prepared · 100% vegetarian',159.00,'images/food/items/hyderabadi-biryani.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(180,17,'Bhaji Only','Freshly prepared · 100% vegetarian',119.00,'images/food/items/bhaji-only.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(181,17,'Pav Bhaji','Freshly prepared · 100% vegetarian',139.00,'images/food/items/pav-bhaji.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(182,17,'Jain Pav Bhaji','Freshly prepared · 100% vegetarian',139.00,'images/food/items/jain-pav-bhaji.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(183,17,'Green Pav Bhaji','Freshly prepared · 100% vegetarian',159.00,'images/food/items/green-pav-bhaji.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(184,17,'Cheese Pav Bhaji','Freshly prepared · 100% vegetarian',159.00,'images/food/items/cheese-pav-bhaji.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(185,17,'Kaju Pav Bhaji','Freshly prepared · 100% vegetarian',179.00,'images/food/items/kaju-pav-bhaji.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(186,17,'Cheese Paneer Green Pav Bhaji','Freshly prepared · 100% vegetarian',199.00,'images/food/items/cheese-paneer-green-pav-bhaji.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(187,18,'Chaas','Freshly prepared · 100% vegetarian',29.00,'images/food/items/chaas.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(188,18,'Masala Chaas','Freshly prepared · 100% vegetarian',39.00,'images/food/items/masala-chaas.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(189,18,'Gol','Freshly prepared · 100% vegetarian',29.00,'images/food/items/gol.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(190,18,'Ghee','Freshly prepared · 100% vegetarian',39.00,'images/food/items/ghee.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(191,18,'Cold Drink','Freshly prepared · 100% vegetarian',20.00,'images/food/items/cold-drink.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(192,19,'Tandoori Roti','Freshly prepared · 100% vegetarian',29.00,'images/food/items/tandoori-roti.svg',1,1,1,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(193,19,'Butter Tandoori Roti','Freshly prepared · 100% vegetarian',34.00,'images/food/items/butter-tandoori-roti.svg',1,1,2,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(194,19,'Plain Chapati','Freshly prepared · 100% vegetarian',14.00,'images/food/items/plain-chapati.svg',1,1,3,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(195,19,'Ghee Chapati','Freshly prepared · 100% vegetarian',19.00,'images/food/items/ghee-chapati.svg',1,1,4,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(196,19,'Paratha','Freshly prepared · 100% vegetarian',39.00,'images/food/items/paratha.svg',1,1,5,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(197,19,'Bhakhri','Freshly prepared · 100% vegetarian',39.00,'images/food/items/bhakhri.svg',1,1,6,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(198,19,'Plain Naan','Freshly prepared · 100% vegetarian',39.00,'images/food/items/plain-naan.svg',1,1,7,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(199,19,'Butter Naan','Freshly prepared · 100% vegetarian',49.00,'images/food/items/butter-naan.svg',1,1,8,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(200,19,'Kulcha','Freshly prepared · 100% vegetarian',69.00,'images/food/items/kulcha.svg',1,1,9,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(201,19,'Stuffed Paratha','Freshly prepared · 100% vegetarian',59.00,'images/food/items/stuffed-paratha.svg',1,1,10,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(202,19,'Missi Roti','Freshly prepared · 100% vegetarian',59.00,'images/food/items/missi-roti.svg',1,1,11,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(203,19,'Lachha Paratha','Freshly prepared · 100% vegetarian',79.00,'images/food/items/lachha-paratha.svg',1,1,12,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(204,19,'Cheese Naan','Freshly prepared · 100% vegetarian',99.00,'images/food/items/cheese-naan.svg',1,1,13,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(205,19,'Garlic Naan','Freshly prepared · 100% vegetarian',109.00,'images/food/items/garlic-naan.svg',1,1,14,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(206,19,'Cheese Garlic Naan','Freshly prepared · 100% vegetarian',119.00,'images/food/items/cheese-garlic-naan.svg',1,1,15,'2026-09-07 10:25:07','2026-09-07 15:37:09',NULL),(207,6,'Cheese Sweet Corn','Freshly prepared · 100% vegetarian',229.00,'images/food/items/cheese-sweet-corn.svg',1,1,18,'2026-09-07 11:16:38','2026-09-07 15:37:09',NULL),(208,6,'Sandwich','Freshly prepared · 100% vegetarian',239.00,'images/food/items/sandwich.svg',1,1,19,'2026-09-07 11:16:38','2026-09-07 15:37:09',NULL),(209,14,'Khoya Kaju','Freshly prepared · 100% vegetarian',239.00,'images/food/items/khoya-kaju.svg',1,1,8,'2026-09-07 11:16:38','2026-09-07 15:37:09',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_07_100000_create_ganesh_restaurant_tables',1),(5,'2026_09_07_200000_create_order_activity_logs_table',2),(6,'2026_09_07_300000_add_features_tables',3),(7,'2026_09_07_400000_add_multilingual_fields',4),(8,'2026_09_07_500000_create_founders_table',5),(9,'2026_09_07_500000_create_customer_reviews_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_activity_logs`
--

DROP TABLE IF EXISTS `order_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_activity_logs`
--

LOCK TABLES `order_activity_logs` WRITE;
/*!40000 ALTER TABLE `order_activity_logs` DISABLE KEYS */;
INSERT INTO `order_activity_logs` VALUES (1,1,'created','pending','Order placed from website',NULL,'2026-09-07 11:09:45','2026-09-07 11:09:45'),(2,2,'created','pending','Order placed from website',NULL,'2026-09-07 15:39:31','2026-09-07 15:39:31'),(3,3,'created','pending','Order placed from website',NULL,'2026-09-07 16:03:42','2026-09-07 16:03:42'),(4,4,'created','pending','Order placed from website',NULL,'2026-09-07 16:04:59','2026-09-07 16:04:59'),(5,5,'created','pending','Order placed from website',NULL,'2026-09-07 16:06:30','2026-09-07 16:06:30');
/*!40000 ALTER TABLE `order_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `menu_item_id` bigint unsigned DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint unsigned NOT NULL DEFAULT '1',
  `unit_price` decimal(12,2) NOT NULL,
  `line_total` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,5,'Baby Paper',1,79.00,79.00,'2026-09-07 11:09:45','2026-09-07 11:09:45'),(2,1,6,'Garlic Paper',1,89.00,89.00,'2026-09-07 11:09:45','2026-09-07 11:09:45'),(3,2,45,'Surati Mysore',1,139.00,139.00,'2026-09-07 15:39:31','2026-09-07 15:39:31'),(4,2,50,'Gotala Mysore',1,219.00,219.00,'2026-09-07 15:39:31','2026-09-07 15:39:31'),(5,2,87,'Plain Uttapam',1,149.00,149.00,'2026-09-07 15:39:31','2026-09-07 15:39:31'),(6,3,3,'Paper Dosa',1,79.00,79.00,'2026-09-07 16:03:42','2026-09-07 16:03:42'),(7,3,4,'Plain Paper',1,79.00,79.00,'2026-09-07 16:03:42','2026-09-07 16:03:42'),(8,3,5,'Baby Paper',1,89.00,89.00,'2026-09-07 16:03:42','2026-09-07 16:03:42'),(9,4,23,'Harabhara Paper',1,129.00,129.00,'2026-09-07 16:04:59','2026-09-07 16:04:59'),(10,4,24,'Cheese Chilli Garlic',1,139.00,139.00,'2026-09-07 16:04:59','2026-09-07 16:04:59'),(11,4,27,'Chocolate Silencer',1,159.00,159.00,'2026-09-07 16:04:59','2026-09-07 16:04:59'),(12,4,28,'Ganesh\'s Special Paper',1,169.00,169.00,'2026-09-07 16:04:59','2026-09-07 16:04:59'),(13,5,5,'Baby Paper',1,89.00,89.00,'2026-09-07 16:06:30','2026-09-07 16:06:30'),(14,5,6,'Garlic Paper',1,79.00,79.00,'2026-09-07 16:06:30','2026-09-07 16:06:30'),(15,5,25,'Choco Cheese',1,139.00,139.00,'2026-09-07 16:06:30','2026-09-07 16:06:30');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_no_unique` (`order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'ORD-20260907-9710CE','jignesh','92878888','hjkjkh@KJhkj.com','kajsd','kjhkj',168.00,'pending','2026-09-07 11:09:45','2026-09-07 11:09:45'),(2,'ORD-20260907-32B803','jignesh','9276819283','mca.jignesh1948@gmail.com','Ganesh umbadiyu','Make spicy',507.00,'pending','2026-09-07 15:39:31','2026-09-07 15:39:31'),(3,'ORD-20260907-E3BD45','kjh','876876876','iuiuyiyiu@KJhjkhk.com','kjhkj','hkjhjk',247.00,'pending','2026-09-07 16:03:42','2026-09-07 16:03:42'),(4,'ORD-20260907-B775CD','jignesh prajapati','9276819283','mca.jignesh1948@gmaial.com','E101 setu vertica near knpis school','make spicy food',596.00,'pending','2026-09-07 16:04:59','2026-09-07 16:04:59'),(5,'ORD-20260907-695DC4','harsh','9879879877','jhkhjkh@kjhkjh.cok','kjghkjhkjh khkjh kj','hjkhkjh',307.00,'pending','2026-09-07 16:06:30','2026-09-07 16:06:30');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_published` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'home','Welcome to Ganesh The Family Restaurant','<p class=\"lead\">Committed to quality, served with love. We are Ahmedabad\'s favourite destination for <strong>South Indian Dosa</strong>, <strong>Kathiyawadi specials</strong>, <strong>Umbadiyu</strong>, and authentic family dining.</p>\n<p>From classic Paper Dosa to our famous <strong>Burj Khalifa Dosa</strong>, Rajasthani Daal-Bati, and Punjabi Paneer — every dish is prepared fresh with care.</p>\n<ul><li>Umbadiyu Specialist</li><li>Dosa & Uttapam varieties</li><li>Kathiyawadi & Rajasthani cuisine</li><li>Online ordering available</li></ul>','Ganesh The Family Restaurant | Gota Ahmedabad',NULL,1,'2026-09-07 10:11:03','2026-09-07 10:25:07'),(2,'about','About Ganesh The Family Restaurant','<p>Ganesh The Family Restaurant is located on <strong>Jagatpur Road, Gota</strong> — in front of Rangoli, beside Magnate Luxuria. We welcome families, friends, and food lovers with warm hospitality and honest flavours.</p>\n<p>Our menu celebrates Gujarat and India: crispy dosas, Surati Mysore specials, Kathiyawadi gathiya, original Rajasthani Daal-Bati, rich paneer gravies, and fresh tandoor breads.</p>\n<p><strong>Contact:</strong> 9276819283 / 8200692794 · info@ganeshtfr.com</p>',NULL,NULL,1,'2026-09-07 10:11:03','2026-09-07 10:25:07');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
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
  `created_at` datetime DEFAULT NULL,
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
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,'Grand Opening','Celebrating our restaurant launch in Gota',NULL,NULL,1,1,'2026-09-07 10:25:07','2026-09-07 10:25:07'),(2,'Dosa Specials','Paper Dosa, Masala Dosa & Fancy Dosa varieties',NULL,NULL,2,1,'2026-09-07 10:25:07','2026-09-07 10:25:07'),(3,'Kathiyawadi Thali','Authentic Kathiyawadi flavours',NULL,NULL,3,1,'2026-09-07 10:25:07','2026-09-07 10:25:07'),(4,'Family Dining','Perfect place for family gatherings',NULL,NULL,4,1,'2026-09-07 10:25:07','2026-09-07 10:25:07'),(5,'Grand Opening Gota','Celebrating our launch on Jagatpur Road','https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80','2026-08-07',1,1,'2026-09-07 12:59:49','2026-09-07 15:37:10'),(6,'Dosa Festival','Paper Dosa to Burj Khalifa Dosa','https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=800&q=80','2026-07-07',2,1,'2026-09-07 12:59:49','2026-09-07 15:37:10'),(7,'Kathiyawadi Night','Varaliyu & Kaju Gathiya specials','https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80','2026-06-07',3,1,'2026-09-07 12:59:49','2026-09-07 15:37:10'),(8,'Family Celebrations','Birthdays & gatherings welcome','https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800&q=80','2026-05-07',4,1,'2026-09-07 12:59:49','2026-09-07 15:37:10');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `show_once` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'Grand Opening Offer','https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=900&q=80','http://localhost/online-order',1,1,'2026-09-07 10:46:47','2026-09-07 10:46:47');
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary_transactions`
--

DROP TABLE IF EXISTS `salary_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salary_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `month` bigint unsigned DEFAULT NULL,
  `year` bigint unsigned DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary_transactions`
--

LOCK TABLES `salary_transactions` WRITE;
/*!40000 ALTER TABLE `salary_transactions` DISABLE KEYS */;
INSERT INTO `salary_transactions` VALUES (2,4,'advance',10000.00,'2026-09-10',9,2026,NULL,'2026-09-10 10:10:02','2026-09-10 10:10:02');
/*!40000 ALTER TABLE `salary_transactions` ENABLE KEYS */;
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
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` bigint unsigned NOT NULL,
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
INSERT INTO `sessions` VALUES ('chOSVdzv8Pffrdb34mQHVgzSKxRBw2o3hY4FnsJC',2,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNjVzeG10aGw0WTM3cDZidGdLM3E5UWlabUVDamRldzU3b1VCdnVQRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5MC9hZG1pbi9vcmRlcnMtcG9sbC9uZXc/YWZ0ZXI9NSI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4ub3JkZXJzLnBvbGwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=',1789055890),('h77ly6s1Cdyh2bDFcqt7BiPx97GQvWR4qRJfbzER',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUc5elY1WTNTWUpzWkFGR0h1ZzFHeXRrUXRVWUJoZ2tJYmE2QjQ5UyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODA5MC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1789056169);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'site_name','Ganesh The Family Restaurant','2026-09-07 10:11:03','2026-09-07 10:11:03'),(2,'tagline','Committed to Quality · Served with Love · Umbadiyu Specialist','2026-09-07 10:11:03','2026-09-07 10:25:07'),(3,'phone','9276819283, 8200692794','2026-09-07 10:11:03','2026-09-07 10:25:07'),(4,'email','info@ganeshtfr.com','2026-09-07 10:11:03','2026-09-07 10:25:07'),(5,'address','In front of Rangoli, Beside Magnate Luxuria, Jagatpur Road, Gota, Ahmedabad - 382481','2026-09-07 10:11:03','2026-09-07 10:25:07'),(6,'opening_hours','Open Daily: 10:00 AM – 11:00 PM','2026-09-07 10:11:03','2026-09-07 10:25:07'),(7,'order_notify_email','info@ganeshtfr.com','2026-09-07 10:11:03','2026-09-07 10:25:07'),(8,'whatsapp_number','919276819283','2026-09-07 10:11:03','2026-09-07 10:25:07'),(9,'instagram_url','https://instagram.com/ganesh_the_family_restaurant','2026-09-07 10:25:07','2026-09-07 10:25:07');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sops`
--

DROP TABLE IF EXISTS `sops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1.0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sops`
--

LOCK TABLES `sops` WRITE;
/*!40000 ALTER TABLE `sops` DISABLE KEYS */;
/*!40000 ALTER TABLE `sops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `monthly_salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (4,'Ramesh bhai','8787687877','ramesh@chokari.com','Safe','2026-10-29',25000.00,1,NULL,'2026-09-10 10:09:04','2026-09-10 10:09:04'),(5,'kesu bhai','9879879877','kesu@majbutsingh.com','safe','2025-11-30',27000.00,1,NULL,'2026-09-10 10:09:36','2026-09-10 10:09:36');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Ganesh Patel','Owner & Head Chef','25+ years serving authentic Gujarati & South Indian cuisine.',NULL,NULL,1,1,'2026-09-07 10:46:47','2026-09-07 10:46:47'),(2,'Priya Shah','Restaurant Manager','Ensures every guest feels like family.',NULL,NULL,2,1,'2026-09-07 10:46:47','2026-09-07 10:46:47'),(3,'Ravi Kumar','Head Cook — Dosa Section','Master of Paper Dosa & Fancy Dosa varieties.',NULL,NULL,3,1,'2026-09-07 10:46:47','2026-09-07 10:46:47'),(4,'Meena Desai','Front Desk','Handles orders, reservations & customer care.',NULL,'8200692794',4,1,'2026-09-07 10:46:47','2026-09-07 10:46:47');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
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
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ganesh Admin','admin@ganeshrestaurant.com',NULL,'$2y$12$UMoxTXw/JWGX5h.BtMdx4.qG5bQTjPgaKVt2Ufwhu4DxEzN71rcfS',NULL,'2026-09-07 10:11:03','2026-09-07 10:11:03'),(2,'Ganesh Admin','admin@ganeshtfr.com',NULL,'$2y$12$TRD9P6QhwBSI03ZKOoP7euOWUkIckpfMXgwGECYWWFeuWjR8qGY6e',NULL,'2026-09-07 10:25:07','2026-09-07 15:37:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vegetable_price_logs`
--

DROP TABLE IF EXISTS `vegetable_price_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vegetable_price_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vegetable_id` bigint unsigned NOT NULL,
  `retail_price_per_kg` decimal(12,2) NOT NULL,
  `vendor_price_per_kg` decimal(12,2) DEFAULT NULL,
  `logged_date` date NOT NULL,
  `changed_by` bigint unsigned DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vegetable_price_logs`
--

LOCK TABLES `vegetable_price_logs` WRITE;
/*!40000 ALTER TABLE `vegetable_price_logs` DISABLE KEYS */;
INSERT INTO `vegetable_price_logs` VALUES (1,1,50.00,32.00,'2026-09-07',2,'Price updated','2026-09-07 15:13:38','2026-09-07 15:13:38');
/*!40000 ALTER TABLE `vegetable_price_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vegetable_sales`
--

DROP TABLE IF EXISTS `vegetable_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vegetable_sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vegetable_id` bigint unsigned NOT NULL,
  `grams` decimal(12,2) NOT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retail',
  `unit_price_per_kg` decimal(12,2) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `sold_date` date NOT NULL,
  `customer_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vegetable_sales`
--

LOCK TABLES `vegetable_sales` WRITE;
/*!40000 ALTER TABLE `vegetable_sales` DISABLE KEYS */;
INSERT INTO `vegetable_sales` VALUES (1,1,500.00,'retail',40.00,20.00,'2026-09-07',NULL,NULL,'2026-09-07 10:50:48','2026-09-07 10:50:48'),(2,2,550.00,'retail',35.00,19.25,'2026-09-07',NULL,NULL,'2026-09-07 10:50:48','2026-09-07 10:50:48'),(3,1,537.00,'retail',40.00,21.48,'2026-09-07',NULL,NULL,'2026-09-07 14:40:54','2026-09-07 14:40:54'),(4,22,100.00,'retail',80.00,8.00,'2026-09-07',NULL,NULL,'2026-09-07 14:40:54','2026-09-07 14:40:54'),(5,21,400.00,'retail',120.00,48.00,'2026-09-07',NULL,NULL,'2026-09-07 14:42:55','2026-09-07 14:42:55'),(6,22,190.00,'retail',80.00,15.20,'2026-09-07',NULL,NULL,'2026-09-07 14:42:55','2026-09-07 14:42:55'),(7,15,150.00,'retail',60.00,9.00,'2026-09-07',NULL,NULL,'2026-09-07 14:54:30','2026-09-07 14:54:30'),(8,15,400.00,'retail',60.00,24.00,'2026-09-07',NULL,NULL,'2026-09-07 14:54:30','2026-09-07 14:54:30'),(9,31,200.00,'retail',40.00,8.00,'2026-09-07',NULL,NULL,'2026-09-07 14:54:30','2026-09-07 14:54:30');
/*!40000 ALTER TABLE `vegetable_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vegetables`
--

DROP TABLE IF EXISTS `vegetables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vegetables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vegetable',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `retail_price_per_kg` decimal(12,2) NOT NULL,
  `vendor_price_per_kg` decimal(12,2) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kg',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `name_hi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_gu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_hi` text COLLATE utf8mb4_unicode_ci,
  `description_gu` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vegetables`
--

LOCK TABLES `vegetables` WRITE;
/*!40000 ALTER TABLE `vegetables` DISABLE KEYS */;
INSERT INTO `vegetables` VALUES (1,'Tomato','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',40.00,32.00,'kg',1,1,'2026-09-07 10:11:03','2026-09-07 15:37:10','Fresh red tomatoes','टमाटर','ટામેટા','ताज़े लाल टमाटर','તાજા લાલ ટામેટા'),(2,'Onion','vegetable','https://images.unsplash.com/photo-1518977956812-cd3db2704828?w=200&q=80',35.00,28.00,'kg',1,31,'2026-09-07 10:11:03','2026-09-07 14:34:37','Premium onions','प्याज','ડુંગળી','ताज़ा प्याज','તાજી ડુંગળી'),(3,'Potato','vegetable','https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=200&q=80',30.00,24.00,'kg',1,32,'2026-09-07 10:11:03','2026-09-07 15:37:10','Clean potatoes','आलू','બટાટું','आलू','બટાટું'),(4,'Carrot','vegetable','https://images.unsplash.com/photo-1598170845058-32b9d6d5ba37?w=200&q=80',70.00,56.00,'kg',1,11,'2026-09-07 10:11:03','2026-09-07 14:34:37','Sweet orange carrots','गाजर','ગાજર','मीठी गाजर','મીઠા ગાજર'),(5,'Capsicum','vegetable','https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?w=200&q=80',60.00,48.00,'kg',1,14,'2026-09-07 10:25:07','2026-09-07 15:37:10','Crunchy bell peppers','शिमला मिर्च','કેપ્સિકમ','शिमला मिर्च','કેપ્સિકમ'),(6,'Cauliflower','vegetable','https://images.unsplash.com/photo-1610832958506-aa56368176?w=200&q=80',60.00,48.00,'kg',1,3,'2026-09-07 10:25:07','2026-09-07 14:34:37','Farm fresh cauliflower','फूलगोभी','ફૂલવાર','ताज़ी फूलगोभी','તાજી ફૂલવાર'),(7,'Cabbage','vegetable','https://images.unsplash.com/photo-1594282486552-05b4d8267489?w=200&q=80',40.00,32.00,'kg',1,13,'2026-09-07 11:16:38','2026-09-07 14:34:37','Fresh green cabbage','पत्तागोभी','કોબી','ताज़ी पत्तागोभी','તાજી કોબી'),(8,'Brinjal','vegetable','https://images.unsplash.com/photo-1628773824103-0d99007fa703?w=200&q=80',60.00,48.00,'kg',1,9,'2026-09-07 11:16:38','2026-09-07 14:34:37','Purple brinjal','बैंगन','રીંગણ','बैंगन','રીંગણ'),(9,'Green Peas','vegetable','https://images.unsplash.com/photo-1459411621453-7b03977f6332?w=200&q=80',80.00,64.00,'kg',1,33,'2026-09-07 11:16:38','2026-09-07 14:34:37','Sweet green peas','मटर','વટાણા','हरे मटर','લીલા વટાણા'),(10,'Coriander','vegetable','https://images.unsplash.com/photo-1618375569902-5c3a8d140f27?w=200&q=80',20.00,15.00,'kg',1,10,'2026-09-07 11:16:38','2026-09-07 12:59:49','Aromatic fresh coriander leaves bunch','धनिया','કોથમીર','ताज़ा धनिया','તાજું કોથમીર'),(11,'Ginger','vegetable','https://images.unsplash.com/photo-1615485290382-441e4d046cb5?w=200&q=80',150.00,120.00,'kg',1,21,'2026-09-07 11:16:38','2026-09-07 14:34:37','Fresh ginger root','अदरक','આદુ','ताज़ी अदरक','તાજું આદુ'),(12,'Garlic','vegetable','https://images.unsplash.com/photo-1607613009820-a38f7a8c8a8e?w=200&q=80',180.00,144.00,'kg',1,34,'2026-09-07 11:16:38','2026-09-07 14:34:37','Fresh garlic bulbs','लहसुन','લસણ','लहसुन','લસણ'),(13,'Bottle Gourd','vegetable','https://images.unsplash.com/photo-1594282486552-05b4d8267489?w=200&q=80',50.00,40.00,'kg',1,2,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh bottle gourd','लौकी','દૂધી','ताज़ी लौकी','તાજી દૂધી'),(14,'Okra','vegetable','https://images.unsplash.com/photo-1607301401176-3c9a0a0a0a0a?w=200&q=80',60.00,48.00,'kg',1,4,'2026-09-07 14:34:37','2026-09-07 14:34:37','Tender lady finger','भिंडी','ભીંડા','कोमल भिंडी','નરમ ભીંડા'),(15,'Green Chili','vegetable','https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?w=200&q=80',60.00,48.00,'kg',1,5,'2026-09-07 14:34:37','2026-09-07 15:37:10','Fresh green chilies','हरी मिर्च','મરચા','ताज़ी हरी मिर्च','તાજા મરચા'),(16,'Cluster Beans','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',100.00,80.00,'kg',1,6,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh cluster beans','गवार फली','ગવાર','ताज़ी गवार','તાજા ગવાર'),(17,'Ivy Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',70.00,56.00,'kg',1,7,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh ivy gourd','कुंदरू','ટીંડોરા','ताज़ा कुंदरू','તાજા ટીંડોરા'),(18,'Small Brinjal','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',60.00,48.00,'kg',1,8,'2026-09-07 14:34:37','2026-09-07 14:34:37','Small brinjal for shaak','छोटा बैंगन','રવૈયા','छोटा बैंगन','નાના રવૈયા'),(19,'Cowpea','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',60.00,48.00,'kg',1,10,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh cowpea beans','चौली','ચોરી','ताज़ी चौली','તાજી ચોરી'),(20,'Lemon','vegetable','https://images.unsplash.com/photo-1546173159-315724a31696?w=200&q=80',180.00,144.00,'kg',1,12,'2026-09-07 14:34:37','2026-09-07 15:37:10','Fresh lemons','नीबू','લીંબુ','ताज़े नीबू','તાજા લીંબુ'),(21,'Spring Onion','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',120.00,96.00,'kg',1,15,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh spring onion bunch','हरा प्याज','લીલું ડુંગળી','हरा प्याज','લીલું ડુંગળી'),(22,'Spinach','vegetable','https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=200&q=80',80.00,64.00,'kg',1,16,'2026-09-07 14:34:37','2026-09-07 15:37:10','Fresh spinach leaves','पालक','પાલક','ताज़ा पालक','તાજું પાલક'),(23,'Fenugreek','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',150.00,120.00,'kg',1,17,'2026-09-07 14:34:37','2026-09-07 14:34:37','Aromatic fenugreek leaves','मेथी','મેથી','ताज़ी मेथी','તાજી મેથી'),(24,'Ridge Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',40.00,32.00,'kg',1,18,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh ridge gourd','तोरई','ગલકા','तोरई','ગલકા'),(25,'Bitter Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',50.00,40.00,'kg',1,19,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh bitter gourd','करेला','કારેલા','करेला','કારેલા'),(26,'Sponge Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',40.00,32.00,'kg',1,20,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh sponge gourd','घिया','તુરીયા','घिया','તુરીયા'),(27,'Coriander Leaves','vegetable','https://images.unsplash.com/photo-1618375569902-5c3a8d140f27?w=200&q=80',90.00,72.00,'kg',1,22,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh coriander bunch','धनिया पत्ता','ધાણાભાજી','ताज़ा धनिया','તાજું ધાણાભાજી'),(28,'Large Chili','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',60.00,48.00,'kg',1,23,'2026-09-07 14:34:37','2026-09-07 14:34:37','Large green chilies','बड़ी मिर्च','મોટા મરચા','बड़ी मिर्च','મોટા મરચા'),(29,'Pointed Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',60.00,48.00,'kg',1,24,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh pointed gourd','परवल','પરવર','परवल','પરવર'),(30,'Spiny Gourd','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',220.00,176.00,'kg',1,25,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh spiny gourd','कंकोडा','કંકોડા','कंकोडा','કંકોડા'),(31,'Tandarjo','vegetable','https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',40.00,32.00,'kg',1,26,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh tandarjo greens','हरी सब्जी','તંદરજો','ताज़ा हरी सब्जी','તાજું તંદરજો'),(32,'Mint','vegetable','https://images.unsplash.com/photo-1628556270448-4fef4f8f0707?w=200&q=80',100.00,80.00,'kg',1,27,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh mint leaves','पुदीना','ફુદીનો','ताज़ा पुदीना','તાજું ફુદીનો'),(33,'Banana','fruit','https://images.unsplash.com/photo-1571771894821-ce9b6c11fe08?w=200&q=80',60.00,48.00,'kg',1,28,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh bananas','केला','કેળા','ताज़े केले','તાજા કેળા'),(34,'Pomegranate','fruit','https://images.unsplash.com/photo-1615485925617-9c2f5a0a0a0a?w=200&q=80',150.00,120.00,'kg',1,29,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh pomegranate','अनार','દાડમ','ताज़ा अनार','તાજું દાડમ'),(35,'Apple','fruit','https://images.unsplash.com/photo-1560806887-1e4cd0b27c6?w=200&q=80',150.00,120.00,'kg',1,30,'2026-09-07 14:34:37','2026-09-07 14:34:37','Fresh apples','सेब','સફરજન','ताज़े सेब','તાજા સફરજન');
/*!40000 ALTER TABLE `vegetables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_categories`
--

DROP TABLE IF EXISTS `video_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_categories`
--

LOCK TABLES `video_categories` WRITE;
/*!40000 ALTER TABLE `video_categories` DISABLE KEYS */;
INSERT INTO `video_categories` VALUES (1,'Restaurant Videos',1,1,'2026-09-07 10:25:07','2026-09-07 10:25:07');
/*!40000 ALTER TABLE `video_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `video_category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` bigint unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,1,'Ganesh The Family Restaurant','Visit us at Gota, Ahmedabad','https://www.youtube.com/watch?v=dQw4w9WgXcQ',NULL,NULL,1,1,'2026-09-07 10:25:07','2026-09-07 10:25:07'),(2,1,'Restaurant Tour','Take a look inside Ganesh The Family Restaurant','https://www.youtube.com/watch?v=9bZkp7q19f0',NULL,NULL,1,1,'2026-09-07 12:59:49','2026-09-07 12:59:49'),(3,1,'Dosa Making','Watch our chefs prepare crispy dosas','https://www.youtube.com/watch?v=dQw4w9WgXcQ',NULL,NULL,2,1,'2026-09-07 12:59:49','2026-09-07 12:59:49');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-10 21:39:30
