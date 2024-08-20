-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ams_db
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
-- Table structure for table `ams_assets`
--

DROP TABLE IF EXISTS `ams_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(256) NOT NULL,
  `asset_type` varchar(256) NOT NULL,
  `asset_thumbnail` varchar(500) NOT NULL,
  `asset_project` varchar(256) NOT NULL,
  `asset_description` text NOT NULL,
  `asset_status` varchar(256) NOT NULL,
  PRIMARY KEY (`asset_id`),
  UNIQUE KEY `asset_name` (`asset_name`),
  UNIQUE KEY `asset_thumbnail` (`asset_thumbnail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_assets`
--

LOCK TABLES `ams_assets` WRITE;
/*!40000 ALTER TABLE `ams_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `ams_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_episode`
--

DROP TABLE IF EXISTS `ams_episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_episode` (
  `episode_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(256) NOT NULL,
  `episode_name` varchar(256) NOT NULL,
  `scene_count` int(11) DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `asset_count` int(11) DEFAULT NULL,
  `episode_checker` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`episode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_episode`
--

LOCK TABLES `ams_episode` WRITE;
/*!40000 ALTER TABLE `ams_episode` DISABLE KEYS */;
INSERT INTO `ams_episode` VALUES (4,'The Tales of Josiah','Episode 1',24,'Approved',15,'Tristan Pro Sevadera'),(5,'The Tales of Josiah','Episode 2',24,'Revise',12,NULL),(6,'The Tales of Josiah','Episode 3',24,'On Going',13,NULL);
/*!40000 ALTER TABLE `ams_episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_projects`
--

DROP TABLE IF EXISTS `ams_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_projects` (
  `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECT_NAME` varchar(256) DEFAULT NULL,
  `ANIMATION_DURATION` int(11) DEFAULT NULL,
  `NUM_OF_ANIMATION_PROCESS` int(11) DEFAULT NULL,
  `ANIMATION_PROCESS` varchar(256) DEFAULT NULL,
  `PROJECT_DESCRIPTION` varchar(1000) DEFAULT NULL,
  `PROJECT_STATUS` varchar(256) DEFAULT NULL,
  `EPISODE_COUNT` int(11) DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`),
  UNIQUE KEY `PROJECT_NAME` (`PROJECT_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_projects`
--

LOCK TABLES `ams_projects` WRITE;
/*!40000 ALTER TABLE `ams_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `ams_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_remarks`
--

DROP TABLE IF EXISTS `ams_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_remarks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCENE` varchar(256) NOT NULL,
  `PROCESS_NAME` varchar(256) NOT NULL,
  `DATE` date DEFAULT NULL,
  `REMARKS` varchar(1000) DEFAULT NULL,
  `PROJECT_NAME` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_remarks`
--

LOCK TABLES `ams_remarks` WRITE;
/*!40000 ALTER TABLE `ams_remarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `ams_remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_task`
--

DROP TABLE IF EXISTS `ams_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_task` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SCENE` varchar(256) NOT NULL,
  `PROJECT_NAME` varchar(256) NOT NULL,
  `SCENE_ARTIST` varchar(256) NOT NULL,
  `SCENE_STATUS` varchar(256) DEFAULT NULL,
  `SCENE_FRAMES` int(11) DEFAULT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `PROCESS` varchar(256) DEFAULT NULL,
  `TYPE_VALUE` varchar(256) DEFAULT NULL,
  `TASK_FILE` varchar(1000) DEFAULT NULL,
  `SUBMISSION_DATE` date DEFAULT NULL,
  `TASK_EPISODE` varchar(256) DEFAULT NULL,
  `TASK_COLOR` varchar(256) DEFAULT NULL,
  `TASK_TYPE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_task`
--

LOCK TABLES `ams_task` WRITE;
/*!40000 ALTER TABLE `ams_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `ams_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ams_users`
--

DROP TABLE IF EXISTS `ams_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ams_users` (
  `USERNAME` varchar(256) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `USER_PRIVILAGE` varchar(256) NOT NULL,
  `USER_FNAME` varchar(256) NOT NULL,
  `USER_LNAME` varchar(256) NOT NULL,
  `USER_MNAME` varchar(256) DEFAULT NULL,
  `USER_POSITION` varchar(256) NOT NULL,
  `USER_GENDER` varchar(10) NOT NULL,
  PRIMARY KEY (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ams_users`
--

LOCK TABLES `ams_users` WRITE;
/*!40000 ALTER TABLE `ams_users` DISABLE KEYS */;
INSERT INTO `ams_users` VALUES ('admin','1234','ADMIN','TeamApp','TeamApp','TeamApp','ADMINISTRATOR','on');
/*!40000 ALTER TABLE `ams_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-05 13:27:29
