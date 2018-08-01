-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: fsic
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstName` varchar(120) NOT NULL,
  `lastName` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin','admin','Admin','Admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstName` varchar(120) NOT NULL,
  `lastName` varchar(120) NOT NULL,
  `contactNo` varchar(11) DEFAULT '-----',
  `position` varchar(120) DEFAULT 'Not Stated',
  `status` enum('Pending','Active','Disabled') NOT NULL DEFAULT 'Pending',
  `profilepicture` varchar(45) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES ('2160051','2160051','Erythrina Nicole','Andres','09298964209','Intern','Active','2160051.jpg'),('2160052','2160052','Mina Isabelle','Santos','09283746298','Intern','Pending','default.jpg'),('365NKE','365NKE','John','Alvarez','09153647263','Fire Officer','Pending','default.jpg');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientdocument`
--

DROP TABLE IF EXISTS `clientdocument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientdocument` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `orNo` varchar(45) NOT NULL,
  `fsicNo` int(11) NOT NULL,
  `id` varchar(45) NOT NULL,
  PRIMARY KEY (`clientID`),
  KEY `orNo_idx` (`orNo`),
  KEY `fsicNo_idx` (`fsicNo`),
  KEY `id_idx` (`id`),
  CONSTRAINT `fsicNo` FOREIGN KEY (`fsicNo`) REFERENCES `document` (`fsicNo`) ON UPDATE CASCADE,
  CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `client` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `orNo` FOREIGN KEY (`orNo`) REFERENCES `payment` (`orNo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientdocument`
--

LOCK TABLES `clientdocument` WRITE;
/*!40000 ALTER TABLE `clientdocument` DISABLE KEYS */;
INSERT INTO `clientdocument` VALUES (1,'345',335,'2160051'),(2,'326',325,'2160051');
/*!40000 ALTER TABLE `clientdocument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `fsicNo` int(11) NOT NULL,
  `dateReceived` date NOT NULL,
  `dateReleased` date NOT NULL,
  `nameOfBusiness` varchar(240) NOT NULL,
  `typeOfBusiness` varchar(120) NOT NULL,
  `nameOwner` varchar(240) NOT NULL,
  `orNo` varchar(45) DEFAULT 'None',
  `remarks` varchar(240) DEFAULT 'None',
  `new` enum('Yes','Not Stated') NOT NULL DEFAULT 'Not Stated',
  PRIMARY KEY (`fsicNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (325,'2018-07-26','2018-07-26','Monang\'s Dried Fish','Dried Fish','Monang Elegado','326','Not Stated','Yes'),(335,'2018-01-09','2018-01-09','Nanay\'s Dried Fish','Dried Fish','Juanita Escodero','345','Not Stated','Not Stated');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `orNo` varchar(45) NOT NULL,
  `amtPaid` decimal(9,2) NOT NULL,
  `payDate` date DEFAULT NULL,
  `status` enum('Paid','Pending') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`orNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES ('326',155.50,'2018-07-26','Paid'),('345',150.00,'2018-01-09','Paid');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-01  8:53:34
