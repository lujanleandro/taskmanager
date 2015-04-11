-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.16 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para tasks_db
CREATE DATABASE IF NOT EXISTS `tasks_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tasks_db`;


-- Volcando estructura para tabla tasks_db.fit_admin
CREATE TABLE IF NOT EXISTS `fit_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `uniq_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_category
CREATE TABLE IF NOT EXISTS `fit_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL DEFAULT '',
  `category_description` varchar(255) DEFAULT NULL,
  `estado_id` int(11) NOT NULL DEFAULT '1',
  `category_order` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_ciudad
CREATE TABLE IF NOT EXISTS `fit_ciudad` (
  `ciudad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad_name` varchar(100) NOT NULL,
  `partido_id` int(11) NOT NULL,
  PRIMARY KEY (`ciudad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_estado
CREATE TABLE IF NOT EXISTS `fit_estado` (
  `estado_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `estado_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`estado_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_files
CREATE TABLE IF NOT EXISTS `fit_files` (
  `file_id` int(10) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `file_type` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_image
CREATE TABLE IF NOT EXISTS `fit_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `thumb_id` int(11) NOT NULL,
  `image_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_partido
CREATE TABLE IF NOT EXISTS `fit_partido` (
  `partido_id` int(11) NOT NULL AUTO_INCREMENT,
  `partido_name` varchar(100) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`partido_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_product
CREATE TABLE IF NOT EXISTS `fit_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `product_description` text,
  `product_order` int(11) DEFAULT NULL,
  `product_document` varchar(255) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `productparent_id` int(11) NOT NULL DEFAULT '0',
  `product_date` date NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_provincia
CREATE TABLE IF NOT EXISTS `fit_provincia` (
  `provincia_id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_name` varchar(100) NOT NULL,
  PRIMARY KEY (`provincia_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_realestate
CREATE TABLE IF NOT EXISTS `fit_realestate` (
  `realestate_id` int(11) NOT NULL AUTO_INCREMENT,
  `realestate_name` varchar(200) DEFAULT NULL,
  `realestate_description` text NOT NULL,
  `realestate_price` decimal(11,0) NOT NULL DEFAULT '0',
  `realestate_dolar` varchar(11) DEFAULT NULL,
  `realestate_street_real` varchar(200) DEFAULT NULL,
  `realestate_street_aprox` varchar(200) DEFAULT NULL,
  `realestate_ambientes` int(1) DEFAULT NULL,
  `realestate_dormitorios` int(1) DEFAULT NULL,
  `realestate_banos` int(1) DEFAULT NULL,
  `realestate_fondo` tinyint(1) DEFAULT NULL,
  `realestate_superficie` int(3) DEFAULT NULL,
  `realestate_orientacion` varchar(100) DEFAULT NULL,
  `realestate_plantas` int(11) DEFAULT NULL,
  `realestate_galpon` varchar(555) NOT NULL,
  `realestate_antiguedad` int(11) DEFAULT NULL,
  `realestate_cochera` varchar(100) DEFAULT NULL,
  `realestate_video` varchar(256) DEFAULT NULL,
  `realestate_code` varchar(50) NOT NULL,
  `realestate_order` int(11) NOT NULL,
  `realestate_adddate` date NOT NULL,
  `realestate_moddate` date NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `partido_id` int(11) NOT NULL,
  `transaction_id` varchar(11) NOT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`realestate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_tag
CREATE TABLE IF NOT EXISTS `fit_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(256) NOT NULL,
  `tag_description` varchar(256) DEFAULT NULL,
  `tag_estado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_tag_relation
CREATE TABLE IF NOT EXISTS `fit_tag_relation` (
  `tag_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_transaction
CREATE TABLE IF NOT EXISTS `fit_transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_name` varchar(100) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla tasks_db.fit_user
CREATE TABLE IF NOT EXISTS `fit_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(256) DEFAULT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  `user_newsletter` int(11) DEFAULT NULL,
  `estado_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `user_moddate` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
