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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allclients`
--

LOCK TABLES `allclients` WRITE;
/*!40000 ALTER TABLE `allclients` DISABLE KEYS */;
INSERT INTO `allclients` VALUES (3,'John','123 Apple St, Toronto','Smith'),(4,'Emma','456 Maple Ave, Vancouver','Johnson'),(6,'Sarah','321 Pine Lane, Calgary','Brown'),(7,'David','654 Cedar Blvd, Ottawa','Jones'),(8,'Lisa','987 Birch Way, Edmonton','Garcia'),(9,'James','147 Elm St, Victoria','Miller'),(10,'Jennifer','258 Spruce Ave, Halifax','Davis'),(11,'Robert','369 Willow Rd, Regina','Rodriguez'),(12,'Maria','741 Fir Lane, Winnipeg','Martinez'),(13,'William','852 Ash St, Quebec City','Anderson'),(14,'Patricia','963 Poplar Ave, Hamilton','Taylor'),(15,'Richard','159 Maple Dr, Surrey','Thomas'),(16,'Linda','753 Oak Circle, London','Moore'),(17,'Joseph','951 Pine Court, Saskatoon','Jackson'),(19,'Thomas','486 Birch Road, Kingston','Harris'),(20,'Margaret','264 Spruce Lane, Kelowna','Martin'),(21,'Charles','159 Willow Ave, Gatineau','Thompson'),(22,'Sandra','753 Elm Court, Guelph','Lee'),(23,'Cyril Jay','Suarez','Acope'),(24,'Jaymar','Pugaan','Mangiboa'),(25,'Jerick Carlo','Iligan','Almeda');
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
  `condition` text DEFAULT NULL,
  `item_type` text DEFAULT NULL,
  `is_sold` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`item_num`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Emerald',99999,'Crafted by Minecraft Villagers','Excellent','Jewel',1),(2,'Rusty Can',10,'Test','Bad','Material',1),(10,'test3',121,'test3','Excellent','test',1),(11,'Antique Victorian Chair',2500,'Excellent craftsmanship, original upholstery','Good','Furniture',0),(12,'1920s Diamond Ring',15000,'Art deco style, 2 carat diamond','Excellent','Jewelry',0),(13,'Vintage Rolex Watch',8500,'Original box and papers included','Excellent','Watches',0),(14,'Persian Carpet',4000,'Hand-woven, natural dyes','Good','Textiles',0),(15,'Bronze Sculpture',3500,'Signed by artist, limited edition','Excellent','Art',0),(16,'Ming Dynasty Vase',12000,'Authenticated, minor restoration','Fair','Pottery',0),(17,'First Edition Book',5000,'Signed by author, rare find','Good','Literature',0),(18,'Art Deco Lamp',1800,'Original glass shade, rewired','Good','Lighting',0),(19,'Vintage Camera',900,'Leica M3, working condition','Fair','Photography',0),(20,'Gold Pocket Watch',3200,'Swiss made, 18k gold case','Good','Watches',0),(21,'Tiffany Stained Glass',7500,'Original piece, documented','Excellent','Art Glass',0),(22,'Victorian Writing Desk',4500,'Mahogany, original hardware','Good','Furniture',0),(23,'Ancient Roman Coin',2800,'Authenticated, rare mint','Fair','Numismatics',0),(24,'Vintage Wine',6000,'Bordeaux 1982, perfect provenance','Excellent','Wine',0),(25,'Oil Painting',9500,'19th century landscape','Good','Art',0),(26,'Crystal Chandelier',5500,'French, 19th century','Good','Lighting',0),(27,'Samurai Sword',11000,'Edo period, authenticated','Good','Weapons',0),(28,'Emerald Necklace',18000,'Colombian emeralds, 18k gold','Excellent','Jewelry',0),(29,'Vintage Motorcycle',15000,'1960 Harley Davidson','Fair','Vehicles',0),(30,'Chinese Jade Carving',3800,'Qing Dynasty, certified','Good','Art',0),(31,'Emerald Block',123,'Crafted by Minecraft Villagers','Fair','Jewel',1),(32,'Nokia',10,'Functional Vintage Nokia','Good','Gadget',1),(33,'Taro Que Chips',15,'Cheese Flavor','Good','Food',1),(34,'25 year old Rocking Chair',10000,'Slighly washout color','Good','Furniture',1);
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
  `p_cost` bigint(20) DEFAULT NULL,
  `p_date` datetime DEFAULT NULL,
  `item_num` int(11) DEFAULT NULL,
  `ClientNumber` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `Items_Purchases` (`item_num`),
  KEY `AllClients_Purchases` (`ClientNumber`),
  CONSTRAINT `purchases_ibfk_10` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`),
  CONSTRAINT `purchases_ibfk_14` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (5,'Fair',123,'2024-11-05 18:59:06',31,23),(6,'Good',50,'2024-11-06 10:44:45',33,24),(7,'Good',10000,'2024-11-08 08:51:22',34,25);
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
  CONSTRAINT `sales_ibfk_11` FOREIGN KEY (`item_num`) REFERENCES `items` (`item_num`),
  CONSTRAINT `sales_ibfk_5` FOREIGN KEY (`ClientNumber`) REFERENCES `allclients` (`ClientNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (3,150,125,15,'2024-11-05 19:01:50',31,3),(4,NULL,15,2,'2024-11-06 10:45:44',33,NULL),(6,NULL,123,15,'2024-11-06 10:47:37',10,NULL),(7,NULL,5,1,'2024-11-07 17:31:16',2,NULL),(8,NULL,15000,1800,'2024-11-08 08:55:45',34,25);
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

-- Dump completed on 2024-11-10 23:23:50
