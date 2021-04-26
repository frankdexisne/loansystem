-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: dbpayroll
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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_lname_fname_mname_unique` (`lname`,`fname`,`mname`),
  UNIQUE KEY `employees_employee_no_unique` (`employee_no`),
  KEY `employees_job_title_id` (`job_title_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'EMP-2005OVF','avatar_2x.png','DEXISNE','FRANKLY JR','DASALLA','Male',7,'2020-05-06 10:51:26','2020-05-06 10:51:26'),(5,'EMP-2007jww','avatar_2x.png','LUSTADO','DONDIE','ZAMUDIO','Male',6,'2020-07-16 11:26:46','2020-07-16 11:26:46'),(6,'EMP-2009PAP','avatar_2x.png','Buen','Gillian','Merculesio','Female',4,'2020-09-19 08:07:36','2020-09-19 08:07:36'),(19,'EMP-20096A0','avatar_2x.png','Lustado','Dhonz','Zamudio','Male',1,'2020-09-21 13:08:54','2020-09-21 13:08:54'),(20,'EMP-2009wWl','avatar_2x.png','Bellen','Kenneth','Belda','Male',1,'2020-09-21 13:09:48','2020-09-21 13:09:48'),(21,'EMP-2009FMK','avatar_2x.png','Miñas','Kyle Krisoffer','N/A','Male',1,'2020-09-21 13:11:01','2020-09-21 13:11:01'),(22,'EMP-20092Uy','avatar_2x.png','Palenzuela','Lyndon','Oira','Male',1,'2020-09-21 13:11:48','2020-09-21 13:11:48'),(23,'EMP-2010NZV','avatar_2x.png','Opiano','Maria Cecilia','Maravella','Female',2,'2020-10-06 07:37:58','2020-10-06 07:37:58'),(24,'EMP-2010q7G','avatar_2x.png','CONSULTA','RACQUEL','C','Female',3,'2020-10-11 08:32:26','2020-10-11 08:32:26');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_titles`
--

DROP TABLE IF EXISTS `job_titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_titles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_titles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_titles`
--

LOCK TABLES `job_titles` WRITE;
/*!40000 ALTER TABLE `job_titles` DISABLE KEYS */;
INSERT INTO `job_titles` VALUES (1,'CREDIT OFFICER','2020-05-06 10:51:26','2020-05-06 10:51:26'),(2,'CASHIER','2020-05-06 10:51:26','2020-05-06 10:51:26'),(3,'ACCOUNTING STAFF','2020-05-06 10:51:26','2020-05-06 10:51:26'),(4,'SECRETARY','2020-05-06 10:51:26','2020-05-06 10:51:26'),(5,'CORPORATE SECRETARY','2020-05-06 10:51:26','2020-05-06 10:51:26'),(6,'PRESIDENT','2020-05-06 10:51:26','2020-05-06 10:51:26'),(7,'SYSTEM ADMINISTRATOR','2020-05-06 10:51:26','2020-05-06 10:51:26');
/*!40000 ALTER TABLE `job_titles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-24  5:44:09
