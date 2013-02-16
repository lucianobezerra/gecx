SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `birth` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(60) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_description` (`description`)
);

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cities_1` (`state_id`)
);

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `isbn` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `existing_copies` int(11) NOT NULL DEFAULT '0',
  `available_copies` int(11) NOT NULL DEFAULT '0',
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_author` (`author_id`),
  KEY `fk_category` (`category_id`),
  KEY `fk_type` (`type_id`),
  KEY `fk_publisher` (`publisher_id`)
);


DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `reader_id` int(11) NOT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prevision` date NOT NULL,
  `devolution` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item` (`item_id`),
  KEY `fk_reader` (`reader_id`)
);

DROP TRIGGER IF EXISTS `baixa_qtde_copia_item`;
DELIMITER //
CREATE TRIGGER `baixa_qtde_copia_item` AFTER INSERT ON `loans`
 FOR EACH ROW BEGIN
    UPDATE items SET items.available_copies = items.available_copies - 1 WHERE items.id = NEW.item_id;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `devolve_item`;
DELIMITER //
CREATE TRIGGER `devolve_item` AFTER UPDATE ON `loans`
 FOR EACH ROW BEGIN
       update items set items.available_copies = (items.available_copies +1) where items.id = OLD.item_id;
    END
//
DELIMITER ;

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `neighborhood` varchar(50) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_publishers_1` (`city_id`),
  KEY `fk_publishers_2` (`state_id`)
);

DROP TABLE IF EXISTS `readers`;
CREATE TABLE IF NOT EXISTS `readers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone1` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `birth` date NOT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_readers_1` (`city_id`),
  KEY `fk_readers_2` (`state_id`)
);

DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` varchar(2) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(40) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_description` (`description`)
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(60) NOT NULL,
  `entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`)
) ;

ALTER TABLE `cities`
  ADD CONSTRAINT `fk_cities_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `items`
  ADD CONSTRAINT `fk_author` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`),
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

ALTER TABLE `loans`
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `fk_reader` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`);

ALTER TABLE `publishers`
  ADD CONSTRAINT `fk_publishers_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publishers_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `readers`
  ADD CONSTRAINT `fk_readers_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_readers_2` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;