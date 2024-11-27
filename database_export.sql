-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mariadb
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `allclients`
--

DROP TABLE IF EXISTS `allclients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allclients` (
  `ClientNumber` bigint(20) unsigned NOT NULL,
  `givenName` varchar(100) DEFAULT NULL,
  `ClientAddress` varchar(255) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ClientNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allclients`
--

LOCK TABLES `allclients` WRITE;
/*!40000 ALTER TABLE `allclients` DISABLE KEYS */;
/*!40000 ALTER TABLE `allclients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_num` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `asking_price` bigint(20) DEFAULT NULL,
  `critiqued_comments` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `condition` text DEFAULT NULL,
  `item_type` text DEFAULT NULL,
  `is_sold` tinyint(1) DEFAULT 0,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`item_num`),
  KEY `allclients_items` (`ClientNumber`),
  CONSTRAINT `allclients_items` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `purchase_id` bigint(20) unsigned NOT NULL,
  `condition_at_purchase` text DEFAULT NULL,
  `p_date` datetime DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchases_ibfk_10` (`ClientNumber`),
  KEY `items_purchases` (`item_num`),
  CONSTRAINT `items_purchases` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`),
  CONSTRAINT `purchases_ibfk_10` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `saleID` bigint(20) unsigned NOT NULL,
  `commissionPaid` bigint(20) DEFAULT NULL,
  `sellingPrice` bigint(20) DEFAULT NULL,
  `salesTax` decimal(10,0) DEFAULT NULL,
  `date_sold` datetime DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`saleID`),
  KEY `sales_ibfk_11` (`item_num`),
  KEY `allclients_sales` (`ClientNumber`),
  CONSTRAINT `allclients_sales` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`),
  CONSTRAINT `sales_ibfk_11` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27  8:53:58
