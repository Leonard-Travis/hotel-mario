-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2010 at 06:07 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hoteles.com.ve`
--

-- --------------------------------------------------------

--
-- Table structure for table `_admin_airlines`
--

CREATE TABLE IF NOT EXISTS `_admin_airlines` (
  `airline_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_airlines`
--

INSERT INTO `_admin_airlines` (`airline_id`, `name`, `code`) VALUES
(1, 'American Airline', 'A.A.'),
(2, 'Santa Barbara', 'S.B.');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_categories`
--

CREATE TABLE IF NOT EXISTS `_admin_categories` (
  `categorie_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_spanish` varchar(50) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `_admin_categories`
--

INSERT INTO `_admin_categories` (`categorie_id`, `name_spanish`) VALUES
(1, 'Margarita'),
(2, 'Playita'),
(3, 'Colonia Tovar'),
(4, 'Navideño'),
(5, 'arenita'),
(6, 'Luna de Miel'),
(7, 'Luna de Miel'),
(8, 'Crucero Panam'),
(9, 'Crucero Miami'),
(10, 'Playa Navideña'),
(11, 'Playero navideño'),
(12, 'Cruceros Caribe');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_categories_package`
--

CREATE TABLE IF NOT EXISTS `_admin_categories_package` (
  `CATEGORIE_id` int(10) unsigned NOT NULL,
  `PACKAGE_id` int(10) unsigned NOT NULL,
  KEY `FK_categorie_packages_pack` (`PACKAGE_id`),
  KEY `FK_categorie_packages_cat` (`CATEGORIE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_categories_package`
--

INSERT INTO `_admin_categories_package` (`CATEGORIE_id`, `PACKAGE_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(4, 3),
(1, 4),
(2, 4),
(1, 5),
(2, 5),
(4, 5),
(3, 6),
(4, 6),
(1, 8),
(2, 8),
(5, 8),
(1, 9),
(6, 9),
(1, 10),
(7, 10),
(8, 10),
(9, 10),
(1, 11),
(10, 12),
(1, 12),
(11, 12),
(1, 12),
(8, 13),
(12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_customers`
--

CREATE TABLE IF NOT EXISTS `_admin_customers` (
  `customer_ci_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `phone` int(10) unsigned NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `sex` enum('m','f') NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`customer_ci_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=898989899 ;

--
-- Dumping data for table `_admin_customers`
--

INSERT INTO `_admin_customers` (`customer_ci_id`, `name`, `lastname`, `phone`, `email`, `address`, `sex`, `birth_date`) VALUES
(22, 'Ana', 'arargar', 111, 'ggggg', 'gg', 'm', '2010-02-27'),
(555, 'tt', 'tt', 0, 'themonkey_89@hotmail.com', 'tt', 'm', '2010-06-26'),
(1987, 'oo', 'oo', 0, 'o@l.com', 'oo', 'm', '2010-06-27'),
(123456, 'lol', 'olol', 0, 'olo@l.com', 'lolo', 'm', '2010-06-27'),
(188888, 'Alito', 'Pacheco', 77777, 'mariomunera89@gmail.com', 'bubiubiuhbouhb', 'm', '2010-01-01'),
(18277056, 'Mario', 'Munera', 111, 'mario@gmail.com', '1', 'm', '1989-06-16'),
(898989898, 'jkjkjk', 'kjkjkjkj', 0, 'jkjkjkjkj', 'kjkjk', 'm', '2010-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_employees`
--

CREATE TABLE IF NOT EXISTS `_admin_employees` (
  `employees_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `nick_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` enum('manager','seller') NOT NULL,
  `status` varchar(9) NOT NULL,
  `password` int(6) NOT NULL,
  PRIMARY KEY (`employees_id`),
  UNIQUE KEY `nick_name` (`nick_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_employees`
--

INSERT INTO `_admin_employees` (`employees_id`, `name`, `lastname`, `nick_name`, `email`, `type`, `status`, `password`) VALUES
(1, 'todo', 'elmundo', 'todo.elmundo', 'todo@gmail.com', 'seller', 'active', 7896),
(22, 'mmm', 'mmm', 'todo.elmundo2', 'mmm', 'seller', 'active', 111111),
(89, 'nnnnn', 'nnnnnn', 'mmmmm', 'mmmm', 'seller', 'inactive', 0),
(1234, 'Mario', 'Munera', 'mario.munera', 'mario@gmail.com', 'seller', 'active', 9876),
(5678, 'juan', 'varon', 'juan.varon', 'juan@gmail.com', 'manager', 'active', 1234),
(7777, 'alex', 'pietro', 'alex.pietro', 'alex@gmail.com', 'seller', 'inactive', 1598),
(77777, 'jjjjj', 'jjjjjj', 'jjjj', 'jjjj', 'seller', 'inactive', 0),
(121111, 'pppp', 'pppp', 'ppp', 'ppppp', 'seller', 'inactive', 0),
(18277056, 'Mario', 'Munera', 'mario.munera.2', 'mario2@gmail.com', 'seller', 'active', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights`
--

CREATE TABLE IF NOT EXISTS `_admin_flights` (
  `flight_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AIRLINES_id` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `class` enum('first class','turist','economic') NOT NULL,
  `price_per_adult` float NOT NULL,
  `price_per_kid` float NOT NULL,
  `origin` int(10) unsigned NOT NULL,
  `destination` int(10) unsigned NOT NULL,
  `go_time` varchar(45) NOT NULL,
  `go_date` date NOT NULL,
  `type` enum('national','international') NOT NULL,
  `round_trip` int(2) NOT NULL,
  `back_time` varchar(45) DEFAULT NULL,
  `back_date` date DEFAULT NULL,
  PRIMARY KEY (`flight_id`),
  KEY `fk__ADMIN_FLIGHTS_has_ADMIN_AIRLINES` (`AIRLINES_id`),
  KEY `origin_flight_city` (`origin`),
  KEY `destination_flight_city` (`destination`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `_admin_flights`
--

INSERT INTO `_admin_flights` (`flight_id`, `AIRLINES_id`, `number`, `class`, `price_per_adult`, `price_per_kid`, `origin`, `destination`, `go_time`, `go_date`, `type`, `round_trip`, `back_time`, `back_date`) VALUES
(80, 1, 123, 'first class', 1.1, 1, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(81, 1, 123, 'first class', 1.1, 1, 2, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(82, 2, 987, 'economic', 1.9, 0, 1, 4, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(83, 2, 987, 'economic', 1.9, 0, 4, 1, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(84, 1, 656, 'economic', 1.2, 0, 1, 3, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(85, 1, 656, 'economic', 1.2, 0, 3, 1, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(86, 2, 657, 'turist', 2.1, 1.1, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(87, 1, 654, 'first class', 1.9, 0, 1, 4, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(88, 1, 654, 'first class', 1.9, 0, 4, 1, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(89, 1, 11, 'first class', 1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(90, 1, 11, 'first class', 1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(91, 1, 6767, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(92, 1, 908, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(93, 1, 908, 'first class', 1.1, 0, 1, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(94, 1, 6959, 'turist', 1.1, 0, 1, 3, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(95, 1, 6959, 'turist', 1.1, 0, 3, 1, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(96, 1, 7867, 'first class', 1.2, 0, 1, 4, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(97, 1, 5678, 'first class', 1.2, 0, 4, 3, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(98, 1, 5678, 'first class', 1.2, 0, 3, 4, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(99, 1, 8998, 'first class', 1.1, 0, 4, 1, 'hh:mm', '0000-00-00', 'international', 0, '', '0000-00-00'),
(100, 1, 1234, 'first class', 156, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(101, 1, 1234, 'first class', 156, 0, 2, 1, 'hh:mm', '0000-00-00', 'national', 0, '', '0000-00-00'),
(102, 1, 123, 'first class', 123, 0, 1, 2, '21:00', '2010-01-02', 'national', 1, '', '0000-00-00'),
(103, 1, 123, 'first class', 1321, 0, 1, 2, '20:00', '2010-01-02', 'national', 1, '', '0000-00-00'),
(104, 1, 167, 'first class', 145, 0, 1, 2, '20:00', '2010-01-02', 'national', 1, '', '0000-00-00'),
(105, 1, 123, 'first class', 12, 0, 1, 2, '22:00', '2010-01-01', 'national', 1, '20:00', '2010-01-02'),
(106, 1, 123, 'first class', 12, 0, 1, 2, '22:00', '2010-01-01', 'national', 1, '20:00', '2010-01-02'),
(107, 1, 567, 'first class', 23, 0, 1, 3, '34:00', '2010-01-01', 'international', 0, 'NULL', '0000-00-00'),
(108, 1, 678, 'first class', 34, 0, 1, 4, '24:00', '2010-01-09', 'international', 1, '01:00', '2010-01-20'),
(109, 1, 123, 'first class', 12, 0, 1, 2, '22:00', '2010-01-01', 'national', 1, '23:00', '2010-01-02'),
(110, 1, 234, 'first class', 34, 0, 1, 3, '04:00', '2010-01-01', 'international', 0, 'NULL', '0000-00-00'),
(111, 1, 123, 'first class', 21, 0, 1, 2, '22:00', '2010-01-01', 'national', 1, '21:00', '2010-01-02'),
(112, 1, 1234, 'first class', 123.67, 0, 1, 2, '11:00', '2010-01-01', 'national', 1, '12:00', '2010-01-05'),
(113, 1, 123, 'first class', 123, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(114, 1, 123, 'first class', 123, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(115, 1, 123, 'first class', 123.45, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(116, 1, 123, 'first class', 234.568, 0, 1, 2, '11:00', '2010-01-01', 'national', 1, 'hh:mm', '2010-11-01'),
(117, 1, 123, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, 'NULL', '0000-00-00'),
(118, 1, 123, 'first class', 13, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(119, 1, 12, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, 'NULL', '0000-00-00'),
(120, 1, 12, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(121, 1, 123, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, 'NULL', '0000-00-00'),
(122, 1, 123, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(123, 1, 123, 'first class', 12, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(124, 1, 123, 'first class', 13, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(125, 1, 123, 'first class', 123, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 0, 'NULL', '0000-00-00'),
(126, 1, 123, 'first class', 123, 0, 1, 2, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00'),
(127, 1, 432, 'first class', 32.54, 0, 2, 1, 'hh:mm', '0000-00-00', 'national', 1, 'hh:mm', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_city`
--

CREATE TABLE IF NOT EXISTS `_admin_flights_city` (
  `flight_city_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FLIGHTS_COUNTRY_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_city_id`),
  KEY `FLIGHTS_CITY_FKIndex1` (`FLIGHTS_COUNTRY_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `_admin_flights_city`
--

INSERT INTO `_admin_flights_city` (`flight_city_id`, `FLIGHTS_COUNTRY_id`, `name`) VALUES
(1, 1, 'CCS'),
(2, 1, 'MAR'),
(3, 2, 'BOG'),
(4, 2, 'MDE');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_country`
--

CREATE TABLE IF NOT EXISTS `_admin_flights_country` (
  `flight_country_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`flight_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `_admin_flights_country`
--

INSERT INTO `_admin_flights_country` (`flight_country_id`, `name`) VALUES
(1, 'venezuela'),
(2, 'colombia');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_flights_per_quote`
--

CREATE TABLE IF NOT EXISTS `_admin_flights_per_quote` (
  `QUOTATIONS_FLIGHTS_id` int(10) unsigned NOT NULL,
  `FLIGHTS_id` int(10) unsigned NOT NULL,
  KEY `FK_quotations_in_FPQ` (`QUOTATIONS_FLIGHTS_id`),
  KEY `FK_flights_in_FPQ` (`FLIGHTS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_flights_per_quote`
--

INSERT INTO `_admin_flights_per_quote` (`QUOTATIONS_FLIGHTS_id`, `FLIGHTS_id`) VALUES
(22, 80),
(22, 81),
(22, 82),
(22, 83),
(23, 84),
(23, 85),
(23, 86),
(23, 87),
(23, 88),
(24, 92),
(24, 93),
(25, 94),
(25, 95),
(25, 96),
(25, 97),
(25, 98),
(25, 99),
(26, 100),
(26, 101),
(27, 102),
(28, 103),
(29, 104),
(30, 105),
(31, 106),
(31, 107),
(31, 108),
(32, 109),
(32, 110),
(33, 111),
(34, 112),
(35, 113),
(36, 114),
(37, 115),
(38, 116),
(39, 117),
(39, 118),
(39, 119),
(39, 120),
(40, 121),
(41, 122),
(42, 123),
(43, 124),
(44, 125),
(45, 126),
(46, 127);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_generic`
--

CREATE TABLE IF NOT EXISTS `_admin_generic` (
  `generic_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  PRIMARY KEY (`generic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `_admin_generic`
--

INSERT INTO `_admin_generic` (`generic_id`, `description`, `quantity`, `unit_price`) VALUES
(1, 'cama adicional', 1, 125.65),
(2, 'toallas', 4, 35.657),
(3, 'masaje', 1, 750),
(4, 'mamisa', 2, 122),
(5, 'botella d vino', 1, 234),
(6, 'toallas', 1, 30),
(7, 'gen1', 1, 12.3),
(8, 'gen2', 3, 12.56),
(9, 'gen1', 1, 12.3),
(10, 'gen2', 3, 12.56),
(11, 'gen1', 1, 12.3),
(12, 'gen2', 3, 12.56),
(13, 'gen1', 1, 12.3),
(14, 'gen2', 3, 12.56),
(15, 'gen1', 1, 12.34),
(16, 'gen2', 2, 13.45),
(17, 'gen1', 1, 12.34),
(18, 'gen2', 2, 13.45),
(19, 'gen1', 1, 12.34),
(20, 'gen2', 2, 13.45),
(21, 'gen1', 1, 23.2),
(22, 'gen2', 2, 32.4),
(23, 'gen3', 2, 12.2),
(24, 'gen1', 1, 12.12),
(25, 'gen1', 1, 12.1),
(26, 'gen1', 2, 123.1),
(27, 'gen1', 2, 12.3),
(28, 'mmmm', 1, 12),
(29, 'mm', 1, 12),
(30, 'mm', 2, 12),
(31, 'mm', 2, 12),
(32, 'mm', 3, 12),
(33, 'mm', 3, 14),
(34, 'mmm', 2, 32),
(35, 'mmm', 3, 14),
(36, 'mmm', 3, 13),
(37, 'kkk', 3, 33),
(38, '2', 2, 2),
(39, 'mmmmm', 2, 123.567),
(40, 'jkjkjk', 3, 456.78);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_generic_per_quote`
--

CREATE TABLE IF NOT EXISTS `_admin_generic_per_quote` (
  `QUOTES_GENERIC_id` int(11) NOT NULL,
  `GENERIC_id` int(11) NOT NULL,
  KEY `FK_generic_id` (`GENERIC_id`),
  KEY `FK_generic_quotation_id` (`QUOTES_GENERIC_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_generic_per_quote`
--

INSERT INTO `_admin_generic_per_quote` (`QUOTES_GENERIC_id`, `GENERIC_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14),
(8, 15),
(8, 16),
(9, 17),
(9, 18),
(10, 19),
(10, 20),
(11, 21),
(11, 22),
(12, 23),
(13, 24),
(14, 25),
(15, 26),
(16, 27),
(17, 28),
(18, 29),
(19, 30),
(20, 31),
(21, 32),
(22, 33),
(23, 34),
(24, 35),
(25, 36),
(26, 37),
(27, 38),
(28, 39),
(29, 40);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotels`
--

CREATE TABLE IF NOT EXISTS `_admin_hotels` (
  `hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `percent_commission` varchar(45) NOT NULL,
  `collect_type` tinyint(1) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(45) NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `_admin_hotels`
--

INSERT INTO `_admin_hotels` (`hotel_id`, `percent_commission`, `collect_type`, `name`, `location`) VALUES
(1, '10', NULL, 'Hilton', 'Caracas'),
(2, '', NULL, 'Marriot', 'Caracas'),
(5, '', NULL, 'Laguna Mar', 'Maragarita'),
(6, '', NULL, 'El Gran Balcon', 'Merida'),
(7, '', NULL, 'Hotel Dunes', 'Maracaibo');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotels_plans`
--

CREATE TABLE IF NOT EXISTS `_admin_hotels_plans` (
  `HOTELS_id` int(10) unsigned NOT NULL,
  `PLANS_id` int(10) unsigned NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`HOTELS_id`,`PLANS_id`),
  KEY `fk__ADMIN_HOTELS_has_ADMIN_PLANS_ADMIN_HOTELS` (`HOTELS_id`),
  KEY `fk__ADMIN_HOTELS_has_ADMIN_PLANS_ADMIN_PLANS` (`PLANS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_hotels_plans`
--

INSERT INTO `_admin_hotels_plans` (`HOTELS_id`, `PLANS_id`, `description`, `status`) VALUES
(1, 1, 'Incluye:\n-Fines de semana\n-desayuno\n-camotaa', 'active'),
(1, 2, 'un cuarto', 'active'),
(1, 4, 'Todo incluido ', 'active'),
(1, 5, 'todo el dia', 'inactive'),
(1, 6, '', 'inactive'),
(1, 7, '', 'inactive'),
(1, 9, '', 'inactive'),
(2, 1, 'Los fines de semana te despertamos con mazucamba', 'active'),
(2, 5, 'Un recorrido por todas las mas bellas playas de margarita!', 'inactive'),
(5, 1, 'fin de semana con alojamiento y desayuno', 'active'),
(5, 2, 'alojamiento y desayuno', 'active'),
(6, 1, 'un fin de semana del carajo', 'active'),
(6, 4, 'absolutamente de toda vaina', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_hotel_packages`
--

CREATE TABLE IF NOT EXISTS `_admin_hotel_packages` (
  `hotel_package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PACKAGE_id` int(10) unsigned NOT NULL,
  `HOTEL_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`hotel_package_id`),
  KEY `FK_hotel_packages_package` (`PACKAGE_id`),
  KEY `FK_hotel_packages_hotel` (`HOTEL_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `_admin_hotel_packages`
--

INSERT INTO `_admin_hotel_packages` (`hotel_package_id`, `PACKAGE_id`, `HOTEL_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 2, 1),
(4, 2, 2),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_packages`
--

CREATE TABLE IF NOT EXISTS `_admin_packages` (
  `package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `description` varchar(450) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `number_of_nights` int(11) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `_admin_packages`
--

INSERT INTO `_admin_packages` (`package_id`, `name`, `date_start`, `date_end`, `description`, `number_of_days`, `number_of_nights`) VALUES
(1, 'Paquete Dunas Margarita', '2010-11-15', '2010-11-20', 'Incluye:\n-Alojamiento\n-Bebidad Nacionales\n-Sillas y toldos enla playa\n-Buffets abierto 24 horas', 6, 5),
(2, 'Paquete Navideño', '2010-12-15', '2010-12-21', 'paquete navideño con cena navideña', 5, 4),
(3, 'Paquete Navidad', '2010-12-15', '2010-12-25', 'Paquete navideño con todoo', 3, 2),
(4, 'PAQUETE ESPECIAL NAVIDAD: Plan Todo Incluido Isla de Margarita ', '2010-12-15', '2010-12-20', 'Incluye:\n\nBoleto aéreo Caracas/ Porlamar/ Caracas\nTraslado Aeropuerto/ Hotel/ Aeropuerto\n05 Noches de alojamiento en el Hotel selecionado\nDesayunos\nAlmuerzos\nCenas\nSnacks\nBebidas alcohólicas y no alcohólicas nacionales ilimitadas\nDisfrute de las instalaciones\nNOTA: Incluye Cena y Fiesta de Navidad', 2, 2),
(5, 'Paquete Especial Navidad: Hesperia Playa El Agua', '2010-12-22', '2010-12-27', 'Incluye:\nBoleto aéreo Caracas/ Porlamar/ Caracas\nTraslado Aeropuerto/ Hotel/ Aeropuerto\n05 Noches de alojamiento \nDesayunos\nAlmuerzos\nCenas\nBebidas alcohólicas y no alcohólicas nacionales ilimitadas\nSnakcs\nCena Especial de Navidad\nDisfrute de todas las instalaciones', 5, 6),
(6, 'popo', '2010-01-01', '2010-01-02', 'popopo', 5, 6),
(7, 'mmm', '2010-01-01', '2010-01-02', 'mm', 3, 2),
(8, 'mm', '2010-01-01', '2010-01-02', 'mmm', 2, 2),
(9, 'Luna de Miel en Margarita', '2010-01-01', '2010-01-15', 'Incluye:\n\n02 Noches de alojamiento en el Hotel selecionado\nDesayunos\nAlmuerzos\nCenas\nSnacks\nBebidas alcohólicas y no alcohólicas nacionales ilimitadas\nDisfrute de las instalaciones', 7, 6),
(10, 'Crucero islas', '2010-12-12', '2010-12-24', 'iyhgdegwjvfkjwvkhwjvc', 5, 4),
(11, 'testprice', '2010-01-01', '2010-01-02', 'nmnmnmn', 4, 3),
(12, 'Paquete playero de navidad', '2010-12-12', '2010-12-24', 'incluye:\n-sillas\n-toallas\n-bebidas', 4, 3),
(13, 'Cruceros', '2010-11-01', '2010-11-30', 'incluye:\n-hola\n-chao\n-como estas', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_plans`
--

CREATE TABLE IF NOT EXISTS `_admin_plans` (
  `plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_english` varchar(45) NOT NULL,
  `status` varchar(10) NOT NULL,
  `name_spanish` varchar(50) NOT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `_admin_plans`
--

INSERT INTO `_admin_plans` (`plan_id`, `name_english`, `status`, `name_spanish`) VALUES
(1, 'Weekends', 'active', 'Fines de Semana'),
(2, 'Only room', 'active', 'Solo la Hab.'),
(4, 'All included', 'active', 'Todo Incluido'),
(5, 'Full day', 'inactive', 'Dia completo'),
(6, 'Room dinner and breakfast', 'active', 'Hab. c/ cena y desayuno'),
(7, 'Full pension', 'inactive', 'Pension Completa'),
(9, 'All drinks inlcluded', 'inactive', 'Todas las bebidad incluidas'),
(10, 'lolo', 'inactive', 'olol');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_price`
--

CREATE TABLE IF NOT EXISTS `_admin_price` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SEASON_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  `PLAN_id` int(11) unsigned NOT NULL,
  `has_weekdays` int(2) NOT NULL,
  `monday_price` float NOT NULL,
  `tuesday_price` float NOT NULL,
  `wednesday_price` float NOT NULL,
  `thursday_price` float NOT NULL,
  `friday_price` float NOT NULL,
  `saturday_price` float NOT NULL,
  `sunday_price` float NOT NULL,
  PRIMARY KEY (`price_id`),
  KEY `fk__ADMIN_PRICE_has_ADMIN_SEASON` (`SEASON_id`),
  KEY `FK_price_rooms_hotels` (`ROOMS_HOTELS_id`),
  KEY `FK_price_plan` (`PLAN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `_admin_price`
--

INSERT INTO `_admin_price` (`price_id`, `SEASON_id`, `ROOMS_HOTELS_id`, `price_per_night`, `PLAN_id`, `has_weekdays`, `monday_price`, `tuesday_price`, `wednesday_price`, `thursday_price`, `friday_price`, `saturday_price`, `sunday_price`) VALUES
(1, 1, 29, 100, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 33, 120, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 2, 29, 100, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 2, 33, 120, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 6, 29, 100, 1, 1, 100, 100, 100, 10, 100, 100, 100),
(9, 6, 40, 190, 1, 1, 190, 190, 190, 190, 190, 200, 200),
(10, 7, 44, 120, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 7, 46, 200, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 7, 47, 120, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 7, 48, 400, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 8, 47, 100, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(15, 8, 48, 300, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(16, 2, 48, 200, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(17, 7, 29, 120, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 9, 29, 230, 4, 0, 0, 0, 0, 0, 0, 0, 0),
(19, 10, 29, 500, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 11, 29, 120, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 11, 40, 100, 1, 1, 100, 100, 100, 100, 100, 120, 120);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_price_record`
--

CREATE TABLE IF NOT EXISTS `_admin_price_record` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season_id` int(10) unsigned NOT NULL,
  `rooms_hotels_id` int(10) unsigned NOT NULL,
  `price_per_night` float NOT NULL,
  `plan_id` int(11) unsigned NOT NULL,
  `elimination_date` date NOT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `_admin_price_record`
--

INSERT INTO `_admin_price_record` (`price_id`, `season_id`, `rooms_hotels_id`, `price_per_night`, `plan_id`, `elimination_date`) VALUES
(1, 1, 34, 200, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations`
--

CREATE TABLE IF NOT EXISTS `_admin_quotations` (
  `quote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CUSTOMERS_ci_id` int(10) unsigned NOT NULL,
  `EMPLOYEES_id` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_FLIGHTS_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_GENERIC_id` int(10) unsigned DEFAULT NULL,
  `QUOTATIONS_PACKAGE_id` int(3) unsigned DEFAULT NULL,
  `quote_date` date DEFAULT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_EMPLOYEES` (`EMPLOYEES_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_GENERIC` (`QUOTATIONS_GENERIC_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_FLIGHTS` (`QUOTATIONS_FLIGHTS_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_CUSTOMERS` (`CUSTOMERS_ci_id`),
  KEY `fk_ADMIN_QUOTATIONS_ADMIN_QUOTATIONS_HOTELS` (`QUOTATIONS_HOTELS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `_admin_quotations`
--

INSERT INTO `_admin_quotations` (`quote_id`, `CUSTOMERS_ci_id`, `EMPLOYEES_id`, `QUOTATIONS_HOTELS_id`, `QUOTATIONS_FLIGHTS_id`, `QUOTATIONS_GENERIC_id`, `QUOTATIONS_PACKAGE_id`, `quote_date`, `total`) VALUES
(2, 18277056, 1, 4, 26, 2, 0, '2010-10-23', 30418),
(3, 18277056, 1, NULL, NULL, NULL, 10, '2010-10-25', 0),
(4, 18277056, 1, NULL, 33, NULL, 11, '2010-10-25', 21),
(5, 18277056, 1, NULL, NULL, NULL, 12, '2010-10-25', 0),
(6, 18277056, 1, NULL, NULL, NULL, 13, '2010-10-25', 0),
(7, 18277056, 1, NULL, NULL, NULL, 14, '2010-10-25', 0),
(8, 18277056, 1, NULL, NULL, NULL, 15, '2010-10-27', 0),
(9, 18277056, 1, 5, NULL, NULL, 16, '2010-10-27', 18310),
(10, 18277056, 1, NULL, NULL, NULL, 17, '2010-10-29', 0),
(11, 188888, 1, 6, 34, 3, 0, '2010-10-31', 1311.34),
(19, 18277056, 1, NULL, NULL, 16, NULL, '2010-11-03', 24.6),
(20, 18277056, 1, 8, 37, NULL, 18, '2010-11-03', 47983.4),
(21, 18277056, 1, 9, 38, NULL, NULL, '2010-11-05', 30019.1),
(22, 18277056, 1, NULL, NULL, NULL, 19, '2010-11-05', 0),
(23, 18277056, 1, NULL, NULL, NULL, 25, '2010-11-05', 8400),
(24, 18277056, 5678, NULL, NULL, 26, NULL, '2010-11-08', 99),
(25, 18277056, 5678, 11, 44, NULL, NULL, '2010-11-09', 18433),
(26, 18277056, 5678, NULL, NULL, NULL, 27, '2010-11-10', 2700),
(27, 18277056, 5678, NULL, NULL, NULL, 28, '2010-11-10', 1290),
(28, 18277056, 5678, NULL, NULL, NULL, 29, '2010-11-10', 1160),
(29, 18277056, 5678, NULL, NULL, NULL, 31, '2010-11-14', 3300),
(30, 18277056, 5678, NULL, NULL, NULL, 32, '2010-11-14', 3645),
(31, 18277056, 5678, NULL, NULL, NULL, 33, '2010-11-14', 4500),
(32, 18277056, 5678, 12, 45, 28, 34, '2010-11-14', 26995.1),
(33, 18277056, 5678, 13, 46, 29, 35, '2010-11-14', 22157.9);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_flights`
--

CREATE TABLE IF NOT EXISTS `_admin_quotations_flights` (
  `quote_flight_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_flight_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `_admin_quotations_flights`
--

INSERT INTO `_admin_quotations_flights` (`quote_flight_id`, `status`, `total`) VALUES
(22, 'x', 8),
(23, 'x', 9.4),
(24, 'x', 2.2),
(25, 'x', 11.6),
(26, 'x', 624),
(27, 'x', 123),
(28, 'x', 1321),
(29, 'x', 145),
(30, 'x', 12),
(31, 'x', 69),
(32, 'x', 46),
(33, 'x', 21),
(34, 'x', 247.34),
(35, 'x', 123),
(36, 'x', 123),
(37, 'x', 123.45),
(38, 'x', 469.135),
(39, 'x', 49),
(40, 'x', 12),
(41, 'x', 12),
(42, 'x', 12),
(43, 'x', 13),
(44, 'x', 123),
(45, 'x', 123),
(46, 'x', 32.54);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_generic`
--

CREATE TABLE IF NOT EXISTS `_admin_quotations_generic` (
  `quotes_generic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total` float unsigned NOT NULL,
  PRIMARY KEY (`quotes_generic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `_admin_quotations_generic`
--

INSERT INTO `_admin_quotations_generic` (`quotes_generic_id`, `total`) VALUES
(1, 1018.28),
(2, 244),
(3, 264),
(4, 49.98),
(5, 49.98),
(6, 49.98),
(7, 49.98),
(8, 39.24),
(9, 39.24),
(10, 39.24),
(11, 88),
(12, 24.4),
(13, 12.12),
(14, 12.1),
(15, 246.2),
(16, 24.6),
(17, 12),
(18, 12),
(19, 24),
(20, 24),
(21, 36),
(22, 42),
(23, 64),
(24, 42),
(25, 39),
(26, 99),
(27, 4),
(28, 247.134),
(29, 1370.34);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_hotels`
--

CREATE TABLE IF NOT EXISTS `_admin_quotations_hotels` (
  `quote_hotel_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_check_in` date NOT NULL,
  `date_check_out` date NOT NULL,
  `PLAN_id` int(10) unsigned NOT NULL,
  `total` float unsigned NOT NULL,
  `persons` int(3) NOT NULL,
  `reservation_status` varchar(45) NOT NULL,
  `collect_status` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `billing_status` varchar(45) NOT NULL,
  PRIMARY KEY (`quote_hotel_id`),
  KEY `FK_qq_hh` (`PLAN_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `_admin_quotations_hotels`
--

INSERT INTO `_admin_quotations_hotels` (`quote_hotel_id`, `date_check_in`, `date_check_out`, `PLAN_id`, `total`, `persons`, `reservation_status`, `collect_status`, `payment_status`, `billing_status`) VALUES
(2, '2010-04-23', '2010-04-22', 1, 11, 0, 'AF', 'af', 'F', 'f'),
(3, '2010-01-01', '2010-02-01', 1, 6000, 0, 'x', 'x', 'x', 'x'),
(4, '2010-01-01', '2010-12-03', 1, 29550, 2, 'x', 'x', 'x', 'x'),
(5, '2010-01-02', '2010-12-01', 1, 18310, 2, 'x', 'x', 'x', 'x'),
(6, '2010-01-01', '2010-01-05', 1, 800, 2, 'x', 'x', 'x', 'x'),
(7, '2010-01-01', '2010-09-03', 1, 29550, 2, 'x', 'x', 'x', 'x'),
(8, '2010-01-01', '2010-09-03', 1, 47860, 2, 'x', 'x', 'x', 'x'),
(9, '2010-01-01', '2010-11-01', 1, 29550, 2, 'x', 'x', 'x', 'x'),
(10, '2010-01-01', '2010-11-30', 1, 36620, 2, 'x', 'x', 'x', 'x'),
(11, '2010-01-18', '2010-11-08', 1, 18310, 2, 'x', 'x', 'x', 'x'),
(12, '2010-01-03', '2010-11-30', 1, 22080, 2, 'x', 'x', 'x', 'x'),
(13, '2010-01-10', '2010-11-30', 1, 18310, 2, 'x', 'x', 'x', 'x');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_quotations_package`
--

CREATE TABLE IF NOT EXISTS `_admin_quotations_package` (
  `quote_package_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`quote_package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `_admin_quotations_package`
--

INSERT INTO `_admin_quotations_package` (`quote_package_id`, `check_in`, `check_out`, `total`) VALUES
(1, '0000-00-00', '0000-00-00', 2333),
(2, '0000-00-00', '0000-00-00', 4555),
(3, '0000-00-00', '0000-00-00', 2254),
(4, '0000-00-00', '0000-00-00', 1312),
(5, '0000-00-00', '0000-00-00', 908),
(6, '0000-00-00', '0000-00-00', 1808),
(7, '0000-00-00', '0000-00-00', 123),
(8, '0000-00-00', '0000-00-00', 454),
(9, '0000-00-00', '0000-00-00', 2708),
(10, '0000-00-00', '0000-00-00', 5600),
(11, '0000-00-00', '0000-00-00', 2708),
(12, '0000-00-00', '0000-00-00', 908),
(13, '0000-00-00', '0000-00-00', 1808),
(14, '0000-00-00', '0000-00-00', 2554),
(15, '2010-01-01', '2010-01-03', 1200),
(16, '2010-01-01', '2010-02-03', 2400),
(17, '2010-11-16', '2010-11-19', 3300),
(18, '2010-01-01', '2010-01-01', 3300),
(19, '2010-11-01', '2010-11-21', 454),
(20, '2010-06-25', '2010-11-05', 908),
(21, '2010-11-30', '2010-11-29', 2270),
(22, '2010-11-05', '2010-11-05', 3632),
(23, '2010-11-05', '2010-11-05', 3178),
(24, '2010-11-05', '2010-11-05', 2724),
(25, '2010-11-05', '2010-11-05', 8400),
(26, '2010-11-15', '2010-11-29', 2400),
(27, '2010-11-23', '2010-11-29', 2700),
(28, '0000-00-00', '0000-00-00', 1290),
(29, '2010-11-29', '2010-11-30', 1160),
(30, '0000-00-00', '0000-00-00', 3090),
(31, '2010-11-01', '2010-11-02', 3300),
(32, '2010-11-01', '2010-11-09', 3645),
(33, '2010-11-01', '2010-11-09', 4500),
(34, '2010-11-01', '2010-11-10', 4545),
(35, '2010-11-01', '2010-11-03', 2445);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms`
--

CREATE TABLE IF NOT EXISTS `_admin_rooms` (
  `room_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_spanish` varchar(45) NOT NULL,
  `name_english` varchar(45) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `_admin_rooms`
--

INSERT INTO `_admin_rooms` (`room_id`, `name_spanish`, `name_english`, `special`, `status`) VALUES
(1, 'Individual', 'Single', 0, 'active'),
(4, 'Doble', 'Double', 0, 'active'),
(6, 'Suite', 'Suite', 0, 'active'),
(7, 'Menores', 'Under-age', 1, 'active'),
(9, 'Matrimonial', 'Wedding room ', 0, 'active'),
(14, 'Triple', 'Triple', 0, 'active'),
(15, 'cuadruple', 'Quad', 0, 'inactive'),
(16, 'Mayores', 'Senior', 1, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_hotels`
--

CREATE TABLE IF NOT EXISTS `_admin_rooms_hotels` (
  `rooms_hotels_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ROOMS_id` int(10) unsigned NOT NULL,
  `HOTELS_id` int(10) unsigned NOT NULL,
  `commissionable` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL,
  `capacity` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`rooms_hotels_id`),
  KEY `fk__ADMIN_ROOMS_HOTELS_ADMIN_HOTELS` (`HOTELS_id`),
  KEY `fk__ADMIN_ROOMS_HOTELS_ADMIN_ROOMS` (`ROOMS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `_admin_rooms_hotels`
--

INSERT INTO `_admin_rooms_hotels` (`rooms_hotels_id`, `ROOMS_id`, `HOTELS_id`, `commissionable`, `description`, `capacity`, `status`) VALUES
(29, 1, 1, 1, 'Cama individual', 1, 'active'),
(33, 9, 2, 1, 'Cama matrimonial para recien casados', 2, 'active'),
(40, 4, 1, 1, 'Dos camas con A/A', 2, 'active'),
(41, 9, 1, 1, 'Cama matrimonial con AA', 2, 'active'),
(42, 6, 1, 1, 'habitacion amplia', 4, 'inactive'),
(43, 1, 2, 1, 'Cama individual', 1, 'active'),
(44, 1, 5, 1, 'cama individual', 1, 'active'),
(45, 4, 5, 1, 'cama doble', 2, 'active'),
(46, 9, 5, 1, 'cama matrimonial', 2, 'active'),
(47, 1, 6, 1, 'cuarto personal con AA', 1, 'active'),
(48, 6, 6, 1, 'cama amplia con jacuzzi', 4, 'active'),
(49, 6, 5, 1, 'de todoo', 4, 'active'),
(50, 7, 1, 0, 'menores de 1 a?o', 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_package`
--

CREATE TABLE IF NOT EXISTS `_admin_rooms_per_package` (
  `room_per_package_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PACKAGE_id` int(10) unsigned NOT NULL,
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `price_per_person` float NOT NULL,
  `additional_night` double NOT NULL,
  `price_per_kid` double NOT NULL,
  PRIMARY KEY (`room_per_package_id`),
  KEY `FK_room_per_package_package` (`PACKAGE_id`),
  KEY `FK_room_per_package_rooms` (`ROOMS_HOTELS_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `_admin_rooms_per_package`
--

INSERT INTO `_admin_rooms_per_package` (`room_per_package_id`, `PACKAGE_id`, `ROOMS_HOTELS_id`, `price_per_person`, `additional_night`, `price_per_kid`) VALUES
(1, 1, 29, 1200, 100, 45),
(2, 1, 40, 900, 0, 0),
(3, 2, 29, 3000, 0, 0),
(4, 2, 40, 2500, 0, 0),
(5, 3, 40, 4000, 0, 0),
(6, 3, 29, 3500, 0, 0),
(7, 4, 29, 3200, 0, 0),
(8, 4, 40, 2800, 0, 0),
(9, 5, 43, 4863, 0, 0),
(10, 5, 33, 4700, 0, 0),
(11, 1, 33, 333, 0, 0),
(12, 1, 44, 656, 0, 0),
(13, 1, 41, 454, 0, 0),
(14, 6, 29, 67, 0, 0),
(15, 6, 40, 76, 0, 0),
(16, 6, 41, 87, 0, 0),
(17, 6, 33, 98, 0, 0),
(18, 6, 44, 97, 0, 0),
(19, 6, 49, 45, 0, 0),
(20, 7, 29, 100, 0, 0),
(21, 8, 29, 100, 0, 0),
(22, 8, 47, 90, 0, 0),
(23, 1, 43, 123, 0, 0),
(24, 9, 29, 200, 0, 0),
(25, 9, 40, 300, 0, 0),
(26, 9, 41, 250, 0, 0),
(27, 9, 33, 350, 0, 0),
(28, 10, 29, 120, 0, 0),
(29, 10, 40, 100, 0, 0),
(30, 11, 29, 333, 100, 32),
(31, 11, 40, 665, 150, 65),
(32, 11, 33, 1111, 99, 11),
(33, 13, 29, 120, 80, 90),
(34, 13, 49, 400, 300, 200);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_package_quote`
--

CREATE TABLE IF NOT EXISTS `_admin_rooms_per_package_quote` (
  `QUOTE_PACKAGE_id` int(3) unsigned NOT NULL,
  `ROOM_PER_PACKAGE_id` int(10) unsigned NOT NULL,
  `number_of_people` int(2) NOT NULL,
  `number_of_kids` int(11) NOT NULL,
  `number_of_additional_nights` int(11) NOT NULL,
  KEY `FK_rooms_per_package_quote` (`QUOTE_PACKAGE_id`),
  KEY `FK_rooms_per_package_rooms` (`ROOM_PER_PACKAGE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_rooms_per_package_quote`
--

INSERT INTO `_admin_rooms_per_package_quote` (`QUOTE_PACKAGE_id`, `ROOM_PER_PACKAGE_id`, `number_of_people`, `number_of_kids`, `number_of_additional_nights`) VALUES
(1, 1, 1, 0, 0),
(3, 2, 2, 0, 0),
(3, 13, 1, 0, 0),
(4, 12, 2, 0, 0),
(5, 13, 2, 0, 0),
(6, 13, 2, 0, 0),
(6, 2, 1, 0, 0),
(7, 23, 1, 0, 0),
(8, 13, 1, 0, 0),
(9, 13, 2, 0, 0),
(9, 2, 2, 0, 0),
(10, 8, 2, 0, 0),
(11, 13, 2, 0, 0),
(11, 2, 2, 0, 0),
(12, 13, 2, 0, 0),
(13, 13, 2, 0, 0),
(13, 2, 1, 0, 0),
(14, 13, 1, 0, 0),
(14, 2, 1, 0, 0),
(15, 1, 1, 0, 0),
(16, 1, 2, 0, 0),
(17, 1, 2, 0, 0),
(17, 2, 1, 0, 0),
(18, 1, 2, 0, 0),
(18, 2, 1, 0, 0),
(19, 13, 1, 0, 0),
(20, 13, 2, 0, 0),
(21, 13, 5, 0, 0),
(22, 13, 8, 0, 0),
(23, 13, 7, 0, 0),
(24, 13, 6, 0, 0),
(25, 1, 7, 0, 0),
(26, 1, 2, 0, 0),
(27, 2, 3, 0, 0),
(28, 1, 1, 2, 0),
(29, 31, 1, 2, 0),
(29, 30, 1, 1, 0),
(30, 1, 1, 2, 0),
(30, 2, 2, 0, 0),
(31, 1, 100, 2, 0),
(31, 2, 0, 1, 0),
(32, 1, 100, 1, 3),
(32, 2, 0, 2, 3),
(33, 1, 3, 0, 3),
(34, 1, 2, 1, 4),
(34, 2, 1, 0, 4),
(35, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `_admin_rooms_per_quote`
--

CREATE TABLE IF NOT EXISTS `_admin_rooms_per_quote` (
  `ROOMS_HOTELS_id` int(10) unsigned NOT NULL,
  `QUOTATIONS_HOTELS_id` int(10) unsigned NOT NULL,
  `quantity_of_rooms` int(10) unsigned NOT NULL,
  `subtotal` float NOT NULL,
  `unit_price` varchar(250) NOT NULL,
  PRIMARY KEY (`ROOMS_HOTELS_id`,`QUOTATIONS_HOTELS_id`),
  KEY `FK_quotations_hotels_per_quote` (`QUOTATIONS_HOTELS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_rooms_per_quote`
--

INSERT INTO `_admin_rooms_per_quote` (`ROOMS_HOTELS_id`, `QUOTATIONS_HOTELS_id`, `quantity_of_rooms`, `subtotal`, `unit_price`) VALUES
(29, 2, 22, 0, ''),
(29, 3, 2, 6000, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />'),
(29, 4, 1, 11240, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(29, 6, 2, 800, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />'),
(29, 7, 1, 11240, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(29, 8, 1, 11240, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(29, 9, 1, 11240, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(29, 12, 2, 22080, '100BsF. (desde 2010-01-01 hasta 2010-01-31).<br />100BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 4, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 5, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 7, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 8, 2, 36620, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 9, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 10, 2, 36620, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 11, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />'),
(40, 13, 1, 18310, '190BsF. (desde 2010-06-01 hasta 2010-09-03).<br />');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_season`
--

CREATE TABLE IF NOT EXISTS `_admin_season` (
  `season_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`season_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `_admin_season`
--

INSERT INTO `_admin_season` (`season_id`, `date_start`, `date_end`) VALUES
(1, '2010-01-01', '2010-01-31'),
(2, '2010-02-01', '2010-02-15'),
(3, '2010-02-16', '2010-03-31'),
(4, '2010-04-05', '2010-04-30'),
(5, '2010-05-01', '2010-06-01'),
(6, '2010-06-01', '2010-09-03'),
(7, '2010-01-01', '2010-01-15'),
(8, '2010-01-16', '2010-01-30'),
(9, '2010-02-03', '2010-02-13'),
(10, '2009-12-12', '2009-12-24'),
(11, '2014-01-01', '2014-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_seasons_per_hotel`
--

CREATE TABLE IF NOT EXISTS `_admin_seasons_per_hotel` (
  `SEASON_id` int(10) unsigned NOT NULL,
  `HOTEL_id` int(10) unsigned NOT NULL,
  `season_name` varchar(50) NOT NULL,
  KEY `hotel_in_seasons_per_hotel` (`HOTEL_id`),
  KEY `season_in_seasons_per_hotel` (`SEASON_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_seasons_per_hotel`
--

INSERT INTO `_admin_seasons_per_hotel` (`SEASON_id`, `HOTEL_id`, `season_name`) VALUES
(6, 1, 'okok'),
(6, 1, 'okok'),
(6, 1, 'okok'),
(6, 1, 'okok'),
(7, 5, 'fin de semana'),
(7, 6, 'test1'),
(8, 6, 'test2'),
(2, 6, 'test3'),
(7, 1, 'test4'),
(9, 1, 'test5'),
(10, 1, 'test7'),
(11, 1, 'mmm');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_travelers`
--

CREATE TABLE IF NOT EXISTS `_admin_travelers` (
  `traveler_ci_id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `passport` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `type` enum('senior','kid','adult') DEFAULT NULL,
  PRIMARY KEY (`traveler_ci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_travelers`
--

INSERT INTO `_admin_travelers` (`traveler_ci_id`, `name`, `lastname`, `passport`, `email`, `type`) VALUES
(0, 'Mercedes', 'Amaya', 'hih', 'ih', 'adult'),
(1, 'pedro', 'munera', '1', '1', 'adult'),
(2, 'peito', 'munera', '2', '2', 'kid'),
(23, 'mm', 'mm', '23', '23', 'adult'),
(111, 'nombre', 'apellido', '11', '111', 'adult'),
(177, 'Alex', 'Brito', '7', '7', 'adult'),
(178, 'Ana', 'Moreno', '7', '7', 'kid'),
(1888, 'Mario ', 'Moreno', '8', '8', 'adult'),
(1998, 'koko', 'ko', '1998', '1998', 'adult'),
(18888, 'alito', 'pacheco', '777', 'mmmm', 'adult'),
(18898, 'Mario', 'Munera', '188981', '18898', 'adult'),
(18998, 'Mario ', 'Munera', '1899889', '8998', 'adult'),
(19909, 'Mercedes ', 'Amaya', '19909', '19909', 'adult'),
(188998, 'Mario', 'Munera', '188998', '18998', 'adult'),
(189878, 'Mario', 'Munera', '1899889', '1899889', 'adult');

-- --------------------------------------------------------

--
-- Table structure for table `_admin_travelers_per_flight`
--

CREATE TABLE IF NOT EXISTS `_admin_travelers_per_flight` (
  `TRAVELERS_ci_id` int(10) unsigned NOT NULL,
  `FLIGHTS_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`TRAVELERS_ci_id`,`FLIGHTS_id`),
  KEY `fk__ADMIN_TRAVELERS_has_ADMIN_FLIGHTS_ADMIN_TRAVELERS` (`TRAVELERS_ci_id`),
  KEY `fk__ADMIN_TRAVELERS_has_ADMIN_FLIGHTS_ADMIN_FLIGHTS` (`FLIGHTS_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_admin_travelers_per_flight`
--

INSERT INTO `_admin_travelers_per_flight` (`TRAVELERS_ci_id`, `FLIGHTS_id`) VALUES
(0, 99),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 111),
(1, 112),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(2, 80),
(2, 81),
(2, 100),
(2, 101),
(2, 110),
(23, 116),
(111, 113),
(177, 87),
(177, 88),
(178, 86),
(1888, 84),
(1888, 85),
(1888, 86),
(1998, 92),
(1998, 93),
(18888, 112),
(18898, 99),
(18998, 96),
(19909, 96),
(19909, 97),
(19909, 98),
(188998, 97),
(188998, 98),
(189878, 94),
(189878, 95);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `_admin_categories_package`
--
ALTER TABLE `_admin_categories_package`
  ADD CONSTRAINT `FK_categorie_packages_cat` FOREIGN KEY (`CATEGORIE_id`) REFERENCES `_admin_categories` (`categorie_id`),
  ADD CONSTRAINT `FK_categorie_packages_pack` FOREIGN KEY (`PACKAGE_id`) REFERENCES `_admin_packages` (`package_id`);

--
-- Constraints for table `_admin_flights`
--
ALTER TABLE `_admin_flights`
  ADD CONSTRAINT `destination_flight_city` FOREIGN KEY (`destination`) REFERENCES `_admin_flights_city` (`flight_city_id`),
  ADD CONSTRAINT `FK_flights_airline` FOREIGN KEY (`AIRLINES_id`) REFERENCES `_admin_airlines` (`airline_id`),
  ADD CONSTRAINT `origin_flight_city` FOREIGN KEY (`origin`) REFERENCES `_admin_flights_city` (`flight_city_id`);

--
-- Constraints for table `_admin_flights_city`
--
ALTER TABLE `_admin_flights_city`
  ADD CONSTRAINT `country_city_flight` FOREIGN KEY (`FLIGHTS_COUNTRY_id`) REFERENCES `_admin_flights_country` (`flight_country_id`),
  ADD CONSTRAINT `FK_flights_city_country` FOREIGN KEY (`FLIGHTS_COUNTRY_id`) REFERENCES `_admin_flights_country` (`flight_country_id`);

--
-- Constraints for table `_admin_flights_per_quote`
--
ALTER TABLE `_admin_flights_per_quote`
  ADD CONSTRAINT `FK_flights_in_FPQ` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_quotations_in_FPQ` FOREIGN KEY (`QUOTATIONS_FLIGHTS_id`) REFERENCES `_admin_quotations_flights` (`quote_flight_id`);

--
-- Constraints for table `_admin_hotels_plans`
--
ALTER TABLE `_admin_hotels_plans`
  ADD CONSTRAINT `FK_hotel_hotel` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `FK_hotel_plan` FOREIGN KEY (`PLANS_id`) REFERENCES `_admin_plans` (`plan_id`);

--
-- Constraints for table `_admin_hotel_packages`
--
ALTER TABLE `_admin_hotel_packages`
  ADD CONSTRAINT `FK_hotel_packages_hotel` FOREIGN KEY (`HOTEL_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `FK_hotel_packages_package` FOREIGN KEY (`PACKAGE_id`) REFERENCES `_admin_packages` (`package_id`);

--
-- Constraints for table `_admin_price`
--
ALTER TABLE `_admin_price`
  ADD CONSTRAINT `FK_price_plan` FOREIGN KEY (`PLAN_id`) REFERENCES `_admin_plans` (`plan_id`),
  ADD CONSTRAINT `fk_price_rooms_hotels` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`),
  ADD CONSTRAINT `fk_price_season` FOREIGN KEY (`SEASON_id`) REFERENCES `_admin_season` (`season_id`);

--
-- Constraints for table `_admin_quotations`
--
ALTER TABLE `_admin_quotations`
  ADD CONSTRAINT `FK_quotations_customer` FOREIGN KEY (`CUSTOMERS_ci_id`) REFERENCES `_admin_customers` (`customer_ci_id`),
  ADD CONSTRAINT `FK_quotations_employees` FOREIGN KEY (`EMPLOYEES_id`) REFERENCES `_admin_employees` (`employees_id`),
  ADD CONSTRAINT `FK_quotations_flights` FOREIGN KEY (`QUOTATIONS_FLIGHTS_id`) REFERENCES `_admin_quotations_flights` (`quote_flight_id`),
  ADD CONSTRAINT `FK_quotations_generic` FOREIGN KEY (`QUOTATIONS_GENERIC_id`) REFERENCES `_admin_quotations_generic` (`quotes_generic_id`);

--
-- Constraints for table `_admin_quotations_hotels`
--
ALTER TABLE `_admin_quotations_hotels`
  ADD CONSTRAINT `FK_qq_hh` FOREIGN KEY (`PLAN_id`) REFERENCES `_admin_plans` (`plan_id`);

--
-- Constraints for table `_admin_rooms_hotels`
--
ALTER TABLE `_admin_rooms_hotels`
  ADD CONSTRAINT `FK_hotel_room` FOREIGN KEY (`HOTELS_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `FK_rooms_rooms` FOREIGN KEY (`ROOMS_id`) REFERENCES `_admin_rooms` (`room_id`);

--
-- Constraints for table `_admin_rooms_per_package`
--
ALTER TABLE `_admin_rooms_per_package`
  ADD CONSTRAINT `FK_room_per_package_package` FOREIGN KEY (`PACKAGE_id`) REFERENCES `_admin_packages` (`package_id`),
  ADD CONSTRAINT `FK_room_per_package_rooms` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`);

--
-- Constraints for table `_admin_rooms_per_package_quote`
--
ALTER TABLE `_admin_rooms_per_package_quote`
  ADD CONSTRAINT `FK_rooms_per_package_quote` FOREIGN KEY (`QUOTE_PACKAGE_id`) REFERENCES `_admin_quotations_package` (`quote_package_id`),
  ADD CONSTRAINT `FK_rooms_per_package_rooms` FOREIGN KEY (`ROOM_PER_PACKAGE_id`) REFERENCES `_admin_rooms_per_package` (`room_per_package_id`);

--
-- Constraints for table `_admin_rooms_per_quote`
--
ALTER TABLE `_admin_rooms_per_quote`
  ADD CONSTRAINT `FK_quotations_hotels_per_quote` FOREIGN KEY (`QUOTATIONS_HOTELS_id`) REFERENCES `_admin_quotations_hotels` (`quote_hotel_id`),
  ADD CONSTRAINT `FK_rooms_hotels_per_quote` FOREIGN KEY (`ROOMS_HOTELS_id`) REFERENCES `_admin_rooms_hotels` (`rooms_hotels_id`);

--
-- Constraints for table `_admin_seasons_per_hotel`
--
ALTER TABLE `_admin_seasons_per_hotel`
  ADD CONSTRAINT `hotel_in_seasons_per_hotel` FOREIGN KEY (`HOTEL_id`) REFERENCES `_admin_hotels` (`hotel_id`),
  ADD CONSTRAINT `season_in_seasons_per_hotel` FOREIGN KEY (`SEASON_id`) REFERENCES `_admin_season` (`season_id`);

--
-- Constraints for table `_admin_travelers_per_flight`
--
ALTER TABLE `_admin_travelers_per_flight`
  ADD CONSTRAINT `FK_travelers_per_flight_flihts` FOREIGN KEY (`FLIGHTS_id`) REFERENCES `_admin_flights` (`flight_id`),
  ADD CONSTRAINT `FK_travelers_travelers_per_flight` FOREIGN KEY (`TRAVELERS_ci_id`) REFERENCES `_admin_travelers` (`traveler_ci_id`);
