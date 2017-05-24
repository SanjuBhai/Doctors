-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: doctors
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` mediumint(8) unsigned NOT NULL,
  `question_owner_id` mediumint(8) unsigned NOT NULL,
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `answer` longtext NOT NULL,
  `likes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `dislikes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_educations`
--

DROP TABLE IF EXISTS `doctor_educations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_educations` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `from_year` smallint(4) unsigned NOT NULL,
  `to_year` smallint(4) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_educations`
--

LOCK TABLES `doctor_educations` WRITE;
/*!40000 ALTER TABLE `doctor_educations` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_educations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_schedules`
--

DROP TABLE IF EXISTS `doctor_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_schedules` (
  `id` mediumint(8) unsigned NOT NULL,
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_schedules`
--

LOCK TABLES `doctor_schedules` WRITE;
/*!40000 ALTER TABLE `doctor_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor_videos`
--

DROP TABLE IF EXISTS `doctor_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor_videos` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_url` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor_videos`
--

LOCK TABLES `doctor_videos` WRITE;
/*!40000 ALTER TABLE `doctor_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `speciality_id` tinyint(3) unsigned NOT NULL,
  `prefix` enum('Dr.','Dt.','Mr.','Ms.','Mrs.') NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `medical_registration_number` varchar(50) NOT NULL,
  `referral_code` varchar(20) DEFAULT NULL,
  `clinic_name` varchar(100) NOT NULL,
  `clinic_fees` smallint(5) unsigned NOT NULL DEFAULT '0',
  `clinic_phone` varchar(15) NOT NULL,
  `clinic_city` varchar(255) NOT NULL,
  `clinic_locality` varchar(255) NOT NULL,
  `online_fees` smallint(5) unsigned NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL,
  `qualifications` varchar(255) DEFAULT NULL,
  `personal_statement` longtext,
  `clinic_latitude` float DEFAULT NULL,
  `clinic_longitude` float DEFAULT NULL,
  `rating_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `like_count` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` bit(1) NOT NULL DEFAULT b'0',
  `facebook_link` text,
  `twitter_link` text,
  `linkedin_link` text,
  `googleplus_link` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (2,5,'Dr.','Test 1 ',NULL,'female','sbdvkjdsbkfbksdbk',NULL,'Test clinic 1',250,'1234567890','Delhi','Lajpat Nagar',0,15,'BDS, MDS',NULL,28.5677,77.2433,0,0,'',NULL,NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-11 00:00:00',NULL),(3,6,'Dr.','Test 2',NULL,'male','sbdvkjdsbkfbkssdbk',NULL,'Test clinic 1',250,'1234567890','Delhi','Lajpat Nagar',0,15,'MBBS, Diploma in Venerology & Dermatology (DVD)','',28.4684,77.0521,0,0,'',NULL,NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-11 00:00:00',NULL),(4,6,'Dr.','Test 4',NULL,'male','sbdvkjdsbkfbkssdk',NULL,'Test clinic 3',350,'1234567893','Gurugram','Sector 14',0,15,'MBBS, Diploma in Venerology','',28.4707,77.0464,0,0,'',NULL,NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-11 00:00:00',NULL),(5,8,'Dt.','Test 5',NULL,'male','sbdvkjdsbkfsbkssdk',NULL,'Test clinic 5',400,'1234567895','Gurugram','Sector 37',0,10,'BDS, MDS','',28.4379,76.998,0,0,'\0',NULL,NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-11 00:00:00',NULL);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` mediumint(8) unsigned NOT NULL,
  `speciality_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `question` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `doctor_id` mediumint(8) unsigned NOT NULL,
  `rating` tinyint(1) unsigned NOT NULL,
  `review` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Doctor'),(3,'Patient');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specializations`
--

DROP TABLE IF EXISTS `specializations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specializations` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specializations`
--

LOCK TABLES `specializations` WRITE;
/*!40000 ALTER TABLE `specializations` DISABLE KEYS */;
INSERT INTO `specializations` VALUES (1,'Dentist',''),(2,'Gynaecologist',''),(3,'General Physician',''),(4,'Physiotherapist',''),(5,'Pediatrician',''),(6,'Orthopedist',''),(7,'General Surgeon',''),(8,'Ophthalmologist',''),(9,'Dermatologist',''),(10,'Cardiologist',''),(11,'Psychologist',''),(12,'Sexologist',''),(13,'Homeopath',''),(14,'Endocrinologist',''),(15,'Dietitian/Nutritionist',''),(16,'Neurologist','');
/*!40000 ALTER TABLE `specializations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login_history`
--

DROP TABLE IF EXISTS `user_login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login_history` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) unsigned NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `user_agent` text NOT NULL,
  `ip_address` int(11) unsigned DEFAULT NULL,
  `mac_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login_history`
--

LOCK TABLES `user_login_history` WRITE;
/*!40000 ALTER TABLE `user_login_history` DISABLE KEYS */;
INSERT INTO `user_login_history` VALUES (11,1,'2016-06-26 10:35:48','2016-06-26 10:40:50','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36',1270,NULL);
/*!40000 ALTER TABLE `user_login_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_type` enum('web','iphone','android') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'web',
  `is_email_verified` bit(1) NOT NULL DEFAULT b'0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` int(10) unsigned DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,3,'Sanjay','Popli','sanjay.jagdish@enukesoftware.com','$2y$10$uiNqMa7G1V8YpdgutymPluAakhH/.xcfmJALuRPMABj1vfjuphuDW',9873304947,NULL,'Haryana','Jind','5, Pocket G-27, Sector 3G, Rohini, New Delhi, Delhi 110085, India',NULL,NULL,NULL,'','web','','ltaR2cKGuY6nZXSxQvs5WxOPkKJZ5SNlqcdPSvGaWl5XFGHuQ2XMkCapkr4e',0,NULL,'2016-06-04 12:58:10','2016-11-25 16:35:40',NULL),(2,2,'Test 1','Kumar','test@gmail.com','djvbsdjvbjsdbvksnhvsdjcbhsdcvhjsdbcjds',1234567890,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'web','',NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-18 00:00:00',NULL),(3,2,'Test 2','Kumar','test2@gmail.com','djvbsdjvbjsdbvksnhvsdjcbhsdcvhjsdbcjds',1234567891,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'web','',NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-18 00:00:00',NULL),(4,2,'Test 3','Kumar','test3@gmail.com','djvbsdjvbjsdbvksnhvsdjcbhsdcvhjsdbcjds',1234567893,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'web','',NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-18 00:00:00',NULL),(5,2,'Test 4','Kumar','test4@gmail.com','djvbsdjvbjsdbvksnhvsdjcbhsdcvhjsdbcjds',1234567894,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'web','',NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-18 00:00:00',NULL),(6,3,'Test 5','Kumar','test5@gmail.com','djvbsdjvbjsdbvksnhvsdjcbhsdcvhjsdbcjds',1234567895,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'web','',NULL,NULL,NULL,'2017-05-18 00:00:00','2017-05-18 00:00:00',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-21 15:24:14
