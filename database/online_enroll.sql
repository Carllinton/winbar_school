-- Win B. A. R. Academy: full database (fresh install), 2026-11-09
-- phpMyAdmin: Import > choose this file > Import. It creates the online_enroll database itself.
-- Sample logins: admin / Admin@2026 (administrator), 25-1001 / Student@2026 (student).
-- Change both passwords before real use.

CREATE DATABASE IF NOT EXISTS `online_enroll`;
USE `online_enroll`;


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
DROP TABLE IF EXISTS `courses_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses_tbl` (
  `course_ID` int(11) NOT NULL AUTO_INCREMENT,
  `course_title` varchar(100) NOT NULL,
  `course_desc` longtext NOT NULL,
  PRIMARY KEY (`course_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `courses_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses_tbl` ENABLE KEYS */;
DROP TABLE IF EXISTS `sched_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sched_tbl` (
  `sched_ID` int(11) NOT NULL AUTO_INCREMENT,
  `section_ID` int(11) NOT NULL,
  `subject_ID` int(11) NOT NULL,
  `Instructor_ID` int(11) NOT NULL,
  `time_from` varchar(100) NOT NULL,
  `time_to` varchar(100) NOT NULL,
  `room_ID` int(11) NOT NULL,
  PRIMARY KEY (`sched_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `sched_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `sched_tbl` ENABLE KEYS */;
DROP TABLE IF EXISTS `sections_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections_tbl` (
  `section_ID` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(100) NOT NULL,
  `section_course` varchar(100) NOT NULL,
  `yr_level` varchar(100) NOT NULL,
  `max_num` int(11) NOT NULL,
  `min_num` int(11) NOT NULL,
  PRIMARY KEY (`section_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `sections_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `sections_tbl` ENABLE KEYS */;
DROP TABLE IF EXISTS `student_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_subject` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` varchar(100) NOT NULL,
  `subjects` longtext NOT NULL,
  `totalunits` int(11) NOT NULL,
  `approved` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `student_subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_subject` ENABLE KEYS */;
DROP TABLE IF EXISTS `studenttbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `studenttbl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` varchar(11) NOT NULL,
  `studnum` varchar(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `minitial` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `contact` varchar(14) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `birthdate` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `yearlvl` varchar(100) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `fathername` varchar(100) NOT NULL,
  `mothername` varchar(100) NOT NULL,
  `guardianname` varchar(100) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `elemschool` varchar(100) NOT NULL,
  `dategradelem` varchar(100) NOT NULL,
  `hsschool` varchar(100) NOT NULL,
  `datehsgrad` varchar(100) NOT NULL,
  `lastgrad` varchar(100) NOT NULL,
  `datelastgrad` varchar(100) NOT NULL,
  `addresslastgrad` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `studenttbl` DISABLE KEYS */;
INSERT INTO `studenttbl` VALUES
(3,'8','25-1001','Juan','P','Dela Cruz','[Sample address]','09170000000','juan.delacruz@example.com','2006-06-15','bsit','II-1','male','[Father\'s name]','[Mother\'s name]','[Guardian\'s name]','[Birthplace]','single','[Elementary school]','2019','[High school]','2025','[High school]','2025','[School address]');
/*!40000 ALTER TABLE `studenttbl` ENABLE KEYS */;
DROP TABLE IF EXISTS `subjecttbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjecttbl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectcode` varchar(100) NOT NULL,
  `subjecttitle` varchar(100) NOT NULL,
  `numofunits` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `islab` int(11) NOT NULL,
  `istutorial` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `course_con` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `subjecttbl` DISABLE KEYS */;
INSERT INTO `subjecttbl` VALUES
(1,'IT201','File Organization','2','','','','',0,0,'asdasdasd','bsit'),
(3,'IT202','File Manage','2','','','','',0,0,'asdsadsad','bsit'),
(4,'CS 103','Farenheit','3','','','','',1,0,'sadadsdsad','bsit');
/*!40000 ALTER TABLE `subjecttbl` ENABLE KEYS */;
DROP TABLE IF EXISTS `usertbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usertbl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `usertbl` DISABLE KEYS */;
INSERT INTO `usertbl` VALUES
(7,'admin','$2y$10$3FWlTR2mQDledQOtjKbEruMVUikYqufWpSdqqMk7O7Ib4a6FGOomy','Ana Reyes','admin'),
(8,'25-1001','$2y$10$Rz6ioHl18SUTMGR/ecMwc.b6q2FhHZm1Zwy/4kvIEyQA257dufWFu','Juan P. Dela Cruz','student');
/*!40000 ALTER TABLE `usertbl` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
