/*
SQLyog Ultimate v8.71 
MySQL - 5.5.41 : Database - koo999d8_kookoo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`koo999d8_kookoo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `koo999d8_kookoo`;

/*Table structure for table `sl_tracker` */

DROP TABLE IF EXISTS `sl_tracker`;

CREATE TABLE `sl_tracker` (
  `TrackID` bigint(20) NOT NULL,
  `UserID` bigint(20) DEFAULT NULL,
  `TrackType` varchar(50) DEFAULT NULL,
  `Value` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `TrackDate` datetime DEFAULT NULL,
  PRIMARY KEY (`TrackID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
