-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: doctoroffice
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `doctorId` varchar(10) NOT NULL,
  `medicaldegrees` varchar(50) NOT NULL,
  `personId` varchar(10) NOT NULL,
  PRIMARY KEY (`doctorId`,`medicaldegrees`,`personId`),
  KEY `personId` (`personId`),
  CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`personId`) REFERENCES `person` (`personId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES ('DJ5000','DDS','444'),('DJ5000','MD','444'),('RG6001','DDS','445'),('MJ6002','DDS','448');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctorspeciality`
--

DROP TABLE IF EXISTS `doctorspeciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctorspeciality` (
  `doctorId` varchar(10) DEFAULT NULL,
  `specialityId` int DEFAULT NULL,
  KEY `doctorId` (`doctorId`),
  KEY `specialityId` (`specialityId`),
  CONSTRAINT `doctorspeciality_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`),
  CONSTRAINT `doctorspeciality_ibfk_2` FOREIGN KEY (`specialityId`) REFERENCES `speciality` (`specialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctorspeciality`
--

LOCK TABLES `doctorspeciality` WRITE;
/*!40000 ALTER TABLE `doctorspeciality` DISABLE KEYS */;
INSERT INTO `doctorspeciality` VALUES ('DJ5000',100),('DJ5000',101),('DJ5000',102),('RG6001',101),('RG6001',102),('MJ6002',NULL);
/*!40000 ALTER TABLE `doctorspeciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctorspecialityrecord`
--

DROP TABLE IF EXISTS `doctorspecialityrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctorspecialityrecord` (
  `doctorId` varchar(50) DEFAULT NULL,
  `dAction` varchar(10) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `specialityId` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctorspecialityrecord`
--

LOCK TABLES `doctorspecialityrecord` WRITE;
/*!40000 ALTER TABLE `doctorspecialityrecord` DISABLE KEYS */;
INSERT INTO `doctorspecialityrecord` VALUES ('DJ5000','ADDED','2020-05-03 01:32:02','100'),('DJ5000','ADDED','2020-05-03 01:32:02','101'),('DJ5000','ADDED','2020-05-03 01:32:02','102'),('RG6001','ADDED','2020-05-03 01:32:02','101'),('RG6001','ADDED','2020-05-03 01:32:02','102'),('MJ6002','ADDED','2020-05-03 01:32:02',NULL);
/*!40000 ALTER TABLE `doctorspecialityrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `doctorview`
--

DROP TABLE IF EXISTS `doctorview`;
/*!50001 DROP VIEW IF EXISTS `doctorview`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `doctorview` AS SELECT 
 1 AS `lastName`,
 1 AS `firstName`,
 1 AS `doctorId`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `patientId` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `personId` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`patientId`),
  KEY `personId` (`personId`),
  CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`personId`) REFERENCES `person` (`personId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES ('1450','1985-01-12','7147855681','101'),('1451','1994-07-23','1258975632','103'),('1460','2000-08-25','1235698745','106'),('1550','1985-10-01','8921462572','102'),('1651','2001-02-02','1232587896','201'),('1850','1993-05-26','4578521456','104');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `patientview`
--

DROP TABLE IF EXISTS `patientview`;
/*!50001 DROP VIEW IF EXISTS `patientview`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `patientview` AS SELECT 
 1 AS `lastName`,
 1 AS `firstName`,
 1 AS `patientId`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `patientvisit`
--

DROP TABLE IF EXISTS `patientvisit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patientvisit` (
  `visitId` varchar(10) NOT NULL,
  `patientId` varchar(10) DEFAULT NULL,
  `doctorId` varchar(10) DEFAULT NULL,
  `visitdate` datetime NOT NULL,
  `docnote` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`visitId`),
  UNIQUE KEY `doctorId` (`doctorId`,`visitdate`),
  KEY `patientId` (`patientId`),
  CONSTRAINT `patientvisit_ibfk_1` FOREIGN KEY (`patientId`) REFERENCES `patient` (`patientId`),
  CONSTRAINT `patientvisit_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientvisit`
--

LOCK TABLES `patientvisit` WRITE;
/*!40000 ALTER TABLE `patientvisit` DISABLE KEYS */;
INSERT INTO `patientvisit` VALUES ('B100','1450','DJ5000','2020-04-21 08:30:00',''),('B102','1450','RG6001','2020-04-21 10:00:00',''),('B103','1450','MJ6002','2020-04-21 14:45:00',''),('B204','1850','RG6001','2020-04-22 13:30:00',''),('B300','1850','DJ5000','2020-04-22 09:00:00',''),('M201','1550','DJ5000','2020-04-21 10:00:00','');
/*!40000 ALTER TABLE `patientvisit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `person` (
  `personId` varchar(10) NOT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` varchar(9) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `ssn` varchar(10) NOT NULL,
  PRIMARY KEY (`personId`),
  UNIQUE KEY `ssn` (`ssn`),
  KEY `personId` (`personId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES ('101','Block','Jane','345 Randolph Circle','Apopka','FL','30458','7147855681','1472583698'),('102','Hamilton','Cherry','3230 Dade St.','Dade City','FL','30555','8921462572','2583693699'),('103','Harrison','Katherine','103 Landis Hall','Bratt','FL','30457','1258975632','2589647896'),('104','Breaux','Carroll','76 Main St.','Apopka','FL','30458','4578521456','8965874569'),('106','Morehouse','Anita','9501 Lafayette St.','Houma','LA','44099','1235698745','1236541236'),('111','Doe','Jane','123 Main St.','Apopka','FL','30458','1258754698','9632589632'),('201','Greaves','Joseph','14325 N. Bankside St.','Godfrey','IL','43580','1232587896','4563214563'),('444','Doe','Jane','Cawthon Dorm, room 642','Tallahassee','FL','32306','3256987412','3258521478'),('445','Riccardi','Greg','101 Thanet St.','London','FL','33333','2589623641','8979878596'),('448','Mylopoulos','Janet','4402 Elm St.','Apopka','FL','33455','1478528529','2121212121');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presciption`
--

DROP TABLE IF EXISTS `presciption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presciption` (
  `presciptionId` varchar(10) NOT NULL,
  `presciptionname` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`presciptionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presciption`
--

LOCK TABLES `presciption` WRITE;
/*!40000 ALTER TABLE `presciption` DISABLE KEYS */;
INSERT INTO `presciption` VALUES ('15C','Ciprofloxa'),('200P','Paracetamo'),('500A','Aspirin');
/*!40000 ALTER TABLE `presciption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presciptionrecord`
--

DROP TABLE IF EXISTS `presciptionrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `presciptionrecord` (
  `presciptionId` varchar(10) DEFAULT NULL,
  `presciptionname` varchar(10) DEFAULT NULL,
  `dAction` varchar(10) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presciptionrecord`
--

LOCK TABLES `presciptionrecord` WRITE;
/*!40000 ALTER TABLE `presciptionrecord` DISABLE KEYS */;
INSERT INTO `presciptionrecord` VALUES ('15C','Ciprofloxa','ADDED','2020-05-03 01:32:05'),('200P','Paracetamo','ADDED','2020-05-03 01:32:05'),('500A','Aspirin','ADDED','2020-05-03 01:32:05');
/*!40000 ALTER TABLE `presciptionrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvisitpresciption`
--

DROP TABLE IF EXISTS `pvisitpresciption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pvisitpresciption` (
  `visitId` varchar(10) DEFAULT NULL,
  `presciptionId` varchar(10) DEFAULT NULL,
  KEY `visitId` (`visitId`),
  KEY `presciptionId` (`presciptionId`),
  CONSTRAINT `pvisitpresciption_ibfk_1` FOREIGN KEY (`visitId`) REFERENCES `patientvisit` (`visitId`),
  CONSTRAINT `pvisitpresciption_ibfk_2` FOREIGN KEY (`presciptionId`) REFERENCES `presciption` (`presciptionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvisitpresciption`
--

LOCK TABLES `pvisitpresciption` WRITE;
/*!40000 ALTER TABLE `pvisitpresciption` DISABLE KEYS */;
INSERT INTO `pvisitpresciption` VALUES ('B100','500A'),('B204','200P'),('M201','15C');
/*!40000 ALTER TABLE `pvisitpresciption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvisitpresciptionrecord`
--

DROP TABLE IF EXISTS `pvisitpresciptionrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pvisitpresciptionrecord` (
  `visitId` varchar(10) DEFAULT NULL,
  `presciptionId` varchar(10) DEFAULT NULL,
  `dAction` varchar(10) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvisitpresciptionrecord`
--

LOCK TABLES `pvisitpresciptionrecord` WRITE;
/*!40000 ALTER TABLE `pvisitpresciptionrecord` DISABLE KEYS */;
INSERT INTO `pvisitpresciptionrecord` VALUES ('B100','500A','ADDED','2020-05-03 01:32:06'),('B204','200P','ADDED','2020-05-03 01:32:06'),('M201','15C','ADDED','2020-05-03 01:32:06');
/*!40000 ALTER TABLE `pvisitpresciptionrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvisitrecord`
--

DROP TABLE IF EXISTS `pvisitrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pvisitrecord` (
  `visitId` varchar(50) DEFAULT NULL,
  `dAction` varchar(10) DEFAULT NULL,
  `patientId` varchar(10) DEFAULT NULL,
  `doctorId` varchar(10) DEFAULT NULL,
  `visitdate` datetime DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `docnote` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvisitrecord`
--

LOCK TABLES `pvisitrecord` WRITE;
/*!40000 ALTER TABLE `pvisitrecord` DISABLE KEYS */;
INSERT INTO `pvisitrecord` VALUES ('B100','ADDED','1450','DJ5000','2020-04-21 08:30:00','2020-05-03 01:32:04',''),('B102','ADDED','1450','RG6001','2020-04-21 10:00:00','2020-05-03 01:32:04',''),('B103','ADDED','1450','MJ6002','2020-04-21 14:45:00','2020-05-03 01:32:04',''),('B204','ADDED','1850','RG6001','2020-04-22 13:30:00','2020-05-03 01:32:04',''),('B300','ADDED','1850','DJ5000','2020-04-22 09:00:00','2020-05-03 01:32:04',''),('M201','ADDED','1550','DJ5000','2020-04-21 10:00:00','2020-05-03 01:32:04','');
/*!40000 ALTER TABLE `pvisitrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvisittest`
--

DROP TABLE IF EXISTS `pvisittest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pvisittest` (
  `visitId` varchar(10) DEFAULT NULL,
  `testId` varchar(10) DEFAULT NULL,
  KEY `visitId` (`visitId`),
  KEY `testId` (`testId`),
  CONSTRAINT `pvisittest_ibfk_1` FOREIGN KEY (`visitId`) REFERENCES `patientvisit` (`visitId`),
  CONSTRAINT `pvisittest_ibfk_2` FOREIGN KEY (`testId`) REFERENCES `test` (`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvisittest`
--

LOCK TABLES `pvisittest` WRITE;
/*!40000 ALTER TABLE `pvisittest` DISABLE KEYS */;
INSERT INTO `pvisittest` VALUES ('B103','BT'),('B300','BT'),('M201','XT'),('B102','XT');
/*!40000 ALTER TABLE `pvisittest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speciality`
--

DROP TABLE IF EXISTS `speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `speciality` (
  `specialityId` int NOT NULL,
  `specialityname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`specialityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality`
--

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` VALUES (100,'Pedodontics'),(101,'Endodontist'),(102,'Orthodontist');
/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialityrecord`
--

DROP TABLE IF EXISTS `specialityrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialityrecord` (
  `userID` varchar(50) DEFAULT NULL,
  `dAction` varchar(10) DEFAULT NULL,
  `datemodified` datetime DEFAULT NULL,
  `specialityID` varchar(10) DEFAULT NULL,
  `specialityname` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialityrecord`
--

LOCK TABLES `specialityrecord` WRITE;
/*!40000 ALTER TABLE `specialityrecord` DISABLE KEYS */;
INSERT INTO `specialityrecord` VALUES ('root@localhost','ADDED','2020-05-03 01:32:07','100','Pedodontic'),('root@localhost','ADDED','2020-05-03 01:32:07','101','Endodontis'),('root@localhost','ADDED','2020-05-03 01:32:07','102','Orthodonti');
/*!40000 ALTER TABLE `specialityrecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `specview`
--

DROP TABLE IF EXISTS `specview`;
/*!50001 DROP VIEW IF EXISTS `specview`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `specview` AS SELECT 
 1 AS `doctorId`,
 1 AS `specialityname`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test` (
  `testId` varchar(10) NOT NULL,
  `testname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`testId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES ('BT','blood test'),('XT','x-ray test');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `doctorview`
--

/*!50001 DROP VIEW IF EXISTS `doctorview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `doctorview` AS select `p`.`lastName` AS `lastName`,`p`.`firstName` AS `firstName`,`d`.`doctorId` AS `doctorId` from (`person` `p` join `doctor` `d`) where (`p`.`personId` = `d`.`personId`) group by `p`.`lastName`,`p`.`firstName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `patientview`
--

/*!50001 DROP VIEW IF EXISTS `patientview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `patientview` AS select `p`.`lastName` AS `lastName`,`p`.`firstName` AS `firstName`,`pa`.`patientId` AS `patientId` from (`patient` `pa` join `person` `p`) where (`p`.`personId` = `pa`.`personId`) group by `p`.`lastName`,`p`.`firstName` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `specview`
--

/*!50001 DROP VIEW IF EXISTS `specview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `specview` AS select `ds`.`doctorId` AS `doctorId`,`s`.`specialityname` AS `specialityname` from (`speciality` `s` join `doctorspeciality` `ds`) where (`s`.`specialityId` = `ds`.`specialityId`) group by `ds`.`doctorId`,`s`.`specialityId` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-02 18:33:23
