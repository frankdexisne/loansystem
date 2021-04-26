-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: dbloans
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_name_unique` (`name`),
  KEY `areas_branch_id_foreign` (`branch_id`),
  CONSTRAINT `areas_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,'Area 1','2020-09-21 13:08:55','2020-09-21 13:08:55'),(2,1,'Area 2','2020-09-21 13:09:48','2020-09-21 13:09:48'),(3,1,'Area 3','2020-09-21 13:11:01','2020-09-21 13:11:01'),(4,1,'Area 4','2020-09-21 13:11:48','2020-09-21 13:11:48');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beneficiaries_client_id_lname_fname_mname_unique` (`client_id`,`lname`,`fname`,`mname`),
  KEY `beneficiaries_relationship_id_foreign` (`relationship_id`),
  CONSTRAINT `beneficiaries_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `beneficiaries_relationship_id_foreign` FOREIGN KEY (`relationship_id`) REFERENCES `relationships` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Main Branch','2020-05-06 10:51:30','2020-05-06 10:51:30');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Business Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(2,'Emergency Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(3,'Construction Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(4,'Salary Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(5,'Group Loan','2020-05-06 10:51:31','2020-09-21 14:12:54'),(6,'Insurance','2020-09-29 13:14:03','2020-09-29 13:14:03'),(7,'Individual Loan','2020-10-18 22:53:00','2020-10-18 22:53:00');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_percent` int(11) NOT NULL DEFAULT '0',
  `is_visible` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `charges_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charges`
--

LOCK TABLES `charges` WRITE;
/*!40000 ALTER TABLE `charges` DISABLE KEYS */;
INSERT INTO `charges` VALUES (1,'Interest',10,1,0,'2020-05-06 11:07:54','2020-08-16 06:28:38'),(2,'Loan Processing',50,0,1,'2020-05-06 11:08:16','2020-05-06 11:08:16'),(3,'Attorneys Fee',100,0,1,'2020-05-06 11:08:31','2020-05-06 11:08:31'),(4,'Capital Build Up',30,0,0,'2020-05-06 11:08:45','2020-05-06 11:08:45'),(5,'Interest(Grocery Loan)',20,1,0,'2020-08-16 06:29:36','2020-08-25 14:03:48'),(6,'Loan Security',50,0,1,NULL,NULL),(7,'Insurance',100,0,1,NULL,NULL),(8,'Prev Balance',0,0,1,NULL,NULL);
/*!40000 ALTER TABLE `charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_salary` double NOT NULL,
  `area_id` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_lname_fname_mname_unique` (`lname`,`fname`,`mname`),
  UNIQUE KEY `clients_account_no_unique` (`account_no`),
  KEY `clients_area_id_foreign` (`area_id`),
  KEY `clients_group_id_foreign` (`group_id`),
  CONSTRAINT `clients_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  CONSTRAINT `clients_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_types`
--

DROP TABLE IF EXISTS `expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expense_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_types`
--

LOCK TABLES `expense_types` WRITE;
/*!40000 ALTER TABLE `expense_types` DISABLE KEYS */;
INSERT INTO `expense_types` VALUES (1,'Employee Allowance','2020-10-11 07:06:37','2020-10-11 07:06:37'),(2,'Operational Expenses','2020-10-11 07:06:37','2020-10-11 07:06:37');
/*!40000 ALTER TABLE `expense_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expense_type_id` bigint(20) unsigned NOT NULL,
  `expense_date` date NOT NULL,
  `ornos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_expense_type_id_foreign` (`expense_type_id`),
  KEY `expenses_employee_id_foreign` (`employee_id`),
  CONSTRAINT `expenses_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `dbpayroll`.`employees` (`id`),
  CONSTRAINT `expenses_expense_type_id_foreign` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (1,1,'2020-11-03','262051',20,'Fuel',100,'2020-11-15 23:44:19','2020-11-15 23:44:19'),(2,1,'2020-11-03','351081',22,'Fuel',100,'2020-11-15 23:45:29','2020-11-15 23:45:29'),(3,1,'2020-11-03','262119',21,'Fuel',150,'2020-11-15 23:46:21','2020-11-15 23:46:21'),(5,1,'2020-11-04','262669',20,'Fuel',100,'2020-11-15 23:48:13','2020-11-15 23:48:13'),(6,2,'2020-11-04','395526',24,'Office Supply',241,'2020-11-15 23:55:55','2020-11-15 23:55:55'),(7,2,'2020-11-04','41655',21,'Motorcycle',130,'2020-11-15 23:59:04','2020-11-15 23:59:04'),(8,1,'2020-11-04','943600',22,'Fuel',100,'2020-11-15 23:59:42','2020-11-15 23:59:42'),(9,1,'2020-11-04','185818',21,'Fuel',100,'2020-11-16 00:00:10','2020-11-16 00:00:10'),(10,2,'2020-11-04','1208',6,'Office Supply',30,'2020-11-16 00:00:55','2020-11-16 00:00:55'),(11,1,'2020-11-05','263495',5,'Fuel',150,'2020-11-16 00:01:41','2020-11-16 00:01:41'),(12,2,'2020-11-05','2603',5,'Others',3843,'2020-11-16 00:02:45','2020-11-16 00:02:45'),(13,2,'2020-11-06','6862',21,'Motorcycle',190,'2020-11-16 00:03:33','2020-11-16 00:03:33'),(14,1,'2020-11-06','264435',20,'Fuel',100,'2020-11-16 00:04:09','2020-11-16 00:04:09'),(15,1,'2020-11-09','351864',22,'Fuel',100,'2020-11-16 00:09:00','2020-11-16 00:09:00'),(16,1,'2020-11-12','3276649',21,'Fuel',100,'2020-11-16 00:09:31','2020-11-16 00:09:31'),(17,1,'2020-11-12','352022',19,'Fuel',75,'2020-11-16 00:10:13','2020-11-16 00:10:13'),(18,1,'2020-11-13','352156',20,'Fuel',60,'2020-11-16 00:10:48','2020-11-16 00:10:48'),(19,1,'2020-11-13','352155',22,'Fuel',60,'2020-11-16 00:14:23','2020-11-16 00:14:23'),(20,2,'2020-11-13','1845517',6,'Office Supply',78.5,'2020-11-16 18:57:14','2020-11-16 18:57:14'),(21,1,'2020-11-15','126669',21,'Fuel',100,'2020-11-16 18:57:56','2020-11-16 18:57:56'),(22,1,'2020-11-16','951569',5,'Fuel',100,'2020-11-16 18:58:19','2020-11-16 18:58:19'),(23,1,'2020-11-16','951568',5,'Fuel',100,'2020-11-16 18:58:50','2020-11-16 18:58:50'),(24,2,'2020-11-16','2314',24,'Other',1082.74,'2020-11-16 19:00:25','2020-11-16 19:00:25'),(25,2,'2020-11-16','2311',24,'Other',500,'2020-11-16 19:00:40','2020-11-16 19:00:40'),(26,1,'2020-11-16','291314',22,'Fuel',120,'2020-11-16 19:01:35','2020-11-16 19:01:35'),(27,1,'2020-11-17','352368',19,'Fuel',115,'2020-11-16 23:33:55','2020-11-16 23:33:55'),(28,2,'2020-11-17','35128',22,'Motorcycle',1650,'2020-11-16 23:34:20','2020-11-16 23:34:20'),(29,1,'2020-11-18','352410',21,'Fuel',100,'2020-11-18 18:44:09','2020-11-18 18:44:09'),(30,1,'2020-11-18','352437',19,'Fuel',50,'2020-11-18 18:44:40','2020-11-18 18:44:40'),(31,2,'2020-11-18','382987',24,'Office Supply',122.5,'2020-11-18 18:45:18','2020-11-18 18:45:18'),(32,2,'2020-11-18','21933',24,'Office Supply',355,'2020-11-18 18:45:35','2020-11-18 18:45:35'),(33,1,'2020-11-18','952877',20,'Fuel',150,'2020-11-18 23:26:59','2020-11-18 23:26:59'),(34,1,'2020-11-19','126832',5,'Fuel',100,'2020-11-22 16:45:49','2020-11-22 16:45:49'),(35,1,'2020-11-20','142247',5,'Fuel',100,'2020-11-22 16:46:05','2020-11-22 16:46:05'),(36,1,'2020-11-23','41239',21,'Fuel',100,'2020-11-22 19:03:22','2020-11-22 19:03:22'),(37,1,'2020-11-24','952994',20,'Fuel',100,'2020-11-23 22:29:22','2020-11-23 22:29:22'),(39,1,'2020-11-21','60501',20,'Fuel',100,'2020-11-23 22:29:51','2020-11-23 22:29:51'),(40,1,'2020-11-19','80557',20,'Fuel',100,'2020-11-23 22:30:26','2020-11-23 22:30:26'),(41,1,'2020-11-24','352747',20,'Fuel',100,'2020-11-24 19:06:41','2020-11-24 19:06:41'),(42,1,'2020-11-23','352125',21,'Fuel',100,'2020-11-24 19:07:10','2020-11-24 19:07:10'),(43,1,'2020-11-24','127050',5,'Fuel',100,'2020-11-24 22:21:30','2020-11-24 22:21:30'),(44,1,'2020-11-20','270218',21,'Fuel',100,'2020-11-24 22:24:50','2020-11-24 22:24:50'),(45,1,'2020-11-25','60866',19,'Fuel',50,'2020-11-24 22:27:17','2020-11-24 22:27:17'),(46,1,'2020-11-25','157029',22,'Fuel',100,'2020-11-25 00:05:35','2020-11-25 00:05:35'),(47,1,'2020-11-26','152041',22,'Fuel',100,'2020-11-26 21:15:53','2020-11-26 21:15:53'),(48,1,'2020-11-25','273451',21,'Fuel',50,'2020-11-26 21:16:20','2020-11-26 21:16:20'),(49,1,'2020-11-26','956452',20,'Fuel',100,'2020-11-26 21:21:31','2020-11-26 21:21:31'),(50,1,'2020-11-26','273882',21,'Fuel',100,'2020-11-26 21:23:09','2020-11-26 21:23:09'),(51,1,'2020-11-27','274459',21,'Fuel',100,'2020-11-26 21:24:11','2020-11-26 21:24:11'),(52,1,'2020-11-25','81756',5,'Fuel',50,'2020-12-01 17:29:23','2020-12-01 17:29:23'),(53,1,'2020-11-28','82202',5,'Fuel',60,'2020-12-01 17:30:58','2020-12-01 17:30:58'),(54,2,'2020-11-27','269477',6,'Office Supply',332,'2020-12-01 17:34:35','2020-12-01 17:34:35'),(55,1,'2020-11-29','275741',5,'Fuel',100,'2020-12-01 17:36:07','2020-12-01 17:36:07'),(56,2,'2020-11-30','0564',5,'Meal',299,'2020-12-01 17:42:53','2020-12-01 17:42:53'),(57,2,'2020-11-30','53126',5,'Meal',250,'2020-12-01 17:43:05','2020-12-01 17:43:05'),(58,1,'2020-12-01','335052',5,'Fuel',143.05,'2020-12-01 17:55:08','2020-12-01 17:55:08'),(59,1,'2020-12-01','205002',20,'Fuel',150,'2020-12-01 17:56:16','2020-12-01 17:56:16'),(60,1,'2020-12-01','353064',21,'Fuel',100,'2020-12-01 17:57:10','2020-12-01 17:57:10'),(61,1,'2020-12-02','277259',22,'Fuel',150,'2020-12-06 23:58:09','2020-12-06 23:58:09'),(62,1,'2020-12-02','353167',20,'Fuel',100,'2020-12-07 00:13:59','2020-12-07 00:13:59'),(63,1,'2020-12-02','57093',20,'Fuel',100,'2020-12-07 00:14:46','2020-12-07 00:14:46'),(64,2,'2020-12-02','90464',5,'Office Supply',29,'2020-12-07 00:15:30','2020-12-07 00:15:30'),(65,1,'2020-12-02','603436',21,'Fuel',50,'2020-12-07 00:16:08','2020-12-07 00:16:08'),(66,1,'2020-12-02','277576',20,'Fuel',50,'2020-12-07 00:16:39','2020-12-07 00:16:39'),(67,2,'2020-12-03','1217',6,'Office Supply',30,'2020-12-07 00:18:06','2020-12-07 00:18:06'),(68,2,'2020-12-03','0008',24,'Internet Bill',5421,'2020-12-07 00:23:08','2020-12-07 00:23:08'),(69,2,'2020-12-03','95648',24,'Others',2930,'2020-12-07 00:25:43','2020-12-07 00:25:43'),(70,2,'2020-12-03','1261',24,'Others',480,'2020-12-07 00:28:46','2020-12-07 00:28:46'),(71,1,'2020-12-04','959384',20,'Fuel',100,'2020-12-07 00:30:26','2020-12-07 00:30:26'),(72,1,'2020-12-04','127475',5,'Fuel',100,'2020-12-07 00:32:11','2020-12-07 00:32:11'),(73,2,'2020-12-04','0006',24,'Retainers fee',5000,'2020-12-08 16:38:37','2020-12-08 16:38:37'),(74,2,'2020-12-07','271213',6,'Office Supply',239,'2020-12-08 16:39:11','2020-12-08 16:39:11'),(75,1,'2020-12-07','396602',6,'Fuel',100,'2020-12-08 16:39:39','2020-12-08 16:39:39'),(76,2,'2020-12-04','1761',21,'Motorcycle',820,'2020-12-08 19:44:36','2020-12-08 19:44:36'),(77,1,'2020-12-07','83863',20,'Fuel',80,'2020-12-10 16:11:39','2020-12-10 16:11:39'),(78,1,'2020-12-09','281400',21,'Fuel',80,'2020-12-10 16:12:45','2020-12-10 16:12:45'),(79,1,'2020-12-11','205457',20,'Fuel',100,'2020-12-10 23:58:21','2020-12-10 23:58:21'),(80,1,'2020-12-10','84454',5,'Fuel',50,'2020-12-14 16:03:42','2020-12-14 16:03:42'),(81,1,'2020-12-11','19917',5,'Fuel',100,'2020-12-14 16:05:09','2020-12-14 16:05:09'),(82,1,'2020-12-14','284203',20,'Fuel',100,'2020-12-14 16:07:16','2020-12-14 16:07:16'),(83,1,'2020-12-14','283990',20,'Fuel',100,'2020-12-14 16:07:31','2020-12-14 16:07:31'),(84,1,'2021-01-04','354681',21,'Fuel',200,'2021-01-05 00:15:42','2021-01-05 00:15:42'),(85,2,'2021-01-04','1223',6,'Office Supply',30,'2021-01-05 00:16:16','2021-01-05 00:16:16'),(86,1,'2021-01-05','537137',5,'Fuel',100,'2021-01-05 00:17:01','2021-01-05 00:17:01'),(87,1,'2021-01-05','354801',21,'Fuel',50,'2021-01-05 00:17:30','2021-01-05 00:17:30'),(88,1,'2021-01-05','354823',20,'Fuel',150,'2021-01-05 00:18:00','2021-01-05 00:18:00'),(89,1,'2021-01-05','973339',20,'Fuel',100,'2021-01-05 00:18:38','2021-01-05 00:18:38'),(90,2,'2021-01-05','272874',6,'Office Supply',313,'2021-01-05 00:19:17','2021-01-05 00:19:17'),(91,1,'2021-01-06','138770',5,'Fuel',50,'2021-01-06 00:37:09','2021-01-06 00:37:09'),(92,1,'2021-01-06','354778',21,'Fuel',200,'2021-01-06 00:37:52','2021-01-06 00:37:52'),(93,2,'2021-01-06','1307',21,'Motorcycle',160,'2021-01-06 00:38:20','2021-01-06 00:38:20'),(94,1,'2021-01-06','295828',20,'Fuel',80,'2021-01-06 00:38:46','2021-01-06 00:38:46'),(95,1,'2021-01-06','304952',20,'Fuel',80,'2021-01-06 00:38:59','2021-01-06 00:38:59'),(96,1,'2021-01-06','164216',22,'Fuel',200,'2021-01-06 00:39:35','2021-01-06 00:39:35'),(97,2,'2021-01-06','196003',6,'Office Supply',141.75,'2021-01-06 00:40:17','2021-01-06 00:40:17'),(98,1,'2021-01-07','89864',5,'Fuel',100,'2021-01-06 23:27:42','2021-01-06 23:27:42'),(99,2,'2021-01-06','2312791',5,'Others',175,'2021-01-06 23:28:57','2021-01-06 23:28:57'),(100,2,'2021-01-07','2312892',5,'Others',4500,'2021-01-06 23:30:06','2021-01-06 23:30:06'),(101,1,'2021-01-07','350836',22,'Fuel',150,'2021-01-07 00:58:59','2021-01-07 00:58:59'),(102,1,'2021-01-07','354853',21,'Fuel',150,'2021-01-07 00:59:13','2021-01-07 00:59:13'),(103,2,'2021-01-08','18433',5,'Others',2800,'2021-01-07 18:13:50','2021-01-07 18:13:50'),(104,1,'2021-01-08','14559',5,'Fuel',50,'2021-01-07 21:04:10','2021-01-07 21:04:10'),(105,1,'2021-01-08','89953',5,'Fuel',50,'2021-01-07 21:05:32','2021-01-07 21:05:32'),(106,1,'2021-01-08','351188',22,'Fuel',200,'2021-01-08 00:22:24','2021-01-08 00:22:24'),(107,1,'2021-01-08','354963',21,'Fuel',100,'2021-01-08 00:22:44','2021-01-08 00:22:44'),(108,1,'2021-01-08','216201',20,'Fuel',100,'2021-01-08 00:23:11','2021-01-08 00:23:11'),(109,2,'2021-01-08','134840',5,'Others',60,'2021-01-08 00:23:42','2021-01-08 00:23:42'),(110,2,'2021-01-08','5237368',5,'Others',500,'2021-01-08 00:24:12','2021-01-08 00:24:12'),(111,1,'2021-01-11','298599',5,'Fuel',100,'2021-01-10 23:54:38','2021-01-10 23:54:38'),(112,1,'2021-01-11','206772',20,'Fuel',100,'2021-01-11 16:15:42','2021-01-11 16:15:42'),(113,1,'2021-01-11','970582',22,'Fuel',150,'2021-01-11 16:16:11','2021-01-11 16:16:11'),(114,1,'2021-01-12','90735',5,'Fuel',100,'2021-01-11 23:05:49','2021-01-11 23:05:49'),(115,1,'2021-01-12','355064',21,'Fuel',100,'2021-01-11 23:31:22','2021-01-11 23:31:22'),(116,2,'2021-01-13','08',24,'Others',3309,'2021-01-13 17:03:13','2021-01-13 17:03:13'),(117,1,'2021-01-13','14693',5,'Fuel',100,'2021-01-13 17:03:40','2021-01-13 17:03:40'),(118,1,'2021-01-13','355120',21,'Fuel',100,'2021-01-13 17:03:57','2021-01-13 17:03:57'),(119,1,'2021-01-13','355141',20,'Fuel',150,'2021-01-13 17:04:46','2021-01-13 17:04:46'),(120,1,'2021-01-13','164437',22,'Fuel',150,'2021-01-13 17:05:14','2021-01-13 17:05:14'),(121,2,'2021-01-13','417759',6,'Office Supply',256,'2021-01-13 17:05:46','2021-01-13 17:05:46'),(122,2,'2021-01-13','315424',6,'Office Supply',58,'2021-01-13 17:06:00','2021-01-13 17:06:00'),(123,2,'2021-01-13','1227',6,'Office Supply',30,'2021-01-13 17:06:18','2021-01-13 17:06:18'),(124,1,'2021-01-13','355151',21,'Fuel',100,'2021-01-13 22:57:07','2021-01-13 22:57:07'),(125,1,'2021-01-15','99993',5,'Fuel',70,'2021-01-15 00:05:16','2021-01-15 00:05:16'),(126,1,'2021-01-15','973774',22,'Fuel',150,'2021-01-15 00:31:53','2021-01-15 00:31:53'),(127,1,'2021-01-15','478230',20,'Fuel',90,'2021-01-15 00:32:10','2021-01-15 00:32:10'),(128,1,'2021-01-15','355227',21,'Fuel',125,'2021-01-18 00:48:20','2021-01-18 00:48:20'),(129,2,'2021-01-18','320769085',24,'Others',2250,'2021-01-18 00:50:41','2021-01-18 00:50:41'),(130,1,'2021-01-19','355449',21,'Fuel',150,'2021-01-19 00:32:38','2021-01-19 00:32:38'),(131,1,'2021-01-19','207213',20,'Fuel',100,'2021-01-19 00:32:51','2021-01-19 00:32:51'),(132,1,'2021-01-19','129215',5,'Fuel',80,'2021-01-19 00:33:21','2021-01-19 00:33:21'),(133,1,'2021-01-18','91886',22,'Fuel',150,'2021-01-19 00:33:57','2021-01-19 00:33:57'),(134,1,'2021-01-18','355376',21,'Fuel',200,'2021-01-19 00:34:30','2021-01-19 00:34:30'),(135,1,'2021-01-18','91886',22,'Fuel',150,'2021-01-19 00:35:01','2021-01-19 00:35:01'),(136,1,'2021-01-20','139351',5,'Fuel',100,'2021-01-19 23:03:15','2021-01-19 23:03:15'),(137,1,'2021-01-20','92257',22,'Fuel',150,'2021-01-19 23:37:21','2021-01-19 23:37:21'),(138,2,'2021-01-20','1228',6,'Office Supply',30,'2021-01-19 23:37:37','2021-01-19 23:37:37'),(139,1,'2021-01-21','355568',21,'Fuel',100,'2021-01-21 15:59:37','2021-01-21 15:59:37'),(140,1,'2021-01-21','164750',22,'Fuel',100,'2021-01-21 15:59:50','2021-01-21 15:59:50'),(141,1,'2021-01-21','207296',20,'Fuel',150,'2021-01-21 16:00:05','2021-01-21 16:00:05'),(142,1,'2021-01-22','8996',5,'Fuel',100,'2021-01-21 18:13:41','2021-01-21 18:13:41'),(143,1,'2021-01-22','207392',20,'Fuel',100,'2021-01-24 21:42:14','2021-01-24 21:42:14'),(144,1,'2021-01-22','6012',21,'Fuel',100,'2021-01-24 21:42:41','2021-01-24 21:42:41');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_area_id_unique` (`name`,`area_id`),
  KEY `groups_area_id_foreign` (`area_id`),
  CONSTRAINT `groups_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_charges`
--

DROP TABLE IF EXISTS `loan_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `charge_id` bigint(20) unsigned NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loan_charges_loan_id_foreign` (`loan_id`),
  KEY `loan_charges_charge_id_foreign` (`charge_id`),
  CONSTRAINT `loan_charges_charge_id_foreign` FOREIGN KEY (`charge_id`) REFERENCES `charges` (`id`),
  CONSTRAINT `loan_charges_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_charges`
--

LOCK TABLES `loan_charges` WRITE;
/*!40000 ALTER TABLE `loan_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL,
  `status_id` bigint(20) unsigned NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_loan` date NOT NULL,
  `date_release` date DEFAULT NULL,
  `first_payment` date DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `loan_amount` double NOT NULL,
  `interest` double NOT NULL,
  `settled` double NOT NULL,
  `balance` double NOT NULL,
  `over` double NOT NULL,
  `payment_per_sched` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loans_transaction_code_unique` (`transaction_code`),
  KEY `loans_client_id_foreign` (`client_id`),
  KEY `loans_category_id_foreign` (`category_id`),
  KEY `loans_term_id_foreign` (`term_id`),
  KEY `loans_status_id_foreign` (`status_id`),
  CONSTRAINT `loans_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `loans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `loans_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `loans_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_11_06_222923_create_transactions_table',1),(4,'2018_11_07_192923_create_transfers_table',1),(5,'2018_11_07_202152_update_transfers_table',1),(6,'2018_11_15_124230_create_wallets_table',1),(7,'2018_11_19_164609_update_transactions_table',1),(8,'2018_11_20_133759_add_fee_transfers_table',1),(9,'2018_11_22_131953_add_status_transfers_table',1),(10,'2018_11_22_133438_drop_refund_transfers_table',1),(11,'2019_05_13_111553_update_status_transfers_table',1),(12,'2019_06_25_103755_add_exchange_status_transfers_table',1),(13,'2019_07_29_184926_decimal_places_wallets_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_10_02_193759_add_discount_transfers_table',1),(16,'2020_10_30_193412_add_meta_wallets_table',1),(17,'2021_03_12_105441_create_permission_tables',1),(18,'1995_10_23_100000_create_philippine_regions_table',2),(19,'1995_10_23_200000_create_philippine_provinces_table',2),(20,'1995_10_23_300000_create_philippine_cities_table',2),(21,'1995_10_23_400000_create_philippine_barangays_table',2),(22,'2021_03_12_105442_create_job_titles_table',3),(23,'2021_03_12_105443_create_employees_table',3),(24,'2021_03_12_115455_create_branches_table',3),(25,'2021_03_12_115456_create_areas_table',3),(26,'2021_03_12_115603_create_categories_table',3),(27,'2021_03_12_115604_create_terms_table',3),(28,'2021_03_12_115605_create_payment_modes_table',3),(29,'2021_03_12_115606_create_expense_types_table',3),(30,'2021_03_12_115607_create_groups_table',3),(31,'2021_03_12_115608_create_statuses_table',3),(32,'2021_03_12_115609_create_relationships_table',3),(33,'2021_03_12_115615_create_charges_table',3),(34,'2021_03_12_115630_create_clients_table',3),(35,'2021_03_12_115702_create_beneficiaries_table',4),(36,'2021_03_12_115746_create_expenses_table',4),(37,'2021_03_12_115820_create_loans_table',4),(38,'2021_03_12_115834_create_loan_charges_table',4),(39,'2021_03_12_115910_create_payments_table',4),(40,'2021_03_12_115922_create_schedules_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_modes`
--

DROP TABLE IF EXISTS `payment_modes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_modes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_modes`
--

LOCK TABLES `payment_modes` WRITE;
/*!40000 ALTER TABLE `payment_modes` DISABLE KEYS */;
INSERT INTO `payment_modes` VALUES (1,'Daily',1,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(2,'Weekly',7,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(3,'Semi-monthly',15,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(4,'Monthly',30,'2020-05-06 10:51:32','2020-05-06 10:51:32');
/*!40000 ALTER TABLE `payment_modes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `loan_id` bigint(20) unsigned DEFAULT NULL,
  `orno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` date NOT NULL,
  `amount` double NOT NULL,
  `ps_id` bigint(20) unsigned DEFAULT NULL,
  `cbu_id` bigint(20) unsigned DEFAULT NULL,
  `ins_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_orno_unique` (`orno`),
  KEY `payments_client_id_foreign` (`client_id`),
  KEY `payments_loan_id_foreign` (`loan_id`),
  KEY `payments_ps_id_foreign` (`ps_id`),
  KEY `payments_cbu_id_foreign` (`cbu_id`),
  KEY `payments_ins_id_foreign` (`ins_id`),
  CONSTRAINT `payments_cbu_id_foreign` FOREIGN KEY (`cbu_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `payments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `payments_ins_id_foreign` FOREIGN KEY (`ins_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `payments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  CONSTRAINT `payments_ps_id_foreign` FOREIGN KEY (`ps_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationships`
--

DROP TABLE IF EXISTS `relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `relationships_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationships`
--

LOCK TABLES `relationships` WRITE;
/*!40000 ALTER TABLE `relationships` DISABLE KEYS */;
INSERT INTO `relationships` VALUES (1,'FATHER','2020-05-07 09:30:08','2020-05-07 09:30:08'),(2,'MOTHER','2020-05-07 09:30:08','2020-05-07 09:30:08'),(3,'SON','2020-05-07 09:30:08','2020-05-07 09:30:08'),(4,'DAUGTHER','2020-05-07 09:30:08','2020-05-07 09:30:08'),(5,'SIBLINGS','2020-05-07 09:30:08','2020-05-07 09:30:08'),(6,'GRAND PARENTS','2020-05-07 09:30:08','2020-05-07 09:30:08'),(7,'RELATIVES','2020-05-07 09:30:08','2020-05-07 09:30:08');
/*!40000 ALTER TABLE `relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned DEFAULT NULL,
  `schedule_date` date NOT NULL,
  `progress` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_loan_id_foreign` (`loan_id`),
  CONSTRAINT `schedules_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statuses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'FOR REQUIREMENT','2020-05-06 10:51:30','2020-05-06 10:51:30'),(2,'FOR APPROVAL','2020-05-06 10:51:30','2020-05-06 10:51:30'),(3,'APPROVED','2020-05-06 10:51:30','2020-05-06 10:51:30'),(4,'DENIED','2020-05-06 10:51:30','2020-05-06 10:51:30'),(5,'FOR RELEASE','2020-05-06 10:51:30','2020-05-06 10:51:30'),(6,'RELEASED','2020-05-06 10:51:30','2020-05-06 10:51:30'),(7,'CLOSED','2020-05-06 10:51:30','2020-05-06 10:51:30');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_of_months` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `terms_no_of_months_unique` (`no_of_months`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,3,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(2,4,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(3,5,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(4,6,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(5,1,'2020-08-16 07:07:55','2020-08-16 07:07:55'),(6,2,'2020-08-16 07:08:19','2020-08-16 07:08:19');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payable_id` bigint(20) unsigned NOT NULL,
  `wallet_id` bigint(20) unsigned DEFAULT NULL,
  `type` enum('deposit','withdraw') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `meta` json DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  KEY `transactions_type_index` (`type`),
  KEY `transactions_wallet_id_foreign` (`wallet_id`),
  CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) unsigned NOT NULL,
  `to_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_id` bigint(20) unsigned NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_id` bigint(20) unsigned NOT NULL,
  `withdraw_id` bigint(20) unsigned NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT '0',
  `fee` decimal(64,0) NOT NULL DEFAULT '0',
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  KEY `transfers_deposit_id_foreign` (`deposit_id`),
  KEY `transfers_withdraw_id_foreign` (`withdraw_id`),
  CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `holder_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holder_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `balance` decimal(64,0) NOT NULL DEFAULT '0',
  `decimal_places` smallint(6) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  KEY `wallets_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-24  5:43:46
