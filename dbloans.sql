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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `philippine_barangay_id` int(10) unsigned NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_client_id_foreign` (`client_id`),
  KEY `addresses_philippine_barangay_id_foreign` (`philippine_barangay_id`),
  CONSTRAINT `addresses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `addresses_philippine_barangay_id_foreign` FOREIGN KEY (`philippine_barangay_id`) REFERENCES `dbsystem`.`philippine_barangays` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (18,26,14381,'F. CALDERON ST','2021-04-19 00:47:50','2021-04-19 00:47:50'),(19,27,14338,'PUROK 1','2021-04-19 00:51:52','2021-04-19 00:51:52');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned NOT NULL,
  `name` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `areas_name_unique` (`name`),
  KEY `areas_branch_id_foreign` (`branch_id`),
  CONSTRAINT `areas_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,1,'2020-09-21 13:08:55','2020-09-21 13:08:55'),(2,1,2,'2020-09-21 13:09:48','2020-09-21 13:09:48'),(3,1,3,'2020-09-21 13:11:01','2020-09-21 13:11:01'),(4,1,4,'2020-09-21 13:11:48','2020-09-21 13:11:48'),(5,1,5,'2021-04-02 13:25:31','2021-04-02 13:25:31');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
INSERT INTO `beneficiaries` VALUES (2,26,'DEXISNE','CARL NATHAN','NIDEA','Male',3,'2021-04-19 00:47:51','2021-04-19 00:47:51'),(3,27,'DEXISNE','CARL NATHAN','NIDEA','Male',3,'2021-04-19 00:51:52','2021-04-19 00:51:52');
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
INSERT INTO `branches` VALUES (1,'Main Branch','2020-05-06 10:51:30','2021-04-01 19:23:41');
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
INSERT INTO `categories` VALUES (1,'Business Loan','2020-05-06 10:51:31','2021-04-01 18:02:09'),(2,'Emergency Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(3,'Grocery Loan','2020-05-06 10:51:31','2021-04-01 14:12:13'),(4,'Salary Loan','2020-05-06 10:51:31','2020-05-06 10:51:31'),(5,'Group Loan','2020-05-06 10:51:31','2020-09-21 14:12:54'),(7,'Individual Loan','2020-10-18 22:53:00','2020-10-18 22:53:00');
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
  `daily_only` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `charges_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charges`
--

LOCK TABLES `charges` WRITE;
/*!40000 ALTER TABLE `charges` DISABLE KEYS */;
INSERT INTO `charges` VALUES (1,'Interest',0,0,0,0,'2020-05-06 11:07:54','2020-08-16 06:28:38'),(2,'Loan Processing',50,0,1,0,'2020-05-06 11:08:16','2020-05-06 11:08:16'),(3,'Attorneys Fee',100,0,1,0,'2020-05-06 11:08:31','2021-04-01 18:51:01'),(4,'Capital Build Up',30,0,0,0,'2020-05-06 11:08:45','2020-05-06 11:08:45'),(6,'Loan Security',50,0,1,0,NULL,NULL),(7,'Insurance',100,0,1,0,NULL,NULL),(9,'Prev Loan',0,0,1,0,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (26,'S-21AOzrs',NULL,'DEXISNE','FRANKLY JR','DASALLA','1992-10-16','Male','0912345789','DOFF','IT PROGRAMMER',15000,1,NULL,'2021-04-19 00:47:50','2021-04-19 00:47:50'),(27,'S-21aTvda',NULL,'DEXISNE','JESSILEN','NIDEA','1994-11-28','Female','0912345789','DA','RESEARCH ASST',1200,1,NULL,'2021-04-19 00:51:52','2021-04-19 00:51:52');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_maker_addresses`
--

