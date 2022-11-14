-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: food_2
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bill` (
  `idbill` int(11) NOT NULL AUTO_INCREMENT,
  `place` varchar(90) NOT NULL,
  `idmember` int(11) NOT NULL,
  `createdate` timestamp NOT NULL,
  `status` int(11) NOT NULL,
  `sell` int(11) NOT NULL,
  PRIMARY KEY (`idbill`),
  KEY `fk_bill_member_idx` (`idmember`),
  CONSTRAINT `fk_bill_member` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
INSERT INTO `bill` VALUES (3,'Ha Noi',2,'2022-12-09 17:00:00',0,0),(16,'Ha Noi',2,'2022-12-09 17:00:00',0,8000),(18,'Ha Noi',2,'2022-12-09 17:00:00',1,0),(20,'Ha Noi',2,'2022-12-09 17:00:00',1,0),(21,'Ha Noi',2,'2022-12-09 17:00:00',0,0);
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill_detail`
--

DROP TABLE IF EXISTS `bill_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bill_detail` (
  `idbill_detail` int(11) NOT NULL AUTO_INCREMENT,
  `idBill` int(11) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `idProduct` int(11) DEFAULT NULL,
  PRIMARY KEY (`idbill_detail`),
  KEY `fk_product_detail_idx` (`idProduct`),
  KEY `fk_bill_detail_bill_idx` (`idBill`),
  CONSTRAINT `fk_bill_detail_bill` FOREIGN KEY (`idBill`) REFERENCES `bill` (`idbill`),
  CONSTRAINT `fk_product_detail` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idproduct`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill_detail`
--

LOCK TABLES `bill_detail` WRITE;
/*!40000 ALTER TABLE `bill_detail` DISABLE KEYS */;
INSERT INTO `bill_detail` VALUES (1,3,3,2),(2,16,2,2);
/*!40000 ALTER TABLE `bill_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `comment` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `datecomment` timestamp NOT NULL,
  `idproduct` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `idmember` int(11) NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `fk_comment_member_idx` (`idmember`),
  KEY `fk_comment_product_idx` (`idproduct`),
  CONSTRAINT `fk_comment_member` FOREIGN KEY (`idmember`) REFERENCES `member` (`idmember`),
  CONSTRAINT `fk_comment_product` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'ybyb','2019-09-12 12:43:45',2,4,1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `member` (
  `idmember` int(11) NOT NULL AUTO_INCREMENT,
  `namelogin` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(40) NOT NULL,
  `createdate` timestamp NOT NULL,
  `idrole` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  `address` varchar(90) NOT NULL,
  `phone` int(15) NOT NULL,
  PRIMARY KEY (`idmember`),
  KEY `fk_member_role_idx` (`idrole`),
  CONSTRAINT `fk_member_role` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'admin','Nguyen Minh Hieu','1234567','2019-09-12 12:18:42',2,1,'HaNoi',987543333),(2,'nguyenminhhieu','Nguyen Hoa','1234567','2019-09-12 12:18:42',1,0,'HaNoi',987543312);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `information` text NOT NULL,
  `sell` int(11) NOT NULL,
  `typeid` int(11) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`idproduct`),
  KEY `fk_product_type_idx` (`typeid`),
  CONSTRAINT `fk_product_type` FOREIGN KEY (`typeid`) REFERENCES `type` (`typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'ww','ddsds',3000,1,'f7807cb61840294ab37a05e6da1c3b30.jpg',1),(2,'Cơm Sường Cừu','Cơm Sường Cừu',4000,1,'f7807cb61840294ab37a05e6da1c3b30.jpg',0),(3,'ewww','sdsdsd',5000,3,'f7807cb61840294ab37a05e6da1c3b30.jpg',0);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `role` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(45) NOT NULL,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'USER'),(2,'ADMIN');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `type` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(45) NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Foot host'),(2,'Fast food'),(3,'Drinks');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-13 11:04:40
