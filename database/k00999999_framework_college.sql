CREATE DATABASE  IF NOT EXISTS `k00999999_framework_college` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `k00999999_framework_college`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: k00999999_framework_college
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.14-MariaDB

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
-- Table structure for table `academicyear`
--

DROP TABLE IF EXISTS `academicyear`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `academicyear` (
  `idAcademicYear` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYear` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idAcademicYear`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academicyear`
--

LOCK TABLES `academicyear` WRITE;
/*!40000 ALTER TABLE `academicyear` DISABLE KEYS */;
INSERT INTO `academicyear` VALUES (5,'2020-21'),(6,'2021-22');
/*!40000 ALTER TABLE `academicyear` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatmsg`
--

DROP TABLE IF EXISTS `chatmsg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chatmsg` (
  `msgID` int(11) NOT NULL AUTO_INCREMENT,
  `msgAuthorID` varchar(10) NOT NULL,
  `msgText` varchar(244) DEFAULT NULL,
  `dateTimeStamp` timestamp NULL DEFAULT current_timestamp(),
  `userType` varchar(45) DEFAULT NULL,
  `msgTo` varchar(45) DEFAULT 'ALL',
  PRIMARY KEY (`msgID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatmsg`
--

LOCK TABLES `chatmsg` WRITE;
/*!40000 ALTER TABLE `chatmsg` DISABLE KEYS */;
INSERT INTO `chatmsg` VALUES (3,'k00123324@','dwfwqf','2022-03-10 18:31:54','STUDENT','ALL'),(4,'k00123324@','This is Topic 02 Exercise 02. This is a practice exercise!','2022-03-18 13:29:03','STUDENT','ALL'),(5,'k00123324@','This is Topic 02 Exercise 02. This is a practice exercise!','2022-03-18 13:30:28','STUDENT','ALL');
/*!40000 ALTER TABLE `chatmsg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `county`
--

DROP TABLE IF EXISTS `county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `county` (
  `idcounty` int(11) NOT NULL AUTO_INCREMENT,
  `countyName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcounty`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `county`
--

LOCK TABLES `county` WRITE;
/*!40000 ALTER TABLE `county` DISABLE KEYS */;
INSERT INTO `county` VALUES (1,'Antrim'),(2,'Armagh'),(3,'Carlow'),(4,'Cavan'),(5,'Clare'),(6,'Cork'),(7,'Donegal'),(8,'Down'),(9,'Dublin'),(10,'DunLaoghaire-Rathdown'),(11,'Fermanagh'),(12,'Fingal'),(13,'Galway'),(14,'Kerry'),(15,'Kildare'),(16,'Kilkenny'),(17,'Laois'),(18,'Leitrim'),(19,'Limerick'),(20,'Londonderry'),(21,'Longford'),(22,'Louth'),(23,'Mayo'),(24,'Meath'),(25,'Monaghan'),(26,'North Tipperary'),(27,'Offaly'),(28,'Roscommon'),(29,'Sligo'),(30,'South Dublin'),(31,'South Tipperary'),(32,'Tipperary'),(33,'Tyrone'),(34,'Waterford'),(35,'Westmeath'),(36,'Wexford'),(37,'Wicklow');
/*!40000 ALTER TABLE `county` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrolment`
--

DROP TABLE IF EXISTS `enrolment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrolment` (
  `studentID` varchar(10) NOT NULL,
  `moduleID` varchar(10) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `academicYearLookup` int(11) NOT NULL,
  PRIMARY KEY (`studentID`,`moduleID`),
  KEY `fk_user_has_module_module1_idx` (`moduleID`),
  KEY `fk_user_has_module_user1_idx` (`studentID`),
  KEY `fk_enrolment_academicyear1_idx` (`academicYearLookup`),
  CONSTRAINT `fk_enrolment_academicyear1` FOREIGN KEY (`academicYearLookup`) REFERENCES `academicyear` (`idAcademicYear`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_module_module1` FOREIGN KEY (`moduleID`) REFERENCES `module` (`ModuleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_module_user1` FOREIGN KEY (`studentID`) REFERENCES `user` (`CollegeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrolment`
--

LOCK TABLES `enrolment` WRITE;
/*!40000 ALTER TABLE `enrolment` DISABLE KEYS */;
INSERT INTO `enrolment` VALUES ('K00123324','AC230',NULL,6),('K00123324','ALG002',NULL,6),('K00123324','BA201',NULL,6),('K00123324','DATAB0018',45,5),('K00123324','SOFT001',NULL,6),('K00675455','DATAB0018',30,5),('K00675455','SOFT001',56,5),('K00998845','ALG002',NULL,5),('K00998845','DATAB0018',NULL,5);
/*!40000 ALTER TABLE `enrolment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helprequest`
--

DROP TABLE IF EXISTS `helprequest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helprequest` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `requestDescription` varchar(255) DEFAULT NULL,
  `user_CollegeID` varchar(10) NOT NULL,
  `requestOpenDate` datetime DEFAULT current_timestamp(),
  `requestCloseDate` datetime DEFAULT NULL,
  `requestStatus` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`requestID`),
  KEY `fk_helpRequest_user1_idx` (`user_CollegeID`),
  CONSTRAINT `fk_helpRequest_user1` FOREIGN KEY (`user_CollegeID`) REFERENCES `user` (`CollegeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helprequest`
--

LOCK TABLES `helprequest` WRITE;
/*!40000 ALTER TABLE `helprequest` DISABLE KEYS */;
INSERT INTO `helprequest` VALUES (1,'PC Problem','L05032554','2022-04-05 12:30:28',NULL,1),(7,'My moodle account is locked','L05032554','2022-04-05 12:30:28',NULL,1),(8,'I need new batteries for my mouse','L05032554','2022-04-05 12:30:44',NULL,1),(9,'MySQL Server issue','L05032554','2022-04-05 12:39:21',NULL,1),(10,'I need some help with using my PC','L05032554','2022-04-05 13:57:59','2022-04-05 14:18:10',0),(11,'My internet doesnt seem to be working','L05032554','2022-04-05 14:18:50',NULL,1),(12,'My keyboard is frozen','L05032554','2022-04-05 14:19:03',NULL,1),(13,'test request','L05032554','2022-05-03 13:28:53','2022-05-03 13:35:11',0),(14,'help me ','L05032554','2022-05-04 15:16:53','2022-05-04 15:18:23',0),(15,'help I have a practical!!!','L05032554','2022-05-05 10:07:41','2022-05-05 10:10:38',0);
/*!40000 ALTER TABLE `helprequest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helprequestresponse`
--

DROP TABLE IF EXISTS `helprequestresponse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `helprequestresponse` (
  `responseNr` int(11) NOT NULL AUTO_INCREMENT,
  `responder_CollegeID` varchar(10) NOT NULL,
  `helpRequest_requestID` int(11) NOT NULL,
  `helpRequestResponse` varchar(255) DEFAULT NULL,
  `responseTimestamp` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`responseNr`),
  KEY `fk_user_has_helpRequest_helpRequest1_idx` (`helpRequest_requestID`),
  KEY `fk_user_has_helpRequest_user1_idx` (`responder_CollegeID`),
  CONSTRAINT `fk_user_has_helpRequest_helpRequest1` FOREIGN KEY (`helpRequest_requestID`) REFERENCES `helprequest` (`requestID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_helpRequest_user1` FOREIGN KEY (`responder_CollegeID`) REFERENCES `user` (`CollegeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helprequestresponse`
--

LOCK TABLES `helprequestresponse` WRITE;
/*!40000 ALTER TABLE `helprequestresponse` DISABLE KEYS */;
INSERT INTO `helprequestresponse` VALUES (1,'A05021145',1,'Turn it on','2022-04-05 10:49:49'),(6,'A05021145',7,'Working on it','2022-04-05 12:34:22'),(7,'A05021145',8,'In progress','2022-04-05 12:34:22'),(8,'A05021145',7,'The Moodle problem is being addressed','2022-04-05 12:35:10');
/*!40000 ALTER TABLE `helprequestresponse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `ModuleID` varchar(10) NOT NULL DEFAULT '',
  `ModuleTitle` varchar(45) NOT NULL,
  `Credits` varchar(45) NOT NULL,
  `LecturerID` varchar(10) NOT NULL,
  PRIMARY KEY (`ModuleID`),
  KEY `fk_module_user1_idx` (`LecturerID`),
  CONSTRAINT `fk_module_user1` FOREIGN KEY (`LecturerID`) REFERENCES `user` (`CollegeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES ('AC230','Accounting 2','10','A00024254'),('ALG002','Algorithms 3','5','L04588745'),('BA201','Business Administration','10','A00029754'),('DATAB0018','Data Driven Applications 2','10','L05032554'),('EN101','Introduction to Engineering','10','A00087985'),('MA101','Mathematics 1','10','A00094855'),('MA201','Mathematics 2','10','A00132745'),('SOFT001','Introduction to Programming','5','L05032554');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roombookhours`
--

DROP TABLE IF EXISTS `roombookhours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roombookhours` (
  `idroomBookHours` int(11) NOT NULL AUTO_INCREMENT,
  `startTime` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`idroomBookHours`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roombookhours`
--

LOCK TABLES `roombookhours` WRITE;
/*!40000 ALTER TABLE `roombookhours` DISABLE KEYS */;
INSERT INTO `roombookhours` VALUES (1,'08:00'),(2,'09:00'),(3,'10:00'),(4,'11:00'),(5,'12:00'),(6,'13:00'),(7,'14:00'),(8,'15:00'),(9,'16:00'),(10,'17:00'),(11,'18:00'),(12,'19:00'),(13,'20:00'),(14,'21:00');
/*!40000 ALTER TABLE `roombookhours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studyroom`
--

DROP TABLE IF EXISTS `studyroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studyroom` (
  `idstudyRoom` int(11) NOT NULL AUTO_INCREMENT,
  `studyRoomLocation` varchar(45) DEFAULT NULL,
  `studyRoomDescription` varchar(45) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `powerSocket` int(11) DEFAULT 0,
  `roomAvailable` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`idstudyRoom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studyroom`
--

LOCK TABLES `studyroom` WRITE;
/*!40000 ALTER TABLE `studyroom` DISABLE KEYS */;
INSERT INTO `studyroom` VALUES (1,'Library','Study Room 1',4,2,1),(2,'Library','Study Room 2',6,4,1),(3,'Library ','Study Room 3',4,0,1),(4,'Library','Study Room 4',5,2,1),(5,'Library','Study Room 5',2,0,1),(6,'Library','Study Room 6',6,4,1),(7,'Library','Study Room 7',4,2,1),(8,'Block 15','Project Room 15B25',12,20,1);
/*!40000 ALTER TABLE `studyroom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studyroombooking`
--

DROP TABLE IF EXISTS `studyroombooking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studyroombooking` (
  `roomBookingNr` int(11) NOT NULL AUTO_INCREMENT,
  `userCollegeID` varchar(10) NOT NULL,
  `studyRoomID` int(11) NOT NULL,
  `roomBookStartTime` int(11) NOT NULL,
  `bookingDate` date DEFAULT NULL,
  `cancelBooking` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`roomBookingNr`),
  KEY `fk_user_has_studyRoom_studyRoom1_idx` (`studyRoomID`),
  KEY `fk_user_has_studyRoom_user1_idx` (`userCollegeID`),
  KEY `fk_user_has_studyRoom_roomBookHours1_idx` (`roomBookStartTime`),
  CONSTRAINT `fk_user_has_studyRoom_roomBookHours1` FOREIGN KEY (`roomBookStartTime`) REFERENCES `roombookhours` (`idroomBookHours`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_studyRoom_studyRoom1` FOREIGN KEY (`studyRoomID`) REFERENCES `studyroom` (`idstudyRoom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_studyRoom_user1` FOREIGN KEY (`userCollegeID`) REFERENCES `user` (`CollegeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studyroombooking`
--

LOCK TABLES `studyroombooking` WRITE;
/*!40000 ALTER TABLE `studyroombooking` DISABLE KEYS */;
INSERT INTO `studyroombooking` VALUES (1,'k00123324',1,2,'2022-05-27',0),(2,'k00123324',2,3,'2022-05-31',0),(3,'K00123324',1,10,'2022-05-27',0),(4,'K00123324',1,10,'2022-05-27',0),(5,'K00123324',1,2,'2022-05-31',1),(6,'K00123324',2,2,'2022-05-31',1),(7,'K00123324',3,2,'2022-05-31',1),(8,'K00123324',1,3,'2022-06-06',0),(9,'K00123324',2,3,'2022-06-06',0),(10,'K00123324',1,1,'0000-00-00',0),(11,'K00123324',1,3,'2022-08-10',1),(12,'K00123324',1,1,'2022-05-13',0),(13,'K00123324',1,1,'2022-05-26',0),(14,'K00123324',1,1,'2022-05-27',0),(15,'K00123324',2,1,'2022-05-27',0),(16,'K00123324',3,1,'2022-05-27',0),(17,'K00123324',1,1,'2022-05-20',0),(18,'K00123324',2,1,'2022-05-20',0),(19,'K00123324',1,1,'2022-05-31',1),(20,'K00123324',1,3,'2022-08-24',0),(21,'K00123324',2,3,'2022-08-24',1),(22,'K00123324',1,1,'2022-10-03',1),(23,'K00123324',1,1,'2022-11-22',1),(24,'K00123324',2,1,'2022-11-22',1),(25,'K00123324',2,1,'2022-07-07',1),(26,'K00123324',1,1,'2022-07-07',0),(27,'K00123324',3,1,'2022-07-07',0),(28,'K00123324',1,1,'2022-06-01',1),(29,'K00123324',2,1,'2022-06-01',0),(30,'K00123324',1,4,'2022-06-01',0),(31,'K00123324',1,1,'2022-06-02',1),(32,'K00123324',1,12,'2022-06-02',1),(33,'K00123324',2,12,'2022-06-02',1),(34,'K00123324',5,5,'2022-06-22',1),(35,'K00123324',1,5,'2022-06-22',0),(36,'K00123324',3,5,'2022-06-22',1),(37,'K00123324',7,5,'2022-06-22',0),(38,'K00123324',6,1,'2022-06-01',1),(39,'K00123324',2,2,'2022-06-01',1),(40,'K00123324',6,2,'2022-06-01',1),(41,'K00123324',7,1,'2022-05-31',1),(42,'K00123324',4,1,'2022-05-31',1),(43,'K00123324',2,1,'2022-05-31',1),(44,'K00123324',6,1,'2022-05-31',1),(45,'K00123324',1,1,'2022-05-31',1),(46,'K00123324',7,1,'2022-05-31',1),(47,'K00123324',4,1,'2022-05-31',1),(48,'K00123324',2,1,'2022-05-31',1),(49,'K00123324',6,1,'2022-05-31',1),(50,'K00123324',2,1,'2022-05-31',0);
/*!40000 ALTER TABLE `studyroombooking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `CollegeID` varchar(10) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `PassWord` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `idcounty` int(11) NOT NULL,
  `userType` varchar(45) NOT NULL DEFAULT 'CUSTOMER',
  PRIMARY KEY (`CollegeID`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_admin_county2_idx` (`idcounty`),
  CONSTRAINT `fk_admin_county2` FOREIGN KEY (`idcounty`) REFERENCES `county` (`idcounty`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('A00024254','Ronald','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','rons@college.ie','0854784586',3,'LECTURER'),('A00029754','Peter','Brady','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','peteb@college.ie','0865211458',6,'LECTURER'),('A00087985','Mary','Murphy','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','murfm@college.ie','0875546258',4,'LECTURER'),('A00094855','Elizabeth','O\'Brien','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','lizob@college.ie','0862549852',8,'LECTURER'),('A00132745','Barry','O\'Connor','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','baz@college.ie','0864574125',12,'LECTURER'),('A00231654','John','Staples','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','hero@college.ie','0854475123',16,'LECTURER'),('A00841985','John','O\'Connell','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','joc@college.ie','0847512596',9,'LECTURER'),('A05021145','John','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','jsmith@college.ie','0875869745',4,'ADMIN'),('K00123324','Harry','Boland','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00123324@student.college.ie','01234567',13,'STUDENT'),('K00125554','James','Flannery','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00125554@student.college.ie','0875426987',3,'STUDENT'),('K00457833','James','Murphy','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00457833@student.college.ie','0862356897',19,'STUDENT'),('K00547895','Jack','McKeown','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00547895@student.college.ie','0875458745',8,'STUDENT'),('K00675455','William','Hart','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00675455@student.college.ie','0847588985',10,'STUDENT'),('K00998845','Harold','Wilson','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','k00998845@student.college.ie','087458784',10,'STUDENT'),('L04588745','Francis','Black','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','francis.black@college.ie','0874588784',13,'LECTURER'),('L05032554','Jane','Smith','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','jane.smith@college.ie','087123456',13,'LECTURER'),('L05241551','Gerry','O\'Brien','90fa6dc0e910c9a7f5e5f3fbca1e669caeb80289','gerry.obrien@college.ie','0854477541',9,'LECTURER'),('L06588748','Jamie','Prince','cf8f0c0d32522bc3d2ebe59d1fa46611d3369c96','jamie.prince@college.ie','0865584214',11,'LECTURER');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'k00999999_framework_college'
--
/*!50003 DROP PROCEDURE IF EXISTS `checkRoomAvailability` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkRoomAvailability`(IN roomID INT, IN timeSlot INT, IN bookingDate DATE , OUT available BOOLEAN)
BEGIN

DECLARE booked BOOLEAN;

SET booked=0;

SELECT COUNT(*) INTO booked FROM studyroombooking WHERE studyRoomID=roomID AND roomBookStartTime=timeSlot AND bookingDate=bookingDate;


IF (booked>0)
THEN 
	SET available=false;
ELSE 
	SET available=true;
END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-31 10:34:31
