/*
SQLyog Ultimate v8.71 
MySQL - 5.6.17 : Database - timkm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `sl_ad_type` */

DROP TABLE IF EXISTS `sl_ad_type`;

CREATE TABLE `sl_ad_type` (
  `AdTypeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `AdTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Width` int(11) DEFAULT NULL,
  `Height` int(11) DEFAULT NULL,
  `NumOfDay` int(11) DEFAULT NULL,
  `DisplayPage` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SharedItem` int(11) DEFAULT NULL COMMENT 'so luong quang cao shared tren 1 panel',
  `Price` decimal(10,0) DEFAULT NULL,
  `CityID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AdTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_advertising` */

DROP TABLE IF EXISTS `sl_advertising`;

CREATE TABLE `sl_advertising` (
  `AdvertisingID` bigint(20) NOT NULL AUTO_INCREMENT,
  `AdvertisingName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PartnerID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Temporaty not use table partner',
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `AdTypeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'From sl_ad_type',
  `ArticleTypeID` int(11) DEFAULT NULL COMMENT 'Parent Article ID',
  `Content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PreferLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Order` int(11) DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` int(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AdvertisingID`)
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_article` */

DROP TABLE IF EXISTS `sl_article`;

CREATE TABLE `sl_article` (
  `ArticleID` bigint(11) NOT NULL AUTO_INCREMENT COMMENT 'Ma so Article',
  `Prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Prefix cua article',
  `Title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'TIeu de',
  `FileName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Duong dan file chua noi dung',
  `Content` text COLLATE utf8_unicode_ci COMMENT 'noi dung article (option)',
  `NotificationType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'loai notification co can send mail khi co comment hay ko',
  `Tags` text COLLATE utf8_unicode_ci COMMENT 'noi dung cua cac tag',
  `NumView` bigint(20) DEFAULT NULL COMMENT 'so luot xem',
  `NumComment` bigint(20) DEFAULT NULL COMMENT 'so luot commnent',
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0: cho kiem duyet, 1: Da kiem duyet,2: Luu nhap',
  `Comments` text COLLATE utf8_unicode_ci COMMENT 'cac comment_ids',
  `RenewedDate` datetime DEFAULT NULL COMMENT 'Ngay tro lai dau trang',
  `RenewedNum` int(11) DEFAULT NULL COMMENT 'So luot da renew',
  `CompanyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CompanyAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CompanyWebsite` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CompanyPhone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_article_type` */

DROP TABLE IF EXISTS `sl_article_type`;

CREATE TABLE `sl_article_type` (
  `ArticleTypeID` int(20) NOT NULL AUTO_INCREMENT,
  `ArticleTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Level` int(11) DEFAULT NULL COMMENT '1: Cap cao nhat (section) 2: Cap category 3: Cap theo dac tinh',
  `ParentID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Thumbnail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'show in index page',
  `Logo` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'show in menu',
  PRIMARY KEY (`ArticleTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_article_type_id` */

DROP TABLE IF EXISTS `sl_article_type_id`;

CREATE TABLE `sl_article_type_id` (
  `ArticleTypeID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  PRIMARY KEY (`ArticleTypeID`,`ArticleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_auction` */

DROP TABLE IF EXISTS `sl_auction`;

CREATE TABLE `sl_auction` (
  `AuctionID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ProductID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `StartingPrice` decimal(20,2) DEFAULT NULL,
  `NumOffer` bigint(20) DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`AuctionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_city` */

DROP TABLE IF EXISTS `sl_city`;

CREATE TABLE `sl_city` (
  `CityID` int(20) NOT NULL AUTO_INCREMENT,
  `CityName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` tinyint(20) DEFAULT NULL,
  `Order` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`CityID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_comment` */

DROP TABLE IF EXISTS `sl_comment`;

CREATE TABLE `sl_comment` (
  `CommentID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CommentType` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ArticleID` bigint(20) DEFAULT NULL,
  `Content` text COLLATE utf8_unicode_ci,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` tinyint(20) DEFAULT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_comment_bad` */

DROP TABLE IF EXISTS `sl_comment_bad`;

CREATE TABLE `sl_comment_bad` (
  `CommentID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci,
  `ReportedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ReportedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_content_summary` */

DROP TABLE IF EXISTS `sl_content_summary`;

CREATE TABLE `sl_content_summary` (
  `ContentID` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'articleID, commentID,....',
  `SubContents` longtext COLLATE utf8_unicode_ci COMMENT 'commentID',
  `PeriodTime` varchar(6) COLLATE utf8_unicode_ci NOT NULL COMMENT '201310,201312',
  `Type` tinyint(4) DEFAULT NULL COMMENT '1: Category, 2: Article',
  PRIMARY KEY (`ContentID`,`PeriodTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_currency` */

DROP TABLE IF EXISTS `sl_currency`;

CREATE TABLE `sl_currency` (
  `CurrencyID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `CurrencyName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EuroRate` decimal(20,2) DEFAULT NULL,
  `USDRate` decimal(20,2) DEFAULT NULL,
  `AUDRate` decimal(20,2) DEFAULT NULL,
  `NDTRate` decimal(20,2) DEFAULT NULL,
  `CADRate` decimal(20,2) DEFAULT NULL,
  `GBPRate` decimal(20,2) DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`CurrencyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_datatype` */

DROP TABLE IF EXISTS `sl_datatype`;

CREATE TABLE `sl_datatype` (
  `DataTypeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DataTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`DataTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_district` */

DROP TABLE IF EXISTS `sl_district`;

CREATE TABLE `sl_district` (
  `DistricID` int(20) NOT NULL AUTO_INCREMENT,
  `DistrictName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CityID` int(20) DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` tinyint(20) DEFAULT NULL,
  `Order` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`DistricID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_evaluation` */

DROP TABLE IF EXISTS `sl_evaluation`;

CREATE TABLE `sl_evaluation` (
  `ArticleID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EvaluationID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NumEvaluation` bigint(20) DEFAULT NULL COMMENT 'so luong nguoi danh gia',
  `EvaluatedBy` text COLLATE utf8_unicode_ci COMMENT 'danh sach userID ngan cach nhau',
  `LastEvaluated` datetime DEFAULT NULL COMMENT 'ngay cuoi cung danh gia',
  PRIMARY KEY (`EvaluationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_evaluation_type` */

DROP TABLE IF EXISTS `sl_evaluation_type`;

CREATE TABLE `sl_evaluation_type` (
  `EvaluationTypeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `EvaluationTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`EvaluationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_like` */

DROP TABLE IF EXISTS `sl_like`;

CREATE TABLE `sl_like` (
  `LikeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `LikeAmount` int(11) DEFAULT NULL,
  `UnlikeAmount` int(11) DEFAULT NULL COMMENT 'option',
  `LIkeUsers` text COLLATE utf8_unicode_ci COMMENT 'danh sach UserID Like,..',
  `UnlikeUsers` text COLLATE utf8_unicode_ci COMMENT 'danh sach user unlinke',
  PRIMARY KEY (`LikeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_manufactory` */

DROP TABLE IF EXISTS `sl_manufactory`;

CREATE TABLE `sl_manufactory` (
  `ManufactoryID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ManufactoryName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ManufactoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_menu` */

DROP TABLE IF EXISTS `sl_menu`;

CREATE TABLE `sl_menu` (
  `MenuID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MenuName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumOrder` int(11) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  `ParentID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MenuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_notification_type` */

DROP TABLE IF EXISTS `sl_notification_type`;

CREATE TABLE `sl_notification_type` (
  `NotificationTypeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NotificationTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`NotificationTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='send mail when having new reply, like article';

/*Table structure for table `sl_numberaire` */

DROP TABLE IF EXISTS `sl_numberaire`;

CREATE TABLE `sl_numberaire` (
  `NumberaireID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NumberaireName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`NumberaireID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_offer` */

DROP TABLE IF EXISTS `sl_offer`;

CREATE TABLE `sl_offer` (
  `AuctionID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `UserID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `OfferedDate` datetime DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDelete` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`AuctionID`,`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_partner` */

DROP TABLE IF EXISTS `sl_partner`;

CREATE TABLE `sl_partner` (
  `PartnerID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PartnerName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressName1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressName2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressName3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressName4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddressName5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailName1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailName2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailName3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailName4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailName5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneName1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneName2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneName3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneName4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone5` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneName5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxName1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxName2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxName3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxName4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fax5` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxName5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WebsiteName1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WebsiteName2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WebsiteName3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WebsiteName4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Website5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WebsiteName5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TaxNumber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AccountNumber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`PartnerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_payment_mode` */

DROP TABLE IF EXISTS `sl_payment_mode`;

CREATE TABLE `sl_payment_mode` (
  `PaymentModeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PaymentModeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`PaymentModeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_product` */

DROP TABLE IF EXISTS `sl_product`;

CREATE TABLE `sl_product` (
  `ProductID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ProductName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CatalogueID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ManufactoryID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PaymentModeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NumberaireID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StorageDate` datetime DEFAULT NULL,
  `Price` decimal(20,2) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_property` */

DROP TABLE IF EXISTS `sl_property`;

CREATE TABLE `sl_property` (
  `PropertyID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `PropertyName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ProductID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PropertyValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataTypeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PropertyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_request` */

DROP TABLE IF EXISTS `sl_request`;

CREATE TABLE `sl_request` (
  `RequesID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ContentRequest` text COLLATE utf8_unicode_ci,
  `RequestedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RequestedDate` datetime DEFAULT NULL,
  `ContentRespone` text COLLATE utf8_unicode_ci,
  `ResponedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ResponedDate` datetime DEFAULT NULL,
  `IsApproved` bit(1) DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`RequesID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_reset_password` */

DROP TABLE IF EXISTS `sl_reset_password`;

CREATE TABLE `sl_reset_password` (
  `ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ExpireDate` datetime DEFAULT NULL,
  `ResetDate` datetime DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_role` */

DROP TABLE IF EXISTS `sl_role`;

CREATE TABLE `sl_role` (
  `RoleID` int(20) NOT NULL,
  `RoleName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` tinyint(20) DEFAULT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_setting` */

DROP TABLE IF EXISTS `sl_setting`;

CREATE TABLE `sl_setting` (
  `SettingID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `SettingName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SettingValue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SettingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_ship_type` */

DROP TABLE IF EXISTS `sl_ship_type`;

CREATE TABLE `sl_ship_type` (
  `ShipTypeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ShipTypeName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ShipTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_status` */

DROP TABLE IF EXISTS `sl_status`;

CREATE TABLE `sl_status` (
  `StatusID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `StatusName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_store` */

DROP TABLE IF EXISTS `sl_store`;

CREATE TABLE `sl_store` (
  `StoreID` int(11) DEFAULT NULL,
  `Name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DistictID` int(11) DEFAULT NULL,
  `CityID` int(11) DEFAULT NULL,
  `Phone` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SpecialDesc` text COLLATE utf8_unicode_ci,
  `Latitude` decimal(10,0) DEFAULT NULL,
  `Longitude` decimal(10,0) DEFAULT NULL,
  `WorkingDay` text COLLATE utf8_unicode_ci,
  `MainCategoryId` int(11) DEFAULT NULL,
  `StoreIcon` text COLLATE utf8_unicode_ci,
  `StoreImage` text COLLATE utf8_unicode_ci,
  `Status` int(11) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdatedBy` int(11) DEFAULT NULL,
  `UpdatedDate` datetime DEFAULT NULL,
  `DeletedBy` int(11) DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_storecategory` */

DROP TABLE IF EXISTS `sl_storecategory`;

CREATE TABLE `sl_storecategory` (
  `StoreID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`StoreID`,`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_user` */

DROP TABLE IF EXISTS `sl_user`;

CREATE TABLE `sl_user` (
  `UserID` int(20) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FullName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sex` tinyint(1) DEFAULT NULL,
  `Identity` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'CMND',
  `RoleID` int(20) DEFAULT NULL,
  `UserRankID` int(20) DEFAULT NULL COMMENT 'User type',
  `Avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AccountID` int(255) DEFAULT NULL COMMENT 'Bank account',
  `IsActived` bit(1) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Index_UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sl_user_rank` */

DROP TABLE IF EXISTS `sl_user_rank`;

CREATE TABLE `sl_user_rank` (
  `UserRankID` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'cap bac user: VIP,Premium, Normal',
  `UserRankName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `DeletedBy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DeletedDate` datetime DEFAULT NULL,
  `IsDeleted` bit(1) DEFAULT NULL,
  `Status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserRankID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
