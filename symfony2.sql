/* SQL Manager Lite for MySQL                              5.6.3.48526 */
/* ------------------------------------------------------------------- */
/* Host     : localhost                                                */
/* Port     : 3306                                                     */
/* Database : symfony2                                                 */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `symfony2`;

CREATE DATABASE `symfony2`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `symfony2`;

SET sql_mode = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';

/* Удаление объектов БД */

DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `categorycomments`;
DROP TABLE IF EXISTS `blog`;
DROP TABLE IF EXISTS `category`;

/* Структура для таблицы `category`:  */

CREATE TABLE `category` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

/* Структура для таблицы `blog`:  */

CREATE TABLE `blog` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `category_id` INTEGER(11) DEFAULT NULL,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `IDX_C015514312469DE2` USING BTREE (`category_id`),
  CONSTRAINT `FK_C015514312469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

/* Структура для таблицы `categorycomments`:  */

CREATE TABLE `categorycomments` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `category_id` INTEGER(11) DEFAULT NULL,
  `author` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `IDX_EC0E372912469DE2` USING BTREE (`category_id`),
  CONSTRAINT `FK_EC0E372912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

/* Структура для таблицы `comments`:  */

CREATE TABLE `comments` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `blog_id` INTEGER(11) DEFAULT NULL,
  `author` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY USING BTREE (`id`),
  KEY `IDX_5F9E962ADAE07E97` USING BTREE (`blog_id`),
  CONSTRAINT `FK_5F9E962ADAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

/* Data for the `category` table  (LIMIT 0,500) */

INSERT INTO `category` (`id`, `name`, `description`) VALUES
  (1,'Category1','My first Category\r\nMy first Category\r\n'),
  (2,'Category2','Me second Category');
COMMIT;

/* Data for the `blog` table  (LIMIT 0,500) */

INSERT INTO `blog` (`id`, `category_id`, `name`, `content`) VALUES
  (1,1,'sdcs','dcsdc');
COMMIT;

/* Data for the `categorycomments` table  (LIMIT 0,500) */

INSERT INTO `categorycomments` (`id`, `category_id`, `author`, `content`, `create_at`) VALUES
  (1,1,'AAA','bbb','2017-07-23 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;