DROP TABLE IF EXISTS `co_maker_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_maker_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `co_maker_id` bigint(20) unsigned NOT NULL,
  `philippine_barangay_id` int(10) unsigned NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_maker_addresses_co_maker_id_foreign` (`co_maker_id`),
  KEY `co_maker_addresses_philippine_barangay_id_foreign` (`philippine_barangay_id`),
  CONSTRAINT `co_maker_addresses_co_maker_id_foreign` FOREIGN KEY (`co_maker_id`) REFERENCES `co_makers` (`id`),
  CONSTRAINT `co_maker_addresses_philippine_barangay_id_foreign` FOREIGN KEY (`philippine_barangay_id`) REFERENCES `dbsystem`.`philippine_barangays` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_maker_addresses`
--

LOCK TABLES `co_maker_addresses` WRITE;
/*!40000 ALTER TABLE `co_maker_addresses` DISABLE KEYS */;
INSERT INTO `co_maker_addresses` VALUES (11,14,14338,'P1','2021-04-19 00:47:51','2021-04-19 00:47:51'),(12,15,14381,'P1','2021-04-19 00:51:52','2021-04-19 00:51:52');
/*!40000 ALTER TABLE `co_maker_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_makers`
--

DROP TABLE IF EXISTS `co_makers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `co_makers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `co_makers_lname_fname_mname_unique` (`lname`,`fname`,`mname`),
  KEY `co_makers_client_id_foreign` (`client_id`),
  CONSTRAINT `co_makers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_makers`
--

LOCK TABLES `co_makers` WRITE;
/*!40000 ALTER TABLE `co_makers` DISABLE KEYS */;
INSERT INTO `co_makers` VALUES (14,26,NULL,'DEXISNE','JESSILEN','NIDEA','1992-10-16','Female','0912345698','DA','RESEARCH ASST',12000,'2021-04-19 00:47:51','2021-04-19 00:47:51'),(15,27,NULL,'DEXISNE','FRANKLY JR','DASALLA','1992-10-16','Male','0912345698','DOFF','IT PROGRAMMER',15000,'2021-04-19 00:51:52','2021-04-19 00:51:52');
/*!40000 ALTER TABLE `co_makers` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_charges`
--

