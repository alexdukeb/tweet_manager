/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - tweet_manager
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tweet_manager` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tweet_manager`;

/*Table structure for table `hashtag` */

DROP TABLE IF EXISTS `hashtag`;

CREATE TABLE `hashtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5AB52A611041E39B` (`tweet_id`),
  CONSTRAINT `FK_5AB52A611041E39B` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hashtag` */

insert  into `hashtag`(`id`,`tweet_id`,`content`) values 
(7,10,'h1'),
(8,10,'h2'),
(9,10,'h3'),
(10,11,'tweet'),
(11,11,'super'),
(12,11,'test'),
(13,12,'autre'),
(14,12,'super'),
(15,12,'test'),
(16,13,'different'),
(17,13,'super'),
(18,13,'test'),
(19,15,'sport'),
(20,15,'football'),
(21,16,'sport'),
(22,16,'baksetball'),
(23,17,'sport'),
(24,17,'tennis'),
(25,18,'web'),
(26,18,'super'),
(27,19,'web'),
(28,19,'php'),
(29,19,'epinal'),
(30,19,'developpeur'),
(31,20,'football'),
(32,20,'epinal');

/*Table structure for table `tweets` */

DROP TABLE IF EXISTS `tweets`;

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tweets` */

insert  into `tweets`(`id`,`message`,`author`,`create_date`) values 
(10,'teweet message','Alex','2021-03-11 01:22:08'),
(11,'Un super tweet de test.','Alex','2021-03-11 02:22:03'),
(12,'Un autre super tweet de test.','Alex','2021-03-11 02:22:35'),
(13,'Un super tweet de test different.','Alex','2021-03-11 02:22:50'),
(14,'Un super tweet sans hashtags','Alex','2021-03-11 02:25:17'),
(15,'Un tweet sur du football.','Alex','2021-03-11 11:54:49'),
(16,'Un tweet sur du basket.','Alex','2021-03-11 11:55:03'),
(17,'Un tweet sur du tennis.','Alex','2021-03-11 11:55:12'),
(18,'Splitfire est une super agence web.','Alex','2021-03-11 11:56:10'),
(19,'Nous recherchons un developpeur web backend php a Epinal.','Splitfire','2021-03-11 11:58:25'),
(20,'Reprise des entrainements en vue des prochains matchs.','SAS Epinal','2021-03-11 12:01:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
