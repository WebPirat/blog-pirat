/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `blog_cat`;
CREATE TABLE `blog_cat` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `deleted` int DEFAULT '1',
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_At` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `blog_entrys`;
CREATE TABLE `blog_entrys` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `teaser` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `online` int DEFAULT '0',
  `site_alias` text,
  `deleted` int DEFAULT '0',
  `version` int DEFAULT '1',
  `author` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lastAuthor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_At` datetime DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `blog_entrys_backup`;
CREATE TABLE `blog_entrys_backup` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oldID` bigint unsigned NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `teaser` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `content` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `online` int DEFAULT '0',
  `site_alias` text,
  `deleted` int DEFAULT '0',
  `version` int DEFAULT '1',
  `author` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lastAuthor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_At` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cat` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `id` (`ID`),
  KEY `group` (`cat`),
  CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`cat`) REFERENCES `settings` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `settings_cat`;
CREATE TABLE `settings_cat` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topID` int DEFAULT '0',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `online` int DEFAULT '0',
  `site_alias` text,
  `deleted` int DEFAULT '0',
  `version` int DEFAULT '1',
  `author` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lastAuthor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sort_order` int DEFAULT '0',
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_At` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `sites_backup`;
CREATE TABLE `sites_backup` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oldID` bigint unsigned DEFAULT NULL,
  `topID` int DEFAULT '0',
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `online` int DEFAULT '0',
  `site_alias` text,
  `deleted` int DEFAULT '0',
  `version` int DEFAULT '1',
  `author` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sort_order` int NOT NULL,
  `lastAuthor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_At` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`),
  KEY `oldID` (`oldID`),
  CONSTRAINT `sites_backup_ibfk_1` FOREIGN KEY (`oldID`) REFERENCES `sites` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `sites_meta`;
CREATE TABLE `sites_meta` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sitesID` bigint unsigned DEFAULT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `keywords` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `version` int DEFAULT '1',
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`),
  KEY `sitesID` (`sitesID`),
  CONSTRAINT `sites_meta_ibfk_1` FOREIGN KEY (`sitesID`) REFERENCES `sites` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `sites_meta_backup`;
CREATE TABLE `sites_meta_backup` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `oldID` bigint unsigned DEFAULT NULL,
  `sitesID` bigint unsigned DEFAULT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `keywords` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `version` int DEFAULT '1',
  `created_At` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_At` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `id` (`ID`),
  KEY `sitesID` (`sitesID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;







INSERT INTO `settings` (`ID`, `name`, `content`, `cat`) VALUES
(1, 'title', 'Blog Pirat', 1);


INSERT INTO `settings_cat` (`ID`, `name`) VALUES
(1, 'meta');











/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;