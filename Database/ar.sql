/*
SQLyog Ultimate v8.63 
MySQL - 5.5.24-log : Database - timkm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`timkm` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `timkm`;

/*Table structure for table `sl_article` */

DROP TABLE IF EXISTS `sl_article`;

CREATE TABLE `sl_article` (
  `ArticleID` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ma so Article',
  `Prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Prefix cua article',
  `Title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'TIeu de',
  `FileName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Duong dan file chua noi dung',
  `ArticleType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Loai article',
  `Content` text COLLATE utf8_unicode_ci COMMENT 'noi dung article (option)',
  `NotificationType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'loai notification co can send mail khi co comment hay ko',
  `Tags` text COLLATE utf8_unicode_ci COMMENT 'noi dung cua cac tag',
  `CatalogueID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'loai san pham',
  `SectionID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'nhom mat hang',
  `NumView` bigint(20) DEFAULT NULL COMMENT 'so luot xem',
  `NumComment` bigint(20) DEFAULT NULL COMMENT 'so luot commnent',
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci COMMENT 'cac comment_ids',
  `RenewedDate` datetime DEFAULT NULL COMMENT 'Ngay tro lai dau trang',
  `RenewedNum` int(11) DEFAULT NULL COMMENT 'So luot da renew',
  `CompanyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CompanyAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CopmanyWebsite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CompanyPhone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AdType` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Loai Khuyen Mai',
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `HappyDays` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StartHappyHour` time DEFAULT NULL,
  `EndHappyHour` time DEFAULT NULL,
  `Addresses` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Dictricts` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cities` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ArticleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sl_article` */

insert  into `sl_article`(`ArticleID`,`Prefix`,`Title`,`FileName`,`ArticleType`,`Content`,`NotificationType`,`Tags`,`CatalogueID`,`SectionID`,`NumView`,`NumComment`,`CreatedBy`,`CreatedDate`,`ModifiedBy`,`ModifiedDate`,`DeletedBy`,`DeletedDate`,`IsDeleted`,`Status`,`comments`,`RenewedDate`,`RenewedNum`,`CompanyName`,`CompanyAddress`,`CopmanyWebsite`,`CompanyPhone`,`AdType`,`StartDate`,`EndDate`,`HappyDays`,`StartHappyHour`,`EndHappyHour`,`Addresses`,`Dictricts`,`Cities`) values ('50','1','1','1','1','1','1','1','1','1',1,1,'1','0000-00-00 00:00:00','1','0000-00-00 00:00:00','1','0000-00-00 00:00:00','\0','','','0000-00-00 00:00:00',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
