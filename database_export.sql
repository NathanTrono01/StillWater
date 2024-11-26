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
  `ClientNumber` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `givenName` varchar(100) DEFAULT NULL,
  `ClientAddress` varchar(255) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ClientNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allclients`
--

LOCK TABLES `allclients` WRITE;
/*!40000 ALTER TABLE `allclients` DISABLE KEYS */;
INSERT INTO `allclients` VALUES (42,'Nathan Miguel','Prk. 3 Luinab, Iligan City','Trono'),(43,'Edsel Lyann Khim','Dalipuga','Bering'),(44,'Jaymar','Pugaan','Mangiboa'),(46,'Janblaire','Suarez','Mericuelo'),(49,'Test','Test','Test'),(50,'test2','test3','test1'),(51,'John','123 Main St','Doe'),(52,'Jane','456 Oak St','Smith'),(53,'Alice','789 Pine St','Johnson'),(54,'Bob','101 Maple St','Brown'),(55,'Charlie','202 Birch St','Davis'),(56,'David','303 Cedar St','Wilson'),(57,'Eve','404 Elm St','Taylor'),(58,'Frank','505 Spruce St','Anderson'),(59,'Grace','606 Fir St','Thomas'),(60,'Hank','707 Willow St','Moore'),(61,'Ivy','808 Ash St','Martin'),(62,'Jack','909 Poplar St','Lee'),(63,'Kathy','1010 Cypress St','White'),(64,'Leo','1111 Redwood St','Harris'),(65,'Mia','1212 Sequoia St','Clark'),(66,'Nina','1313 Magnolia St','Lewis'),(67,'Oscar','1414 Palm St','Walker'),(68,'Paul','1515 Olive St','Hall'),(69,'Quinn','1616 Cedar St','Allen'),(70,'Rose','1717 Pine St','Young'),(71,'Sam','1818 Oak St','King'),(72,'Tina','1919 Maple St','Scott'),(73,'Uma','2020 Birch St','Green'),(74,'Vince','2121 Cedar St','Adams'),(75,'Wendy','2222 Elm St','Baker'),(76,'Xander','2323 Spruce St','Carter'),(77,'Yara','2424 Fir St','Mitchell'),(78,'Zane','2525 Willow St','Perez'),(79,'Amy','2626 Ash St','Roberts'),(80,'Brian','2727 Poplar St','Turner');
/*!40000 ALTER TABLE `allclients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_num` int(11) NOT NULL AUTO_INCREMENT,
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
  CONSTRAINT `allclients_items` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (61,'Testing Item 1',0,'Testing Sales, and Inserting for Commission',NULL,'Excellent','Others',1,42),(62,'Testing Item 2',0,'Testing Existing Clients Commissions','67456c77cdee7-3051b9ce49b872d9d6f6e1deee24e0f7.png','Excellent','Others',0,43),(63,'Testing Item 3',1,'Testing Sales, and Item Insertion','67456c6f552e5-3051b9ce49b872d9d6f6e1deee24e0f7.png','Bad','Others',0,NULL),(69,'test',1,'test',NULL,'Bad','Others',1,44),(71,'test4',1,'test5','67456c663b3b9-3051b9ce49b872d9d6f6e1deee24e0f7.png','Excellent','Others',0,50),(72,'test6',1,'test7',NULL,'Bad','Others',1,50);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `purchase_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `condition_at_purchase` text DEFAULT NULL,
  `p_date` datetime DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `Items_Purchases` (`item_num`),
  KEY `AllClients_Purchases` (`ClientNumber`),
  CONSTRAINT `purchases_ibfk_10` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchases_ibfk_14` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (22,'Excellent','2024-11-23 11:33:51',61,42),(23,'Excellent','2024-11-23 11:40:58',62,43),(24,'Bad','2024-11-23 12:31:40',NULL,44),(26,'Bad','2024-11-23 13:21:02',69,44),(27,'Bad','2024-11-25 16:31:37',71,50),(28,'Bad','2024-11-25 08:32:17',72,50);
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `saleID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commissionPaid` bigint(20) DEFAULT NULL,
  `sellingPrice` bigint(20) DEFAULT NULL,
  `salesTax` decimal(10,0) DEFAULT NULL,
  `date_sold` datetime DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`saleID`),
  KEY `AllClients_Sales` (`ClientNumber`),
  KEY `Items_Sales` (`item_num`),
  CONSTRAINT `sales_ibfk_11` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `sales_ibfk_5` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (19,NULL,1,0,'2024-11-23 11:35:58',61,NULL),(20,NULL,10,1,'2024-11-25 16:33:00',69,NULL),(21,NULL,10,1,'2024-11-25 16:33:32',72,NULL);
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

-- Dump completed on 2024-11-26  6:37:54