LOCK TABLES `loan_charges` WRITE;
/*!40000 ALTER TABLE `loan_charges` DISABLE KEYS */;
INSERT INTO `loan_charges` VALUES (37,4,9,4000,'2021-04-22 12:43:42','2021-04-22 12:43:42'),(38,4,1,900,'2021-04-22 12:43:42','2021-04-22 12:43:42'),(39,7,1,900,'2021-04-23 13:38:18','2021-04-23 13:38:18'),(40,7,2,50,'2021-04-23 13:38:19','2021-04-23 13:38:19'),(41,7,3,100,'2021-04-23 13:38:19','2021-04-23 13:38:19'),(42,7,6,50,'2021-04-23 13:38:19','2021-04-23 13:38:19');
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
  `payment_mode_id` bigint(20) unsigned DEFAULT NULL,
  `status_id` bigint(20) unsigned NOT NULL,
  `ps_id` bigint(20) unsigned DEFAULT NULL,
  `cbu_id` bigint(20) unsigned DEFAULT NULL,
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
  `byout_of` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loans_transaction_code_unique` (`transaction_code`),
  KEY `loans_client_id_foreign` (`client_id`),
  KEY `loans_category_id_foreign` (`category_id`),
  KEY `loans_term_id_foreign` (`term_id`),
  KEY `loans_status_id_foreign` (`status_id`),
  KEY `loans_byout_of_foreign` (`byout_of`),
  KEY `loans_payment_mode_id_foreign` (`payment_mode_id`),
  KEY `loans_ps_id_foreign` (`ps_id`),
  KEY `loans_cbu_id_foreign` (`cbu_id`),
  CONSTRAINT `loans_byout_of_foreign` FOREIGN KEY (`byout_of`) REFERENCES `loans` (`id`),
  CONSTRAINT `loans_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `loans_cbu_id_foreign` FOREIGN KEY (`cbu_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `loans_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `loans_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_modes` (`id`),
  CONSTRAINT `loans_ps_id_foreign` FOREIGN KEY (`ps_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `loans_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `loans_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (4,27,1,1,2,7,NULL,NULL,'S-21aTvda-202119','2021-04-19','2021-04-23','2021-04-24','2021-07-10',5000,18,5900,0,0,491.66666666667,NULL,'2021-04-19 00:51:52','2021-05-01 06:29:13'),(5,27,1,1,2,7,NULL,NULL,'S-21aTvda-202120','2021-04-19','2021-04-20','2021-04-21','2021-06-21',5000,18,3000,4000,0,0,4,'2021-04-19 00:51:52','2021-04-22 13:05:01'),(7,26,1,7,1,6,NULL,NULL,'S-21AOzrs-20210423','2021-04-23','2021-04-25','2021-04-26','2021-08-04',5000,18,500,5900,0,59,NULL,'2021-04-23 13:28:18','2021-05-01 14:23:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_11_06_222923_create_transactions_table',1),(4,'2018_11_07_192923_create_transfers_table',1),(5,'2018_11_07_202152_update_transfers_table',1),(6,'2018_11_15_124230_create_wallets_table',1),(7,'2018_11_19_164609_update_transactions_table',1),(8,'2018_11_20_133759_add_fee_transfers_table',1),(9,'2018_11_22_131953_add_status_transfers_table',1),(10,'2018_11_22_133438_drop_refund_transfers_table',1),(11,'2019_05_13_111553_update_status_transfers_table',1),(12,'2019_06_25_103755_add_exchange_status_transfers_table',1),(13,'2019_07_29_184926_decimal_places_wallets_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_10_02_193759_add_discount_transfers_table',1),(16,'2020_10_30_193412_add_meta_wallets_table',1),(17,'2021_03_12_105441_create_permission_tables',1),(18,'1995_10_23_100000_create_philippine_regions_table',2),(19,'1995_10_23_200000_create_philippine_provinces_table',2),(20,'1995_10_23_300000_create_philippine_cities_table',2),(21,'1995_10_23_400000_create_philippine_barangays_table',2),(22,'2021_03_12_105442_create_job_titles_table',3),(23,'2021_03_12_105443_create_employees_table',3),(24,'2021_03_12_115455_create_branches_table',3),(25,'2021_03_12_115456_create_areas_table',3),(26,'2021_03_12_115603_create_categories_table',3),(27,'2021_03_12_115604_create_terms_table',3),(28,'2021_03_12_115605_create_payment_modes_table',3),(29,'2021_03_12_115606_create_expense_types_table',3),(30,'2021_03_12_115607_create_groups_table',3),(31,'2021_03_12_115608_create_statuses_table',3),(32,'2021_03_12_115609_create_relationships_table',3),(33,'2021_03_12_115615_create_charges_table',3),(34,'2021_03_12_115630_create_clients_table',3),(35,'2021_03_12_115702_create_beneficiaries_table',4),(36,'2021_03_12_115746_create_expenses_table',4),(37,'2021_03_12_115820_create_loans_table',4),(38,'2021_03_12_115834_create_loan_charges_table',4),(39,'2021_03_12_115910_create_payments_table',4),(40,'2021_03_12_115922_create_schedules_table',4),(41,'2021_03_31_222342_create_modules_table',5),(42,'2021_03_31_222743_alter_table_permissions',6),(43,'2021_04_02_033509_alter_table_employees_add_branch_id',7),(44,'2021_04_02_100057_alter_table_employees_add_user_id',8),(45,'2021_04_02_102354_alter_table_employees_add_area_id',9),(46,'2021_04_03_021141_create_co_makers_table',10),(47,'2021_04_03_021241_create_addresses_table',11),(48,'2021_04_03_021955_create_co_maker_addresses_table',11),(49,'2021_04_03_102148_create_withdraws_table',12),(50,'2021_04_04_071900_alter_table_loans_add_byout_of',13),(51,'2021_04_08_215048_alter_table_loans_add_column_payment_mode',14),(52,'2021_04_19_005727_alter_tabe_terms_add_column_daily_only',15),(53,'2021_04_20_203819_alter_table_charges_add_column_daily_only',16),(54,'2021_05_03_193411_create_workstations_table',17),(55,'2021_05_05_194659_alter_table_payment_add_penalty',18),(56,'2021_05_06_201736_alter_table_loans_add_ps_and_cbu_id',19);
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
  `penalty` double NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (2,NULL,4,'1001','2021-04-30',500,87,88,NULL,0,NULL,'2021-05-01 05:12:29'),(3,26,NULL,'1002','2021-05-01',0,75,76,NULL,0,'2021-04-30 16:03:53','2021-04-30 16:03:53'),(4,26,NULL,'1003','2021-05-01',0,77,78,NULL,0,'2021-04-30 16:06:12','2021-04-30 16:06:12'),(5,26,NULL,'1004','2021-05-01',0,79,80,NULL,0,'2021-04-30 16:07:00','2021-04-30 16:07:00'),(6,26,NULL,'1005','2021-05-02',0,81,82,NULL,0,'2021-04-30 16:07:31','2021-04-30 16:07:31'),(7,26,NULL,'1006','2021-05-02',0,83,84,NULL,0,'2021-04-30 16:08:03','2021-04-30 16:08:03'),(8,26,NULL,'1007','2021-05-02',0,85,86,NULL,0,'2021-05-01 05:07:47','2021-05-01 05:07:47'),(10,NULL,4,'1012','2021-05-01',500,91,92,NULL,0,'2021-05-01 05:42:10','2021-05-01 05:42:10'),(11,NULL,4,'1013','2021-05-01',500,93,94,NULL,0,'2021-05-01 05:53:13','2021-05-01 05:53:13'),(12,NULL,4,'1014','2021-05-01',500,95,96,NULL,0,'2021-05-01 05:57:37','2021-05-01 05:57:37'),(19,NULL,4,'1015','2021-05-01',3900,109,110,NULL,0,'2021-05-01 06:29:13','2021-05-01 06:29:13'),(20,NULL,NULL,'1016','2021-05-01',500,NULL,NULL,NULL,0,'2021-05-01 14:23:38','2021-05-01 14:23:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (17,4,'2021-04-23',0,NULL,NULL),(18,4,'2021-04-30',0,NULL,NULL),(19,4,'2021-05-07',0,NULL,NULL),(20,4,'2021-05-14',0,NULL,NULL),(21,4,'2021-05-21',0,NULL,NULL),(22,4,'2021-05-28',0,NULL,NULL),(23,4,'2021-06-04',0,NULL,NULL),(24,4,'2021-06-11',0,NULL,NULL),(25,4,'2021-06-18',0,NULL,NULL),(26,4,'2021-06-25',0,NULL,NULL),(27,4,'2021-07-02',0,NULL,NULL),(28,4,'2021-07-09',0,NULL,NULL),(29,4,'2021-04-24',0,NULL,NULL),(30,4,'2021-05-01',0,NULL,NULL),(31,4,'2021-05-08',0,NULL,NULL),(32,4,'2021-05-15',0,NULL,NULL),(33,4,'2021-05-22',0,NULL,NULL),(34,4,'2021-05-29',0,NULL,NULL),(35,4,'2021-06-05',0,NULL,NULL),(36,4,'2021-06-12',0,NULL,NULL),(37,4,'2021-06-19',0,NULL,NULL),(38,4,'2021-06-26',0,NULL,NULL),(39,4,'2021-07-03',0,NULL,NULL),(40,4,'2021-07-10',0,NULL,NULL);
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
  `daily_only` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `terms_no_of_months_unique` (`no_of_months`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,3,0,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(2,4,0,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(3,5,0,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(4,6,0,'2020-05-06 10:51:31','2020-05-06 10:51:31'),(5,1,0,'2020-08-16 07:07:55','2021-04-01 15:11:12'),(6,2,0,'2020-08-16 07:08:19','2020-08-16 07:08:19'),(7,100,1,'2020-08-16 07:08:19','2021-04-18 17:17:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,0,NULL,'588be8ba-6073-4c76-a520-9035d093aa6c','2021-04-04 00:59:40','2021-04-05 04:05:31'),(2,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,0,NULL,'2eca72b8-ee73-49b3-95b9-71aa669c16ec','2021-04-04 00:59:40','2021-04-05 04:05:31'),(3,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,1,NULL,'dd643623-96dd-4b10-8b4d-3af99b7b9cf9','2021-04-04 01:05:01','2021-04-04 01:05:01'),(4,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,1,NULL,'181e0470-0ac2-407b-8cdf-5cd43e96e005','2021-04-04 01:05:01','2021-04-04 01:05:01'),(5,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,1,NULL,'e38a793f-8eea-43f9-9642-622ad98bdba6','2021-04-04 01:06:28','2021-04-04 01:06:28'),(6,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,1,NULL,'9ba6b4f0-97e0-4ee5-9647-fb4c2e7e1106','2021-04-04 01:06:28','2021-04-04 01:06:28'),(7,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,1,NULL,'f3b717a9-5554-4e47-90c1-df3bfd4890e5','2021-04-04 01:10:21','2021-04-04 01:10:21'),(8,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,1,NULL,'9b8adb95-ba96-4b3f-88e1-936acb3234c5','2021-04-04 01:10:22','2021-04-04 01:10:22'),(9,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,1,NULL,'42c0bcd3-8b19-4a5a-a5f7-5d7e0e77bfb3','2021-04-04 01:11:23','2021-04-04 01:11:23'),(10,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,1,NULL,'dc41f7e7-0e65-44d0-b531-f059d3c411e8','2021-04-04 01:11:23','2021-04-04 01:11:23'),(11,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,0,NULL,'fc535cf2-e79c-4b09-9ca9-3abfb10ae0e1','2021-04-04 02:04:00','2021-04-07 13:27:29'),(12,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,0,NULL,'dd3b4a93-fcf1-4a91-bb3c-6db797bf0777','2021-04-04 02:04:00','2021-04-07 13:27:29'),(13,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,0,NULL,'8d351221-9031-4e02-ba42-a0a5c943d32d','2021-04-04 02:06:05','2021-04-05 04:20:35'),(14,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,0,NULL,'b79ceda5-151b-4bcd-aa0b-7841dfba0298','2021-04-04 02:06:05','2021-04-05 04:20:35'),(15,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,0,NULL,'81ab762d-89c7-44ee-81a4-64f0acf2bc0c','2021-04-04 02:06:18','2021-04-05 04:19:34'),(16,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,0,NULL,'76153134-9155-4646-9a6b-077e41900e72','2021-04-04 02:06:18','2021-04-05 04:19:34'),(17,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,0,NULL,'76153134-9155-4646-9a6b-077e41900e73','2021-04-04 02:06:18','2021-04-07 14:04:33'),(18,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,1,NULL,'f8b92439-3df8-426e-9dd4-5cab6f5a6851','2021-04-07 12:14:24','2021-04-07 12:14:24'),(19,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,1,NULL,'848e1a31-4ba7-4c5a-9edf-0ed4ae00506e','2021-04-07 12:14:42','2021-04-07 12:14:42'),(20,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,1,NULL,'f88e3581-16af-4b26-afdd-db491c8508e5','2021-04-07 12:15:29','2021-04-07 12:15:29'),(21,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,1,NULL,'0f63b17d-3f8d-45bd-be69-e4184e4b7041','2021-04-07 12:15:59','2021-04-07 12:15:59'),(22,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-50,1,NULL,'511f5633-d63c-4f83-9bf2-07d40f113c5f','2021-04-07 12:17:37','2021-04-07 12:17:37'),(23,'App\\Models\\DBLoans\\Client',1,1,'deposit',50,1,NULL,'65022846-36a0-4892-870f-edbe9383cea8','2021-04-07 12:18:09','2021-04-07 12:18:09'),(24,'App\\Models\\DBLoans\\Client',1,2,'deposit',50,1,NULL,'b9a19043-c3d9-4a83-ab5d-43ec526be5ea','2021-04-07 12:18:09','2021-04-07 12:18:09'),(25,'App\\Models\\DBLoans\\Client',1,1,'deposit',100,1,NULL,'78a8d163-6931-4af1-a44f-142e7333da0c','2021-04-07 12:19:40','2021-04-07 12:19:40'),(26,'App\\Models\\DBLoans\\Client',1,2,'deposit',100,1,NULL,'2f31150e-c822-4626-9a3b-9a376b950a5d','2021-04-07 12:19:40','2021-04-07 12:19:40'),(27,'App\\Models\\DBLoans\\Client',1,1,'withdraw',-30,0,NULL,'8737bd0d-ec61-4661-a7d9-ed4eaa97e1f5','2021-04-07 12:25:50','2021-04-07 14:05:15'),(28,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,0,NULL,'588be8ba-6073-4c76-a520-9035d093aa6d','2021-04-04 00:59:40','2021-04-05 04:05:31'),(29,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,1,NULL,'dd643623-96dd-4b10-8b4d-3af99b7b9cf0','2021-04-04 01:05:01','2021-04-04 01:05:01'),(30,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,1,NULL,'e38a793f-8eea-43f9-9642-622ad98bdba7','2021-04-04 01:06:28','2021-04-04 01:06:28'),(31,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,1,NULL,'f3b717a9-5554-4e47-90c1-df3bfd4890e6','2021-04-04 01:10:21','2021-04-04 01:10:21'),(32,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,1,NULL,'42c0bcd3-8b19-4a5a-a5f7-5d7e0e77bfb4','2021-04-04 01:11:23','2021-04-04 01:11:23'),(33,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,0,NULL,'fc535cf2-e79c-4b09-9ca9-3abfb10ae0e2','2021-04-04 02:04:00','2021-04-07 13:27:29'),(34,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,0,NULL,'8d351221-9031-4e02-ba42-a0a5c943d32e','2021-04-04 02:06:05','2021-04-05 04:20:35'),(35,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,0,NULL,'81ab762d-89c7-44ee-81a4-64f0acf2bc0d','2021-04-04 02:06:18','2021-04-05 04:19:34'),(36,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,0,NULL,'76153134-9155-4646-9a6b-077e41900e74','2021-04-04 02:06:18','2021-04-07 14:04:33'),(37,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,1,NULL,'f8b92439-3df8-426e-9dd4-5cab6f5a6852','2021-04-07 12:14:24','2021-04-07 12:14:24'),(38,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,1,NULL,'848e1a31-4ba7-4c5a-9edf-0ed4ae00506d','2021-04-07 12:14:42','2021-04-07 12:14:42'),(39,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,1,NULL,'f88e3581-16af-4b26-afdd-db491c8508e6','2021-04-07 12:15:29','2021-04-07 12:15:29'),(40,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,1,NULL,'0f63b17d-3f8d-45bd-be69-e4184e4b7042','2021-04-07 12:15:59','2021-04-07 12:15:59'),(41,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-50,1,NULL,'511f5633-d63c-4f83-9bf2-07d40f113c5e','2021-04-07 12:17:37','2021-04-07 12:17:37'),(42,'App\\Models\\DBLoans\\Client',1,3,'deposit',50,1,NULL,'65022846-36a0-4892-870f-edbe9383cea9','2021-04-07 12:18:09','2021-04-07 12:18:09'),(43,'App\\Models\\DBLoans\\Client',1,3,'deposit',100,0,NULL,'78a8d163-6931-4af1-a44f-142e7333da0d','2021-04-07 12:19:40','2021-05-01 05:12:29'),(44,'App\\Models\\DBLoans\\Client',1,3,'withdraw',-30,0,NULL,'8737bd0d-ec61-4661-a7d9-ed4eaa97e1f6','2021-04-07 12:25:50','2021-04-07 14:05:15'),(65,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,0,NULL,'2eca72b8-ee73-49b3-95b9-71aa669c16ed','2021-04-04 00:59:40','2021-04-05 04:05:31'),(66,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,1,NULL,'181e0470-0ac2-407b-8cdf-5cd43e96e006','2021-04-04 01:05:01','2021-04-04 01:05:01'),(67,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,1,NULL,'9ba6b4f0-97e0-4ee5-9647-fb4c2e7e1107','2021-04-04 01:06:28','2021-04-04 01:06:28'),(68,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,1,NULL,'9b8adb95-ba96-4b3f-88e1-936acb3234c6','2021-04-04 01:10:22','2021-04-04 01:10:22'),(69,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,1,NULL,'dc41f7e7-0e65-44d0-b531-f059d3c411e9','2021-04-04 01:11:23','2021-04-04 01:11:23'),(70,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,0,NULL,'dd3b4a93-fcf1-4a91-bb3c-6db797bf0778','2021-04-04 02:04:00','2021-04-07 13:27:29'),(71,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,0,NULL,'b79ceda5-151b-4bcd-aa0b-7841dfba0299','2021-04-04 02:06:05','2021-04-05 04:20:35'),(72,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,0,NULL,'76153134-9155-4646-9a6b-077e41900e75','2021-04-04 02:06:18','2021-04-05 04:19:34'),(73,'App\\Models\\DBLoans\\Client',1,4,'deposit',50,1,NULL,'b9a19043-c3d9-4a83-ab5d-43ec526be5eb','2021-04-07 12:18:09','2021-04-07 12:18:09'),(74,'App\\Models\\DBLoans\\Client',1,4,'deposit',100,0,NULL,'2f31150e-c822-4626-9a3b-9a376b950a5e','2021-04-07 12:19:40','2021-05-01 05:12:29'),(75,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'55a013b0-b8ce-42a6-a97b-e26d429bce57','2021-04-30 16:03:53','2021-04-30 16:03:53'),(76,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'98973c2a-c325-4786-959d-841630f95ce0','2021-04-30 16:03:53','2021-04-30 16:03:53'),(77,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'d13ffeb8-e8a7-48e1-9dae-9b2889cdea16','2021-04-30 16:06:12','2021-04-30 16:06:12'),(78,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'7094e477-1409-41db-9e29-0985aa46a325','2021-04-30 16:06:12','2021-04-30 16:06:12'),(79,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'eb5ed5b7-21e6-4ebd-b6bc-93acda3f024e','2021-04-30 16:07:00','2021-04-30 16:07:00'),(80,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'f5b6423f-3cdb-4183-a32d-524d799997c7','2021-04-30 16:07:00','2021-04-30 16:07:00'),(81,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'9b79cc5f-7480-4abc-b46b-07e31e84d864','2021-04-30 16:07:31','2021-04-30 16:07:31'),(82,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'843a5792-8ceb-446a-a783-1d178bf6aaa9','2021-04-30 16:07:31','2021-04-30 16:07:31'),(83,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'e3b1d702-88e2-4aff-ac13-84b9a3fc71c1','2021-04-30 16:08:03','2021-04-30 16:08:03'),(84,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'cd65d18f-f850-4764-ba04-d3a19f96308c','2021-04-30 16:08:03','2021-04-30 16:08:03'),(85,'App\\Models\\DBLoans\\Client',26,5,'deposit',50,1,NULL,'37e3c502-a1e9-448f-b59a-eadaf75c558c','2021-05-01 05:07:47','2021-05-01 05:07:47'),(86,'App\\Models\\DBLoans\\Client',26,6,'deposit',50,1,NULL,'0d45b95a-3e1d-4ef6-a0ea-21f9e3d8222e','2021-05-01 05:07:47','2021-05-01 05:07:47'),(87,'App\\Models\\DBLoans\\Client',27,7,'deposit',100,1,NULL,'72c0b06a-b210-4e42-97c4-9dcd5c388ab9','2021-05-01 05:12:29','2021-05-01 05:12:29'),(88,'App\\Models\\DBLoans\\Client',27,8,'deposit',100,1,NULL,'466d7166-1247-4c84-8e5e-dd2bf54790a1','2021-05-01 05:12:29','2021-05-01 05:12:29'),(89,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'da4960b6-ca9c-4cb4-b269-3eaf064de8bb','2021-05-01 05:39:04','2021-05-01 05:39:04'),(90,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'a2dccc59-1123-463a-bb58-38f2c3fcc57d','2021-05-01 05:39:04','2021-05-01 05:39:04'),(91,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'aa297ace-df66-47b9-89f1-2441cbf0ae82','2021-05-01 05:42:10','2021-05-01 05:42:10'),(92,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'836d9a06-992a-4572-acf3-b296f4965b2a','2021-05-01 05:42:10','2021-05-01 05:42:10'),(93,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'b3bd230e-5f6a-4b9e-8ff4-312df4232584','2021-05-01 05:53:13','2021-05-01 05:53:13'),(94,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'e423b848-6177-41cf-9e62-3817b4ead4a4','2021-05-01 05:53:13','2021-05-01 05:53:13'),(95,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'2bf61700-6391-471b-a361-7921fbe26d1e','2021-05-01 05:57:37','2021-05-01 05:57:37'),(96,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'90dc8da9-d9ec-46f7-ad62-ac6bcb43c41e','2021-05-01 05:57:37','2021-05-01 05:57:37'),(97,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'63d69f39-9a9c-499f-980e-34d1fc89a9c5','2021-05-01 06:02:57','2021-05-01 06:02:57'),(98,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'0d98f0a2-1827-4e68-a2a7-92e55fa3f39b','2021-05-01 06:02:57','2021-05-01 06:02:57'),(99,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'ef95a9d2-5af5-404d-ac39-65700ad8c484','2021-05-01 06:06:52','2021-05-01 06:06:52'),(100,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'250a3ffc-ea39-4a9d-a928-22c015544694','2021-05-01 06:06:52','2021-05-01 06:06:52'),(101,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'0a03974f-0a14-46f9-b0f5-4bcc92f9a56f','2021-05-01 06:09:16','2021-05-01 06:09:16'),(102,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'5a893a6a-690a-4ef1-803d-e155a0ba5540','2021-05-01 06:09:16','2021-05-01 06:09:16'),(103,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'4b1524ac-02a2-4b0c-8914-89fb301323fb','2021-05-01 06:10:07','2021-05-01 06:10:07'),(104,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'de7a7388-d302-417c-a057-b271b80f56f9','2021-05-01 06:10:07','2021-05-01 06:10:07'),(105,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'8c76dbc0-b462-4dc7-b096-99aa58219007','2021-05-01 06:11:57','2021-05-01 06:11:57'),(106,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'82c8eef1-d960-4b5d-9cf8-d2974a04902a','2021-05-01 06:11:57','2021-05-01 06:11:57'),(107,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'265f1695-26e3-4070-b242-f70639cbf8fe','2021-05-01 06:13:51','2021-05-01 06:13:51'),(108,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'ad7869d9-ab20-40e1-ba06-0d24e131b58a','2021-05-01 06:13:51','2021-05-01 06:13:51'),(109,'App\\Models\\DBLoans\\Client',27,7,'deposit',50,1,NULL,'00cef4ec-ef59-434a-8130-d0a12403aace','2021-05-01 06:29:13','2021-05-01 06:29:13'),(110,'App\\Models\\DBLoans\\Client',27,8,'deposit',25,1,NULL,'52d08ef7-fc88-4463-876d-b9deedb049f1','2021-05-01 06:29:13','2021-05-01 06:29:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'App\\Models\\DBLoans\\Client',1,'PERSONAL SAVINGS','ps',NULL,NULL,100,2,'2021-04-04 00:59:39','2021-04-07 14:05:15'),(2,'App\\Models\\DBLoans\\Client',1,'CAPITAL BUILD UP','cbu',NULL,NULL,350,2,'2021-04-04 00:59:39','2021-04-07 13:27:29'),(3,'App\\Models\\DBLoans\\Client',2,'PERSONAL SAVINGS','ps',NULL,NULL,100,2,'2021-04-04 00:59:39','2021-04-07 14:05:15'),(4,'App\\Models\\DBLoans\\Client',2,'CAPITAL BUILD UP','cbu',NULL,NULL,350,2,'2021-04-04 00:59:39','2021-04-07 13:27:29'),(5,'App\\Models\\DBLoans\\Client',26,'PERSONAL SAVINGS','ps',NULL,NULL,300,2,'2021-04-30 16:03:52','2021-05-01 05:07:47'),(6,'App\\Models\\DBLoans\\Client',26,'CAPITAL BUILD UP','cbu',NULL,NULL,300,2,'2021-04-30 16:03:52','2021-05-01 05:07:47'),(7,'App\\Models\\DBLoans\\Client',27,'PERSONAL SAVINGS','ps',NULL,NULL,650,2,'2021-04-30 18:18:12','2021-05-01 06:29:13'),(8,'App\\Models\\DBLoans\\Client',27,'CAPITAL BUILD UP','cbu',NULL,NULL,375,2,'2021-04-30 18:18:12','2021-05-01 06:29:13');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraws`
--

DROP TABLE IF EXISTS `withdraws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdraws` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `transaction_id` bigint(20) unsigned DEFAULT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw_date` date NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `withdraws_reference_no_unique` (`reference_no`),
  KEY `withdraws_client_id_foreign` (`client_id`),
  KEY `withdraws_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `withdraws_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `withdraws_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraws`
--

LOCK TABLES `withdraws` WRITE;
/*!40000 ALTER TABLE `withdraws` DISABLE KEYS */;
INSERT INTO `withdraws` VALUES (1,27,37,'1001','2021-05-07',50,NULL,NULL);
/*!40000 ALTER TABLE `withdraws` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-07  7:49:45
