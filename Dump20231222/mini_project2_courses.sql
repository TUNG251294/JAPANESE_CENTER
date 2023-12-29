-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mini_project2
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` bigint unsigned DEFAULT NULL,
  `estimated_students` int DEFAULT NULL,
  `actual_students` int DEFAULT NULL,
  `fee` int NOT NULL,
  `opening_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `schedule_dates` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_session` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_name_unique` (`name`),
  KEY `courses_level_id_foreign` (`level_id`),
  CONSTRAINT `courses_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'TEST COURSE',5,40,37,9000000,'2023-11-12','2024-07-31','ONGOING','monday,saturday',60),(2,'Est qui.',5,65,41,8037601,'2010-08-10','2012-06-07','ONGOING','tuesday,friday',38),(4,'Architecto cupiditate.',5,63,59,7072922,'1995-03-10','1981-07-27','ONGOING','monday,thursday',42),(5,'Dicta ea.',2,69,91,8121374,'2021-03-17','1978-03-09','ONGOING','monday,thursday',54),(6,'Accusantium vel excepturi.',4,88,75,8706313,'2002-10-31','1999-12-25','CLOSED','monday,thursday',31),(7,'Unde nisi maiores.',3,43,76,4797492,'2018-04-20','2023-08-23','NEW','monday,thursday',42),(8,'Vero et.',5,69,41,4823330,'1982-01-17','2017-03-16','CLOSED','tuesday,friday',46),(9,'Nesciunt et.',1,22,16,3841020,'1994-04-10','2008-01-07','NEW','monday,thursday',41),(10,'Architecto adipisci architecto.',5,51,95,1294748,'1971-07-16','1978-02-05','ONGOING','tuesday,friday',55),(11,'Maxime laborum fugiat.',4,15,99,9329037,'1970-06-15','2001-05-18','NEW','tuesday,friday',23),(12,'TEST Register',4,42,100,1012972,'2018-04-30','1992-10-28','NEW','tuesday,friday',41),(13,'Et quos accusantium.',4,60,57,5785356,'1990-02-06','1991-06-25','CLOSED','tuesday,friday',52),(14,'Aut aut veniam.',3,20,24,6467270,'1975-10-14','2010-02-17','NEW','monday,thursday',39),(15,'Vel voluptates.',4,82,96,9739335,'1995-09-17','2014-09-02','CLOSED','tuesday,friday',51),(16,'Delectus porro corrupti.',4,37,17,4838900,'1982-11-24','1979-08-30','NEW','tuesday,friday',37),(17,'Quia ut occaecati.',2,74,94,7358942,'1997-11-19','2006-02-06','CLOSED','monday,thursday',40),(18,'Animi omnis iure.',5,100,27,7911374,'1987-12-21','1979-03-04','ONGOING','monday,thursday',27),(19,'Animi tempora consequatur.',4,17,14,7387377,'1993-04-30','1998-09-02','CLOSED','monday,thursday',47),(21,'WINTER 2024',4,20,NULL,10000000,'2023-12-20','0023-04-15','ONGOING','wednesday,friday',30),(22,'JAPANESE MID 2023',5,20,NULL,30000000,'2023-12-20','2024-04-30','NEW','monday,saturday',35);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-22 13:37:25
